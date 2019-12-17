<?php

namespace App\Http\Controllers;

use App\Entities\Product;
use App\Entities\ImportGoodBill;
use App\Entities\ImportGoodsBillDetail;
use App\Http\Services\ImportGoodsBillService;
use App\Http\Services\ProductService;
use App\Http\Services\AngencyProductService;
use Illuminate\Http\Request;
use App\Helpers\Statics\ImportGoodBillStatus;
class ImportGoodsBillController extends Controller
{
    protected $importGoodsBillService;
    protected $productService;
    protected $angencyproductService;


    public function __construct(
        ImportGoodsBillService $importGoodsBillService,
        AngencyProductService $angencyproductService,
        ProductService $productService
    )
    {
        $this->importGoodsBillService = $importGoodsBillService;
        $this->productService = $productService;
        $this->angencyproductService = $angencyproductService;
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
        $result =  $this->importGoodsBillService->selectList($request, 2);
      //  return $result['data'];
        foreach($result as $key => $bill){
           // return $bill;
            $result[$key]->status = ImportGoodBillStatus::getStatusText($bill->status);
        }

        return response()->json(['selling_bill' =>$result]);
    }
    public function detail($id){
           $user = auth()->user();
        return $this->importGoodsBillService->detail($id,2);
    }
    public function update($id){
      // $user = auth()->user();
      $agency_id = ImportGoodBill::find($id)['agency_id'];
      $product_id = ImportGoodsBillDetail::select('product_id')->where('import_goods_bill_id', $id);
     
      dd($product_id);
        // $angencyproduc = $this->angencyproductService->
        return $this->importGoodsBillService->update($id,2);
    }
}
