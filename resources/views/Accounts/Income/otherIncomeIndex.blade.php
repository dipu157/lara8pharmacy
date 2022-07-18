@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Other Income</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Other Income</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    @include('Accounts.Income.modals.otherIncomeAdd')

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">

                @if($open_balance->cash_in_hand > 0)
                <button style="margin-right: 1rem;" class="card-title btn btn-info btn-sm" data-toggle="modal" data-target="#addOtherIncomeModal"><i class="fa fa-plus"></i>Add Other Income</button>
                @else
                <p style="margin-top:0.2rem; font-size:20px; text-transform: capitalize;"><mark> You did not set opening balance. first set <a href="{{ route('openingBalance') }}">Opening Balance</a></p>
                @endif
            </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_otherIncome">

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

    // Get All Income function acll
    fetchAllIncomes();

    // Get All Income function
    function fetchAllIncomes(){
    $.ajax({
    url: '{{ route('allIncomes') }}',
    method: 'get',
    success: function(res){
    $("#show_all_otherIncome").html(res);

    $("table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#getAllIncome_wrapper .col-md-6:eq(0)');

    }
    });
    }

		// Add Other Income
	$("#add_income_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#add_income_btn").text('Adding...');
	$.ajax({
	url: '{{ route('save.otherIncome') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
	if(res.status == 200){
		toastr.success('Data Save Successfully');
        fetchAllIncomes();
	}
	$("#add_income_btn").text('SAVE');
	$("#add_income_form")[0].reset();
	$("#addOtherIncomeModal").modal('hide');
	}

	});
	});

    //Date picker
    $('#reservationdate').datetimepicker({
		format: 'L'
	});

    </script>

@endpush
