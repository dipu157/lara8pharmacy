<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\Customers;
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
                  <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editEmployeeModal"><i class="fa fa-edit"></i></a>

                  <a href="#" id="' . $row->id . '" class="text-danger mx-1 deleteIcon"><i class="fa fa-trash"></i></a>
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
