@extends('layouts.master')

@section('content')
	
	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Doctor List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="#">Home</a></li>
	              <li class="breadcrumb-item active">Doctor List</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    @include('Doctor.modals.addDoctor')
	@include('Doctor.modals.editDoctor')

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <button class="card-title btn btn-info btn-sm" data-toggle="modal" data-target="#addDoctorModal"><i class="fa fa-plus"></i>Add Doctor</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_doctors">
                
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
<!-- Select2 -->
<script src="{{asset('/')}}plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert2 -->
<script src="{{asset('/')}}plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="{{asset('/')}}plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
    	
    	// Get All Doctor function acll
    	fetchAllDoctors();

    	// Get All Doctor function
		function fetchAllDoctors(){
		$.ajax({
		url: '{{ route('allDoctors') }}',
		method: 'get',
		success: function(res){
		$("#show_all_doctors").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#getAllDoctor_wrapper .col-md-6:eq(0)');

		}
		});
		}

		// Add Doctor Code
	$("#add_doctor_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#add_doctor_btn").text('Adding...');
	$.ajax({
	url: '{{ route('save.doctor') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
	if(res.status == 200){
		alert("Data Save Successfully");
		fetchAllDoctors();
	}
	$("#add_doctor_btn").text('SAVE');
	$("#add_doctor_form")[0].reset();
	$("#addDoctorModal").modal('hide');
	}

	});
	});

		//Edit Icon click for Doctor Edit
		$(document).on('click', '.editIcon', function(e){
		e.preventDefault();
		let id = $(this).attr('id');
		$.ajax({
		url: '{{ route('edit.doctor') }}',
		method: 'get',
		data: {
		id: id,
		_token: '{{ csrf_token() }}'
		},
		success: function(res){
			console.log(res);
			$("#doctor_id").val(res.id);
			$("#full_name").val(res.full_name);
			$("#email").val(res.email);
			$("#phone").val(res.phone);
			$("#address").val(res.address);
			$("#degrees").val(res.degrees);			
		}
		});
		});

		// update Doctor ajax request
	$("#edit_doctor_form").submit(function(e) {
	e.preventDefault();
	const fd = new FormData(this);
	$("#edit_doctor_btn").text('Updating...');
		$.ajax({
			url: '{{ route('update.doctor') }}',
			method: 'post',
			data: fd,
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
		success: function(response) {
			if (response.status == 200) {
				alert("Update Successfully");
				fetchAllDoctors();
			}
			$("#edit_doctor_btn").text('Update');
			$("#edit_doctor_form")[0].reset();
			$("#editdoctorModal").modal('hide');
			}
		});
	});

	// delete Doctor ajax request
	$(document).on('click', '.deleteIcon', function(e) {
		e.preventDefault();
		let id = $(this).attr('id');
		let csrf = '{{ csrf_token() }}';
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		if (result.isConfirmed) {
		$.ajax({
			url: '{{ route('delete.doctor') }}',
			method: 'delete',
			data: {
			id: id,
			_token: csrf
		},
		success: function(response) {
			console.log(response);
			Swal.fire(
			'Deleted!',
			'Your file has been deleted.',
			'success'
			)
			fetchAllDoctors();
		}
		});
		}
		})
	});
    </script>

    <script>
    	$(function () {

    		$('.select2').select2()

    		//Date picker
		    $('#reservationdate').datetimepicker({
		        format: 'L'
		    });


    	})
    </script>
@endpush