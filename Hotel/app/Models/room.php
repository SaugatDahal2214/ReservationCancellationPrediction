<?php

namespace App\Models;

use App\Http\Controllers\RoomController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class room extends Model
{
    use HasFactory;

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'title',
        'type',
        'description',
        'image',
        'price',
    ];

    public function getTypeAsStringAttribute()
{
    return array_search($this->type, RoomController::ROOM_TYPES);
}
}
