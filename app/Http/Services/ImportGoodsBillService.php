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
    public function detail($id,$role)
    {
        $result = ImportGoodBill::with('importGoodsBillDetail.product', 'vendor:name,address,email,id')->find($id);
        return $result;
    }
    public function updateStatus($id,$role){
        $ImportGoodBill = ImportGoodBill::where('import_good_bills.id', $id);
        switch($role){
            case 2:
                $ImportGoodBill->update(['import_good_bills.status' => 1]);
            break;
            case 5:
                $ImportGoodBill->update(['import_good_bills.status' => 2]);
            break;
        }

       $ImportGoodBillSQL = $ImportGoodBill;
        return response()
            ->json($ImportGoodBillSQL);
    }
}
