@extends('layouts.admin')

@section('main_content')
<div class="content-wrapper" style="min-height: 1302.4px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6 text-right">
            <button type="button" class="btn btn-success rounded-0" data-toggle="modal" data-target="#modal-insert">
              Add New
            </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- start data insert modal -->
    <div class="modal fade" id="modal-insert">
      <form action="{{route('category.store')}}" method="post">
        @csrf
      <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add New Category</h4>
                <button type="button" class="close rounded-0" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <div class="input-group mb-3">
                  <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name"  required autocomplete="category_name" autofocus placeholder="Category Name">
                  @error('category_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-0" data-dismiss="modal">Close</button>
                <button class="btn btn-primary rounded-0 subbtn submit" type="submit">Submit</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </form>
    </div>
    <!-- end data insert modal -->

    <!-- start data edit modal -->
    <div class="modal fade" id="modal-edit">
      <form action="{{route('category.update')}}" method="post">
        @csrf
        @method('PUT')
      <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add New Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <div class="input-group mb-3">
                  <input type="text" id="cname" class="form-control @error('category_name') is-invalid @enderror" name="category_name" required autocomplete="category_name" autofocus placeholder="Category Name">
                  <input type="hidden" id="category_id" name="id">
                  @error('category_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger rounded-0" data-dismiss="modal">Close</button>
                <button class="btn btn-success rounded-0" type="submit">Update</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </form>
    </div>
    <!-- end data edit modal -->
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
                <h3 class="card-title">All Category list here.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped rounded-0">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Category Slug</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $key=>$row)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$row->category_name}}</td>
                    <td>{{$row->category_slug}}</td>
                    <td>
                      <a href="#" class="btn btn-success rounded-0 btn-sm edit" data-id="{{$row->id}}" name="action" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-edit"></i></a>
                      <a href="{{route('category.delete', $row->id)}}" style="margin-left:6px;" name="action" class="btn btn-danger rounded-0 btn-sm Deletep"><i class="far fa-trash-alt"></i></a>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script>

    var edit = document.querySelectorAll('.edit');
    edit.forEach(all => all.addEventListener("click", function() {
      let cat_id = $(this).data('id');
      $.get("/category/edit/" + cat_id,function(data){
        $('#category_id').val(data.id);
        $('#cname').val(data.category_name);
      });
      
    }));
    
  </script>

@endsection('main_content')