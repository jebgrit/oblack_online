<?php

namespace App\Http\Controllers\Fronted;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShipRegion;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{


    /**
     * Ajouter au panier page de détails
     */

    public function addToCartDetails(Request $request, $id)
    {
        // when you add a new product, if this session has any coupon
        // remove this coupon
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);


        if ($product->discount_price == NULL) {

            $cart1 = Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->product_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
            ]);

            return response()->json([
                'success' => $cart1->name . ' a été ajouté à votre panier',
            ]);
        } else {

            $cart2 = Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
            ]);

            return response()->json([
                'success' => $cart2->name . ' a été ajouté à votre panier'
            ]);
        }
    }









    /**
     * Add mini cart
     */
    public function addMiniCart()
    {
        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_total = Cart::total();

        // here
        return response()->json(array(
            'carts' => $carts,
            'cart_qty' => $cart_qty,
            'cart_total' => $cart_total,
        ));
    }








    /**
     * Remove mini cart
     */
    public function removeMiniCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json();
    }










    /**
     * My cart
     */
    public function myCart()
    {
        return view('fronted.mycart.view_mycart');
    }







    /**
     * pour la page de resumés avant l'achat
     */
    public function getCartProduct()
    {
        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_total = Cart::total();

        // here
        return response()->json(array(
            'carts' => $carts,
            'cart_qty' => $cart_qty,
            'cart_total' => $cart_total,
        ));
    }







    /**
     * Remove product from cart
     */
    public function cartRemove($rowId)
    {
        Cart::remove($rowId);

        // update card when product was delete
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }

        return response()->json();
    }








    /**
     * Cart decrement
     */
    public function cartDecrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        // update grand total when coupon is apply
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }

        return response()->json('Decrement');
    }









    /**
     * Cart Increment
     */
    public function cartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        // update grand total when coupon is apply
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }

        return response()->json('Increment');
    }









    /**
     * Coupon apply
     */
    public function couponApply(Request $request)
    {
        // check if value of colum coupon name match with value of input coupon name on fronted
        // cart_total * discount_amount / 100

        $coupon = Coupon::where('coupon_name', $request->coupon_name)
            ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
            ->first();

        if ($coupon) {
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Super!!! La réduction est bien passée xD'
            ));
        } else {
            return response()->json(['error' => '🥺 Ooops!!! Ce coupon n\'est malheuresement pas ou plus valide']);
        }
    }








    /**
     * Coupon calculation
     */
    public function couponCalculation()
    {
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }








    /**
     * Coupon remove
     */
    public function couponRemove()
    {
        Session::forget('coupon');

        return response()->json();
    }










    /**
     * Checkout create
     */
    public function checkoutCreate()
    {
        if (Auth::check()) {

            if (Cart::total() > 0) {

                $carts = Cart::content();
                $cart_qty = Cart::count();
                $cart_total = Cart::total();

                return view('fronted.checkout.checkout_view', compact('carts', 'cart_qty', 'cart_total'));
            } else {
                $notification = array(
                    'message' => 'Oulaa!! Votre panier est vide :(',
                    'alert-type' => 'error'
                );

                return redirect()->to('/')->with($notification);
            }
        } else {
            $notification = array(
                'message' => '❌❌❌ Pour continuer par là, vous devez vous connecter ou créer un compte :D',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }
    }
}
