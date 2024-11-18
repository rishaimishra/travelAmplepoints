@include('site.header')
<?php // $contentArr=json_decode($hotelData->content,true);
$images=array(); 
if(isset($contentArr['images'])){  }
 $images= json_decode($activitySearchData->images,true);  ?>
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
                $img=4;
         @endphp



<!-- ================================
    START BREADCRUMB AREA
================================= -->  

<section class="breadcrumb-area bread-bg-7 py-0">
<div class="video-bg" style="background:url(<?php if(isset($images[0]['urls'][$img]['resource'])){ echo $images[0]['urls'][$img]['resource']; } ?>);background-size: cover;">
</div>
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-btn">
                        <div class="btn-box">
                            <!--<a class="theme-btn" data-fancybox="video" data-src="https://www.youtube.com/watch?v=5u1WISBbo5I" data-speed="700">
                                <i class="la la-video-camera mr-2"></i>Video
                            </a>-->
                           <a class="theme-btn" data-src="<?php if(isset($images[0]['urls'][$img]['resource'])){ echo $images[0]['urls'][$img]['resource'];  } ?>"
                               data-fancybox="hotel-single-main-gallery"
                               data-caption="Showing image - 01"
                               data-speed="700">
                                <i class="la la-photo mr-2"></i>More Photos
                            </a>
                        </div>
                    <?php if(isset($images[0])){  for($i=1;$i<count($images);$i++){ ?>
                             <a class="d-none"
                             data-fancybox="hotel-single-main-gallery"
                             data-src="<?php  if(isset($images[$i]['urls'][$img]['resource'])){ echo $images[$i]['urls'][1]['resource']; } ?>"
                             data-caption="Showing image - <?php if($i<9){ echo "0"; } echo $i+1; ?>"
                             data-speed="700"></a>
                        <?php } } ?>
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
                            <li><a data-scroll="ActivityName" href="#ActivityName" class="scroll-link active">Activity Name</a></li>
                            <li><a data-scroll="availability" href="#availability" class="scroll-link">Availability</a></li>
                            <li><a data-scroll="description" href="#description" class="scroll-link">Activity Details</a></li>
                            <li><a data-scroll="amenities" href="#amenities" class="scroll-link">Features</a></li>
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

                        <div id="ActivityName" class="page-scroll">
                            <div class="single-content-item pb-4">
                                <h3 class="title font-size-26 hotel_Name">...</h3>
                                <div class="d-flex align-items-center pt-2">
                                    <p class="mr-2 hotel_full_address">...</p>
                                    <p>
                                        <span class="badge badge-warning text-white font-size-16"><span class="hotel_rating">...</span></span>
                                        <!--<span>(4,209 Reviews)</span>-->
                                    </p>
                                </div>
                            </div><!-- end single-content-item -->
                            <div class="section-block"></div>
                           <p class="py-3 roomDetailDescription" style="display:none">...</p>
                           <!-- <div class="single-content-item padding-top-40px padding-bottom-40px">
                                <h3 class="title font-size-20"></h3>
                            </div>--><!-- end single-content-item -->
                            <div class="section-block"></div>
                        </div><!-- end description -->
                        
                        <div id="availability" class="page-scroll">
                            <div class="single-content-item padding-top-40px padding-bottom-30px">
                                <h3 class="title font-size-20">Available Options</h3>
                                <div class="AvailableRooms">
                                Loading............<!-- end cabin-type -->
                                </div>
                            </div><!-- end single-content-item -->
                        </div>
                        
                        <div id="description" class="page-scroll">
                            <div class="section-block"></div>
                            <div class="single-content-item padding-top-40px padding-bottom-40px">
                                <h3 class="title font-size-20">About <span class="hotel_Name">...</span></h3>
                                <p class="py-3 Hotel_description" style="text-align: justify;">...</p>
                            </div><!-- end single-content-item -->
                            <div class="section-block"></div>
                        </div><!-- end location-map -->

                        

                         <!-- Included start-->
                        <div id="amenities" class="page-scroll featureIncludedMain">
                            <div class="single-content-item padding-top-40px padding-bottom-20px">
                                <h3 class="title font-size-20">Feature Included    </h3>
                                <div class="amenities-feature-item pt-4">
                                    <div class="row featureIncluded">
                                        <!-- end col-lg-4 -->
                                    </div><!-- end row -->
                                </div>
                            </div><!-- end single-content-item -->
                            <div class="section-block"></div>
                        </div>
                        <!-- Included  end-->

                        

                        <!-- Excluded start-->
                        <div id="amenities1" class="page-scroll featureExcludedMain">
                            <div class="single-content-item padding-top-40px padding-bottom-20px">
                                <h3 class="title font-size-20">Feature Excluded </h3>
                                <div class="amenities-feature-item pt-4">
                                    <div class="row featureExcluded">
                                        <!-- end col-lg-4 -->
                                    </div><!-- end row -->
                                </div>
                            </div><!-- end single-content-item -->
                            <div class="section-block"></div>
                        </div>
                        <!-- Excluded end-->
                        
                        <!-- ActivitiesFor   start-->
                        <div id="amenities2" class="page-scroll ActivitiesForMain">
                            <div class="single-content-item padding-top-40px padding-bottom-20px">
                                <h3 class="title font-size-20">Activities   </h3>
                                <div class="amenities-feature-item pt-4">
                                    <div class="row ActivitiesFor">
                                        <!-- end col-lg-4 -->
                                    </div><!-- end row -->
                                </div>
                            </div><!-- end single-content-item -->
                            <div class="section-block"></div>
                        </div>
                        <!-- ActivitiesFor    end-->

                        

                        <!-- Categories start-->
                        <div id="amenities3" class="page-scroll CategoriesMain">
                            <div class="single-content-item padding-top-40px padding-bottom-20px">
                                <h3 class="title font-size-20">Categories </h3>
                                <div class="amenities-feature-item pt-4">
                                    <div class="row Categories">
                                        <!-- end col-lg-4 -->
                                    </div><!-- end row -->
                                </div>
                            </div><!-- end single-content-item -->
                            <div class="section-block"></div>
                        </div>
                        <!-- Categories end-->

                        

                  
                    </div><!-- end single-content-wrap -->

                </div><!-- end col-lg-8 -->

                <div class="col-lg-4">

                    <div class="sidebar single-content-sidebar mb-0">

                        <div class="sidebar-widget single-content-widget">

                            <div class="sidebar-widget-item">

                                <div class="sidebar-book-title-wrap mb-3">

                                    <h3>Popular</h3>

                                    <p><span class="text-form">From</span><span class="text-value ml-2 mr-1"><?php  echo $currency_symbol." ".$provider::convertCurrencyRateFlight($activitySearchData->api_currency,$activitySearchData->api_price); ?></span> <!--<span class="before-price">$<?php echo $activitySearchData->api_price+100; ?>.</span>--></p>

                                </div>

                            </div><!-- end sidebar-widget-item -->

                            <div class="sidebar-widget-item">

                                <div class="contact-form-action">

                                    <form action="#">

                                        <div class="input-box">

                                            <label class="label-text">Check in </label>

                                            <div class="form-group">

                                                <span class="la la-calendar form-icon"></span>

                                                <input class=" form-control" type="text" name="checkin" value="<?php echo $activitySearchData->checkin; ?>" readonly>

                                            </div>

                                        </div>

                                        <div class="input-box">

                                            <label class="label-text"> Check out</label>

                                            <div class="form-group">

                                                <span class="la la-calendar form-icon"></span>

                                                <input class=" form-control" type="text" name="checkout"  value="<?php echo $activitySearchData->checkout; ?>" readonly>

                                            </div>

                                        </div>

                                       <!-- <div class="input-box">

                                            <label class="label-text">Rooms</label>

                                            <div class="form-group">

                                                <div class="select-contain w-auto">

                                                <input class=" form-control" type="text" name="rooms"  value="<?php echo $activitySearchData->code; ?>" readonly>

                                                </div>

                                            </div>

                                        </div>-->

                                    </form>

                                </div>

                            </div><!-- end sidebar-widget-item -->



                            <div class="sidebar-widget-item">

                                <div class="qty-box mb-2 d-flex align-items-center justify-content-between">

                                    <label class="font-size-16">Adult(s) <span></span></label>

                                    <div class="qtyBtn d-flex align-items-center">

                                        <input class=" form-control" type="text" name="Cri_Adults"  value="<?php echo $activitySearchData->adults; ?>" readonly>

                                       <!-- <div class="qtyDec"><i class="la la-minus"></i></div>

                                        <div class="qtyInc"><i class="la la-plus"></i></div>-->

                                    </div>

                                </div><!-- end qty-box -->

                                <div class="qty-box mb-2 d-flex align-items-center justify-content-between">

                                    <label class="font-size-16">Children <span></span></label>

                                    <div class="qtyBtn d-flex align-items-center">

                                         <input class=" form-control" type="text" name="Cri_Childs"  value="<?php echo $activitySearchData->childs; ?>" readonly>

                                        <!--<div class="qtyDec"><i class="la la-minus"></i></div>

                                        <div class="qtyInc"><i class="la la-plus"></i></div>-->

                                    </div>

                                </div><!-- end qty-box -->

                                <!--<div class="qty-box mb-2 d-flex align-items-center justify-content-between">

                                    <label class="font-size-16">Infants <span>0-2 years old</span></label>

                                    <div class="qtyBtn d-flex align-items-center">

                                        <div class="qtyDec"><i class="la la-minus"></i></div>

                                        <input type="text" name="qtyInput" value="0">

                                        <div class="qtyInc"><i class="la la-plus"></i></div>

                                    </div>

                                </div>--><!-- end qty-box -->

                            </div><!-- end sidebar-widget-item -->

                            <!--<div class="btn-box pt-2">

                                <a href="tour-booking.html" class="theme-btn text-center w-100 mb-2"><i class="la la-shopping-cart mr-2 font-size-18"></i>Book Now</a>

                                <a href="#" class="theme-btn text-center w-100 theme-btn-transparent"><i class="la la-heart-o mr-2"></i>Add to Wishlist</a>

                                <div class="d-flex align-items-center justify-content-between pt-2">

                                    <a href="#" class="btn theme-btn-hover-gray font-size-15" data-toggle="modal" data-target="#sharePopupForm"><i class="la la-share mr-1"></i>Share</a>

                                    <p><i class="la la-eye mr-1 font-size-15 color-text-2"></i>3456</p>

                                </div>

                            </div>-->

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

	  

	  				Activity_Description();
	

						function Activity_Description(){

			   			 $.ajax({

								url:<?php url(''); ?>'/Activity_Description',

								type: "GET",

								data: {
									action: "Activity_Description",  
									code: "<?php echo $activitySearchData->code; ?>",
									regionid: "<?php echo $activitySearchData->destinationCode; ?>",
									destination: "<?php echo $activitySearchData->destination; ?>",
									checkIn: "<?php echo $activitySearchData->checkin; ?>",  
									checkOut: "<?php echo $activitySearchData->checkout; ?>",
									adults: "<?php echo $activitySearchData->adults; ?>",  
									childs: "<?php echo $activitySearchData->childs; ?>",
									search_session: "<?php echo $activitySearchData->search_session; ?>",
								},

								dataType: "json",

								success: function (data) {

								console.log(data);

									var ActivitySummary=data.responseData.ActivitySummary;
									var country=data.responseData.country;
									var ActivitySummary=data.responseData.ActivitySummary;
									var PropertyInfo=data.responseData.ActivitySummary.description;
									var countryFrom=data.responseData.country;
									var destinations=countryFrom.destinations.country;
									var amountsFrom=data.responseData.amountsFrom;
									var modalities=data.responseData.modalities;
									var featureGroups=data.responseData.featureGroups;
									var segmentationGroups=data.responseData.segmentationGroups;
									var ActivityImages=data.responseData.ActivityImages.ActivityImage;
									
									var ActivityFare = data.responseData.ActivityFare.ActivityTypes;
									
									var ActivitiesFor=data.responseData.ActivitiesFor;
									var Categories=data.responseData.Categories.segments;
									var Duration=data.responseData.Duration;
									
									var featureIncluded=data.responseData.featureIncluded;
									var featureExcluded=data.responseData.featureExcluded;
									
									var conversion_rate=data.responseData.conversion_rate;

									

									jQuery('.hotel_Name').html(ActivitySummary.Name);

									jQuery('.hotel_full_address').html(country.destinations[0].name+', '+country.name);

									jQuery('.hotel_rating').html(ActivitySummary.guidingOptions);
	
									jQuery('.roomDetailDescription').html(ActivitySummary.description);						

									jQuery('.Hotel_description').html(ActivitySummary.description);

									
							if(featureIncluded.length!=0){
								var featureIncludedHtml='';
								for(var a=0;a<featureIncluded.length;a++){
									featureIncludedHtml +='<div class="col-lg-4 responsive-column"><div class="single-tour-feature d-flex align-items-center mb-3"><div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3"><i class="la la-check"></i></div><div class="single-feature-titles"><h3 class="title font-size-15 font-weight-medium">'+featureIncluded[a].groupCode+'</h3></div></div></div>';
								}
								jQuery('.featureIncluded').html(featureIncludedHtml);
							}else{
								jQuery('.featureIncludedMain').html('');
							}

							if(featureExcluded.length!=0){
								var featureExcludedHtml='';
								for(var a=0;a<featureExcluded.length;a++){
									featureExcludedHtml +='<div class="col-lg-4 responsive-column"><div class="single-tour-feature d-flex align-items-center mb-3"><div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3"><i class="la la-check"></i></div><div class="single-feature-titles"><h3 class="title font-size-15 font-weight-medium">'+featureExcluded[a].groupCode+'</h3></div></div></div>';
								}
								jQuery('.featureExcluded').html(featureExcludedHtml);
							}else{
								jQuery('.featureExcludedMain').html('');
							}
							
							if(ActivitiesFor!=null && ActivitiesFor!='' ){	
								var ActivitiesForHtml='';
								for(var a=0;a<ActivitiesFor.segments.length;a++){
									ActivitiesForHtml +='<div class="col-lg-4 responsive-column"><div class="single-tour-feature d-flex align-items-center mb-3"><div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3"><i class="la la-check"></i></div><div class="single-feature-titles"><h3 class="title font-size-15 font-weight-medium">'+ActivitiesFor.segments[a].name+'</h3></div></div></div>';
								}
								jQuery('.ActivitiesFor').html(ActivitiesForHtml);
							}
							else{
								jQuery('.ActivitiesForMain').html('');
							}
							
							if(Categories.length!=0){
								var CategoriesHtml='';
								for(var a=0;a<Categories.length;a++){
									CategoriesHtml +='<div class="col-lg-4 responsive-column"><div class="single-tour-feature d-flex align-items-center mb-3"><div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3"><i class="la la-check"></i></div><div class="single-feature-titles"><h3 class="title font-size-15 font-weight-medium">'+Categories[a].name+'</h3></div></div></div>';
								}
								jQuery('.Categories').html(CategoriesHtml);
						    }else{
								jQuery('.CategoriesMain').html('');
							}
							
							var htmlRoomlist='';
							
							htmlRoomlist+='<div class="cabin-type padding-top-30px"><div class="cabin-type-item seat-selection-item d-flex"><div class="" style="border: 1px solid rgba(128, 137, 150, 0.2);">';

							
							for(var m=0;m<modalities.length;m++){
							
						 		var operationDates=modalities[m].rates[0].rateDetails[0].operationDates;
	
						  		for(var t=0;t<operationDates.length;t++){	
							
								var ModalityName= modalities[m].name;							
								var Duration= modalities[m].duration;							
								var ModalityPrice= parseFloat(modalities[m].total_price).toLocaleString();							
								var rateKey=modalities[m].rates[0].rateDetails[0].rateKey;
								
								var availDate=operationDates[t].from;
								
								var cptool ='';
								var avbltool ='';
							
								var CancellationPolicy= modalities[m].rates[0].rateDetails[0].operationDates[0].cancellationPolicies[0];
							
								var CPArr= modalities[m].rates[0].rateDetails[0].operationDates;
							
							if(CPArr.length>0){
                               for(var c=0; c<CPArr.length;c++){
									var fdate = CPArr[c].cancellationPolicies[0].dateFrom.split('T');
									var fdateArr =fdate[0].split('-');
									var fromdate = fdateArr[2]+'/'+fdateArr[1]+'/'+fdateArr[0];
									var CanAmount=CPArr[c].cancellationPolicies[0].amount;
									var CancellationCharge=(CanAmount*conversion_rate);
									CancellationCharge = CancellationCharge.toFixed(2);
									cptool+='<p><?php echo $currency_symbol; ?>'+CancellationCharge+' will be charged after '+fromdate+'</p>';								
                               }
							   
                               var fdate = CPArr[0].cancellationPolicies[0].dateFrom.split('T');
                               var fdateArr =fdate[0].split('-');
                               var fromdate = fdateArr[2]+'/'+fdateArr[1]+'/'+fdateArr[0];
                               cancellationLebel='<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Free Cancellation Until '+fromdate;
                             }
                             else{
                               //cptool+='<p>Cancellation fees not available</p>';
                               cancellationLebel='';
                             }
							cancellationPoliciesTool='<div class="cancellationtool" ><h3>Cancellation Policies</h3><p><span style="">'+ModalityName+' :</span><span style="">'+cptool+'</span></p></div>';
							var roomPriceTool='<div class="roompricetool"><h3>Activity Prices</h3>';
							roomPriceTool+='<p><span style="">Price:</span><span style="float: right "><?php echo $currency_symbol; ?> '+ModalityPrice+'</span></p>';
							roomPriceTool+='</div>';
							
							//var BookLink = $scope.nextPageUrl+'?mid='+$scope.mid+'&mt=booking&pid='+$scope.pid+'&agent_id='+$scope.agent_id+'&code='+activity_code+'&rateKey='+rateKey+'&dest='+$scope.regionname+'&checkIn='+availDate+'&checkOut='+availDate+'&adults='+$scope.adults+'&children='+$scope.children+'&childage='+$scope.childAge+'&language='+$scope.language+ '&currency='+$scope.currency+'&cityId='+$scope.regionid+'&search_id='+$scope.search_id;
							
							var taxesHtml ='Taxes and fees are included in the price';
							
							
							/*htmlRoomlist+='<li><div class="boardClsNew"><div class="mainboardcssmain"><span class="roonboardcssmain"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;'+Duration.value+' '+Duration.metric+'</span><span class="refundPolicycls canceltooltip">'+cancellationLebel+'<span class="canceltooltiptext" style="">'+cancellationPoliciesTool+'</span> </span><span class="roonboardcssmain availDatecls"><i class="fa fa-calendar" style=""></i>'+availDate+'</span></div>';
							
							 htmlRoomlist+='<div class="btnmaincls"><div class="btnmaincls789"><span class="pricetooltip">'+$scope.currency_symbol+' '+ModalityPrice+'<span class="tooltiptext">'+roomPriceTool+'</span></span></div></div><div class="btnmaincls456"><p  class="promotion_tag_p"><span class="promotion"><i style="" class="fa fa-tag" aria-hidden="true"></i>'+taxesHtml+'</span></p></div></div><div class="rightsidebtnbox"><a class="adi-btn text-color-white" style="" href="'+BookLink+'" target="_parent">BOOK</a></div></div></li></div>';*/
							 
							 htmlRoomlist+='<h3 class="title" style="background-color:rgba(128, 137, 150, 0.2); padding:5px 15px;">'+ModalityName+'</h3>';
							 
							 htmlRoomlist+='<div class="row" style="margin:0; border-top: 1px solid rgba(128, 137, 150, 0.2); margin-bottom: 5px;"><div class="col-lg-3 responsive-column">'+taxesHtml+'</div><div class="col-lg-3 responsive-column">'+cancellationLebel+'</div><div class="col-lg-2 responsive-column"style="color:RED"> '+availDate+' ('+Duration.value+' '+Duration.metric+')</div><div class="col-lg-2 responsive-column"><p class="text-uppercase font-size-14">Per/person<strong class="mt-n1 text-black font-size-18 font-weight-black d-block"><?php echo $currency_symbol; ?> '+ModalityPrice+'</strong></p></div><div class="col-lg-2 responsive-column cabin-price"><div class="custom-checkbox mb-0"><input style="display:none" type="radio" name="akm" id="selectChb'+m+''+t+'"><!--<label for="selectChb'+m+''+t+'" class="theme-btn theme-btn-small">Select</label>--><a href="{{ asset("tours-booking") }}/<?php echo base64_encode($activitySearchData->code); ?>/'+btoa(rateKey)+'/'+btoa(availDate)+'/<?php echo base64_encode($activitySearchData->id); ?>" class="theme-btn theme-btn-small" style="width:100px; text-align:center; padding:0;">Book Now</a></div></div></div>';
							 
							 

						     }
									
							}
							
							 htmlRoomlist+='</div></div></div>';
							 jQuery('.AvailableRooms').html(htmlRoomlist);
							
							
																		
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}

					});

				}
      });	   

	  

	


      </script>

      

@include('site.footer')