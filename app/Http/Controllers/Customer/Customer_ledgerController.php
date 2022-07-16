<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
       // echo $current = Carbon::now()->format('Y-m-d');

        $emps = Employee::all();
        $output = '';
        if($emps->count() > 0){
            $output .= '<table id="getAllEmployee" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Blood Group</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>'.$emp->id.'</td>
                <td><img src="storage/images/'.$emp->photo.'" width="50"
                class="img-thumbnail"></td>
                <td>'. $emp->first_name.' '.$emp->last_name. '</td>
                <td>'.$emp->mobile.'</td>
                <td>'.$emp->email.'</td>
                <td>'.$emp->blood_group.'</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editEmployeeModal"><i class="fa fa-edit"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="fa fa-trash"></i></a>
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
