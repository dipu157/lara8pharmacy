@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Customer List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Customer List</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    @include('Customer.modals.addCustomer')
	@include('Customer.modals.editCustomer')

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <button class="card-title btn btn-info btn-sm" data-toggle="modal" data-target="#addCustomerModal"><i class="fa fa-plus"></i>Add Customer</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_Customers">

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

        $('.select2').select2();

    	// Get All Customer function acll
    	fetchAllCustomers();

    	// Get All Customer function
		function fetchAllCustomers(){
		$.ajax({
		url: '{{ route('allCustomers') }}',
		method: 'get',
		success: function(res){
		$("#show_all_Customers").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#getAllCustomer_wrapper .col-md-6:eq(0)');

		}
		});
		}


        	// Add Customer Code
	$("#add_customer_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#add_customer_btn").text('Adding...');
	$.ajax({
	url: '{{ route('save.Customer') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
	if(res.status == 200){
		toastr.success('Data Save Successfully');
		fetchAllCustomers();
	}
	$("#add_customer_btn").text('SAVE');
	$("#add_customer_form")[0].reset();
	$("#addCustomerModal").modal('hide');
	}

	});
	});

		//Edit Icon click for Customer Edit
		$(document).on('click', '.editIcon', function(e){
		e.preventDefault();
		let id = $(this).attr('id');
		$.ajax({
		url: '{{ route('edit.Customer') }}',
		method: 'get',
		data: {
		id: id,
		_token: '{{ csrf_token() }}'
		},
		success: function(res){
			console.log(res);
			$("#customer_id").val(res.id);
			$("#name").val(res.name);
			$("#email").val(res.email);
			$("#address").val(res.address);
			$("#phone").val(res.phone);
            $('#customer_type option[value="'+res.customer_type+'"]').prop('selected', true);
			$("#regular_discount").val(res.regular_discount);
			$("#special_discount").val(res.special_discount);
		}
		});
		});

		// update Customer ajax request
	$("#edit_customer_form").submit(function(e) {
	e.preventDefault();
	const fd = new FormData(this);
	$("#edit_customer_btn").text('Updating...');
		$.ajax({
			url: '{{ route('update.Customer') }}',
			method: 'post',
			data: fd,
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
		success: function(response) {
			if (response.status == 200) {
				toastr.success('Update Successfully');
				fetchAllCustomers();
			}
			$("#edit_customer_btn").text('Update');
			$("#edit_customer_form")[0].reset();
			$("#editCustomerModal").modal('hide');
			}
		});
	});

    </script>
@endpush
