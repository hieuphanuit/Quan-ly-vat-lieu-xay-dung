<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellingBillDetail extends Model
{
    protected $table = 'selling_bill_detail';

    protected $fillable = [
        'id',
        'selling_bill_id',
        'product_id',
        'total',
        'unit_price',
        'quantity'
    ];
}
