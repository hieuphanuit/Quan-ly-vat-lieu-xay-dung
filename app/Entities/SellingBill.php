<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

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

    public function sellingBillDetail()
    {
        return $this->hasMany(SellingBillDetail::class, 'selling_bill_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function sellingTransaction()
    {
        return $this->hasMany(SellingTransaction::class, 'selling_bill_id');
    }

}
