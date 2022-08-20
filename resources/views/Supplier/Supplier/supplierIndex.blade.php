@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Supplier List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Supplier List</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    @include('Supplier.Supplier.modals.addSupplier')
	@include('Supplier.Supplier.modals.editSupplier')

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <button class="card-title btn btn-info btn-sm" data-toggle="modal" data-target="#addSupplierModal"><i class="fa fa-plus"></i>Add Supplier</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_suppliers">

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
    	fetchAllSuppliers();

    	// Get All Supplier function
		function fetchAllSuppliers(){
		$.ajax({
		url: '{{ route('allSuppliers') }}',
		method: 'get',
		success: function(res){
		$("#show_all_suppliers").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#getAllSupplier_wrapper .col-md-6:eq(0)');

		}
		});
		}


        	// Add Supplier Code
	$("#add_Supplier_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#add_Supplier_btn").text('Adding...');
	$.ajax({
	url: '{{ route('save.Supplier') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
	if(res.status == 200){
		toastr.success('Data Save Successfully');
		fetchAllSuppliers();
	}
	$("#add_Supplier_btn").text('SAVE');
	$("#add_Supplier_form")[0].reset();
	$("#addSupplierModal").modal('hide');
	}

	});
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

		// update Supplier ajax request
	$("#edit_Supplier_form").submit(function(e) {
	e.preventDefault();
	const fd = new FormData(this);
	$("#edit_Supplier_btn").text('Updating...');
		$.ajax({
			url: '{{ route('update.Supplier') }}',
			method: 'post',
			data: fd,
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
		success: function(response) {
			if (response.status == 200) {
				toastr.success('Update Successfully');
				fetchAllSuppliers();
			}
			$("#edit_Supplier_btn").text('Update');
			$("#edit_Supplier_form")[0].reset();
			$("#editSupplierModal").modal('hide');
			},
        error: function (request, status, error) {
            toastr.error(request.responseText);
            fetchAllSuppliers();
            $("#edit_Supplier_btn").text('Update');
			$("#edit_Supplier_form")[0].reset();
			$("#editSupplierModal").modal('hide');
        }
		});
	});

    </script>
@endpush
