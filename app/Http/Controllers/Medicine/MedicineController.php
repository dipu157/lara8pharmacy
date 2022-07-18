<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\Shelf;
use App\Models\Supplier\Supplier;
use App\Models\Medicine\Generic;
use App\Models\Medicine\Medicine_Type;
use App\Models\Medicine\Strength;
use App\Models\Medicine\Medicine;
use Illuminate\Support\Facades\Auth;


class MedicineController extends Controller
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
        $shelf = Shelf::query()->where('company_id',$this->company_id)
                        ->where('status',true)
                        ->pluck('name','id');

        $strength = Strength::query()->where('company_id',$this->company_id)
                        ->where('status',true)
                        ->pluck('strength','id');

        $supplier = Supplier::query()->where('company_id',$this->company_id)
                        ->where('status',true)
                        ->pluck('name','id');

        $generic = Generic::query()->where('company_id',$this->company_id)
                        ->where('status',true)
                        ->pluck('name','id');

        $medicine_type = Medicine_Type::query()->where('company_id',$this->company_id)
                        ->where('status',true)
                        ->pluck('name','id');

        return view('Medicine.Medicine.medicineIndex',compact('shelf','strength','supplier','generic','medicine_type'));

    }

    public function getAllMedicine()
    {
       // echo $current = Carbon::now()->format('Y-m-d');

        $medicine = Medicine::all();
        $output = '';
        if($medicine->count() > 0){
            $output .= '<table id="getAllmedicine" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Generic</th>
                    <th>Shelf</th>
                    <th>MRP</th>
                    <th>In Stock</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($medicine as $row) {
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'. $row->medicine_type->short_name.' '.$row->name.' '.$row->strength->strength. '</td>
                <td>'.$row->generic->name.'</td>
                <td>'.$row->shelf->name.'</td>
                <td>'.$row->mrp.'</td>
                <td>'.$row->in_stock.'</td>
                <td>
                  <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editMedicineModal"><i class="fa fa-edit"></i></a>
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
            'medicine_code' => 'M'.rand(1000,2000),
            'name' => $request->name,
            'shelf_id' => $request->shelf_id,
            'supplier_id' => $request->supplier_id,
            'batch_no' => $request->batch_no,
            'supplier_id' => $request->supplier_id,
            'generic_id' => $request->generic_id,
            'strength_id' => $request->strength_id,
            'medicine_type_id' => $request->medicine_type_id,
            'box_size' => $request->box_size,
            'box_price' => $request->box_price,
            'mrp' => $request->mrp,
            'trade_price' => $request->trade_price,
            'vat' => $request->vat,
            'p_discount' => $request->p_discount,
            'u_purchase' => $request->u_purchase,
            'details' => $request->details,
            'side_effect' => $request->side_effect,
            'short_stock' => $request->short_stock,
            'favourite' => $request->favourite,
            'is_discount' => $request->is_discount,
            'user_id' => $this->user_id,
        ];

        Medicine::create($data);
        return response()->json([
            'status' => 200
        ]);
    }

    public function edit(Request $request){

        $id = $request->id;
        $medicine = Medicine::find($id);
        return response()->json($medicine);
    }

    public function update(Request $request) {

        $med = Medicine::find($request->id);

        $data = [
            'name' => $request->name,
            'shelf_id' => $request->shelf_id,
            'supplier_id' => $request->supplier_id,
            'batch_no' => $request->batch_no,
            'supplier_id' => $request->supplier_id,
            'generic_id' => $request->generic_id,
            'strength_id' => $request->strength_id,
            'medicine_type_id' => $request->medicine_type_id,
            'box_size' => $request->box_size,
            'box_price' => $request->box_price,
            'mrp' => $request->mrp,
            'trade_price' => $request->trade_price,
            'vat' => $request->vat,
            'p_discount' => $request->p_discount,
            'u_purchase' => $request->u_purchase,
            'details' => $request->details,
            'side_effect' => $request->side_effect,
            'short_stock' => $request->short_stock,
            'favourite' => $request->favourite,
            'is_discount' => $request->is_discount,
            'user_id' => $this->user_id,
        ];

        $med->update($data);
        return response()->json([
            'status' => 200,
        ]);
    }
}
