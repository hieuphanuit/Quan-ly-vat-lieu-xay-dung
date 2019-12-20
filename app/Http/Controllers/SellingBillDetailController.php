<?php

namespace App\Http\Controllers;

use App\Entities\Product;
use App\Entities\SellingBill;
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
        $data = SellingBill::with([
            'sellingBillDetail.product',
            'customer'
            ])->find($selling_bill_id);
        $data->status_confirm_text = SellingBillStatus::getStatusText($data->status_confirm); 
        return response()->json($data); 
    }
}
