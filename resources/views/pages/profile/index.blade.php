@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-5 col-md-offset-1">
    <div class="box box-primary">
      <div class="box-body box-profile">
        @if (!Auth::user()->avatar)
        <img src="{{ asset('/img/user-160x160.jpg')}}" class="profile-user-img img-responsive img-circle" style="width:150px; height:150px">
        @else
        <img src="{{ asset('/storage/avatars/' . Auth::user()->avatar . '')}}" class="profile-user-img img-responsive img-circle" style="width:150px; height:150px">
        @endif
        <h3 class="profile-username text-center">{{ $user->name }}</h3>
        <p class="text-muted text-center">Tester</p>
        <form action="/profile" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
            @foreach ($errors->all() as $error)
                <div style="color: red;">{{ $error }}</div>
            @endforeach
            <small id="fileHelp" class="form-text text-muted">Size of image should not be more than 2MB.</small>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Profile</h3>
      </div>
      <div class="box-body">
        <strong><i class="fa fa-user margin-r-5"></i> {{ $user->name }}</strong>

        <hr>

        <strong><i class="fa fa-envelope margin-r-5"></i> {{ $user->email }}</strong>

        <hr>

        <strong><i class="fa fa-calendar margin-r-5"></i> Created: {{ date( "F j, Y", strtotime($user->created_at)) }}</strong>

      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection
