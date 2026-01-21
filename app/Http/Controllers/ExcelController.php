<?php

namespace App\Http\Controllers;

use App\Exports\MultiSheetExport;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Owner;
use App\Services\ExcelImportService;
use App\Services\PdfExportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class ExcelController extends Controller
{
    public function index()
    {

        $records = collect()
            ->merge(Client::all())
            ->merge(Owner::all())
            ->merge(Admin::all());

        return view("excel.index", compact('records'));
    }
    public function import(Request $request, ExcelImportService $service)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);
        $service->import($request->file('file'));

        return back()->with('success', 'Excel Imported Successfully');
    }

    public function export()
    {
        $fileName = 'all_data_' . time() . '.xlsx';
        return Excel::download(new MultiSheetExport(), $fileName);
    }

    public function exportPdfMpdf(PdfExportService $service)
    {
        $service->export();
        return back()->with('success', 'data Exported Successfully');
    }
}
