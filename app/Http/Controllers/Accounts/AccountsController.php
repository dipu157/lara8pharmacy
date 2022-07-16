<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts\Accounts;
use Auth;

class AccountsController extends Controller
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
        $open_balance = Accounts::query()
                        ->where('company_id',1)
                        ->where('id',1)
                        ->get();
       // dd($open_balance);

       return view('Accounts.openingBalanceIndex',compact('open_balance'));
    }

    public function create(Request $request)
    {
        $open_balance = Accounts::find($request->id);
        $data = [
            'company_id' => $this->company_id,
            'opening_balance' => $request->opening_balance,
            'cash_in_hand' => $request->cash_in_hand,
            'closing_balance' => $request->closing_balance,
            'user_id' => $this->user_id,
        ];

        $open_balance->update($data);
        return response()->json([
            'status' => 200,
        ]);

    }
}
