<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellingTransaction extends Model
{
    protected $table = 'selling_transactions';

    protected $fillable = [
        'id',
        'selling_bill_id',
        'amount'
    ];
}
