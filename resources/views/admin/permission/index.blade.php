@extends('layouts.vertical', ['title' => 'Leads'])

@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

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
                <h4 class="page-title">Available Permissions</h4>
            </div>
        </div>
    </div>  

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ route('permissions.create') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Permission</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="scroll-horizontal-datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Permissions</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $k=>$permission)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $permission->name }}</td> 
                                    <td>
                                    <ul style="padding: initial;">
                                        <li data-toggle="tooltip" title="Reject" style="display:inline-block;">
                                            <a href="{{ URL::to('admin/permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left"><i class="fa fa-edit"></i></a>
                                        </li>
                                        <li data-toggle="tooltip" title="Delete" style="display:inline-block;"><a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-danger pull-left"><i class="fa fa-ban"></i></a>
                                        </li>
                                    </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    <!-- <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Add Permission</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<!-- third party js ends -->

<!-- Datatables init -->
<script src="{{asset('assets/js/pages/customers.init.js')}}"></script>
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
