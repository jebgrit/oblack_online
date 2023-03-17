<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * all slider
     */
    public function allSlider()
    {
        $sliders = Slider::latest()->get();

        return view('backend.slider.slider_all', compact('sliders'));
    }

    /**
     * add slider
     */
    public function addSlider()
    {
        return view('backend.slider.slider_add');
    }

    /**
     *  store slider
     */
    public function storeSlider(Request $request)
    {
        $request->validate([
            'slider_title' => ['required', 'max:100'],
            'slider_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:1024'],
        ]);

        # get the image from form, rename it and and resize it
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(2376, 807)->save('upload/slider/' . $name_gen);

        $save_url = 'upload/slider/' . $name_gen;

        Slider::insert([
            'slider_title' => $request->slider_title,
            'slider_image' => $save_url,
            'created' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Slider ajoutée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    }

    /**
     *  edit slider
     */
    public function editSlider($id)
    {
        $slider = Slider::findOrFail($id);

        return view('backend.slider.slider_edit', compact('slider'));
    }

    /**
     *  update slider
     */
    public function updateSlider(Request $request)
    {
        $request->validate([
            'slider_title' => ['required', 'max:100'],
            'slider_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:1024'],
        ]);

        $slider_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('slider_image')) {

            # get the image from form, rename it and and resize it
            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(2376, 807)->save('upload/slider/' . $name_gen);

            $save_url = 'upload/slider/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'slider_image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Slider mis à jour avec succès',
                'alert-type' => 'success'
            );

            return redirect()->route('all.slider')->with($notification);
        } else {

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Slider mis à jour avec succès',
                'alert-type' => 'success'
            );

            return redirect()->route('all.slider')->with($notification);
        }
    }

    /**
     *  delete slider
     */
    public function deleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        unlink($img);

        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
