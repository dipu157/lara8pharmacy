

<div class="modal fade" id="editMedicineTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Medicine Type</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div class="card card-outline-primary">
                <div class="card-body">
                  <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="edit_MedicineType_form">
                      @csrf

                      <input type="hidden" name="id" id="medicine_type_id">

                        <div class="input-group mb-3">
                          <input type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Code" name="code" id="code" value="{{ old('code') }}" required>

                          @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror

                        </div>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" id="name" value="{{ old('name') }}" required>

                          @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>

                        
                        <div class="input-group mb-3">
                          <input type="text" class="form-control @error('short_name') is-invalid @enderror" placeholder="Short Name" id="short_name" name="short_name" value="{{ old('short_name') }}" required>

                          @error('short_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror

                        </div>


                        <div class="row">
                          <!-- /.col -->
                          <div class="col-4">
                            <button type="submit" id="edit_MedicineType_btn" class="btn btn-primary btn-block">UPDATE</button>
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

