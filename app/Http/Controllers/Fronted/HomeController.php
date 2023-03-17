<?php

namespace App\Http\Controllers\Fronted;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    # contact
    public function contact()
    {
        return view('fronted.contact');
    }

    # terms
    public function term()
    {
        $term = SiteSetting::find(1);

        return view('fronted.term', compact('term'));
    }



    # cgv
    public function cgv()
    {
        $cgv = SiteSetting::find(1);

        return view('fronted.cgv', compact('cgv'));
    }

    # legal
    public function legalNotice()
    {
        $legal = SiteSetting::find(1);

        return view('fronted.legal_notice', compact('legal'));
    }


    public function faq()
    {
        $faq = Faq::latest()->get();

        return view('fronted.faq', compact('faq'));
    }










    ////////////////// Backend /////////////////////

    # faq
    public function faqAll()
    {
        $faq = Faq::latest()->get();

        return view('backend.setting.faq', compact('faq'));
    }


    public function faqNew()
    {
        return view('backend.setting.new_faq');
    }

    public function faqStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => ['required', 'max:100'],
            'answer' => ['required', 'max:1000'],

        ], [
            'question.required' => 'Ce champ est requis',
            'question.max' => '100 caractères maximums',
            'answer.required' => 'Ce champ est requis',
            'answer.max' => '1000 caractères maximums',
        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            Faq::insert([
                'question' => $request->question,
                'answer' => $request->answer,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Faq ajoutée avec succès',
                'alert-type' => 'success'
            );

            return redirect()->route('faq.all')->with($notification);
        }
    }

    public function faqDelete($id)
    {
        Faq::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Faq supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
