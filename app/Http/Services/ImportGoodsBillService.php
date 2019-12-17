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
        select('import_good_bills.id', 'vendors.name', 'import_good_bills.status', 'import_good_bills.total_paid', 'import_good_bills.created_at')
        ->join('users', function($q)
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

        return  $ImportGoodBillSQL;
    }
    public function detail($id,$role){
        $ImportGoodBill = ImportGoodBill::
        select('vendors.name as vendor_name','vendors.email as vendor_email',
        'products.name as product_name', 'products.unit as product_unit',
        'import_goods_bill_details.quantity as IGD_quantity', 'products.price as IGD_unit_price',
        'import_good_bills.total_amount as IG_total_amount', 'import_good_bills.total_paid as IG_total_paid'
        )

        ->join('import_goods_bill_details', function($q) use ($id)
        {
            $q->on('import_good_bills.id', 'import_goods_bill_details.import_goods_bill_id')
                ->where('import_goods_bill_details.import_goods_bill_id', $id)
                ->join('products', 'import_goods_bill_details.product_id', '=', 'products.id');
        })
        ->join('vendors', 'import_good_bills.vendor_id', '=', 'vendors.id');

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
    public function updateStatus($id,$role){
        //dd($id);
        $ImportGoodBill = ImportGoodBill::where('import_good_bills.id', $id);
    ///

    // dd($ImportGoodBill->toSql());
    switch($role){
            case 2:
                $ImportGoodBill->update(['import_good_bills.status' => 1]);
            break;
            case 5:
                $ImportGoodBill->update(['import_good_bills.status' => 2]);
            break;
        }

       $ImportGoodBillSQL = $ImportGoodBill;
     //  dd($ImportGoodBill->toSql());
        return response()
            ->json($ImportGoodBillSQL);
    }
}
