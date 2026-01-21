<?php

use App\Http\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;

Route::get('/excel', [ExcelController::class, 'index'])->name('excel.index');
Route::post('/excel/import', [ExcelController::class, 'import'])->name('excel.import');
Route::get('/excel/export', [ExcelController::class, 'export'])->name('excel.export');
Route::get('/excel/export-pdf', [ExcelController::class, 'exportPdfMpdf'])->name('excel.exportPdfMpdf');
