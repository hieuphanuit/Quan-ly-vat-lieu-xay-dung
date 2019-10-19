<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class AgencyVendorDepts extends Model
{
    //
    protected $table = 'agency_vendor_depts';

    protected $fillable = [
        'id',
        'agency_id',
        'vendor_id',
        'in_dept_amount'
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }


}
