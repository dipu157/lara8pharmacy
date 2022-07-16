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
                <button class="card-title btn btn-info btn-sm" data-toggle="modal" data-target="#addOtherIncomeModal"><i class="fa fa-plus"></i>Add Other Income</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

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


		// Add Other Income
	$("#add_openBalance_form").submit(function(e){
	e.preventDefault();
	const fd = new FormData(this);
	$("#add_openBalance_btn").text('Adding...');
	$.ajax({
	url: '{{ route('save.openBalance') }}',
	method: 'post',
	data: fd,
	cache: false,
	processData: false,
	contentType: false,
	success: function(res){
	if(res.status == 200){
		alert("Data Save Successfully");
	}
	$("#add_openBalance_btn").text('SAVE');
	$("#add_openBalance_form")[0].reset();
	$("#addOpeningBalanceModal").modal('hide');
	}

	});
	});

    $('#opening_balance').on('keyup', function() {
        $('#cash_in_hand').val($(this).val());
        $('#closing_balance').val($(this).val());
    });

    //Date picker
    $('#reservationdate').datetimepicker({
		format: 'L'
	});

    </script>

@endpush
