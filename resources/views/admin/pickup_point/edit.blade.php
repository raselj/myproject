<form action="{{route('pickup_point.update')}}" method="post" id="pickup_edit_form" autocomplete="on">
    @csrf
    @method("PUT")
        <div class="modal-body">
            <div class="form-group">
                <label for="cupon_code">Pickup Point Name</label>
                <input type="text" class="form-control @error('pickup_point_name') is-invalid @enderror" name="pickup_point_name" value="{{$pickup->pickup_point_name}}" required autocomplete="pickup_point_name" placeholder="Enter Pickup Point Name">
            </div>
            <div class="form-group">
                <label for="coupon_amount">Pickup Point Address</label>
                <input type="text" class="form-control" name="pickup_point_address" value="{{$pickup->pickup_point_address}}" autocomplete="pickup_point_address" required placeholder="Enter Pickup Point Address">
            </div>
            <div class="form-group">
                <label for="pickup_point_phone">Pickup Point Phone</label>
                <input type="text" class="form-control @error('pickup_point_phone') is-invalid @enderror" name="pickup_point_phone" value="{{$pickup->pickup_point_phone}}"  required autocomplete="pickup_point_phone" placeholder="Enter Pickup Point Phone">
            </div>
            <div class="form-group">
                <label for="pickup_point_phone_two">Another Pickup Point Phone</label>
                <input type="text" class="form-control @error('pickup_point_phone_two') is-invalid @enderror" name="pickup_point_phone_two" value="{{$pickup->pickup_point_phone_two}}"  required autocomplete="pickup_point_phone_two" placeholder="Enter another pickup point phone">
            </div>
            <input type="hidden" name="id" value="{{$pickup->id}}">
            @error('valid_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger text-center rounded-0" data-dismiss="modal">Close</button>
            <button class="btn btn-success rounded-0 update" type="submit"><span class="d-none">Loading..</span>Update</button>
        </div>
</form>