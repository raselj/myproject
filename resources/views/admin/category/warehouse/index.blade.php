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
      <form action="{{route('warehouse.store')}}" method="post" autofocus autocomplete="on" id="addform" >
        @csrf
         <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Warehouse list</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="category_name">Warehouse Name</label>
                    <input type="text" value="" class="form-control @error('warehouse_name') is-invalid @enderror" id="warehouse_name" name="warehouse_name"  required autocomplete="warehouse_name" placeholder="Warehouse Name">
                  </div>
                  <div class="form-group">
                    <label for="warehouse_address">Warehouse Address</label>
                    <input type="text" value="" class="form-control @error('warehouse_address') is-invalid @enderror" id="warehouse_address" name="warehouse_address"  required autocomplete="warehouse_address" placeholder="warehouse Address">
                  </div>
                  <div class="form-group">
                    <label for="warehouse_phone">Warehouse Phone</label>
                    <input type="text" value="" class="form-control @error('warehouse_phone') is-invalid @enderror" id="warehouse_phone" name="warehouse_phone"  required autocomplete="warehouse_phone" placeholder="Warehouse Phone">
                  </div>
                  @error('warehouse_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger text-center rounded-0" data-dismiss="modal">Close</button>
                <button class="btn btn-success rounded-0  subbtn update" type="submit"><span class="d-none loader"><i class="fa fa-spinner"></i>...</span><span class="wsubbtn">Submit</span></button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </form>
    </div>
    <!-- end data insert modal -->

    <!-- start data edit modal -->
    <div class="modal fade" id="ware-edit">
      
       <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Update Warehouse</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal_body">
                
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
                <h3 class="card-title">All warehouse list.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped data-tables">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Warehouse Name</th>
                    <th>Warehouse Address</th>
                    <th>Warehouse Phone</th>
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

<script>
   // on click edit data
   $(document).ready(function() {
   $('body').on('click', '.wedit', function() {

      var wareid = $(this).data('id');
      $.get("/warehouse/edit/" + wareid,function(data){
         $('.modal_body').html(data);
      });

      });
   });
</script>

<script>


  // ytable data load
  $(function () {
      
    var table = $('.data-tables').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('warehouse.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'warehouse_name', name: 'warehouse_name'},
              {data: 'warehouse_address', name: 'warehouse_address'},
              {data: 'warehouse_phone', name: 'warehouse_phone'},
              {data: 'action', name: 'action', orderable: true, searchable: true},
          ]
      });
    
  });
    
   // onsubmit loader button
   $(document).ready(function() {
    $('#addform').on('submit', function() {

        $('.loader').removeClass('d-none');
        $('.wsubbtn').addClass('d-none');

      });
  });

  
</script>

@endsection('main_content')