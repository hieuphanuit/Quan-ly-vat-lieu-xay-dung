<?php


namespace App\Http\Services;
use App\Entities\ImportGoodBill;

class ImportGoodsBillService
{
    public function create($request)
    {
        return ImportGoodBill::create($request);
    }
}
