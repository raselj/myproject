@extends('layouts.admin')
@section('main_content')

<div class="content-wrapper" style="min-height: 1345.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Change Password.</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- col-12 column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary card-outline">
              <div class="card-header rounded-0">
                <h3 class="card-title">Change Your <small>Password</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('pass.reset') }}" method="post" autocomplete="on">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" autocomplete="email" autofocus placeholder="Enter Your Email" required>
                  </div>
                  <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" class="form-control" name="old_password" class="form-control @error('password') is-invalid @enderror" autocomplete="password" id="old_password" placeholder="Old Password">
                  </div>
                  <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" autocomplete="password">
                  </div>
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="password-confirm" placeholder="Confirm Password">
                  </div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!-- col-12 column -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection('main_content')