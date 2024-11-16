<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Prediction;

use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{


    public function index()
    {
        $bookings = Booking::all(); // Fetch all bookings
        return view('admin.bookings.index', ['bookings' => $bookings]); // Pass bookings data to the view
    }
    public function PredictionIndex()
    {
        $predictions = Prediction::all(); // Fetch all bookings
        return view('admin.predictions.index', ['predictions' => $predictions]); // Pass bookings data to the view
    }

    // Show the booking form
    public function showForm($room_type, $price)
    {
        return view('users.booking', compact('room_type', 'price')); // Returns the form view (e.g., resources/views/booking_form.blade.php)
    }

    // Handle form submission
    public function submitForm(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'no_of_adults' => 'required|integer|min:1',
            'no_of_children' => 'required|integer|min:0',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'meal_type' => 'required|integer|in:0,1,2',
            'special_requests' => 'array|max:5',
            'price' => 'required|numeric|min:0',
            'email' => 'required|email',
            'required_car_parking_space' => 'boolean',
            'room_type_reserved' => 'required|string|in:' . implode(',', array_keys(RoomController::ROOM_TYPES))
        ]);

        // Check if the customer is a repeated customer based on email existence
        $repeatedCustomer = Booking::where('email', $request->email)->exists() ? 1 : 0;

        // Calculate additional fields
        $checkInDate = Carbon::parse($request->check_in_date);
        $checkOutDate = Carbon::parse($request->check_out_date);
        $bookedDate = Carbon::now();

        // Calculate previous cancellations and successful bookings
        $previousBookings = Booking::where('email', $request->email)->get();
        $no_of_previous_cancellations = $previousBookings->where('booking_status', 1)->count();
        $no_of_previous_bookings_not_canceled = $previousBookings->where('booking_status', 0)->count();

        $specialRequestCount = count($request->special_requests ?? []);
        $roomTypeNumeric = RoomController::ROOM_TYPES[$request->room_type_reserved];
        $leadTime = (int) $bookedDate->diffInDays($checkInDate);
        $arrivalMonth = $checkInDate->month;
        $arrivalDate = $checkInDate->day;
        $weekendDays = $checkInDate->diffInDaysFiltered(fn($date) => $date->isWeekend(), $checkOutDate);
        $weekdays = $checkInDate->diffInDaysFiltered(fn($date) => !$date->isWeekend(), $checkOutDate);

        $predictionData = [
            'no_of_adults' => $request->no_of_adults,
            'no_of_children' => $request->no_of_children,
            'no_of_weekend_nights' => $weekendDays,
            'no_of_week_nights' => $weekdays,
            'type_of_meal_plan' => $request->meal_type,
            'required_car_parking_space' => $request->required_car_parking_space ?? 0,
            'room_type_reserved' => $roomTypeNumeric,
            'lead_time' => $leadTime,
            'arrival_month' => $arrivalMonth,
            'arrival_date' => $arrivalDate,
            'repeated_guests' => $repeatedCustomer,
            'no_of_previous_cancellations' => $no_of_previous_cancellations,
            'no_of_previous_bookings_not_canceled' => $no_of_previous_bookings_not_canceled,
            'avg_price_per_room' => $request->price,
            'no_of_special_requests' => $specialRequestCount
        ];

        $scriptPath = base_path('scripts/prediction.py');
        $values = array_values($predictionData);
        $command = 'python "' . $scriptPath . '" ' . escapeshellarg(json_encode($values));
        $output = shell_exec($command);

        $lines = explode("\n", $output);
        $prediction = null; // Initialize prediction variable

        foreach ($lines as $line) {
            // Trim whitespace and check if the line contains a valid numeric value
            $line = trim($line);
            if (is_numeric($line)) {
                // Convert the valid numeric prediction to an integer, rounding if necessary
                $prediction = (int) round($line);
                break;
            }
        }

        if ($prediction === null) {
            Log::error("Prediction output is invalid: " . $output);
            $prediction = "NO"; // Default or fallback if no valid prediction found
        }


        // Store the data in the database
        $booking = new Booking();
        $booking->no_of_adults = $request->no_of_adults;
        $booking->no_of_children = $request->no_of_children;
        $booking->check_in_date = $checkInDate;
        $booking->check_out_date = $checkOutDate;
        $booking->meal_type = $request->meal_type;
        $booking->repeated_customer = $repeatedCustomer;
        $booking->special_requests = json_encode($request->special_requests);
        $booking->price = $request->price;
        $booking->lead_time = $leadTime;
        $booking->arrival_month = $arrivalMonth;
        $booking->arrival_date = $arrivalDate;
        $booking->no_of_weekdays = $weekdays;
        $booking->no_of_weekend_days = $weekendDays;
        $booking->email = $request->email;
        $booking->no_of_previous_cancellations = $no_of_previous_cancellations;
        $booking->no_of_previous_bookings_not_canceled = $no_of_previous_bookings_not_canceled;
        $booking->required_car_parking_space = $request->required_car_parking_space ?? false;
        $booking->room_type_reserved = $roomTypeNumeric;
        $booking->no_of_special_requests = $specialRequestCount;
        $booking->booking_status = 0;
        $booking->save();

        // Save the prediction result in the predictions table
        $predictionModel = new Prediction();
        $predictionModel->email = $request->email;
        $predictionModel->room_type_reserved = $request->room_type_reserved;
        $predictionModel->price = $request->price;
        $predictionModel->special_requests = json_encode($request->special_requests);
        $predictionModel->prediction_output = $prediction; // Store the output of the prediction
        $predictionModel->save();

        $paymentAmount = $prediction === 1
            ? $booking->price * 0.7  // High risk: 70% of price
            : $booking->price * 0.4;      // Low risk: Full price

        return redirect()->route('stripe.payment', [
            'bookingId' => $booking->id,
            'paymentAmount' => $paymentAmount,
        ]);
    }
}
