@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Shelf List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Shelf List</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    @include('Shelf.modals.addShelf')
	@include('Shelf.modals.editShelf')

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <button class="card-title btn btn-info btn-sm" data-toggle="modal" data-target="#addShelfModal"><i class="fa fa-plus"></i>Add Shelf</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_Shelf">

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

    	// Get All Shelf function acll
    	fetchAllShelfs();

    	// Get All Shelf function
		function fetchAllShelfs(){
		$.ajax({
		url: '{{ route('allShelf') }}',
		method: 'get',
		success: function(res){
		$("#show_all_Shelf").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#getAllShelf_wrapper .col-md-6:eq(0)');

		}
		});
		}

		// Add Shelf Code
	$("#add_Shelf_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#add_Shelf_btn").text('Adding...');
	$.ajax({
	url: '{{ route('save.Shelf') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
	if(res.status == 200){
		alert("Data Save Successfully");
		fetchAllShelfs();
	}
	$("#add_Shelf_btn").text('SAVE');
	$("#add_Shelf_form")[0].reset();
	$("#addShelfModal").modal('hide');
	}

	});
	});

		//Edit Icon click for Shelf Edit
		$(document).on('click', '.editIcon', function(e){
		e.preventDefault();
		let id = $(this).attr('id');
		$.ajax({
		url: '{{ route('edit.Shelf') }}',
		method: 'get',
		data: {
		id: id,
		_token: '{{ csrf_token() }}'
		},
		success: function(res){
			console.log(res);
			$("#shelf_id").val(res.id);
			$("#name").val(res.name);
			$("#details").val(res.details);
		}
		});
		});

		// update Shelf ajax request
	$("#edit_shelf_form").submit(function(e) {
	e.preventDefault();
	const fd = new FormData(this);
	$("#edit_shelf_btn").text('Updating...');
		$.ajax({
			url: '{{ route('update.Shelf') }}',
			method: 'post',
			data: fd,
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
		success: function(response) {
			if (response.status == 200) {
				alert("Update Successfully");
				fetchAllShelfs();
			}
			$("#edit_shelf_btn").text('Update');
			$("#edit_shelf_form")[0].reset();
			$("#editShelfModal").modal('hide');
			}
		});
	});

	// delete Shelf ajax request
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
			url: '{{ route('delete.Shelf') }}',
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
			fetchAllShelfs();
		}
		});
		}
		})
	});
    </script>

@endpush
