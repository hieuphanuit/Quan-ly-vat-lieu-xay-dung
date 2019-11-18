<?php
namespace App\Http\Services;

use App\SellingBill;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;


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


}

?>
