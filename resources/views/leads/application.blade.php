@extends('layouts.vertical', ['title' => 'Application'])
@section('css')
<style type="text/css">
   .form-application .inner-addon .form-control, .form-application .select2-container--default .select2-selection--single, .form-application .inner-addon textarea {
    position: relative;
    top: 0;
    left: 0;
    z-index: 1;
    height: 44px;
    padding: 8px 25px 8px 25px;
    font-size: 14px;
    line-height: 1.45;
    border: 0px;
    box-shadow: none;
    border-radius: 45px;
    background: #ECF0F5;
    -webkit-appearance: none;
}
</style>
@endsection
@section('content')
<div class="card card-primary form-application">
   <div class="card-header">
      <h3 class="card-title">Your Application Details</h3>
   </div>
   <!-- /.card-header -->
   <!-- form start -->
   <form role="form" action="{{ url('leads/application')}}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="POST">
      <input type="hidden" name="loan_id" value="{{ ($application)?$application->id:'' }}">
      <div class="card-body inner-addon">
         @if (session('success'))
         <div class="alert alert-success">
            {{ session('success') }}
         </div>
         @endif
         @if (session('error'))
         <div class="alert alert-danger">
            {{ session('error') }}
         </div>
         @endif
         <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-6 col-lg-offset-2 border">
               @include('application',['application' =>$application])
            </div>
         </div>
      </div>
   </form>
</div>
@endsection
@section('script')
@endsection