  <?php if(isset($_GET['msg'])){ echo "<script>alert('".$_GET['msg']."'); </script>";  } 
  	$url= url('').'/login';
  if(session()->has('user_id')){ }else {  echo '<script>alert("Session Expired");window.location.href="'.$url.'"</script>'; die(); }
  ?>



@inject('siteData1', 'App\Http\Controllers\Site')
@inject('agentData1', 'App\Http\Controllers\Admin')
         @php   $data=json_decode($siteData1::Index(),true);
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                $currency=$data['siteData']['currency']; 
                $currency_symbol=$data['siteData']['currency_symbol'];  
                
                $a_data=json_decode($agentData1::Index(),true);
				$a_common_data= $a_data['siteData']['common_data']; 
                $a_common=json_decode($a_common_data,true);    
                
                $wallet=$a_data['siteData']['wallet'];  
                $currency=$a_data['siteData']['currency'];
                $currency_symbol=$a_data['siteData']['currency_symbol'];     
                
                if(isset($images['icon'])){ $icon=$images['icon']; }else{ $icon=''; }
                 
         @endphp  




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$data['siteData']['website_name']}}</title>
  <!-- Google Font: Source Sans Pro {{ asset('css/myCss.css') }} -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
  {{-- <link rel="icon" href="{{$icon}}"> --}}
    <link rel="icon" href="https://amplepoints.com/images/favicon.ico">
  <style>
  	.top-menu{
		background: #00CCFF;
		color: #FFFFFF!important;
		font-size: 16px;
		font-weight: bold;
		border-radius: 10px;
		margin-left:10px;
	}
  
  </style>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">  
    <img class="animation__shake" src="{{asset($icon)}}" alt="Icon" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
		<a target="_blank"   href="<?php echo  url(''); ?>" class="nav-link top-menu">Visit Site</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block" >
        <a href="#" class="nav-link top-menu">Contact</a>
      </li>
      <li class="nav-item  d-sm-inline-block" >
        <a href="<?php echo  url(''); ?>" class="nav-link top-menu">Booking Tool</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block" >
        <a href="<?php echo  url(''); ?>" class="nav-link top-menu">Home</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      @if($sessionval['user_type']=='admin' || $sessionval['user_type']=='agent')
      <li class="nav-item">
        <b class="nav-link">
          <i class="fas fa-wallet"></i> <b><?php echo $currency_symbol; ?> {{$wallet}}</b>
        </b>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{ asset('logout') }}" role="button">
          <i class="nav-icon fas fa-power-off"></i>          
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->