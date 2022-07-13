
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div class="card card-outline-primary">
                <div class="card-body">
                  <form action="#" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="form-horizontal" id="add_user_form">
                      @csrf
                        <div class="input-group mb-3">
                          {!! Form::select('role_id',$roles,null,array('id'=>'role_id','class'=>'form-control','name'=>'role_id')) !!}
                        </div>
                        <div class="input-group mb-3">
                          {!! Form::select('employee_id',$employees,null,array('id'=>'employee_id','class'=>'form-control','name'=>'employee_id')) !!}
                        </div>

                        <input type="hidden" name="name" id="emp_name">

                        <div class="input-group mb-3">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required>

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
                          <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required="" placeholder="Password">

                          @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror

                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="password" class="form-control" name="password_confirmation" required placeholder="Retype password">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-8">
                            <div class="icheck-primary">
                              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                              <label for="agreeTerms">
                               I agree to the <a href="#">terms</a>
                              </label>
                            </div>
                          </div>
                          <!-- /.col -->
                          <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
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

