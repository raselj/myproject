<form action="{{route('subcategory.update')}}" method="post">
         @csrf
         @method('PUT')
        <div class="modal-body">
            <div class="form-group">
            <label for="category_name">Category Name</label>
            <select class="form-control" name="category_name" id="mySelect" require="">
                @foreach($category as $row)
                <option value="{{ $row->id }}" @if($row->id==$data->category_id) selected="" @endif style="font-weight:400;">{{ $row->category_name }}</option>
                @endforeach
            </select>
            <input type="hidden" id="subcat_id" name="id" value="{{$data->id}}">
            </div>
            <div class="form-group">
            <label for="subcategory_name">Sub-Category Name</label>
            <input type="text" value="{{$data->subcategory_name}}" class="form-control @error('subcategory_name') is-invalid @enderror" id="subcategory_name" name="subcategory_name" required autocomplete="subcategory_name" autofocus placeholder="Sub Category Name">
            </div>
            @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger rounded-0" data-dismiss="modal">Close</button>
            <button class="btn btn-success update rounded-0" type="submit">Update</button>
        </div>
  <!-- /.modal-content -->
</form>