<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine\Generic;
use Illuminate\Support\Facades\Auth;

class GenericController extends Controller
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

       return view('Medicine.Generic.genericIndex');
    }


    public function getAllGeneric()
    {
       // echo $current = Carbon::now()->format('Y-m-d');

        $users = Generic::all();
        $output = '';
        if($users->count() > 0){
            $output .= '<table id="getAllgeneric" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($users as $row) {
                $status = ($row->status == 1) ? "Active"  :  "In-Active";
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->name.'</td>
                <td>'.$status. '</td>
                <td>
                  <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editGenericModal"> <i class="fa fa-edit"></i></a>

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


        $data = [
            'company_id' => $this->company_id,
            'name' => $request->name,
            'user_id' => $this->user_id,
        ];

        Generic::create($data);
        return response()->json([
            'status' => 200
        ]);
    }

    public function edit(Request $request){

        $id = $request->id;
        $generic = Generic::find($id);
        return response()->json($generic);
    }

    public function update(Request $request) {

        $generic = Generic::find($request->id);
        $data = [
            'company_id' => $this->company_id,
            'name' => $request->name,
            'user_id' => $this->user_id,
        ];

        $generic->update($data);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request) {
        $id = $request->id;
      //  $generic = Generic::find($id);
        Generic::destroy($id);
    }
}
