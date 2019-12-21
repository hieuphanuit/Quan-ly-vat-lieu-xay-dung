<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    //
    protected $table = 'agencies';

    protected $fillable = [
        'name',
        'address',
        'phone',
    ];
}
