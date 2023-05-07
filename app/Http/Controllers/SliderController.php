<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function addslider()
    {
        return view('admin.addslider');
    }

    public function sliders()
    {
        $sliders = Slider::All();
        return view('admin.sliders')->with('sliders');
    } 

    public function saveslider(Request $request)
    {
        $this->validate($request, [
            'description1' => 'required',
            'description2' => 'required',
            'slider_image' => 'image|nullable|max:1999|required']);

        
            //get filename with extension
            $filenameWithExt = $request->file('slider_image')->getClientOriginalName();
            //get just filename
            $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            //get just file extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //upload image
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);
        

        $slider = new Slider();
        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');
        $slider->slider_image = $fileNameToStore;
        //equals to 1 for the purpose of deactivation
        $slider->status = 1;

        $slider->save();

        return back()->with('status', 'Slider saved successfully');
    }
}
