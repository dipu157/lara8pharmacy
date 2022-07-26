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

    public function customerById(Request $request)
    {
        $id = $request->search;
        $customer = Customers::query()
                    ->where('company_id',1)
                    ->where('name', 'LIKE', "%{$id}%")
                    ->orWhere('phone', 'LIKE', "%{$id}%")
                    ->orWhere('customer_code', 'LIKE', "%{$id}%")
                    ->limit(10)
                    ->get();


        foreach ($customer as $row){
            $new_row['label']=htmlentities(stripslashes($row['name']));
            $new_row['value']=htmlentities(stripslashes($row['id']));
            $new_row['c_cont']=htmlentities(stripslashes($row['phone']));
            $new_row['ctype']=htmlentities(stripslashes($row['customer_type']));
            $row_set[] = $new_row; //build an array
            }
            echo json_encode($row_set); //format the array into json data

    }

    public function customerBalancebyID(Request $request)
    {
        $id = $request->id;

        $customer = Customers::query()
                    ->where('company_id',1)
                    ->where('id', $id)
                    ->first();

        $customer_ledger = Customer_ledger::query()
                            ->where('company_id',1)
                            ->where('customer_id',$id)
                            ->first();
       // dd($customer_ledger);

        echo"<div class='dues'>";
            if($customer_ledger->due > 0){
                echo"<h4 class='previous-due-header'><span class='previous-dues'>Previous Dues= </span> $customer_ledger->due TK</h4>";
            } ;
    }

    public function superMedicinepos(Request $request)
    {
        $id = $request->id ;
        $data = [];
        $superMedicine = Medicine::query()
                        ->where('company_id',1)
                        ->where('id',$id)
                        ->with('medicine_type')
                        ->with('strength')
                        ->with('generic')
                        ->first();

        $data['mvalue'] = $superMedicine;

        echo json_encode($data);
    }

    public function medicineTorow(Request $request)
    {
        $cid = $request->customer_id;
        $pid = $request->proid;
        $qty = $request->qty;
        $mrp = $request->mrp;
    }
}
