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
                $order_id=$hotelData->order_id;
                $payment_ststus=$hotelData->payment_status;
                 $booking_ststus=$hotelData->booking_status;
                if($hotelData->itineraryId==''){ $itineraryId='-'; }else { $PNR=$hotelData->itineraryId; } 
                if($payment_ststus=='Confirmed'){ $paycolor='#00FF00'; }else{ $paycolor='#FF0000'; }
                if($booking_ststus=='Confirmed'){ $bookcolor='#00FF00'; }else{ $bookcolor='#FF0000'; } 
         @endphp
<!-- ================================
    START BOOKING AREA
================================= -->
<section class="payment-area section-bg section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-box payment-received-wrap mb-0">
                    <div class="form-title-wrap">
                        <div class="step-bar-wrap text-center">
                            <ul class="step-bar-list d-flex align-items-center justify-content-around">
                                <li class="step-bar flex-grow-1 step-bar-active">
                                    <span class="icon-element">1</span>
                                    <p class="pt-2 color-text-2" style="color:#00FF00">Choose Your Hotel</p>
                                </li>
                                <li class="step-bar flex-grow-1 @if($payment_ststus=='Confirmed') step-bar-active @endif">
                                    <span class="icon-element">2</span>
                                    <p class="pt-2 color-text-2" style="color:{{$paycolor}}">Payment {{$payment_ststus}}</p>
                                </li>
                                <li class="step-bar flex-grow-1 @if($booking_ststus=='Confirmed') step-bar-active @endif">
                                    <span class="icon-element">3</span>
                                    <p class="pt-2 color-text-2" style="color:{{$bookcolor}}">Booking {{$booking_ststus}}!</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-content">
                        <div class="payment-received-list">
                            <div class="d-flex align-items-center">
                                <i class="la la-check icon-element flex-shrink-0 mr-3 ml-0"></i>
                                <div>
                                    <h3 class="title pb-1">Hi, {{$hotelData->user_name}} </h3>
                                    <h3 class="title" style="color:{{$bookcolor}}">Your booking  is {{$hotelData->booking_status}}.</h3>
                                    @if($hotelData->error_message!='')<p style="color:#FF0000">Error: {{$hotelData->error_message}}</p>@endif
                                </div>
                            </div>
                            <ul class="list-items py-4">
                                <li><i class="la la-check text-success mr-2"></i>Your <strong class="text-black">Payment</strong> have been {{$hotelData->payment_status}}.  </li>
                        <!--<li><i class="la la-check text-success mr-2"></i>Make changes to your booking or ask the properly a question in just a few clicks</li>-->
                            </ul>
                            <div class="btn-box pb-4">
                                <a href="#" class="theme-btn mb-2 mr-2">Itinerary Id: {{$hotelData->itineraryId}} </a>
                                <a href="#" class="theme-btn mb-2 theme-btn-transparent">Order Id : {{$hotelData->order_id}} </a>
                            </div>
                            <h3 class="title"><a href="#" class="text-black">{{$hotelData->hotelName}}</a></h3>
                            <p>{{$hotelData->hotelAddress}}</p>
                            
                            <ul class="list-items list-items-3 list-items-4 py-4">
                                <li><span class="text-black font-weight-bold">Email</span>({{$hotelData->user_email}})</li>
                                <li><span class="text-black font-weight-bold">Phone</span>({{$hotelData->user_contactno}})</li>
                                <li><span class="text-black font-weight-bold">Adult(s)</span>({{$hotelData->adults}})</li>
                                <li><span class="text-black font-weight-bold">Children</span>({{$hotelData->children}})</li>
                                <li><span class="text-black font-weight-bold">Payment Status</span>{{$hotelData->payment_status}}</li>
                                <li><span class="text-black font-weight-bold">Booking Status</span>{{$hotelData->booking_status}}</li>
                                <!--<li><span class="text-black font-weight-bold">Cancellation cost</span>From now on: USD 34</li>-->
                            </ul>
                            <div class="btn-box" @if($hotelData->booking_status!='Confirmed') style="display:none"  @endif>
                                <a href="javascript:void(0)" onclick="cancel()" class="cancel theme-btn border-0 text-white bg-7">Cancel your booking</a>
                                <a href="javascript:void(0)" style="display:none" class="canceling theme-btn border-0 text-white bg-7">Canceling...</a>
                                <a href="<?php url('') ?>/hotel-voucher?order_id={{$hotelData->order_id}}" class="theme-btn mb-2 mr-2">Download E-Ticket </a>
                            </div>
                        </div><!-- end card-item -->
                    </div>
                </div><!-- end payment-card -->
            </div><!-- end col-lg-12 -->
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
	 		  					$.ajax({
										url:'<?php url(''); ?>/hotel-voucher-email',
										type: "GET",
										data: {
											action: "hotel-voucher-email",
											order_id: "<?php echo $hotelData->order_id; ?>",
											rand: "<?php echo rand(); ?>",
										},
										dataType: "json",  
										success: function (data) {
											alert(data.msg+'. Attached with Voucher.');
										
											$("#mailing_"+order_id).hide();
											$("#mail_"+order_id).show();	
									
										},
										error: function (error) {
											console.log(`Error ${error}`);
										}
									});	
								 function cancel(){
								 	$(".cancel").hide();
									$(".canceling").show();	
	 									$.ajax({
										url:'<?php url(''); ?>/hotel-cancellation',
										type: "GET",
										data: {
											action: "hotel-cancellation",
											order_id: "<?php echo $hotelData->order_id; ?>",
											rand: "<?php echo rand(); ?>",
										},
										dataType: "json",  
										success: function (data) {
											alert(data.msg);
										
											$(".cancel").show();
											$(".canceling").hide();	
									
										},
										error: function (error) {
											console.log(`Error ${error}`);
										}
									});	
	 	
								} 
      </script>
@include('site.footer')

