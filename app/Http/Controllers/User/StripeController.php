<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

use App\Notifications\OrderComplete;
use Illuminate\Support\Facades\Notification;

class StripeController extends Controller
{




    public function checkout(Request $request)
    {


        /**
         * on récupère les données qui vont venir du formulaire rempli par l'utilisateur dans la page checkout
         * 
         * on redirige vers le checkout de stripe
         * on insère les données dans la table order et order item qui vont nous permettre de mettre en place le recu
         * on envoit un email à l'utilisateur
         * on vérifie si tout se passe bien (si oui)
         * on redirige vers la page de confirmation du paiement
         * sinon vers la page d'erreur
         * 
         */




        // dd($request); //data du formulaire


        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $lineItems = [];


        $carts = Cart::content();

        foreach ($carts as $cart) {

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $cart->name,
                        'images' => [$cart->options->image],
                    ],
                    'unit_amount' => $cart->price * 100, // on obtient un integer
                ],
                'quantity' => $cart->qty,
            ];
        }

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            // 'allow_promotion_codes' => true,
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.failure', [], true),
        ]);

        // dd($checkout_session);


        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'name' => $request->shipping_name,
            'phone' => $request->shipping_phone,
            'address' => $request->shipping_address,
            'city' => $request->shipping_city,
            'zip_code' => $request->shipping_zipcode,
            'payment_method' => 'card',
            'session_id' => $checkout_session->id,
            'payment_status' => $checkout_session->payment_status,
            'currency' => $checkout_session->currency,
            'amount' => $checkout_session->amount_total / 100, // on redivise par 100 pour obtenir un nombre à virgule
            'invoice_no' => mt_rand(10000000000000, 99999999999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'En attente',
            'created_at' => Carbon::now(),
        ]);


        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'session_id' => $checkout_session->id,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }




        // destroy cart
        Cart::destroy();

        return redirect($checkout_session->url);
    }




    public function success(Request $request)
    {

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));

            if (!$session) {
                return view('fronted.checkout.failure');
            }

            return view('fronted.checkout.success');
        } catch (\Exception $e) {
            // throw new NotFoundHttpException();
            return view('fronted.checkout.failure');
        }
    }



    public function failure(Request $request)
    {
        return view('fronted.checkout.failure');
    }





    public function webhook()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));


        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = Order::where('session_id', $session->id)->first();
                if ($order && $order->payment_status === 'unpaid') {
                    $order->payment_status = 'paid';
                    $order->save();
                    // Send email to customer

                    // Mail::to($session->customer_details->email)->send(new OrderMail($session->customer_details->name));

                    // $stripe->invoices->sendInvoice('id', []);


                }

                // ... handle other event types


                // envoyer une notif à l'admin quand une commande a été passer
                $user = User::where('role', 'admin')->get();
                Notification::send($user, new OrderComplete($session->id));



            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }
}
