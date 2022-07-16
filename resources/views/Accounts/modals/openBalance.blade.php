
<div class="modal fade" id="addOpeningBalanceModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Opening Balance</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="card card-outline-primary">
            <div class="card-body">
              <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="add_openBalance_form">
                  @csrf
                    <input type="hidden" name="id" value="{{ $open_balance[0]->id }}">

                    <div class="input-group mb-3">
                        <div class="form-group">
                            <label>Opening Balance</label>
                      <input type="text" class="form-control @error('opening_balance') is-invalid @enderror"
                       name="opening_balance" id="opening_balance" value="{{ $open_balance[0]->opening_balance }}" required>
                        </div>

                      @error('opening_balance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <input type="hidden" class="form-control" name="cash_in_hand"
                    id="cash_in_hand" value="{{ $open_balance[0]->cash_in_hand }}" required>

                    <input type="hidden" class="form-control" name="closing_balance"
                    id="closing_balance" value="{{ $open_balance[0]->closing_balance }}" required>

                    <div class="row">
                      <!-- /.col -->
                      <div class="col-4">
                        <button type="submit" id="add_openBalance_btn" class="btn btn-primary btn-block">SAVE</button>
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

