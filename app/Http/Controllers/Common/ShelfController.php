<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Common\Company;
use App\Models\Common\Shelf;
use Auth;

class ShelfController extends Controller
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
        return view('Shelf.shelfIndex');
    }

    public function getAllShelf()
    {
       // echo $current = Carbon::now()->format('Y-m-d');

        $users = Shelf::all();
        $output = '';
        if($users->count() > 0){
            $output .= '<table id="getAllShelf" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>details</th>
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
                <td>'.$row->details.'</td>
                <td>'.$status.'</td>
                <td>
                  <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editShelfModal"><i class="fa fa-edit"></i></a>

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
            'details' => $request->details,
            'user_id' => $this->user_id,
        ];

        Shelf::create($data);
        return response()->json([
            'status' => 200
        ]);
    }

    public function edit(Request $request){

        $id = $request->id;
        $shelf = Shelf::find($id);
        return response()->json($shelf);
    }

    public function update(Request $request) {

        $shelf = Shelf::find($request->id);
        $data = [
            'company_id' => $this->company_id,
            'name' => $request->name,
            'details' => $request->details,
            'user_id' => $this->user_id,
        ];

        $shelf->update($data);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request) {
        $id = $request->id;
        Shelf::destroy($id);
    }
}
