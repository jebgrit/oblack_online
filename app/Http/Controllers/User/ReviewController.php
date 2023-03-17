<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use App\Notifications\ReviewNotification;
// use App\Rules\CheckRating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{

    public function storeReview(Request $request)
    {
        // print_r($_POST);

        $product = $request->product_id;
        $vendor = $request->hvendor_id;

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'max:30'],
            'comment' => ['required', 'max:20000'],
        ], [
            'title.required' => 'Ce champ est requis',
            'title.max' => 'Le titre doit avoir 30 caractères maximums',
            'comment.required' => 'Ce champ est requis',
            'comment.max' => 'Le commentaire doit avoir 20000 caractères maximums',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {

            $user_comment_id = Auth::id();
            $if_purchased = null;
            $date_p = null;

            // check if user has bougth product
            $order_user_comment = Order::where('user_id', $user_comment_id)->first();

            if ($order_user_comment) {

                $if_purchased = 'oui';
                $date_p = $order_user_comment->order_date;
            } else {

                $if_purchased = 'non';
                $date_p = Null;
            }

            $review = new Review();

            $review->product_id = $product;
            $review->user_id = $user_comment_id;
            $review->title = $request->title;
            $review->comment = $request->comment;
            $review->rating = $request->quality;
            $review->vendor_id = $vendor;
            $review->user_purchased = $if_purchased;
            $review->date_purchased = $date_p;
            $review->created_at = Carbon::now();

            $review->save();


            // envoyer une notif à l'admin quand une commande a recu un commentaire
            $user = User::where('role', 'admin')->get();
            Notification::send($user, new ReviewNotification($request));

            return response()->json([
                'status' => 200,
                'messages' => 'Merci pour votre commentaire!'
            ]);
        }
    }


    # show review admin dashboard
    public function pendingReview()
    {

        $review = Review::where('status', 0)
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.review.pending_review', compact('review'));
    }

    public function approveReview($id)
    {
        Review::where('id', $id)->update([
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'Commentaire approuvé avec succès.',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.review')->with($notification);
    }

    public function showReview($id)
    {
        $review = Review::where('id', $id)->firstOrFail();

        // dd($rep);

        return view('backend.review.show_review', compact('review'));
    }



    public function publishReview()
    {
        $review = Review::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.review.publish_review', compact('review'));
    }


    # delete
    public function deleteReview($id)
    {
        Review::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Commentaire supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



    ///////////////////////////////////////////////////////
    //
    // VENDOR ALL REVIEW
    //
    ///////////////////////////////////////////////////////


    public function vendorAllReview()
    {
        $id = Auth::user()->id;

        $review = Review::where('vendor_id', $id)
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        return view('vendor.backend.review.all_review', compact('review'));
    }


    public function vendorShowReview($id)
    {
        $id = Auth::user()->id;

        $review = Review::where('vendor_id', $id)->firstOrFail();

        // dd($rep);

        return view('vendor.backend.review.vendor_show_review', compact('review'));
    }
}
