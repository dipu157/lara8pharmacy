<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Common\Company;
use App\Models\Medicine\Strength;
use Auth;

class StrengthController extends Controller
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

       return view('Medicine.Strength.strengthIndex');
    }


    public function getAllStrength()
    {
       // echo $current = Carbon::now()->format('Y-m-d');

        $strength = Strength::all();
        $output = '';
        if($strength->count() > 0){
            $output .= '<table id="getAllStrength" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Strength</th>
                    <th>Status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($strength as $row) {
                $status = ($row->status == 1) ? "Active"  :  "In-Active";
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->strength.'</td>
                <td>'.$status.'</td>
                <td>
                  <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editStrengthModal"> <i class="fa fa-edit"></i></a>

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
            'strength' => $request->strength,
            'user_id' => $this->user_id,
        ];

        Strength::create($data);
        return response()->json([
            'status' => 200
        ]);
    }

    public function edit(Request $request){

        $id = $request->id;
        $strength = Strength::find($id);
        return response()->json($strength);
    }

    public function update(Request $request) {

        $strength = Strength::find($request->id);
        $data = [
            'company_id' => $this->company_id,
            'strength' => $request->strength,
            'user_id' => $this->user_id,
        ];

        $strength->update($data);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request) {
        $id = $request->id;
      //  $Strength = Strength::find($id);
        Strength::destroy($id);
    }
}
