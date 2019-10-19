<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ImportGoodsBillDetail extends Model
{
    //
    protected $table = 'import_goods_bill_details';

    protected $fillable = [
        'import_goods_bill_id',
        'product_id',
        'unit_price',
        'quantity',
        'total',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
