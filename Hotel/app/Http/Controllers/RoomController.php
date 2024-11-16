<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class RoomController extends Controller
{
    const ROOM_TYPES = [
        'Single' => 0,
        'Double' => 1,
        'Suite' => 2,
        'Deluxe' => 3,
        'Executive' => 4,
        'Family' => 5,
        'Presidential' => 6
    ];

    public function showRoom(){
        $rooms = Room::all();
        $roomTypes = self::ROOM_TYPES;
        return view('users.rooms', compact('rooms', 'roomTypes'));
    }
    
    public function index()
{
    $rooms = Room::all();
    return view('admin.rooms.index', compact('rooms'));
}

public function create()
{
    return view('admin.rooms.create', ['roomTypes' => self::ROOM_TYPES]);
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'type' => 'required|string|in:' . implode(',', array_keys(self::ROOM_TYPES)),
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'price' => 'required|numeric'
    ]);

    $data = $request->only(['title', 'description', 'price']);
    
    // Map room type to its integer value
    $data['type'] = self::ROOM_TYPES[$request->type];

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('rooms', 'public');
    }

    Room::create($data);

    return redirect()->route('rooms.index')->with('success', 'Room created successfully!');
}


public function edit(Room $room)
{
    return view('admin.rooms.edit', compact('room'))->with('roomTypes', self::ROOM_TYPES);
}

public function update(Request $request, Room $room)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'type' => 'required|string|in:' . implode(',', array_keys(self::ROOM_TYPES)),
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'price' => 'required|numeric'
    ]);

    $data = $request->only(['title', 'description', 'price']);
    
    // Map room type to its integer value
    $data['type'] = self::ROOM_TYPES[$request->type];

    if ($request->hasFile('image')) {
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }
        $data['image'] = $request->file('image')->store('rooms', 'public');
    }

    $room->update($data);

    return redirect()->route('rooms.index')->with('success', 'Room updated successfully!');
}


public function delete(Room $room)
{
    if ($room->image) {
        Storage::disk('public')->delete($room->image);
    }
    
    $room->delete();

    return redirect()->route('rooms.index')->with('success', 'Room deleted successfully!');
}

}
