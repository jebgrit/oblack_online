<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Contact::all(
            'id',
            'name',
            'email',
            'phone',
            'subject',
            'message',
            'created_at'
        );
    }

    public function headings(): array
    {
        return [
            'id',
            'nom',
            'email',
            'téléphone',
            'objet',
            'message',
            'date d\'envoi'
        ];
    }
}
