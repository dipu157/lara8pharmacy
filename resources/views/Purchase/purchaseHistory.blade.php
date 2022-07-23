@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Purchase List</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Purchase List</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <a class="card-title btn btn-info btn-sm" href="{{ route('createPurchase') }}"><i class="fa fa-plus"></i>Add Purchase</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_all_Purchases">

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

    	// Get All Purchase function acll
    	fetchAllPurchase();

    	// Get All Doctor function
		function fetchAllPurchase(){
		$.ajax({
		url: '{{ route('allPurchase') }}',
		method: 'get',
		success: function(res){
		$("#show_all_Purchases").html(res);

		$("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#getAllPurchase_wrapper .col-md-6:eq(0)');

		}
		});
		}

        </script>

    @endpush

