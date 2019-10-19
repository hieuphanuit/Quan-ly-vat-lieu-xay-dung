<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        '_lft',
        '_rgt',
        'parent_id',
    ];


}
