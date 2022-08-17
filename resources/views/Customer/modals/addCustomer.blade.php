<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Cusomer</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="add_customer_form">
          @csrf

            <div class="modal-body">

                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                  </div>

                  <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address" cols="20" rows="2"></textarea>
                  </div>

                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Phone">
                  </div>

                  <div class="form-group">
                    <label>Customer Type</label>
                    <select class="form-control" id="customer_type" name="customer_type" style="width: 100%;">
                      <option value="walkin">Walk IN</option>
                      <option value="regular">Regular</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Regular Discount</label>
                    <input type="text" class="form-control" name="regular_discount" placeholder="Regular Discount (%)">
                  </div>

                  <div class="form-group">
                    <label>Special Discount</label>
                    <input type="text" class="form-control" name="special_discount" placeholder="Special Discount (%)">
                  </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="add_customer_btn" class="btn btn-primary">Save</button>
          </div>
        </form>


      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

