<?php


namespace App\Http\Services;
use App\Entities\ImportGoodsBillDetail;

class ImportGoodsBillDetailsService
{
    public function create($request)
    {
        return ImportGoodsBillDetail::create($request);
    }

}
