@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Medicine List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Medicine List</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    @include('Medicine.Medicine.modals.addMedicine')
	@include('Medicine.Medicine.modals.editMedicine')

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <button class="card-title btn btn-info btn-sm" data-toggle="modal" data-target="#addMedicineModal"><i class="fa fa-plus"></i>Add Medicine</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_Medicines">

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

<script>
    $(".myselect").select2({ dropdownParent: "#addMedicineModal" });
  </script>

    <script type="text/javascript">

    	// Get All Medicine function acll
    	fetchAllMedicines();

    	// Get All Medicine function
		function fetchAllMedicines(){
		$.ajax({
		url: '{{ route('allMedicine') }}',
		method: 'get',
		success: function(res){
		$("#show_all_Medicines").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#getAllmedicine .col-md-6:eq(0)');

		}
		});
		}

        // Medicine MRP Calculation
        $('#box_size , #box_price').on('input', function() {
        var box_size = $('#box_size').val();
        var box_price = $('#box_price').val();

        $('#mrp').val((box_price / box_size ? box_price / box_size : 0).toFixed(2));
        });

        // Medicine Unit Purchase Calculation
        $('#box_size , #trade_price , #vat , #p_discount').on('input', function() {
        var box_size = $('#box_size').val();
        var trade_price = $('#trade_price').val();
        var vat = $('#vat').val();
        var p_discount = $('#p_discount').val();
        var main_purchase = parseFloat(trade_price)+parseFloat(vat) ;
        var after_discount = main_purchase - p_discount ;
        var u_purchase = after_discount / box_size ;
        console.log(main_purchase);
        $('#u_purchase').val((u_purchase ? u_purchase : 0).toFixed(2));
        });



        // Add Medicine Code
            $("#add_Medicine_form").submit(function(e){
            e.preventDefault();
            const fd = new FormData(this);
            $("#add_Medicine_btn").text('Adding...');
            $.ajax({
            url: '{{ route('save.Medicine') }}',
            method: 'post',
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res){
            if(res.status == 200){
                toastr.success('Data Save Successfully');
                fetchAllMedicines();
            }
            $("#add_Medicine_btn").text('SAVE');
            $("#add_Medicine_form")[0].reset();
            $("#addMedicineModal").modal('hide');
            }

            });
            });


		//Edit Icon click for Medicine Edit
		$(document).on('click', '.editIcon', function(e){
		e.preventDefault();
		let id = $(this).attr('id');
		$.ajax({
		url: '{{ route('edit.Medicine') }}',
		method: 'get',
		data: {
		id: id,
		_token: '{{ csrf_token() }}'
		},
		success: function(res){
			console.log(res);
            $("#medicine_id").val(res.id);
			$("#med_name").val(res.name);
			$("#batch_noid").val(res.batch_no);
			$("#box_sizeid").val(res.box_size);
			$("#box_priceid").val(res.box_price);
			$("#trade_priceid").val(res.trade_price);
			$("#vatid").val(res.vat);
			$("#mrpid").val(res.mrp);
			$("#p_discountid").val(res.p_discount);
			$("#u_purchaseid").val(res.u_purchase);
			$("#detailsid").val(res.details);
			$("#side_effectid").val(res.side_effect);
			$("#short_stockid").val(res.short_stock);
            $('#shelf_id option[value="'+res.shelf_id+'"]').prop('selected', true);
            $('#supplier_id option[value="'+res.supplier_id+'"]').prop('selected', true);
            $('#generic_id option[value="'+res.generic_id+'"]').prop('selected', true);
            $('#strength_id option[value="'+res.strength_id+'"]').prop('selected', true);
            $('#medicine_type_id option[value="'+res.medicine_type_id+'"]').prop('selected', true);
            $("input[name=favourite][value=" + res.favourite + "]").prop('checked', true);
            $("input[name=is_discount][value=" + res.is_discount + "]").prop('checked', true);
		}
		});
		});

		// update Medicine ajax request
	$("#edit_Medicine_form").submit(function(e) {
	e.preventDefault();
	const fd = new FormData(this);
	$("#edit_Medicine_btn").text('Updating...');
		$.ajax({
			url: '{{ route('update.Medicine') }}',
			method: 'post',
			data: fd,
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
		success: function(response) {
			if (response.status == 200) {
                toastr.success('Update Successfully');
				fetchAllMedicines();
			}
			$("#edit_Medicine_btn").text('Update');
			$("#edit_Medicine_form")[0].reset();
			$("#editMedicineModal").modal('hide');
			}
		});
	});

	// delete Medicine ajax request
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
			fetchAllMedicines();
		}
		});
		}
		})
	});

    </script>
@endpush
