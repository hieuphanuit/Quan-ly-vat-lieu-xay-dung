<?php

namespace App\Entities;

use App\Entities\AgencyProduct;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    protected $fillable = [
        'name',
        'unit',
        'price',
        'import_price',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function agencyProduct()
    {
        return $this->hasOne(AgencyProduct::class, 'product_id');
    }
}
