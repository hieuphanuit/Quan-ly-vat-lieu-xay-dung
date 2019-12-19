<?php
namespace App\Http\Services;

use App\Entities\SellingBill;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Entities\Customer;
use App\Helpers\Statics\UserRolesStatic;

class SellingBillService
{
    public function index($request)
    {
        $limit = $request->get('limit', 10);

        $SellingBill = SellingBill::paginate($limit);

        return response()
            ->json($SellingBill);
    }

    public function detail($id)
    {
        $SellingBill = SellingBill::find($id);

        return response()
            ->json($SellingBill);
    }

    public function create($request)
    {
       return SellingBill::create($request);
    }

    public function update($request)
    {
        $data = $request->all();
        $SellingBill = SellingBill::find($request->id);
        $SellingBill->update($data);

        return response()
            ->json($SellingBill);
    }

    public function delete($id)
    {
        $SellingBill = SellingBill::find($id);
        $SellingBill->delete();

        return response()
            ->json('Success');
    }

    public function selectList($agencyID, $limit = 10, $userRole =  UserRolesStatic::ASSISTANT)
    {
        $sellingBill = SellingBill::select('selling_bills.id', 'total_amount', 'total_paid', 'c.name',
                                    'selling_bills.created_at', 'status_paid', 'status_confirm')
                        ->leftJoin('customers as c', 'customer_id', '=', 'c.id')
                        //->orderBy('selling_bills.id', 'desc')
                        ->where('agency_id', $agencyID)
                        ->orderBy('status_confirm');

        if($userRole ==  UserRolesStatic::WAREHOUSE_STAFF){
            $sellingBill->where('status_confirm', '=', 0);
        }

        return $sellingBill->paginate($limit);
    }

    public function model()
    {
        return SellingBill::class;
    }

    public function updateStatus($id)
    {
        $sellingBill = SellingBill::find($id);
        return response()->json($sellingBill->update(['status_confirm' => 1]));
    }
}
