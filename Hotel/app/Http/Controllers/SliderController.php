<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\slider;
use Illuminate\Support\Facades\File;


class SliderController extends Controller
{
    public function index(){
        $sliders = slider::all();
        return view('admin.sliders.index',['sliders' => $sliders]);
        
    }

    public function create(){
        return view('admin.sliders.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:png,jpg,svg'
        ]);

        if($request->has('image')){

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;

            $path = 'uploads/slider/';
            $file -> move($path ,$filename);
        }

        $newSlider = Slider::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path.$filename
        ]);

        return redirect(route('slider.index'));
    }

    public function edit(Slider $slider){
        return view('admin.sliders.edit', ['slider' => $slider]);
    }
    
    public function update(Slider $slider, Request $request){
        $data = $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:png,jpg,svg',
            'description' => 'required'
        ]);
        
        if($request->has('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'uploads/slider/';
            $file->move($path, $filename);
    
            if(File::exists($slider->image)){
                File::delete($slider->image);
            }
            $slider->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $path.$filename
            ]);
        } else {
            $slider->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
        }
        return redirect(route('slider.index'))->with('success','Slider updated successfully');
    }

    public function delete(Slider $slider){
        $slider->delete(); // Delete slider
        return redirect(route('slider.index'))->with('success','Slider deleted successfully');
    }
}
