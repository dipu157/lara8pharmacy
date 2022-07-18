<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Supplier</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="edit_Supplier_form">
          @csrf

            <div class="modal-body">

                <input type="hidden" name="id" id="supplier_id" >

                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" id="name" required>
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                  </div>

                  <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address" id="address" cols="20" rows="2"></textarea>
                  </div>

                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                  </div>

                  <div class="form-group">
                    <label>Note</label>
                    <input type="text" class="form-control" name="note" id="note" placeholder="Note">
                  </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="edit_Supplier_btn" class="btn btn-primary">Update</button>
          </div>
        </form>


      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

