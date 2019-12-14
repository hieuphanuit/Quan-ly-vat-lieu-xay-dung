<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\VendorService;
use App\Http\Requests\Vendor\CreateVendorRequest;
use App\Http\Requests\Vendor\UpdateVendorRequest;

class VendorController extends Controller
{
    //
    protected $service;

    public function __construct(VendorService $vendorService)
    {
        $this->service = $vendorService;    
    }
    
    public function index(Request $request)
    {
        return $this->service->index($request); 
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }

    public function create(CreateVendorRequest $request)
    {
        return $this->service->create($request);
    }

    public function update(UpdateVendorRequest $request)
    {
        return $this->service->update($request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

    public function selectList()
    {
        return $this->service->getList();
    }
}