<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //
        'name' => "san pham 1",
        'unit' =>"kg",
        'price' => 10,
        'import_price' => 8, // secret
    ];
});
