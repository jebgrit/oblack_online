<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    //
    public function siteSetting()
    {
        $site = SiteSetting::find(1);

        return view('backend.setting.site_setting', compact('site'));
    }

    public function storeSetting(Request $request)
    {
        // dd($request);
        $site_id = $request->id;

        if ($request->hasFile('company_logo', 'favicon')) {


            // logo
            $image = $request->file('company_logo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(180, 56)->save('upload/logo/' . $name_gen);
            $save_url = 'upload/logo/' . $name_gen;

            // favicon
            $image_fav = $request->file('favicon');
            $name_gen_fav = hexdec(uniqid()) . '.' . $image_fav->getClientOriginalExtension();
            Image::make($image_fav)->resize(180, 56)->save('upload/logo/' . $name_gen_fav);
            $save_favicon = 'upload/logo/' . $name_gen_fav;


            SiteSetting::findOrFail($site_id)->update([
                'company_name' => $request->company_name,
                'slogan' => $request->slogan,
                'company_address' => $request->company_address,
                'company_email' => $request->company_email,
                'company_phone' => $request->company_phone,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'copyright' => $request->copyright,
                'cgv' => $request->cgv,
                'legal_notice' => $request->legal_notice,
                'term' => $request->term,
                'company_logo' => $save_url,
                'favicon' => $save_favicon,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Paramètre du site mis à jour avec succès',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {

            SiteSetting::findOrFail($site_id)->update([
                'company_name' => $request->company_name,
                'slogan' => $request->slogan,
                'company_address' => $request->company_address,
                'company_email' => $request->company_email,
                'company_phone' => $request->company_phone,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'copyright' => $request->copyright,
                'cgv' => $request->cgv,
                'legal_notice' => $request->legal_notice,
                'term' => $request->term,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Paramètre du site mis à jour avec succès',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }


    public function seo()
    {
        $seo = Seo::find(1);

        return view('backend.setting.seo', compact('seo'));
    }

    public function storeSeo(Request $request)
    {
        $seo_id = $request->id;

        Seo::findOrFail($seo_id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Paramètre de référencement mis à jour avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
