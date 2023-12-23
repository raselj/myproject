<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<form action="{{route('brand.update')}}" method="post" autofocus autocomplete="on" enctype="multipart/form-data">
         @csrf
         @method('PUT')
        <div class="modal-body">
            <div class="form-group">
                <label for="brand_name">Brand Name</label>
                <input type="text" class="form-control" value="{{$data->brand_name}}" name="brand_name" placeholder="Brand Name">
            </div>
            <input type="hidden" name="id" value="{{$data->id}}">
            <div class="form-group">
                <label for="brand_logo">Brand Logo</label>
                <input type="file" class="form-control dropify" name="brand_logo" multiple>
                <input type="hidden" name="olf_logo" value="{{ $data->brand_logo}}">
            </div>
            @error('category_name')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger rounded-0" data-dismiss="modal">Close</button>
            <button class="btn btn-success update rounded-0" type="submit">Update</button>
        </div>
  <!-- /.modal-content -->
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<!-- dropify js here -->
<script>
  $(document).ready(function(){
    $('.dropify').dropify();
  });
</script>
