<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (isset($page_title)?$page_title.' - ':'').config('app.name', 'Laravel') }}</title>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/pace-progress/themes/blue/pace-theme-minimal.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    

    <!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/pace-progress/pace.min.js') }}"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div id="app"></div>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-language"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="{{url('locale/en')}}" class="dropdown-item">English</a>
          <a href="{{url('locale/fr')}}" class="dropdown-item">fran�aise</a>          
        </div>
      </li>
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=https%3A%2F%2Fui-avatars.com%2Fapi%2F{{ urlencode(Auth::user()->name) }}/128/ff914d/fff" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline">{{ Str::title(Auth::user()->name) }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=https%3A%2F%2Fui-avatars.com%2Fapi%2F{{ urlencode(Auth::user()->name) }}/128/ff914d/fff" class="img-circle elevation-2" alt="User Image">

            <p>
              {{ Str::title(Auth::user()->name) }}
              <small>{{ Auth::user()->email }}</small>
            </p>
          </li>
          <!--
          <li class="user-body">
            <div class="row">
              <div class="col-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Friends</a>
              </div>
            </div>
          </li> -->
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="{{ url('/settings')}}" class="btn btn-default btn-flat">{{ __('Settings') }}</a>
            <a href="#" class="btn btn-default btn-flat float-right" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
          </li>
        </ul>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link text-center">
    <span class="kpip_logo_mini">MyAdmin</span>
      <img src="https://flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=clan-logo&text={{ urlencode(config('app.name', 'Vishal')) }}&doScale=true&scaleWidth=240&scaleHeight=58" alt="{{ config('app.name', 'Laravel') }} Logo" class="img-fluid brand-text"/>
      <!-- <img src="{{ asset('img/logoblk.png') }}" alt="{{ config('app.name', 'Laravel') }} Logo" class="img-fluid brand-text"/> -->
      <!-- <img src="{{ asset('img/AdminLTELogo.png') }}" alt="{{ config('app.name', 'Laravel') }} Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-none">
        <div class="image">
          <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=https%3A%2F%2Fui-avatars.com%2Fapi%2F/{{ urlencode(Auth::user()->name) }}/128" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Str::title(Auth::user()->name) }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a class="nav-link {{ (Route::current()->uri=='/'?'active':'') }}" href="{{ url('') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>                
                <p>{{ __('Dashboard') }}</p>
            </a>
          </li>
          
            @can('Role-section')
          <li class="nav-item">
            <a class="nav-link {{ (Route::current()->uri=='roles'?'active':'') }}" href="{{ route('roles') }}">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>{{ __('Roles') }}</p>
            </a>
          </li>
          @endcan
          @can('Staff-section')
          <li class="nav-item">
            <a class="nav-link {{ (Route::current()->uri=='staff'?'active':'') }}" href="{{ route('staff') }}">
                <i class="nav-icon fas fa-users"></i>
                <p>{{ __('Staff') }}</p>
            </a>
          </li>
          @endcan
          @can('Permission-section')
           <li class="nav-item">
            <a class="nav-link {{ (Route::current()->uri=='permissions'?'active':'') }}" href="{{ route('permissions') }}">
                <i class="nav-icon fas fa-lock"></i>
                <p>{{ __('Permissions') }}</p>
            </a>
          </li>
          @endcan  
             
          <li class="nav-item">
            <a class="nav-link {{ (Route::current()->uri=='settings'?'active':'') }}" href="{{ route('settings') }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>{{ __('Settings') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off"></i>
                <p>{{ __('Logout') }}</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

<script>
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }
function before(_this=null){
_this.find('.save').prop('disabled',true);
_this.find('.formloader').css("display","inline-block");
}
function complete(_this=null){
_this.find('.save').prop('disabled',false);
_this.find('.formloader').css("display","none");
}
$(document).ready(function(){
$('.kpip_logo_mini').css('display','inline-block').toggle();

$('[data-widget="pushmenu"]').click(function(){
  if($( window ).width()>1000){
    $('.kpip_logo_mini').fadeToggle(); 
  }
});
});
</script>
</body>

</html>
