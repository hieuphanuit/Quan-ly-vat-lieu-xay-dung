<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'in_debt_amount'
    ];


}
