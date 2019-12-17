<?php

namespace App\Http\Controllers;

use App\Entities\SellingBill;
use App\Entities\SellingTransaction;
use Illuminate\Http\Request;
use App\Http\Services\SellingTransactionsService;
use App\Http\Requests\SellingTransactions\CreateSellingTransactionRequest;
use App\Http\Requests\SellingTransactions\UpdateSellingTransactionsRequest;

class SellingTransactionsController extends Controller
{
    //
    protected $service;

    public function __construct(SellingTransactionsService $sellingtransactionsService)
    {
        $this->service = $sellingtransactionsService;
    }

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function detail($id)
    {
        return $this->service->detail($id);
    }

    public function getListSellingBill(Request $request)
    {
        $data = $request->all();
    }

    public function create(CreateSellingTransactionRequest $request)
    {
        return $this->service->create($request);
    }

    public function update(UpdateSellingTransactionsRequest $request)
    {
        return $this->service->update($request);
    }
    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
