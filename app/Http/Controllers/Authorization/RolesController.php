<?php

namespace App\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->company_id = Auth::user()->company_id;
            $this->user_id = Auth::id();

            return $next($request);
        });
    }

    public function rollIndex()
    {
        return view('auth.authorization.roll.rollIndex');
    }

    public function fetchRoll()
    {
        $role = Role::all();
        $output = '';
        if($role->count() > 0){
            $output .= '<table id="example1" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Roll Name</th>
                    <th>Assign Role</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($role as $row) {
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->name.'</td>
                <td>
                <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon"><i class="fa fa-edit"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        }else{
            echo '<h1 class="text-center text-secondary my-5">No Record Found in Database</h1>';
        }
    }

    public function saveRoll(Request $request)
    {
        $role = Role::create(['name' => $request->name]);

        return response()->json([
            'status' => 200
        ]);
    }

    public function permissionIndex()
    {
        return view('auth.authorization.permission.permissionIndex');
    }

    public function fetchPermission()
    {
        $role = Permission::all();
        $output = '';
        if($role->count() > 0){
            $output .= '<table id="example1" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Permission Name</th>
                    <th>Group Name</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($role as $row) {
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->name.'</td>
                <td>'.$row->group_name.'</td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        }else{
            echo '<h1 class="text-center text-secondary my-5">No Record Found in Database</h1>';
        }
    }

    public function savePermission(Request $request)
    {
        $permission = Permission::create(['name' => $request->name,'group_name' => $request->group_name]);

        return response()->json([
            'status' => 200
        ]);
    }

    public static function getpermissionsByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
        ->select('name','id')
        ->where('group_name', $group_name)
        ->get();

        return $permissions;
    }

    public function rollPermissionIndex(Request $request)
    {
        $id = $request->id;

        $role = Role::findById($id);
        $permission = Permission::all();
        $permission_groups = DB::table('permissions')
        ->select('group_name')
        ->groupBy('group_name')
        ->get();

        $view = view('auth.authorization.rollPermissionIndex',compact('role','permission','permission_groups'))->render();
        return $view;

    }

    public function UpdateRolePermission(Request $request)
    {
        
       $role = Role::findById($request->role_id);
       $permissions = $request->permission;

       $role->givePermissionTo($permissions);

       return redirect('/createRollIndex')->with('status', 'Role Permission updated!');
    }

    public function userPermissionIndex()
    {

        return view('auth.authorization.userPermissionIndex');
    }

    public function getallUsers()
    {
        $role = User::all();
        $output = '';
        if($role->count() > 0){
            $output .= '<table id="example1" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Assign Role</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($role as $row) {
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->name.'</td>
                <td>
                <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon"><i class="fa fa-edit"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        }else{
            echo '<h1 class="text-center text-secondary my-5">No Record Found in Database</h1>';
        }
    }

    
}
