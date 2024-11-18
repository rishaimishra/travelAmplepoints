@include('site.header')

@inject('provider', 'App\Http\Controllers\Site')
  @inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images_main=  $data['siteData']['images'];
                $images_main=json_decode($images_main,true);
                 $sessionval=session()->all();
                $currency=$data['siteData']['currency'];   
                $currency_symbol=$data['siteData']['currency_symbol']; 
                $DOB=date('Y/m/d ', strtotime(date('m/d/Y').' -19 year'));
         @endphp
         
<section class="booking-area padding-top-100px padding-bottom-70px">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="form-box">
          <div class="form-title-wrap">
            <h3 class="title">Traveler Information</h3>
          </div>
          <!-- form-title-wrap -->
          <div class="form-content">
            <div class="contact-form-action">
              <form method="post" action="{{ asset('tours-final-checkout') }}">
              @csrf
                <input class="form-control" type="hidden" name="code" id="code" value="<?php echo $activitySearchData->code; ?>">
                <input class="form-control" type="hidden" name="search_id" id="search_id" value="<?php echo $activitySearchData->search_session; ?>">
                <input class="form-control" type="hidden" name="ref_id" id="ref_id" value="<?php echo $activitySearchData->id; ?>">
                <input class="form-control" type="hidden" name="paymentType" id="paymentType" value="">
                <input class="form-control" type="hidden" name="ratekey" id="ratekey" value="<?php echo $ratekey; ?>">
                <input class="form-control" type="hidden" name="code" id="code" value="<?php echo $code; ?>">
                <input class="form-control" type="hidden" name="agent_id" id="agent_id">
                <input class="form-control" type="hidden" name="user_id" id="user_id" value="<?php if(isset($sessionval['user_id'])){ echo $sessionval['user_id']; } ?>">
                <input class="form-control" type="hidden" name="currency" id="currency_main">
                <input class="form-control" type="hidden" name="api_currency" id="api_currency" value="<?php echo $activitySearchData->api_currency; ?>">
                <input class="form-control" type="hidden" name="apiPrice" id="apiPrice"  value="{{$activitySearchData->api_price}}">
                <input class="form-control" type="hidden" name="chargeableRate" id="chargeableRate" value="<?php echo $provider::convertCurrencyRateFlight($activitySearchData->api_currency,$activitySearchData->api_price); ?>">
                <input class="form-control" type="hidden" name="base_fare" id="base_fare" value="{{$activitySearchData->api_price}}">
                <input class="form-control" type="hidden" name="tax" id="tax">
                <div class="inpurroomdata"></div>
                <div class="row">
                  <?php for($a=0;$a<$activitySearchData->adults;$a++){ ?>
                  <div class="form-title-wrap col-lg-12">
                    <h3 class="title">Adult <?php echo $a+1; ?></h3>
                  </div>
                  <!-- form-title-wrap -->
                  <div class="col-lg-2 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Title <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <div class="select-contain w-auto">
                          <select class="select-contain-select" name="passenger[adult][title][]" required>
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
                      <div class="form-group"> <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="passenger[adult][first_name][]" placeholder="First name" required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-5 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Last Name</label>
                      <div class="form-group"> <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="passenger[adult][last_name][]" placeholder="Last name">
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">DOB <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-calendar form-icon"></span>
                        <input class="form-control date-picker-single2" type="text" name="passenger[adult][dob][]" value="{{$DOB}}" readonly required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Gender <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <div class="select-contain w-auto">
                          <select class="select-contain-select" name="passenger[adult][gender][]" required>
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
                          <input class="form-control" type="text" name="passenger[adult][id][]" placeholder="Enter ID">
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <?php for($a=0;$a<$activitySearchData->childs;$a++){ ?>
                  <div class="form-title-wrap col-lg-12">
                    <h3 class="title">Children <?php echo $a+1; ?></h3>
                  </div>
                  <!-- form-title-wrap -->
                  <div class="col-lg-2 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Title <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <div class="select-contain w-auto">
                          <select class="select-contain-select" name="passenger[child][title][]" required>
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
                      <div class="form-group"> <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="passenger[child][first_name][]" placeholder="First name" required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-5 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Last Name</label>
                      <div class="form-group"> <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="passenger[child][last_name][]" placeholder="Last name">
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">DOB <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <input class="form-control date-picker-single2" type="text" name="passenger[child][dob][]" value="{{$DOB}}"  readonly required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Gender <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <div class="select-contain w-auto">
                          <select class="select-contain-select" name="passenger[child][Gender][]">
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
                  <div class="col-lg-6 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Your Email <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-envelope-o form-icon"></span>
                        <input class="form-control" type="email" name="passenger[email]" placeholder="Email address" required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-6 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Phone Number <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-phone form-icon"></span>
                        <input class="form-control" type="text" name="passenger[phone]" placeholder="Phone Number" required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-12">
                    <div class="input-box">
                      <label class="label-text">Address <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-map-marked form-icon"></span>
                        <input class="form-control" type="text" name="passenger[address]" placeholder="Address line" required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-12 -->
                  <div class="col-lg-6 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Postal/Zip Code <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-phone form-icon"></span>
                        <input class="form-control" type="text" name="passenger[pin_code]" placeholder="Postal/Zip code" required>
                      </div>
                    </div>
                  </div>
                   <!-- end col-lg-12 -->
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
                  </div>
                  <!-- end col-lg-6 --> <?php if(!isset($sessionval['user_id'])){ $sessionval['user_type']=''; } ?>
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
                  </div>
                  <!-- end col-lg-12 -->
                </div>
                <button class="theme-btn" onclick="checkTerm()" type="button" >Confirm Booking</button>
 				<button style="display:none" class="theme-btn"  id="submit_btn" type="cubmit">Confirm Booking</button>
              </form>
            </div>
            <!-- end contact-form-action -->
          </div>
          <!-- end form-content -->
        </div>
        <!-- end form-box -->       
      </div>
      <!-- end col-lg-8 -->
      <div class="col-lg-4">
        <div class="form-box booking-detail-form">
          <div class="form-title-wrap">
            <h3 class="title">Booking Details</h3>
          </div>
          <!-- end form-title-wrap -->
          <div class="form-content">
            <div class="card-item shadow-none radius-none mb-0">
              <div class="card-img pb-4"> <a href="#" class="d-block"> <img src="<?php echo $activitySearchData->thumbNailUrl; ?>" alt="plane-img"> </a> </div>
              <div class="card-body p-0">
                <div class="d-flex justify-content-between">
                  <div>
                    <h3 class="card-title"><?php echo $activitySearchData->name; ?> </h3>
                    <p class="card-meta"><?php echo $activitySearchData->destination;  ?></p>
                  </div>
                  <!--<div> <a href="<?php url('');?>" class="btn ml-1"><i class="la la-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> </div>-->
                </div>
                <!--<div class="card-rating">
                                    <span class="badge text-white">4.4/5</span>
                                    <span class="review__text">Average</span>
                                    <span class="rating__text">(30 Reviews)</span>
                                </div>-->
                <div class="section-block"></div>
                <ul class="list-items list-items-2 list-items-flush py-2">
                  <li class="font-size-15"><span class="w-auto d-block mb-n1"><i class="la la-plane mr-1 font-size-17"></i>Check In</span><?php echo date('d M  Y  ',strtotime($activitySearchData->checkin)); ?></li>
                  <li class="font-size-15"><span class="w-auto d-block mb-n1"><i class="la la-plane mr-1 font-size-17"></i>Check Out</span><?php echo date('d M  Y  ',strtotime($activitySearchData->checkout)); ?></li>
                </ul>
                <h3 class="card-title pb-3">Order Details</h3>
                <div class="section-block"></div>
                <ul class="list-items list-items-2 py-3">
                  <li><span>Activity Type:</span><?php echo $activitySearchData->activity_type;  ?> </li>
                  <li><span>Source:</span><?php echo $activitySearchData->source; ?></li>
                  <li><span>Categories:</span><?php echo $activitySearchData->categories; ?></li>
                  <li><span>Duration:</span><?php echo $activitySearchData->duration; ?></li>
                  <li><span>Passengers:</span>Adult: <?php echo $activitySearchData->adults; ?> Children: <?php echo $activitySearchData->childs; ?></li>
                </ul>
                <div class="section-block"></div>
                <ul class="list-items list-items-2 pt-3 price_details">
                  <li><span>Total Fare:</span><span class="base_fare"><?php  echo $currency_symbol." ".$provider::convertCurrencyRateFlight($activitySearchData->api_currency,$activitySearchData->api_price); ?></span></li>
                </ul>
              </div>
            </div>
            <!-- end card-item -->
          </div>
          <!-- end form-content -->
        </div>
        <!-- end form-box -->
      </div>
      <!-- end col-lg-4 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">

var innerHtml=''; var page=0; var search_session='';
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
      jQuery(document).ready(function(){

	 // var innerHtml='<div class="loader"><svg class="spinner" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg></div>';   jQuery('.flight_ist').html(innerHtml);	

	 //'action=RoomAvailability&pid='+$scope.pid+'&hotelId=' + $scope.hotelId + '&regionid=' + $scope.regionid + '&boardCode='+$scope.boardCode+'&rateClass='+$scope.rateClass+'&roomCodeIds='+$scope.roomCodeIds+'&checkIn=' + $scope.checkIn + '&checkOut=' + $scope.checkOut + '&rooms=' + $scope.rooms + '&adults=' + $scope.adults + '&children=' + $scope.children + '&childAge='+$scope.childage+'&group='+$scope.group+'&language=' + $scope.language + '&isCombo='+$scope.isCombo+'&currency=' + $scope.currency;
      });	   
      </script>
@include('site.footer')