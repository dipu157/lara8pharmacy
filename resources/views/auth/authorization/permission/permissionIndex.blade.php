@extends('layouts.master')

@section('content')

@include('auth.authorization.permission.addPermissionModal')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Permission List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Permission List</li>
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
              <div class="card-header">
                <button class="card-title btn btn-info btn-sm" data-toggle="modal" data-target="#addPermissionModal"><i class="fa fa-plus"></i>Add Permission</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_permission">

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

    	// Get All Doctor function acll
    	fetchAllPermission();

    	// Get All Doctor function
		function fetchAllPermission(){
		$.ajax({
		url: '{{ route('allPermission') }}',
		method: 'get',
		success: function(res){
		$("#show_all_permission").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

		}
		});
		}

		// Add Doctor Code
	$("#add_permission_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#add_permission_btn").text('Adding...');
	$.ajax({
	url: '{{ route('save.permission') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
        if(res.status == 200){
            toastr.success('Data Save Successfully');
            fetchAllPermission();
        }
        $("#add_permission_btn").text('SAVE');
        $("#add_permission_form")[0].reset();
        $("#addPermissionModal").modal('hide');
	},
    error: function (request, status, error) {
        toastr.error(request.responseText);
        fetchAllPermission();
        $("#add_permission_btn").text('SAVE');
        $("#add_permission_form")[0].reset();
        $("#addPermissionModal").modal('hide');
    }
	});
	});
    </script>
@endpush
