<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ClientSheetExport implements FromCollection , WithHeadings , WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $sheetName;

    public function __construct($sheetName = 'client')
    {
        $this->sheetName = $sheetName;
    }
    public function collection()
    {
        return Client::select('name', 'email', 'phone')->get();
    }
    public function headings():array
    {
        return [
            'Name',
            'Email',
            'Phone',
        ];
    }

    public function title(): string
    {
        return $this->sheetName;
    }
}
