@extends('layouts.master')

@section('content')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Purchase</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create Purchase</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </section>
        <!-- Content Header (Page header) -->

        <div class="content-header">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">New Purchase</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="" method="post" accept-charset="utf-8" class="form-horizontal"
                            id="purchaseForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" style="margin-bottom: 15px">
                                        <label class="control-label">Supplier Name</label>
                                        {!! Form::select('supplier_id', $supplier, null, [
                                            'id' => 'supplier_id',
                                            'class' => 'form-control selsect2',
                                            'name' => 'supplier_id',
                                            'placeholder' => 'Select Supplier',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="margin-bottom: 15px">
                                        <label class="control-label">Invoice No</label>
                                        <input type="number" id="invoice_id" name="invoice_no" class="form-control"
                                            placeholder="Invoice No" value="" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="margin-bottom: 15px">
                                        <label class="control-label">Invoice Date</label>
                                        <input type="date" id="datepicker" class="form-control datepicker" placeholder=""
                                            name="purchase_date" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group" style="margin-bottom: 15px">
                                        <label class="control-label">Note</label>
                                        <textarea type="text" name="details" class="form-control" placeholder="Details" rows="1" cols="8"></textarea>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered pos_table  purchase">
                                <thead>
                                    <tr>
                                        <th style="width:15%">Medicine </th>
                                        <th>Exp. Date</th>
                                        <th>Stock</th>
                                        <th>Qty</th>
                                        <th>TP</th>
                                        <th>VAT</th>
                                        <th>MRP</th>
                                        <th>Disc</th>
                                        <th>Net Payable</th>
                                    </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                </tbody>
                                <tfoot>

                                    <tr>
                                        <td class="text-right font-weight-bold" colspan=8>Total Amount:</td>
                                        <td><input type="text" class="form-control netAmnt" name="total_amount"
                                                placeholder="0.00" readonly="" value=""></td>

                                    </tr>

                                    <tr>
                                        <td class="text-right font-weight-bold" colspan=8>Total Vat:</td>
                                        <td><input type="text" class="form-control netVat" name="total_vat"
                                                placeholder="0.00" readonly="" value=""></td>

                                    </tr>

                                    <tr>
                                        <td class="text-right font-weight-bold" colspan=8>Total Discount:</td>
                                        <td><input type="text" class="form-control netDis" name="total_discount"
                                                placeholder="0.00" readonly="" value=""></td>

                                    </tr>

                                    <tr>
                                        <td class="text-right font-weight-bold" colspan=8>Net Payable:</td>
                                        <td><input type="text" class="form-control gtotal" id="netPayable"
                                                name="net_payable" placeholder="0.00" readonly="" value=""></td>

                                    </tr>
                                    <tr>
                                        <td class="text-right font-weight-bold" colspan=8>Total Paid:</td>
                                        <td><input type="text" class="form-control paid" name="paid_amount"
                                                placeholder="0.00" value=""></td>

                                    </tr>
                                    <tr>
                                        <td class="text-right font-weight-bold" colspan=8>Total Due:</td>
                                        <td><input type="text" class="form-control due" name="due"
                                                placeholder="0.00" readonly="" value=""></td>

                                    </tr>
                                    <tr id="payform">

                                        <td><select name="payment_type" id="payment_type" class="form-control" required>
                                                <?php foreach($payment_type as $value): ?>
                                                <option value="<?php echo $value->id; ?>"><?php echo $value->payment_method; ?></option>
                                                <?php endforeach; ?>
                                            </select></td>

                                            
                                        <td><input type="text" name="receiver_name" id="rname"
                                                class="form-control" placeholder="Receiver Name" value=""></td>
                                        <td><input type="text" name="receiver_contact" id="rcontact"
                                                class="form-control" placeholder="Receiver Contact" value=""></td>
                                        <td><input type="date" name="issue_date" class="form-control datepicker"
                                                placeholder="Pay Date" value=""></td>
                                        <td class="text-right"> <input type="submit" id="purchasesubmit"
                                                class="btn btn-primary btn-block" value="Review Order"
                                                style="color:white"> </td>

                                    </tr>
                                </tfoot>
                            </table>

                        </form>
                        <!-- /.col -->
                    </div>


                </div>
            </div>
        </div>
    </div>

    @include('Purchase.modals.review')
    @include('Purchase.modals.invoicePrint')
@endsection

@push('scripts')
    @include('assets.js.themejs')

    <!--Get supplier product-->
    <script type="text/javascript">
        $('#supplier_id').on('change', function(e) {
            e.preventDefault();
            var supp_id = $(this).val();
            //console.log(supp_id);
            $.ajax({
                url: '{{ route('medicineBySupplier') }}',
                method: 'get',
                data: {
                    id: supp_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    $("#addPurchaseItem").html(res);

                }
            });
        });
    </script>

    <!--Purchase calculation-->
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('keyup',
                '.qty, .tradeprice, .vat, .total, .discount,.gtotal, .netAmnt , .netDis , .paid, .due',
                function() {

                    var rows = this.closest('#purchaseForm tr');
                    var quantity = $(rows).find(".qty");
                    var price = $(rows).find(".tradeprice");
                    var vat = $(rows).find(".vat");
                    var pdiscount = $(rows).find(".discount");

                    var qty = parseInt($(quantity).val());
                    var trade = parseFloat($(price).val());
                    var vat = parseFloat($(vat).val());
                    var discount = parseFloat($(pdiscount).val());
                    // alert(qty);
                    if (isNaN(qty) == true) {
                        //console.log(qty);
                        $('#purchasesubmit').hide();
                        $('#payform').hide();
                    } else {
                        // console.log(qty);
                        $('#purchasesubmit').show();

                    }
                    var total_amount = 0;
                    var total_vat = 0;
                    var total_discount = 0;
                    var net_payable = 0;
                    if (isNaN(qty) == true) {
                        net_payable = 0;
                        total_amount = 0;
                        total_vat = 0;
                        total_discount = 0;
                    } else {
                        if (qty > 0) {
                            var rawPrice = trade + vat - discount;
                            net_payable = qty * rawPrice;
                            net_payable = parseFloat(net_payable).toFixed(2);
                            var net_amount = net_payable;

                            total_amount = parseFloat(qty * trade).toFixed(2);
                            total_vat = parseFloat(qty * vat).toFixed(2);
                            total_discount = parseFloat(qty * discount).toFixed(2);
                        }
                    }
                    if (isNaN(discount) == true) {
                        net_payable = net_amount;
                    } else {
                        if (qty > 0) {
                            var rawPrice = trade + vat - discount;
                            net_payable = qty * rawPrice;
                            net_payable = parseFloat(net_payable).toFixed(2);

                            total_amount = parseFloat(qty * trade).toFixed(2);
                            total_vat = parseFloat(qty * vat).toFixed(2);
                            total_discount = parseFloat(qty * discount).toFixed(2);
                        }
                    }

                    // alert(net_payable);
                    $(rows).find('[name="total_amount[]"]').val(total_amount);
                    $(rows).find('[name="total_vat[]"]').val(total_vat);
                    $(rows).find('[name="total_discount[]"]').val(total_discount);
                    $(rows).find('[name="net_amount[]"]').val(net_payable);

                    var sum = 0;
                    $(".total").each(function(index) {
                        sum += parseFloat($(this).val());
                    });

                    var tamnt = 0;
                    $(".tamount").each(function(index) {
                        tamnt += parseFloat($(this).val());
                    });

                    var tvat = 0;
                    $(".tvat").each(function(index) {
                        tvat += parseFloat($(this).val());
                    });

                    var discoun = 0;
                    $(".tdiscount").each(function(index) {
                        discoun += parseFloat($(this).val());
                    });


                    $(".gtotal").val(sum);
                    $(".netAmnt").val(tamnt);
                    $(".netVat").val(tvat);
                    $(".netDis").val(discoun);

                    var paid = $(rows).find(".paid");
                    var paidval = parseInt($(paid).val());

                    var netPayable = $(rows).find(".gtotal");
                    var netAmount = $(rows).find(".netAmnt");
                    var totalVat = $(rows).find(".netVat");
                    var netDiscount = $(rows).find(".netDis");
                    var netPayablev = parseInt($(".gtotal").val(sum));
                    var netAmountv = parseInt($(".netAmnt").val(tamnt));
                    var totalVatv = parseInt($(".netVat").val(tvat));
                    var netDiscountv = parseInt($(".netDis").val(discoun));

                    var dueval = 0;
                    if (isNaN(paidval) == true) {
                        dueval = 0;
                        $('#payform').hide();
                        /* var theTotal = fnAlltotal(total);
                        console.log( "first " + total);*/
                    } else {
                        var dueval = sum - paidval;
                        $('#purchasesubmit').show();
                        $('#payform').show();
                    }
                    $(".due").val(dueval);
                });
        });
    </script>

    {{-- Click Review Button --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $("#purchasesubmit").click(function(event) {
                event.preventDefault();
                var formval = $('#purchaseForm')[0];
                var data = new FormData(formval);
                $.ajax({
                    type: "POST",
                    url: '{{ route('purchaseReview') }}',
                    dataType: 'html',
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    success: function(response) {
                        if (response.status == 'error') {
                            $(".flashmessage").fadeIn('fast').delay(3000).fadeOut('fast').html(
                                response.message);
                        } else {
                            /*console.log(response);*/
                            $("#reviewDom").html(response);
                            $("#ReviewForm").trigger("reset");
                            $("#reviewmodal").modal("show");
                        }
                    },
                    error: function(response) {
                        console.error();
                    }
                });
            });
        });
    </script>
@endpush
