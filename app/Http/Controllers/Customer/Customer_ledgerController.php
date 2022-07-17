<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\Customers;
use App\Models\Customer\Customer_ledger;
use Auth;

class Customer_ledgerController extends Controller
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
        return view('Customer.CustomerLedger.customerLedgerIndex');
    }


    public function fatchAll()
    {
       // echo $current = Carbon::now()->format('Y-m-d');

        $cust_ledg = Customer_ledger::all();
        $output = '';
        if($cust_ledg->count() > 0){
            $output .= '<table id="getAllCustomerLedger" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Total Balance</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($cust_ledg as $cl) {
                $output .= '<tr>
                <td>'.$cl->id.'</td>
                <td>'. $cl->customer->name. '</td>
                <td>'.$cl->total_balance.'</td>
                <td>'.$cl->paid.'</td>
                <td>'.$cl->due.'</td>
                <td>
                  <a href="#" id="' . $cl->id . '" class="text-success mx-1 printIcon"><i class="fa fa-print"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        }else{
            echo '<h1 class="text-center text-secondary my-5">No Record Found in Database</h1>';
        }

     //   return view('employeeIndex');
    }
}
