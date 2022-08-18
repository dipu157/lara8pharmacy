@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Invoice List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Invoice Details</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    @include('Supplier.modals.supplierBillModal')

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <a class="card-title btn btn-info btn-sm" href="{{ route('purchaseHistory') }}">Purchase History</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Invoice</th>
                      <th>Supplier</th>
                      <th>Purchase Date</th>
                      <th>Total Price</th>
                      <th>Paid</th>
                      <th>Due</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($purchase as $row)
                    <tr>
                      <td>{{ $row->purchase->invoice_no }}</td>
                      <td>{{ $row->supplier->name }}</td>
                      <td> {{ $row->purchase->purchase_date }}</td>
                      <td>{{ $row->total_amount }}</td>
                      <td>{{ $row->paid_amount }}</td>
                      <td>{{ $row->due }}</td>
                      <td><a id="{{ $row->id }}" class="btn btn-sm btn-success paySupplier" data-toggle="modal" data-target="#supplierBillModal">Pay Bill</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
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

    <script type="text/javascript">

    //Edit Icon click for Supplier Edit
		$(document).on('click', '.paySupplier', function(e){
		e.preventDefault();
		let id = $(this).attr('id');
		$.ajax({
		url: '{{ route('bill.Supplier') }}',
		method: 'get',
		data: {
		id: id,
		_token: '{{ csrf_token() }}'
		},
		success: function(res){
			console.log(res);
			$("#id").val(res.id);
			$("#supplier_id").val(res.supplier_id);
			$("#purchase_id").val(res.purchase_id);
			$("#total_amount").val(res.total_amount);
			$("#due_amount").val(res.due);
		}
		});
		});

    // Add Supplier Code
	$("#supplier_Bill_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#bill_payment_btn").text('Adding...');
	$.ajax({
	url: '{{ route('pay.Supplier') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
	if(res.status == 200){
		toastr.success('Payment Save Successfully');
        location.reload(true);
	}
	$("#bill_payment_btn").text('SAVE');
	$("#supplier_Bill_form")[0].reset();
	$("#supplierBillModal").modal('hide');
	}

	});
	});


    </script>

    <script type="text/javascript">
        $("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>

@endpush

