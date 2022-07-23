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
                        <td><input type='date' class='form-control datepicker' name='expire_date[]' value='' id='datepicker'></td>
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
                'purchase_code' => 'P'.rand(1000,2000),
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
                                ->where('supplier_id',$data['supplier_id'])
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

            if($supplierBalanceUpdate){
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
                        'supplier_price'=>$tradeprice + $vat - $discount,
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

                    $medicine = Medicine::query()->where('company_id',1)->where('id',$medicineId)->first();
                    $instock = $medicine->in_stock + $qty;
                    $boxSize = $medicine->box_size;

                    $medicineData = [
                            'in_stock'       =>  $instock,
                            'mrp'           =>  $mrp,
                            'trade_price'   =>  $tradeprice * $boxSize,
                            'vat'           =>  $vat * $boxSize,
                            'p_discount'    =>  $discount *$boxSize
                    ];
                    $Medicine = Medicine::find($medicine->id);
                    $MedicineUpdate =  $Medicine->update($medicineData);
                    }

                    }
            }

            echo "<div class='row'>
                    <div class='col-md-12'>
                        <div class='card card-body printableArea' id='printableArea'>
                            <h5>INVOICE: <span class='pull-right text-muted'>#$request->invoice_no</span></h5>
                            <hr>
                            <div class='row'>
                                <div class='col-md-12' style='margin-top: -32px;'>
                                    <div class='pull-left'>
                                        <address>
                                            <h3> &nbsp;<b class='text-muted'>". get_company_name() ."</b></h3>
                                        </address>
                                    </div>
                                    <div class='pull-right text-right'>
                                        <address>
                                            <h3 class='text-muted'>To,</h3>
                                            <h5 class='text-muted'>$purchaseLast->name</h5>
                                            <p class='text-muted m-l-10'>$purchaseLast->address,
                                                <br> $purchaseLast->email,
                                                <br> $purchaseLast->phone</p>
                                            <p class='text-muted m-t-5'><b>Invoice Date :</b> <i class='fa fa-calendar'></i> $request->purchase_date</p>
                                        </address>
                                    </div>
                                </div>
                                <div class='col-md-12'>
                                    <div class='table-responsive m-t-10' style='clear: both;'>
                                        <table class='table table-hover'>
                                            <thead>
                                                <tr>
                                                    <th class=''>Medicine</th>
                                                    <th>Quantity</th>
                                                    <th class=''>Trade Price</th>
                                                    <th class=''>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                            foreach ($request->qty as $row => $name) {
                                                if (!empty($request->qty[$row])) {
                                                    $medicineId   =   $request->id[$row];
                                                    $qty        =   $request->qty[$row];
                                                    $tradeprice =   $request->trade_price[$row];
                                                    $vat        =   $request->vat[$row];
                                                    $discount   =   $request->p_discount[$row];
                                                    $total      =   $request->net_amount[$row];
                                                    $expire     =   $request->expire_date[$row];

                                                    $medicine = Medicine::query()->where('company_id',1)->where('id',$medicineId)->first();
                                                    $instock = $medicine->in_stock + $qty;
                                                echo "<tr>
                                                    <td class=''>$medicine->name</td>
                                                    <td>$qty</td>
                                                    <td class=''>$tradeprice </td>
                                                    <td class=''> $total </td>
                                                </tr>";
                                        }
                                        }
                                            echo "</tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class='col-md-12'>
                                    <div class='pull-right m-t-5 text-right'>
                                        <p style='margin-bottom: auto'>Sub - Total amount: $request->net_payable</p>
                                        <p style='margin-bottom: auto'>Sub - Total Paid: $paids</p>
                                        <p style='margin-bottom: auto'>Sub - Total Due: $due </p>
                                        <hr>
                                    </div>
                                    <div class='clearfix'></div>
                                    <hr>
                                </div>
                                <div class='col-md-12 m-t-10'>
                                    <div class='clearfix'>
                                    <div class='col-md-4'>
                                    <div id='signaturename'>
                                        Signature:
                                    </div>

                                    <div id='signature'>
                                    </div>
                                    </div>
                                    <div class='col-md-8'>
                                    </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";

        }
}
