@extends('layouts.vertical', ['title' => 'Update Status'])

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Status</li>
                    </ol>
                </div>
                <h4 class="page-title">Update Status</h4>
            </div>
        </div>
    </div>  

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <form method="post" action="{{ route('status.update',$status->id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input required="" id="name" type="text" value="{{ $status->name }}" name="name" class="form-control col-lg-4 col-lg-offset-4">
                                @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="color_code">Color Code</label>
                                <input required="" id="color_code" type="color" value="{{ $status->color_code }}" name="color_code" class="form-control col-lg-4 col-lg-offset-4">
                                @if ($errors->has('color_code'))
                                        <span class="text-danger">{{ $errors->first('color_code') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection