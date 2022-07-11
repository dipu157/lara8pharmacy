

<div class="modal fade" id="editStrengthModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Strength</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div class="card card-outline-primary">
                <div class="card-body">
                  <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="edit_strength_form">
                      @csrf

                      <input type="hidden" name="id" id="strength_id">

                        <div class="input-group mb-3">
                          <input type="text" class="form-control @error('strength') is-invalid @enderror" placeholder="Name" id="strength" name="strength" value="{{ old('strength') }}" required>

                          @error('strength')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>


                        <div class="row">
                          <!-- /.col -->
                          <div class="col-4">
                            <button type="submit" id="edit_strength_btn" class="btn btn-primary btn-block">UPDATE</button>
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

