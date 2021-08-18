@extends('layouts.vertical', ['title' => 'New Leads'])

@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

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
                        <li class="breadcrumb-item active">New Leads</li>
                    </ol>
                </div>
                <h4 class="page-title">New Leads</h4>
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
                            <a href="{{ url($route.'/leads/create')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Lead</a>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-cog"></i></button>
                                <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                                <button type="button" class="btn btn-light mb-2">Export</button>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="scroll-horizontal-datatable">
                            <thead>
                                <tr>
                                    <th style="display: none;">user_id</th>
                                    <th>ID</th>
                                    <th>Company</th>
                                    <th>Owner</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>State</th>
                                    <th>Agent</th>
                                    <th>Amount</th>
                                    <th>Create Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $k=>$user)
                                <tr>
                                    <td style="display: none;">{{ $user->id }}</td>
                                    <td>
                                        {{ 1000 + ($k + 1) }}
                                    </td>
                                    <td>{{ $user->company_name }}</td>
                                    <td class="table-user">
                                        <img src="{{ $user->profile_photo_url }}" alt="table-user" class="mr-2 rounded-circle">
                                        <a href="{{ url($route.'/leads').'/'. $user->id }}" class="text-body font-weight-semibold">{{ $user->name }}</a>
                                    </td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>{{$user->state}}</td>
                                    <td>
                                        @if($user->application && $user->application->agent)
                                            <a data-agent_id="{{ $user->application->agent->id }}" data-lead_id="{{ $user->id }}" href="javascript:void(0)" title="Update Agent" class="action-icon UpdateAgent"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            {{ $user->application->agent->name }}

                                        @else
                                            <button data-lead_id="{{ $user->id }}"  class="btn btn-sm btn-success AssignAgent">Assign Agent</button> 
                                        @endif
                                    </td>
                                    <td>${{ number_format($user->lenders)}} </td>
                                    <td>
                                        {{ $user->created_at->format('d/m/Y') }} 
                                    </td>
                                    <td>
                                      <select style="display: none;" class="form-control application-status" data-lead_id="{{$user->id}}" data-status_id="{{ ($user->application)?$user->application->status_id:'' }}" data-application_id="{{ ($user->application)?$user->application->id:'' }}"   id="application_status_{{$user->id}}">
                                        @foreach($status_list as $data)
                                          <option style="color:{{ $data->color_code }};background-color: {{ $data->color_code_opcity}}" value="{{$data->id}}" @if($user->application_status == $data->name)  selected @endif>{{$data->name}}</option>
                                        @endforeach
                                      </select>

                                      @if($user->application)
                                            <span data-application_id="{{ ($user->application)?$user->application->id:'' }}" data-lead_id="{{ $user->id }}" data-status_id="{{ ($user->application)?$user->application->status_id:'' }}" href="javascript:void(0)" title="Update Status"  class="badge UpdateStatus" style="color:{{ $user->application->color_code }};background-color: {{ $user->application->color_code_opcity}}">{{ $user->application->status }}</span>
                                        @else
                                        @endif
                                        <!-- <a data-application_id="{{ ($user->application)?$user->application->id:'' }}" data-lead_id="{{ $user->id }}" data-status_id="{{ ($user->application)?$user->application->status_id:'' }}" href="javascript:void(0)" title="Update Status" class="action-icon UpdateStatus"> <i class="mdi mdi-square-edit-outline"></i></a> -->
                                    </td>
                                    <td>
                                      <div class="btn-group dropdown">
                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ url($route.'/leads/'.$user->id.'/edit')}}"><i class="mdi mdi-pencil mr-2 text-muted font-18 vertical-middle"></i>Edit Lead</a>
                                                <a class="dropdown-item deleteLead" href="javascript:void(0)" data-user_id="{{ $user->id }}"><i class="mdi mdi-delete mr-2 text-muted font-18 vertical-middle"></i>Remove</a>
                                                <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-star mr-2 font-18 text-muted vertical-middle"></i>Mark as Unread</a> -->
                                            </div>
                                        </div>
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
<div id="UpdateAgent" class="modal fade" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Reassign Agent</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="px-3" action="#">
                    <input type="hidden" name="lead_id" id="update_lead_id">
                    <div class="form-group">
                        <label for="update_agent_id">Agent</label>
                        <select id="update_agent_id" class="form-control">
                            @foreach($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary float-left UpdateAgentSubmit" type="submit">update agent</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div id="AssignAgent" class="modal fade" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Assign Agent</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="px-3" action="#">
                    <input type="hidden" name="lead_id" id="lead_id">
                    <div class="form-group">
                        <label for="agent_id">Agent</label>
                        <select id="agent_id" class="form-control">
                            @foreach($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary float-left AssignAgentSubmit" type="submit">Assign</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div id="UpdateStatus" class="modal fade" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Status</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="px-3" action="#">
                    <input type="hidden" name="status_lead_id" id="status_lead_id">
                    <input type="hidden" name="application_id" id="application_id">
                    <div class="form-group">
                        <label for="status_id">Status</label>
                        <select id="status_id" class="form-control" required="">
                            <option value="">--Select Status--</option>
                            @foreach($status_list as $st)
                            <option value="{{ $st->id }}">{{ $st->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary float-left UpdateStatusSubmit" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endsection
@section('script')
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js')}}"></script>
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-tabledit/jquery.tabledit.min.js')}}"></script>
<!-- third party js ends -->
<script type="text/javascript">
    $(document).ready(function() {
         var dataTable = $('#scroll-horizontal-datatable').DataTable({
            "order": []
        });
    });

    $('#scroll-horizontal-datatable').Tabledit({
            url: base_url+'/updateThings',
            eventType: 'dblclick',
            editButton: false,
            columns: {
                identifier: [0, 'user_id'],
                editable: [[8, 'amount']]
            }
        });
</script>
<script type="text/javascript">
    let route = "{{ $route }}";
      $(function () {
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $(".deleteLead").click(function(e){
          console.log('hehe');
                e.preventDefault();
                var user_id = $(this).attr('data-user_id');
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.value) {
                      $.ajax({
                         type:'DELETE',
                         url:base_url+'/'+route+'/leads/'+user_id,
                         data:{id:user_id},
                         success:function(data){
                            Swal.fire(
                              'Deleted!',
                              'Lead has been deleted.',
                              'success'
                            ).then((result)=>{
                              window.location.reload();
                            });
                         }
                      });
                    }
                });
          
          });
      });
    </script>
<!-- Datatables init -->
<script src="{{asset('assets/js/pages/customers.init.js')}}"></script>
<script type="text/javascript">
    $(".AssignAgent").click(function(e){
          e.preventDefault();
          var lead_id = $(this).attr('data-lead_id');
          $("#lead_id").val(lead_id);
          $('#AssignAgent').modal('show');
    });
    $(".UpdateAgent").click(function(e){
          e.preventDefault();
          var lead_id = $(this).attr('data-lead_id');
          var agent_id = $(this).attr('data-agent_id');
          $("#update_agent_id").val(agent_id).change();
          $("#update_lead_id").val(lead_id);
          $('#UpdateAgent').modal('show');
    });
    $(".UpdateStatus").click(function(e){
          var lead_id = $(this).data('lead_id');
      $('#application_status_'+lead_id).toggle();
      $(this).toggle();
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('change','.application-status', function() {
        var status_id = $(this).val();
        var lead_id = $(this).data('lead_id');
        var id = $(this).data('application_id');
        if(status_id && lead_id && id){
          $.ajax({
             type:'POST',
             url:base_url+'/'+route+'/update/status',
             data:{status_id:status_id,id:id,lead_id:lead_id},
             success:function(data){
                Swal.fire(
                  'Updated!',
                  'Status Update',
                  'success'
                ).then((result)=>{
                  window.location.reload();
                });
             }
          });
        }
    });
    $(".AssignAgentSubmit").click(function(e){
        e.preventDefault();
        $(this).html('Assigning...');
        $(this).attr('disabled',true);
        var lead_id = $('#lead_id').val();
        var agent_id = $('#agent_id').val();
        $.ajax({
           type:'POST',
           url:base_url+'/'+route+'/assign/agent',
           data:{agent_id:agent_id,lead_id:lead_id,type:'add'},
           success:function(data){
              Swal.fire(
                'Assined!',
                'Agent Assigned',
                'success'
              ).then((result)=>{
                window.location.reload();
              });
           }
        });
    });
    $(".UpdateStatusSubmit").click(function(e){
        e.preventDefault();
        $(this).html('please wait...');
        $(this).attr('disabled',true);
        var lead_id = $('#status_lead_id').val();
        var id = $('#application_id').val();
        var status_id = $('#status_id').val();
        $.ajax({
           type:'POST',
           url:base_url+'/'+route+'/update/status',
           data:{status_id:status_id,id:id,lead_id:lead_id},
           success:function(data){
              Swal.fire(
                'Updated!',
                'Status Update',
                'success'
              ).then((result)=>{
                window.location.reload();
              });
           }
        });
    });
    $(".UpdateAgentSubmit").click(function(e){
        e.preventDefault();
        $(this).html('Updating...');
        $(this).attr('disabled',true);
        var lead_id = $('#update_lead_id').val();
        var agent_id = $('#update_agent_id').val();
        $.ajax({
           type:'POST',
           url:base_url+'/'+route+'/assign/agent',
           data:{agent_id:agent_id,lead_id:lead_id,type:'update'},
           success:function(data){
              Swal.fire(
                'Updating!',
                'Agent Assigned',
                'success'
              ).then((result)=>{
                window.location.reload();
              });
           }
        });
    });
</script>
@endsection