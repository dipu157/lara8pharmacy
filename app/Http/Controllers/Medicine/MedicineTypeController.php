<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Common\Company;
use App\Models\Medicine\Medicine_Type;
use Auth;

class MedicineTypeController extends Controller
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

       return view('Medicine.MedicineType.medicineTypeIndex');
    }


    public function getAllMedicineType()
    {
       // echo $current = Carbon::now()->format('Y-m-d');

        $medicineType = Medicine_Type::all();
        $output = '';
        if($medicineType->count() > 0){
            $output .= '<table id="getAllMedicine_Type" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Short Name</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($medicineType as $row) {
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->code.'</td>
                <td>'.$row->name.'</td>
                <td>'.$row->short_name.'</td>
                <td>
                  <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editMedicineTypeModal"> <i class="fa fa-edit"></i></a>

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
            'code' => rand(1000,2000),
            'name' => $request->name,
            'short_name' => $request->short_name,
            'user_id' => $this->user_id,
        ];

        Medicine_Type::create($data);
        return response()->json([
            'status' => 200
        ]);
    }

    public function edit(Request $request){

        $id = $request->id;
        $medicine_Type = Medicine_Type::find($id);
        return response()->json($medicine_Type);
    }

    public function update(Request $request) {

        $medicine_Type = Medicine_Type::find($request->id);
        $data = [
            'company_id' => $this->company_id,
            'code' => rand(1000,2000),
            'name' => $request->name,
            'short_name' => $request->short_name,
            'user_id' => $this->user_id,
        ];

        $medicine_Type->update($data);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request) {
        $id = $request->id;
      //  $Medicine_Type = Medicine_Type::find($id);
        Medicine_Type::destroy($id);
    }
}
