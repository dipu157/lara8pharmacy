@extends('layouts.master')

@section('content')

  <div class="content-wrapper">

  	<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Update Profile</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Profile</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
	      @if (session('status'))
			    <div class="alert alert-success">
			        {{ session('status') }}
			    </div>
			@endif
    </section>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Update Profile</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

          <form action="{{ route('update.employee') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="form-horizontal" id="edit_employee_form">
              @csrf

                <div class="modal-body">
                <div class="row">

                  <input type="hidden" name="id" id="emp_id" value="{{ $emp->id }}">
                  <input type="hidden" name="emp_photo" id="emp_photo" value="{{ $emp->photo }}">
                  
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" id="first_name" class="form-control" name="first_name" value="{{ $emp->first_name }}" placeholder="First Name">
                      </div>
                  </div>
                  
                   <div class="col-md-6">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" id="last_name" class="form-control" name="last_name" value="{{ $emp->last_name }}"placeholder="Last Name">
                      </div>
                   </div>


                   <div class="col-md-6">

                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="emp_email" class="form-control" name="email" value="{{ $emp->email }}" placeholder="Email">
                      </div>

                      <div class="form-group">
                        <label>DOB</label>
                        <div class="input-group date">
                          <input type="date" name="dob" id="emp_dob" class="form-control" value="{!! $emp->dob !!}" />
                        </div>
                      </div>
                  </div>
                  
                   <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" id="mobile" class="form-control" name="mobile" value="{{ $emp->mobile }}"placeholder="Phone">
                      </div>

                      <div class="form-group">
                        <label>Gender</label>
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                              <input type="radio" id="gender1" name="gender" value="m" {{ ($emp->gender=="m")? "checked" : "" }}>
                              <label for="gender1">Male </label>
                            </div>
                            <div class="icheck-primary d-inline">
                              <input type="radio" id="gender2" name="gender" value="f" {{ ($emp->gender=="f")? "checked" : "" }}>
                              <label for="gender2">Female </label>
                            </div>
                        </div>

                      </div>
                   </div>

                   <div class="col-md-6">
                      <div class="form-group">
                        <label>National ID</label>
                        <input type="text" id="emp_national_id" class="form-control" name="national_id" value="{{ $emp->national_id }}" placeholder="National ID">
                      </div>

                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" id="emp_address" cols="50" rows="2" name="address">{{ $emp->address }}</textarea>
                      </div>
                   </div>

                   <div class="col-md-6">
                      <div class="form-group">
                        <label>Blood Group</label>
                        <select class="form-control" id="emp_blood_group" name="blood_group" style="width: 100%;">
                          <option>Select Blood Group</option>
                          <option {{ ($emp->blood_group) == 'a+' ? 'selected' : '' }} value="a+">A+</option>
                          <option {{ ($emp->blood_group) == 'a-' ? 'selected' : '' }} value="a-">A-</option>
                          <option {{ ($emp->blood_group) == 'b+' ? 'selected' : '' }} value="b+">B+</option>
                          <option {{ ($emp->blood_group) == 'b-' ? 'selected' : '' }} value="b-">B-</option>
                          <option {{ ($emp->blood_group) == 'ab+' ? 'selected' : '' }} value="ab+">AB+</option>
                          <option {{ ($emp->blood_group) == 'ab-' ? 'selected' : '' }} value="ab-">AB-</option>
                          <option {{ ($emp->blood_group) == '0+' ? 'selected' : '' }} value="o+">O+</option>
                          <option {{ ($emp->blood_group) == '0-' ? 'selected' : '' }} value="o-">O-</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Last Education</label>
                        <input type="text" class="form-control" id="emp_last_education" name="last_education" placeholder="Last Education" value="{{ $emp->last_education }}">
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
	              <!-- /.col -->
	            </div>
           

          </div>
        </div>
      </div>
  	</div>
   </div>

@endsection
