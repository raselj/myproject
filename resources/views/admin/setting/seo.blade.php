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
              <li class="breadcrumb-item active">OnPage SEO.</li>
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
                <h3 class="card-title">Your SEO Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('seo.setting.update', $data->id) }}" method="post" autocomplete="on">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" value="{{$data->meta_title}}" class="form-control @error('meta_title') is-invalid @enderror" autocomplete="meta_title" id="meta_title" placeholder="Meta Title">
                  </div>
                  <div class="form-group">
                    <label for="meta_author">Meta Title</label>
                    <input type="text" name="meta_author" value="{{$data->meta_author}}" class="form-control @error('meta_author') is-invalid @enderror" autocomplete="meta_author" id="meta_author" placeholder="Meta Author">
                  </div>
                  <div class="form-group">
                    <label for="meta_tag">Meta Tags</label>
                    <input type="text" name="meta_tag" value="{{$data->meta_tag}}" class="form-control @error('meta_tag') is-invalid @enderror" autocomplete="meta_author" id="meta_tag" placeholder="Meta Tag">
                  </div>
                  <div class="form-group">
                    <label for="meta_keyword">Meta Keyword</label>
                    <input type="text" name="meta_keyword" value="{{$data->meta_keyword}}" class="form-control @error('meta_keyword') is-invalid @enderror" autocomplete="meta_keyword" id="meta_keyword" placeholder="Meta Keyword">
                    <small>Example: Ecommerce Online Shop, Online Market.</small>
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="description" class="form-control @error('meta_description') is-invalid @enderror" cols="30" rows="5">{{$data->meta_description}}</textarea>
                    <small>Example: Ecommerce Online Shop, Online Market.</small>
                  </div>
                  <strong class="text-center"> ---Others--- </strong><br>
                  <div class="form-group">
                    <label for="google_verification">Google Verification</label>
                    <input type="text" name="google_verification" value="{{$data->google_verification}}" class="form-control @error('google_verification') is-invalid @enderror" autocomplete="google_verification" id="google_verification" placeholder="Google Verification">
                    <small>Put here google verification code.</small>
                 </div>
                 <div class="form-group">
                    <label for="alexa_verification">Alexa Verification</label>
                    <input type="text" name="alexa_verification" value="{{$data->alexa_verification}}" class="form-control @error('alexa_verification') is-invalid @enderror" autocomplete="alexa_verification" id="alexa_verification" placeholder="Alexa Verification">
                    <small>Put here google verification code.</small>
                 </div>
                  <div class="form-group">
                    <label for="google_analytics">Google Analytics</label>
                    <textarea name="google_analytics" id="google_analytics" class="form-control @error('google_analytics') is-invalid @enderror" cols="30" rows="5">{{$data->google_analytics}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="google_adsense">Google Adsense</label>
                    <textarea name="google_adsense" id="google_adsense" class="form-control @error('google_adsense') is-invalid @enderror" cols="30" rows="5">{{$data->google_adsense}}</textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Seo</button>
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