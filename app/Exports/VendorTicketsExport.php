<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VendorTicketsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Ticket::all(
            'ticket_id',
            'objet',
            'priority',
            'message',
            'created_at'
        );
    }

    public function headings(): array
    {
        return [
            'identifiant ticket',
            'objet',
            'priorité',
            'message',
            'date de création'
        ];
    }
}
