<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportTableExport implements FromCollection, WithHeadings
{

    protected $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }

    public function headings() : array {
        return [
            'ID',
            'Vehicle',
            'Driver',
            'Fuel Estimation',
            'Start Date',
            'End Date',
            'Request Approval'
        ];
    }
}
