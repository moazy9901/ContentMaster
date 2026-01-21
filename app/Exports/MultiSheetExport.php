<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheetExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        return [
            'client' => new ClientSheetExport("client"),
            'owner'  => new OwnerSheetExport("owner"),
            'admin'  => new AdminSheetExport("admin"),
        ];
    }
}
