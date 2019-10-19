<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Entities\Agency;

class AgencyService {

    public function index($request)
    {
        $limit = $request->get('limit', 10);

        $agency = Agency::paginate($limit);

        return response()
            ->json($agency); 
    }

    public function detail($id)
    {
        $agency = Agency::find($id);

        return response()
            ->json($agency);
    }

    public function create($request)
    {
        $data = $request->all();
        $agency = Agency::create($data);

        return response()
            ->json($agency);
    }

    public function update($request)
    {
        $data = $request->all();
        $agency = Agency::find($request->id);
        $agency->update($data);

        return response()
            ->json($agency);
    }

    public function delete($id)
    {
        $agency = Agency::find($id);
        $agency->delete();

        return response()
            ->json('Success');
    }
}



?>