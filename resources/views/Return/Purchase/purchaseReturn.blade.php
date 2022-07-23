@extends('layouts.master')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Purchase Return</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Purchase Return</li>
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
                <form class="form-inline" action="#" method="post" id="searchInvoice_form">
                    @csrf
                    <div class="form-group mx-sm-3 mb-2">
                      <input type="text" class="form-control" id="invoiceNo" name="invoice_no" placeholder="Enter Invoice No.">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2" id="invoiceSearchSubmit">Search</button>
                  </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="show_invoice_details">

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
    $(document).ready(function() {
        $("#invoiceSearchSubmit").click(function(event) {
            event.preventDefault();
            var formval = $('#searchInvoice_form')[0];
            var data = new FormData(formval);
            $.ajax({
                type: "POST",
                url: '{{ route('searchInvoice') }}',
                dataType: 'html',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function(response) {
                    if (response.status == 'error') {
                        $(".flashmessage").fadeIn('fast').delay(3000).fadeOut('fast').html(
                            response.message);
                    } else {
                        /*console.log(response);*/
                        $("#show_invoice_details").html(response);
                    }
                },
                error: function(response) {
                    console.error();
                }
            });
        });
    });
</script>

<!--Purchase Return calculation-->
<script type="text/javascript">
    $(document).ready(function () {
    $(document).on('keyup','.rqty, .total',function() {
      //var total;
      var gtotal = 0;
      var rows = this.closest('#purchaserForm tr');
      var quantity = $(rows).find(".pqty");
      var reqty = $(rows).find(".rqty");
      var price = $(rows).find(".td");
      var qtyval = parseInt($(quantity).val());
      var rqtyval = Math.abs(parseInt($(reqty).val()));
      var tradeval = parseFloat($(price).val());
        var total = 0;
        if(isNaN(rqtyval) == true){
            total = 0;
       } else {
            total =  Math.round(rqtyval * tradeval);
        }

      $(rows).find('[name="total[]"]').val(total);
              var sum = 0;
              $(".total").each(function(index){
                     sum += parseFloat($(this).val());
              });

        $(".gtotal").val(sum);
    });
  });
    </script>
@endpush
