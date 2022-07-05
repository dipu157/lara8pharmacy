
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Employee</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>


            <form action="#" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="form-horizontal">
              @csrf
                <div class="modal-body">
                <div class="row">
                  
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="title" placeholder="Title">
                      </div>
                  </div>
                  
                   <div class="col-md-6">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name">
                      </div>
                   </div>


                   <div class="col-md-6">

                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="name" placeholder="Name">
                      </div>
                  </div>
                  
                   <div class="col-md-6">
                      

                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" cols="50" rows="3" name="description"></textarea>
                      </div>
                   </div>

                   <div class="col-md-6">
                      <div class="form-group">
                        <label>DOB</label>
                        <input type="text" class="form-control" name="website" placeholder="WebSite">
                      </div>

                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone">
                      </div>
                   </div>

                   <div class="col-md-6">
                      <div class="form-group">
                        <label>Gender</label>
                        <input type="email" class="form-control" name="email" placeholder="Email">
                      </div>

                      <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="form-control" name="logo_img">
                      </div>
                   </div>

                   <div class="col-md-6">
                      <div class="form-group">
                        <label>Blood Group</label>
                        <input type="text" class="form-control" name="website" placeholder="WebSite">
                      </div>

                      <div class="form-group">
                        <label>Last Education</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone">
                      </div>
                   </div>

                   <div class="col-md-6">
                      <div class="form-group">
                        <label>National ID</label>
                        <input type="email" class="form-control" name="email" placeholder="Email">
                      </div>
                   </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Update</button>
              </div>
            </form>


          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>