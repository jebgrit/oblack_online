<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TicketsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Ticket::all(
            'ticket_id',
            'user_id',
            'objet',
            'priority',
            'message',
            'status',
            'created_at'
        );
    }

    public function headings(): array
    {
        return [
            'identifiant ticket',
            'expéditeur',
            'objet',
            'priorité',
            'message',
            'statut',
            'date de création'
        ];
    }
}
