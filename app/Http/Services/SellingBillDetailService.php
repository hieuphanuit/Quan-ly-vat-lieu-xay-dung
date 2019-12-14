<?php


namespace App\Http\Services;
use App\SellingBillDetail;

class SellingBillDetailService
{
    public function create($data)
    {
        SellingBillDetail::create($data);
    }

    public function sellingBillDetail($selling_bil_id)
    {
        //$result = SellingBillDetail::select('')
    }
}
