<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\AngencyProductService;
use App\Http\Requests\AngencyProduct\UpdateAngencyProducRequest;
use App\Http\Requests\AngencyProduct\CreateAngencyProducRequest;

class AngencyProductController extends Controller
{
    //AngencyProduc
    protected $service;
    public function __construct(AngencyProductService $angencyproductService)
    {
        $this->service = $angencyproductService;
    }
    public function index(Request $request)
    {
        return $this->service->index($request); 
    }
    public function detail($id)
    {
        return $this->service->detail($id);
    }
    public function create(CreateAngencyProducRequest $request)
    {
        return $this->service->create($request);        
    }
    public function update(UpdateAngencyProducRequest $request)
    {
        return $this->service->update($request);
    }
    public function delete($id)
    {
        return $this->service->delete($id);
    }
    
}
