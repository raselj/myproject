@extends('layouts.admin')
@section('main_content')

<div class="content-wrapper" style="min-height: 1345.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update your new page.</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/home')}}">Home</a></li>
              <li class="breadcrumb-item" style="padding:0px 4px 0px 4px;"><a href="{{ url('/setting/pages')}}"> View Page </a></li>
              <li class="breadcrumb-item active">Update Page</li>
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
            <div class="card card-success card-outline">
              <div class="card-header rounded-0">
                <h3 class="card-title">Update Your <small>Page.</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('pageupdate.setting', $page->id) }}" method="post" autocomplete="on">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="page_position">Page Position</label>
                    <select name="page_position" id="page_position" class="form-control" autofocus>
                        <option value="2" @if($page->page_position==1) selected @endif>Line One</option>
                        <option value="3" {{ ($page->page_position==2) ? "selected" : ""}}>Line Two</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="page_name">Page Name</label>
                    <input type="text" name="page_name" id="page_name" value="{{$page->page_name}}" class="form-control" autocomplete="page_name" autofocus autocomplete="page_name" placeholder="Enter Your Page Name" required>
                  </div>
                  <div class="form-group">
                    <label for="page_title">Page Title</label>
                    <input type="text" name="page_title" id="page_title" value="{{$page->page_title}}" class="form-control @error('page_title') is-invalid @enderror" placeholder="New Page Title" autocomplete="page_title">
                  </div>
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  <div class="form-group">
                    <label for="page_description">Page Description</label>
                    <textarea name="page_description" id="page_description" class="form-control textarea" rows="5">{{$page->page_description}}</textarea>
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
                  <button type="submit" class="btn btn-primary">Update Now</button>
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