

<div class="modal fade" id="addRollModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Roll</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="card card-outline-primary">
            <div class="card-body">
              <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="add_roll_form">
                  @csrf
                    <div class="input-group mb-3">
                      <input type="text" class="form-control @error('name') is-invalid @enderror" minlength="4" placeholder="Roll Name" name="name" value="{{ old('name') }}" required>
                      <span class="text-danger" id="nameError"></span>
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
                      <div class="col-4">
                        <button type="submit" id="add_roll_btn" class="btn btn-primary btn-block">SAVE</button>
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

