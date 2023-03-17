<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportProduct;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\ReportNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{


    /////////////////////////////////////////////////////////////////////////
    //
    //                  COMMENT REPORT


    public function storeReport(Request $request)
    {
        // print_r($_POST);

        $product = $request->product_id;
        $review = $request->review_id;

        $validator = Validator::make($request->all(), [
            'report' => ['required', 'max:2000'],
        ], [
            'report.required' => 'Ce champ est requis',
            'report.max' => 'Le message doit avoir 2000 caractères maximums',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {

            $report = new Report();

            $report->product_id = $product;
            $report->user_id = Auth::id();
            $report->review_id = $review;
            $report->report = $request->report;
            $report->created_at = Carbon::now();

            $report->save();


            // envoyer une notif à l'admin quand un commentaire a recu un signalement
            $user = User::where('role', 'admin')->get();
            Notification::send($user, new ReportNotification($request));

            return response()->json([
                'status' => 200,
                'messages' => 'Merci pour votre commentaire!'
            ]);
        }
    }







    public function allReport()
    {
        $report = Report::orderBy('created_at', 'DESC')->get();

        return view('backend.report.all_report', compact('report'));
    }

    public function showReport($id)
    {
        $report = Report::where('id', $id)->firstOrFail();

        // dd($rep);

        return view('backend.report.show_report', compact('report'));
    }

    public function deletereport($id)
    {
        Report::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }








    /////////////////////////////////////////////////////////////////////////
    //
    //                  PRODUCT REPORT

    public function storeReportProduct(Request $request)
    {
        $product = $request->product_id;

        $request->validate([
            'product_report_reason' => 'required|string',
        ]);

        ReportProduct::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'product_report_reason' => $request->product_report_reason,
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Merci de nous avoir informés.',
            'alert-type' => 'success'
        );


        // envoyer une notif à l'admin quand un product a recu un signalement
        $user = User::where('role', 'admin')->get();
        Notification::send($user, new ReportNotification($request));

        return redirect()->back()->with($notification);
    }


    public function allReportProduct()
    {
        $report_product = ReportProduct::orderBy('created_at', 'DESC')->get();

        return view('backend.report.all_report_product', compact('report_product'));
    }


    public function deletereportProduct($id)
    {
        ReportProduct::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
