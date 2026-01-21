<?php

namespace App\Exports;

use App\Models\Owner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class OwnerSheetExport implements FromCollection , WithHeadings , WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $sheetName;

    public function __construct($sheetName = 'owner')
    {
        $this->sheetName = $sheetName;
    }
    public function collection()
    {
        return Owner::select('name', 'email', 'phone' , 'age')->get();
    }

    public function headings():array
    {
        return['Name', 'Email', 'Phone', 'Age'];
    }

    public function title(): string
    {
        return $this->sheetName;
    }
    
}
