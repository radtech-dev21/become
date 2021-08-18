@extends('layouts.vertical', ['title' => 'Create Permission'])

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
                        <li class="breadcrumb-item active">Leads</li>
                    </ol>
                </div>
                <h4 class="page-title">Update Permissions</h4>
            </div>
        </div>
    </div>  

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <form method="post" action="{{ route('permissions.update',$permission->id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input required="" id="name" type="text" value="{{ $permission->name }}" name="name" class="form-control col-lg-4 col-lg-offset-4">
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