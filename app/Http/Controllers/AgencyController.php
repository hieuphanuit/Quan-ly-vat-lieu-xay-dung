<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\AgencyService;
use App\Http\Requests\Agency\CreateAgencyRequest;
use App\Http\Requests\Agency\UpdateAgencyRequest;

class AgencyController extends Controller
{
    //
    protected $service;

    public function __construct(AgencyService $agencyService)
    {
        $this->service = $agencyService;    
    }
    
    public function index(Request $request)
    {
        return $this->service->index($request); 
    }

    public function getList()
    {
        return $this->service->all();
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }

    public function create(CreateAgencyRequest $request)
    {
        $request['manager_id'] = auth()->user()->id;
        return $this->service->create($request);
    }

    public function update(Request $request)
    {
        return $this->service->update($request);       
    }
    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
