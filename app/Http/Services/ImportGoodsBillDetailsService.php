<?php


namespace App\Http\Services;

class ImportGoodBillDetailsService
{
    public function create($request)
    {
        return ImportGoodBillDetail::create($request);
    }

}
