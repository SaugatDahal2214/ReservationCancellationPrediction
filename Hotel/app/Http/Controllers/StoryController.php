<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::all();
        return view('admin.stories.index', compact('stories'));
    }

    public function create()
    {
        return view('admin.stories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'paragraph_one' => 'required|string',
            'paragraph_two' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $data = $request->only(['paragraph_one', 'paragraph_two']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Story::create($data);

        return redirect()->route('about.index')->with('success', 'Story created successfully!');
    }

    /**
     * Show the form for editing the specified story.
     */
    public function edit(Story $story)
    {
        return view('admin.stories.edit', compact('story'));
    }

    /**
     * Update the specified story in storage.
     */
    public function update(Request $request, Story $story)
    {
        $request->validate([
            'paragraph_one' => 'required|string',
            'paragraph_two' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $data = $request->only(['paragraph_one', 'paragraph_two']);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($story->image) {
                Storage::disk('public')->delete($story->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $story->update($data);

        return redirect()->route('about.index')->with('success', 'Story updated successfully!');
    }

    /**
     * Remove the specified story from storage.
     */
    public function delete(Story $story)
    {
        if ($story->image) {
            Storage::disk('public')->delete($story->image);
        }
        
        $story->delete();

        return redirect()->route('about.index')->with('success', 'Story deleted successfully!');
    }
}
