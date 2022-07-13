

<div class="modal fade" id="editShelfModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Shelf</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div class="card card-outline-primary">
                <div class="card-body">
                  <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="edit_shelf_form">
                      @csrf

                      <input type="hidden" name="id" id="shelf_id">

                        <div class="input-group mb-3">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" id="name" name="name" value="{{ old('name') }}" required>

                          @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror

                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>


                        <div class="input-group mb-3">
                          <textarea name="details" rows="2" id="details" placeholder="Details" cols="30" class="form-control"></textarea>
                        </div>


                        <div class="row">
                          <!-- /.col -->
                          <div class="col-4">
                            <button type="submit" id="edit_shelf_btn" class="btn btn-primary btn-block">UPDATE</button>
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

