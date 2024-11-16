<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function payment(Request $request)
    {
        $booking = Booking::findOrFail($request->bookingId);
        $paymentAmount = $request->paymentAmount; // Amount passed from the previous step
    
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
    
        $response = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Room Booking - ' . $booking->room_type_reserved,
                        ],
                        'unit_amount' => $paymentAmount * 100, // Stripe expects amount in cents
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success', ['bookingId' => $booking->id]),
            'cancel_url' => route('stripe.cancel', ['bookingId' => $booking->id]),
        ]);
    
        return redirect()->away($response->url);
    }
    
    public function success(){

        return 'yay it works';
    }
    public function cancel(){
         return 'Payment Canceled';
    }
}
