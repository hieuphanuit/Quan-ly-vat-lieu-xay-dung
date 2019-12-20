<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class AgencyProduct extends Model
{
    //
    protected $table = 'agency_product';

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
