<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    //
    protected $service;

    public function __construct(UserService $agencyService)
    {
        $this->service = $agencyService;    
    }
    
    public function index(Request $request)
    {
        return $this->service->index($request); 
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }

    public function create(CreateUserRequest $request)
    {
        return $this->service->create($request);
    }

    public function update(UpdateUserRequest $request)
    {
        return $this->service->update($request);
    }
    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
