<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts\Income;
use App\Models\Accounts\Accounts;
use App\Models\Common\Payment_Type;
use Carbon\Carbon;
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
        $open_balance = Accounts::query()
                        ->where('company_id',1)
                        ->first();

        $payment_type = Payment_Type::query()->where('company_id',$this->company_id)->pluck('payment_method','id');

       return view('Accounts.Income.otherIncomeIndex',compact('payment_type','open_balance'));
    }

    public function fetchAll()
    {
        $incomes = Income::all();
        $output = '';
        if($incomes->count() > 0){
            $output .= '<table id="getAllIncome" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Purpose</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($incomes as $row) {
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->purpose.'</td>
                <td>'.$row->description.'</td>
                <td>'.$row->amount.'</td>
                <td>'.$row->date.'</td>
                <td>
                  <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editIncomeModal"><i class="fa fa-edit"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        }else{
            echo '<h1 class="text-center text-secondary my-5">No Record Found in Database</h1>';
        }
    }

    public function create(Request $request)
    {
        $data = [
            'company_id' => $this->company_id,
            'purpose' => $request->purpose,
            'payment_type_id' => $request->payment_type_id,
            'description' => $request->description,
            'amount' => $request->amount,
            'date' => Carbon::createFromFormat('d/m/Y',$request['date'])->format('Y-m-d'),
            'user_id' => $this->user_id,
        ];

        Income::create($data);

        $open_balance = Accounts::query()
                        ->where('company_id',1)
                        ->latest('id')->first();

        // dd($open_balance);

        $income = Income::query()
                        ->where('company_id',1)
                        ->latest('id')->first();
        //dd($income);

        $data1 = [
            'company_id' => $this->company_id,
            'opening_balance' => 0,
            'cash_in_hand' => $open_balance->cash_in_hand + $income->amount,
            'cash_in' => $income->amount,
            'other_income_id' => $income->id,
            'user_id' => $this->user_id,
        ];

        Accounts::create($data1);


        return response()->json([
            'status' => 200
        ]);
    }
}
