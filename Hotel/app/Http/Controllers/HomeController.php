<?php

namespace App\Http\Controllers;

use App\Models\room;
use App\Models\slider;
use App\Models\Story;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $sliders = slider::all();
        $story = Story::first(); 
        $rooms = room::all();
        return view('users.home', compact('sliders', 'story', 'rooms'));
    }
    
}
