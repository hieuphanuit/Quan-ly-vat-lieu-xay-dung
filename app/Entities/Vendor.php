<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    //
    protected $table = 'vendors';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'in_debt_amount'
    ];


}
