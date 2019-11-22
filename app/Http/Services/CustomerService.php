<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Entities\Customer;

class CustomerService
{
    public function index($request)
    {
        $limit = $request->get('limit', 10);

        $customer = Customer::paginate($limit);

        return response()
            ->json($customer); 
    }

    public function detail($id)
    {
        $customer = Customer::find($id);

        return response()
            ->json($customer);
    }

    public function create($request)
    {
        $data = $request->all();
        $customer = Customer::create($data);

        return response()
            ->json($customer);
    }

    public function update($request)
    {
        $data = $request->all();
        $customer = Customer::find($request->id);
        $customer->update($data);

        return response()
            ->json($customer);
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return response()
            ->json('Success');
    }
}



?>
