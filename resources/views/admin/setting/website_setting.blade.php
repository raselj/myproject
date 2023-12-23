@extends('layouts.admin')
@section('main_content')

<div class="content-wrapper" style="min-height: 1345.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Website Setting</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary card-outline">
              <div class="card-header rounded-0">
                <h3 class="card-title">Your Website Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('websupdate.setting', $setting->id)}}" method="post" autocomplete="on" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="currency">Currency</label>
                    <select name="currency" class="form-control">
                        <option value="৳" {{ ($setting->currency == '৳') ? 'selected': '' }}>Taka</option>
                        <option value="$" {{ ($setting->currency == '$') ? 'selected': '' }}>USD</option>
                        <option value="₹" {{ ($setting->currency == '₹') ? 'selected': '' }}>Rupee</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="phoneone">Phone One</label>
                    <input type="text" name="phoneone" value="{{$setting->phoneone}}" class="form-control @error('phoneone') is-invalid @enderror" autocomplete="phoneone" id="phoneone" placeholder="Phone one" require>
                  </div>
                  <div class="form-group">
                    <label for="phonetwo">Phone Two</label>
                    <input type="text" name="phonetwo" value="{{$setting->phonetwo}}" class="form-control @error('phonetwo') is-invalid @enderror" autocomplete="phonetwo" id="phonetwo" placeholder="Phone Two" require>
                  </div>
                  <div class="form-group">
                    <label for="main_email">Mail Email</label>
                    <input type="email" name="main_email" value="{{$setting->main_email}}" class="form-control @error('main_email') is-invalid @enderror" autocomplete="main_email" id="main_email" placeholder="Mail Email" require>
                  </div>
                  <div class="form-group">
                    <label for="support_email">Support Email</label>
                    <input type="email" name="support_email" value="{{$setting->support_email}}" class="form-control @error('support_email') is-invalid @enderror" autocomplete="support_email" id="support_email" placeholder="Support Email" require>
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" value="{{$setting->address}}" class="form-control @error('address') is-invalid @enderror" autocomplete="address" id="address" placeholder="Your Address" require>
                  </div>

                  <strong class="text-info">Social Link</strong><br>

                  <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" value="{{$setting->facebook}}" class="form-control @error('facebook') is-invalid @enderror" autocomplete="facebook">
                  </div>
                  <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" name="twitter" value="{{$setting->twitter}}" class="form-control @error('twitter') is-invalid @enderror" autocomplete="twitter">
                  </div>
                  <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" value="{{$setting->instagram}}" class="form-control @error('instagram') is-invalid @enderror" autocomplete="instagram">
                  </div>
                  <div class="form-group">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" name="linkedin" value="{{$setting->linkedin}}" class="form-control @error('linkedin') is-invalid @enderror" autocomplete="linkedin">
                  </div>
                  <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <input type="text" name="youtube" value="{{$setting->youtube}}" class="form-control @error('youtube') is-invalid @enderror" autocomplete="youtube">
                  </div>

                  <strong class="text-info">Logo & Favicon</strong><br>

                  <div class="form-group">
                    <label for="logo">Main Logo</label>
                    <input type="file" name="logo" value="{{$setting->logo}}" class="form-control @error('logo') is-invalid @enderror">
                  </div>
                  <div class="form-group">
                    <label for="logo">Favicon</label>
                    <input type="file" name="favicon" value="{{$setting->favicon}}" class="form-control @error('favicon') is-invalid @enderror">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection('main_content')