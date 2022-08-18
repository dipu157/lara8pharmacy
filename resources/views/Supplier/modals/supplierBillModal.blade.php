<div class="modal fade" id="supplierBillModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pay Supplier Bill</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="card card-outline-primary">
            <div class="card-body">
              <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="supplier_Bill_form">
                  @csrf
                      <input type="hidden" class="form-control" id="id" name="id">
                      <input type="hidden" class="form-control" id="purchase_id" name="purchase_id">
                      <input type="hidden" class="form-control" id="supplier_id" name="supplier_id">

                    <div class="input-group mb-3">
                        <label>Total Amount :</label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
                    </div>

                    <div class="input-group mb-3">
                        <label>Due Amount :</label>
                        <input type="number" class="form-control" id="due_amount" name="due_amount" readonly>
                    </div>

                    <div class="input-group mb-3">
                        <label>Now Payment :</label>
                        <input type="number" class="form-control" placeholder="Now Payment" name="paid_amount">
                    </div>
                    <div class="row">
                      <!-- /.col -->
                      <div class="col-4">
                        <button type="submit" id="bill_payment_btn" class="btn btn-primary btn-block">SAVE</button>
                      </div>
                      <!-- /.col -->
                    </div>
              </form>
             </div>
          </div>

        </div>


      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

