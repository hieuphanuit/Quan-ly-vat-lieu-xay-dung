<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class AngencyProduct extends Model
{
    //
    protected $table = 'angency_product';

    protected $fillable = [
        'agency_id',
        'product_id',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }
}
