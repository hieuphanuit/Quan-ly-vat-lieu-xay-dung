<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'in_debt_amount'
    ];


}
