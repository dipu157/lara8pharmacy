<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Common\Company;
use App\Models\Common\Role;
use App\Models\Common\Employee;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
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
       $roles = Role::query()->where('company_id',$this->company_id)->pluck('name','id');

       $employees = Employee::query()
       ->where('company_id',$this->company_id)
       ->where('status',true)
       ->pluck('full_name','id');

      // dd($employees);

       return view('User.userIndex',compact('roles','employees'));
    }

    
    public function getAllUser()
    {
       // echo $current = Carbon::now()->format('Y-m-d');

        $users = User::all();
        $output = '';
        if($users->count() > 0){
            $output .= '<table id="getAllUser" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($users as $row) {
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->role->name.'</td>
                <td>'. $row->employee->full_name.'</td>
                <td>'.$row->email.'</td>
                <td>
                  <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editUserModal"><i class="fa fa-edit"></i></a>

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

    public function edit(Request $request){

        $id = $request->id;
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request) {

        $user = User::find($request->id);
        $userData = [
            'role_id' => $request->role_id, 
            'employee_id' => $request->employee_id, 
            'email' => $request->email,
        ];

        $user->update($userData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request) {
        $id = $request->id;
        $user = User::find($id);
        User::destroy($id);
    }
}
