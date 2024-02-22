@include('site.header')
<div class="loader"><svg class="spinner" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg><br />Loading...</div>
<div class="searching" style="display:none">


@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                if(isset($sessionval['user_id'])){ $user_id=$sessionval['user_id']; } else { $user_id=''; }
                $currency=$data['siteData']['currency'];  
                $currency_symbol=$data['siteData']['currency_symbol'];   
                $oc=json_decode($pageData->other_content,true);       
         @endphp
         <?php  
		 		if(!isset($_REQUEST['IATA_from'])){ $_REQUEST['IATA_from']=$pageData->city_from_code; }
				if(!isset($_REQUEST['IATA_to'])){ $_REQUEST['IATA_to']=$pageData->city_to_code; } 
				if(!isset($_REQUEST['flighttype'])){ $_REQUEST['flighttype']=$oc['flight_type']; } 
				if(!isset($_REQUEST['departure_date'])){ $_REQUEST['departure_date']=date('d/m/Y',strtotime(date('m/d/Y').' +'.$oc["outbound_days"].' day')); } 
				if(!isset($_REQUEST['return_date'])){ $_REQUEST['return_date']=date('d/m/Y',strtotime(date('m/d/Y').' +'.$oc["inbound_days"].' day'));  } 
				if(!isset($_REQUEST['adults'])){ $_REQUEST['adults']=$oc['adult']; } 
				if(!isset($_REQUEST['childs'])){ $_REQUEST['childs']=$oc['child']; } 
				if(!isset($_REQUEST['infants'])){ $_REQUEST['infants']=$oc['infant']; } 
				if(!isset($_REQUEST['cabin_class'])){ $_REQUEST['cabin_class']='economy'; } 
				if(!isset($_REQUEST['origin'])){ $_REQUEST['origin']=$pageData->city_from; }  
				if(!isset($_REQUEST['destination'])){ $_REQUEST['destination']=$pageData->city_to; }
		 ?>
<style>
    .card-img{

        display: flex;

        flex-direction: column;

        align-items: center;

        justify-content: space-around;

    }

    .card-img img{

        width:70%;

    }

	

.opacity_5 {

  opacity: 0.3;

}



</style>





<!-- ================================

    START BREADCRUMB AREA

================================= -->

<section class="breadcrumb-area bread-bg-6 notMobile">

<div class="video-bg" style="background:url({{$pageData->image}});background-size: cover;">

    </div>

    <div class="breadcrumb-wrap">

    

        <div class="container">

        

            <div class="row align-items-center">

            

                <div class="col-lg-6">

                    <div class="breadcrumb-content">

                        <div class="section-heading">

                            <h2 class="sec__title text-white">Flight List</h2>

                        </div>

                    </div><!-- end breadcrumb-content -->

                </div><!-- end col-lg-6 -->

                <div class="col-lg-6">

                    <div class="breadcrumb-list text-right">

                        <ul class="list-items">

                            <li><a href="<?php url('');?>">Home</a></li>

                            <li>Flight</li>

                            <li>Flight List</li>

                        </ul>

                    </div><!-- end breadcrumb-list -->

                </div><!-- end col-lg-6 -->

            </div><!-- end row -->

             <div class="search-fields-container" style="margin-top:10px;">

             @include('flight.flight-search-box')

             </div>

        </div><!-- end container -->

    </div><!-- end breadcrumb-wrap -->

    <!--<div class="bread-svg-box">
  <svg class="bread-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none"><polygon points="100 0 50 10 0 0 0 10 100 10"></polygon></svg>
    </div>--><!-- end bread-svg -->

</section><!-- end breadcrumb-area -->

<!-- ================================

    END BREADCRUMB AREA

================================= -->

<section class="card-area not_found" style="display:none">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
					<div class="container" style=" text-align:center;color:#FF0000">Sorry, Flight Not Found.</div> 
            </div>
        </div>
    </div>
</section>
<?php //echo "<h1>AKMAKM</h1><pre>";   print_r($flightlist);  ?>



<!-- ================================

    START CARD AREA

================================= -->

<section class="card-area ">
    <div class="container whole_content">

        <div class="row">

            <div class="col-lg-12">

                <div class="filter-wrap margin-bottom-30px margin-top-30px">

                    <div class="filter-top d-flex align-items-center justify-content-between pb-4">

                        <div>

                            <h3 style="color:#287dfa" class="title font-size-24"><span class='totalflight'></span> Flights found ({{$_REQUEST['IATA_from']}} @if($_REQUEST['flighttype']=='oneway') &#8594 @else &#8596 @endif {{$_REQUEST['IATA_to']}})</h3>

                            <p class="font-size-14"><span class="mr-1 pt-1">Book with confidence:</span>No flight booking fees</p>

                        </div>

                        <!--<div class="layout-view d-flex align-items-center">

                            <a href="flight-grid.html" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="la la-th-large"></i></a>

                            <a href="flight-list.html" data-toggle="tooltip" data-placement="top" title="List View" class="active"><i class="la la-th-list"></i></a>

                        </div>-->

                    </div><!-- end filter-top -->

                    <div class="filter-bar d-flex align-items-center justify-content-between">

                        <div class="filter-bar-filter d-flex flex-wrap align-items-center">

                            <div class="filter-option">

                                <h3 class="title font-size-16">Filter Your Flight:

           </h3>

                            </div>

                            

                        </div><!-- end filter-bar-filter -->

                        <div class="select-contain">

                            <select class="select-contain-select" name="sort" id="sort" onchange="Show_Flights('filter')">

                                <option value="price_ASC" selected="selected">Sort Your Flight</option>

                                <option value="price_ASC">Price: low to high</option>

                                <option value="price_DESC">Price: high to low</option>

                                <option value="airlines_ASC">Airline: A to Z</option>

                                <option value="airlines_DESC">Airline: Z to A</option>

                                <option value="duration_ASC">Duration: low to high</option>

                                <option value="duration_DESC">Duration: high to low</option>

                            </select>

                        </div><!-- end select-contain -->

                    </div><!-- end filter-bar -->

                </div><!-- end filter-wrap -->

            </div><!-- end col-lg-12 -->

        </div><!-- end row -->

        <div class="row">

            <div class="col-lg-4 notMobile">



                <div class="sidebar mt-0" >

    @if($_REQUEST['flighttype']=='round')

    <a href="javascript:void(0)" onclick="ShowHideFilter('outbound')" class="outbound akm theme-btn theme-btn-small ">Outbound Filter</a>

    <a href="javascript:void(0)" onclick="ShowHideFilter('return')" class="return akm theme-btn theme-btn-small theme-btn-transparent mr-1">Return Filter</a><br />

    @endif

                <div class="onewayfilter" >

                    <div class="sidebar-widget">

                        <h3 class="title stroke-shape">Filter by Price</h3>

                        <div class="sidebar-price-range">

                            <div class="slider-range-wrap">

                                <div class="price-slider-amount padding-bottom-20px">

                                    <label for="amount2" class="filter__label">Price:</label>

                                    <span id="price_cs"></span><input type="text"   id="price" class="amounts">

                                </div><!-- end price-slider-amount -->

                                <div id="slider-range-price" onclick="Show_Flights('filter')" ></div><!-- end slider-range -->

                            </div><!-- end slider-range-wrap -->

                            <div class="btn-box pt-4">

                                <button class="theme-btn theme-btn-small theme-btn-transparent" type="button" onclick="Show_Flights('filter')" >Apply</button>

                            </div>

                        </div>

                    </div><!-- end sidebar-widget -->

                    

                    <div class="sidebar-widget">

                        <h3 class="title stroke-shape">Filter by Duration</h3>

                        <div class="sidebar-price-range">

                            <div class="slider-range-wrap">

                                <div class="price-slider-amount padding-bottom-20px">

                                    <label for="amount2" class="filter__label">Duration:</label>

                                    <input type="text" id="duration" class="amounts">

                                </div><!-- end price-slider-amount -->

                                <div id="slider-range-duration" onclick="Show_Flights('filter')"></div><!-- end slider-range -->

                            </div><!-- end slider-range-wrap -->

                            <div class="btn-box pt-4">

                                <button class="theme-btn theme-btn-small theme-btn-transparent" type="button" onclick="Show_Flights('filter')">Apply</button>

                            </div>

                        </div>

                    </div><!-- end sidebar-widget -->

                    

                    <div class="sidebar-widget" style="display:none">

                        <h3 class="title stroke-shape">Filter by  Departure Time</h3>

                        <div class="sidebar-price-range">

                            <div class="slider-range-wrap">

                                <div class="price-slider-amount padding-bottom-20px">

                                    <label for="amount2" class="filter__label">Departure Time:</label>

                                    <input type="text" id="Departure" class="amounts">

                                </div>

                                <div id="slider-range-Departure" onclick="Show_Flights('filter')"></div>

                            </div>

                        </div>

                   </div>  

                   

                   <div class="sidebar-widget" style="display:none">

                        <h3 class="title stroke-shape">Filter by Arrival Time</h3>  

                        <div class="sidebar-price-range">

                            <div class="slider-range-wrap">

                                <div class="price-slider-amount padding-bottom-20px">

                                    <label for="amount2" class="filter__label">Arrival Time:</label>

                                    <input type="text" id="Arrival" class="amounts">

                                </div>

                                <div id="slider-range-Arrival" onclick="Show_Flights('filter')"></div>

                            </div>

                           

                        </div>

                    </div>

                    

                     

                    <div class="sidebar-widget">

                        <h3 class="title stroke-shape">Flight Stops</h3>

                        <div class="sidebar-widget-item Stops_Filter">                            

                        </div>

                    </div><!-- end sidebar-widget -->

                    <div class="sidebar-widget">

                        <h3 class="title stroke-shape ">Filter by Airline Name</h3>

                        <div class="sidebar-widget-item Airline_Name_Filter">

                        </div>

                    </div><!-- end sidebar-widget -->

                </div><!-- end sidebar -->

                

                <div class="roundfilter" style="display:none" > 

                   <!-- <div class="sidebar-widget">

                        <h3 class="title stroke-shape">Filter by Price</h3>

                        <div class="sidebar-price-range">

                            <div class="slider-range-wrap">

                                <div class="price-slider-amount padding-bottom-20px">

                                    <label for="amount2" class="filter__label">Price:</label>

                                    <input type="text"   id="return-price" class="amounts">

                                </div>

                                <div id="return-slider-range-price" onclick="Show_Flights('filter')" ></div>

                            </div><end slider-range-wrap 

                            <div class="btn-box pt-4">

                                <button class="theme-btn theme-btn-small theme-btn-transparent" type="button">Apply</button>

                            </div>

                        </div>

                    </div> end sidebar-widget -->

                    

                    <div class="sidebar-widget">

                        <h3 class="title stroke-shape">Filter by Duration</h3>

                        <div class="sidebar-price-range">

                            <div class="slider-range-wrap">

                                <div class="price-slider-amount padding-bottom-20px">

                                    <label for="amount2" class="filter__label">Duration:</label>

                                    <input type="text" id="return-duration" class="amounts">

                                </div><!-- end price-slider-amount -->

                                <div id="return-slider-range-duration" onclick="Show_Flights('filter')"></div><!-- end slider-range -->

                            </div><!-- end slider-range-wrap -->

                            <div class="btn-box pt-4">

                                <button class="theme-btn theme-btn-small theme-btn-transparent" type="button" onclick="Show_Flights('filter')">Apply</button>

                            </div>

                        </div>

                    </div><!-- end sidebar-widget -->

                    

                    <div class="sidebar-widget" style="display:none">

                        <h3 class="title stroke-shape">Filter by  Departure Time</h3>

                        <div class="sidebar-price-range">

                            <div class="slider-range-wrap">

                                <div class="price-slider-amount padding-bottom-20px">

                                    <label for="amount2" class="filter__label">Departure Time:</label>

                                    <input type="text" id="return_Departure" class="amounts">

                                </div>

                                <div id="return-slider-range-Departure" onclick="Show_Flights('filter')"></div>

                            </div>

                        </div>

                   </div>  

                   

                   <div class="sidebar-widget" style="display:none">

                        <h3 class="title stroke-shape">Filter by Arrival Time</h3>  

                        <div class="sidebar-price-range">

                            <div class="slider-range-wrap">

                                <div class="price-slider-amount padding-bottom-20px">

                                    <label for="amount2" class="filter__label">Arrival Time:</label>

                                    <input type="text" id="return_Arrival" class="amounts">

                                </div>

                                <div id="return-slider-range-Arrival" onclick="Show_Flights('filter')"></div>

                            </div>

                           

                        </div>

                    </div>

                    

                     

                    <div class="sidebar-widget">

                        <h3 class="title stroke-shape">Flight Stops</h3>

                        <div class="sidebar-widget-item return_Stops_Filter">                            

                        </div>

                    </div><!-- end sidebar-widget -->

                    <div class="sidebar-widget">

                        <h3 class="title stroke-shape ">Filter by Airline Name</h3>

                        <div class="sidebar-widget-item return_Airline_Name_Filter">

                        </div>

                    </div><!-- end sidebar-widget -->

                </div>

                

               </div>

            </div><!-- end col-lg-4 -->

            

            <div class="col-lg-8 flight_ist">

            </div><!-- end col-lg-8 --> 

            

            <div class="col-lg-4 outbound_flight_ist">

            </div><!-- end col-lg-8 -->  

            

            <div class="col-lg-4 inboubd_flight_ist">

            </div><!-- end col-lg-8 -->

            

        </div><!-- end row -->

        <div class="row">

            <div class="col-lg-12">

                <div class="btn-box mt-3 text-center">

                    <button type="button" class="theme-btn" onclick="Show_Flights('load')"><i class="la la-refresh mr-1"></i>Load More</button>

                    <p class="font-size-13 pt-2">Showing 1 - <span class="showflight"></span> of <span class="totalflight"></span> Flights</p>

                </div><!-- end btn-box -->

            </div><!-- end col-lg-12 -->

        </div><!-- end row -->

    </div><!-- end container -->

</section><!-- end card-area -->

<!-- ================================

    END CARD AREA

================================= -->





<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
jQuery(".common_beard_comb").hide(); 
var innerHtml=''; var page=0; var search_session='';

      jQuery(document).ready(function(){
	  	
			   			 $.ajax({
								url:'<?php url(''); ?>/flightsearchresults',
								type: "get",
								data: {
								    _token:"{{csrf_token()}}",
									action: "flight-search-results",
									flighttype: "<?php echo $_REQUEST['flighttype']; ?>",
									origin: "<?php echo $_REQUEST['origin']; ?>",  
									destination: "<?php echo $_REQUEST['destination']; ?>",
									IATA_from: "<?php echo $_REQUEST['IATA_from']; ?>",  
									IATA_to: "<?php echo $_REQUEST['IATA_to']; ?>",
									departure_date: "<?php echo $_REQUEST['departure_date']; ?>",
									return_date: "<?php echo $_REQUEST['return_date']; ?>",
									adults: "<?php echo $_REQUEST['adults']; ?>",
									childs: "<?php echo $_REQUEST['childs']; ?>",
									infants: "<?php echo $_REQUEST['infants']; ?>",
									cabin_class: "<?php echo $_REQUEST['cabin_class']; ?>",  
									user_id: "<?php echo $user_id; ?>",
									rand: "<?php echo rand(); ?>",
									isDomestic: "No",
								},
								dataType: "json",
								success: function (data) {
								console.log(data);
																
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							});
							Show_Search();	
							
						 
      });	   
	  			   function Show_Search()
					{
						$.ajax({
								url:'<?php url(''); ?>/flight-search-results2',
								type: "get",
								data: {
								    _token:"{{csrf_token()}}",
									action: "findSearchKey",
									flighttype: "<?php echo $_REQUEST['flighttype']; ?>",
									origin: "<?php echo $_REQUEST['origin']; ?>",  
									destination: "<?php echo $_REQUEST['destination']; ?>",
									IATA_from: "<?php echo $_REQUEST['IATA_from']; ?>",  
									IATA_to: "<?php echo $_REQUEST['IATA_to']; ?>",
									departure_date: "<?php echo $_REQUEST['departure_date']; ?>",
									return_date: "<?php echo $_REQUEST['return_date']; ?>",
									adults: "<?php echo $_REQUEST['adults']; ?>",
									childs: "<?php echo $_REQUEST['childs']; ?>",
									infants: "<?php echo $_REQUEST['infants']; ?>",
									cabin_class: "<?php echo $_REQUEST['cabin_class']; ?>",  
									user_id: "<?php echo $user_id; ?>",
									rand: "<?php echo rand(); ?>",
									isDomestic: "No",
								},
								dataType: "json",
								success: function (data) {
								jQuery('.searching').show();
								jQuery('.loader').hide();
								console.log(data);
									if(data.isFind=='Yes'){ 
									search_session=data.search_session;
										
										Get_FlightController();
										Show_Flights('load');
										//Show_OutBoundFlights(data.search_session);
										//Show_InBoundFlights(data.search_session);
									}else{
										jQuery('.not_found').show();
										jQuery('.loader').hide();
										jQuery('.whole_content').hide();
										
										alert("No Flight Found.");
									}
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							});
					}
	  
					function Show_Flights(type)
					{      
								jQuery('.flight_ist').addClass('opacity_5');
								if(type=='filter'){  innerHtml=''; } else { page=page+1; }
								var sortVal= document.getElementById("sort").value;
								var Arrival= document.getElementById("Arrival").value;
								var Departure= document.getElementById("Departure").value;
								var price= document.getElementById("price").value;
								var duration= document.getElementById("duration").value;
								var airlines='';
								 jQuery("input[name=airlines]:checked").each( function () {
									   var a=jQuery(this).val() ;
									   airlines +=a+",";
								 });
								 
								 var Stops='';
								 jQuery("input[name=Stops]:checked").each( function () {
									   var s=jQuery(this).val() ;
									   Stops +=s+",";
								 });
								 
								   //alert("page=="+page+"\nsearch_session"+search_session)
							 $.ajax({
								url:'<?php url(''); ?>/Show_Flights',
								type: "GET",
								data: {
									_token:"{{csrf_token()}}",
									action: "Show_Flights",
									search_id: search_session,
									sortVal: sortVal,
									Arrival: Arrival,
									Departure: Departure,
									duration: duration,
									price: price,
									Stops: Stops,
									airlines: airlines,  
									user_id: "<?php echo $user_id; ?>",
									rand: "<?php echo rand(); ?>",
								},
								dataType: "json",
								success: function (data) {
								
								Get_FlightController1();
													jQuery('.flight_ist').removeClass('opacity_5');
									                jQuery('.totalflight').html(data.result[0].totalcountfilter); 
													jQuery('.showflight').html(page*20); 
								for(var i=0;i<data.result.length;i++){ 
									if(data.result[i].max_stops==0){ var onewaystop='Non';} else { onewaystop=data.result[i].max_stops; }
									if(data.result[i].return_max_stops==0){ var returnstop='Non';} else { returnstop=data.result[i].return_max_stops; } 
									if(data.result[i].isReturn=='Yes'){  var arraow='&#8596'; }else{  var arraow='&#8594'; }
									$price=parseFloat(data.result[i].price);
									innerHtml +='<div class="card-item flight-card flight--card card-item-list card-item-list-2"><div class="card-img"><div class="an-container"><img src="https://res.cloudinary.com/wego/image/upload/c_fit,w_100,h_100/v20190802/flights/airlines_square/'+data.result[i].validating_carrier+'" alt="flight-logo-img">  <br> <span>'+data.result[i].onewayFlights[0].airline_name+'<br> '+data.result[i].onewayFlights[0].operating_carrier+'-'+data.result[i].onewayFlights[0].flight_no+'</span></div></div><div class="card-body"><div class="card-top-title d-flex justify-content-between"><div style="color:#287dfa"><h3 class="card-title font-size-17">'+data.result[i].origon_airport+' '+arraow+' '+data.result[i].destination_airport+'</h3></div><div><div class="text-right" style="color:#287dfa"><h6 class="font-weight-bold color-text"><?php echo $currency_symbol; ?> '+$price.toLocaleString()+'</h6></div></div></div><div style="text-align: center;" class="flight-details py-3"><div class="flight-time pb-3"><p class="card-meta font-size-14">One way flight</p><div class="flight-time-item  d-flex"><div class="flex-shrink-0 mr-2 take-off"><i class="la la-plane "></i></div><div><h3 class="card-title font-size-15 font-weight-medium mb-0">Take off</h3><p class="card-meta font-size-14">'+data.result[i].departure_date+'</p><p class="card-meta font-size-14">'+data.result[i].departure_time+'</p></div><div  style=" margin-left:20px"><h3 class="card-title font-size-15 font-weight-medium mb-0">'+onewaystop+' Stop</h3><hr><h3 class="card-meta font-size-14">'+data.result[i].fly_duration+'</h3></div><div style=" margin-left:20px"  class="flex-shrink-0 mr-2 landing"><i class="la la-plane"></i></div><div><h3 class="card-title font-size-15 font-weight-medium mb-0">Landing</h3><p class="card-meta font-size-14">'+data.result[i].arrival_date+'</p><p class="card-meta font-size-14">'+data.result[i].arrival_time+'</p></div></div></div>';									
		
		//Return Start								 										 
	if(data.result[i].isReturn=='Yes'){  var arraow='&#8596';
innerHtml +='<div class="flight-time pb-3"><p class="card-meta font-size-14">Return flight</p><div class="flight-time-item  d-flex"><div class="flex-shrink-0 mr-2 take-off"><i class="la la-plane"></i></div><div><h3 class="card-title font-size-15 font-weight-medium mb-0">Take off</h3><p class="card-meta font-size-14">'+data.result[i].return_departure_date+'</p><p class="card-meta font-size-14">'+data.result[i].return_departure_time+'</p></div><div  style=" margin-left:20px"><h3 class="card-title font-size-15 font-weight-medium mb-0">'+returnstop+' Stop</h3><hr><h3 class="card-meta font-size-14"> '+data.result[i].return_total_duration+'</h3></div><div style=" margin-left:20px"  class="flex-shrink-0 mr-2 landing"><i class="la la-plane "></i></div><div><h3 class="card-title font-size-15 font-weight-medium mb-0">Landing</h3><p class="card-meta font-size-14">'+data.result[i].return_arrival_date+'</p><p class="card-meta font-size-14">'+data.result[i].return_arrival_time+'</p></div></div></div>'; 
	}// return End
innerHtml +='</div><div class="btn-box text-center"><a href="flight-booking/'+btoa(data.result[i].id)+'" class="theme-btn theme-btn-small w-100">Book Now</a></div></div></div>';

						}// End For Loop
				jQuery('.flight_ist').html(innerHtml);	
								},  // End Response
								error: function (error) {
									console.log(`Error ${error}`);
								}  //end Error
							   }); // end Ajax Fun
				  } // end Show_Flights Fun
							
								
				
				function Get_FlightController1()
							{      
								 $.ajax({
								url:'<?php url(''); ?>/flight-controller',
								type: "GET",
								data: {
									_token:"{{csrf_token()}}",
									action: "Get_FlightController",
									search_id: '62d1ceb285fe3',
									user_id: "<?php echo $user_id; ?>",
									rand: "<?php echo rand(); ?>",

								},

								dataType: "json",
								success: function (data) {},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							   });
							}
							function Get_FlightController()
							{      
								 $.ajax({
								url:'<?php url(''); ?>/travel/apiflight_update_rates.php',
								//url:'<?php url(''); ?>/flight-controller',
								type: "GET",
								data: {
									action: "Get_FlightController",
									search_id: search_session,
									user_id: "<?php echo $user_id; ?>",
									rand: "<?php echo rand(); ?>",
								},
								dataType: "json",
								success: function (data) { 
								var cs=data.currency_symbol;
									var airlines=data.airlines;  
									var airlinesHtml='';    
									var type="'filter'";
									for(var i=0;i<airlines.length;i++){  
										airlinesHtml+='<div class="custom-checkbox"><input onclick="Show_Flights('+type+')" type="checkbox" name="airlines" value="'+airlines[i].airline_code+'" id="chba'+i+'" ><label for="chba'+i+'">'+airlines[i].name+' ('+airlines[i].carriercount+')</label></div>';
									}
								jQuery('.Airline_Name_Filter').html(airlinesHtml);
								jQuery('.return_Airline_Name_Filter').html(airlinesHtml);
								var stopages=data.stopages;  
									var stopagesHtml='';    
									for(var i=0;i<stopages.length;i++){  
										stopagesHtml+='<div class="custom-checkbox"><input onclick="Show_Flights('+type+')" type="checkbox" name="Stops" value="'+stopages[i].max_stops+'" id="stopes'+i+'" ><label for="stopes'+i+'">'+stopages[i].max_stops+' Stops ('+stopages[i].maxstopcount+')</label></div>'
									}
								jQuery('.Stops_Filter').html(stopagesHtml);
								jQuery('.return_Stops_Filter').html(stopagesHtml);
								
									
									var maxprice=data.maxprice;
									var minprice=data.minprice;
									var rangeSlider	=$('#slider-range-price');
									var rangeSliderAmount =$('#price');	
									if ($(rangeSlider).length) {
            							$(rangeSlider).slider({
											range: true,
											min: minprice,
											max: maxprice,
											values: [ minprice, maxprice ],
											slide: function( event, ui ) {
												$(rangeSliderAmount).val( ui.values[ 0 ] + "-"+ ui.values[ 1 ] );
											}
										});
									}
				 $('#price_cs').html(cs);	
				  $(rangeSliderAmount).val( $(rangeSlider).slider( "values", 0 ) + "-" + $(rangeSlider).slider( "values", 1 ) );

									
									var fly_duration_maxtime=data.fly_duration_maxtime;  
									var fly_duration_mintime=data.fly_duration_mintime;  
									 var rangeSliderDuration =$('#slider-range-duration');
									var rangeSliderAmountDuration =$('#duration');	
									if ($(rangeSliderDuration).length) {
            							$(rangeSliderDuration).slider({
											range: true,
											min: fly_duration_mintime,
											max: fly_duration_maxtime,
											values: [ fly_duration_mintime, fly_duration_maxtime ],
											slide: function( event, ui ) {
												$(rangeSliderAmountDuration).val(  ui.values[ 0 ] + ":00-" + ui.values[ 1 ]+':00' );
											}
										});
									}
					$(rangeSliderAmountDuration).val( $(rangeSliderDuration).slider( "values", 0 ) + ":00-" + $(rangeSliderDuration).slider( "values", 1 )+':00' );

									var fly_duration_maxtime1=data.returnfly_duration_maxtime;
									var fly_duration_mintime1=data.returnfly_duration_mintime;
									 var return_rangeSliderDuration =$('#return-slider-range-duration');
									var return_rangeSliderAmountDuration =$('#return-duration');	
									if ($(return_rangeSliderDuration).length) {
            							$(return_rangeSliderDuration).slider({
											range: true,
											min: fly_duration_mintime1,
											max: fly_duration_maxtime1,
											values: [ fly_duration_mintime1, fly_duration_maxtime1 ],
											slide: function( event, ui ) {
												$(return_rangeSliderAmountDuration).val(  ui.values[ 0 ] + ":00 - " + ui.values[ 1 ]+':00' );
											}
										});
									}
					$(return_rangeSliderAmountDuration).val( $(return_rangeSliderDuration).slider( "values", 0 ) + ":00 - " + $(return_rangeSliderDuration).slider( "values", 1 )+':00' );
					
								},

								error: function (error) {

									console.log(`Error ${error}`);

								}

							   });

							}

							

				

				

				

				function ShowHideFilter(type){

					jQuery('.akm').removeClass('theme-btn-transparent mr-1');

					

					if(type=='outbound'){

						jQuery('.onewayfilter').show(); 

					    jQuery('.roundfilter').hide(); 

						jQuery('.return').addClass('theme-btn-transparent mr-1');

					}

					else{

						jQuery('.roundfilter').show(); 

						jQuery('.onewayfilter').hide(); 

						jQuery('.outbound').addClass('theme-btn-transparent mr-1');

					}

					

					

				}

				

		



	  

      </script>

      

      

@include('site.footer')
</div>