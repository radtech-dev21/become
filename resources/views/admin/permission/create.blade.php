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
                <h4 class="page-title">Add Permissions</h4>
            </div>
        </div>
    </div>  

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <form method="post" action="{{ url('admin/permissions') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input required="" id="name" type="text" name="name" class="form-control col-lg-4 col-lg-offset-4">
                            </div>
                            @if(!$roles->isEmpty())
                                <label>Assign Permission to Roles</label>
                                @foreach ($roles as $role)
                                    <div class="form-group">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                                    <label>{{ $role->name }}</label>
                                    </div> 
                                @endforeach
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
<script type="text/javascript">
    $(document).ready(function() {
         var dataTable = $('#scroll-horizontal-datatable').DataTable({
            "autoFill": false,
            "scrollX": true,
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                }
            },
            "drawCallback": function () {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            },
            initComplete: function() {
                $(this.api().table().container()).find('input[type=search]').parent().wrap('<form>').parent().attr('autocomplete', 'off');
            }
        });
    });
</script>
@endsection