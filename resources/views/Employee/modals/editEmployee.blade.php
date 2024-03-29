
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Employee</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>


            <form action="#" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="form-horizontal" id="edit_employee_form">
              @csrf

                <div class="modal-body">
                <div class="row">

                  <input type="hidden" name="id" id="emp_id">
                  <input type="hidden" name="emp_photo" id="emp_photo">

                  <div class="col-md-6">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" id="first_name" class="form-control" name="first_name" placeholder="First Name">
                      </div>
                  </div>

                   <div class="col-md-6">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last Name">
                      </div>
                   </div>


                   <div class="col-md-6">

                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="emp_email" class="form-control" name="email" placeholder="Email">
                      </div>

                      <div class="form-group">
                        <label>DOB</label>
                        <div class="input-group date" data-target-input="nearest">
                          <input type="date" name="dob" id="emp_dob" class="form-control"/>
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                          </div>
                        </div>
                      </div>
                  </div>

                   <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" id="mobile" class="form-control" name="mobile" placeholder="Phone">
                      </div>

                      <div class="form-group">
                        <label>Gender</label>
                        <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                          <input type="radio" id="gender1" name="gender" value="m">
                          <label for="gender1">Male </label>
                        </div>
                        <div class="icheck-primary d-inline">
                          <input type="radio" id="gender2" name="gender" value="f">
                          <label for="gender2">Female </label>
                        </div>
                        </div>
                      </div>
                   </div>

                   <div class="col-md-6">
                      <div class="form-group">
                        <label>National ID</label>
                        <input type="text" id="emp_national_id" class="form-control" name="national_id" placeholder="National ID">
                      </div>

                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" id="emp_address" cols="50" rows="2" name="address"></textarea>
                      </div>
                   </div>

                   <div class="col-md-6">
                      <div class="form-group">
                        <label>Blood Group</label>
                        <select class="form-control" id="emp_blood_group" name="blood_group" style="width: 100%;">
                          <option>Select Blood Group</option>
                          <option value="a+">A+</option>
                          <option value="a-">A-</option>
                          <option value="b+">B+</option>
                          <option value="b-">B-</option>
                          <option value="ab+">AB+</option>
                          <option value="ab-">AB-</option>
                          <option value="o+">O+</option>
                          <option value="o-">O-</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Last Education</label>
                        <input type="text" class="form-control" id="emp_last_education" name="last_education" placeholder="Last Education">
                      </div>
                   </div>

                   <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                          </div>
                        </div>
                        <div class="col-md-6" id="emp_img">
                        </div>
                      </div>
                   </div>

                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="edit_employee_btn" class="btn btn-primary">UPDATE</button>
              </div>
            </form>


          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
