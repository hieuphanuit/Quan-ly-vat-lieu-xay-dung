<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $service;

    public function __construct(CustomerService $customerService)
    {
        $this->service = $customerService;
    }

    public function create(CreateCustomerRequest $request)
    {
        return $this->service->create($request);
    }
}
