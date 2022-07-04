@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Password') }}</div>

                <div class="card-body">
                    @if(session()->has('success'))
                    <strong class="text-success">{{ session()->get('success') }}</strong>
                @endif                  

                @if(session()->has('error'))
                    <strong class="text-danger">{{ session()->get('error') }}</strong>
                @endif
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
