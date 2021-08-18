@extends('layouts.vertical', ['title' => 'Add Admin'])
@section('css')
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add Admin</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ url('admin/admins')}}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="POST">
      <input type="hidden" name="roles" value="super_admin">
        <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
          <div class="form-group">
            <label for="exampleInputEmail1">Email address*</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="exampleInputEmail1" placeholder="Enter email" required="">
            @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="name">Name*</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name" placeholder="name" required="">
            @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="password">Password*</label>
            <input type="password" name="password" class="form-control"  id="password" required="" placeholder="password" autocomplete="new-password">
            @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="password_confirmation">Confirm Password*</label>
            <input type="password" name="confirm-password" class="form-control" required="" id="password_confirmation" placeholder="password confirmation" autocomplete="new-password">
            @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" id="phone" placeholder="phone">
            @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="photo">Profile Photo</label>
            <input type="file" name="photo" class="form-control" value="{{ old('photo') }}" id="photo" placeholder="photo" accept="image/*">
            @if ($errors->has('photo'))
                    <span class="text-danger">{{ $errors->first('photo') }}</span>
            @endif
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
  </div>
   @endsection
@section('script')
@endsection