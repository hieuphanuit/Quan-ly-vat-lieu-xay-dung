<?php
namespace App\Http\Services;

use App\Entities\SellingBill;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Entities\Customer;
use App\Entities\AgencyProduct;
use App\Helpers\Statics\UserRolesStatic;
use DB;

class SellingBillService
{
    public function index($request)
    {
        $limit = $request->get('limit', 10);
        
        $currentUser = auth()->user(); 
        $query = SellingBill::query();
        
        if(!in_array($currentUser->role, [
            UserRolesStatic::ADMIN,
            UserRolesStatic::MANAGER,
            UserRolesStatic::ASSISTANT,

        ]) ){
            $query->where('agency_id', $currentUser->agency_id);
        }

        $SellingBill =  $query
            ->orderBy('id', 'desc')
            ->paginate($limit);

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

    public function selectList($limit = 10)
    {
        $currentUser = auth()->user();

        $query = SellingBill::with('customer:id,name')
                ->orderBy('status_confirm', 'asc')
                ->orderBy('id', 'desc');

        // if(!in_array($currentUser->role, [
        //     UserRolesStatic::ADMIN,
        //     UserRolesStatic::MANAGER,
        //     UserRolesStatic::ASSISTANT,
        //     UserRoleStatic::BUSINESS_STAFF,

        // ]) ){
            $query->where('agency_id', $currentUser->agency_id);
       // }

        if($currentUser->role == UserRolesStatic::BUSINESS_STAFF) {
            $query->where('status_confirm', 0);
        }
      
        return $query->paginate($limit);
    }

    public function model()
    {
        return SellingBill::class;
    }

    public function updateStatus($id)
    {
        $user = auth()->user();
        $sellingBill = SellingBill::with([
            'sellingBillDetail.product.agencyProduct' => function ($q) use ($user) {
                $q->where('agency_id', $user->agency_id);
            } 
        ])
            ->find($id);

        if(!$sellingBill) {
            return response()->json('Không tìm thấy hóa đơn', 422);
        }

        DB::beginTransaction();
        
        foreach($sellingBill->sellingBillDetail as $sellingBillDetail) {
            $product = $sellingBillDetail->product;
            if (!$product) {
                DB::rollback();
                return response()->json('Hóa đơn có sản phẩm không tồn tại', 422);
            }

            $agencyProduct = $product->agencyProduct;
            if($agencyProduct->quantity < $sellingBillDetail) {
                DB::rollback();
                return response()->json('Số lượng sản phẩm còn lại không đủ để xác nhận', 422);
            }

            $agencyProduct->decrement('quantity', $sellingBillDetail->quantity);
        }

        $sellingBill->update(['status_confirm' => 1]);
        DB::commit();


        return response()->json($sellingBill);
    }
}
