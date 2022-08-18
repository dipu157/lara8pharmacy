@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Supplier Ledger</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Supplier Ledger</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body" id="show_all_SuppliersLedger">

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

    	// Get All Supplier function acll
    	fetchAllSuppliersLedger();

    	// Get All Supplier function
		function fetchAllSuppliersLedger(){
		$.ajax({
		url: '{{ route('allSuppliersLedger') }}',
		method: 'get',
		success: function(res){
		$("#show_all_SuppliersLedger").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#getAllSupplierLedger_wrapper .col-md-6:eq(0)');

		}
		});

		//Edit Icon click for Supplier Edit
		$(document).on('click', '.editIcon', function(e){
		e.preventDefault();
		let id = $(this).attr('id');
		$.ajax({
		url: '{{ route('edit.Supplier') }}',
		method: 'get',
		data: {
		id: id,
		_token: '{{ csrf_token() }}'
		},
		success: function(res){
			console.log(res);
			$("#supplier_id").val(res.id);
			$("#name").val(res.name);
			$("#email").val(res.email);
			$("#address").val(res.address);
			$("#phone").val(res.phone);
			$("#note").val(res.regular_discount);
		}
		});
		});
    }

    </script>
@endpush
