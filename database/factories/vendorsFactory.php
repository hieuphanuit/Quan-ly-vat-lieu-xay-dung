<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Vendor;
use Faker\Generator as Faker;

$factory->define(Vendor::class, function (Faker $faker) {
    return [
        //
  


        'name' => "vendor name 1",
        'address' => "vendor address 1",
        'phone' => "999999999",
        'email'=> "vendor@gmail.com",
        'in_debt_amount' => 100,

    ];
});
