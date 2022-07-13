@extends('layouts.master')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Update Password</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Password Change</li>
                </ol>
              </div>
            </div>
          @if(session()->has('success'))
                    <strong class="text-success">{{ session()->get('success') }}</strong>
                    @endif                  

                    @if(session()->has('error'))
                        <strong class="text-danger">{{ session()->get('error') }}</strong>
                    @endif
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
            <h3 class="card-title">Update Password</h3>

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

          <form method="post" action="{{ route('updatePass') }}">
                        @csrf

                        <div class="col-md-6">
                            <label>Current Password</label>
                            <input type="password" class="form-control" name="current_password" required>
                        </div>
                        <br>

                        <div class="col-md-6">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>

                        <div class="col-md-6">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <br>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>               <!-- /.col -->
                </div>
           

          </div>
        </div>
      </div>
    </div>
   </div>

@endsection
