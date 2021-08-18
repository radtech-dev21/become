 
<!-- bundle -->
<!-- Vendor js -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
@yield('script')
<!-- App js -->
<script src="{{asset('assets/js/app.min.js')}}"></script>
@if(config('client_connected') && (config::get("client_data")->domain_name=="mp2r"||config::get("client_data")->domain_name=="food"))
<div id="sb_widget"></div>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

@endif
@yield('script-bottom')