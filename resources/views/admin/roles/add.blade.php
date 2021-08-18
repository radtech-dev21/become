@extends('layouts.vertical', ['title' => 'Add Role'])

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
                        <li class="breadcrumb-item active">Add Role</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Role</h4>
            </div>
        </div>
    </div>  

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <form method="post" action="{{ url('admin/roles') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input required="" value="{{ old('name') }}" id="name" type="text" name="name" class="form-control col-lg-4 col-lg-offset-4">
                                @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <label>Assign Permissions</label>
                            @foreach ($permissions as $permission)
                                <div class="form-group">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                <label>{{ ucfirst($permission->name) }}</label>
                                </div> 
                            @endforeach
                            @if ($errors->has('permissions'))
                                    <span class="text-danger">{{ $errors->first('permissions') }}</span>
                            @endif
                            <div class="form-group">
                                <button class="btn btn-info" type="submit">Add</button>
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