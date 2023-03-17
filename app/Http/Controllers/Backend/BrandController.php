<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function allBrand()
    {
        $brands = Brand::latest()->get();

        return view('backend.brand.brand_all', compact('brands'));
    }

    public function addBrand()
    {
        return view('backend.brand.brand_add');
    }

    public function storeBrand(Request $request)
    {
        $request->validate([
            'brand_name' => ['required', 'string', 'max:170'],
            'brand_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:1024'],
        ]);

        # get the image from form, rename it and and resize it

        // if ($request->hasFile('brand_name')) {
        $image = $request->file('brand_image');

        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);
        $save_url = 'upload/brand/' . $name_gen;
        // } else {
        // $save_url = 'upload/no_image.jpg';
        // }

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Marque ajoutée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);
    }

    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);

        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function updateBrand(Request $request)
    {
        $request->validate([
            'brand_name' => ['required', 'string', 'max:170'],
            'brand_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:1024'],
        ]);


        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {

            # get the image from form, rename it and and resize it
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);

            $save_url = 'upload/brand/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Marque mis à jour avec succès',
                'alert-type' => 'success'
            );

            return redirect()->route('all.brand')->with($notification);
        } else {

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Marque mis à jour avec succès',
                'alert-type' => 'success'
            );

            return redirect()->route('all.brand')->with($notification);
        }
    }

    public function deleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Marque supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
