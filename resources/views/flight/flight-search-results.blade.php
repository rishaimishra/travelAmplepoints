@include('site.header')
@inject('siteData1', 'App\Http\Controllers\Site')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
         @php   $data=json_decode($siteData1::Index(),true);
				$common_data= $data['siteData']['common_data'];
                $device=$data['device'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                $currency=$data['siteData']['currency'];  
                $currency_symbol=$data['siteData']['currency_symbol'];               
         @endphp
<!--<div class="loader"><svg class="spinner" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg><br />Loading...</div>-->

<style>
@-webkit-keyframes flash {
  0% {
    background-position: -468px 0
  }
  100% {
    background-position: 468px 0
  }
}

@keyframes flash {
  0% {
    background-position: -468px 0
  }
  100% {
    background-position: 468px 0
  }
}

@import url('https://fonts.googleapis.com/css?family=Open+Sans');
    

h2{
  text-align: center;
  color: white;
  font-weight: normal;
  font-family: 'Open Sans', sans-serif;
}

body, html{
  margin: 0;
  padding: 0;
 
}
.wrapper {
  color: #141823;
  padding: 20px;
  padding-bottom: 60px;
  
}

.item {
  background: #fff;
  border: 1px solid rgba(0,0,0,0.2);
  border-radius: 3px;
  padding: 12px;
  margin-top:10px;
 
  position: relative;
 	
  height: 150px;
}


.round-box{
  width: 50px;
  margin: 10px;
  height: 50px;
  border-radius: 100%;
}

.animated-background {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
  -webkit-animation-name: flash;
  animation-name: flash;
  -webkit-animation-timing-function: linear;
  animation-timing-function: linear;
  background: -webkit-linear-gradient(left, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
  background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
  -webkit-background-size: 800px 104px;
  position: relative;      
}

.rect1{
  width: 50%;
  float: left;
  top: 25px;
  left: 80px;
  margin-top: 10px;
  height: 12px;
  position: absolute;
}

.rect2{
  width: 55%;
  float: left;
  top: 45px;
  left: 80px;
  margin-top: 10px;
  height: 12px;
  position: absolute;
}

.rect3{
  width: 70%;
  float: left;
  top: 80px;
  left: 25px;
  margin-top: 10px;
  height: 10px;
  position: absolute;
}

.rect4{
  width: 75%;
  float: left;
  top: 95px;
  left: 25px;
  margin-top: 10px;
  height: 10px;
  position: absolute;
}

.rect5{
  width: 75%;
  float: left;
  top: 110px;
  left: 25px;
  margin-top: 10px;
  height: 10px;
  position: absolute;
}
</style>

{{-- neww css --}}

<style>
    .c-div-0 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0
}

.c-div-1 {
    width: 10%;
    margin: 0 !important
}

.c-div-1 img {
    margin-bottom: 8px;
    object-fit: cover;
    width: 100%
}

.c-div-2 {
    width: 50%;
    display: flex;
    justify-content: space-between
}

.c-div-3 {}

.c-div-3 hr {}

.c-div-4 {
    width: 60%
}

.c-div-5 {}

.c-div-6 {
    width: 30%;
    display: flex;
    justify-content: end;
    text-align: right
}

@media only screen and (max-width:800px) {
    .c-div-1 {
        width: 10%;
        font-size: 13px;
        line-height: 20px
    }

    .c-div-2 {
        width: 60%
    }

    .c-div-2 * {
        font-size: 12px !important
    }

    .c-div-6 {
        width: 25%
    }

    .c-div-6 h6 {
        font-size: 13px !important
    }
}

@media only screen and (max-width:600px) {
    .c-div-1 {
        width: 8%;
        font-size: 12px;
        line-height: 20px
    }

    .c-div-2 {
        width: 60%
    }

    .c-div-2 * {
        font-size: 10px !important;
        line-height: 13px;
        margin: 0 0;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        width: 60%
    }

    .c-div-6 {
        width: 25%
    }

    .c-div-6 h6 {
        font-size: 11px !important
    }

    .theme-btn {
        font-size: 10px;
        line-height: normal;
        padding: 5px 6px !important
    }
}
</style>

@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                if(isset($sessionval['user_id'])){ $user_id=$sessionval['user_id']; } else { $user_id=''; }
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
<section class="hero-wrapper hero-wrapper6 Edit_search_sec Edit_search" rel="0" style="display:none">
    <div @if($device=='Desktop') style="padding-top: 100px;padding-bottom: 100px;background:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.5)),url({{$pageData->image}});background-size: cover;" @endif >
 
        <div  class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="search-fields-container mt-4" style="box-shadow: 2px 2px 20px #dfdfdf;">
                        <div class="tab-content" id="myTabContent3">
                            @include('flight.flight-search-box')<!-- end tab-pane -->
                        </div>
                    </div><!-- end main-search-input -->
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div>
</section>


<img src=" {{ asset('admin/dist/img/banner/flight.jpg') }}" {{-- class="img-circle elevation-2" --}} alt="banner image" style="width: 100%; margin-bottom: 20px;">

<section class="card-area not_found" style="display:none">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
					<div class="container" style=" text-align:center;color:#FF0000">Sorry, Flight Not Found.</div> 
            </div>
        </div>
    </div>
</section>


<section class="card-area ">
    <div class="container whole_content">

        <div class="row"  >
            <div class="col-lg-12">
                <div class="filter-wrap margin-bottom-30px margin-top-30px">
                    <div class="filter-top d-flex align-items-center justify-content-between pb-4">
                        <div>
                            <h3 style="color:#287dfa" class="title font-size-24"><span class='totalflight'></span> Flights found ({{$_REQUEST['IATA_from']}} @if($_REQUEST['flighttype']=='oneway') &#8594 @else &#8596 @endif {{$_REQUEST['IATA_to']}})</h3>

                            <p class="font-size-14"><span class="mr-1 pt-1">Book with confidence:</span>No flight booking fees</p>
                        </div>
                    </div>
                    <div class="filter-bar d-flex align-items-center justify-content-between">
                        <div class="filter-bar-filter d-flex flex-wrap align-items-center">
                            <div class="filter-option">
                                <h3 class="title font-size-16"> <a href="javascript:void(0)" rel="0" onclick="Edit_search()" class="Edit_search theme-btn theme-btn-small ">Edit</a> </h3>
                            </div>                            
                        </div><!-- end filter-bar-filter -->

                    <div style="display: flex;align-items: center;justify-content: start;">
                        <button style="border: 1px solid white" data-toggle="modal" data-target="#myModal2"><img src="{{url('/')}}/travel/filter.png" style="width: 20px; background: #ffffff; border-radius: 1px solid #ffffff; margin-right: 20px;"></button>
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
                    </div>
                    </div><!-- end filter-bar -->
                </div><!-- end filter-wrap -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
  











        <div class="row"  >




                            <div class="col-lg-3"  @if($device!='Desktop') style="display:" @endif>
                                <div class="wrapper filter_loader">
                                        <div class="item">
                                              <div class="animated-background round-box"></div>
                                              <div class="animated-background rect1"></div>
                                              <div class="animated-background rect2"></div>
                                              <div class="animated-background rect3"></div>
                                              <div class="animated-background rect4"></div>
                                              <div class="animated-background rect5"></div>   
                                        </div>
                                        <div class="item">
                                              <div class="animated-background round-box"></div>
                                              <div class="animated-background rect1"></div>
                                              <div class="animated-background rect2"></div>
                                              <div class="animated-background rect3"></div>
                                              <div class="animated-background rect4"></div>
                                              <div class="animated-background rect5"></div>   
                                        </div>
                                        <div class="item">
                                              <div class="animated-background round-box"></div>
                                              <div class="animated-background rect1"></div>
                                              <div class="animated-background rect2"></div>
                                              <div class="animated-background rect3"></div>
                                              <div class="animated-background rect4"></div>
                                              <div class="animated-background rect5"></div>   
                                        </div>
                                        <div class="item">
                                              <div class="animated-background round-box"></div>
                                              <div class="animated-background rect1"></div>
                                              <div class="animated-background rect2"></div>
                                              <div class="animated-background rect3"></div>
                                              <div class="animated-background rect4"></div>
                                              <div class="animated-background rect5"></div>   
                                        </div>
                                        <div class="item">
                                              <div class="animated-background round-box"></div>
                                              <div class="animated-background rect1"></div>
                                              <div class="animated-background rect2"></div>
                                              <div class="animated-background rect3"></div>
                                              <div class="animated-background rect4"></div>
                                              <div class="animated-background rect5"></div>   
                                        </div>
                                        <div class="item">
                                              <div class="animated-background round-box"></div>
                                              <div class="animated-background rect1"></div>
                                              <div class="animated-background rect2"></div>
                                              <div class="animated-background rect3"></div>
                                              <div class="animated-background rect4"></div>
                                              <div class="animated-background rect5"></div>   
                                        </div>
                                        <div class="item">
                                              <div class="animated-background round-box"></div>
                                              <div class="animated-background rect1"></div>
                                              <div class="animated-background rect2"></div>
                                              <div class="animated-background rect3"></div>
                                              <div class="animated-background rect4"></div>
                                              <div class="animated-background rect5"></div>   
                                        </div>
                                        <div class="item">
                                              <div class="animated-background round-box"></div>
                                              <div class="animated-background rect1"></div>
                                              <div class="animated-background rect2"></div>
                                              <div class="animated-background rect3"></div>
                                              <div class="animated-background rect4"></div>
                                              <div class="animated-background rect5"></div>   
                                        </div>
                                    </div>
                    {{--normal filter part start --}}


                     <div class="sidebar mt-0" style="display:">
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
                                                    <button class="theme-btn theme-btn-small theme-btn-transparent" type="button" onclick="Show_Flights('filter_apply')" >Apply</button>
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
                                                    <button class="theme-btn theme-btn-small theme-btn-transparent" type="button" onclick="Show_Flights('filter_apply')">Apply</button>
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
                                                    <button class="theme-btn theme-btn-small theme-btn-transparent" type="button" onclick="Show_Flights('filter_apply')">Apply</button>
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


                    {{--normal filter part end --}}







                               






                    {{-- filter model part start --}}

                    <!-- Modal -->
                    <div id="myModal2" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" id="mdlcls2" data-dismiss="modal">&times;</button>
                            
                          </div>
                          <div class="modal-body">
                            <div class="sidebar mt-0" style="display:none">
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
                                                    <button class="theme-btn theme-btn-small theme-btn-transparent" type="button" onclick="Show_Flights('filter_apply')" >Apply</button>
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
                                                    <button class="theme-btn theme-btn-small theme-btn-transparent" type="button" onclick="Show_Flights('filter_apply')">Apply</button>
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
                                                    <button class="theme-btn theme-btn-small theme-btn-transparent" type="button" onclick="Show_Flights('filter_apply')">Apply</button>
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
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                      {{-- model part end --}}




</div>{{-- col-lg- end --}}









           
            


            <div class="col-lg-9 flight_list">
            <div class="wrapper">
                   <div class="item">
                          <div class="animated-background round-box"></div>
                          <div class="animated-background rect1"></div>
                          <div class="animated-background rect2"></div>
                          <div class="animated-background rect3"></div>
                          <div class="animated-background rect4"></div>
                          <div class="animated-background rect5"></div>   
                    </div>
                    <div class="item">
                          <div class="animated-background round-box"></div>
                          <div class="animated-background rect1"></div>
                          <div class="animated-background rect2"></div>
                          <div class="animated-background rect3"></div>
                          <div class="animated-background rect4"></div>
                          <div class="animated-background rect5"></div>   
                    </div>
                    <div class="item">
                          <div class="animated-background round-box"></div>
                          <div class="animated-background rect1"></div>
                          <div class="animated-background rect2"></div>
                          <div class="animated-background rect3"></div>
                          <div class="animated-background rect4"></div>
                          <div class="animated-background rect5"></div>   
                    </div>
                    <div class="item">
                          <div class="animated-background round-box"></div>
                          <div class="animated-background rect1"></div>
                          <div class="animated-background rect2"></div>
                          <div class="animated-background rect3"></div>
                          <div class="animated-background rect4"></div>
                          <div class="animated-background rect5"></div>   
                    </div>
                    <div class="item">
                          <div class="animated-background round-box"></div>
                          <div class="animated-background rect1"></div>
                          <div class="animated-background rect2"></div>
                          <div class="animated-background rect3"></div>
                          <div class="animated-background rect4"></div>
                          <div class="animated-background rect5"></div>   
                    </div>
                    <div class="item">
                          <div class="animated-background round-box"></div>
                          <div class="animated-background rect1"></div>
                          <div class="animated-background rect2"></div>
                          <div class="animated-background rect3"></div>
                          <div class="animated-background rect4"></div>
                          <div class="animated-background rect5"></div>   
                    </div>
                    <div class="item">
                          <div class="animated-background round-box"></div>
                          <div class="animated-background rect1"></div>
                          <div class="animated-background rect2"></div>
                          <div class="animated-background rect3"></div>
                          <div class="animated-background rect4"></div>
                          <div class="animated-background rect5"></div>   
                    </div>
                    <div class="item">
                          <div class="animated-background round-box"></div>
                          <div class="animated-background rect1"></div>
                          <div class="animated-background rect2"></div>
                          <div class="animated-background rect3"></div>
                          <div class="animated-background rect4"></div>
                          <div class="animated-background rect5"></div>   
                    </div>
                </div>
            </div><!-- end col-lg-8 --> 

      

        </div><!-- end row -->

        <div class="row load_more" style="display:none">
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



<script src = "//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"> </script> 
<script src = "//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"> </script>

<script src = "https://code.jquery.com/jquery-3.4.1.min.js"> </script> 
<script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"> </script> 


<script type = "text/javascript" >
    jQuery(".common_beard_comb").hide();
var innerHtml = '';
var page = 0;
var search_id = '';

function Edit_search() {
    jQuery("#flight").show();
    var rel = jQuery('.Edit_search').attr('rel');
    if (rel == 0) {
        jQuery('.Edit_search_sec').show(500);
        jQuery('.Edit_search').attr('rel', '1');
    } else {
        jQuery('.Edit_search_sec').hide(500);
        jQuery('.Edit_search').attr('rel', '0');
    }

}

jQuery(document).ready(function() {


});

Show_Search();
//1  insert flight
function Show_Search() {
    $.ajax({
        url: '<?php url('
        '); ?>/get_flight_search_id',
        type: "get",
        data: {
            _token: "{{csrf_token()}}",
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
        success: function(data) {
            jQuery('.searching').show();
            jQuery('.loader').hide();
            console.log(data, 1);
            if (data.isFind == 'Yes') {
                search_id = data.search_id;

                Get_FlightController();
                Show_Flights('load');
                //Show_OutBoundFlights(data.search_session);
                //Show_InBoundFlights(data.search_session);
            } else {
                jQuery('.not_found').show();
                jQuery('.loader').hide();
                jQuery('.whole_content').hide();

                alert("No Flight Found.");
            }
        },
        error: function(error) {
            console.log(`Error ${error}`);
        }
    });
}






function Get_FlightController() {
    $.ajax({
        url: '<?php url('
        '); ?>/get_flight_filter_data',
        //url:'<?php url(''); ?>/flight-controller',
        type: "GET",
        data: {
            action: "get_flight_filter_data",
            search_id: search_id,
            user_id: "<?php echo $user_id; ?>",
            rand: "<?php echo rand(); ?>",
        },
        dataType: "json",
        success: function(data) {
            jQuery('.filter_loader').hide();
            jQuery('.sidebar').show();
            var cs = data.currency_symbol;
            var airlines = data.airlines;
            var airlinesHtml = '';
            var type = "'filter'";
            for (var i = 0; i < airlines.length; i++) {
                airlinesHtml += '<div class="custom-checkbox"><input onclick="Show_Flights(' + type + ')" type="checkbox" name="airlines" value="' + airlines[i].airline_code + '" id="chba' + i + '" ><label for="chba' + i + '">' + airlines[i].name + ' (' + airlines[i].carriercount + ')</label></div>';
            }
            jQuery('.Airline_Name_Filter').html(airlinesHtml);
            jQuery('.return_Airline_Name_Filter').html(airlinesHtml);
            var stopages = data.stopages;
            var stopagesHtml = '';
            for (var i = 0; i < stopages.length; i++) {
                stopagesHtml += '<div class="custom-checkbox"><input onclick="Show_Flights(' + type + ')" type="checkbox" name="Stops" value="' + stopages[i].max_stops + '" id="stopes' + i + '" ><label for="stopes' + i + '">' + stopages[i].max_stops + ' Stops (' + stopages[i].maxstopcount + ')</label></div>'
            }
            jQuery('.Stops_Filter').html(stopagesHtml);
            jQuery('.return_Stops_Filter').html(stopagesHtml);


            var maxprice = data.maxprice + 700;
            var minprice = data.minprice;
            var rangeSlider = $('#slider-range-price');
            var rangeSliderAmount = $('#price');
            if ($(rangeSlider).length) {
                $(rangeSlider).slider({
                    range: true,
                    min: minprice,
                    max: maxprice,
                    values: [minprice, maxprice],
                    slide: function(event, ui) {
                        $(rangeSliderAmount).val(ui.values[0] + "-" + ui.values[1]);
                    }
                });
            }
            $('#price_cs').html(cs);
            $(rangeSliderAmount).val($(rangeSlider).slider("values", 0) + "-" + $(rangeSlider).slider("values", 1));


            var fly_duration_maxtime = data.fly_duration_maxtime;
            var fly_duration_mintime = data.fly_duration_mintime;
            var rangeSliderDuration = $('#slider-range-duration');
            var rangeSliderAmountDuration = $('#duration');
            if ($(rangeSliderDuration).length) {
                $(rangeSliderDuration).slider({
                    range: true,
                    min: fly_duration_mintime,
                    max: fly_duration_maxtime,
                    values: [fly_duration_mintime, fly_duration_maxtime],
                    slide: function(event, ui) {
                        $(rangeSliderAmountDuration).val(ui.values[0] + ":00-" + ui.values[1] + ':00');
                    }
                });
            }
            $(rangeSliderAmountDuration).val($(rangeSliderDuration).slider("values", 0) + ":00-" + $(rangeSliderDuration).slider("values", 1) + ':00');

            var fly_duration_maxtime1 = data.returnfly_duration_maxtime;
            var fly_duration_mintime1 = data.returnfly_duration_mintime;
            var return_rangeSliderDuration = $('#return-slider-range-duration');
            var return_rangeSliderAmountDuration = $('#return-duration');
            if ($(return_rangeSliderDuration).length) {
                $(return_rangeSliderDuration).slider({
                    range: true,
                    min: fly_duration_mintime1,
                    max: fly_duration_maxtime1,
                    values: [fly_duration_mintime1, fly_duration_maxtime1],
                    slide: function(event, ui) {
                        $(return_rangeSliderAmountDuration).val(ui.values[0] + ":00 - " + ui.values[1] + ':00');
                    }
                });
            }
            $(return_rangeSliderAmountDuration).val($(return_rangeSliderDuration).slider("values", 0) + ":00 - " + $(return_rangeSliderDuration).slider("values", 1) + ':00');

        },

        error: function(error) {
            console.log(`Error ${error}`);
        }
    });
}








//2 afor show flight list
function Show_Flights(type) {
    // console.log(type,22)
    jQuery('.flight_list').addClass('opacity_5');
    if (type == 'filter') {
        innerHtml = '';
    } else if (type == 'filter_apply') {
        innerHtml = '';
        $("#mdlcls2").click();
    } else {
        page = page + 1;
    }
    var sortVal = document.getElementById("sort").value;
    var Arrival = document.getElementById("Arrival").value;
    var Departure = document.getElementById("Departure").value;
    var price = document.getElementById("price").value;
    var duration = document.getElementById("duration").value;
    var airlines = '';

    // Split the price value into its components
    var parts = price.split('-');
    // console.log(price,parts[0],parts[1])

    // Divide each component by 2
    var newMinPrice = parseFloat(parts[0]) / 2;
    var newMaxPrice = parseFloat(parts[1]) / 2;

    // Construct the new price value
    if (type == 'filter_apply' || type == "filter") {
        var newPrice = newMinPrice + ' - ' + newMaxPrice;
    } else {
        var newPrice = price;
    }


    jQuery("input[name=airlines]:checked").each(function() {
        var a = jQuery(this).val();
        airlines += a + ",";
    });

    var Stops = '';
    jQuery("input[name=Stops]:checked").each(function() {
        var s = jQuery(this).val();
        Stops += s + ",";
    });

    //alert("page=="+page+"\nsearch_session"+search_session)
    $.ajax({
        url: '<?php url('
        '); ?>/get_flight_list',
        type: "GET",
        data: {
            _token: "{{csrf_token()}}",
            action: "Show_Flights",
            search_id: search_id,
            sortVal: sortVal,
            Arrival: Arrival,
            Departure: Departure,
            duration: duration,
            price: newPrice,
            Stops: Stops,
            airlines: airlines,
            user_id: "<?php echo $user_id; ?>",
            rand: "<?php echo rand(); ?>",
        },
        dataType: "json",
        success: function(data) {
            console.log(data)
            if (data.hasOwnProperty('result')) {
                jQuery('.load_more').show();
                jQuery('.flight_list').removeClass('opacity_5');
                jQuery('.totalflight').html(data.result[0].totalcountfilter);
                jQuery('.showflight').html(page * 20);


                for (var i = 0; i < data.result.length; i++) {
                    if (data.result[i].max_stops == 0) {
                        var onewaystop = 'Non';
                    } else {
                        onewaystop = data.result[i].max_stops;
                    }
                    if (data.result[i].return_max_stops == 0) {
                        var returnstop = 'Non';
                    } else {
                        returnstop = data.result[i].return_max_stops;
                    }
                    if (data.result[i].isReturn == 'Yes') {
                        var arraow = '&#8596';
                    } else {
                        var arraow = '&#8594';
                    }
                    $price = parseFloat(data.result[i].price * 2);

                    //code 1
                     if (data.result[i].isReturn == 'Yes') {
                        var tripType = '&nbsp;&nbsp;&nbsp; Return Trip';
                    } else {
                         var tripType = '&nbsp;&nbsp;&nbsp; Oneway';
                    }


                    innerHtml+=`<div class="card-item flight-card flight--card card-item-list card-item-list-2">
                          <div class="card-body">
                            <div class="card-top-title d-flex justify-content-between">
                              <div style="color: black">
                                <h3 class="card-title font-size-17">${tripType}</h3>
                              </div>
                            </div>

                            <div style="text-align: center" class="flight-details py-3">
                              <div class="flight-time pb-3">
                                <div class="flight-time-item d-flex c-div-0">
                                  <div class="flex-shrink-0 mr-4 take-off airlineimg c-div-1">
                                    <img src="https://res.cloudinary.com/wego/image/upload/c_fit,w_100,h_100/v20190802/flights/airlines_square/${data.result[i].validating_carrier}" />
                                    <p>${data.result[i].onewayFlights[0].flight_no}</p>
                                    <p>${data.result[i].onewayFlights[0].airline_name}</p>
                                  </div>
                                  <div class="d-flex c-div-2">
                                    <div class="c-div-3">
                                      <h3 class="card-title font-size-15 font-weight-medium mb-0">${data.result[i].origon_airport}</h3>
                                      <p class="card-meta font-size-14">${data.result[i].departure_date}</p>
                                      <p class="card-meta font-size-14">${data.result[i].departure_time}</p>
                                    </div>
                                    <div class="c-div-4">
                                      <h3 class="card-title font-size-15 font-weight-medium mb-0">${ onewaystop}</h3>
                                      <hr />
                                      <h3 class="card-meta font-size-14">${data.result[i].fly_duration}</h3>
                                    </div>
                                    <div class="c-div-5">
                                      <h3 class="card-title font-size-15 font-weight-medium mb-0">${data.result[i].destination_airport}</h3>
                                      <p class="card-meta font-size-14">${data.result[i].arrival_date}</p>
                                      <p class="card-meta font-size-14">${data.result[i].arrival_time}</p>
                                    </div>
                                  </div>
                                  <div class="c-div-6">
                                    <h6 class="" >
                                      <span style="font-size:20px">From <span> <span style="color: #f75b10">{{$currency_symbol}}${$price.toLocaleString()}</span><br /><span
                                        ><span style="font-size: 15px">and get 50% back in amplepoints </span><br />
                                       <span style="font-size: 15px"> or <br />
                                        buy it free with </span> </span
                                      ><span class="price__num" style="color: #f75b10;font-size: 15px">${parseInt(data.result[i].no_of_amples)}</span><span style="font-size: 15px"> amplepoints </span>
                                    </h6>
                                  </div>
                                </div>



                                ${data.result[i].isReturn == 'Yes' ? 
                                    `<div class="flight-time-item d-flex c-div-0">
                                  <div class="flex-shrink-0 mr-4 take-off airlineimg c-div-1">
                                    <img src="https://res.cloudinary.com/wego/image/upload/c_fit,w_100,h_100/v20190802/flights/airlines_square/${data.result[i].return_validating_carrier}" />
                                    <p>${data.result[i].returnFlights[0].flight_no}</p>
                                    <p>${data.result[i].returnFlights[0].airline_name}</p>
                                  </div>
                                  <div class="d-flex c-div-2">
                                    <div class="c-div-3">
                                      <h3 class="card-title font-size-15 font-weight-medium mb-0">${data.result[i].destination_airport}</h3>
                                      <p class="card-meta font-size-14">${data.result[i].return_departure_date}</p>
                                      <p class="card-meta font-size-14">${data.result[i].return_departure_time}</p>
                                    </div>
                                    <div class="c-div-4">
                                      <h3 class="card-title font-size-15 font-weight-medium mb-0">Non Stop</h3>
                                      <hr />
                                      <h3 class="card-meta font-size-14">${data.result[i].return_total_duration}</h3>
                                    </div>
                                    <div class="c-div-5">
                                      <h3 class="card-title font-size-15 font-weight-medium mb-0">${data.result[i].origon_airport}</h3>
                                      <p class="card-meta font-size-14">${data.result[i].return_arrival_date}</p>
                                      <p class="card-meta font-size-14">${data.result[i].return_arrival_time}</p>
                                    </div>
                                  </div>
                                  <div class="c-div-6">
                                  @if(@Auth::user()->id && @Auth::user()->user_type!="admin")
                                   <div class="btn-box text-center"><a href="flight-booking/${btoa(data.result[i].id)}"  class="theme-btn theme-btn-small" style="width: auto; text-align: center; padding:4px 38px;margin-bottom: 111px;">Select</a></div>
                                  @elseif(@Auth::user()->id && @Auth::user()->user_type=="admin")@else
                                    <div class="btn-box text-center"><a href="{{ asset("login") }}" class="theme-btn theme-btn-small" style="width: auto; text-align: center; padding:4px 38px;margin-bottom: 111px;">Login To Book</a></div>
                                  
                                  @endif
                                  </div>
                                </div>`
                                   
                                    : 
                                    ""}

                              </div>
                            </div>
                          </div>
                        </div>
                        `;

                } // End For Loop 

                jQuery('.flight_list').html(innerHtml);
            } //end if of has property
            else {
                jQuery('.flight_list').html('No data found');
            }
        }, // End Response
        error: function(error) {
            console.log(`Error ${error}`);
        } //end Error
    }); // end Ajax Fun
} // end Show_Flights Fun






function ShowHideFilter(type) {
    jQuery('.akm').removeClass('theme-btn-transparent mr-1');

    if (type == 'outbound') {
        jQuery('.onewayfilter').show();
        jQuery('.roundfilter').hide();
        jQuery('.return').addClass('theme-btn-transparent mr-1');
    } else {
        jQuery('.roundfilter').show();
        jQuery('.onewayfilter').hide();
        jQuery('.outbound').addClass('theme-btn-transparent mr-1');
    }

} 
</script>

@include('site.footer')
