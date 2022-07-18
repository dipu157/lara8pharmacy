@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Other Expense</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Other Expense</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    @include('Accounts.Expense.modals.otherExpenseAdd')

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                @if($open_balance->cash_in_hand > 0)
                <button style="margin-right: 1rem;" class="card-title btn btn-info btn-sm" data-toggle="modal" data-target="#addOtherExpenseModal"><i class="fa fa-plus"></i>Add Other Expense</button>
                @else
                <p style="margin-top:0.2rem; font-size:20px; text-transform: capitalize;"><mark> You do not have balance to make expense. first add balance from <a href="{{ route('otherIncome') }}">Other Income</a> or create <a href="{{ route('openingBalance') }}">Opening Balance</a></p>
                @endif
            </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_otherExpense">

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

    // Get All Expense function acll
    fetchAllExpenses();

    // Get All Expense function
    function fetchAllExpenses(){
    $.ajax({
    url: '{{ route('allExpenses') }}',
    method: 'get',
    success: function(res){
    $("#show_all_otherExpense").html(res);

    $("table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#getAllExpense_wrapper .col-md-6:eq(0)');

    }
    });
    }

		// Add Other Expense
	$("#add_Expense_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#add_Expense_btn").text('Adding...');
	$.ajax({
	url: '{{ route('save.otherExpense') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
	if(res.status == 200){
        toastr.success('Data Save Successfully');
        fetchAllExpenses();
	}else{
        toastr.error('You Do Not Have Sufficient Balance to Expense!');
        fetchAllExpenses();
    }
	$("#add_Expense_btn").text('SAVE');
	$("#add_Expense_form")[0].reset();
	$("#addOtherExpenseModal").modal('hide');
	}

	});
	});

    //Date picker
    $('#reservationdate').datetimepicker({
		format: 'L'
	});

    </script>

@endpush
