@extends('layouts.master')

@section('content')
	
	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Employee List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="#">Home</a></li>
	              <li class="breadcrumb-item active">Employee List</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    @include('Employee.modals.addEmployee')
	@include('Employee.modals.editEmployee')

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <button class="card-title btn btn-info btn-sm" data-toggle="modal" data-target="#addEmployeeModal"><i class="fa fa-plus"></i>Add Employee</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_employees">
                
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

<script src="{{asset('/')}}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('/')}}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('/')}}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('/')}}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('/')}}plugins/jszip/jszip.min.js"></script>
<script src="{{asset('/')}}plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('/')}}plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('/')}}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('/')}}plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('/')}}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('/')}}dist/js/adminlte.min.js"></script>

    <script type="text/javascript">
    	
    	// Get All employee function acll
    	fetchAllEmployees();

    	// Get All employee function
		function fetchAllEmployees(){
		$.ajax({
		url: '{{ route('allEmployee') }}',
		method: 'get',
		success: function(res){
		$("#show_all_employees").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#getAllEmployee_wrapper .col-md-6:eq(0)');

		}
		});
		}

		//Edit Icon click for Employee Edit
	$(document).on('click', '.editIcon', function(e){
	e.preventDefault();
	let id = $(this).attr('id');
	$.ajax({
	url: '{{ route('edit') }}',
	method: 'get',
	data: {
	id: id,
	_token: '{{ csrf_token() }}'
	},
	success: function(res){
	$("#fname").val(res.first_name);
	$("#lname").val(res.last_name);
	$("#email").val(res.email);
	$("#phone").val(res.phone);
	$("#post").val(res.post);
	$("#avatar").html(`<img src="storage/images/${res.avatar}" width="100" class="img-fluid img-thumbnail">`);
	$("#emp_id").val(res.id);
	$("#emp_avatar").val(res.avatar);
	}
	});
	});
    </script>
@endpush