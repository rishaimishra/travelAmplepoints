@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                $currency_list=$data['currency_list']; 
                
                $currency=$data['siteData']['currency']; 
                $currency_symbol=$data['siteData']['currency_symbol'];  
                
                if(isset($_GET['msg'])){ $msg=$_GET['msg']; echo "<script>alert('".$msg."')</script>"; }
                            
         @endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="description" content="@if(isset($pageData->meta_description)){{$pageData->meta_description}}@endif">
      <meta name="keywords" content="@if(isset($pageData->meta_keywords)){{$pageData->meta_keywords}}@endif">
      <meta name="author" content="Akin">
    <title>@if(isset($pageData->title)) {{$pageData->title}} @endif</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset($images['icon'])}}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Template CSS Files -->
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{ asset('site/css/line-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('site/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('site/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('site/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{ asset('site/css/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('site/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{ asset('site/css/animated-headline.css')}}">
    <link rel="stylesheet" href="{{ asset('site/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('site/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('site/css/style.css')}}">
    <style>
	
		.theme-btn-transparent {
			background-color: #fff!important;
			color: #f75b10;
		}
		.bgc{
			background-color: #f75b10!important;
			border: 1px solid #f75b10;
		}
		.section-tab .nav-tabs
		.nav-link.active {
		 color: #f75b10;
		}
		.theme-btn{
			background-color: #f75b10;
			border: 1px solid #f75b10;
		}
		
		.price-slider-amount .amounts{
			color: #f75b10!important;
		}
		.theme-btn:hover{
			color: #f75b10;
		}
		
		.loader .spinner .path{
			stroke: #f75b10;
		}
		
		.stroke-shape::before, .stroke-shape::after{
			background-color: #f75b10!important;
		}
		
		.ui-widget.ui-widget-content .ui-slider-handle{
			background-color: #f75b10!important;
		}
		.ui-widget.ui-widget-content .ui-slider-range{
			background-color: #f75b10!important;
		}
		
		.custom-checkbox input[type=checkbox]:checked + label:before {
			background-color: #f75b10!important;
			border-color: #f75b10!important;
		}
		
		.custom-checkbox label a {
			color: #f75b10!important;
		}
	
	
	
        .an-from, .an-to{
            position: relative;
        }
        .an-plane-from{
            transform: rotate(45deg);
        }
        .an-plane-to{
            transform: rotate(135deg);
        }
        .from_list, .to_list{
            border: 1px solid #287dfa;
            position: absolute;
            top: 90px;
            background: rgb(255, 255, 255);
            z-index: 2;
            font-size: 13px;
            color: rgb(13, 35, 62);
            text-decoration: none;
            list-style-type: none;
            width: 97%;
            border-radius: 4px;
            /* padding: 0 40px; */
        }
        .form-icon{
            z-index: 1;
        }
        .from_list li, .to_list li{
            padding: 2px 40px;
        }
        .from_list li:hover, .to_list li:hover{
            background: #287dfa;
            color:#fff;
        }
        .an-custom-img-icon{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .an-custom-img-icon img{
            width:16px;
        }
@media screen and (max-width : 1920px){
 .notMobile{
  visibility:visible;
  display:block;
  }
  .mobile{
  visibility:hidden;
  display:none;
  }
}
@media screen and (max-width : 906px){
 .mobile{
  visibility:visible;
  display:block;
  }
  .notMobile{
  visibility:hidden;
  display:none;
  }
}
.hidefun{
	float:right;
	width: 28px;
	background-color: rgba(128, 137, 150, 0.08);
	text-align: center;
    border-radius: 100%;
    cursor: pointer;
}
</style>

</head>
<body>
<!-- start cssload-loader -->
<div class="preloader" id="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>
<!-- end cssload-loader -->
<!--<a href="http://techydevs.com/demos/themes/html/trizen/rtl/index.html" class="rtl-btn">RTL Version</a>-->
<!-- ================================
            START HEADER AREA
================================= -->
<header class="header-area">
    <div class="header-top-bar padding-right-100px padding-left-100px">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="header-top-content">
                        <div class="header-left">
                            <ul class="list-items">
                            {{-- <li><a href="{{ asset('help-desk')}}" style="font-size: 1.5rem!important;" ><i class="la la-question-circle"></i>Support</a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header-top-content" >
                        <div class="header-right d-flex align-items-center justify-content-end an-remove-flex">
                            <div class="header-right-action an-div-sep" style="display:none">
                                <div class="select-contain select--contain w-auto">
                                <div class="notMobile"  id="google_translate_element"></div>
                                </div>
                            </div>
                            <div class="header-right-action an-div-sep" style="display:none">
                                <div class="select-contain select--contain w-auto">
                                <form method="post" action="{{ asset('change-currency') }}">
          					    @csrf 
                                <input type="hidden" name="redirectUrl" value="{{url()->full()}}" />
                                    <select style="width:100%" name="currency" id='currency'  onChange="changeCurrency()"class="form-control">
                                      @foreach($currency_list as $key => $data)
                                      <option "@if($currency ==  $data['currency']) } selected @endif" value="{{$data['currency']}}_{{$data['currency_symbol']}}">{{$data['currency']}}</option>
                                      @endforeach
                                    </select>
                                    <input style="display:none" class="currency_submit" type="submit" />
                                </form>
                                </div>
                            </div>
                            <div class="header-right-action" an-div-sep>
                                 <?php if(isset($sessionval['first_name'])){ ?>
                            	 <a href="#" class="theme-btn theme-btn-small">Hi {{$sessionval['first_name']}}</a>
                                 <a href="{{ asset('logout')}}" class="theme-btn theme-btn-small" >
                                 <i class="la la-power-off mr-2 text-color-11"></i>Logout</a>
                                <?php } else{ ?>
                                 <a href="{{ asset('customer-signup')}}" class="theme-btn theme-btn-small">Sign Up</a>
                                 <a href="{{ asset('login')}}" class="theme-btn theme-btn-small" >Login</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu-wrapper padding-right-100px padding-left-100px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 an-shadow">
                    <div class="menu-wrapper">
                        <a href="javascript:void(0);" class="down-button"><i class="la la-angle-down"></i></a>
                        <div class="logo" style="margin:4px"> 
                            <a href="<?php echo url('');?>"><img src="{{asset($images['logo'])}}" height="65" width="250" alt="logo"></a>
                            <div class="menu-toggler">
                                <i class="la la-bars"></i>
                                <i class="la la-times"></i>
                            </div><!-- end menu-toggler -->
                        </div><!-- end logo -->
                        <div class="main-menu-content">
                            <nav>
                                <ul>
                                    <li><a href="{{ asset('')}}"><i class="la la-home mr-1"></i>Home</a></li>
                                    <li><a href="{{ asset('hotel-search')}}"><i class="la la-bed mr-1"></i>Hotel/Stays</a></li>
                                    <li><a href="{{ asset('flight-search')}}"><i class="la la-plane mr-1"></i>Flight</a></li>
                                    <li><a href="{{ asset('tours-search')}}"><i class="la la-camera mr-1"></i>Tours</a></li>
                                    <li><a href="{{ asset('transfers-search')}}"><i class="la la-car mr-1"></i>Transfers</a></li>
									<li style="display:none"><a style="display:flex;" href="{{ asset('tours-search')}}"><span class="form-icon an-custom-img-icon" style="margin: 0 5px 0 0;"><img src="<?php echo url('');?>/icon/globe-black.png" alt=""></span>Tours</a></li>
                                     
                                   <!-- <li><a style="display:flex;" href="#"><span class="form-icon an-custom-img-icon" style="margin: 0 5px 0 0;"><img src="<?php echo url('');?>/icon/cruise-black.png" alt=""></span>Cruise</a></li>-->
                                   
                                    <li style="display:none"><a style="display:flex;" href="{{ asset('transfers-search')}}"><span class="form-icon an-custom-img-icon" style="margin: 0 5px 0 0;"><img src="<?php echo url('');?>/icon/car-black.png" alt=""></span>Transfers</a></li>
                                    
                                    <div style="display:none" class="mobile" >
                                 {{--    <li><a href="{{ asset('help-desk')}}"><i class="la la-question-circle"></i>Support</a></li> --}}
                                   	   <div class="col-lg-6">
                                            <div class="header-top-content">
                                                <div class="header-right align-items-center justify-content-end an-remove-flex">
                                                   
                                                    <!--<div  id="google_translate_element2"></div>-->
                                                      
                                                    <div class="header-right-action an-div-sep">
                                                        <div class="select-contain select--contain w-auto">
                                                        <form method="post" action="{{ asset('change-currency') }}">
                                                        @csrf 
                                                        <input type="hidden" name="redirectUrl" value="{{url()->full()}}" />
                                                            <select style="width:100%" name="currency" id='currency'  onChange="changeCurrency2()"class="form-control">
                                                             @foreach($currency_list as $key => $data)
                                                              <option "@if($currency ==  $data['currency']) } selected @endif" value="{{$data['currency']}}_{{$data['currency_symbol']}}">{{$data['currency']}}</option>
                                                              @endforeach

                                                            </select>
                                                            <input style="display:none" class="currency_submit2" type="submit" />
                                                        </form>
                                                        </div>
                                                    </div>
                                                    <div class="header-right-action" an-div-sep>
                                                    <a href="https://dev.plistbooking.com/add-new-listing-list-your-event/" target="_blank" class="theme-btn theme-btn-small theme-btn-transparent mr-1">List Your Property</a>
                                                         <?php if(isset($sessionval['first_name'])){ ?>
                                                         <a href="#" class="theme-btn theme-btn-small">Hi {{$sessionval['first_name']}}</a>
                                                         <a href="{{ asset('logout')}}" class="theme-btn theme-btn-small" >
                                                         <i class="la la-power-off mr-2 text-color-11"></i>Logout</a>
                                                        <?php } else{ ?>
                                                         <a href="{{ asset('customer-signup')}}" class="theme-btn theme-btn-small">Sign Up</a>
                                                         <a href="{{ asset('login')}}" class="theme-btn theme-btn-small" >Login</a>
                                                        <?php } ?>
                                                    </div>
                                                    {{-- <div class="header-right-action" style="margin-top:10px;" an-div-sep>
                                                    <a href="{{ asset('agent-signup')}}" class="theme-btn">Become an Agent</a> 
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </ul>
                            </nav>
                        </div><!-- end main-menu-content -->
                        <div class="nav-btn">
                        <?php if(isset($sessionval['first_name'])){ ?>
                                <a @if(@Auth::user()->user_type=="admin") href="{{ asset('admin-dashboard')}}" @else href="{{ route('customer.dashboard')}}" @endif class="theme-btn">Dashboard</a>
                         <?php }else{ ?>
                            	{{-- <a href="{{ asset('agent-signup')}}" class="theme-btn">Become an Agent</a>      --}}
                         <?php } ?>                       
                        </div><!-- end nav-btn -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-wrapper -->
</header>

<!-- ================================
         END HEADER AREA
================================= -->



<!-- ================================
         START MOBILE MENU
================================= -->
<div class="an-container-responsive" style="display:none;">
    <div>
        <a style="display:flex;" href="{{ asset('hotel-search')}}"><span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="<?php echo url('');?>/icon/bed-whitw.png" alt="" style="width: 20px;"></span>Hotel / Stays</a>
    </div>
    <div>
        <a style="display:flex;" href="{{ asset('flight-search')}}"><span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="<?php echo url('');?>/icon/flight-white.png" alt="" style="width: 20px;"></span>    Flight</a>
    </div>
    <div>
        <a style="display:flex;" href="{{ asset('tours-search')}}"><span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="<?php echo url('');?>/icon/globe-black.png" alt="" style="width: 20px;"></span>Tours</a>
    </div>
        <div>
        <a style="display:flex;" href="{{ asset('transfers-search')}}"><span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="<?php echo url('');?>/icon/car-white.png" alt="" style="width: 20px;"></span>Trannsfers</a>
    </div>
    <!--<div>
        <a style="display:flex;" href="#"><span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="<?php echo url('');?>/icon/cruise-white.png" alt="" style="width: 20px;"></span>Cruise</a>
    </div>-->

</div>
<!-- ================================
         END MOBILE MENU
================================= -->
@if(isset($pageData->name))
@if($pageData->id!='home')
<section class="breadcrumb-area bread-bg-6 common_beard_comb notMobile"> 
<div class="video-bg" style="background:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.5)),url({{$pageData->image}});background-size: cover;">
    </div>
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="breadcrumb-content">
                        <div class="section-heading beard_comb_left">{{$pageData->name}}</h2>
                        </div>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="breadcrumb-list text-right">
                        <ul class="list-items">
                            <li><a href="<?php url('');?>">Home</a></li>
                            <li>{{$pageData->name}}</li>
                        </ul>
                    </div><!-- end breadcrumb-list -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->            
        </div><!-- end container -->
    </div><!-- end breadcrumb-wrap -->
   <!-- This is for arrow image <div class="bread-svg-box">
        <svg class="bread-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none"><polygon points="100 0 50 10 0 0 0 10 100 10"></polygon></svg>
    </div>-->
</section>
@endif
@endif

<style>
    .an-container-responsive {
        display: flex;
        width: 100%;
        align-items: center;
        padding: 15px;
        overflow: scroll;
        white-space: nowrap;
    }
    .an-container-responsive div{
        margin: 0 10px;
    }
    .an-container-responsive  a{
        padding:10px;
        background: #007bff;
        color: #fff;
        border-radius: 30px;
    }
	.form-control{
		font-size: 1rem!important;
	}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
checkPosition();
function checkPosition() {
    if (window.matchMedia('(max-width: 700px)').matches) {
        console.log('resize...');
		googleTranslateElementInit2();
        $('.an-container-responsive').css({"display":"flex"});
        $('.an-shadow').css({"box-shadow":"0px 1px 10px -2px"});
        $('.an-remove-flex').removeClass('d-flex align-items-center justify-content-end');
		$('.VIpgJd-ZVi9od-l4eHX-hSRGPd').hide(); 
    } else {
		 googleTranslateElementInit();
        $('.an-container-responsive').css({"display":"none"});
        $('.an-shadow').css({"box-shadow":""});
        $('.an-remove-flex').addClass('d-flex align-items-center justify-content-end');
		$('.VIpgJd-ZVi9od-l4eHX-hSRGPd').hide();
    }
}
$(document).load($(window).bind("resize", checkPosition));
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
function googleTranslateElementInit2() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element2');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
      <script type="text/javascript">	  
	  function changeCurrency(){ jQuery(".currency_submit").trigger("click"); }
	  function changeCurrency2(){ jQuery(".currency_submit2").trigger("click"); }
		function pollDOM () {
		  if(jQuery(".goog-te-combo")[0]){
			jQuery(".goog-te-combo").addClass('form-control');
			jQuery(".goog-logo-link").empty();
			jQuery('.goog-te-gadget').html($('.goog-te-gadget').children());
		  } else {
			setTimeout(pollDOM, 1000); // try again in 300 milliseconds
		  }
		}
		pollDOM();						
</script>