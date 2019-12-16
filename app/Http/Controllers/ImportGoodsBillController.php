<?php

namespace App\Http\Controllers;

use App\Entities\Product;
use App\Http\Services\ImportGoodsBillService;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class ImportGoodsBillController extends Controller
{
    protected $importGoodsBillService;
    protected $productService;

    public function __construct(
        ImportGoodsBillService $importGoodsBillService,
    
        ProductService $productService
    )
    {
        $this->importGoodsBillService = $importGoodsBillService;
        $this->productService = $productService;
    }

    public function create(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
       //dd($data);
        $totalAmount = 0;

        $importGoodBill = $this->importGoodsBillService->create([
            'created_by' =>$user->id  ,  //$user->id
            'agency_id' => $user->agency_id, //$user->agency_id
            'total_paid' => $data['total_paid'],
            'vendor_id' => $data['vendor_id'],
        ]);

        foreach($data['details'] as &$detail){
           // dd($detail);
            $price = Product::find($detail['product_id'])['import_price'];
            //$price = $detail['import_unit_price'];
            $detail['unit_price'] = $price;
            $totalAmount += $price * $detail['quantity'];
            $detail['total'] = $price * $detail['unit_price'];

        }
     //   $status = ($data['total_paid'] == $totalAmount) ? 0 : 1;
        $importGoodBill->importGoodsBillDetail()->createMany($data['details']);
        $importGoodBill->total_amount = $totalAmount;
        //$importGoodBill->status = $status;  

        $importGoodBill->update([
            'total_amount' =>$totalAmount,
          //  'status' => $status
        ]);

        return response()->json($importGoodBill);
    }
    public function selectList(Request $request){
       $user = auth()->user();
      //  dd($user->role);
        return $this->importGoodsBillService->selectList($request, $user->role); 
    }
    public function detail($id){
           $user = auth()->user();
        return $this->importGoodsBillService->detail($id,$user->role);
    }
    public function update($id){
        $user = auth()->user();
        return $this->importGoodsBillService->update($id,$user->role);
    }
}
