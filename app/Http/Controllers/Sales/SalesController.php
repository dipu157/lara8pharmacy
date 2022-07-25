<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine\Medicine;
use App\Models\Customer\Customers;
use App\Models\Customer\Customer_ledger;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->company_id = Auth::user()->company_id;
            $this->user_id = Auth::id();

            return $next($request);
        });
    }

    public function index()
    {
        $medicine = Medicine::query()
                ->where('company_id', 1)
                ->where('status', true)->get();

        return view('Sales.salesIndex',compact('medicine'));
    }

    public function GetCustomerId(Request $request)
    {
        $id = $request->search;
        $customer = Customers::query()
                    ->where('company_id',1)
                    ->where('name', 'LIKE', "%{$id}%")
                    ->orWhere('phone', 'LIKE', "%{$id}%")
                    ->orWhere('customer_code', 'LIKE', "%{$id}%")
                    ->limit(10)
                    ->get();
    }

    public function customerBalancebyID()
    {

    }
}
