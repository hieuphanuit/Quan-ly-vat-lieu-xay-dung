<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Entities\Category;

class CategoryService {

    public function index($request)
    {
        $limit = $request->get('limit', 1);
        $categories = Category::withDepth()->paginate($limit);

        return response()
            ->json($categories); 
    }

    public function detail($id)
    {
        $category = Category::find($id);

        return response()
            ->json($category);
    }

    public function create($request)
    {
        $data = $request->all();
        $category = Category::create($data);

        return response()
            ->json($category);
    }

    public function update($request)
    {
        $data = $request->all();
        $category = Category::find($request->id);
        $category->update($data);

        return response()
            ->json($category);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()
            ->json('Success');
    }

    public function selectList()
    {
        $categories = Category::select('name', 'id')->get();
        return response()
            ->json($categories);
    }
}



?>