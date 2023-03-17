<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Exports\VendorTicketsExport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

use App\Notifications\VendorTicketNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

use function App\Ticket_ID_gen;

class VendorTicketController extends Controller
{


    public function vendorAllTicket()
    {
        $id = Auth::user()->id; // affiche uniquement ses tickets à ce toto

        $tickets = Ticket::where('user_id', $id)->latest()->get();

        return view('vendor.backend.ticket.vendor_ticket_all', compact('tickets'));
    }








    public function vendorNewTicket()
    {
        return view('vendor.backend.ticket.vendor_new_ticket');
    }






    public function vendorStoreTicket(Request $request)
    {

        $this->validate($request, [
            'objet' => ['required', 'max:50'],
            'priority' => ['required'],
            'message' => ['required', 'max:2000'],
        ]);

        $sender_id = Auth::user()->id;
        $sender_name = Auth::user()->name;
        $date = (date('Y') - 1800);

        $ticket = new Ticket([
            'objet' => $request->input('objet'),
            'user_id' => $sender_id,
            'ticket_id' => Ticket_ID_gen($sender_name, random_int(1000, 9999), $date),
            'priority' => $request->input('priority'),
            'message' => $request->input('message'),
            'status' => "Ouvert",
            'created_at' => Carbon::now(),
        ]);

        $ticket->save();

        $notification = array(
            'message' => 'Ticket ouvert avec succès',
            'alert-type' => 'success'
        );


        // send notif to admin when ticket was created
        $admin = User::where('role', 'admin')->get();
        Notification::send($admin, new VendorTicketNotification($request));

        return redirect()->route('vendor.all.ticket')->with($notification);
    }






    public function vendorShowTicket($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        return view('vendor.backend.ticket.vendor_show_ticket', compact('ticket'));
    }






    // export ticket
    public function exportTicket()
    {
        return Excel::download(new VendorTicketsExport, 'tickets.xlsx');
    }
}
