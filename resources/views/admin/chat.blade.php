@extends('layouts.vertical', ['title' => 'Chat'])
@section('css')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">UBold</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Apps</a>
                        </li>
                        <li class="breadcrumb-item active">Chat</li>
                    </ol>
                </div>
                <h4 class="page-title">Chat</h4>
            </div>
        </div>
    </div>
    <input type="hidden" id="role" value="{{$role}}">
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="media mb-3">
                        <img src="{{asset('assets/images/users/user-5.jpg')}}" class="mr-2 rounded-circle" height="42" alt="Brandon Smith">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-15">
                                <a href="contacts-profile.html" class="text-reset">{{Auth::user() ? Auth::user()->name : ''}}</a>
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-14">
                                <small class="mdi mdi-circle text-success"></small> Online
                            </p>
                        </div>
                    </div>
                    <div class="search-bar mb-3">
                        <div class="position-relative">
                            <input type="text" class="form-control form-control-light" placeholder="People, groups & messages..." id="search_box">
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </div>
                    <h6 class="font-13 text-muted text-uppercase mb-2">Contacts</h6>
                    <div class="row">
                        <div class="col">
                            <div data-simplebar style="max-height: 375px; min-height:375px;" id="user_inbox">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-body py-2 px-3 border-bottom border-light">
                    <div class="media py-1">
                        <img src="{{ asset('assets/images/users/user-5.jpg') }}" class="mr-2 rounded-circle" height="36" alt="Brandon Smith">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-15">
                                <span class="text-reset" id="selectedConversation_name" data-user_id="" data-user_name="{{ Auth::user() ? Auth::user()->name : '' }}"></span>
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-12">
                                <small class="mdi mdi-circle text-success"></small> Online
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="conversation-list" data-simplebar style="max-height: 460px;min-height: 460px;" id="chat-messages-list">
                        
                    </ul>
                    <div class="row">
                        <div class="col">
                            <div class="mt-2 bg-light p-3 rounded">
                                <div class="needs-validation" name="chat-form" id="chat-form">
                                    <div class="row">
                                        <div class="col mb-2 mb-sm-0">
                                            <input type="text" class="form-control border-0" placeholder="Enter your text" required="" id="msg-text">
                                            <div class="invalid-feedback">Please enter your messsage</div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="btn-group">
                                                <a href="javascript::void(0);" class="btn btn-light">
                                                    <i class="fe-paperclip"></i>
                                                </a>
                                                <button type="button" class="btn btn-success chat-send btn-block" id="send_message_btn">
                                                    <i class='fe-send'></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script id="user-list-template" type="x-tmpl-mustache">
    <a href="javascript:void(0);" class="text-body chat_list" data-user="@{{user_id}}">
        <div class="media p-2">
            <img src="{{ asset('assets/images/users/user-5.jpg') }}" class="mr-2 rounded-circle" height="42"/>
            <div class="media-body">
                <h5 class="mt-0 mb-0 font-14">
                    <span class="float-right text-muted font-weight-normal font-12">@{{last_message_time}}</span>
                    @{{ user_name }}
                </h5>
                <p class="mt-1 mb-0 text-muted font-14">
                    <span class="w-25 float-right text-right">
                        <span class="badge badge-soft-danger"></span>
                    </span>
                    <span class="w-75">@{{ last_message }}</span>
                </p>
            </div>
        </div>
    </a>
</script>
<script id="msg-template" type="x-tmpl-mustache">
    @{{#isSent}}
        <li class="clearfix">
           <div class="chat-avatar">
              <img src="{{ asset('assets/images/users/user-5.jpg') }}" class="rounded" alt="James Z">
              <i>@{{created_at}}</i>
           </div>
           <div class="conversation-text">
              <div class="ctext-wrap">
                 <i>@{{sender_name}}</i>
                 <p>@{{ message }}</p>
              </div>
           </div>
        </li>
    @{{/isSent}}
    @{{^isSent}}
        <li class="clearfix odd">
            <div class="chat-avatar">
                <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="Geneva M" class="rounded">
                <i>@{{created_at}}</i>
            </div>
            <div class="conversation-text">
                <div class="ctext-wrap">
                    <i>@{{sender_name}}</i>
                    <p>@{{ message }}</p>
                </div>
            </div>
        </li>
    @{{/isSent}}
</script>
<script>
    var user = {{ \Auth::id() }};
    var SOCKET_URL = "{{ config('app.socket_url') }}";
    var selectedConversation = {{ $selectedConversation->id ?? "null" }};
    var selectedConversationUser = {{ (isset($selectedConversation) && $selectedConversation ? $selectedConversation->user_1 : "null") ?? "null" }};
</script>
<script src="{{ asset(mix('js/admin/chat/chat.js')) }}"></script>
@endsection
@section('script')
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
@endsection