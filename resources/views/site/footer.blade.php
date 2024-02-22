@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
      
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                $currency=$data['siteData']['currency']; 
                $currency_symbol=$data['siteData']['currency_symbol'];              
         @endphp
         
         
         
         
<!-- ================================
       START FOOTER AREA
================================= -->

<div class="section-block"></div>
<section class="info-area info-bg padding-top-90px padding-bottom-70px">
<div class="container">
<div class="row">
<div class="col-lg-4 responsive-column"> <a href="{{ asset('contact')}}" class="icon-box icon-layout-2 d-flex">
<div class="info-icon flex-shrink-0 bg-rgb text-color-2"> <i class="la la-phone"></i> </div>

<div class="info-content">
<h4 class="info__title">Need Help? Contact us</h4>
<p class="info__desc"> {{$common['email1']}} </p>
<p class="info__desc"> {{$common['contact1']}} </p>
</div>

</a>

</div>

<div class="col-lg-4 responsive-column"> <a href="#" class="icon-box icon-layout-2 d-flex">
<div class="info-icon flex-shrink-0 bg-rgb-2 text-color-3"> <i class="la la-money"></i> </div>

<div class="info-content">
<h4 class="info__title">Payments</h4>
<p class="info__desc"> We Accept All Credit Cards Payment?  </p>
</div>

</a>

</div>

<div class="col-lg-4 responsive-column"> <a href="{{ asset('privacy-policy')}}" class="icon-box icon-layout-2 d-flex">
<div class="info-icon flex-shrink-0 bg-rgb-3 text-color-4"> <i class="la la-times"></i> </div>

<div class="info-content">
<h4 class="info__title">Cancel Policy</h4>
<p class="info__desc">Click Here to Know More</p>
</div>

</a>

</div>

</div>

</div>

</section>

<section class="cta-area subscriber-area section-bg-2 padding-top-60px padding-bottom-60px">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-7">
<div class="section-heading">
<h2 class="sec__title font-size-30 text-white">Subscribe to see Secret Deals</h2>
</div>

</div>

<div class="col-lg-5">
<div class="subscriber-box">
<div class="contact-form-action">
<form  action="{{ asset('enquiry') }}" method="post" enctype="multipart/form-data">
 @csrf
<input type="hidden" name="redirectUrl" value="{{url()->full()}}" />
<input type="hidden" name="type" value="subscribe" />
<div class="input-box">
<label class="label-text text-white">Enter email address</label>
<div class="form-group mb-0"> <span class="la la-envelope form-icon"></span>
<input class="form-control" type="email" name="email" placeholder="Email address">
<button class="theme-btn theme-btn-small submit-btn" type="submit">Subscribe</button>
<span class="font-size-14 pt-1 text-white-50"><i class="la la-lock mr-1"></i>Don't worry your information is safe with us.</span> </div>
</div>
</form>
</div>
</div>

</div>

</div>

</div>

</section>



<section class="footer-area section-bg padding-top-100px padding-bottom-30px">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <div class="footer-logo padding-bottom-30px">
                        <a href="" class="foot__logo"><img src="{{asset($images['icon'])}}" height="65" width="250" alt="logo"></a>
                    </div><!-- end logo -->
                    <p class="footer__desc"><?php echo $common['about'] ?></p>
                    <!--<ul class="list-items pt-3">
                        <li>phphere</li>
                        <li>phphere</li>
                        <li><a href="#">phphere</a></li>
                    </ul>-->
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">Company</h4>
                    <ul class="list-items list--items">
                        <li><a href="{{ asset('about')}}">About us</a></li>
                        <li><a href="{{ asset('support')}}">Support</a></li>
                        <li><a href="{{ asset('help-desk')}}">Help Desk</a></li>
                        <li><a href="{{ asset('contact')}}">Contact Us</a></li>
                    </ul>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">Other Links</h4>
                    <ul class="list-items list--items">
                        <li><a href="{{ asset('hotel-search')}}">Hotel Booking</a></li>
                        <li><a href="{{ asset('flight-search')}}">Flight Booking</a></li>
                        <!--<li><a href="#">Cruise Booking</a></li>-->
                        <li><a href="{{ asset('tours-search')}}">Tour Booking</a></li>
                        <li><a href="{{ asset('transfers-search')}}">Car Booking</a></li>
                    </ul>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">Subscribe now</h4>
                    <p class="footer__desc pb-3">Subscribe for latest updates & promotions</p>
                    <div class="contact-form-action">
                        <form  action="{{ asset('enquiry') }}" method="post" enctype="multipart/form-data">
                         @csrf
                        <input type="hidden" name="redirectUrl" value="{{url()->full()}}" />
                        <input type="hidden" name="type" value="subscribe" />
                            <div class="input-box">
                                <label class="label-text">Enter email address</label>
                                <div class="form-group mb-0">
                                    <span class="la la-envelope form-icon"></span>
                                    <input class="form-control" type="email" name="email" placeholder="Email address">
                                    <button class="theme-btn theme-btn-small submit-btn" type="submit">Go</button>
                                    <span class="font-size-14 pt-1"><i class="la la-lock mr-1"></i>Your information is safe with us.</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="term-box footer-item">
                    <ul class="list-items list--items d-flex align-items-center">
                        <li><a href="{{ asset('terms-and-condition')}}">Terms & Conditions</a></li>
                        <li><a href="{{ asset('privacy-policy')}}">Privacy Policy</a></li>
                    </ul>
                </div>
            </div><!-- end col-lg-8 -->
             <div class="col-lg-4">
                <div class="footer-social-box text-right">
                    <ul class="social-profile">
                        <li><a target="_blank"  href="{{$common['fb_link']}}"><i class="lab la-facebook-f"></i></a></li>
                        <li><a target="_blank"  href="{{$common['tw_link']}}"><i class="lab la-twitter"></i></a></li>
                        <li><a target="_blank"  href="{{$common['insta_link']}}"><i class="lab la-instagram"></i></a></li>
                        <li><a target="_blank"  href="{{$common['ld_link']}}"><i class="lab la-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
    <div class="section-block mt-4"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="copy-right padding-top-30px">
                    <p class="copy__desc">
                        &copy; Copyright 2021-<?php echo date('Y'); ?>. <!--Made with
                        <span class="la la-heart"></span> by <a href="https://travel.akmtechie.in/">AKM TECHIE</a>-->
                    </p>
                </div><!-- end copy-right -->
            </div><!-- end col-lg-7 -->
            <div class="col-lg-5">
                <div class="copy-right-content d-flex align-items-center justify-content-end padding-top-30px">
                    <h3 class="title font-size-15 pr-2">We Accept</h3>
                    <img src="{{ asset('images/payment-img.png')}}" alt="">
                </div><!-- end copy-right-content -->
            </div><!-- end col-lg-5 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end footer-area -->
<!-- ================================
       START FOOTER AREA
================================= -->

<!-- start back-to-top -->
<div id="back-to-top">
    <i class="la la-angle-up" title="Go top"></i>
</div>
<!-- end back-to-top -->

<!-- end modal-shared -->
<div class="modal-popup">
    <div class="modal fade" id="signupPopupForm" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title title" id="exampleModalLongTitle">Sign Up</h5>
                        <p class="font-size-14">Hello! Welcome Create a New Account</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="contact-form-action">
                        <form method="post">
                            <div class="input-box">
                                <label class="label-text">Username</label>
                                <div class="form-group">
                                    <span class="la la-user form-icon"></span>
                                    <input class="form-control" type="text" name="text" placeholder="Type your username">
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box">
                                <label class="label-text">Email Address</label>
                                <div class="form-group">
                                    <span class="la la-envelope form-icon"></span>
                                    <input class="form-control" type="text" name="text" placeholder="Type your email">
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box">
                                <label class="label-text">Password</label>
                                <div class="form-group">
                                    <span class="la la-lock form-icon"></span>
                                    <input class="form-control" type="text" name="text" placeholder="Type password">
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box">
                                <label class="label-text">Repeat Password</label>
                                <div class="form-group">
                                    <span class="la la-lock form-icon"></span>
                                    <input class="form-control" type="text" name="text" placeholder="Type again password">
                                </div>
                            </div><!-- end input-box -->
                            <div class="btn-box pt-3 pb-4">
                                <button type="button" class="theme-btn w-100">Register Account</button>
                            </div>
                            <div class="action-box text-center">
                                <p class="font-size-14">Or Sign up Using</p>
                                <ul class="social-profile py-3">
                                    <li><a href="#" class="bg-5 text-white"><i class="lab la-facebook-f"></i></a></li>
                                    <li><a href="#" class="bg-6 text-white"><i class="lab la-twitter"></i></a></li>
                                    <li><a href="#" class="bg-7 text-white"><i class="lab la-instagram"></i></a></li>
                                    <li><a href="#" class="bg-5 text-white"><i class="lab la-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </form>
                    </div><!-- end contact-form-action -->
                </div>
            </div>
        </div>
    </div>
</div><!-- end modal-popup -->

<!-- end modal-shared -->
<div class="modal-popup">
    <div class="modal fade" id="loginPopupForm" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title title" id="exampleModalLongTitle2">Login</h5>
                        <p class="font-size-14">Hello! Welcome to your account</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="contact-form-action">
                        <form method="post">
                            <div class="input-box">
                                <label class="label-text">Username</label>
                                <div class="form-group">
                                    <span class="la la-user form-icon"></span>
                                    <input class="form-control" type="text" name="text" placeholder="Type your username">
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box">
                                <label class="label-text">Password</label>
                                <div class="form-group mb-2">
                                    <span class="la la-lock form-icon"></span>
                                    <input class="form-control" type="text" name="text" placeholder="Type your password">
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="custom-checkbox mb-0">
                                        <input type="checkbox" id="rememberchb">
                                        <label for="rememberchb">Remember me</label>
                                    </div>
                                    <p class="forgot-password">
                                        <a href="recover.html">Forgot Password?</a>
                                    </p>
                                </div>
                            </div><!-- end input-box -->
                            <div class="btn-box pt-3 pb-4">
                                <button type="button" class="theme-btn w-100">Login Account</button>
                            </div>
                            <div class="action-box text-center">
                                <p class="font-size-14">Or Login Using</p>
                                <ul class="social-profile py-3">
                                    <li><a href="{{$common['about']}}" class="bg-5 text-white"><i class="lab la-facebook-f"></i></a></li>
                                    <li><a href="{{$common['about']}}" class="bg-6 text-white"><i class="lab la-twitter"></i></a></li>
                                    <li><a href="{{$common['about']}}" class="bg-7 text-white"><i class="lab la-instagram"></i></a></li>
                                    <li><a href="{{$common['about']}}" class="bg-5 text-white"><i class="lab la-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </form>
                    </div><!-- end contact-form-action -->
                </div>
            </div>
        </div>
    </div>
</div><!-- end modal-popup -->

<!-- Template JS Files -->
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
 <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
 <script type="text/javascript">
 function updateGuest(){
 	var adults=0; var childs=0;
 	var rooms=document.getElementById("rooms").value;
	 for(var i=0;i<rooms;i++){ var adultId='adult_'+i; var clildId='child_'+i; 
							adults=parseInt(adults)+ parseInt(jQuery('#'+adultId).val()); 
							childs=parseInt(childs)+ parseInt(jQuery('#'+clildId).val()); 
							var guests=parseInt(adults)+parseInt(childs);
							jQuery('.guests').html(guests); 
	}
}
	  function managePax(type){ 
			var maxval = document.getElementById(type).max;
			var minVal = document.getElementById(type).min;
			var val = jQuery('#'+type).val();
			var finalval=jQuery('#'+type).val();;
			if(val>=maxval){ finalval=maxval; }else if(val<=minVal){ finalval=parseInt(minVal);  }
			jQuery('#'+type).val(finalval);
			jQuery('.'+type).html(jQuery('#'+type).val()); 
			updateGuest();
	  }
	 function hidefun(){ jQuery('.dropdown-menu').hide(); }
</script>

<script src="{{ asset('site/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{ asset('site/js/jquery-ui.js')}}"></script>
<script src="{{ asset('site/js/popper.min.js')}}"></script>
<script src="{{ asset('site/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('site/js/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('site/js/moment.min.js')}}"></script>
<script src="{{ asset('site/js/daterangepicker.js')}}"></script>
<script src="{{ asset('site/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('site/js/jquery.fancybox.min.js')}}"></script>
<script src="{{ asset('site/js/jquery.countTo.min.js')}}"></script>
<script src="{{ asset('site/js/animated-headline.js')}}"></script>
<script src="{{ asset('site/js/jquery.ripples-min.js')}}"></script>
<script src="{{ asset('site/js/quantity-input.js')}}"></script>
<script src="{{ asset('site/js/main.js')}}"></script>
<script src="{{ asset('site/js/leaflet.js')}}"></script>
<script src="{{ asset('site/js/ajax-form.js')}}"></script>
<script src="{{ asset('site/js/map.js')}}"></script>

<script src="{{ asset('site/js/copy-text-script.js')}}"></script>
<script src="{{ asset('site/js/navbar-sticky.js')}}"></script>

</body>
</html>