<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data_orders;
    public $data_order_items;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_orders, $data_order_items)
    {
        $this->data_orders = $data_orders;
        $this->data_order_items = $data_order_items;
    }

    /**
     * Build message
     */
    public function build()
    {
        $orders = $this->data_orders;
        $order_items = $this->data_order_items;

        return $this->from('service@a16e.com')
            ->view('mail.order_mail', compact('orders', 'order_items'))
            ->subject('Confirmation de commande');
    }
}
