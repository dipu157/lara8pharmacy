@extends('layouts.master')

@section('content')

@include('auth.authorization.roll.addRollModal')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid" id="topt">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>User List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">User List</li>
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
              <div class="card-body" id="show_all_users">

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
    	fetchAllUsers();

    	// Get All Doctor function
		function fetchAllUsers(){
		$.ajax({
		url: '{{ route('allUsers') }}',
		method: 'get',
		success: function(res){
		$("#show_all_users").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

		}
		});
		}

	//Edit Icon click
	$(document).on('click', '.editIcon', function(e){
	e.preventDefault();
	let id = $(this).attr('id');
	$.ajax({
	url: '{{ route('usersPermission') }}',
	method: 'get',
	datatype: 'html',
	data: {
	id: id,
	_token: '{{ csrf_token() }}'
	},
	success: function(res){
		console.log('success');
		console.log(res);
		$('.btn-addRole').hide();
		$('#topt').hide();
		$('#show_all_users').html(res);
	}
	});
	});
    </script>
@endpush
