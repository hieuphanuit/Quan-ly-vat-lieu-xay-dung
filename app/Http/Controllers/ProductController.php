<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Services\ProductService;

class ProductController extends Controller
{
    //
    protected $service;

    public function __construct(ProductService $productService)
    {
        $this->service = $productService;    
    }
    
    public function index(Request $request)
    {
        return $this->service->index($request); 
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }

    public function create(CreateProductRequest $request)
    {
        return $this->service->create($request);
    }

    public function update(UpdateProductRequest $request)
    {
        return $this->service->update($request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
