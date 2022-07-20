<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine\Medicine;
use App\Models\Purchase\Purchase;
use App\Models\Supplier\Supplier;
use App\Models\Common\Bank;
use App\Models\Common\Payment_Type;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
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
        $bank = Bank::query()->where('company_id', 1)->where('status', true)->get();
        $payment_type = Payment_Type::query()->where('company_id', 1)->where('status', true)->get();
        $supplier = Supplier::query()
            ->where('company_id', 1)
            ->where('status', true)
            ->pluck('name', 'id');

        return view('Purchase.createPurchase', compact('bank', 'supplier', 'payment_type'));
    }

    public function medicinebysupplierId(Request $request)
    {

        $id = $request->id;

        $medicine = Medicine::query()
            ->where('company_id', 1)
            ->where('supplier_id', $id)
            ->get();

        foreach ($medicine as $value) {
            echo "<tr>
                        <td>
                        <input type='hidden' class='form-control medicine' id='medicineId' name='id[]' readonly value=" . $value->id . ">
                        <input type='text' class='form-control' name='mname[]' readonly value='" . $value->medicine_type->short_name . " " . $value->name . " " . $value->strength->strength . "'>
                        </td>
                        <td><input type='date' class='form-control datepicker' name='expire_date[]' value='' id='datepicker'></td>
                        <td> <input type='text' class='form-control' name='in_stock[]' placeholder='0.00' readonly value='" . $value->in_stock . "'> </td>
                        <td><input type='text' class='form-control qty' name='qty[]' placeholder='0.00' value=''></td>
                        <td><input type='text' class='form-control tradeprice' name='trade_price[]' placeholder='0.00' value='" . sprintf("%.2f", $value->trade_price / $value->box_size) . "'></td>
                        <td><input type='text' class='form-control vat' name='vat[]' placeholder='0.00' value='" . sprintf("%.2f", $value->vat / $value->box_size) . "'></td>
                        <td><input type='text' class='form-control mrp' name='mrp[]' placeholder='0.00' value='" . $value->mrp . "'></td>
                        <td><input type='text' class='form-control discount' name='p_discount[]' placeholder='0.00' value='" . sprintf("%.2f", $value->p_discount / $value->box_size) . "'></td>

                        <td><input type='text' class='form-control total' name='net_amount[]' placeholder='0.00' value='0'></td>
                        <input type='hidden' class='form-control tamount' name='total_amount[]' placeholder='0.00' value='0'>
                        <input type='hidden' class='form-control tvat' name='total_vat[]' placeholder='0.00' value='0'>
                        <input type='hidden' class='form-control tdiscount' name='total_discount[]' placeholder='0.00' value='0'></td>
                    </tr>";
        }
    }

    public function purchaseReview(Request $request)
    {

        $supplier_id   =   $request->supplier_id;
        $invoice    =   $request->invoice_no;
        $entrydate  =   $request->purchase_date;
        $details    =   $request->details;
        //$mtype    =   $request->mtype;
        $paydate    =   $request->issue_date;
        $receiver_name    =   $request->receiver_name;
        $receiver_contact    =   $request->receiver_contact;
        $tdiscount  =   round($request->total_discount);
        $tamount =  round($request->total_amount);
        $netPayable =  round($request->net_payable);
        $tVat =  round($request->total_vat);
        $paid =  round($request->paid_amount);
        $due =  round($request->due);
        $payment_type_id = $request->payment_type;

        // dd($payment_type_id);

        $payment_type = Payment_Type::query()->where('company_id', 1)->where('status', true)->get();


        $invoiceid    = Purchase::query()->where('company_id', 1)->where('invoice_no', $invoice)->pluck('invoice_no');
        if ($invoice == $invoiceid) {
            echo "This Invoice is Already exist";
            die();
        }

        $supplier = Supplier::query()
            ->where('company_id', 1)
            ->where('status', true)
            ->where('id', $supplier_id)
            ->get();

        //   dd($supplier);

        if ($supplier && $netPayable > 0) {

            echo "
            <div class='row'>
            <div class='col-md-3'>
            <div class='form-group' style='margin-bottom: 15px'>
                <label class='control-label'>Supplier</label>
                <input type='hidden' class='form-control supplier' id='supplier' name='id' placeholder='Supplier' readonly value='" . $supplier[0]->id . "'>
                <input type='text' class='form-control' style='border: 1px solid rgba(222, 218, 218, 0.15);' placeholder='Ounce' name='' readonly value='" . $supplier[0]->name . "'>
            </div>
            </div>
            <div class='col-md-3'>
            <div class='form-group' style='margin-bottom: 15px'>
                <label class='control-label'>Invoice No</label>
                <input type='text' style='border: 1px solid rgba(222, 218, 218, 0.15);' id='firstName' name='invoice' class='form-control' placeholder='Invoice No' value='$invoice' required='1'>
                 </div>
                 </div>
                <div class='col-md-2'>
                    <div class='form-group' style='margin-bottom: 15px'>
                    <label class='control-label'>Date</label>
                     <input type='date' style='border: 1px solid rgba(222, 218, 218, 0.15);' id='datepicker' class='form-control datepicker' placeholder='' name='entrydate' required value='$entrydate'>
                                                </div>
                                            </div>
                                            <div class='col-md-4'>
                    <div class='form-group' style='margin-bottom: 15px'>
                    <label class='control-label'>Note</label>
            <input type='text' style='border: 1px solid rgba(222, 218, 218, 0.15);' name='details' class='form-control' placeholder='Details' value='$details'>
                                                </div>
                                            </div>
                                        </div>
                <table class='table table-bordered m-t-10 pos_table purchase'>
                    <thead>
                        <tr>
                            <th style='width: 144px;'>Medicine Name </th>
                            <th>Expiry Date</th>
                            <th>Quantity</th>
                            <th>Trade Price</th>
                            <th>VAT</th>
                            <th>M.R.P.</th>
                            <th>Discount</th>
                            <th>Net Payable</th>
                        </tr>
                    </thead>
                    <tbody id='addPurchaseItem'>";
            foreach ($request->qty as $row => $name) {
                if (!empty($request->qty[$row])) {
                    $medicineId   =   $request->id[$row];
                    $mname      =   $request->mname[$row];
                    $qty        =   $request->qty[$row];
                    $instock    =   $request->in_stock[$row];
                    $tradeprice =   $request->trade_price[$row];
                    $vat        =   $request->vat[$row];
                    $mrp        =   $request->mrp[$row];
                    $discount   =   $request->p_discount[$row];
                    $net_amount      =   $request->net_amount[$row];
                    $expire     =   $request->expire_date[$row];
                    $medicineval    = Medicine::query()->where('company_id', 1)->where('id', $medicineId)->get();
                    echo "<tr>
                                    <td><input type='hidden' class='form-control medicine' id='medicine' name='id[]' placeholder='Ounce' readonly value='$medicineId'>
                                    <input type='text' class='form-control' placeholder='Ounce' readonly value='$mname'>
                                    </td>
                                    <td><input type='date' class='form-control datepicker' name='expire_date[]' value='$expire' id='datepicker' required>
                                    <input type='hidden' class='form-control' name='in_stock[]' placeholder='0.00' readonly value='$instock' >
                                    </td>
                                    <td><input type='text' class='form-control qtyval' name='qty[]' placeholder='0.00' value='$qty' autocomplete='off' required></td>
                                    <td><input type='text' class='form-control tardepriceval' name='tradeprice[]' placeholder='0.00' value='$tradeprice'></td>
                                    <td><input type='text' class='form-control vatval' name='vat[]' placeholder='0.00' value='$vat'></td>
                                    <td><input type='text' class='form-control mrpval' name='mrp[]' placeholder='0.00' value='$mrp'></td>
                                    <td><input type='text' class='form-control wholesalerval' name='p_discount[]' placeholder='0.00' value='$discount'></td>
                                    <td><input type='text' class='form-control totalval' name='net_payable[]' placeholder='0.00' value='$net_amount'></td>
                            </tr>";
                }
            }

            echo "</tbody>
                        <tfoot>
                            <tr>
                                    <td class='text-right font-weight-bold' colspan=7>Total Amount:</td>
                                    <td><input type='text' class='form-control netAmnt' name='total_amount' placeholder='0.00' readonly value='$tamount'></td>
                                    <td></td>
                            </tr>

                            <tr>
                                    <td class='text-right font-weight-bold' colspan=7>Total Vat:</td>
                                    <td><input type='text' class='form-control netAmnt' name='total_vat' placeholder='0.00' readonly value='$tVat'></td>
                                    <td></td>
                            </tr>

                            <tr>

                                    <td class='text-right font-weight-bold' colspan=7>Total Discount:</td>
                                    <td><input type='text' class='form-control netDiscount' name='netDiscount' placeholder='0.00' readonly value='$tdiscount'></td>
                                    <td></td>
                            </tr>

                            <tr>

                                    <td class='text-right font-weight-bold' colspan=7>Net Payable:</td>
                                    <td><input type='text' class='form-control gtotalval' name='grandamount' placeholder='0.00' readonly value='$netPayable'></td>
                                    <td></td>
                            </tr>
                            <tr>
                                    <td class='text-right font-weight-bold' colspan=7>Total Paid:</td>
                                    <td><input type='text' class='form-control rpaid' name='paid' placeholder='0.00' value='$paid'></td>

                            </tr>
                            <tr>
                                    <td class='text-right font-weight-bold' colspan=7>Total Due:</td>
                                    <td><input type='text' class='form-control rdue' name='due' placeholder='0.00' readonly='' value='$due'></td>

                            </tr>


                            <tr id='payform'>";


                            echo "<td><select class='select2 form-control' name='payment_type_id' style='width:100%' >";
                            foreach ($payment_type as $value) {
                                echo "<option value='$value->id'>$value->payment_method</option>";
                            }
                            echo "</select></td>
                            <td><input type='text' name='receiver_name' id='rname' class='form-control' placeholder='Receiver Name' value='$receiver_name'></td>
                                                <td><input type='text' name='receiver_contact' id='rcontact' class='form-control' placeholder='Receiver Contact' value='$receiver_contact'></td>
                                                <td><input type='date' name='issue_date' class='form-control datepicker' placeholder='Pay Date' value='$paydate'></td>
                                        </tr>
                                    </tfoot>
                        </table>";
            } else {
                echo '<h2>Nothing To Display!!</h2>';
            }
        }
}
