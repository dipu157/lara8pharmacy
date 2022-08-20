<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\Doctor;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
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

       return view('Doctor.doctorIndex');
    }


    public function getAllDoctor()
    {
       // echo $current = Carbon::now()->format('Y-m-d');

        $users = Doctor::all();
        $output = '';
        if($users->count() > 0){
            $output .= '<table id="getAllDoctor" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Degrees</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($users as $row) {
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->full_name.'</td>
                <td>'.$row->email.'</td>
                <td>'.$row->phone.'</td>
                <td>'.$row->degrees.'</td>
                <td>
                  <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editdoctorModal"><i class="fa fa-edit"></i></a>

                  <a href="#" id="' . $row->id . '" class="text-danger mx-1 deleteIcon"><i class="fa fa-trash"></i></a>
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
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $data = [
            'company_id' => $this->company_id,
            'full_name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'degrees' => $request->degrees,
            'user_id' => $this->user_id,
        ];

        Doctor::create($data);

        return response()->json([
            'status' => 200
        ]);
    }

    public function edit(Request $request){

        $id = $request->id;
        $doctor = Doctor::find($id);
        return response()->json($doctor);
    }

    public function update(Request $request) {

        $doctor = Doctor::find($request->id);
        $data = [
            'company_id' => $this->company_id,
            'full_name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'degrees' => $request->degrees,
            'user_id' => $this->user_id,
        ];

        $doctor->update($data);

        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request) {
        $id = $request->id;
        $doctor = Doctor::find($id);
        Doctor::destroy($id);
    }
}
