@extends('layouts.admin')

@section('main_content')
<div class="content-wrapper" style="min-height: 1302.4px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Pages</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{ route('pagecreate.setting')}}" class="btn btn-success rounded-0">
              +Add New
            </a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
    <!-- start container-fluid -->
      <div class="container-fluid">
        <!-- start row -->
        <div class="row">
          <!-- start col -->
          <div class="col-12">
            <!-- Start card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Page list here.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped rounded-0">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Page Name</th>
                    <th>Page Slug</th>
                    <th>Page Title</th>
                    <th>Page Position</th>
                    <th>Page Description</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($page as $key=>$row)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$row->page_name}}</td>
                    <td>{{$row->page_slug}}</td>
                    <td>{{$row->page_title}}</td>
                    <td>{{$row->page_position}}</td>
                    <td>{{$row->page_description}}</td>
                    <td>
                      <a href="{{ route('pageedit.setting',$row->id) }}" class="btn btn-success rounded-0 btn-sm" data-id="{{$row->id}}" name="action"><i class="fas fa-edit"></i></a>
                      <a href="{{ route('pagedelete.setting',$row->id) }}" style="margin-left:6px;" name="action" class="btn btn-danger rounded-0 btn-sm Deletep"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- End card -->
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container-fluid -->
    </section>
  </div>
  
@endsection('main_content')