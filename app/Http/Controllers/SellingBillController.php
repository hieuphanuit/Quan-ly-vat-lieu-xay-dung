<?php

namespace App\Http\Controllers;

use App\Entities\Product;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\SellingBill\CreateSellingBillRequest;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Services\SellingBillService;
use App\Http\Services\SellingBillDetailService;

class SellingBillController extends Controller
{
    protected $service;
    protected $productService;
    protected $sellingBilDetailService;

    public function __construct(
        SellingBillService $sellingBillService,
        ProductService $productService,
        SellingBillDetailService $sellingBilDetailService
    )
    {
        $this->service = $sellingBillService;
        $this->productService = $productService;
        $this->sellingBilDetailService = $sellingBilDetailService;
    }


    public function create(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $totalAmount = 0;

        $sellingBill = $this->service->create([
            'created_by' => $user->id,
            'agency_id' => $user->agency_id,
            'total_paid' => $data['total_paid'],
            'customer_id' => $data['customer_id'],
        ]);

        foreach($data['details'] as &$detail){
            $price = Product::find($detail['product_id'])['price'];
            $detail['unit_price'] = $price;
            $totalAmount += $price * $detail['quantity'];
            $detail['total'] = $price * $detail['unit_price'];
        }

        $status = ($data['total_paid'] == $totalAmount) ? 0 : 1;
        $sellingBill->sellingBillDetail()->createMany($data['details']);

        $sellingBill->total_amount = $totalAmount;
        $sellingBill->status = $status;

        $sellingBill->update([
           'total_amount' =>$totalAmount,
           'status' => $status
        ]);

        return response()->json($sellingBill);
    }



}
