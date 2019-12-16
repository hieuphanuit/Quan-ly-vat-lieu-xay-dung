<?php


namespace App\Http\Services;
use App\SellingBillDetail;

class SellingBillDetailService
{    
   public function sellingBillDetail($selling_bill_id)
    {
        $result = SellingBillDetail::select('*', 'c.name as customer_name', 'p.name')
                    ->leftJoin('selling_bills as b', 'selling_bill_details.selling_bill_id', '=', 'b.id')
                    ->leftJoin('customers as c', 'c.id', 'b.customer_id')
                    ->leftJoin('products as p', 'p.id', '=', 'selling_bill_details.product_id')
                    ->where('selling_bill_details.selling_bill_id', '=', $selling_bill_id);

        return $result->get();
    }
}
