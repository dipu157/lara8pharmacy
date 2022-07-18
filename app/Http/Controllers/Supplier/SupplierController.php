<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier\Supplier;
use App\Models\Supplier\SupplierLedger;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
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
        return view('Supplier.Supplier.supplierIndex');
    }

    public function getAllSupplier()
    {
       // echo $current = Carbon::now()->format('Y-m-d');

        $supplier = Supplier::all();
        $output = '';
        if($supplier->count() > 0){
            $output .= '<table id="getAllsupplier" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($supplier as $row) {
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->supplier_code.'</td>
                <td>'. $row->name. '</td>
                <td>'.$row->phone.'</td>
                <td>
                  <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editSupplierModal"><i class="fa fa-edit"></i></a>
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
        $data = [
            'company_id' => $this->company_id,
            'supplier_code' => 'S'.rand(1000,1999),
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'note' => $request->note,
            'user_id' => $this->user_id,
        ];

       // dd($data);

       Supplier::create($data);

        $supplier = Supplier::query()
                        ->where('company_id',1)
                        ->latest('id')->first();
        //dd($income);

        $data1 = [
            'company_id' => $this->company_id,
            'supplier_id' => $supplier->id,
            'total_amount' => 0.00,
            'paid' => 0.00,
            'due' => 0.00,
            'user_id' => $this->user_id,
        ];

        SupplierLedger::create($data1);


        return response()->json([
            'status' => 200
        ]);
    }

    public function edit(Request $request){

        $id = $request->id;
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    public function update(Request $request) {

        $supplier = Supplier::find($request->id);
        $data = [
            'company_id' => $this->company_id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'note' => $request->note,
            'user_id' => $this->user_id,
        ];

        $supplier->update($data);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function supplierLedgerIndex()
    {
        return view('Supplier.SupplierLedger.supplierLedgerIndex');
    }

    public function fetchAll()
    {
       // echo $current = Carbon::now()->format('Y-m-d');

        $supp_ledg = SupplierLedger::all();

       // dd($supp_ledg);
        $output = '';
        if($supp_ledg->count() > 0){
            $output .= '<table id="getAllSupplierLedger" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Supplier Name</th>
                    <th>Total Balance</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($supp_ledg as $sl) {
                $output .= '<tr>
                <td>'.$sl->id.'</td>
                <td>'. $sl->supplier->name. '</td>
                <td>'.$sl->total_amount.'</td>
                <td>'.$sl->paid.'</td>
                <td>'.$sl->due.'</td>
                <td>
                  <a href="#" id="' . $sl->id . '" class="text-success mx-1 printIcon"><i class="fa fa-print"></i></a>
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
