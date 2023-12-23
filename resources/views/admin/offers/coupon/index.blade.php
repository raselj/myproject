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
            <button type="button" class="btn btn-success rounded-0 text-align-right" data-toggle="modal" data-target="#addmodal">
              +Add New
            </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- start data insert modal -->
    <div class="modal fade" id="addmodal">
      <form action="{{ route('coupon.store') }}" method="post" id="add_form" autocomplete="on">
        @csrf
         <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add New Coupon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="cupon_code">Coupon Code</label>
                    <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" name="coupon_code" required autocomplete="coupon_code" placeholder="Enter your coupon code">
                  </div>
                  <div class="form-group">
                    <label for="coupon_type">Coupon Type</label>
                    <select class="form-control" name="coupon_type" required>
                        <option value="1">Fixed</option>
                        <option value="2">Percentage</option>
                    </select>
                  </div>
                  <div class="form-group">
                     <label for="coupon_amount">Coupon Amount</label>
                     <input type="text" class="form-control" name="coupon_amount" autocomplete="coupon_amount" required placeholder="Enter your coupon amount">
                  </div>
                  <div class="form-group">
                    <label for="valid_date">Valid Date</label>
                    <input type="date" class="form-control @error('valid_date') is-invalid @enderror" name="valid_date"  required autocomplete="valid_date" placeholder="Enter your valid date">
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" required>
                        <option value="Active">Active</option>
                        <option value="Pending">Pending</option>
                    </select>
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
    <div class="modal fade" id="coupon_edit">
      
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
                    <th>Coupon Code</th>
                    <th>Coupon Amount</th>
                    <th>Coupon Type</th>
                    <th>Valid Date</th>
                    <th>Coupon Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>
                <form id="deleted_form" action="" method="delete">
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
          ajax: "{{ route('coupon.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'coupon_code', name: 'coupon_code'},
              {data: 'coupon_amount', name: 'coupon_amount'},
              {data: 'coupon_type', name: 'coupon_type'},
              {data: 'valid_date', name: 'valid_date'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: true, searchable: true},
          ]
      });
      // end ytable function

      // start delete coupon data by ajax
      $(document).on('click', '#delete_coupon', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $('#deleted_form').attr('action', url);

        var id = $(this).data('id');

        swal({
          title: "Are you sure?",
          text: "Do you want to delete",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete){
              $('#deleted_form').submit();
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
      $(document).on('submit', '#deleted_form', function(e){
          e.preventDefault();

          var url = $(this).attr('action');
          var request = $(this).serialize();
          $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
                $('#deleted_form')[0].reset();
                table.ajax.reload();
            }
          })
        });
      // end delete coupon data by ajax


      //start insert data by ajax
      $(document).on('submit', '#add_form', function(e){
          e.preventDefault();
          var url = $(this).attr('action');
          var request = $(this).serialize();
          $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
                $('#add_form')[0].reset();
                table.ajax.reload();
                $('#addmodal').hide();
                $('.modal-backdrop').hide();
            }
          })
        });
        // end insert data by ajax


      //start update data by ajax
      $(document).on('submit', '#editform', function(e){
          e.preventDefault();

          var url = $(this).attr('action');
          var request = $(this).serialize();
          $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
                $('#editform')[0].reset();
                table.ajax.reload();
                $('#coupon_edit').hide();
                $('.modal-backdrop').hide();
            }
          })

        // sweet alert
        swal({
          icon: "success",
          text: 'Updated successfully!'
        })

        });
        // end update data by ajax


        // start update function
        $(document).on('click', '.edit', function(){
          let coupon_id = $(this).data('id');
          $.get("/coupons/edit/" + coupon_id,function(data){
            $('#modal_body').html(data);
          })
        });
        // end update function
        
});




    // var edit = document.querySelectorAll('.edit');
    // edit.forEach(all => all.addEventListener("click", function() {

     
      
    
  </script>

@endsection('main_content')