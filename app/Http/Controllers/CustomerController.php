<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Services\CustomerService;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    protected $service;

    public function __construct(CustomerService $customerService)
    {
        $this->service = $customerService;
    }

    /**
     * create customer
     * @param CreateCustomerRequest $request
     * @return Response
    */
    public function create(CreateCustomerRequest $request)
    {
        return $this->service->create($request);
    }

    /**
     * update customer 
     * @params UpdateCustomerRequest $request
     * @return Response
    */
    public function update(UpdateCustomerRequest $request)
    {
        return $this->service->update($request);
    }

    /**
     * delete customer
     * @param integer $id : customer id
     * @return JsonResponse
     */
    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
