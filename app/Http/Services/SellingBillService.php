<?php
namespace App\Http\Services;

use App\SellingBill;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Entities\Customer;

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

    public function selectList($agencyID)
    {
        $sellingBill = SellingBill::select('total_amount', 'total_paid', 'status', 'c.name')
                        ->join('customers as c', 'customer_id', '=', 'c.id')
                        ->where('agency_id', $agencyID)
                        ->get();

        return $sellingBill;
    }
}
