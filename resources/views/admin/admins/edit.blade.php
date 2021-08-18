@extends('layouts.vertical', ['title' =>'Edit'])
@section('css')
@endsection
@section('content')
<div class="container-fluid">
<!-- start page title -->
  <div class="row">
      <div class="col-12">
          <div class="page-title-box">
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ url('admin/admins') }}}">Admins</a></li>
                      <li class="breadcrumb-item active">Update Admin</li>
                  </ol>
              </div>
              <h4 class="page-title">Update Admin</h4>
          </div>
      </div>
  </div>  
<div class="card card-primary">
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ url('admin/admins/'.$user->id)}}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="roles" value="admins">
        <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
          <div class="form-group">
            <label for="exampleInputEmail1">Email address*</label>
            <input type="email" class="form-control" name="email" value="{{ old('email')??$user->email }}" id="exampleInputEmail1" placeholder="Enter email" required="">
            @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="name">Name*</label>
            <input type="text" name="name" class="form-control" value="{{ old('name')??$user->name }}" id="name" placeholder="name" required="">
            @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control"  id="password"  placeholder="password" autocomplete="new-password" >
            @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="confirm-password" class="form-control"  id="password_confirmation" placeholder="password confirmation" autocomplete="new-password">
            @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone')??$user->phone }}" id="phone" placeholder="phone">
            @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="photo">Profile Photo</label>
            <input type="file" name="photo" class="form-control" value="" id="photo" placeholder="photo" accept="image/*">
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
</div>
   @endsection
@section('script')
@endsection