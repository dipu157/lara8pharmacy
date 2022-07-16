<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts\Income;
use App\Models\Common\Payment_Type;
use Auth;

class IncomeController extends Controller
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

        $payment_type = Payment_Type::query()->where('company_id',$this->company_id)->pluck('payment_method','id');

       return view('Accounts.Income.otherIncomeIndex',compact('payment_type'));
    }
}
