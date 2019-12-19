<?php


namespace App\Http\Services;

use App\Entities\AgencyProduct;
use App\Entities\ImportGoodBill;
use App\Helpers\Statics\UserRolesStatic;

class ImportGoodsBillService
{
    public function create($request)
    {
        return importGoodBill::create($request);
    }
    public function selectList($request,$role)
    {
        $limit = $request->get('limit', 10);
        $importGoodBill = ImportGoodBill::
        select('import_good_bills.id', 'vendors.name', 'import_good_bills.status', 'import_good_bills.total_paid', 'import_good_bills.created_at')
        ->join('users', function($q)
        {
           $q->on('import_good_bills.created_by', 'users.id')
               ->join('agencies', 'users.agency_id', '=', 'agencies.id');
        })
        ->join('vendors', 'import_good_bills.vendor_id', '=', 'vendors.id');
        switch($role){
            case 2:
                $importGoodBill->where('status',0);
            break;
            case 4:
                $importGoodBill->where('status', 0)
                ->orWhere('status', 1);
            break;
            case 5:
                $importGoodBill->where('status', 1)
                ->orWhere('status', 2);
            break;
        }
        $importGoodBillSQL = $importGoodBill->paginate($limit);

        return  $importGoodBillSQL;
    }

    public function detail($id,$role)
    {
        $result = ImportGoodBill::with('importGoodsBillDetail.product', 'vendor:name,address,email,id')->find($id);
        return $result;
    }

    public function updateStatus($id){
        $user = auth()->user();

        $importGoodBill = ImportGoodBill::with([
            'importGoodsBillDetail.product',
        ])
            ->find($id);

        switch($user->role){
            case UserRolesStatic::BUSINESS_STAFF:
                $importGoodBill->update(['status' => 1]);
                break;
            case UserRolesStatic::WAREHOUSE_STAFF:
                if($importGoodBill->status == 2 ) {
                  return response()
                      ->json('Đã được xác nhận không thể xác nhận lại', 422);
                }
                $importGoodBill->update(['status' => 2]);
                foreach($importGoodBill->importGoodsBillDetail as $importGoodsBillDetail) {
                    $agencyProduct = $importGoodsBillDetail->product->agencyProduct()->firstOrCreate(
                        [
                            'agency_id' => $user->agency_id
                        ],
                        [
                            'agency_id' => $user->agency_id,
                            'quantity' => 0
                        ]
                    );
                    $agencyProduct->increment('quantity', $importGoodsBillDetail->quantity);
                }
                break;
        }
        return response()
            ->json($importGoodBill);
    }
}
