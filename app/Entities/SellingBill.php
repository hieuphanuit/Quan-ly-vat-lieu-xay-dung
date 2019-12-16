<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\SellingBillDetail;

class SellingBill extends Model
{
    //
    protected $table = 'selling_bills';

    protected $fillable = [
        'id',
        'agency_id',
        'created_by',
        'total_amount',
        'total_paid',
        'customer_id',
        'status_paid',
        'status_confirm'
    ];

    public function SellingBillDetail()
    {
        return $this->hasMany(SellingBillDetail::class, 'selling_bill_id');
    }
}
