@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Strength List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
	              <li class="breadcrumb-item active">Strength List</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    @include('Medicine.Strength.modals.addStrength')
    @include('Medicine.Strength.modals.editStrength')

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <button class="card-title btn btn-info btn-sm" data-toggle="modal" data-target="#addStrengthModal"><i class="fa fa-plus"></i>Add Strength</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_strength">

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

    	// Get All strength function acll
    	fetchAllStrength();

    	// Get All strength function
		function fetchAllStrength(){
		$.ajax({
		url: '{{ route('allStrengths') }}',
		method: 'get',
		success: function(res){
		$("#show_all_strength").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#getAllStrength_wrapper .col-md-6:eq(0)');

		}
		});
		}

		// Add strength Code
	$("#add_strength_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#add_strength_btn").text('Adding...');
	$.ajax({
	url: '{{ route('save.strength') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
	if(res.status == 200){
		alert("Data Save Successfully");
		fetchAllStrength();
	}
	$("#add_strength_btn").text('SAVE');
	$("#add_strength_form")[0].reset();
	$("#addStrengthModal").modal('hide');
	}

	});
	});

		//Edit Icon click for strength Edit
		$(document).on('click', '.editIcon', function(e){
		e.preventDefault();
		let id = $(this).attr('id');
		$.ajax({
		url: '{{ route('edit.strength') }}',
		method: 'get',
		data: {
		id: id,
		_token: '{{ csrf_token() }}'
		},
		success: function(res){
			console.log(res);
			$("#strength_id").val(res.id);
			$("#strength").val(res.strength);
		}
		});
		});

		// update strength ajax request
	$("#edit_strength_form").submit(function(e) {
	e.preventDefault();
	const fd = new FormData(this);
	$("#edit_strength_btn").text('Updating...');
		$.ajax({
			url: '{{ route('update.strength') }}',
			method: 'post',
			data: fd,
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
		success: function(response) {
			if (response.status == 200) {
				alert("Update Successfully");
				fetchAllStrength();
			}
			$("#edit_strength_btn").text('Update');
			$("#edit_strength_form")[0].reset();
			$("#editStrengthModal").modal('hide');
			}
		});
	});

	// delete strength ajax request
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
			url: '{{ route('delete.strength') }}',
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
			fetchAllStrength();
		}
		});
		}
		})
	});
    </script>
@endpush
