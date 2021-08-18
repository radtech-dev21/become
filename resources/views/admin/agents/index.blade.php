@extends('layouts.vertical', ['title' => 'Agents'])

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
                        <li class="breadcrumb-item active">Agents</li>
                    </ol>
                </div>
                <h4 class="page-title">Agents</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ url('admin/agents/create')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Agent</a>
                        </div>
                        <div class="col-sm-8">
                            <!-- <div class="text-sm-right">
                                <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-cog"></i></button>
                                <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                                <button type="button" class="btn btn-light mb-2">Export</button>
                            </div> -->
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered table-striped dt-responsive nowrap w-100" id="scroll-horizontal-datatable">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">
                                        ID
                                    </th>
                                    <th>Agent Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Last Updated</th>
                                    <th style="width: 75px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $k=>$user)
                                <tr>
                                    <td>
                                        {{ $k + 1}}
                                    </td>
                                    <td class="table-user">
                                        <img src="{{ $user->profile_photo_url }}" alt="table-user" class="mr-2 rounded-circle">
                                        <a href="{{ url('admin/agents').'/'. $user->id }}" class="text-body font-weight-semibold">{{ $user->name }}</a>
                                    </td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->updated_at }} 
                                        <!-- <small class="text-muted">10:29 PM</small> -->
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/agents/'.$user->id.'/edit')}}
" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    
</div> <!-- container -->
@endsection
@section('script')
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js')}}"></script>
<!-- third party js ends -->

<!-- Datatables init -->
<script src="{{asset('assets/js/pages/customers.init.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
         var dataTable = $('#scroll-horizontal-datatable').DataTable({});
    });
</script>
@endsection