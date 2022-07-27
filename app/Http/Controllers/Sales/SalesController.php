<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\Generic;
use App\Models\Customer\Customers;
use App\Models\Customer\Customer_ledger;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SalesController extends Controller
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
        $medicine = Medicine::query()
                ->where('company_id', 1)
                ->where('status', true)->get();

        return view('Sales.salesIndex',compact('medicine'));
    }

    public function customerById(Request $request)
    {
        $id = $request->search;
        $customer = Customers::query()
                    ->where('company_id',1)
                    ->where('name', 'LIKE', "%{$id}%")
                    ->orWhere('phone', 'LIKE', "%{$id}%")
                    ->orWhere('customer_code', 'LIKE', "%{$id}%")
                    ->limit(10)
                    ->get();


        foreach ($customer as $row){
            $new_row['label']=htmlentities(stripslashes($row['name']));
            $new_row['value']=htmlentities(stripslashes($row['id']));
            $new_row['c_cont']=htmlentities(stripslashes($row['phone']));
            $new_row['ctype']=htmlentities(stripslashes($row['customer_type']));
            $row_set[] = $new_row; //build an array
            }
            echo json_encode($row_set); //format the array into json data

    }

    public function customerBalancebyID(Request $request)
    {
        $id = $request->id;

        $customer = Customers::query()
                    ->where('company_id',1)
                    ->where('id', $id)
                    ->first();

        $customer_ledger = Customer_ledger::query()
                            ->where('company_id',1)
                            ->where('customer_id',$id)
                            ->first();
       // dd($customer_ledger);

        echo"<div class='dues'>";
            if($customer_ledger->due > 0){
                echo"<h4 class='previous-due-header'><span class='previous-dues'>Previous Dues= </span> $customer_ledger->due TK</h4>";
            } ;
    }

    public function specificMedicine(Request $request)
    {
        $id = $request->id ;
        $data = [];
        $superMedicine = Medicine::query()
                        ->where('company_id',1)
                        ->where('id',$id)
                        ->with('medicine_type')
                        ->with('strength')
                        ->with('generic')
                        ->first();

        $data['mvalue'] = $superMedicine;

        echo json_encode($data);
    }

    public function medicineTorow(Request $request)
    {
        $cid = $request->customer_id;
        $pid = $request->proid;
        $qty = $request->qty;
        $mrp = $request->mrp;

        if(empty($pid)){
            die();
        }

        if(empty($cid)){
        $ctype= 'walkin';
        } else {
            $customer = Customers::query()->where('company_id',1)->where('id', $cid)->first();
            $ctype= $customer->customer_type;
        }

        if($ctype=='regular'){
            $product = Medicine::query()
                                ->where('company_id',1)
                                ->where('id',$pid)
                                ->with('medicine_type')
                                ->with('strength')
                                ->with('generic')
                                ->first();

        date_default_timezone_set("Asia/Dhaka");
        $today = strtotime(date('Y/m/d'));
        $expire = strtotime($product->expire_date);
        $date = str_replace('/', '-',$product->expire_date);
        $expired = strtotime($date);
        $a = date('Y/m/d',$expired);
        $b = strtotime($a);
         if($today > $b){
                    echo '<script language="javascript">';
                    echo 'alert(Expired)';  //not showing an alert box.
                    echo '</script>';
                    die();
         }
        if($qty > $product->in_stock){
                echo '<script language="javascript">';
                echo 'alert(Short Quantity)';  //not showing an alert box.
                echo '</script>';
            die();
        }
        if(empty($qty)){
                echo '<script language="javascript">';
                echo 'alert(Pls Insert Quantity)';  //not showing an alert box.
                echo '</script>';
            die();
        }
    $product = Medicine::query()
                        ->where('company_id',1)
                        ->where('id',$pid)
                        ->with('medicine_type')
                        ->with('strength')
                        ->with('generic')
                        ->first();
    $date = date('Y-m',strtotime('-1 month'));
    $balance = Customer_ledger::query()
                                ->where('company_id',1)
                                ->where('customer_id',$cid)
                                ->first();
    // $to= 0 ;
    // foreach($balance as $value){
    //    $to += $value->total_balance;
    // }
    // $totalsales = $to;
    // $target = $customer->target_amount;
        if($product->is_discount == 1){
        // if($totalsales > $target){
        //     $totall = ($mrp * $qty);
        //     $percent = ($customer->regular_discount + $customer->target_discount)/100;
        //     $discount = $totall*$percent;
        //     $total = $totall - $discount;
        // }
        // if{
            $totall = ($mrp * $qty);
            $percent = $customer->regular_discount/100;
            $discount = $totall*$percent;
            $total = $totall - $discount;
        // }
        } else if($product->discount ==0){
            $totall = ($mrp * $qty);
            $discount = 0;
            $total = ($mrp * $qty) - $discount;
        }
            echo "          <tr class='premove'>
                              <td><input type='hidden' class='pid' value='$pid' name='pid[]'><input type='text' value='".$product->medicine_type->short_name.$product->name.'('.$product->strength->strength.')'."' readonly></td>
                            <td><input type='text' class='qty' value='$qty' name='qty[]' readonly><input type='hidden' class='mrp' value='$mrp' name='mrp[]'></td>
                              <td><input type='hidden' class='total' value='$total' name='total[]' readonly>
                              <input type='hidden' class='discount' value='$discount' name='discount[]'>
                              <input type='text' class='totall' value='$totall' name='totall[]' readonly></td>
                              <td class='text-nowrap'>
                                <a href='' id='tremove' data-total='$total' data-totall='$totall' data-discount='$discount' data-original-title='Close'>
                                  <i class='fa fa-close text-danger'>Delete</i>
                                </a>
                              </td>
                            </tr>";
        } elseif($ctype=='walkin') {
            $product = Medicine::query()
                            ->where('company_id',1)
                            ->where('id',$pid)
                            ->with('medicine_type')
                            ->with('strength')
                            ->with('generic')
                            ->first();
        date_default_timezone_set("Asia/Dhaka");
        $today = strtotime(date('Y/m/d'));
        $expire = strtotime($product->expire_date);
        $date = str_replace('/', '-',$product->expire_date);
        $expired = strtotime($date);
        $a = date('Y/m/d',$expired);
        $b = strtotime($a);
         if($today > $b){
                    echo '<script language="javascript">';
                    echo 'alert(Expired)';  //not showing an alert box.
                    echo '</script>';
                    die();
         }
        if($qty > $product->in_stock){
                echo '<script type="javascript/text">';
                echo 'alert(Invalid Quantity)';  //not showing an alert box.
                echo '</script>';
            die();
        }
        if(empty($qty)){
                echo '<script type="javascript/text">';
                echo 'alert(Invalid Quantity)';  //not showing an alert box.
                echo '</script>';
            die();
        }
        $product = Medicine::query()
                            ->where('company_id',1)
                            ->where('id',$pid)
                            ->with('medicine_type')
                            ->with('strength')
                            ->with('generic')
                            ->first();
        $totall = ($mrp * $qty);
        $total = ($mrp * $qty);
            echo "          <tr class='premove'>
                              <td><input type='hidden' class='pid' value='$pid' name='pid[]'><input type='text' value='".$product->medicine_type->short_name.$product->name.'('.$product->strength->strength.')'."' readonly></td>
                            <td><input type='text' class='qty' value='$qty' name='qty[]' readonly><input type='hidden' class='mrp' value='$mrp' name='mrp[]'></td>
                              <td><input type='hidden' class='total' value='$total' name='total[]' readonly>
                              <input type='hidden' class='discount' value='0' name='discount[]'>
                              <input type='text' class='totall' value='$totall' name='totall[]' readonly></td>
                              <td class='text-nowrap'>
                                <a href='' id='tremove' data-total='$total' data-totall='$totall' data-discount='0' data-original-title='Close'>
                                  <i class='fa fa-close text-danger'>Delete</i>
                                </a>
                              </td>
                            </tr>";
        }
    }

    public function medicineAuTorow(Request $request)
    {
        $id = $request->search;
        $medicine = Medicine::query()
                    ->where('company_id',1)
                    ->where('name', 'LIKE', "%{$id}%")
                    ->orWhere('medicine_code', 'LIKE', "%{$id}%")
                    ->orWhere('batch_no', 'LIKE', "%{$id}%")
                    ->with('medicine_type')
                    ->with('generic')
                    ->with('strength')
                    ->limit(10)
                    ->get();

        date_default_timezone_set("Asia/Dhaka");
        $today = strtotime(date('Y/m/d'));

        foreach ($medicine as $row){
            $new_row['label']=htmlentities(stripslashes($row['name']));
            $new_row['value']=htmlentities(stripslashes($row['id']));
            $new_row['genval']=htmlentities(stripslashes($row['generic_id']));
            $new_row['mrp']=htmlentities(stripslashes($row['mrp']));
            $new_row['stock']=htmlentities(stripslashes($row['in_stock']));
            $date = str_replace('/', '-', $row['expire_date']);
            $expire = strtotime($date);
            $a = date('Y/m/d',$expire);
            $b = strtotime($a);
            if($today >= $b){
                $new_row['expiry']=htmlentities(stripslashes($row['expire_date']));
            } else {
                 $new_row['expiry']=htmlentities(stripslashes(0));
            }
            $row_set[] = $new_row; //build an array
            }
            echo json_encode($row_set); //format the array into json data
    }

    public function similarGenericMed(Request $request)
    {
        $pid = $request->id;

        $medicine = Medicine::query()
                    ->where('company_id',1)
                    ->where('id', $pid)
                    ->with('medicine_type')
                    ->with('generic')
                    ->with('strength')
                    ->first();

        $gen_id = $medicine->generic_id ;

        $medicine = Medicine::query()->where('company_id',1)->where('generic_id',$gen_id)->get();

        foreach($medicine as $value){
            echo "<option value='$value->id'>$value->name</option>";
        }
    }

    public function genericMed(Request $request)
    {
        $id = $request->id;
    }
}
