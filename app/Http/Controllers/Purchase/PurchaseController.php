<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine\Medicine;
use App\Models\Purchase\Purchase;
use App\Models\Purchase\PurchaseDetails;
use App\Models\Purchase\PurchaseReturn;
use App\Models\Purchase\PurchaseReturnDetails;
use App\Models\Supplier\Supplier;
use App\Models\Common\Bank;
use App\Models\Common\Payment_Type;
use App\Models\Supplier\SupplierAccount;
use App\Models\Supplier\SupplierLedger;
use App\Models\Supplier\SupplierPayment;
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
                        <td><input type='date' class='form-control datepicker' name='expire_date[]' value='" . $value->expire_date . "' id='datepicker'></td>
                        <td> <input type='text' class='form-control' name='in_stock[]' placeholder='0.00' readonly value='" . $value->in_stock . "'> </td>
                        <td><input type='text' class='form-control qty' name='qty[]' placeholder='0.00' value=''></td>
                        <td><input type='text' class='form-control tradeprice' name='trade_price[]' placeholder='0.00' value='" . sprintf("%.2f", $value->trade_price / $value->box_size) . "'></td>
                        <td><input type='text' class='form-control vat' name='vat[]' placeholder='0.00' value='" . sprintf("%.2f", $value->vat / $value->box_size) . "'></td>
                        <td><input type='text' class='form-control mrp' name='mrp[]' placeholder='0.00' value='" . $value->mrp . "'></td>
                        <td><input type='text' class='form-control discount' name='p_discount[]' placeholder='0.00' value='" . sprintf("%.2f", $value->p_discount / $value->box_size) . "'></td>
                        <td><input type='text' class='form-control total' name='net_amount[]' placeholder='0.00' value='0'></td>

                        <input type='hidden' class='form-control tamount' name='net_tp[]' placeholder='0.00' value='0'>
                        <input type='hidden' class='form-control tvat' name='net_vat[]' placeholder='0.00' value='0'>
                        <input type='hidden' class='form-control tdiscount' name='net_discount[]' placeholder='0.00' value='0'>
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
                <input type='hidden' class='form-control supplier' id='supplier' name='supplier_id' placeholder='Supplier' readonly value='" . $supplier[0]->id . "'>
                <input type='text' class='form-control' style='border: 1px solid rgba(222, 218, 218, 0.15);' placeholder='Ounce' name='' readonly value='" . $supplier[0]->name . "'>
            </div>
            </div>
            <div class='col-md-3'>
            <div class='form-group' style='margin-bottom: 15px'>
                <label class='control-label'>Invoice No</label>
                <input type='text' style='border: 1px solid rgba(222, 218, 218, 0.15);' id='invoice' name='invoice_no' class='form-control' placeholder='Invoice No' value='$invoice' required='1'>
                 </div>
                 </div>
                <div class='col-md-2'>
                    <div class='form-group' style='margin-bottom: 15px'>
                    <label class='control-label'>Date</label>
                     <input type='date' style='border: 1px solid rgba(222, 218, 218, 0.15);' id='datepicker' class='form-control datepicker' placeholder='' name='purchase_date' required value='$entrydate'>
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
                    $total_amount      =   $request->net_tp[$row];
                    $total_vat      =   $request->net_vat[$row];
                    $total_discount      =   $request->net_discount[$row];
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
                                    <td><input type='text' class='form-control tardepriceval' name='trade_price[]' placeholder='0.00' value='$tradeprice'></td>
                                    <td><input type='text' class='form-control vatval' name='vat[]' placeholder='0.00' value='$vat'></td>
                                    <td><input type='text' class='form-control mrpval' name='mrp[]' placeholder='0.00' value='$mrp'></td>
                                    <td><input type='text' class='form-control p_discountval' name='p_discount[]' placeholder='0.00' value='$discount'></td>
                                    <td><input type='text' class='form-control totalval' name='net_amount[]' placeholder='0.00' value='$net_amount'></td>

                                    <input type='hidden' class='form-control tamountval' name='net_tp[]' placeholder='0.00' value='$total_amount'>
                                    <input type='hidden' class='form-control tvatval' name='net_vat[]' placeholder='0.00' value='$total_vat'>
                                    <input type='hidden' class='form-control tdiscountval' name='net_discount[]' placeholder='0.00' value='$total_discount'>
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
                                    <td><input type='text' class='form-control netVat' name='total_vat' placeholder='0.00' readonly value='$tVat'></td>
                                    <td></td>
                            </tr>

                            <tr>
                                    <td class='text-right font-weight-bold' colspan=7>Total Discount:</td>
                                    <td><input type='text' class='form-control netDiscount' name='total_discount' placeholder='0.00' readonly value='$tdiscount'></td>
                                    <td></td>
                            </tr>

                            <tr>

                                    <td class='text-right font-weight-bold' colspan=7>Net Payable:</td>
                                    <td><input type='text' class='form-control gtotalval' name='net_payable' placeholder='0.00' readonly value='$netPayable'></td>
                                    <td></td>
                            </tr>
                            <tr>
                                    <td class='text-right font-weight-bold' colspan=7>Total Paid:</td>
                                    <td><input type='text' class='form-control paidval' name='paid' placeholder='0.00' value='$paid'></td>

                            </tr>
                            <tr>
                                    <td class='text-right font-weight-bold' colspan=7>Total Due:</td>
                                    <td><input type='text' class='form-control dueval' name='due' placeholder='0.00' readonly='' value='$due'></td>

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

    public function purchaseSave(Request $request)
    {
        // dd($request->all());

        $data = [
            'company_id' => $this->company_id,
            'purchase_code' => 'P' . rand(1000, 2000),
            'supplier_id' => $request->supplier_id,
            'invoice_no' => $request->invoice_no,
            'purchase_date' => $request->purchase_date,
            'details' => $request->details,
            'total_amount' => $request->total_amount,
            'total_vat' => $request->total_vat,
            'total_discount' => $request->total_discount,
            'net_payable' => $request->net_payable,
            'user_id' => $this->user_id,
        ];

        //dd($data['invoice_no']);

        $invoiceid    = Purchase::query()->where('company_id', 1)->where('invoice_no', $data['invoice_no'])->pluck('invoice_no');
        if ($data['invoice_no'] == $invoiceid) {
            echo "This Invoice is Already exist";
            die();
        }

        $supplier_balance = SupplierLedger::query()
            ->where('company_id', 1)
            ->where('supplier_id', $data['supplier_id'])
            ->first();

        $supplier_info = Supplier::query()
            ->where('company_id', 1)
            ->where('id', $data['supplier_id'])
            ->first();
        // dd($supplier_balance);

        $total = $supplier_balance->total_amount + $data['net_payable'];
        $due = $supplier_balance->due + $request->due;
        $paids = $supplier_balance->paid + $request->paid;

        $supplier_balanceData = array();
        $supplier_balanceData = array(
            'total_amount' => $total,
            'paid' => $paids,
            'due' => $due
        );
        $supplierBalance = SupplierLedger::find($supplier_balance->id);
        $supplierBalanceUpdate =  $supplierBalance->update($supplier_balanceData);

        if ($supplierBalanceUpdate) {
            $purchaseInsert = Purchase::create($data);

            $purchaseLast = Purchase::query()
                ->where('company_id', 1)
                ->latest('id')
                ->first();

            $supplierPaymentData = [
                'company_id' => $this->company_id,
                'purchase_id' => $purchaseLast->id,
                'supplier_id' => $purchaseLast->supplier_id,
                'payment_type_id' => $request->payment_type_id,
                'receiver_name' => $request->receiver_name,
                'receiver_contact' => $request->receiver_contact,
                'paid_amount' => $request->paid,
                'user_id' => $this->user_id,
            ];

            $SupplierPaymentInsert = SupplierPayment::create($supplierPaymentData);

            $supplierAccountData = [
                'company_id' => $this->company_id,
                'purchase_id' => $purchaseLast->id,
                'supplier_id' => $purchaseLast->supplier_id,
                'total_amount' => $request->net_payable,
                'paid_amount' => $request->paid,
                'due' => $request->due,
                'user_id' => $this->user_id,
            ];

            $SupplierAccountInsert = SupplierAccount::create($supplierAccountData);

            foreach ($request->qty as $row => $name) {
                if (!empty($request->qty[$row])) {
                    $medicineId   =   $request->id[$row];
                    $qty        =   $request->qty[$row];
                    $tradeprice =   $request->trade_price[$row];
                    $vat        =   $request->vat[$row];
                    $discount   =   $request->p_discount[$row];
                    $total      =   $request->net_amount[$row];
                    $expire     =   $request->expire_date[$row];

                    $PurchaseDetails = [
                        'company_id' => $this->company_id,
                        'purchase_id'   =>  $purchaseLast->id,
                        'medicine_id'      =>  $medicineId,
                        'supplier_id' => $purchaseLast->supplier_id,
                        'qty'      =>  $qty,
                        'supplier_price' => $tradeprice + $vat - $discount,
                        'net_vat'   =>  $vat,
                        'net_discount'   =>  $discount,
                        'net_tp'   =>  $tradeprice,
                        'expire_date'   =>  $expire,
                        'net_amount'  =>  $total,
                        'user_id' => $this->user_id,
                    ];
                    $PurchaseDetailsInsert = PurchaseDetails::create($PurchaseDetails);
                }
            }

            foreach ($request->qty as $row => $name) {
                if (!empty($request->qty[$row])) {
                    $medicineId   =   $request->id[$row];
                    $qty        =   $request->qty[$row];
                    $tradeprice =   $request->trade_price[$row];
                    $mrp         =   $request->mrp[$row];
                    $vat        =   $request->vat[$row];
                    $discount   =   $request->p_discount[$row];
                    $expire     =   $request->expire_date[$row];

                    $medicine = Medicine::query()->where('company_id', 1)->where('id', $medicineId)->first();
                    $instock = $medicine->in_stock + $qty;
                    $boxSize = $medicine->box_size;

                    $medicineData = [
                        'in_stock'       =>  $instock,
                        'expire_date'   => $expire,
                        'mrp'           =>  $mrp,
                        'trade_price'   =>  $tradeprice * $boxSize,
                        'vat'           =>  $vat * $boxSize,
                        'p_discount'    =>  $discount * $boxSize
                    ];
                    $Medicine = Medicine::find($medicine->id);
                    $MedicineUpdate =  $Medicine->update($medicineData);
                }
            }
        }
    }

    public function purchaseHistoryIndex()
    {

        return view('Purchase.purchaseHistory');
    }

    public function getallPurchase()
    {
        // echo $current = Carbon::now()->format('Y-m-d');

        $purchase = Purchase::all();
        $output = '';
        if ($purchase->count() > 0) {
            $output .= '<table id="getAllPurchase" class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Supplier Name</th>
                    <th>Invoice No</th>
                    <th>Purchase Date</th>
                    <th>Total</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($purchase as $row) {
                $output .= '<tr>
                <td>' . $row->id . '</td>
                <td>' . $row->supplier->name . '</td>
                <td><a href="' . route('invoiceDetails', ['id' => $row->id]) . '">' . $row->invoice_no . '</a></td>
                <td>' . $row->purchase_date . '</td>
                <td>' . $row->net_payable . '</td>
                <td>
                  <a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#"><i class="fa fa-print"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No Record Found in Database</h1>';
        }
    }

    public function invoiceDetails(Request $request)
    {

        $id = $request->id;

        $purchaseDetails = PurchaseDetails::query()->where('company_id', 1)->where('purchase_id', $id)->get();

        return view('Purchase.medicineByPurchaseId', compact('purchaseDetails'));
    }

    public function purchaseReturn()
    {
        return view('Return.Purchase.purchaseReturn');
    }

    public function invoiceSearch(Request $request)
    {
        $purchase = Purchase::query()
            ->where('company_id', 1)
            ->where('invoice_no', $request->invoice_no)
            ->first();

        $purchaseDetails = PurchaseDetails::query()->where('company_id', 1)->where('purchase_id', $purchase->id)->get();

        // dd($purchaseDetails);

        echo "
                    <div class='row'>
                        <div class='col-md-3'>
                            <div class='form-group'>
                            <label class='control-label'>Supplier Name</label>
                            <input type='text' name='supplier' class='form-control' placeholder='' value='" . $purchaseDetails[0]->supplier->name . "' autocomplete='off' readonly>
                            <input type='hidden' name='sid' class='form-control' placeholder='' value='" . $purchaseDetails[0]->supplier->id . "' autocomplete='off'>
                            <input type='hidden' name='purid' class='form-control' placeholder='' value='" . $purchaseDetails[0]->purchase_id . "' autocomplete='off'>
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class='form-group'>
                                <label class='control-label'>Invoice No</label>
                                <input type='number' id='firstName' name='invoice' class='form-control' placeholder='Invoice No' value='" . $purchaseDetails[0]->purchase->invoice_no . "' autocomplete='off' readonly>
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class='form-group'>
                                <label class='control-label'>Return Date</label>
                                <input type='date' id='datepicker' class='form-control datepicker' placeholder='' name='returndate' autocomplete='off'>
                            </div>
                        </div>
                        <div class='col-md-5'>
                            <div class='form-group'>
                                <label class='control-label'>Note</label>
                                <textarea type='text' name='details' class='form-control' placeholder='Details' rows='1' cols='8' readonly>" . $purchaseDetails[0]->purchase->details . "</textarea>
                            </div>
                        </div>
                    </div>
                <tfood>
                        </tfood><table class='table table-bordered m-t-5 purchase'>

                    <thead>
                        <tr>
                            <th>Medicine  </th>
                            <th>Purchase Qty</th>
                            <th>Return Qty</th>
                            <th>Supplier Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id='addPurchaseItem'>";
        foreach ($purchaseDetails as $value) :
            echo "<tr>
                    <td><input type='text' name='medicine' class='form-control' placeholder='Medicine' value='" . $value->medicine->name . "' autocomplete='off' readonly>
                    <input type='hidden' name='mid[]' class='form-control' placeholder='Medicine' value='" . $value->medicine->id . "' autocomplete='off'>
                    </td>
                    <td><input type='number' class='form-control pqty' name='pqty[]' placeholder='' readonly value='$value->qty'></td>
                    <td><input type='number' class='form-control rqty' name='rqty[]' placeholder='0.00' min='0' max='$value->qty' value='' ></td>
                    <td><input type='text' class='form-control td' name='td[]' placeholder='' value='$value->supplier_price' readonly></td>
                    <td><input type='text' class='form-control total' name='total[]' placeholder='' value='0'></td>
                 </tr>";
        endforeach;
        echo "</tbody>
                <tbody><tr>
                    <td class='text-right'> <input type='submit' class='btn btn-primary btn-block PurchaseReturnSubmit' value='Return'> </td>
                    <td class='text-right font-weight-bold' colspan=3>Grand Total:</td>

                    <td><input type='text' class='form-control gtotal' name='grandamount' placeholder='' readonly value=''></td>
                    </tr>

                </tbody>

                </table>";
    }

    public function purchaseReturnSave(Request $request)
    {
        $purchase_id = $request->purid;
        $supplier_id = $request->sid;

        $supplier_acc = SupplierAccount::query()->where('company_id',1)
                            ->where('purchase_id',$purchase_id)
                            ->first();
        $supplier_account = SupplierAccount::find($supplier_acc->id);

        if($request->grandamount >= $supplier_account->due){
            $supplierAccData = [
                'total_amount' => $supplier_account->total_amount - $request->grandamount,
                'paid' => $supplier_account->paid - $request->grandamount
            ];
        }else{
            $supplierAccData = [
                'total_amount' => $supplier_account->total_amount - $request->grandamount,
                'due' => $supplier_account->due - $request->grandamount
            ];
        }

        $supplierBalanceUpdate =  $supplier_account->update($supplierAccData);

        $supplier_led = SupplierLedger::query()->where('company_id',1)
                            ->where('supplier_id',$supplier_id)
                            ->first();
        $supplier_ledger = SupplierLedger::find($supplier_led->id);

        if($request->grandamount >= $supplier_ledger->due){
            $supplierLedData = [
                'total_amount' => $supplier_ledger->total_amount - $request->grandamount,
                'paid' => $supplier_ledger->paid - $request->grandamount
            ];
        }else{
            $supplierLedData = [
                'total_amount' => $supplier_ledger->total_amount - $request->grandamount,
                'due' => $supplier_ledger->due - $request->grandamount
            ];
        }

         $supplierLedgerUpdate =  $supplier_ledger->update($supplierLedData);

        $purchasea = Purchase::query()->where('company_id',1)
                            ->where('id',$purchase_id)
                            ->first();
        $purchase = Purchase::find($purchasea->id);

        $purchaseData = [
            'net_payable' => $purchase->net_payable - $request->grandamount,
            'details' => 'purchase return update log'
        ];

         $purchaseUpdate =  $purchase->update($purchaseData);

        $data = [
            'company_id' => $this->company_id,
            'return_code' => 'PR' . rand(1000, 2000),
            'purchase_id' => $request->purid,
            'supplier_id' => $request->sid,
            'invoice_no' => $request->invoice,
            'return_date' => $request->returndate,
            'total_deduction' => $request->grandamount,
            'user_id' => $this->user_id,
        ];

         $purchaseReturn = PurchaseReturn::create($data);

        $purchaseReturnLast = PurchaseReturn::query()
                ->where('company_id', 1)
                ->latest('id')
                ->first();

        foreach ($request->rqty as $row => $name) {
            if (!empty($request->rqty[$row])) {
                $medicineId   =   $request->mid[$row];
                $qty        =   $request->rqty[$row];
                $amount =   $request->total[$row];

                $PurchaseReturnDetails = [
                    'company_id' => $this->company_id,
                    'return_code' => $purchaseReturnLast->return_code,
                    'purchase_id'   =>  $purchase_id,
                    'medicine_id'      =>  $medicineId,
                    'supplier_id' => $supplier_id,
                    'return_qty'      =>  $qty,
                    'deduction_amount'      =>  $amount,
                    'purchase_return_id'      =>  $purchaseReturnLast->id,
                    'user_id' => $this->user_id,
                ];
                $PurchaseReturnDetailsInsert = PurchaseReturnDetails::create($PurchaseReturnDetails);
            }

        }

        foreach ($request->rqty as $row => $name) {
            if (!empty($request->rqty[$row])) {
                $medicineId   =   $request->mid[$row];
                $qty        =   $request->rqty[$row];

                $medicine = Medicine::query()->where('company_id', 1)->where('id', $medicineId)->first();
                $instock = $medicine->in_stock - $qty;

                $medicineData = [
                    'in_stock'       =>  $instock,
                ];
                $Medicine = Medicine::find($medicine->id);
                $MedicineUpdate =  $Medicine->update($medicineData);
            }
        }

        $purchaseDetailsa = PurchaseDetails::query()->where('company_id', 1)
                                    ->where('purchase_id', $purchase_id)->get();

       // dd($purchaseDetailsa);

        foreach ($request->rqty as $row => $name) {
            foreach($purchaseDetailsa as $pd){
                if (!empty($request->rqty[$row]) && $request->mid[$row] == $pd->medicine_id) {
                    $medicineId   =   $request->mid[$row];
                    $qty        =   $request->rqty[$row];
                    $amount =   $request->total[$row];

                    $purchaseDetailsData = [
                        'qty'           =>  $pd->qty - $qty,
                        'net_amount'    =>  $pd->net_amount - $amount,
                    ];

                    $purchaseDetails = PurchaseDetails::find($pd->id);
                    $purchaseDetailsUpdate =  $purchaseDetails->update($purchaseDetailsData);
                }
            }
        }
    }
}
