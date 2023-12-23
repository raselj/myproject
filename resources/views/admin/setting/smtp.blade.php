@extends('layouts.admin')
@section('main_content')

<div class="content-wrapper" style="min-height: 1345.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/home')}}">Home</a></li>
              <li class="breadcrumb-item active">SMTP Mail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary card-outline">
              <div class="card-header rounded-0">
                <h3 class="card-title">Your SMTP Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('smtp.setting.update', $data->id) }}" method="post" autocomplete="on">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="mailer">Mail Mailer</label>
                    <input type="text" name="mailer" value="{{$data->mailer}}" class="form-control @error('mailer') is-invalid @enderror" autocomplete="mailer" id="mailer" placeholder="Mail Mailer">
                  </div>
                  <div class="form-group">
                    <label for="host">Mail Host</label>
                    <input type="text" name="host" value="{{$data->host}}" class="form-control @error('host') is-invalid @enderror" autocomplete="host" id="host" placeholder="Mail Host">
                  </div>
                  <div class="form-group">
                    <label for="port">Mail Port</label>
                    <input type="text" name="port" value="{{$data->port}}" class="form-control @error('port') is-invalid @enderror" autocomplete="port" id="port" placeholder="Mail Port">
                  </div>
                  <div class="form-group">
                    <label for="user_name">Mail User Name</label>
                    <input type="text" name="user_name" value="{{$data->user_name}}" class="form-control @error('user_name') is-invalid @enderror" autocomplete="user_name" id="user_name" placeholder="Mail User Name">
                    <small>Example: Mail User Name.</small>
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Mail Password</label>
                    <input type="password" name="password" value="{{$data->password}}" class="form-control @error('password') is-invalid @enderror" autocomplete="password" id="password" placeholder="Mail Password">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update SMTP</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection('main_content')