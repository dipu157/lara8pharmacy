<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Common\Company;
use App\Models\Common\Employee;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Auth;

class EmployeeController extends Controller
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

    public function create(Request $request)
    {

        $file = $request->file('photo');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/images', $filename);

        $empData = [
            'company_id' => $this->company_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'dob' => Carbon::createFromFormat('d/m/Y',$request['dob'])->format('Y-m-d'),
            'gender' => $request->gender,
            'national_id' => $request->national_id,
            'address' => $request->address,
            'blood_group' => $request->blood_group,
            'last_education' => $request->last_education,
            'photo' => $filename,
        ];

        Employee::create($empData);
        return response()->json([
            'status' => 200
        ]);
    }


    public function edit(Request $request){

        $id = $request->id;
        $emp = Employee::find($id);
        return response()->json($emp);
    }


     // handle update an employee ajax request
    public function update(Request $request) {

        $fileName = '';
        $emp = Employee::find($request->id);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($emp->photo) {
                Storage::delete('public/images/' . $emp->photo);
            }
        } else {
            $fileName = $request->emp_photo;
        }

        $empData = [
            'first_name' => $request->first_name, 
            'last_name' => $request->last_name, 
            'email' => $request->email, 
            'mobile' => $request->mobile, 
            'dob' => $request->dob, 
            'gender' => $request->gender, 
            'national_id' => $request->national_id, 
            'address' => $request->address, 
            'blood_group' => $request->blood_group, 
            'last_education' => $request->last_education, 
            'photo' => $fileName
        ];

        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request) {
        $id = $request->id;
        $emp = Employee::find($id);
        if (Storage::delete('public/images/' . $emp->photo)) {
            Employee::destroy($id);
        }
    }

}
