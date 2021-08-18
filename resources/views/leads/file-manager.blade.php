@extends('layouts.vertical', ['title' => 'Statement'])
@section('css')
@endsection
@section('content')
<style type="text/css">
  .file-upload {
    height: 230px;
    width: 100%;
    line-height: 70px;
    position: relative;
    border-radius: 6px;
    align-items: center;
    border: 1px dashed #283251;
    background-color: rgb(255 255 255);
}
.file-upload input[type='file'] {
  top: 0;
  left: 0;
  opacity: 0;
  z-index:55;
  width: 100%;
  height:230px;
  cursor: pointer;
  position: absolute;
}
.uploaded-image-block {
  width: 100%;
   height: 180px;
  border-radius: 3px;
  border: 1px solid rgba(0,0,0,0.08);
}
</style>
<style type="text/css" href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}"></style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">My Financial Documents</li>
                    </ol>
                </div>
                <h4 class="page-title">My Financial Documents</h4>
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
                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-sortable-default-col="" data-tablesaw-priority="3">Update Document</th>
                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($months as $month)
                                <tr>
                                    <td><b class=" tablesaw-cell-label">Bank Statements - {{$month['label']}}</b></td>
                                    <td><b class="tablesaw-cell-label" id="file_name_{{ $month['date'] }}">{{$month['filename']}}</b></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light upload_docs_btn" data-label="{{$month['label']}}" data-date="{{ $month['date'] }}" data-filename="{{$month['filename']}}" id="upload_btn_{{ $month['date'] }}">{{$month['filename'] ? 'View...' : 'Upload'}}</button>
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
<div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <h4 class="text-center" id="myCenterModalLabel">Upload Bank Statements - <span id="myCenterModalSpan"></span></h4>
                    <p class="text-center">Please upload your business bank statements in high-quality PDF format</p>
                   <div class="card-body">
                    <input type="hidden" id="bank_statement_date" value="">
                    <input id="bank_statement" type="file" name="bank_statement" accept="application/pdf" />
                    <label for="file_default">No File Choosen </label>
                    <label for="file_name"><b></b></label>
                   </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" id="close_pdf_btn_modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_pdf_btn">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
<script src="{{asset('assets/js/app.min.js')}}"></script>
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
<script type="text/javascript">
    var base_url = "{{ url('leads/documents')}}"
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".upload_docs_btn").click(function(){
          let that = $(this);
          $("#bank_statement").val('');
          $("#centermodal").modal('show');
          $("#centermodal #myCenterModalSpan").html(that.data('label'));
          $("#centermodal #bank_statement_date").val(that.data('date'));
          $("label[for='file_name'] b").html(that.data('filename'));
          $("label[for='file_default']").text('Selected File: ');
        });
        $('#close_pdf_btn_modal').on('click', function (e) {
            $("#centermodal").modal('hide');
        });
        $('#save_pdf_btn').on('click', function (e) { 
           e.preventDefault();
           let data = new FormData();
           var statement_date = $("#centermodal #bank_statement_date").val();
           data.append('statement_date', statement_date);
           data.append('bank_statement', $('#bank_statement')[0].files[0]);
           $.ajax({
               data: data,
               type: 'POST',
               async: false,
               cache: false,
               url: base_url,
               contentType: false,
               processData: false,
               enctype: 'multipart/form-data',
               success: function (response) {
                if(response.status == 'success'){
                    $("#centermodal").modal('hide');
                    $('#upload_btn_'+statement_date).html("View...");
                    $('#file_name_'+statement_date).html(response.filename);
                    Swal.fire({
                      icon: 'success',
                      title: 'Bank Statement Uploaded Successfully.',
                      showConfirmButton: false,
                      timer: 1500
                    });
                }
               }
           });
        });
    });
</script>
@endsection