<?php

namespace App\Http\Controllers;

use App\Entities\Product;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Services\SellingBillService;
use App\Http\Services\SellingBillDetailService;

class SellingBillDetailController extends Controller
{
    protected $service;
    //protected $productService;
    //protected $sellingBilDetailService;

    public function __construct(
        //SellingBillService $sellingBillService,
        //ProductService $productService,
        SellingBillDetailService $sellingBilDetailService
    )
    {
        $this->service = $sellingBilDetailService;
        //$this->productService = $productService;
       // $this->sellingBilDetailService = $sellingBilDetailService;
    }
    public function index(Request $request)
    {
        return $this->service->index($request); 
    }
    public function detail($id)
    {
        return $this->service->detail($id);
    }
    public function create(Request $request)
    {
        return $this->service->create($request);
    }

    public function selectList()
    {
        $agency_id = auth()->user()->agency_id;
        $result = $this->service->selectList($agency_id);

        return response()->json(['selling_bill' =>$result]);
    }
}
