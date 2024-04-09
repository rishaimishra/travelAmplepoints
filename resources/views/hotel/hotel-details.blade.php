@include('site.header')

<?php // $contentArr=json_decode($hotelData->content,true);
$images=array(); 
if(isset($hotelData['HotelImages']['HotelImage'])){ $images=$hotelData['HotelImages']['HotelImage']; }
?>
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
         @endphp
         
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area bread-bg-7 py-0">
<div class="video-bg" style="background:url(<?php if(isset($images[0])){ echo $images[0]; } ?>);background-size: cover;">
    </div>
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-btn">
                        <div class="btn-box">
                            <!--<a class="theme-btn" data-fancybox="video" data-src="https://www.youtube.com/watch?v=5u1WISBbo5I"
                               data-speed="700">
                                <i class="la la-video-camera mr-2"></i>Video
                            </a>-->
                            <a class="theme-btn" data-src="<?php if(isset($images[0])){ echo $images[0]; } ?>"
                               data-fancybox="hotel-single-main-gallery"
                               data-caption="Showing image - 01"
                               data-speed="700">
                                <i class="la la-photo mr-2"></i>More Photos
                            </a>
                        </div>
                        <?php for($i=1;$i<count($images);$i++){ ?>
                        <a class="d-none"
                             data-fancybox="hotel-single-main-gallery"
                             data-src="<?php echo $images[$i];  ?>"
                             data-caption="Showing image - <?php if($i<9){ echo "0"; } echo $i+1; ?>"
                             data-speed="700"></a>
                        <?php } ?>
                    </div><!-- end breadcrumb-btn -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end breadcrumb-wrap -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
    START TOUR DETAIL AREA
================================= -->
<section class="tour-detail-area padding-bottom-90px">
    <div class="single-content-navbar-wrap menu section-bg" id="single-content-navbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content-nav" id="single-content-nav">
                        <ul>
                            <li><a data-scroll="description" href="#description" class="scroll-link active">Hotel Details</a></li>
                            <li><a data-scroll="availability" href="#availability" class="scroll-link">Availability</a></li>
                            <li><a data-scroll="amenities" href="#amenities" class="scroll-link">Amenities</a></li>
                            <!--<li><a data-scroll="faq" href="#faq" class="scroll-link">Faq</a></li>
                            <li><a data-scroll="reviews" href="#reviews" class="scroll-link">Reviews</a></li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end single-content-navbar-wrap -->
    <div class="single-content-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-content-wrap padding-top-60px">
                        <div id="description" class="page-scroll">
                            <div class="single-content-item pb-4"> 
                                <h3 class="title font-size-26 hotel_Name">{{ $hotelSearchData->Name }}</h3>
                                <div class="d-flex align-items-center pt-2">
                                    <p class="mr-2 hotel_full_address">{{$hotelSearchData->address1}}, {{$hotelSearchData->city}}, {{$hotelSearchData->postalCode}}
									</p> 
                                    <p>
                                        <span class="badge badge-warning text-white font-size-16">{{ $hotelSearchData->hotelRating; }}/5</span>
                                        <!--<span>(4,209 Reviews)</span>-->
                                    </p>
                                </div>
                            </div><!-- end single-content-item -->
                            <div class="section-block"></div>
                            <p class="py-3 roomDetailDescription">{{$hotelData['HotelDetails']['roomDetailDescription']; }}</p>
                           <!-- <div class="single-content-item padding-top-40px padding-bottom-40px">
                                <h3 class="title font-size-20"></h3>
                                
                            </div>--><!-- end single-content-item -->
                            <div class="section-block"></div>
                            
                        </div><!-- end description -->
                        <div id="availability" class="page-scroll">
                            <div class="single-content-item padding-top-40px padding-bottom-30px">
                                <!--<h3 class="title font-size-20">Availability</h3>-->
                                
                                <h3 class="title font-size-20">Available Rooms</h3>
                                <div class="AvailableRooms"> Loading............<!-- end cabin-type --></div>
                                
                                
                            </div><!-- end single-content-item -->
                            @if($hotelSearchData->hotelDetails!='')
                            <div class="section-block"></div>
                            <div class="single-content-item padding-top-40px padding-bottom-40px">
                                <h3 class="title font-size-20">About <span class="hotel_Name">{{ $hotelSearchData->Name }}</span></h3>
                                <p class="py-3 Hotel_description" style="text-align: justify;"> {{ $hotelSearchData->promoDescription; }}</p>
                            </div><!-- end single-content-item -->
                            @endif
                            <div class="section-block"></div>
                        </div><!-- end location-map -->
                        <?php $BusinessAmenity=$hotelData['BusinessAmenities']['BusinessAmenity']; ?>
                        @if(count($BusinessAmenity)>0)
                         <!-- Business Amenities start-->
                        <div id="amenities" class="page-scroll">
                            <div class="single-content-item padding-top-40px padding-bottom-20px">
                                <h3 class="title font-size-20">Business Amenities</h3>
                                <div class="amenities-feature-item pt-4">
                                    <div class="row Amenities">
                                    
                                    
									@for($i=0;$i<count($BusinessAmenity);$i++)
										 <div class="col-lg-4 responsive-column">
                                         	<div class="single-tour-feature d-flex align-items-center mb-3">
                                            	<div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
                                                    <i class="la la-check"></i>
                                                 </div>
                                                 <div class="single-feature-titles">
                                                    <h3 class="title font-size-15 font-weight-medium">{{$BusinessAmenity[$i]['businessamenity']}}</h3>
                                                </div>
                                            </div>
                                         </div>
									@endfor
                                    </div><!-- end row -->
                                </div>
                            </div><!-- end single-content-item -->
                            <div class="section-block"></div>
                        </div>
                        @endif
                        <!-- Business Amenities end-->
                        <!-- Amenities start-->
                        <?php $PropertyAmenity=$hotelData['PropertyAmenities']['PropertyAmenity']; ?>
                        @if(count($PropertyAmenity)>0)
                        <div id="amenities" class="page-scroll">
                            <div class="single-content-item padding-top-40px padding-bottom-20px">
                                <h3 class="title font-size-20">Amenities</h3>
                                <div class="amenities-feature-item pt-4">
                                    <div class="row Amenities">
                                    
                                    
									@for($i=0;$i<count($PropertyAmenity);$i++)
										 <div class="col-lg-4 responsive-column">
                                         	<div class="single-tour-feature d-flex align-items-center mb-3">
                                            	<div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
                                                    <i class="la la-check"></i>
                                                 </div>
                                                 <div class="single-feature-titles">
                                                    <h3 class="title font-size-15 font-weight-medium">{{$PropertyAmenity[$i]['amenity']}}</h3>
                                                </div>
                                            </div>
                                         </div>
									@endfor
                                    </div><!-- end row -->
                                </div>
                            </div><!-- end single-content-item -->
                            <div class="section-block"></div>
                        </div>
                       @endif
                        
                       
                    </div><!-- end single-content-wrap -->
                </div><!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="sidebar single-content-sidebar mb-0">
                        <div class="sidebar-widget single-content-widget">
                            <div class="sidebar-widget-item">
                                <div class="sidebar-book-title-wrap mb-3">
                                    <h3>Popular</h3>
                                    <p><span class="text-form">From</span><span class="text-value ml-2 mr-1"><?php echo $currency_symbol." ".($hotelSearchData->lowRate*2) ?></span>  
                                     {{--   ( <span style="text-decoration: line-through;" class="text-value ml-2 mr-1"> <?php echo $currency_symbol." ".($hotelSearchData->lowRate)*2; ?> </span> )  --}}</p>
                                       
                                       @php
                                       $admin_model_obj = new \App\Models\commonFunctionModel;
                                       $toCurrencyRate = $admin_model_obj->getFromToCurrencyRate(1.00,'INR', 'USD');
                                        $original_single_price = $hotelSearchData->lowRate;
                                        $OfferedPriceRoundedOff = $admin_model_obj->displayFinalRates($hotelSearchData->lowRate, $toCurrencyRate);

                                        //dd($original_single_price,$OfferedPriceRoundedOff);
                                        $single_price = (($OfferedPriceRoundedOff) * 2);
                                        $wholesale_price = ($single_price / 2);
                                        $free_with_amples = 0.00;
                                        $no_of_amples = 0.00;
                                        $discount_price = 0.00;
                                        $discount = 0.00;
                                        $FinalTextAmount = 0.00;
                                        $calculateDiscount = ((($single_price - $wholesale_price) * 100) / $single_price);
                                        $discount = round($calculateDiscount, 2);
                                        $discount_price = (($single_price * $discount) / 100);
                                        $discount_margin = $discount_price;
                                        $buyandearnamples = ($discount_margin / .12);
                                        $no_of_amples = $buyandearnamples;
                                       @endphp
                                       <br>
                                      <h3>Book and earn amplepoints from : {{round($no_of_amples)}}</h3>
                                </div>
                                {{-- <h1>{{$no_of_amples}}---{{$OfferedPriceRoundedOff}}</h1> --}}
                            </div><!-- end sidebar-widget-item -->
                            <div class="sidebar-widget-item">
                                <div class="contact-form-action">
                                    <form action="#">
                                        <div class="input-box">
                                            <label class="label-text">Check in </label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon"></span>
                                                <input class=" form-control" type="text" name="checkin" value="<?php echo $hotelSearchData->checkin; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="input-box">
                                            <label class="label-text"> Check out</label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon"></span>
                                                <input class=" form-control" type="text" name="checkout"  value="<?php echo $hotelSearchData->checkout; ?>" readonly>
                                            </div>
                                        </div>
                                       <!-- <div class="input-box">
                                            <label class="label-text">Rooms</label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
                                                <input class=" form-control" type="text" name="rooms"  value="<?php echo $hotelSearchData->rooms; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>-->
                                    </form>
                                </div>
                            </div><!-- end sidebar-widget-item -->
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
                        </div><!-- end sidebar-widget -->
                       
                    </div><!-- end sidebar -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end single-content-box -->
</section><!-- end tour-detail-area -->
<!-- ================================
    END TOUR DETAIL AREA
================================= -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
                                <script type="text/javascript">
jQuery(".common_beard_comb").hide(); jQuery(".preloader").hide();
var innerHtml=''; var page=0; var search_session='';
      jQuery(document).ready(function(){   
	  var innerHtml='<div class="loader"><svg class="spinner" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg></div>';   jQuery('.flight_ist').html(innerHtml);	
	  				Hotel_Description();
					RoomAvailability();
						function Hotel_Description(){
			   			 $.ajax({
								url:<?php url(''); ?>'/travel/hotel-update-rates.php',
								type: "GET",
								data: {
									action: "Hotel_Description",  
									hotelId: "<?php echo $hotelSearchData->EANHotelID; ?>",
									tid: "<?php echo $hotelSearchData->id; ?>",
									search_session: "<?php echo $hotelSearchData->search_session; ?>",
									regionid: "<?php echo $hotelSearchData->desti_lat_lon; ?>",
									destination: "<?php echo $hotelSearchData->city; ?>",
									checkIn: "<?php echo $hotelSearchData->checkin; ?>",  
									checkOut: "<?php echo $hotelSearchData->checkout; ?>",
									rooms: "<?php echo $hotelSearchData->rooms; ?>",
									adults: '<?php echo $hotelSearchData->Cri_Adults; ?>',
									childs: '<?php echo $hotelSearchData->Cri_Childs; ?>',
								},
								dataType: "json",
								success: function (data) {
									var HotelSummary=data.responseData.HotelSummary;
									var BusinessAmenity=data.responseData.BusinessAmenities.BusinessAmenity;
									var HotelDetails=data.responseData.HotelDetails;
									
									jQuery('.hotel_Name').html(HotelSummary.Name);
									jQuery('.hotel_full_address').html(HotelSummary.Address1+', '+HotelSummary.City+', '+HotelSummary.postalCode);
									jQuery('.hotel_rating').html(HotelSummary.hotelRating);
									jQuery('.roomDetailDescription').html(HotelDetails.roomDetailDescription);						
									jQuery('.Hotel_description').html(HotelDetails.propertyDescription);
									/*var AmenitiesHtml='';
									var PropertyAmenity=data.responseData.PropertyAmenities.PropertyAmenity;
									for(var i=0;i<PropertyAmenity.length;i++){
										 AmenitiesHtml +='<div class="col-lg-4 responsive-column"><div class="single-tour-feature d-flex align-items-center mb-3"><div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3"><i class="la la-check"></i></div><div class="single-feature-titles"><h3 class="title font-size-15 font-weight-medium">'+PropertyAmenity[i].amenity+'</h3></div></div></div>';
									}
									jQuery('.Amenities').html(AmenitiesHtml);
									var businessamenityHtml='';
									for(var i=0;i<BusinessAmenity.length;i++){
										 businessamenityHtml +='<div class="col-lg-4 responsive-column"><div class="single-tour-feature d-flex align-items-center mb-3"><div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3"><i class="la la-check"></i></div><div class="single-feature-titles"><h3 class="title font-size-15 font-weight-medium">'+BusinessAmenity[i].businessamenity+'</h3></div></div></div>';
									}
									jQuery('.businessamenity').html(businessamenityHtml);*/									
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							});
							}
							

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
									tid: "<?php echo $hotelSearchData->id; ?>",
								},
								dataType: "json",
								success: function (response) {								
									
									var countRoomCombination =response.responseData.RoomTypes.size;
									var RoomGroup =response.responseData.RoomTypes.RoomGroup;
									var policy_data =response.responseData.RoomTypes.policy_data;
									var currency_symbol=response.currency_symbol;
									
									/*=== RoomList ====*/
									var htmlRoomlist=''; 
									if(countRoomCombination<1){  htmlRoomlist +='No Room Available';  }
									htmlRoomlist+='<div class="cabin-type padding-top-30px"><div class="cabin-type-item seat-selection-item d-flex"><div class="" style="border: 1px solid rgba(128, 137, 150, 0.2);">';

									for(var i=0;i<countRoomCombination;i++){
									  var boardArr = Object.keys(RoomGroup[i].name);
									  for(var j=0;j<boardArr.length;j++){
									  
									  //cabin-type-detail
										var board =boardArr[j];
										var nameArr =RoomGroup[i].name[board];
										var ratesArr =RoomGroup[i].rates[board];
										var keys = Object.keys(nameArr);
										
										var keyInd =keys.indexOf("NOR");
										
										if (keyInd>-1){
										 var key =keys[keyInd];
										}
										else{
										 var key =keys[0];	
										}
										
										var rateClass=key;
										
										var nameA =nameArr[key];
										var ratesA =ratesArr[key];
										if(j==0){
										 var roomCombineName =	CountRoomName(nameA);
									htmlRoomlist+='<h3 class="title" style="background-color:rgba(128, 137, 150, 0.2); padding:5px 15px;">'+roomCombineName+'</h3>';	
										}
										
										var roomPrice =0;
										var cancellationPolicies ='';
										var roomPriceTool='<div class="roompricetool"><h3>Room Prices</h3>';
										var cancellationPoliciesTool='<div class="cancellationtool" ><h3> cancellation policies</h3>';
										var rateKeyIds ='';
										var roomCodeIds ='';
										var allotmentArr =[];
										for(var l=0;l<ratesA.length;l++){
										 roomCodeIds+=ratesA[l].code+'~~~~';
										 rateKeyIds+=ratesA[l].rates.rateKey+'~~~~';
										 var allotment =ratesA[l].rates.allotment;
										 allotmentArr.push(allotment);
										 var CPArr =ratesA[l].rates.cancellationPolicies;
										 var net =ratesA[l].rates.net;	
										 roomPrice =(parseFloat(roomPrice)+parseFloat(net)).toFixed(2);
										 var pax =ratesA[l].rates.adults;
										 if(ratesA[l].rates.children>0){
										   pax+=','+ratesA[l].rates.children;	 
										 }   
										 roomPriceTool+='<p><span style="display:inline-block;    letter-spacing: 0px;color: #607D8B">'+ratesA[l].name+'('+pax+'):</span><span style="    text-align: right;float: right;letter-spacing: 0px;color: #607D8B">'+currency_symbol+' '+ratesA[l].rates.net+'</span></p>';
										var cptool ='';
										var cancellationFee =0;
										var cancellationLebel='';
										if(rateClass=='NRF'){
												cancellationLebel='<i class="fa fa-ban" aria-hidden="true"></i>&nbsp;Non Refundable';  
												cptool+='<p>Non Refundable</p>';
										}
										else if(CPArr.length>0){
											for(var c=0; c<CPArr.length;c++){
													var fdate = CPArr[c].from.split('T');
													var fdateArr =fdate[0].split('-');
													var fromdate = fdateArr[2]+'/'+fdateArr[1]+'/'+fdateArr[0];   
													cptool+='<p>'+CPArr[c].amount+'&nbsp; txt_will_be_charged_after &nbsp;'+fromdate+'</p>';
											}
										   var fdate = CPArr[0].from.split('T');
										   var fdateArr =fdate[0].split('-');
										   var fromdate = fdateArr[2]+'/'+fdateArr[1]+'/'+fdateArr[0];
										   cancellationLebel='<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Free cancellation until '+fromdate;
										}
										else{
										   //cptool+='<p>Cancellation fees not available</p>';
										   cancellationLebel='';
										}
																
										cancellationPoliciesTool+='<p><span style="display:inline-block; letter-spacing: 0px;color: #607D8B">'+ratesA[l].name+'('+pax+'):</span><span style="text-align: right;float: right;letter-spacing: 0px;color: #607D8B">'+cptool+'</span></p>';					 
								     } // End ratesA for 
									
									var leastAllotment =Math.min.apply(Math,allotmentArr);
									cancellationPoliciesTool+='</div>';
									roomPriceTool+='</div>';
									var roomInpolicy = '';// checkInPolicy(key,roomPrice,roomCombineName,HotelSummary.hotelRating);
																
									var fa_thumbs ='fa-thumbs-down';
									if(roomInpolicy=='Yes'){
										fa_thumbs ='fa-thumbs-up';
									}
									roomPriceTool+='</div>';
									var roomCodeIds =roomCodeIds.slice(0,-4);
									var rateKeyIds =rateKeyIds.slice(0,-4);
									var roomIndex =i+''+j;
									var nextPageUrl='';
									var BookLink ='';
									var BoardNameArr =[];

					 BoardNameArr ={'RO':'Room only','BB':'Bed and breakfast','AI':'All inclusive','LB':'Lunch and breakfast','HB':'Half Board','FB':'Full Board'};
					 var boardName = BoardNameArr[board];
					 
					htmlRoomlist+='<div class="row" style="margin:0; border-top: 1px solid rgba(128, 137, 150, 0.2); margin-bottom: 5px;"><div class="col-lg-3 responsive-column">'+boardName+'('+board+')</div><div class="col-lg-3 responsive-column">'+cancellationLebel+'</div><div class="col-lg-2 responsive-column"style="color:RED"> '+leastAllotment+' Room(s) Left</div><div class="col-lg-2 responsive-column"><p class="text-uppercase font-size-14">Per/night<strong class="mt-n1 text-black font-size-18 font-weight-black d-block"><?php echo $currency_symbol; ?> '+roomPrice*2+'</strong> <span style="text-decoration: line-through; display:none"><?php echo $currency_symbol; ?>  '+2*roomPrice+'</span></p></div><div class="col-lg-2 responsive-column cabin-price"><div class="custom-checkbox mb-0"><input style="display:none" type="radio" name="akm" id="selectChb'+i+''+j+'"><!--<label for="selectChb'+i+''+j+'" class="theme-btn theme-btn-small">Select</label>--><a href="{{ asset("hotel-booking") }}/'+btoa(board)+'/'+btoa(rateClass)+'/'+btoa(roomCodeIds)+'/<?php echo base64_encode($hotelSearchData->id); ?>" class="theme-btn theme-btn-small" style="width:100px; text-align:center; padding:0;">Book Now</a></div></div></div>';
											} // Inner for End
									}// outer for End	
									htmlRoomlist+='</div></div></div>';
									jQuery('.AvailableRooms').html(htmlRoomlist);
							},
							error: function (error) {
							console.log(`Error ${error}`);
							}
						}); // ajax End
					} // Room Avabalitu fun End
});	   

			function CountRoomName(array_elements) {
					// array_elements = ["a", "b", "c", "d", "e", "a", "b", "c", "f", "g", "h", "h", "h", "e", "a"];
					array_elements.sort();
					var current = null;
					var cnt = 0;
					var result='';
					for (var i = 0; i < array_elements.length; i++) {
						if (array_elements[i]['name'] != current) {
							if (cnt > 0) {
								//document.write(current + ' comes --> ' + cnt + ' times<br>');
							  if(cnt<2){
								result+=current+' + ';  
							  }
							  else{									  
							  result+= cnt+' X '+current+'+ ';	
							  }
							}
							current = array_elements[i]['name'];
							cnt = 1;
						} else {
							cnt++;
						}
					}
					if (cnt > 0) {
						//document.write(current + ' comes --> ' + cnt + ' times');
						if(cnt<2){
								result+=current+' + ';  
							  }
							  else{									  
							  result+= cnt+' X '+current+'+ ';	
							  }
					}  
					return result.slice(0,-2);
			}

      </script>

      

@include('site.footer')