<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AllUserController extends Controller
{


    public function userAccount()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('fronted.userdashboard.account_details', compact('userData'));
    }








    public function userChangePassword()
    {
        return view('fronted.userdashboard.user_change_password');
    }








    public function userOrderPage()
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)
            ->where('payment_status', 'paid')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('fronted.userdashboard.user_order_page', compact('orders'));
    }








    public function userOrderDetails($order_id)
    {

        $order = Order::where('id', $order_id)
            ->where('user_id', Auth::id())
            ->first();

        $order_item = OrderItem::with('product')
            ->where('order_id', $order_id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('fronted.order.order_details', compact('order', 'order_item'));
    }









    public function userOrderInvoice($order_id)
    {
        $order = Order::where('id', $order_id)
            ->where('user_id', Auth::id())
            ->first();

        $order_item = OrderItem::with('product')
            ->where('order_id', $order_id)
            ->orderBy('id', 'DESC')
            ->get();

        $pdf = Pdf::loadView('fronted.order.order_invoice', compact('order', 'order_item'))
            ->setPaper('a4')
            ->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);

        return $pdf->download('oblack.pdf');
    }











    public function userTrackOrder()
    {
        return view('fronted.userdashboard.user_track_order');
    }








    public function orderTracking(Request $request)
    {
        $invoice = $request->invoice_no;

        $track = Order::where('invoice_no', $invoice)
            ->first();

        if ($track) {
            return view('fronted.tracking.track_order', compact('track'));
        } else {
            $notification = array(
                'message' => 'Numéro de commande invalide',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
