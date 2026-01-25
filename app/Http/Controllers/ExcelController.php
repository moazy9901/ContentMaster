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
        $client = Client::orderBy('id')->paginate(10);
        $owner = Owner::orderBy('id')->paginate(10);
        $admin = Admin::orderBy('id')->paginate(10);
        return view("admin.excel.index", compact('client' , 'owner', 'admin'));
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
