<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * All orders
     */
    public function allOrder()
    {
        $orders = Order::orderBy('id', 'DESC')->get();

        return view('backend.orders.all_orders', compact('orders'));
    }

    /**
     *  Order details
     */
    public function orderDetails($id)
    {

        $order = Order::where('id', $id)
            ->first();

        $order_item = OrderItem::with('product')
            ->where('order_id', $id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.order_details', compact('order', 'order_item'));
    }












    /**
     * Pending to confirm (EN ATTENTE -> VALIDÉ)
     */
    public function pendingToConfirm($id)
    {
        Order::findOrFail($id)->update([
            'status' => 'Validé',
        ]);

        $notification = array(
            'message' => 'Commande mis à jour avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.orders')->with($notification);
    }



    /**
     * Confirm to processig (VALIDÉ -> EN COURS)
     */
    public function confirmToProcessing($id)
    {
        Order::findOrFail($id)->update([
            'status' => 'En cours',
        ]);

        $notification = array(
            'message' => 'Commande mis à jour avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.orders')->with($notification);
    }



    /**
     * Processing to delivered (EN COURS -> LIVRÉ)
     */
    public function processingToDelivered($id)
    {
        // mettre à jour le stock quand la commande a été livré
        $product = OrderItem::where('order_id', $id)->get();

        foreach ($product as $item) {
            Product::where('id', $item->product_id)->update([
                'product_quantity' => DB::raw('product_quantity -' . $item->qty)
            ]);
        }
        // fin

        Order::findOrFail($id)->update([
            'status' => 'Livré',
            'delivered_date' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Commande mis à jour avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.orders')->with($notification);
    }














    /**
     * Invoice order download
     */
    public function orderInvoiceDownload($id)
    {
        $order = Order::where('id', $id)
            ->first();

        $order_item = OrderItem::with('product')
            ->where('order_id', $id)
            ->orderBy('id', 'DESC')
            ->get();

        $pdf = Pdf::loadView('backend.orders.order_invoice', compact('order', 'order_item'))
            ->setPaper('a4')
            ->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);

        return $pdf->download('oblack.pdf');
    }









    public function deleteOrder($id)
    {
        Order::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Commande supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
