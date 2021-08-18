@extends('layouts.vertical', ['title' => 'View Agent'])
@php $route = 'admin'; @endphp

@section('css')
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" ></style>

  <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div id="modal01" class="w3-modal" onclick="this.style.display='none'" style="z-index: 999999;">
      <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
      <div class="w3-modal-content w3-animate-zoom">
        <img id="img01" style="width:100%">
      </div>
    </div>
    <div class="row">
            <div class="col-md-4">
              <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"></li>
                  </ul>
                </div>
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="mr-2 rounded-circle" src="{{ $user->profile_photo_url }}" height="50%" width="50%" alt="User Image">
                  </div>
                  <h3 class="profile-username text-center">{{ $user->name }}</h3>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Name:</b> {{ $user->name }}
                    </li>
                    <li class="list-group-item">
                      <b>Phone:</b> {{ $user->phone }}
                    </li>
                    <li class="list-group-item">
                      <b>Email:</b> {{ $user->email }}
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                  <ul class="nav nav-tabs nav-bordered">
                      <li class="nav-item">
                          <a href="#Statements" data-toggle="tab" aria-expanded="true" class="nav-link px-3 py-2">
                              <i class="mdi mdi-image font-18 d-md-none d-block"></i>
                              <span class="d-none d-md-block">Documents</span>
                          </a>
                      </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="Statements">
                      <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Document Upload</h4>
                                    <form action="{{url('admin/upload/document/'.$user->id)}}" method="post" class="dropzone dz-clickable" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                                        <div class="dz-message needsclick">
                                            <i class="h1 text-muted dripicons-cloud-upload"></i>
                                            <h3>Drop files here or click to upload.</h3>
                                            <span class="text-muted font-13">(This is just a demo dropzone. Selected files are
                                                <strong>not</strong> actually uploaded.)</span>
                                        </div>
                                    </form>
                                    <div class="dropzone-previews mt-3" id="file-previews"></div>  
                                </div>
                            </div>
                        </div>
                      </div>
                        @if($documents)
                             <table class="tablesaw table mb-0 tablesaw-stack" data-tablesaw-mode="stack" id="tablesaw-4613">
                              <thead>
                                  <tr>
                                      <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist">File Name</th>
                                      <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="2">Action</th>
                                  </tr>
                              </thead>
                              @foreach($documents as $bank_statement)
                                <tbody>
                                  <td>
                                    <object data="{{ Storage::disk('public')->url('uploads/'.$bank_statement->filename) }}" type="application/pdf" height="200px" width="200px">
                                    </object>{{ $bank_statement->filename }}
                                  </td>
                                  <td>
                                    <a href="{{url('admin/download-file/'.$bank_statement->id)}}" class="btn btn-sm btn-success" target="__blank">View</a>
                                  </td>
                                </tbody>
                              @endforeach
                          </table>
                        @else
                          Not Added yet
                        @endif
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
   @endsection
@section('script')
  <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
  <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
  function onClick(element) {
    document.getElementById("img01").src = element.src;
    document.getElementById("modal01").style.display = "block";
  }
  var doctor_text = "{{ __('text.Vendor') }}";
  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

  $("#rejectExpert").on('click',function(e){
    var __this = $(this);
    console.log(__this.attr('data-approved'))
    var consultant_id = __this.attr('data-consultant_id');
    var approved = __this.attr('data-approved');
    if(approved=='false'){
      Swal.fire({
        title: 'Write reason for Reject:',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Reject',
        showLoaderOnConfirm: true,
        preConfirm: (data) => {
            if(!data)
              Swal.showValidationMessage(
                'Write reason for Reject:'
              )
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        // __this.text('Rejecting');
        if (result.value) {
          $.ajax({
             type:'PUT',
             url:base_url+'/admin/consultants/'+consultant_id,
             data:{id:consultant_id,account_reject_ajax:'true','comment':result.value},
             success:function(data){
                Swal.fire(
                  'Rejected!',
                  'Account has been Rejected.',
                  'success'
                ).then((result)=>{
                    location.reload();
                });
             }
          });
        }
      });
    }
  });
</script>
@endsection