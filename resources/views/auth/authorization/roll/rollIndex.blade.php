@extends('layouts.master')

@section('content')

@include('auth.authorization.roll.addRollModal')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid" id="topt">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Role List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Role List</li>
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
                <button class="card-title btn btn-info btn-sm btn-addRole" data-toggle="modal" data-target="#addRollModal"><i class="fa fa-plus"></i>Add Roll</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_rolls">

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
    	fetchAllRolls();

    	// Get All Doctor function
		function fetchAllRolls(){
		$.ajax({
		url: '{{ route('allRolls') }}',
		method: 'get',
		success: function(res){
		$("#show_all_rolls").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

		}
		});
		}

		// Add Doctor Code
	$("#add_roll_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#add_roll_btn").text('Adding...');
	$.ajax({
	url: '{{ route('save.roll') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
        if(res.status == 200){
            toastr.success('Data Save Successfully');
            fetchAllRolls();
        }
        $("#add_roll_btn").text('SAVE');
        $("#add_roll_form")[0].reset();
        $("#addRollModal").modal('hide');
	},
    error: function (request, status, error) {
        toastr.error(request.responseText);
        fetchAllRolls();
        $("#add_roll_btn").text('SAVE');
        $("#add_roll_form")[0].reset();
        $("#addRollModal").modal('hide');
    }
	});
	});

	//Edit Icon click
	$(document).on('click', '.editIcon', function(e){
	e.preventDefault();
	let id = $(this).attr('id');
	$.ajax({
	url: '{{ route('roll.permission') }}',
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
		$('#show_all_rolls').html(res);
	}
	});
	});
    </script>
@endpush
