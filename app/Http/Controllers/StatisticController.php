<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Statics\UserRolesStatic;

use App\Entities\User;
use App\Entities\SellingBill;
use App\Entities\ImportGoodBill;

use DB;

class StatisticController extends Controller
{
    public function overviewStatistic(Request $request) 
    {
        $agencyId = $request->get('agency_id');
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $user = auth()->user();
        if ($user->role == UserRolesStatic::AGENCY_MANAGER) {
            $agencyId = $user->agency_id; 
        }

        $totalUserQuery = User::query();
        $totalSellingBillQuery = SellingBill::query();
        $totalSellingBillPaidAmountQuery = SellingBill::query();
        $totalImportBillPaidAmountQuery = ImportGoodBill::query();

        if($agencyId) {
            $totalUserQuery->where('agency_id', $agencyId);
            $totalSellingBillQuery->where('agency_id', $agencyId);
            $totalSellingBillPaidAmountQuery->where('agency_id', $agencyId);
            $totalImportBillPaidAmountQuery->where('agency_id', $agencyId);
        }

        if($fromDate) {
            $totalSellingBillQuery->where('created_at', '>=', $fromDate);
            $totalSellingBillPaidAmountQuery->where('created_at', '>=', $fromDate);
            $totalImportBillPaidAmountQuery->where('created_at', '>=', $fromDate);

        }

        if($toDate) {
            $totalSellingBillQuery->where('created_at', '<=', $toDate);
            $totalSellingBillPaidAmountQuery->where('created_at', '<=', $toDate);
            $totalImportBillPaidAmountQuery->where('created_at', '<=', $toDate);
        }

        $totalUser = $totalUserQuery->count();
        $totalSellingBill = $totalSellingBillQuery->count();
        $totalSellingBillPaidAmount = $totalSellingBillPaidAmountQuery->sum('total_paid');
        $totalImportBillPaidAmount = $totalImportBillPaidAmountQuery->sum('total_paid');

        return response()->json([
            'total_user' => $totalUser,
            'total_selling_bill' => $totalSellingBill,
            'total_paid' => $totalSellingBillPaidAmount,
            'total_spend' => $totalImportBillPaidAmount,
        ]);
    }

    public function sellingBillTrend(Request $request)
    {
        $agencyId = $request->get('agency_id');
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $user = auth()->user();
        if ($user->role == UserRolesStatic::AGENCY_MANAGER) {
            $agencyId = $user->agency_id; 
        }

        $query = SellingBill::query();
        
        if($agencyId) {
            $query->where('agency_id', $agencyId);
        }

        if($fromDate) {
            $query->where('created_at', '>=', $fromDate);

        }

        if($toDate) {
            $query->where('created_at', '<=', $toDate);
        }

        $query->select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        ])
            ->groupBy('date');
        
        $data = $query->get();

        return response()->json($data);
    }

    public function sellingBillPaidTrend(Request $request)
    {
        $agencyId = $request->get('agency_id');
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $user = auth()->user();
        if ($user->role == UserRolesStatic::AGENCY_MANAGER) {
            $agencyId = $user->agency_id; 
        }

        $query = SellingBill::query();
        
        if($agencyId) {
            $query->where('agency_id', $agencyId);
        }

        if($fromDate) {
            $query->where('created_at', '>=', $fromDate);

        }

        if($toDate) {
            $query->where('created_at', '<=', $toDate);
        }

        $query->select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_paid) as total_paid')
        ])
            ->groupBy('date');
        
        $data = $query->get();

        return response()->json($data);
    }

    public function importBillSpendTrend(Request $request)
    {
        $agencyId = $request->get('agency_id');
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $user = auth()->user();
        if ($user->role == UserRolesStatic::AGENCY_MANAGER) {
            $agencyId = $user->agency_id; 
        }

        $query = ImportGoodBill::query();
        
        if($agencyId) {
            $query->where('agency_id', $agencyId);
        }

        if($fromDate) {
            $query->where('created_at', '>=', $fromDate);

        }

        if($toDate) {
            $query->where('created_at', '<=', $toDate);
        }

        $query->select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_paid) as total_spend')
        ])
            ->groupBy('date');
        
        $data = $query->get();

        return response()->json($data);
    }
}