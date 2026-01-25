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
        return view("admin.excel.index", compact('client', 'owner', 'admin'));
    }

    public function import(Request $request, ExcelImportService $service)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls'
            ]);
            $service->import($request->file('file'));
            return back()->with('success', 'Excel Imported Successfully');
        } catch (\Exception $ex) {
            return back()->with('Failed', 'Excel Imported Failed');
        }
    }

    public function export()
    {
        if (Admin::count() === 0 && Owner::count() === 0 && Client::count() === 0) {
            return back()->with('error', 'No data available to export.');
        }
        $fileName = 'all_data_' . time() . '.xlsx';
        return Excel::download(new MultiSheetExport(), $fileName);
    }

    public function exportPdfMpdf(PdfExportService $service)
    {
        if (Admin::count() === 0 && Owner::count() === 0 && Client::count() === 0) {
            return back()->with('error', 'No data available to export.');
        }
        try {
            $service->export();
            return back()->with('success', 'Data exported successfully!');
        } catch (\Throwable $ex) {
            return back()->with('error', 'Failed to export PDF. Please try again.');
        }
    }
}
