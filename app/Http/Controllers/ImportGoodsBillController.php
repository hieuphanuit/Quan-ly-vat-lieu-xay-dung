<?php

namespace App\Http\Controllers;

use App\Entities\Product;
use App\Http\Services\ImportGoodsBillDetailsService;
use App\Http\Services\ImportGoodsBillService;
use App\Http\Services\ProductService;
use http\Env\Request;

class ImportGoodsBillController extends Controller
{
    protected $importGoodsBillService;
    protected $productService;
    protected $importGoodsBilDetailService;

    public function __construct(
        ImportGoodsBillService $importGoodsBillService,
        ImportGoodsBillDetailsService $importGoodsBillDetailsService,
        ProductService $productService
    )
    {
        $this->importGoodsBilDetailService = $importGoodsBillDetailsService;
        $this->importGoodsBillService = $importGoodsBillService;
        $this->productService = $productService;
    }

    public function create(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $totalAmount = 0;

        $importGoodBill = $this->importGoodsBillService->create([
            'created_by' => $user->id,
            'agency_id' => $user->agency_id,
            'total_paid' => $data['total_paid'],
            'vendor_id' => $data['vendor_id'],
        ]);

        foreach($data['details'] as &$detail){
            $price = Product::find($detail['product_id'])['price'];
            $detail['unit_price'] = $price;
            $totalAmount += $price * $detail['quantity'];
            $detail['total'] = $price * $detail['unit_price'];
        }
        $status = ($data['total_paid'] == $totalAmount) ? 0 : 1;
        $importGoodBill->importGoodsBillDetail()->createMany($data['details']);
        $importGoodBill->total_amount = $totalAmount;
        $importGoodBill->status = $status;

        $importGoodBill->update([
            'total_amount' =>$totalAmount,
            'status' => $status
        ]);

        return response()->json($importGoodBill);
    }
}
