<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class SellingBillDetail extends Model
{
    protected $table = 'selling_bill_details';

    protected $fillable = [
        'id',
        'selling_bill_id',
        'product_id',
        'total',
        'unit_price',
        'quantity'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
