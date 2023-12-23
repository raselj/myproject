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
            <button type="button" class="btn btn-success rounded-0 text-align-right" data-toggle="modal" data-target="#pickup_addmodal">
              +Add New
            </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- start data insert modal -->
    <div class="modal fade" id="pickup_addmodal">
      <form action="{{ route('pickup_point.store') }}" method="post" id="pickup_add_form" autocomplete="on">
         @csrf
         <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add New Pickup Point</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="cupon_code">Pickup Point Name</label>
                    <input type="text" class="form-control @error('pickup_point_name') is-invalid @enderror" name="pickup_point_name" required autocomplete="pickup_point_name" placeholder="Enter Pickup Point Name">
                  </div>
                  <div class="form-group">
                     <label for="coupon_amount">Pickup Point Address</label>
                     <input type="text" class="form-control" name="pickup_point_address" autocomplete="pickup_point_address" required placeholder="Enter Pickup Point Address">
                  </div>
                  <div class="form-group">
                    <label for="pickup_point_phone">Pickup Point Phone</label>
                    <input type="text" class="form-control @error('pickup_point_phone') is-invalid @enderror" name="pickup_point_phone"  required autocomplete="pickup_point_phone" placeholder="Enter Pickup Point Phone">
                  </div>
                  <div class="form-group">
                    <label for="pickup_point_phone_two">Another Pickup Point Phone</label>
                    <input type="text" class="form-control @error('pickup_point_phone_two') is-invalid @enderror" name="pickup_point_phone_two"  required autocomplete="pickup_point_phone_two" placeholder="Enter another pickup point phone">
                  </div>
                  @error('valid_date')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger text-center rounded-0" data-dismiss="modal">Close</button>
                <button class="btn btn-success rounded-0 update" type="submit"><span class="d-none">Loading..</span>Submit</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </form>
    </div>
    <!-- end data insert modal -->

    <!-- start data edit modal -->
    <div class="modal fade" id="pickupedit">
      
       <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Update Coupon</h4>
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
                <h3 class="card-title">All coupon list here.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped data-tables">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Pickup Point Name</th>
                    <th>Pickup Point Address</th>
                    <th>Pickup Point Phone</th>
                    <th>Pickup Point Phone Two</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>
                <form id="pickupform" method="delete">
                    @csrf
                    @method('DELETE')
                </form>
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


$(function () {
      
      // start ytable function
      var table = $('.data-tables').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('pickup_point.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'pickup_point_name', name: 'pickup_point_name'},
              {data: 'pickup_point_address', name: 'pickup_point_address'},
              {data: 'pickup_point_phone', name: 'pickup_point_phone'},
              {data: 'pickup_point_phone_two', name: 'pickup_point_phone_two'},
              {data: 'action', name: 'action', orderable: true, searchable: true},
          ]
      });
      // end ytable function

      //start pickup point insert data by ajax
      $(document).on('submit', '#pickup_add_form', function(e){
          e.preventDefault();
        
          var url = $(this).attr('action');
          var request = $(this).serialize();
          $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
                $('#pickup_add_form')[0].reset();
                table.ajax.reload();
                $('#pickup_addmodal').hide();
                $('.modal-backdrop').hide();
            }
          })
        });
        // end pickup point insert data by ajax

      //start pickup point update data by ajax
      $(document).on('submit', '#pickup_edit_form', function(e){
          e.preventDefault();
        
          var url = $(this).attr('action');
          var request = $(this).serialize();
          $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
                $('#pickup_edit_form')[0].reset();
                table.ajax.reload();
                $('#pickupedit').hide();
                $('.modal-backdrop').hide();
            }
          })
        });
        // end pickup point update data by ajax

        // start delete pickup data by ajax
      $(document).on('click', '#delete_pickup', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $('#pickupform').attr('action', url);

        swal({
          title: "Are you sure?",
          text: "Do you want to delete",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete){
              $('#pickupform').submit();
              swal("Deleted successfully!", {
                  icon: "success",
              });
            }
            else {
            swal("Your data is safe!");
          }
        });
        
      })

      // data passed jquery
      $(document).on('submit', '#pickupform', function(e){
          e.preventDefault();

          var url = $(this).attr('action');
          var request = $(this).serialize();
          $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
                $('#pickupform')[0].reset();
                table.ajax.reload();
            }
          })
        });
      // end delete pickup data by ajax

      // start update function
      $(document).on('click', '.edit', function(){
          let pickup_id = $(this).data('id');
          $.get("/pickups/edit/" + pickup_id,function(data){
            $('#modal_body').html(data);
          })
        });
      // end update function
    


        
});


     
    
  </script>

@endsection('main_content')