<?php

namespace App\Exports;

use App\Models\Newsletter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NewsletterExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Newsletter::all(
            'id',
            'email',
            'created_at'
        );
    }

    public function headings(): array
    {
        return [
            'id',
            'email',
            'date d\'envoi'
        ];
    }
}
