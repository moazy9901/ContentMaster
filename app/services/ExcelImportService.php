<?php

namespace App\Services;

use App\Imports\MultiSheetImport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportService
{
    public function import($file)
    {
        Excel::import(new MultiSheetImport, $file);
    }
}
