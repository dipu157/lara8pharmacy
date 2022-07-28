<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\Generic;
use App\Models\Customer\Customers;
use App\Models\Customer\Customer_ledger;
use App\Models\Sales\Sales;
use App\Models\Sales\SalesDetails;
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
                              <td><input type='hidden' class='pid' value='$pid' name='pid[]'>
                              <input type='text' value='".$product->medicine_type->short_name.$product->name.'('.$product->strength->strength.')'."' readonly></td>
                              <td><input type='text' class='qty' value='$qty' name='qty[]' readonly>
                              <input type='hidden'  value='$mrp' name='mrp[]'></td>
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
                              <td><input type='hidden' class='pid' value='$pid' name='pid[]'>
                              <input type='text' value='".$product->medicine_type->short_name.$product->name.'('.$product->strength->strength.')'."' readonly></td>
                              <td><input type='text' class='qty' value='$qty' name='qty[]' readonly>
                              <input type='hidden'  value='$mrp' name='mrp[]'></td>
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

    public function sellMedicine(Request $request)
    {
       // dd($request->all());
        date_default_timezone_set("Asia/Dhaka");
        $entrydate  =   date("Y-m-d");

        $data = [
            'company_id' => $this->company_id,
            'sale_code' => 'S' . rand(1000, 2000),
            'customer_id' => $request->cid,
            'refd_doctor_id' => $request->supplier_id,
            'payment_type_id' => $request->supplier_id,
            'total_amount' => $request->grandtotal,
            'p_discount' => $request->gdiscount,
            'total_discount' => $request->total_discount,
            'net_amount' => $request->payable,
            'paid_amount' => $request->pay,
            'due_amount' => $request->due,
            'invoice_no' => rand(10000000,50000000),
            'sale_date' => $entrydate,
            'counter' => 1,
            'user_id' => $this->user_id,
        ];

        $customer_balance = Customer_ledger::query()
            ->where('company_id', 1)
            ->where('customer_id', $data['customer_id'])
            ->first();

        $total = $customer_balance->total_balance + $data['net_amount'];
        $due = $customer_balance->due + $request->due;
        $paids = $customer_balance->paid + $request->paid;

        $customer_balanceData = array();
        $customer_balanceData = array(
            'total_balance' => $total,
            'paid' => $paids,
            'due' => $due
        );
        $customerBalance = Customer_ledger::find($customer_balance->id);
         $customerBalanceUpdate =  $customerBalance->update($customer_balanceData);

        $saveSale = Sales::create($data);

        $lastSale = Sales::query()
                ->where('company_id', 1)
                ->latest('id')
                ->first();

        foreach ($request->qty as $row => $name) {
            if (!empty($request->qty[$row])) {
                $medicineId     =   $request->pid[$row];
                $qty            =   $request->qty[$row];
                $mrp            =   $request->mrp[$row];
                $discount       =   ($request->gdiscount * $mrp) / 100;
                $sale_rate      =   $mrp - $discount ;
                $total          =   $qty * $sale_rate;


                $salesDetails = [
                    'company_id'  => $this->company_id,
                    'sales_id'    =>  $lastSale->id,
                    'medicine_id' =>  $medicineId,
                    'qty'         =>  $qty,
                    'mrp'         =>  $mrp,
                    'discount'    =>  $discount,
                    'sale_rate'   =>  $sale_rate,
                    'total_price' =>  $total,
                    'user_id'     => $this->user_id,
                ];

               // dd($salesDetails);
                $PurchaseDetailsInsert = SalesDetails::create($salesDetails);
            }

            foreach($_POST['qty'] as $row=>$name){
                if(!empty($_POST['qty'][$row])){
                    $medicineId     =   $request->pid[$row];
                    $qty            =   $request->qty[$row];
                    $mrp            =   $request->mrp[$row];
                    $discount       =   ($request->gdiscount * $mrp) / 100;
                    $sale_rate      =   $mrp - $discount ;
                    $total          =   $qty * $sale_rate;

                    $medicine = Medicine::query()->where('company_id', 1)->where('id', $medicineId)->first();
                    $instock = $medicine->in_stock - $qty;
                    $soldqty = $medicine->sale_qty + $qty;

                    $medicineData = array(
                        'instock'  =>  $instock,
                        'sale_qty'  =>  $soldqty
                    );
                    $Medicine = Medicine::find($medicine->id);
                    $MedicineUpdate =  $Medicine->update($medicineData);

                }

                }

                echo " <div class='card-body pos_receipt'>
                            <div class='receipt_header'>
                            <div class='row'>
                            <div class='col-md-12'>
                            <p class='company-info' style='padding-bottom:5px;margin-top:-10px;'>
                                <span style='text-align:center; font-size:22px;'>Cash Memo</span>
                                <span style='text-align:center; font-size:18px;'>Ahmad Pharma</span>

                                <span style='text-align:center;font-size: 12px;font-weight: 600;color: #000;line-height:15px;'> </span>
                                <span style='text-align:center;font-size: 13px;font-weight: 600;color: #000;line-height:15px;margin-bottom:5px;padding-bottom:5px;border-bottom:1px dashed;'>Contact:</span>
                                <span style='float:left;font-size: 13px;font-weight: 600;color: #000;line-height:15px;'></span>
                                <span style='float:right;font-size: 13px;font-weight: 600;color: #000'></span>
                            </p>
                            </div>
                            <div class='col-md-12'>
                            <p class='customer-details;margin-bottom:5px;'>
                                <span style='float:left;right;font-size: 12px;font-weight: 600;color: #000'>ID: </span>
                                <span style='float:right;right;font-size: 12px;font-weight: 600;color: #000'>Invoice# </span><br>

                            </p>
                            </div>
                            </div>
                            </div>
                            <div class='receipt_body'>
                            <table style='font-size:8px'>
                            <thead>
                                <th style='right;font-size: 13px;font-weight: 600;color: #000'>SL</th>
                                <th style='right;font-size: 13px;font-weight: 600;color: #000'>Item/Desc</th>
                                <th style='right;font-size: 13px;font-weight: 600;color: #000'>Qty.</th>
                                <th style='text-align:right;right;font-size: 13px;font-weight: 600;color: #000'>Amount</th>
                            </thead>
                            <tbody>";
                                    $id = 0;
                            foreach($_POST['qty'] as $row=>$name):

                                    if(!empty($_POST['qty'][$row])){
                                    $id +=1;
                                    $medicineId     =   $request->pid[$row];
                                    $qty            =   $request->qty[$row];
                                    $mrp            =   $request->mrp[$row];
                                    $discount       =   ($request->gdiscount * $mrp) / 100;
                                    $sale_rate      =   $mrp - $discount ;
                                    $total          =   $qty * $sale_rate;

                                    $medicine = Medicine::query()->where('company_id', 1)->where('id', $medicineId)->first();

                                echo"<tr>
                                <td style='right;font-size: 12px;font-weight: 600;color: #000'>";echo $id; echo"</td>
                                <td class='medicine_name' style='right;font-size: 11px;font-weight: 600;color: #000'>
                                    $medicine->name
                                </td>
                                <td style='right;font-size: 12px;font-weight: 600;color: #000'>$qty * $medicine->mrp</td>
                                <td style='right;font-size: 12px;font-weight: 600;color: #000'>$total Tk.</td>
                                </tr>";
                                    }
                                    endforeach;
                            echo "</tbody></table>

                            <table style='font-size:8px'>
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan='7'></td>
                                <td style='right;font-size: 12px;font-weight: 600;color: #000'>Total:  Tk.</td>
                                </tr>

                                <tr>
                                <td></td>
                                <td></td>
                                <td colspan='7'></td>
                                <td style='right;font-size: 12px;font-weight: 600;color: #000'>Discount:  Tk.</td>
                                </tr>

                                <tr>
                                <td></td>
                                <td></td>
                                <td colspan='7'></td>
                                <td style='right;font-size: 12px;font-weight: 600;color: #000'>Payable:  Tk.</td>
                                </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan='7'></td>
                                <td style='right;font-size: 12px;font-weight: 600;color: #000'>Paid:  Tk.</td>
                                </tr>
                                <tr>
                                <td colspan='9'></td>
                                <td style='right;font-size: 12px;font-weight: 600;color: #000'>Net Due:  Tk.</td>
                                </tr>

                            </table>
                            </div>
                            <div style='padding-left:25px;border-top:1px solid gray; width:38%;color:#000;'>Signature</div>
                            <div class='receipt_footer'>
                            <span style='text-align:left' style='font-size: 15px; color: #000'>Thank you for Choosing us. Pls bring the receipt for change medicine.</span>
                            </div>
                        </div>";

        }
    }
}
