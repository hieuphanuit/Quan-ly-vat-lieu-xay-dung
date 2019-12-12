<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Entities\Vendor;

class VendorService {

    public function index($request)
    {
        $limit = $request->get('limit', 10);

        $vendor = Vendor::paginate($limit);

        return response()
            ->json($vendor); 
    }

    public function detail($id)
    {
        $vendor = Vendor::find($id);

        return response()
            ->json($vendor);
    }

    public function create($request)
    {
        $data = $request->all();
        $vendor = Vendor::create($data);

        return response()
            ->json($vendor);
    }

    public function update($request)
    {
        $data = $request->all();
        $vendor = Vendor::find($request->id);
        $vendor->update($data);

        return response()
            ->json($vendor);
    }

    public function delete($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();

        return response()
            ->json('Success');
    }

    public function getList()
    {
        $vendors = Vendor::all();
        
        return response()
            ->json($vendors);
    }
}



?>