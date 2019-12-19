<?php
namespace App\Http\Services;

use App\Entities\SellingBill;
use App\Entities\SellingTransaction;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;


class SellingTransactionsService
{


    public function index($request)
    {
        $limit = $request->get('limit', 10);

        $SellingTransaction = SellingTransaction::paginate($limit);

        return response()
            ->json($SellingTransaction);
    }

    public function detail($id)
    {
        $SellingTransaction = SellingTransaction::find($id);

        return response()
            ->json($SellingTransaction);
    }

    public function create($data)
    {
        $SellingTransaction = SellingTransaction::create($data);
        return $SellingTransaction;
    }

    public function update($request)
    {
        $data = $request->all();
        $SellingTransaction = SellingTransaction::find($request->id);
        $SellingTransaction->update($data);

        return response()
            ->json($SellingTransaction);
    }

    public function delete($id)
    {
        $SellingTransaction = SellingTransaction::find($id);
        $SellingTransaction->delete();

        return response()
            ->json('Success');
    }

    public function getList(int $sellingBillId, $keyword = null)
    {
        return SellingTransaction::where('selling_bill_id', $sellingBillId)->get();
    }

}

?>
