<form action="{{ route('coupon.update') }}" method="post" id="editform" autocomplete="on">
   @csrf
   @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="cupon_code">Coupon Code</label>
            <input type="text" class="form-control" name="coupon_code" value="{{ $data->coupon_code }}" required placeholder="Enter your coupon code">
        </div>
        <div class="form-group">
            <label for="coupon_type">Coupon Type</label>
            <select class="form-control" name="coupon_type" required>
            <option value="1" @if($data->coupon_type==1) selected @endif >Fixed</option>
            <option value="2" @if($data->coupon_type==2) selected @endif >Percentage</option>
            </select>
        </div>
        <div class="form-group">
            <label for="coupon_amount">Coupon Amount</label>
            <input type="text" class="form-control" name="coupon_amount" value="{{$data->coupon_amount}}" required autocomplete="coupon_amount" placeholder="Enter your coupon amount">
        </div>
        <div class="form-group">
            <label for="valid_date">Valid Date</label>
            <input type="date" class="form-control @error('valid_date') is-invalid @enderror" name="valid_date" value="{{$data->valid_date}}" required autocomplete="valid_date" placeholder="Enter your valid date">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status" required>
            <option value="Active" @if($data->status=='Active') selected @endif >Active</option>
            <option value="Pending" @if($data->status=='Pending') selected @endif >Pending</option>
            </select>
        </div>
        <input type="hidden" name="id" value="{{$data->id}}">
        @error('valid_date')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger text-center rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-success rounded-0 subbtn update" type="submit"><span class="d-none">Loading..</span>Update</button>
    </div>
</form>