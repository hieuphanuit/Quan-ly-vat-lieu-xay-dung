<?php


namespace App\Http\Services;
use App\Entities\ImportGoodBill;

class ImportGoodsBillService
{
    public function create($request)
    {
        return ImportGoodBill::create($request);
    }
    public function selectList($request,$role)
    {
        $limit = $request->get('limit', 10);
        $ImportGoodBill = ImportGoodBill::
        join('users', function($q) 
        {
           $q->on('import_good_bills.created_by', 'users.id')
               ->join('agencies', 'users.agency_id', '=', 'agencies.id');
        })
        ->join('vendors', 'import_good_bills.vendor_id', '=', 'vendors.id');
        switch($role){
            case 2:
                $ImportGoodBill->where('status',0);
            break;
            case 4:
                $ImportGoodBill->where('status', 0)
                ->orWhere('status', 1);
            break;
            case 5:
                $ImportGoodBill->where('status', 1)
                ->orWhere('status', 2);
            break;
        }
        $ImportGoodBillSQL = $ImportGoodBill->paginate($limit);

        return response()
            ->json($ImportGoodBillSQL); 
    }
    public function detail($id,$role){
        $ImportGoodBill = ImportGoodBill::      
        join('import_goods_bill_details', function($q) use ($id)
        {
            $q->on('import_good_bills.id', 'import_goods_bill_details.import_goods_bill_id')
                ->where('import_goods_bill_details.import_goods_bill_id', $id)
                ->join('products', 'import_goods_bill_details.product_id', '=', 'products.id');
        });
        switch($role){
            case 2:
                $ImportGoodBill->where('status', 0);
            break;
            case 4:
                $ImportGoodBill->where('status', 0)
                ->orWhere('status', 1);
            break;
            case 5:
                $ImportGoodBill->where('status', 1)
                ->orWhere('status', 2);
            break;
        }
     
       $ImportGoodBillSQL = $ImportGoodBill->get();
       // dd( $ImportGoodBill->toSql());
        return response()
            ->json($ImportGoodBillSQL);

    }
    public function update($id,$role){
        $ImportGoodBill = ImportGoodBill::where('id', $id);
       
        switch($role){
            case 2:   
                $ImportGoodBill->update(['status' => 0]);
          
            break;
            case 5:
                $ImportGoodBill->update(['status' => 2]);
            break;
        }
       $ImportGoodBillSQL = $ImportGoodBill;
      
        return response()
            ->json($ImportGoodBillSQL);
    }
}
