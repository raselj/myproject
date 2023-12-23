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
            <button type="button" class="btn btn-success rounded-0 text-align-right" data-toggle="modal" data-target="#modal-insert">
              Add New
            </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- start data insert modal -->
    <div class="modal fade" id="modal-insert">
      <form action="{{route('subcategory.store')}}" method="post">
        @csrf
         <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add New Sub-Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <select class="form-control" name="category_id" require="">
                    @foreach($category as $row)
                      <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                    @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="subcategory_name">Sub-Category Name</label>
                    <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror" name="subcategory_name"  required autocomplete="subcategory_name" autofocus placeholder="Sub Category Name">
                  </div>
                  @error('category_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger text-center rounded-0" data-dismiss="modal">Close</button>
                <button class="btn btn-success rounded-0 subbtn update" type="submit">Submit</button>
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
      
       <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Update Sub-Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div id="modal_body">
                <!-- this data is edit.blade.php -->
              </div>
          </div>
          <!-- /.modal-dialog -->
        </div>
      
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
                <h3 class="card-title">All Sub-Category list here.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped rounded-0">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Sub Category Name</th>
                    <th>Sub Category Slug</th>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($subcategory as $key=>$row)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$row->subcategory_name}}</td>
                    <td>{{$row->subcat_slug}}</td>
                    <td>{{$row->category->category_name}}</td>
                    <td>
                      <a href="#" class="btn btn-success rounded-0 btn-sm edit" data-id="{{$row->id}}" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-edit"></i></a>
                      <a href="{{route('subcategory.delete', $row->id)}}" style="margin-left:6px;" class="btn btn-danger rounded-0 btn-sm Deletep"><i class="far fa-trash-alt"></i></a>
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

      let subcat_id = $(this).data('id');
      $.get("/subcategory/edit/" + subcat_id,function(data){
         $('#modal_body').html(data);
      });
      
    }));
    
  </script>

@endsection('main_content')