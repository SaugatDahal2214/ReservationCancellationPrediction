<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if it follows naming convention)
    protected $table = 'bookings';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'no_of_adults',
        'no_of_children',
        'check_in_date',
        'check_out_date',
        'meal_type',
        'repeated_customer',
        'special_requests',
        'price',
        'lead_time',
        'arrival_month',
        'arrival_date',
        'no_of_weekdays',
        'no_of_weekend_days',
        'email',
        'no_of_previous_cancellations',
        'no_of_previous_bookings_not_canceled',
        'booking_status',
        'required_car_parking_space',    // New field
        'room_type_reserved',            // New field
    ];
    

    // Define the attributes that should be cast to native types
    protected $casts = [
        'repeated_customer' => 'boolean',
        'special_requests' => 'array',
        'booking_status' => 'boolean',
        'check_in_date' => 'date',
        'check_out_date' => 'date',
    ];

    // Add any relationships, scopes, or additional methods here as needed
}
