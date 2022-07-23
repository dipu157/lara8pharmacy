@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Purchase Details</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Purchase Details</li>
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
                <a class="card-title btn btn-info btn-sm" href="{{ route('purchaseHistory') }}">Purchase History</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Supplier</th>
                      <th>Medicine</th>
                      <th>Quantity</th>
                      <th>Trade Price</th>
                      <th>Vat</th>
                      <th>Discount</th>
                      <th>Supplier Price</th>
                      <th>Net Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($purchaseDetails as $row)
                    <tr>
                      <td>{{ $row->supplier->name }}</td>
                      <td>{{ $row->medicine->name }}</td>
                      <td> {{ $row->qty }}</td>
                      <td>{{ $row->net_tp }}</td>
                      <td>{{ $row->net_vat }}</td>
                      <td>{{ $row->net_discount }}</td>
                      <td>{{ $row->supplier_price }}</td>
                      <td>{{ $row->net_amount }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
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
        $("table").DataTable({
		      "responsive": true, "lengthChange": false, "autoWidth": false,
		      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>

@endpush

