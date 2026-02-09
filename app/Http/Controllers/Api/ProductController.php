<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Jobs\ImportProductsJob;
use App\Services\ProductImportService;
use App\Traits\ApiResponse;

class ProductController extends Controller
{
    use ApiResponse;
     protected $service;

    public function __construct(ProductImportService $service)
    {
        $this->service = $service;
    }

    public function import()
    {
        ImportProductsJob::dispatch();
        // $products = $this->service->fetchAndStoreProducts();
        return $this->success(null, null, 'Products import job dispatched successfully');
    }
}


