<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Entities\Customer;

class CustomerService
{

    public function create($request)
    {
        $data = $request->all();
        $customer = Customer::create($data);

        return response()
            ->json(['message' => 'Create products Success']);
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
