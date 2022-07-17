@extends('layouts.master')

@section('content')

  <div class="content-wrapper">

  	<section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Company Settings</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	              <li class="breadcrumb-item active">Company Settings</li>
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
            <h3 class="card-title">Company Settings</h3>

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

          <form action="{{ route('editCompany') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="form-horizontal" >
          	@csrf
              <input type="hidden" name="company_photo" id="company_photo" value="{{ $company_info[0]->logo_img }}">
	            <div class="row">
	            	<input type="hidden" name="id" value="{{ $company_info[0]->id }}">
		              <div class="col-md-6">
			                <div class="form-group">
			                  <label>Title</label>
			                  <input type="text" class="form-control" name="title" value="{{ $company_info[0]->title }}" placeholder="Title">
			                </div>
		              </div>

		               <div class="col-md-6">
			                <div class="form-group">
			                  <label>Name</label>
			                  <input type="text" class="form-control" name="name" value="{{ $company_info[0]->name }}" placeholder="Name">
			                </div>
		               </div>


		               <div class="col-md-6">

			                <div class="form-group">
			                  <label>Address</label>
			                  <textarea class="form-control" cols="50" rows="3" name="address">{{ $company_info[0]->address }}</textarea>
			                </div>
		              </div>

		               <div class="col-md-6">


			                <div class="form-group">
			                  <label>Description</label>
			                  <textarea class="form-control" cols="50" rows="3" name="description">{{ $company_info[0]->description }}</textarea>
			                </div>
		               </div>

		               <div class="col-md-6">
			                <div class="form-group">
			                  <label>Website</label>
			                  <input type="text" class="form-control" name="website" value="{{ $company_info[0]->website }}" placeholder="WebSite">
			                </div>

			                <div class="form-group">
			                  <label>Phone</label>
			                  <input type="text" class="form-control" name="phone" value="{{ $company_info[0]->phone }}" placeholder="Phone">
			                </div>
		               </div>

		               <div class="col-md-6">
			                <div class="form-group">
			                  <label>email</label>
			                  <input type="email" class="form-control" name="email" value="{{ $company_info[0]->email }}" placeholder="Email">
			                </div>

			                <div class="form-group">
			                  <label>Currency</label>
			                  <input type="text" class="form-control" name="currency" id="currency" value="{{ $company_info[0]->currency }}">
			                </div>
		               </div>

                       <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" class="form-control" name="logo_img" id="logo_img">
                              </div>
                          </div>
                          <div class="col-md-6" id="logo_img_prev">
                            <img src="storage/images/{{ $company_info[0]->logo_img }}" width="100" class="img-fluid img-thumbnail">
                          </div>
                        </div>
                     </div>
		                <button class="btn btn-block btn-primary" type="submit">UPDATE</button>
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
