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

    public function index(Request $request)
    {
        return $this->service->index($request); 
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }

    public function create(CreateCustomerRequest $request)
    {
        return $this->service->create($request);
    }

    public function update(UpdateCustomerRequest $request)
    {
        return $this->service->update($request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

    public function selectList()
    {
        return $this->service->selectList();
    }
}
