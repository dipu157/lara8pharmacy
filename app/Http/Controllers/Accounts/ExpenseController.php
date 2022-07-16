<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts\Expense;
use Auth;

class ExpenseController extends Controller
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

       return view('Accounts.Expense.otherExpenseIndex');
    }
}
