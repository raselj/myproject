@extends('layouts.app')
@section('main')


<div class="container">
    <div class="col-md-6 m-auto" style="margin-top:35px !important;">
        <div class="card">
            <div class="card-head pt-3"><h4 style="text-align:center;">Reset Password.</h4></div>
            <div class="card-body">
            @if (session('status') == true)
            <p class="alert alert-success" role="alert success">
                We already send reset password link by email.
            </p>
            @endif
            <form action="{{ route('password.request')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" placeholder="Enter email" id="email" name="email">
                </div>
                <button type="submit" class="btn btn-primary" name="reset" id="reset">Reset Password.</button>
            </form>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection('main')