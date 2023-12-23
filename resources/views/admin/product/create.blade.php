@extends('layouts.admin')
@section('main_content')

<div class="content-wrapper" style="min-height: 1302.4px;">
    <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
       <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary mt-3 rounded-0">
              <div class="card-header rounded-0">
                <h3 class="card-title">Add New Products</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <!-- start row one -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="product_name">Product Name</label>
                          <input type="text" class="form-control rounded-0" name="product_name" placeholder="Product Name">
                      </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="product_code">Product Code</label>
                          <input type="text" class="form-control rounded-0" name="product_code" placeholder="Product Name">
                      </div>
                    </div>  
                  </div>
                  <!-- end row one -->

                  <!-- start row two -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="product_name">Category/Subcategory</label>
                          <select class="form-control rounded-0" id="subcategory_id" name="subcategory_id">
                            <option disabled="" selected="">--Choose Category--</option>
                            @foreach($category as $row)
                                @php
                                  $subcategory = DB::table('subcategories')->where('category_id', $row->id)->get();
                                @endphp
                                  <option value="{{ $row->id }}" disabled="" style="color:blue;">{{ $row->category_name }}</option>
                                  @foreach($subcategory as $row)
                                  <option value="{{ $row->id }}">{{ $row->subcategory_name }}</option>
                                  @endforeach
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="child_category">Child Category</label>
                          <select name="childcategory_id" class="form-control" id="childcategory_id">
                            @foreach($childcategory as $row)
                              <option value="{{$row->childcategory_name}}">{{$row->childcategory_name}}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row two -->

                  <!-- start row three -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group rounded-0">
                          <label for="brand_id">Brand <span class="text-danger">*</span></label>
                          <select class="form-control rounded-0" name="brand_id">
                            @foreach($brand as $row)
                              <option value="{{ $row->brand_name }}">{{ $row->brand_name }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                      <div class="form-group rounded-0">
                          <label for="pickup_point_id">Pickup Point</label>
                          <select name="pickup_point_id" class="form-control rounded-0">
                            @foreach($pickuppoint as $row)
                              <option value="{{$row->pickup_point_name}}" class="rounded-0">{{$row->pickup_point_name}}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row three -->

                  <!-- start row foure -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="unit">Unit <span class="text-danger">*</span></label>
                          <select class="form-control rounded-0" name="unit">
                              <option value=""></option>
                          </select>
                      </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="tags">Tags</label>
                          <input type="text" class="form-control rounded" data-role="tagsinput" multiple name="tags" required>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row foure -->

                  <!-- start row five -->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="tag">Purchase Price</label>
                          <input type="text" class="form-control rounded-0" name="tag">
                      </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="tag">Selling Price <span class="text-danger">*</span></label>
                          <input type="text" class="form-control rounded-0" name="tag">
                      </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="tag">Discount Price</label>
                          <input type="text" class="form-control" name="tag">
                      </div>
                    </div>
                  </div>
                  <!-- end row five -->
                
                  <!-- start row six -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="product_name">Warehouse <span class="text-danger">*</span></label>
                          <select class="form-control rounded-0" name="brand_id">
                            @foreach($warehouse as $row)
                              <option value="{{ $row->warehouse_name }}">{{ $row->warehouse_name }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="tag">Stock</label>
                          <input type="text" class="form-control rounded-0" name="tag">
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row six -->

                  <!-- start row seven -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="product_name">Color <span class="text-danger">*</span></label>
                          <input type="text" class="form-control rounded-0" name="color">
                      </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="tag">Size</label>
                          <input type="text" class="form-control rounded-0" name="tag">
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row seven -->

                  <!-- start row eight -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="product_name">Product Details <span class="text-danger">*</span></label>
                          <textarea id="summernote" name="description" class="form-control bg-white rounded-0">
                          </textarea>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row eight -->

                  <!-- start row eight -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="product_name">Video Embed Code </label>
                          <textarea class="form-control rounded-0" name="video" row="10" cols="20">
                          </textarea>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row eight -->
                  <button type="submit" class="btn btn-primary rounded-0">Submit</button>
                </div>
                <!-- end card body -->
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
          <div class="col-md-4">
            <!-- Form Element sizes -->
            <div class="card card-success mt-3 rounded-0">
              <div class="card-body">
                <div class="form-group">
                  <label for="">Main Thumbnail <span class="text-danger">*</span></label>
                  <input type="file" name="thumbnail" class="form-control rounded-0 dropify">
                </div>
                <label for="">More Images</label>
                <div class="form-group d-flex">
                  <input type="text" name="images" class="form-control rounded-0">
                  <span><button class="btn btn-primary rounded-0" button-type="btan ">Add</button></span>
                </div>
              </div>
              <!-- end /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-light rounded-0">
              <div class="card-body">
                <div class="form-group">
                  <h6 for="featured_product">Featured Product</h6>
                  <input type="checkbox" name="featured" class="radius-0" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                </div>
              </div>
            </div>
            <!-- /.card -->
            <div class="card card-light rounded-0">
              <div class="card-body">
                <div class="form-group">
                  <h6 for="featured_product">Today Deal</h6>
                  <input type="checkbox" name="today_deal" class="rounded-0" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                </div>
              </div>
            </div>
            <!-- /.card -->
            <div class="card card-light rounded-0">
              <div class="card-body">
                <div class="form-group">
                  <h6 for="featured_product">Status</h6>
                  <input type="checkbox" name="status" class="rounded-0" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
       </form>
      </div><!-- /.container-fluid -->
   </section>
    <!-- /.content -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
  $(document).ready(function(){
    $('#subcategory_id').change(function(){
        var id = $(this).val();
        $.ajax({
          url:"{{ url("/get-child-category/") }}/"+id,
          type:'get',
          success:function(data){
            $('select[name="childcategory_id"]').empty();
            $.each(data, function(key, data){
              $('select[name="childcategory_id"]').append('<option value="'+data.id+'">' + data.childcategory_name + '</option>');
            });
          }
        });
    });
  });
</script>


@endsection('end_main')




