<form action="{{route('childcategory.update')}}" method="post">
         @csrf
         @method('PUT')
        <div class="modal-body">
            <div class="form-group">
            <label for="category_name">Sub Category Name</label>
            <select class="form-control" name="subcategory_id" require="">
              @foreach($category as $row)
                @php
                  $subcat = DB::table('subcategories')->where('category_id', $row->id)->get();
                @endphp
                <option style="font-weight:700;">{{$row->category_name}}</option>
                @foreach($subcat as $row)
                <option value="{{ $row->id }}" @if($row->id==$data->subcategory_id) selected="" @endif style="font-weight:400;">--{{ $row->subcategory_name }}--</option>
                @endforeach
              @endforeach
            </select>
            <input type="hidden" name="id" value="{{$data->id}}">
            </div>
            <div class="form-group">
            <label for="subcategory_name">Child Category Name</label>
            <input type="text" value="{{$data->childcategory_name}}" class="form-control @error('subcategory_name') is-invalid @enderror" id="childcategory_name" name="childcategory_name" required autocomplete="subcategory_name" autofocus placeholder="Sub Category Name">
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