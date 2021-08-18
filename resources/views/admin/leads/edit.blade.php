@extends('layouts.vertical', ['title' =>'Edit'])
@section('css')
@endsection
@section('content')
@if(auth()->user()->hasRole('agents'))
    @php $route = 'agent'; @endphp
@else
    @php $route = 'admin'; @endphp
@endif
<div class="container-fluid">
<!-- start page title -->
  <div class="row">
      <div class="col-12">
          <div class="page-title-box">
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                      <li class="breadcrumb-item">Leads</li>
                      <li class="breadcrumb-item active">Update Lead</li>
                  </ol>
              </div>
              <h4 class="page-title">Update Lead</h4>
          </div>
      </div>
  </div>  
<div class="card card-primary">
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ url($route.'/leads/'.$user->id)}}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="roles" value="leads">
        <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="form-group col-lg-6">
              <label class="form-label">Company</label>
              <input type="text" name="company_name" class="form-control" value="{{ old('company_name') ?? $user->company_name }}" id="company_name" placeholder="Company">
              @if ($errors->has('company_name'))
              <span class="text-danger">{{ $errors->first('company_name') }}</span>
              @endif
          </div>
          <div class="form-group col-lg-6">
            <label for="name">Name*</label>
            <input type="text" name="name" class="form-control" value="{{ old('name')??$user->name }}" id="name" placeholder="name" required="">
            @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="form-group col-lg-6">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') ?? $user->phone }}" id="phone" placeholder="phone">
                @if ($errors->has('phone'))
                  <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
          </div>
          <div class="form-group col-lg-6">
            <label for="exampleInputEmail1">Email address*</label>
            <input type="email" class="form-control" name="email" value="{{ old('email')??$user->email }}" required="" id="exampleInputEmail1" placeholder="Enter email" required="">
            @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="form-group col-lg-6">
              <label class="example-select">State</label> <br>
              <select required="" class="form-control" name="state">
                <option value=""></option>
                @foreach($state_list as $k => $state)
                <option {{ ($user->state==$state)?"selected":"" }} value="{{$state}}">{{$state}}</option>
                @endforeach
              </select>
          </div>
            <div class="form-group col-lg-6">
                <label for="phone">Amount</label>
                <input type="number" name="lenders" class="form-control" value="{{ old('lenders') ??  $user->lenders}}" id="lenders" placeholder="Amount">
                @if ($errors->has('lender'))
                  <span class="text-danger">{{ $errors->first('lenders') }}</span>
                @endif
            </div>
          <!-- <div class="form-group">
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
          </div> -->
          <div class="form-group col-lg-6">
              <label class="example-select">Agent</label> <br>
              <select  class="form-control" name="agent_id">
                <option value=""></option>
                @foreach($agents as $k => $agent)
                <option {{ ($user->application && $user->application->agent_id==$agent->id)?"selected":"" }} value="{{ $agent->id }}">{{ $agent->name }}</option>
                @endforeach
              </select>
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