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
    public function selectList($limit = 10)
    {
        $currentUser = auth();

        $query = ImportGoodBill::with([
            'vendor:id,name', 
            'createdUser:id,name',
            ]);
        
        if(!in_array($currentUser->role, [
            UserRolesStatic::ADMIN,
            UserRolesStatic::MANAGER,
            UserRolesStatic::ASSISTANT,

        ]) ){
            $query->where('agency_id', $currentUser->agency_id);
        }

        switch($currentUser->role){
            case UserRolesStatic::BUSINESS_STAFF:
                $query->where('status', 0)
                    ->orWhere('status', 1)
                    ->orderBy('status', 'asc');
            break;
            case UserRolesStatic::WAREHOUSE_STAFF:
                $query->where('status', 1)
                    ->orWhere('status', 2)
                    ->orderBy('status', 'asc');
            break;
        }
        $importGoodBills = $query->orderBy('id', 'desc')
            ->paginate($limit);

        return  $importGoodBills;
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
