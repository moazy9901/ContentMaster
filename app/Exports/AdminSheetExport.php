<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AdminSheetExport implements FromCollection , WithHeadings , WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */


    protected $sheetName;

    public function __construct($sheetName = 'admin')
    {
        $this->sheetName = $sheetName;
    }
    public function collection()
    {
        return Admin::select('name' ,'email' , 'phone' , 'address')->get();
    }
    public function headings():array
    {
        return [
            "Name" , "Email" , "Phone" , "Address"
        ];
    }

    public function title(): string
    {
        return $this->sheetName;
    }

}
