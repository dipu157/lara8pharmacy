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
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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

@include('assets.js.themejs')

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

		// Add Employee Code
	$("#add_employee_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#add_employee_btn").text('Adding...');
	$.ajax({
	url: '{{ route('save') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
	if(res.status == 200){
		toastr.success('Data Save Successfully');
		fetchAllEmployees();
	}
	$("#add_employee_btn").text('SAVE');
	$("#add_employee_form")[0].reset();
	$("#addEmployeeModal").modal('hide');
	}

	});
	});

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
			console.log(res);

			// Getting DOB in date format
			date = new Date(res.dob);
			var year = date.getFullYear();
			var month = date.getMonth()+1;
			month = ('0'+month).slice(-2);
			var day = date.getDate();
			day = ('0'+day).slice(-2);
			full_date = year+'-'+month+'-'+day;

			$("#first_name").val(res.first_name);
			$("#last_name").val(res.last_name);
			$('#emp_blood_group option[value="'+res.blood_group+'"]').prop('selected', true);
			$("#mobile").val(res.mobile);
			$("#emp_dob").val(full_date);
			$("#emp_email").val(res.email);
			$("input[name=gender][value=" + res.gender + "]").prop('checked', true);
			$("#emp_national_id").val(res.national_id);
			$("#emp_address").val(res.address);
			$("#emp_last_education").val(res.last_education);
			$("#emp_img").html(`<img src="storage/images/${res.photo}" width="100" class="img-fluid img-thumbnail">`);
			$("#emp_id").val(res.id);
			$("#emp_photo").val(res.photo);
		}
		});
		});

		// update employee ajax request
	$("#edit_employee_form").submit(function(e) {
	e.preventDefault();
	const fd = new FormData(this);
	$("#edit_employee_btn").text('Updating...');
		$.ajax({
			url: '{{ route('update') }}',
			method: 'post',
			data: fd,
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
		success: function(response) {
			if (response.status == 200) {
                toastr.success('Update Successfully');
				fetchAllEmployees();
			}
			$("#edit_employee_btn").text('Update');
			$("#edit_employee_form")[0].reset();
			$("#editEmployeeModal").modal('hide');
			}
		});
	});

	// delete employee ajax request
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
			url: '{{ route('delete') }}',
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
			fetchAllEmployees();
		}
		});
		}
		})
	});
    </script>

    <script>
    	$(function () {

    		$('.select2').select2();

    		//Date picker
		    $('#reservationdate').datetimepicker({
		        format: 'L'
		    });
    	});
    </script>
@endpush
