<?php

namespace App\Services;

use App\Imports\MultiSheetImport;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Owner;
use Mpdf\Mpdf;

class PdfExportService
{
    public function export()
    {
        $clients = Client::all();
        $owners  = Owner::all();
        $admins  = Admin::all();

        $html = view('pdf.multi_sheet', compact('clients', 'owners', 'admins'))->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans',
            'margin_top' => 10
        ]);

        $mpdf->WriteHTML($html);
        return $mpdf->Output('all_data_' . time() . '.pdf', 'D');
    }
}
