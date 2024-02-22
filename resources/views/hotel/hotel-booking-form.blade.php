<!-- ================================
    START BREADCRUMB AREA
================================= -->

@include('site.header')

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
          </div>
          <!-- form-title-wrap -->
          <div class="form-content">
            <div class="contact-form-action">
              <form method="post" action="{{ asset('hotel-final-checkout') }}">
              @csrf
                <input class="form-control" type="hidden" name="EANHotelID" id="EANHotelID" value="<?php echo $hotelSearchData->EANHotelID; ?>">
                <input class="form-control" type="hidden" name="search_id" id="search_id" value="<?php echo $hotelSearchData->search_session; ?>">
                <input class="form-control" type="hidden" name="ref_id" id="ref_id" value="<?php echo $hotelSearchData->id; ?>">
                <input class="form-control" type="hidden" name="paymentType" id="paymentType" value="<?php echo $hotelSearchData->paymentType; ?>">
                <input class="form-control" type="hidden" name="agent_id" id="agent_id">
                <input class="form-control" type="hidden" name="user_id" id="user_id" value="<?php if(isset($sessionval['user_id'])){ echo $sessionval['user_id']; } ?>">
                <input class="form-control" type="hidden" name="currency" id="currency_main">
                <input class="form-control" type="hidden" name="api_currency" id="api_currency" value="<?php echo $hotelSearchData->api_currency; ?>">
                <input class="form-control" type="hidden" name="apiPrice" id="apiPrice">
                <input class="form-control" type="hidden" name="chargeableRate" id="chargeableRate">
                <input class="form-control" type="hidden" name="base_fare" id="base_fare">
                <input class="form-control" type="hidden" name="tax" id="tax">
                <span class="inpurroomdata"></span>
                
                <div class="row">
                  <?php 
				  $AdultArr=json_decode($hotelSearchData->Cri_Adults,true);
				  $ChildArr=json_decode($hotelSearchData->Cri_Childs,true);
				   for($r=0;$r<$hotelSearchData->rooms;$r++){ ?>
                   <div class="form-title-wrap col-lg-12">
                    <h3 class="title">Room <?php echo $r+1; ?></h3>
                  </div>
                  <?php for($a=0;$a<$AdultArr[$r];$a++){ ?>
                  <div class="form-title-wrap col-lg-12">
                    <h3 class="title">Adult <?php echo $a+1; ?></h3>
                  </div>
                  <!-- form-title-wrap -->
                  <div class="col-lg-2 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Title <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <div class="select-contain w-auto">
                          <select class="select-contain-select" name="passenger[adult][title][<?php echo $r; ?>][]" required>
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
                        <input class="form-control" type="text" name="passenger[adult][first_name][<?php echo $r; ?>][]" placeholder="First name" required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-5 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Last Name</label>
                      <div class="form-group"> <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="passenger[adult][last_name][<?php echo $r; ?>][]" placeholder="Last name">
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">DOB <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-calendar form-icon"></span>
                        <input class="form-control date-picker-single2" value="{{$DOB}}" type="text" name="passenger[adult][dob][<?php echo $r; ?>][]" readonly required>
                        
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Gender <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <div class="select-contain w-auto">
                          <select class="select-contain-select" name="passenger[adult][gender][<?php echo $r; ?>][]" required>
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
                          <input class="form-control" type="text" name="passenger[adult][id][<?php echo $r; ?>][]" placeholder="Enter ID" >
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <?php for($a=0;$a<$ChildArr[$r];$a++){ ?>
                  <div class="form-title-wrap col-lg-12">
                    <h3 class="title">Children <?php echo $a+1; ?></h3>
                  </div>
                  <!-- form-title-wrap -->
                  <div class="col-lg-2 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Title <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <div class="select-contain w-auto">
                          <select class="select-contain-select" name="passenger[child][title][<?php echo $r; ?>][]" required>
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
                        <input class="form-control" type="text" name="passenger[child][first_name][<?php echo $r; ?>][]" placeholder="First name" required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-5 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Last Name</label>
                      <div class="form-group"> <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="passenger[child][last_name][<?php echo $r; ?>][]" placeholder="Last name">
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">DOB <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <input class="form-control date-picker-single2" value="{{$DOB}}" type="text" name="passenger[child][dob][<?php echo $r; ?>][]" readonly required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Gender <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <div class="select-contain w-auto">
                          <select class="select-contain-select" name="passenger[child][Gender][<?php echo $r; ?>][]" required>
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
                          <input class="form-control" type="text" name="passenger[child][id][<?php echo $r; ?>][]" placeholder="Enter ID" >
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php }
				  echo "<hr>";
				   }?>
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
                      <label class="label-text">Phone Number <span style="color:#FF0000">*</span> </label>
                      <div class="form-group"> <span class="la la-phone form-icon"></span>
                        <input class="form-control" type="text" name="passenger[phone]" placeholder="Phone Number" required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-6">
                    <div class="input-box">
                      <label class="label-text">Address Line <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-map-marked form-icon"></span>
                        <input class="form-control" type="text" name="passenger[address]" placeholder="Address line" required>
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
              <div class="card-img pb-4"> <a href="#" class="d-block"> <img src="<?php echo $hotelSearchData->thumbNailUrl; ?>" alt="plane-img"> </a> </div>
              <div class="card-body p-0">
                <div class="d-flex justify-content-between">
                  <div>
                    <h3 class="card-title"><?php echo $hotelSearchData->Name; ?> </h3>
                    <p class="card-meta"><?php echo $hotelSearchData->address1;  ?></p>
                  </div>
                </div>
               
                <div class="section-block"></div>
                <ul class="list-items list-items-2 list-items-flush py-2">
                  <li class="font-size-15"><span class="w-auto d-block mb-n1"><i class="la la-plane mr-1 font-size-17"></i>Check In</span><?php echo date('d M  Y  ',strtotime($hotelSearchData->checkin)); ?></li>
                  <li class="font-size-15"><span class="w-auto d-block mb-n1"><i class="la la-plane mr-1 font-size-17"></i>Check Out</span><?php echo date('d M  Y  ',strtotime($hotelSearchData->checkout)); ?></li>
                </ul>
                <h3 class="card-title pb-3">Order Details</h3>
                <div class="section-block"></div>
                <ul class="list-items list-items-2 py-3">
                  <li><span>Board Name:</span><?php echo $hotelSearchData->boardName;  ?> </li>
                  <li><span>Payment Type:</span><?php echo $hotelSearchData->paymentType; ?></li>
                  <li>
				  		   <?php 
							$AdultsArr=json_decode($hotelSearchData->Cri_Adults,true);
							$ChildsArr=json_decode($hotelSearchData->Cri_Childs,true);
							$ChildAgeArr=json_decode($hotelSearchData->child_age,true);
							for($i=0;$i<$hotelSearchData->rooms;$i++){ ?>
                            <br />
                            <div class="sidebar-widget-item">
                                <div class="qty-box mb-2 d-flex align-items-center justify-content-between">
                                    <label class="font-size-16">Room {{$i+1}}<span></span></label>
                                    <div class="qtyBtn d-flex align-items-center">
                                    </div>
                                </div><!-- end qty-box -->
                            </div>
                            <div class="sidebar-widget-item">
                                <div class="qty-box mb-2 d-flex align-items-center justify-content-between">
                                    <div class=" d-flex align-items-center">
                                        <input class=" form-control" type="text" name="Cri_Adults"  value="Adult(s): <?php echo $AdultsArr[$i]; ?>" readonly>
                                        &nbsp;&nbsp;
                                        <input class=" form-control" type="text" name="Cri_Adults"  value="Children: <?php echo $ChildsArr[$i]; ?>" readonly>
                                        
                                    </div>                                   
                                </div><!-- end qty-box -->
                                 <?php for($c=0;$c<$ChildsArr[$i];$c++){ ?>
                                 <div class="qty-box mb-2 d-flex align-items-center justify-content-between">
                                    <div class=" d-flex align-items-center">
                                        <input class=" form-control" type="text" name="Cri_Adults"  value="Child {{$c+1}} Age : <?php echo $ChildAgeArr[$i][$c]; ?>" readonly>	</div></div>
										<?php } ?>
                            </div><!-- end sidebar-widget-item -->
                            <?php } ?>
                  </li>
                </ul>
                <div class="section-block"></div>
                <ul class="list-items list-items-2 pt-3 price_details">
                  <!--<li><span>Base Fare:</span><span class="base_fare"><?php $hotelSearchData->currency." ".$hotelSearchData->lowRate;?></span></li>
                  <li><span>Taxes And Fees:</span><span class="tax"><?php echo $hotelSearchData->currency; ?> </span></li>-->
                  <li><span>Total Price:</span><span class="total_amount"><?php echo $hotelSearchData->currency." ".$hotelSearchData->lowRate; ?></span></li>
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

	 

	 //'action=RoomAvailability&pid='+$scope.pid+'&hotelId=' + $scope.hotelId + '&regionid=' + $scope.regionid + '&boardCode='+$scope.boardCode+'&rateClass='+$scope.rateClass+'&roomCodeIds='+$scope.roomCodeIds+'&checkIn=' + $scope.checkIn + '&checkOut=' + $scope.checkOut + '&rooms=' + $scope.rooms + '&adults=' + $scope.adults + '&children=' + $scope.children + '&childAge='+$scope.childage+'&group='+$scope.group+'&language=' + $scope.language + '&isCombo='+$scope.isCombo+'&currency=' + $scope.currency;

	 

	  RoomAvailability();  
			   			 function RoomAvailability(){  
			   			 $.ajax({ 
								url:'/RoomAvailability',
								type: "GET",
								data: {
									action: "RoomAvailability",  
									hotelId: "<?php echo $hotelSearchData->EANHotelID; ?>",
									regionid: "<?php echo $hotelSearchData->desti_lat_lon; ?>",
									destination: "<?php echo $hotelSearchData->city; ?>",
									checkIn: "<?php echo $hotelSearchData->checkin; ?>",  
									checkOut: "<?php echo $hotelSearchData->checkout; ?>",
									rooms: "<?php echo $hotelSearchData->rooms; ?>",
									adults: '<?php echo $hotelSearchData->Cri_Adults; ?>',
									childs: '<?php echo $hotelSearchData->Cri_Childs; ?>',  
									boardCode: "<?php  echo $board;  ?>",
									rateClass: "<?php  echo $rateClass;  ?>",
									roomCodeIds: "<?php  echo $roomCodeIds;  ?>",
									search_session: "<?php echo $hotelSearchData->search_session; ?>",
									tid: "<?php echo $hotelSearchData->id; ?>",
								},
								dataType: "json",
								success: function (response) {
								var SelectedRoom=response.responseData.SelectedRoom;
								var innerHtml='';
								var priceHtml ='';
								var total_price=0;
								var total_apiPrice=0;
								for(var i=0;i<SelectedRoom.length;i++){
									innerHtml +='<ul style="display:none" >';
									innerHtml +='<input  name="roomPrice[]" value="'+SelectedRoom[i].rates.net+'"/>';
									innerHtml +='<input name="roomName[]" value="'+SelectedRoom[i].name+'" />';
									innerHtml +='<input name="rateClass[]" value="'+SelectedRoom[i].rates.rateClass+'" />';
									innerHtml +='<input name="boardCode[]" value="'+SelectedRoom[i].rates.boardCode+'" />';
									innerHtml +='<input name="boardName[]" value="'+SelectedRoom[i].rates.boardName+'" />';
									innerHtml +='<input name="rateType[]" value="'+SelectedRoom[i].rates.rateType+'" />';
									innerHtml +='<input name="paymentType" value="'+SelectedRoom[i].rates.paymentType+'" />';
									innerHtml +='<input name="rateCommentsId[]" value="'+SelectedRoom[i].rates.rateCommentsId+'" />';
								innerHtml +='<textarea type="text" name="rateKey[]" style="white-space: pre-line">'+SelectedRoom[i].rates.rateKey+'</textarea>';
									innerHtml +='</ul>';

									priceHtml +='Room: '+parseInt(parseInt(i)+parseInt(1))+'<li><span>Base Fare:</span><span class="base_fare">'+response.currency_symbol+' '+SelectedRoom[i].rates.net.toFixed(2)+'</span></li>';
									total_price=parseFloat(total_price)+parseFloat(SelectedRoom[i].rates.net);
									total_apiPrice=parseFloat(total_apiPrice)+parseFloat(SelectedRoom[i].rates.api_price);
									
								}
								priceHtml +='<li><span>Total Price:</span><span class="total_amount">'+response.currency_symbol+' '+total_price+'</span></li>';
								jQuery('.price_details').html(priceHtml);
								jQuery('.total_amount').html(response.currency_symbol+' '+total_price.toFixed(2));
								jQuery('.inpurroomdata').html(innerHtml);
								document.getElementById('currency_main').value=response.currency;
								document.getElementById('chargeableRate').value=total_price.toFixed(2);
								document.getElementById('apiPrice').value=total_apiPrice.toFixed(2);
								},
								error: function (error) {
									console.log(`Error ${error}`);

								}
							});
							}
      });	   
      </script>
@include('site.footer')