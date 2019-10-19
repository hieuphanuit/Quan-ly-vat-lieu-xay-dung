<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellingBill extends Model
{
    //
    protected $table = 'selling_bill';

    protected $fillable = [
        'id',
        'agency_id',
        'amount',
        'created_by',
        'total_amount',
        'total_paid',
        'customer_id',
        'status'
    ];
}
