<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheetImport implements WithMultipleSheets
{
    /**
    * @param Collection $collection
    */
    public function sheets(): array
    {
        return [
            'client' => new ClientSheetImport(),
            'admin'  => new AdminSheetImport(),
            'owner'  => new OwnerSheetImport(),
        ];
    }
}
