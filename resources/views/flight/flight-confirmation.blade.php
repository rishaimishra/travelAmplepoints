@include('site.header')
         @inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
      
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                 $sessionval=session()->all();
                
                 if(isset($sessionval['user_id'])){ $user_id=$sessionval['user_id']; } else {  $user_id=''; }
                 $currency=$data['siteData']['currency'];  
                $currency_symbol=$data['siteData']['currency_symbol']; ;   
                 $order_id=$flightData->order_id;
                 $payment_ststus=$flightData->payment_status;
                 $booking_ststus=$flightData->booking_status;
                if($flightData->pnr==''){ $PNR='-'; }else { $PNR=$flightData->pnr; } 
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
                                    <p class="pt-2 color-text-2" style="color:#00FF00">Choose Your Flight</p>
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
                                    <h3 class="title pb-1">Hi, {{$flightData->first_name}} {{$flightData->last_name}}</h3>
                                    <h3 class="title" style="color:{{$bookcolor}}">Your booking  is {{$flightData->booking_status}}.</h3>
                                    @if($flightData->error_msg!='')<p style="color:#FF0000">Error: {{$flightData->error_msg}}</p>@endif
                                </div>
                            </div>
                            <ul class="list-items py-4">
                                <li><i class="la la-check text-success mr-2"></i>Your <strong class="text-black">Payment</strong> have been {{$flightData->payment_status}}.  </li>
                           <!--<li><i class="la la-check text-success mr-2"></i>Make changes to your booking or ask the properly a question in just a few clicks</li>-->
                            </ul>
                            <div class="btn-box pb-4">
                                <a href="#" class="theme-btn mb-2 mr-2">PNR: {{$flightData->pnr}} </a>
                                <a href="#" class="theme-btn mb-2 theme-btn-transparent">Order Id : {{$flightData->order_id}} </a>
                            </div>
                            <h3 class="title"><a href="#" class="text-black">{{$flightData->address}}</a></h3>
                            <p>{{$flightData->address}}</p>
                            
                            <ul class="list-items list-items-3 list-items-4 py-4">
                                <li><span class="text-black font-weight-bold">Email</span>({{$flightData->email}})</li>
                                <li><span class="text-black font-weight-bold">Phone</span>({{$flightData->phone}})</li>
                                <li><span class="text-black font-weight-bold">Adult(s)</span>({{$flightData->adults}})</li>
                                <li><span class="text-black font-weight-bold">Children</span>({{$flightData->children}})</li>
                                <li><span class="text-black font-weight-bold">Infant</span>{{$flightData->infants}}</li>
                                <li><span class="text-black font-weight-bold">Payment Status</span>{{$flightData->payment_status}}</li>
                                <li><span class="text-black font-weight-bold">Booking Status</span>{{$flightData->booking_status}}</li>
                                <!--<li><span class="text-black font-weight-bold">Cancellation cost</span>From now on: USD 34</li>-->
                            </ul>
                            <div class="btn-box" @if($flightData->booking_status!='Confirmed') style="display:none"  @endif>
                                <!--<a href="#" class="theme-btn border-0 text-white bg-7">Cancel your booking</a>-->
                                <a href="<?php url('') ?>/flight-ticket?order_id={{$flightData->order_id}}" class="theme-btn mb-2 mr-2">Download E-Ticket </a>
                            </div>
                        </div><!-- end card-item -->
                    </div>
                </div><!-- end payment-card -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<!-- end booking-area -->
<!-- ================================
    END BOOKING AREA
================================= -->

<div class="section-block"></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">  
jQuery(".common_beard_comb").hide(); jQuery(".preloader").hide();  
var page=0; var search_session='';
      jQuery(document).ready(function(){   
	  
	  					$.ajax({
										url:'<?php url(''); ?>/flight-ticket-email',
										type: "GET",
										data: {
											action: "flight-ticket-email",
											order_id: "<?php echo $flightData->order_id; ?>",
											rand: "<?php echo rand(); ?>",
										},
										dataType: "json",  
										success: function (data) {
											//alert(data.msg);
										
											$("#mailing_"+order_id).hide();
											$("#mail_"+order_id).show();	
									
										},
										error: function (error) {
											console.log(`Error ${error}`);
										}
									});				
			});
      </script>

      

      

      @include('site.footer')

