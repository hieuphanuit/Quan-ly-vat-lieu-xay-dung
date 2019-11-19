<?php

namespace App;

use App\Entities\ImportGoodBill;
use Illuminate\Database\Eloquent\Model;

class ImportGoodTransaction extends Model
{
    protected $table = 'import_good_transactions';

    protected $fillable = [
        'id',
        'import_good_bill_id',
        'amount',
    ];

    public function ImportGoodBill()
    {
        return $this->belongsTo(ImportGoodBill::class, 'import_good_bill_id');
    }
}
