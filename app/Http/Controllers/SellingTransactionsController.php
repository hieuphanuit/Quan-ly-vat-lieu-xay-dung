<?php

namespace App\Http\Controllers;

use App\Entities\SellingBill;
use App\Entities\SellingTransaction;
use App\Http\Services\SellingBillService;
use Illuminate\Http\Request;
use App\Http\Services\SellingTransactionsService;
use App\Http\Requests\SellingTransactions\CreateSellingTransactionRequest;
use App\Http\Requests\SellingTransactions\UpdateSellingTransactionsRequest;

class SellingTransactionsController extends Controller
{
    //
    protected $service;
    protected $sellingBillService;

    public function __construct(SellingTransactionsService $sellingTransactionsService, SellingBillService $sellingBillService)
    {
        $this->service = $sellingTransactionsService;
        $this->sellingBillService = $sellingBillService;
    }

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }

    public function getList($id)
    {
        $result = $this->service->getList($id);

        return response()->json($result);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        
        $sellingBill = SellingBill::where('id', $data['selling_bill_id'])->first();
        $totalDept = $sellingBill->total_amount - $sellingBill->total_paid;
        if($data['amount'] > $totalDept){
            return response()->json(['status'=> false, 'message'=> 'Nợ còn ít hơn tổng tiền trả']);
        }else{
            $this->service->create($data);
            if($totalDept == $data['amount']){
                $sellingBill->update(['status_paid' => 0]);
            }
            $sellingBill->update(['total_paid' => ($sellingBill->total_paid + $data['amount'])]);

        }

        return response()->json(['status'=> true, 'message'=> 'Thanh toán thành công']);
    }

    public function update(UpdateSellingTransactionsRequest $request)
    {
        return $this->service->update($request);
    }
    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
