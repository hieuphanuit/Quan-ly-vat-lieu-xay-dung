<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Agency;
use Faker\Generator as Faker;

$factory->define(App\Entities\Agency::class, function (Faker $faker) {
    return [
        //
        'name' => "agency name 1",
        'address' => "agency address 1",
        'phone' => "132123132",
        'manager_id' => 1,
       
       
    ];
});
