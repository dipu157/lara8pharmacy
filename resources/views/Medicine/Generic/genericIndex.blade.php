@extends('layouts.master')

@section('content')
	
	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Generic List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Generic List</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    @include('Medicine.Generic.modals.addGeneric')
    @include('Medicine.Generic.modals.editGeneric')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <button class="card-title btn btn-info btn-sm" data-toggle="modal" data-target="#addGenericModal"><i class="fa fa-plus"></i>Add Generic</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_generics">
                
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
    	
    	// Get All generic function acll
    	fetchAllgenerics();

    	// Get All generic function
		function fetchAllgenerics(){
		$.ajax({
		url: '{{ route('allGenerics') }}',
		method: 'get',
		success: function(res){
		$("#show_all_generics").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#getAllgeneric_wrapper .col-md-6:eq(0)');

		}
		});
		}

		// Add generic Code
	$("#add_generic_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#add_generic_btn").text('Adding...');
	$.ajax({
	url: '{{ route('save.generic') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
	if(res.status == 200){
		alert("Data Save Successfully");
		fetchAllgenerics();
	}
	$("#add_generic_btn").text('SAVE');
	$("#add_generic_form")[0].reset();
	$("#addGenericModal").modal('hide');
	}

	});
	});

		//Edit Icon click for generic Edit
		$(document).on('click', '.editIcon', function(e){
		e.preventDefault();
		let id = $(this).attr('id');
		$.ajax({
		url: '{{ route('edit.generic') }}',
		method: 'get',
		data: {
		id: id,
		_token: '{{ csrf_token() }}'
		},
		success: function(res){
			console.log(res);
			$("#generic_id").val(res.id);
			$("#generic_name").val(res.name);		
		}
		});
		});

		// update generic ajax request
	$("#edit_generic_form").submit(function(e) {
	e.preventDefault();
	const fd = new FormData(this);
	$("#edit_generic_btn").text('Updating...');
		$.ajax({
			url: '{{ route('update.generic') }}',
			method: 'post',
			data: fd,
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
		success: function(response) {
			if (response.status == 200) {
				alert("Update Successfully");
				fetchAllgenerics();
			}
			$("#edit_generic_btn").text('Update');
			$("#edit_generic_form")[0].reset();
			$("#editGenericModal").modal('hide');
			}
		});
	});

	// delete generic ajax request
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
			url: '{{ route('delete.generic') }}',
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
			fetchAllgenerics();
		}
		});
		}
		})
	});
    </script>
@endpush