<?php


namespace App\Http\Services;
use App\SellingBillDetail;

class SellingBillDetailService
{
    public function index($request)
    {
        // $sell_bill_id = $request->get('sell_bill_id');

        $limit = $request->get('limit', 10);

        $SellingBillDetail = SellingBillDetail::paginate($limit);

        return response()
            ->json($SellingBillDetail);
       
    }

    public function detail($id)
    {
       $selling_bill_id = ['selling_bill_id' => $id];
        $SellingBillDetail = SellingBillDetail::where($selling_bill_id)->get();
        return response()
            ->json($SellingBillDetail);
    }


    public function create($data)
    {
        SellingBillDetail::create($data);
    }
}
