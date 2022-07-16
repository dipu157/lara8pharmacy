<div class="modal fade" id="addOtherIncomeModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Income</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="add_income_form">
          @csrf

            <div class="modal-body">

                  <div class="form-group">
                    <label>Purpose</label>
                    <input type="text" class="form-control" name="purpose" placeholder="Purpose">
                  </div>

                  <div class="form-group">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="amount" placeholder="Amount">
                  </div>

                  <div class="form-group">
                    <label>Date</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                      <input type="text" name="date" id="date" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Payment Type</label>
                    {!! Form::select('payment_type_id',$payment_type,null,array('id'=>'payment_type_id','class'=>'form-control','name'=>'payment_type_id')) !!}
                  </div>

                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Description">
                  </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="add_income_btn" class="btn btn-primary">Save</button>
          </div>
        </form>


      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

