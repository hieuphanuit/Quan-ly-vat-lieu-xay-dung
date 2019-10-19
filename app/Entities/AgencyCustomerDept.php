<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class AgencyCustomerDept extends Model
{
    //
    protected $table = 'agency_customer_depts';

    protected $fillable = [
        'id',
        'agency_id',
        'customer_id',
        'in_dept_amount'
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }


}
