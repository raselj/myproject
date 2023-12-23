<form action="{{ route('warehouse.update')}}" method="post" autocomplete="on">
         @csrf
         @method('PUT')
        <div class="modal-body">
            <div class="form-group">
              <label for="category_name">Warehouse Name</label>
              <input type="text" value="{{$warehouse->warehouse_name}}" class="form-control @error('warehouse_name') is-invalid @enderror" id="warehouse_name" name="warehouse_name"  required autocomplete="warehouse_name" placeholder="Warehouse Name">
            </div>
            <div class="form-group">
              <label for="warehouse_address">Warehouse Address</label>
              <input type="text" value="{{$warehouse->warehouse_address}}" class="form-control @error('warehouse_address') is-invalid @enderror" id="warehouse_address" name="warehouse_address"  required autocomplete="warehouse_address" placeholder="warehouse Address">
            </div>
            <div class="form-group">
              <label for="warehouse_phone">Warehouse Phone</label>
              <input type="text" value="{{$warehouse->warehouse_phone}}" class="form-control @error('warehouse_phone') is-invalid @enderror" id="warehouse_phone" name="warehouse_phone"  required autocomplete="warehouse_phone" placeholder="Warehouse Phone">
            </div>
            <input type="hidden" id="wareid" name="id" value="{{$warehouse->id}}">
            @error('warehouse_name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger rounded-0" data-dismiss="modal">Close</button>
            <button class="btn btn-success update rounded-0" type="submit">Update</button>
        </div>
</form>

