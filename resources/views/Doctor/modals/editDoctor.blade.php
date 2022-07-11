

<div class="modal fade" id="editdoctorModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Doctor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div class="card card-outline-primary">
                <div class="card-body">
                  <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="edit_doctor_form">
                      @csrf

                      <input type="hidden" name="id" id="doctor_id">

                        <div class="input-group mb-3">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" id="full_name" name="name" value="{{ old('name') }}" required>

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
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>

                          @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror

                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-envelope"></span>
                            </div>
                          </div>
                        </div>

                        <div class="input-group mb-3">
                          <textarea name="address" rows="2" id="address" placeholder="Address" cols="30" class="form-control"></textarea>
                        </div>


                        <div class="input-group mb-3">
                          <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" name="phone" value="{{ old('phone') }}" required>

                          @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror

                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-phone-square"></span>
                            </div>
                          </div>
                        </div>


                        <div class="input-group mb-3">
                          <textarea name="degrees" rows="2" id="degrees" placeholder="Degrees" cols="30" class="form-control"></textarea>
                        </div>


                        <div class="row">
                          <!-- /.col -->
                          <div class="col-4">
                            <button type="submit" id="edit_doctor_btn" class="btn btn-primary btn-block">UPDATE</button>
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

