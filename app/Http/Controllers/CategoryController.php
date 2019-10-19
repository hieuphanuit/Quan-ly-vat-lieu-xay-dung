<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Services\CategoryService;

class CategoryController extends Controller
{
    //
    protected $service;

    public function __construct(CategoryService $categoryService)
    {
        $this->service = $categoryService;    
    }
    
    public function index(Request $request)
    {
        return $this->service->index($request); 
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }

    public function create(CreateCategoryRequest $request)
    {
        return $this->service->create($request);
    }

    public function update(UpdateCategoryRequest $request)
    {
        return $this->service->update($request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
