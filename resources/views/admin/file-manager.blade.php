@extends('layouts.vertical', ['title' => 'Statement'])
@section('css')
<style href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" ></style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">My Documents</li>
                    </ol>
                </div>
                <h4 class="page-title">My Documents</h4>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                  <h4 class="header-title">Documents Upload</h4>
                  <p class="sub-header">
                      DropzoneJS is an open source library that provides drag’n’drop file uploads with image previews.
                  </p>
                  <form action="{{url('admin/documents')}}" method="post" class="dropzone dz-clickable" id="myAwesomeDropzone" data-plugin="dropzone" data-upload-preview-template="#uploadPreviewTemplate">
                    <div class="dz-message needsclick">
                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                        <h3>Drop files here or click to upload.</h3>
                        <span class="text-muted font-13">(This is just a demo dropzone. Selected files are
                            <strong>not</strong> actually uploaded.)</span>
                    </div>
                  </form>
              </div>
          </div>
      </div>
  </div>   
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Bank Statements</h4>
                    <p class="sub-header">Upload your Bank Statements of the last 6 months</p>
                    <div class=" tablesaw-bar tablesaw-mode-stack"></div>
                    <table class="tablesaw table mb-0 tablesaw-stack" data-tablesaw-mode="stack" id="tablesaw-4613">
                        <thead>
                            <tr>
                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist">File Name</th>
                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($file_managers as $file_manager)
                                <tr>
                                    <td><b class="tablesaw-cell-label">{{$file_manager['filename']}}</b></td>
                                    <td>
                                      <a href="{{url('admin/download-file/'.$file_manager->id)}}">
                                        <button type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-cloud-download"></i></button>
                                      </a>
                                        <button type="button" class="btn btn-danger waves-effect waves-light delete_file_btn" data-file="{{ $file_manager->id }}"><i class="mdi mdi-close"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
<script src="{{asset('assets/js/app.min.js')}}"></script>
<script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript">
    var base_url = "{{ url('admin/documents')}}"
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete_file_btn').on('click', function (e) {
            var file_id = $(this).data('file');
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              console.log(result);
              if (result.value) {
                $.ajax({
                  data:{},
                  async:false,
                  type:'DELETE',
                  dataType:'json',
                  url:base_url+'/'+file_id,
                  success:function(response){
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                  setTimeout(function(){ 
                    location.reload(); 
                  }, 500);
                  },
                });
              }
            });
        });
    });
</script>
@endsection