<?php

namespace App\Http\Controllers;

use App\Entities\Product;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Services\SellingBillService;
use App\Http\Services\SellingBillDetailService;
use App\Helpers\Statics\SellingBillStatus;

class SellingBillDetailController extends Controller
{
    protected $service;

    public function __construct(
        SellingBillDetailService $sellingBilDetailService
    )
    {
        $this->service = $sellingBilDetailService;
    }
    public function index($selling_bill_id)
    {
        $sellingBillDetails = $this->service->sellingBillDetail($selling_bill_id);
        foreach($sellingBillDetails as $key => $bill){
            $sellingBillDetails[$key]->status_confirm_text = SellingBillStatus::getStatusText($bill->status_confirm); 
        }

        return response()->json($sellingBillDetails); 
    }
}
