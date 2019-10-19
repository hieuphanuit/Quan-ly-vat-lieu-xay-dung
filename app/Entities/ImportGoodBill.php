<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ImportGoodBill extends Model
{
    //
    protected $table = 'import_good_bills';

    protected $fillable = [
        'id',
        'created_by',
        'agency_id',
        'vendor_id',
        'total_amount',
        'total_paid',
        'status',
    ];

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
