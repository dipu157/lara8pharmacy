<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\Customers;
use App\Models\Customer\Customer_ledger;
use Auth;

class CustomerController extends Controller
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
       return view('Customer.customerIndex');
    }


    public function getAllCustomer()
    {
       // echo $current = Carbon::now()->format('Y-m-d');

        $customer = Customers::all();
        $output = '';
        if($customer->count() > 0){
            $output .= '<table id="getAllCustomer" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Customer Type</th>
                    <th>Discount</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($customer as $row) {
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'. $row->name. '</td>
                <td>'.$row->phone.'</td>
                <td>'.$row->customer_type.'</td>
                <td>'.$row->regular_discount.'</td>
                <td>
                  <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editCustomerModal"><i class="fa fa-edit"></i></a>
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

    public function create(Request $request)
    {
        $data = [
            'company_id' => $this->company_id,
            'customer_code' => 'C'.rand(1000,1999),
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'customer_type' => $request->customer_type,
            'regular_discount' => $request->regular_discount,
            'special_discount' => $request->special_discount,
            'user_id' => $this->user_id,
        ];

       // dd($data);

        Customers::create($data);

        $customer = Customers::query()
                        ->where('company_id',1)
                        ->latest('id')->first();
        //dd($income);

        $data1 = [
            'company_id' => $this->company_id,
            'customer_id' => $customer->id,
            'total_balance' => 0.00,
            'paid' => 0.00,
            'due' => 0.00,
            'user_id' => $this->user_id,
        ];

        Customer_ledger::create($data1);


        return response()->json([
            'status' => 200
        ]);
    }

    public function edit(Request $request){

        $id = $request->id;
        $customer = Customers::find($id);
        return response()->json($customer);
    }

    public function update(Request $request) {

        $customer = Customers::find($request->id);
        $data = [
            'company_id' => $this->company_id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'customer_type' => $request->customer_type,
            'regular_discount' => $request->regular_discount,
            'special_discount' => $request->special_discount,
            'user_id' => $this->user_id,
        ];

        $customer->update($data);
        return response()->json([
            'status' => 200,
        ]);
    }
}
