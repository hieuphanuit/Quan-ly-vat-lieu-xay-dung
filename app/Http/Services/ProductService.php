<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Entities\Product;
use App\Helpers\Traits\UploadImageTrait;

class ProductService {
    use UploadImageTrait;

    public function index($request)
    {
        $limit = $request->get('limit');
        $keyword = $request->get('keyword');
        $priceFrom = $request->get('price_from');
        $priceTo = $request->get('price_to');
        $categories = $request->get('categories');

        $productQuery = Product::with(['categories', 'images']);
        
        if ($keyword) {
            $productQuery->where('name', 'like', "%{$keyword}%");
        }

        if ($priceFrom) {
            $productQuery->where('price', '>=', $priceFrom);
        }

        if ($priceTo) {
            $productQuery->where('name', '<=', $priceTo);
        }

        if ($categories) {
            $productQuery->whereHas('categories', function (Builder $query) use ($categories){
                $query->whereIn('id', $categories);
            });
        }

        if ($keyword) {
            $productQuery->where('name', 'like', "%{$keyword}%");
        }

        $product = $productQuery->paginate($limit);

        return response()
            ->json($product);
    }

    public function detail($id)
    {
        $product = Product::with(['categories', 'images'])
            ->find($id);

        return response()
            ->json($product);
    }

    public function create($request)
    {
        $data = $request->all();
        $product = Product::create($data);

        $categories = $request->get('categories');
        $product->categories()->attach($categories);

        $images = $request->file('images');

        if($request->hasFile('images'))
        {
            foreach ($images as $image) {
                $path = $this->upload($image);
                $product->images()->create([
                    'image' => $path
                ]);
            }
        }

        return response()
            ->json($product);
    }

    public function update($request)
    {
        $data = $request->all();
        $product = Product::find($request->id);
        $product->update($data);

        $categories = $request->get('categories');
        $product->categories()->sync($categories);

        $images = $request->file('images');

        if($request->hasFile('images'))
        {
            foreach ($images as $image) {
                $path = $this->upload($image);
                $product->images()->create([
                    'image' => $path
                ]);
            }
        }

        $deleteImages = $request->get('delete_images', []);
        $product->images()->whereIn('id', $deleteImages)->delete();

        return response()
            ->json($product);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()
            ->json('Success');
    }
}



?>
