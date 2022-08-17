@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Short Stock Medicine</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Short Stock Medicine</li>
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

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>SL</th>
                        <th>Supplier Name</th>
                        <th>Medicine Name</th>
                        <th>Generic</th>
                        <th>Stock</th>
                        <th>Short Stock</th>
                        <th>Sold Quantity</th>
                      </tr>
                      </thead>
                      <tbody>
                        @php($count=1)
                        @foreach ($medicine as $row)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $row->supplier->name }}</td>
                            <td>{{ $row->medicine_type->short_name." ".$row->name." ".$row->strength->strength }}</td>
                            <td>{{ $row->generic->name }}</td>
                            <td>{{ $row->in_stock }}</td>
                            <td>{{ $row->short_stock }}</td>
                            <td>{{ $row->sale_qty }}</td>
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
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

</script>

@endpush
