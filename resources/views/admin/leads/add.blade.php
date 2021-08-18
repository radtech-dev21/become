@extends('layouts.vertical', ['title' =>'Add Lead'])
@section('css')
@endsection
@section('content')
@if(auth()->user()->hasRole('agents'))
    @php $route = 'agent'; @endphp
@else
    @php $route = 'admin'; @endphp
@endif
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add Lead</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ url($route.'/leads')}}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="POST">
      <input type="hidden" name="roles" value="leads">
        <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
          <div class="form-group col-lg-6">
                <label class="form-label">Company</label>
                <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" id="company_name" placeholder="Company">
                @if ($errors->has('company_name'))
                <span class="text-danger">{{ $errors->first('company_name') }}</span>
                @endif
          </div>
          <div class="form-group col-lg-6">
            <label for="name">Name*</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name" placeholder="name" required="">
            @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="form-group col-lg-6">
              <label for="phone">Phone</label>
              <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" id="phone" placeholder="phone">
              @if ($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
              @endif
          </div>
          <div class="form-group col-lg-6">
            <label for="exampleInputEmail1">Email address*</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="exampleInputEmail1" placeholder="Enter email" required="">
            @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="form-group col-lg-6">
                <label class="example-select">State</label> <br>
                <select class="form-control" name="state">
                  <option value="">Select State</option>
                  @foreach($state_list as $k => $state)
                  <option value="{{$state}}">{{$state}}</option>
                  @endforeach
                </select>
          </div>
          <div class="form-group col-lg-6">
                <label for="phone">Amount</label>
                <input type="number" name="lenders" class="form-control" value="{{ old('lenders') }}" id="lenders" required="" placeholder="Amount">
                @if ($errors->has('lenders'))
                  <span class="text-danger">{{ $errors->first('lenders') }}</span>
                @endif
          </div>
          <div class="form-group col-lg-6">
              <label class="example-select">Agent</label> <br>
              <select  class="form-control" name="agent_id">
                <option value=""></option>
                @foreach($agents as $k => $agent)
                <option  value="{{ $agent->id }}">{{ $agent->name }}</option>
                @endforeach
              </select>
          </div>
          <!-- <div class="form-group">
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
          </div> -->
          <div class="form-group col-lg-6">
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