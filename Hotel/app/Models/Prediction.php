<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'room_type_reserved',
        'price',
        'special_requests',
        'prediction_output',
    ];
}
