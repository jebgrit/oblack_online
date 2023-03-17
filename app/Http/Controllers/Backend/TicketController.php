<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Exports\TicketsExport;
use Maatwebsite\Excel\Facades\Excel;


class TicketController extends Controller
{
    // All ticket
    public function allTicket()
    {
        $tickets = Ticket::latest()->get();

        return view('backend.ticket.ticket_all', compact('tickets'));
    }


    // reply ticket
    public function showTicket($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        return view('backend.ticket.ticket_show', compact('ticket'));
    }


    // close ticket
    public function closeTicket($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = "Fermé";

        $ticket->save();

        $ticketOwner = $ticket->user;

        return redirect()->back()->with("status", "The ticket has been closed.");
    }

    // export ticket
    public function exportTicket()
    {
        return Excel::download(new TicketsExport, 'tickets.xlsx');
    }
}
