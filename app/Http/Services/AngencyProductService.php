<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Entities\AngencyProduct;

class AngencyProductService {

    public function index($request)
    {
        $limit = $request->get('limit', 10);

        $angencyproduct = AngencyProduct::paginate($limit);

        return response()
            ->json($angencyproduct); 
    }

    public function detail($id)
    {
        $angencyproduct = AngencyProduct::find($id);

        return response()
            ->json($angencyproduct);
    }

    public function create($request)
    {
        $data = $request->all();
        $angencyproduct = AngencyProduct::create($data);

        return response()
            ->json($angencyproduct);
    }

    public function update($request)
    {
        $data = $request->all();
        $angencyproduct = AngencyProduct::find($request->id);
        $angencyproduct->update($data);

        return response()
            ->json($angencyproduct);
    }

    public function delete($id)
    {
        $angencyproduct = AngencyProduct::find($id);
        $angencyproduct->delete();

        return response()
            ->json('Success');
    }
}



?>