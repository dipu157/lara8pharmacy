@extends('layouts.master')

@section('content')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style2.css') }}" rel="stylesheet">

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="pos_inputs">
                                            <form action="" method="post" class="SalesForm" id="SalesForm">
                                                <div class="row m-b-5">
                                                    <div class="col-md-3">
                                                        <input name="customer_type" value="WalkIn" type="radio"
                                                            id="WalkIn_customer" tabindex="-1" checked="checked">
                                                        <label for="WalkIn_customer">Walk In Customer</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input name="customer_type" value="Regular" type="radio"
                                                            id="regular_customer" tabindex="-1">
                                                        <label for="regular_customer">Regular Customer</label>
                                                    </div>

                                                    <div class="col-md-2" style="margin-left: -42px;">
                                                        <a href="
                                {{ route('customerIndex') }}"
                                                            target="_blank"
                                                            class="btn btn-sm btn-info waves-effect waves-light"
                                                            tabindex="-1"><b>New Customer</b></a>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <a href="" target="_blank"
                                                            class="btn btn-sm btn-info waves-effect waves-light"
                                                            tabindex="-1"><b>Invoice</b></a>
                                                    </div>
                                                </div>
                                                <div class="row m-b-5">
                                                    <div class="col-md-3 p-r-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon b-r-0"><i class="fa fa-search"
                                                                    aria-hidden="true"></i>
                                                            </span>
                                                            <input type="text" class="form-control" name="cusid"
                                                                id="cusid" placeholder="Name , Phone No..."
                                                                tabindex="1" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 p-l-r-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon b-r-0">
                                                                <i class="fa fa-user-circle"></i></span>
                                                            <input type="text" class="form-control" name="customer_name"
                                                                id="customer_name" placeholder="customer name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 p-l-r-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon b-r-0">
                                                                <i class="fa fa-user-circle"></i></span>
                                                            <input type="text" class="form-control" name="cus_contact"
                                                                id="cus_contact" placeholder="Phone Number">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input type="hidden" class="form-control customer_id"
                                                            name="customer_id" id="customer_id" placeholder="customer ID">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <span class="custom-text-button">
                                                                    Date: {{ date('d-m-y') }}
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="custom-text-button">
                                                                    Time: {{ date('h:i A', strtotime('+6 hours')) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row m-b-5">
                                                    <div class="col-md-9">
                                                        <div class="row pos-remove-spacing">
                                                            <div class="col-md-4" style="">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon b-r-0"><i
                                                                            class="fa fa-search" aria-hidden="true"></i>
                                                                    </span>
                                                                    <input type="hidden" id="proid" name="proid"
                                                                        value="">
                                                                    <input type="text" class="form-control proval"
                                                                        name="proval"
                                                                        placeholder="Barcode , Product ID..."
                                                                        id="product_name" tabindex="2"
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control proname"
                                                                        name="proname" id="proname"
                                                                        placeholder="Product Name"
                                                                        autocomplete="off"><sup>
                                                                        <h6 id="expiry"
                                                                            style="color:red;margin-top: 5px;position:absolute;">
                                                                        </h6>
                                                                    </sup>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group genric-left-sug">
                                                                    <input type="text" class="form-control genname"
                                                                        name="genname" id="genname"
                                                                        placeholder="Generic Name" required
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group genric-right-sug">
                                                                    <select id="lunch"
                                                                        class="form-control select2 generic gensuggestion"
                                                                        name="generic" title="" style=""
                                                                        placeholder="" autocomplete="off">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2" style="">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control qty"
                                                                        name="qty" max="" id="qty"
                                                                        placeholder="Qty " required tabindex="4"
                                                                        autocomplete="off">
                                                                    <!-- TABINDEX RESET INPUT  -->
                                                                    <input type="text" tabindex="5"
                                                                        onfocus="document.getElementById('product_name').focus()"
                                                                        style="position: fixed; top: 9999px; left: 9999px">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="far fa-money-bill-alt"></i>
                                                                    </span>
                                                                    <input type="text" class="form-control mrp"
                                                                        name="mrp" id="mrp" placeholder="MRP"
                                                                        readonly tabindex="-1" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="fa fa-cart-arrow-down"></i>
                                                                    </span>
                                                                    <input type="text" class="form-control stock"
                                                                        name="stock" id="stock"
                                                                        placeholder="Stock " readonly tabindex="-1"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                            <form action="" method="post" name="SalesFormConfirm"
                                                class="SalesFormConfirm" id="SalesFormConfirm">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="table-responsive mb-15"
                                                            style="height: 300px; overflow-y: auto; ">
                                                            <table class="table table-bordered pos_table scroll">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product Name
                                                                        </th>
                                                                        <th>Quantity
                                                                        </th>
                                                                        <th>Total
                                                                        </th>
                                                                        <th>Action
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="posinfo">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="row form-group">
                                                            <div class="col-md-5">
                                                                <label for="example-text-input"
                                                                    class=" col-form-label pos-label">Total Tk.
                                                                </label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <input class="form-control grandtotal" name="grandtotal"
                                                                    type="text" value="" style=""
                                                                    tabindex="-1" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-5">
                                                                <label for="example-text-input"
                                                                    class=" col-form-label pos-label">Discount (%)
                                                                </label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <input class="form-control gdiscount" name="gdiscount"
                                                                    type="text" value="" style=""
                                                                    tabindex="-1">
                                                                <input class="form-control total_discount"
                                                                    name="total_discount" type="hidden" value=""
                                                                    style="" tabindex="-1">
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-5">
                                                                <label for="example-text-input"
                                                                    class=" col-form-label pos-label">Payable Tk.
                                                                </label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <input class="form-control payable" name="payable"
                                                                    type="text" value="" style=""
                                                                    tabindex="-1" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-5">
                                                                <label for="example-text-input"
                                                                    class=" col-form-label pos-label">Paid Tk.
                                                                </label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <input class="form-control pay" type="text"
                                                                    name="pay" value="" style=""
                                                                    tabindex="-1" required="1">
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-5">
                                                                <label for="example-text-input"
                                                                    class=" col-form-label pos-label">Return Tk.
                                                                </label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <input class="form-control return" name="return"
                                                                    type="text" value="" style=""
                                                                    tabindex="-1">
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-5">
                                                                <label for="example-text-input"
                                                                    class=" col-form-label pos-label">Due Tk.
                                                                </label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <input class="form-control due" name="due"
                                                                    type="text" value="" style=""
                                                                    tabindex="-1">
                                                            </div>
                                                        </div>
                                                        <!--Regular customer sales target view-->
                                                        <div class="row form-group">
                                                            <div class="col-md-12">
                                                                <div id="sales">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="cid" name="cid" value=''
                                                    tabindex="-1">
                                                <input type="hidden" id="cus_name" placeholder="Name" name="cus_name"
                                                    value='' tabindex="-1">
                                                <input type="hidden" id="cus_mob" name="cus_mob"
                                                    placeholder="Contact No." value='' tabindex="-1">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <button type="submit" id="salesposSubmit"
                                                            class="btn waves-effect waves-light btn-secondary"
                                                            style="width: 70%;">Save & Print
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <!--Super sale-->
                                        <div class="card">
                                            <div class="card-heading">
                                                <span
                                                    style="display: block; padding: 7px 10px; background-color: #a5a5a5; color: #fff;font-weight:600">
                                                    Super Sale
                                                </span>
                                            </div>
                                            <div class="card-body" style="padding: 0; ">
                                                <ul class="list-group custom_list"
                                                    style="height: 420px; overflow-y: auto;">
                                                    @foreach ($medicine as $value)
                                                        <li class="super-sale-list"
                                                            style="padding:1px;padding-left:5px;border-bottom:.5px solid #e3e3e3">
                                                            <a href="" id="superpro"
                                                                data-id="{{ $value->id }}">{{ $value->medicine_type->short_name . ' ' . $value->name . '(' . $value->strength->strength . ')' }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>


    </div>
@endsection

@push('scripts')
    @include('assets.js.themejs')

    <script>
        $('#salesposSubmit').hide();
        $('#cusid').attr('tabindex', 1).focus();
    </script>

    <!--Walkin customer name , phone number fillup-->
    <script type="text/javascript">
        $('#customer_name').on('keyup', function() {
            $('#cus_name').val($(this).val());
        });

        $('#cus_contact').on('keyup', function() {
            $('#cus_mob').val($(this).val());
        });
    </script>

    <!--Customer information for c_type & c_name-->
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', ".customer", function(e) {
                e.preventDefault(e);
                //select to data return an array
                var data = $(this).select2('data');
                //so i access it by index
                var iid = data[0].id;
                //console.log(iid);
                $.ajax({
                    url: '<?php echo base_url(); ?>Customer/GetCustomerValueforPOS?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function(response) {
                    //console.log(response);
                    // Populate the form fields with the data returned from server
                    $('#SalesFormConfirm').find('[name="cid"]').val(response.mvalue.c_id).end();
                    $('#SalesForm').find('[name="customer_name"]').val(response.mvalue.c_name)
                .end();
                    $('#SalesForm').find('[name="cus_contact"]').val(response.mvalue.c_contact)
                    .end();
                    $('#SalesForm').find('[name="customer_id"]').val(response.mvalue.c_id).end();
                    if (response.mvalue.c_type == 'Regular') {
                        $('#SalesForm').find(':radio[id=regular_customer][value="Regular"]').prop(
                            'checked', true).end();
                    } else if (response.mvalue.c_type == 'WalkIn') {
                        $('#SalesForm').find(':radio[id=WalkIn_customer][value="WalkIn"]').prop(
                            'checked', true).end();
                    }
                });
            });
        });
    </script>
    <!--After keypress Event-->

    <!-- Customer Search Autocomplete -->
    <script>
        $(function() {
            $(this.target).find('input').autocomplete();
            $("#cusid").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: '{{ route('GetCustomerId') }}',
                        type: 'post',
                        dataType: "json",
                        cache: false,
                        data: {
                            search: request.term,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $('#cusid').val(''); // display the selected text
                    $('#customer_name').val(ui.item.label); // display the selected text
                    $('#cus_contact').val(ui.item.c_cont); // display the Contact
                    $('#cid').val(ui.item.value); // display the selected text
                    $('#customer_id').val(ui.item.value); // save selected id to input
                    if (ui.item.ctype == 'Regular') {
                        $('#SalesForm').find(':radio[id=regular_customer][value="Regular"]').prop(
                            'checked', true).end();
                    } else if (ui.item.ctype == 'Wholesale') {
                        $('#SalesForm').find(':radio[id=wholesale_customer][value="Wholesale"]').prop(
                            'checked', true).end();
                    }
                    if (ui.item.ctype == 'Regular') {
                        var id = ui.item.value;
                        $.ajax({
                            url: '{{ route('customerBalance') }}',
                            method: 'GET',
                            data: 'data',
                        }).done(function(response) {
                            //console.log(response);
                            $('#sales').show();
                            $('#sales').html(response);
                        });
                    } else if (ui.item.ctype == 'Wholesale') {
                        $('#sales').hide();
                    }
                    $("#cusid").autocomplete('close');
                    $('#product_name').attr('tabindex', 2).focus();
                    return false;
                },

                open: function(e, ui) {
                    //console.log(e);
                    var len = $('.ui-autocomplete > li').length;
                    if (len == 1) {
                        $(".ui-menu-item:eq(0)").trigger("click");
                        $("#cusid").autocomplete('close');
                        return false;
                    } else if (len == 2) {
                        $(".ui-menu-item:eq(1)").trigger("click");
                        $("#cusid").autocomplete('close');
                        return false;
                    }
                }
            });
        });
    </script>



    <script>
        $(".close").click(function() {
            location.reload();
        });
    </script>
@endpush
