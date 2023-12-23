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
      <form action="{{ route('brand.store')}}" method="post" autofocus autocomplete="on" enctype="multipart/form-data">
        @csrf
         <div class="modal-dialog">
            <div class="modal-content rounded-0">
              <div class="modal-header">
                <h4 class="modal-title">Add New Brand.</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="brand_name">Brand Name</label>
                    <input type="text" class="form-control" name="brand_name" placeholder="Brand Name">
                  </div>
                  <div class="form-group">
                    <label for="brand_logo">Brand Logo</label>
                    <input type="file" class="form-control dropify" name="brand_logo">
                  </div>
                  <input type="hidden" name="id">
                  @error('brand_name')
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
    <div class="modal fade" id="child-edit">
      
       <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Update Brand.</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div id="modal_body">
                
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
            <div class="card rounded-0">
              <div class="card-header">
                <h3 class="card-title">All Brand list here.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped y-tables">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Brand Name</th>
                    <th>Brand Slug</th>
                    <th>Brand Logo</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
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

<!-- Data table is here -->
<script>


  $(function () {
      
      var table = $('.y-tables').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('brand.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'brand_name', name: 'brand_name'},
              {data: 'brand_slug', name: 'brand_slug'},
              {data: 'brand_logo', name: 'brand_logo', render: function(data,type,full,meta){
                  return "<img src=\"" +data+ "\" height=\"50\" />";
              }},
              {data: 'action', name: 'action', orderable: true, searchable: true},
          ]
      });
  
        
    });


    // edit jquery btn here

  $(document).ready(function() {
    $('body').on('click', '.edit', function() {
        let id = $(this).data('id');
        $.get("/brand/edit/"+id,function(data){
           $('#modal_body').html(data);
        });
      });
  });

      
    

</script>

@endsection('main_content')