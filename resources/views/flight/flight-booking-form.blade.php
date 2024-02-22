@include('site.header')

@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                $currency=$data['siteData']['currency'];  
                $currency_symbol=$data['siteData']['currency_symbol'];                
				$DOB=date('Y/m/d ', strtotime(date('m/d/Y').' -19 year')); 
         @endphp
         

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
    START BOOKING AREA
================================= -->
<section class="booking-area padding-top-100px padding-bottom-70px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="form-box">
                    <div class="form-title-wrap">
                        <h3 class="title">Traveler Information</h3>
                    </div><!-- form-title-wrap -->
                    <div class="form-content">
                        <div class="contact-form-action">
                            <form method="post" action="{{ asset('flight-final-checkout') }}">
                            @csrf
                            <input class="form-control" type="hidden" name="OfferId" id="OfferId" value="<?php echo $flightData->OfferId; ?>">
                            <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $flightData->id; ?>">
                                <div class="row">
                                <?php for($a=0;$a<$flightData->adults;$a++){ ?>
                                 <div class="form-title-wrap col-lg-12">
                                    <h3 class="title">Adult <?php echo $a+1; ?></h3>
                                 </div><!-- form-title-wrap -->
                                
                                	<div class="col-lg-2 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Title <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
                                                <select class="select-contain-select" name="passenger[adult][title][]" requited>
                                                        <option value="mr">Mr</option>
                                                        <option value="mrs">Mrs</option>
                                                        <option value="Mrs">Mrs</option>
                                                 </select>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">First Name <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input class="form-control" type="text" name="passenger[adult][first_name][]" placeholder="First name" requited>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-5 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Last Name</label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input class="form-control" type="text" name="passenger[adult][last_name][]" placeholder="Last name">
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-4 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">DOB <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon"></span>
                                               <input class="form-control date-picker-single2" type="text" name="passenger[adult][dob][]" value="{{$DOB}}" placeholder="" requited>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-4 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Gender <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
                                                <select class="select-contain-select" name="passenger[adult][gender][]" requited>
                                                        <option value="m">Male</option>
                                                        <option value="f">Female</option>
                                                        <option value="other">Other</option>
                                                 </select>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">ID </label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
                                                <input class="form-control" type="text" name="passenger[adult][id][]" placeholder="Document ID">
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                 <?php } ?>
            						<hr /><hr />
                                  <?php for($a=0;$a<$flightData->children;$a++){ ?>
                                 <div class="form-title-wrap col-lg-12">
                                    <h3 class="title">Children <?php echo $a+1; ?></h3>
                                 </div><!-- form-title-wrap -->
                                	<div class="col-lg-2 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Title <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
                                                <select class="select-contain-select" name="passenger[child][title][]" requited>
                                                        <option value="mr">Mr</option>
                                                        <option value="mrs">Mrs</option>
                                                        <option value="Mrs">Mrs</option>
                                                 </select>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">First Name <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input class="form-control" type="text" name="passenger[child][first_name][]" placeholder="First name" requited>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-5 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Last Name</label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input class="form-control" type="text" name="passenger[child][last_name][]" placeholder="Last name">
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-4 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">DOB <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon"></span>
                                                <input class="form-control date-picker-single2" type="text" name="passenger[child][dob][]" value="{{$DOB}}" requited>
                                            </div>
                                        </div>
                                    	</div><!-- end col-lg-6 -->
                                    </div>
                                    <div class="col-lg-4 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Gender <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
                                                <select class="select-contain-select" name="passenger[child][gender][]" requited>
                                                        <option value="m">Male</option>
                                                        <option value="f">Female</option>
                                                        <option value="other">Other</option>
                                                 </select>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">ID</label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
                                                <input class="form-control" type="text" name="passenger[child][id][]" placeholder="Enter ID" >
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                 
                                 <?php } ?>
                                 <hr /><hr />

                                  <?php for($a=0;$a<$flightData->infants;$a++){ ?>
                                 <div class="form-title-wrap col-lg-12">
                                    <h3 class="title">Infants <?php echo $a+1; ?></h3>
                                 </div><!-- form-title-wrap -->
                                
                                	<div class="col-lg-2 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Title <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
                                                <select class="select-contain-select" name="passenger[infant][title][]" requited>
                                                        <option value="mr">Mr</option>
                                                        <option value="mrs">Mrs</option>
                                                        <option value="Mrs">Mrs</option>
                                                 </select>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">First Name <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input class="form-control" type="text" name="passenger[infant][first_name][]" placeholder="First name" requited>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-5 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Last Name</label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input class="form-control" type="text" name="passenger[infant][last_name][]" placeholder="Last name">
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-4 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">DOB <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon"></span>
                                                <input class="form-control date-picker-single2" type="text" name="passenger[infant][dob][]" value="{{$DOB}}" requited>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-4 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Gender <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
                                                <select class="select-contain-select" name="passenger[infant][gender][]">
                                                        <option value="m">Male</option>
                                                        <option value="f">Female</option>
                                                        <option value="other">Other</option>
                                                 </select>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">ID </label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
                                                <input class="form-control" type="text" name="passenger[infant][id][]" placeholder="Enter ID">
                                               
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                                                  
                                 <?php } ?>

                                 
									<hr /><hr />
                                 

                                 <div class="col-lg-6 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Your Email <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <span class="la la-envelope-o form-icon"></span>
                                                <input class="form-control" type="email" name="passenger[email]" placeholder="Email address" requited>
                                            </div>

                                        </div>

                                    </div><!-- end col-lg-6 -->

                                 <div class="col-lg-6 responsive-column">

                                        <div class="input-box">

                                            <label class="label-text">Phone Number <span style="color:#FF0000">*</span></label>

                                            <div class="form-group">

                                                <span class="la la-phone form-icon"></span>

                                                <input class="form-control" type="text" name="passenger[phone]" placeholder="Phone Number" requited>

                                            </div>

                                        </div>

                                    </div><!-- end col-lg-6 --> 

                                    

                                    <div class="col-lg-12">

                                        <div class="input-box">

                                            <label class="label-text">Address <span style="color:#FF0000">*</span></label>

                                            <div class="form-group">

                                                <span class="la la-map-marked form-icon"></span>

                                                <input class="form-control" type="text" name="passenger[address]" placeholder="Address line" requited>

                                            </div>

                                        </div>

                                    </div><!-- end col-lg-12 -->

                                     <div class="col-lg-6">

                                        <div class="input-box">

                                            <label class="label-text">City <span style="color:#FF0000">*</span></label>

                                            <div class="form-group">

                                                <span class="la la-map-marked form-icon"></span>

                                                <input class="form-control" type="text" name="passenger[city]" placeholder="City" requited>

                                            </div>

                                        </div>

                                    </div><!-- end col-lg-12 -->

                                    <div class="col-lg-6 responsive-column">

                                        <div class="input-box">

                                            <label class="label-text">Country <span style="color:#FF0000">*</span></label>

                                            <div class="form-group">

                                                <div class="select-contain w-auto">

                                                    <select class="select-contain-select" name="passenger[country]" required>
                                                    <option value="select-country">Select country</option>
                                                    <option value="Afghanistan">Afghanistan</option>
                                                     @foreach($countryData as $key => $data)
                                                              <option value="{{$data->name}}">{{$data->name}}</option>
                                                              @endforeach
                                                  </select>

                                                </div>

                                            </div>

                                        </div>

                                    </div><!-- end col-lg-6 -->

                                   <?php if(!isset($sessionval['user_id'])){ $sessionval['user_type']=''; } ?>
                                    @if($sessionval['user_type']=='agent')
                                <input type="hidden" name="payment_type" value="wallet" />
                                @else
                  				<div class="col-lg-6 responsive-column" style="display:none">
                                        <div class="input-box">
                                            <label class="label-text">Choose Payment Type</label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
                                                    <select class="select-contain-select" name="payment_type">
                                                        <option value="flutterwave">Flutterwave</option>
                                                        <option value="braintree">Braintree</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   @endif

                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <div class="custom-checkbox mb-0">
                                                <input type="checkbox" id="receiveChb">
												<label for="receiveChb">Accept <a target="_blank" href="{{ asset('terms-and-condition')}}">Terms & Condition</a></label>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-12 -->

                                </div>

                            <button class="theme-btn" id="show_button" onclick="checkTerm()" type="button" >Confirm Booking</button>
                            <button style="display:none" class="theme-btn"  id="submit_btn" type="submit">Confirm Booking</button>
                            
                            <button style="background:#FF0000;display:none" id="NotAvalible" type="button">Flight No Longer Avalible Please Select Other Flight.</button>
                            
                            </form>

                        </div><!-- end contact-form-action -->

                    </div><!-- end form-content -->

                </div><!-- end form-box -->

                <?php /*?><div class="form-box">

                    <div class="form-title-wrap">

                        <h3 class="title">Your Card Information</h3>

                    </div><!-- form-title-wrap -->

                    <div class="form-content">

                        <div class="section-tab check-mark-tab text-center pb-4">

                            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">

                                <li class="nav-item">

                                    <a class="nav-link active" id="credit-card-tab" data-toggle="tab" href="#credit-card" role="tab" aria-controls="credit-card" aria-selected="false">

                                        <i class="la la-check icon-element"></i>

                                        <img src="<?php echo url(' ');?>assets/images/payment-img.png" alt="">

                                        <span class="d-block pt-2">Payment with credit card</span>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" id="paypal-tab" data-toggle="tab" href="#paypal" role="tab" aria-controls="paypal" aria-selected="true">

                                        <i class="la la-check icon-element"></i>

                                        <img src="<?php echo url(' ');?>assets/images/paypal.png" alt="">

                                        <span class="d-block pt-2">Payment with PayPal</span>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" id="payoneer-tab" data-toggle="tab" href="#payoneer" role="tab" aria-controls="payoneer" aria-selected="true">

                                        <i class="la la-check icon-element"></i>

                                        <img src="<?php echo url(' ');?>assets/images/payoneer.png" alt="">

                                        <span class="d-block pt-2">Payment with payoneer</span>

                                    </a>

                                </li>

                            </ul>

                        </div><!-- end section-tab -->

                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="credit-card" role="tabpanel" aria-labelledby="credit-card-tab">

                                <div class="contact-form-action">

                                    <form method="post">

                                        <div class="row">

                                            <div class="col-lg-6 responsive-column">

                                                <div class="input-box">

                                                    <label class="label-text">Card Holder Name</label>

                                                    <div class="form-group">

                                                        <span class="la la-credit-card form-icon"></span>

                                                        <input class="form-control" type="text" name="text" placeholder="Card holder name">

                                                    </div>

                                                </div>

                                            </div><!-- end col-lg-6 -->

                                            <div class="col-lg-6 responsive-column">

                                                <div class="input-box">

                                                    <label class="label-text">Card Number</label>

                                                    <div class="form-group">

                                                        <span class="la la-credit-card form-icon"></span>

                                                        <input class="form-control" type="text" name="text" placeholder="Card number">

                                                    </div>

                                                </div>

                                            </div><!-- end col-lg-6 -->

                                            <div class="col-lg-6">

                                                <div class="row">

                                                    <div class="col-lg-6 responsive-column">

                                                        <div class="input-box">

                                                            <label class="label-text">Expiry Month</label>

                                                            <div class="form-group">

                                                                <span class="la la-credit-card form-icon"></span>

                                                                <input class="form-control" type="text" name="text" placeholder="MM">

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-lg-6 responsive-column">

                                                        <div class="input-box">

                                                            <label class="label-text">Expiry Year</label>

                                                            <div class="form-group">

                                                                <span class="la la-credit-card form-icon"></span>

                                                                <input class="form-control" type="text" name="text" placeholder="YY">

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div><!-- end col-lg-6 -->

                                            <div class="col-lg-6">

                                                <div class="input-box">

                                                    <label class="label-text">CVV</label>

                                                    <div class="form-group">

                                                        <span class="la la-pencil form-icon"></span>

                                                        <input class="form-control" type="text" name="text" placeholder="CVV">

                                                    </div>

                                                </div>

                                            </div><!-- end col-lg-6 -->

                                            <div class="col-lg-12">

                                                <div class="input-box">

                                                    <div class="form-group">

                                                        <div class="custom-checkbox">

                                                            <input type="checkbox" id="agreechb">

                                                            <label for="agreechb">By continuing, you agree to the <a href="#">Terms and Conditions</a>.</label>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div><!-- end col-lg-12 -->

                                            <div class="col-lg-12">

                                                <div class="btn-box">

                                                    <button class="theme-btn" type="submit">Confirm Booking</button>

                                                </div>

                                            </div><!-- end col-lg-12 -->

                                        </div>

                                    </form>

                                </div><!-- end contact-form-action -->

                            </div><!-- end tab-pane-->

                            <div class="tab-pane fade" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">

                                <div class="contact-form-action">

                                    <form method="post">

                                        <div class="row">

                                            <div class="col-lg-6 responsive-column">

                                                <div class="input-box">

                                                    <label class="label-text">Email Address</label>

                                                    <div class="form-group">

                                                        <span class="la la-envelope form-icon"></span>

                                                        <input class="form-control" type="email" name="email" placeholder="Enter email address">

                                                    </div>

                                                </div>

                                            </div><!-- end col-lg-6 -->

                                            <div class="col-lg-6 responsive-column">

                                                <div class="input-box">

                                                    <label class="label-text">Password</label>

                                                    <div class="form-group">

                                                        <span class="la la-lock form-icon"></span>

                                                        <input class="form-control" type="text" name="text" placeholder="Enter password">

                                                    </div>

                                                </div>

                                            </div><!-- end col-lg-6 -->

                                            <div class="col-lg-12">

                                                <div class="btn-box">

                                                    <button class="theme-btn" type="submit">Login Account</button>

                                                </div>

                                            </div><!-- end col-lg-12 -->

                                        </div>

                                    </form>

                                </div><!-- end contact-form-action -->

                            </div><!-- end tab-pane-->

                            <div class="tab-pane fade" id="payoneer" role="tabpanel" aria-labelledby="payoneer-tab">

                                <div class="contact-form-action">

                                    <form method="post">

                                        <div class="row">

                                            <div class="col-lg-6 responsive-column">

                                                <div class="input-box">

                                                    <label class="label-text">Email Address</label>

                                                    <div class="form-group">

                                                        <span class="la la-envelope form-icon"></span>

                                                        <input class="form-control" type="email" name="email" placeholder="Enter email address">

                                                    </div>

                                                </div>

                                            </div><!-- end col-lg-6 -->

                                            <div class="col-lg-6 responsive-column">

                                                <div class="input-box">

                                                    <label class="label-text">Password</label>

                                                    <div class="form-group">

                                                        <span class="la la-lock form-icon"></span>

                                                        <input class="form-control" type="text" name="text" placeholder="Enter password">

                                                    </div>

                                                </div>

                                            </div><!-- end col-lg-6 -->

                                            <div class="col-lg-12">

                                                <div class="btn-box">

                                                    <button class="theme-btn" type="submit">Login Account</button>

                                                </div>

                                            </div><!-- end col-lg-12 -->

                                        </div>

                                    </form>

                                </div><!-- end contact-form-action -->

                            </div><!-- end tab-pane-->

                        </div><!-- end tab-content -->

                    </div><!-- end form-content -->

                </div><?php */?><!-- end form-box -->

            </div><!-- end col-lg-8 -->

            <div class="col-lg-4">

                <div class="form-box booking-detail-form">

                    <div class="form-title-wrap">

                        <h3 class="title">Booking Details</h3>

                    </div><!-- end form-title-wrap -->

                    <div class="form-content">

                        <div class="card-item shadow-none radius-none mb-0">

                            <div class="card-img pb-4">

                                <a href="#" class="d-block">

                                    <img src="https://res.cloudinary.com/wego/image/upload/c_fit,w_100,h_100/v20190802/flights/airlines_square/<?php echo $flightData->validating_carrier; ?>" alt="plane-img">

                                </a>

                            </div>

                            <div class="card-body p-0">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <h3 class="card-title"><?php echo $flightData->cityFrom; ?> to <?php echo $flightData->cityTo; ?></h3>

                                        <p class="card-meta"><?php if($flightData->is_return==0){ echo "One way Flight"; }else{ echo "Return Flight"; } ?></p>

                                    </div>

                                   

                                </div>

                                <!--<div class="card-rating">

                                    <span class="badge text-white">4.4/5</span>

                                    <span class="review__text">Average</span>

                                    <span class="rating__text">(30 Reviews)</span>

                                </div>-->

                                <div class="section-block"></div>

                                <ul class="list-items list-items-2 list-items-flush py-2">

                                    <li class="font-size-15"><span class="w-auto d-block mb-n1"><i class="la la-plane mr-1 font-size-17"></i>Take off</span><?php echo date('d M  Y  h:i:s',$flightData->departure_datetime); ?></li>

                                    <li class="font-size-15"><i class="la la-clock-o mr-1 text-black font-size-17"></i><?php echo floor($flightData->duration/3600).' Hours '.floor(($flightData->duration/60)%60).' Minutes' ?></li>

                                    <li class="font-size-15"><span class="w-auto d-block mb-n1"><i class="la la-plane mr-1 font-size-17"></i>Landing</span><?php echo date('d M  Y  h:i:s',$flightData->arrival_datetime); ?></li>

                                </ul>

                                <?php $onewayFlights=json_decode($flightData->onewayFlights,true); ?>

                                <h3 class="card-title pb-3">Order Details</h3>

                                <div class="section-block"></div>

                                <ul class="list-items list-items-2 py-3">

                                    <li><span>Airline:</span><?php echo $onewayFlights[0]['airline_name'];  ?> </li>

                                    <li><span>Flight Type:</span><?php echo $flightData->CabinClass; ?></li>

                                    <li><span>Passengers:</span>Adult: <?php echo $flightData->adults; ?> Children: <?php echo $flightData->children; ?> Infants: <?php echo $flightData->infants; ?></li>

                                </ul>

                                <div class="section-block"></div>

                                <ul class="list-items list-items-2 pt-3">

                                    <li><span>Base Fare:</span><span class="base_fare">...<?php //echo $flightData->base_fare; ?></span></li>

                                    <li><span>Taxes And Fees:</span><span class="tax">...<?php //echo $flightData->tax; ?></span></li>

                                    <li><span>Total Price:</span><span class="total_amount">...<?php //echo $flightData->price; ?></span></li>

                                </ul>

                            </div>

                        </div><!-- end card-item -->

                    </div><!-- end form-content -->

                </div><!-- end form-box -->

            </div><!-- end col-lg-4 -->

        </div><!-- end row -->

    </div><!-- end container -->

</section><!-- end booking-area -->

<!-- ================================

    END BOOKING AREA

================================= -->



<div class="section-block"></div>





<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
								
function checkTerm()
{
	var val=$("#receiveChb").prop("checked");
	if(val==true){
		$("#submit_btn").trigger("click");
	}
	else{
		alert('Please Accept Terms and Condition.');
	}
		
}
								

var innerHtml=''; var page=0; var search_session='';

      jQuery(document).ready(function(){

	 // var innerHtml='<div class="loader"><svg class="spinner" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg></div>';   jQuery('.flight_ist').html(innerHtml);	
			   			 $.ajax({
								url:'<?php url(''); ?>/recheck_flight',
								type: "GET",
								data: {
									action: "recheck_flight",
									id: "<?php echo $flightData->id; ?>",
									rand: "<?php echo rand(); ?>",
								},
								dataType: "json",  
								success: function (data) {
									if(typeof data.errors === 'object'){ 
										alert('Flight No Longer Avalible. Please Select Other Flight.'); $("#show_button").hide(); $("#NotAvalible").show(); 
									}
									else if(typeof data.data === 'object'){
										document.getElementById('api_currency').value=data.data.total_currency; 
										document.getElementById('currency_main').value=data.data.currency;
										document.getElementById('chargeableRate').value=data.data.total_amount;
										document.getElementById('apiPrice').value=data.data.apiPrice;
										document.getElementById('base_fare').value=data.data.base_amount;
										document.getElementById('tax').value=data.data.tax_amount;
										
										jQuery('.base_fare').html(data.data.currency_symbol+' '+parseFloat(data.data.base_amount).toLocaleString());
										jQuery('.tax').html(data.data.currency_symbol+' '+parseFloat(data.data.tax_amount).toLocaleString());
										jQuery('.total_amount').html(data.data.currency_symbol+' '+parseFloat(data.data.total_amount).toLocaleString());
									}else{
										alert('Error Occur.'); $("#show_button").hide(); $("#NotAvalible").show();
									}
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							});
      });	   
      </script>

@include('site.footer')