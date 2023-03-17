<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class VendorOrderController extends Controller
{
    /**
     * Pending order
     */
    public function vendorOrder()
    {
        $id = Auth::user()->id;

        $order_item = OrderItem::with('order')
            ->where('vendor_id', $id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('vendor.backend.orders.vendor_all_orders', compact('order_item'));
    }

    /**
     * Order details
     */
    public function vendorOrderDetails($id)
    {
        $order = Order::where('id', $id)
            ->first();

        $order_item = OrderItem::with('product')
            ->where('order_id', $id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('vendor.backend.orders.vendor_order_details', compact('order', 'order_item'));
    }

    /**
     * 
     */
    public function vendorInvoiceDownload($id)
    {
        $order = Order::where('id', $id)
            ->first();

        $order_item = OrderItem::with('product')
            ->where('order_id', $id)
            ->orderBy('id', 'DESC')
            ->get();

        $pdf = Pdf::loadView('vendor.backend.orders.vendor_order_invoice', compact('order', 'order_item'))
            ->setPaper('a4')
            ->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);

        return $pdf->download('oblack.pdf');
    }
}
