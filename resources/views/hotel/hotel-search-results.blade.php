@include('site.header')
           @inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
                $common_data= $data['siteData']['common_data'];
                $device=$data['device'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                $currency=$data['siteData']['currency'];  
                $currency_symbol=$data['siteData']['currency_symbol'];   
                $oc=json_decode($pageData->other_content,true);
         @endphp
         
        <?php  
                if(!isset($_REQUEST['city_code'])){ $_REQUEST['city_code']=$pageData->city_to_code; } 
                if(!isset($_REQUEST['city_name'])){ $_REQUEST['city_name']=$pageData->city_to;  } 
                if(!isset($_REQUEST['date_range'])){ 
                $_REQUEST['date_range']=date('d/m/Y',strtotime(date('m/d/Y').' +'.$oc["outbound_days"].' day')).'-'.date('d/m/Y',strtotime(date('m/d/Y').' +'.$oc["inbound_days"].' day')); } 
                //if(!isset($_REQUEST['check_out'])){ $_REQUEST['check_out']=date('d/m/Y',strtotime(date('m/d/Y').' +'.$oc["inbound_days"].' day')); } 
                if(!isset($_REQUEST['adults'])){ $adults[]=$oc['adult']; }  else{ $adults=$_REQUEST['adults']; }
                if(!isset($_REQUEST['childs'])){ $childs[]=$oc['child']; }  else{ $childs=$_REQUEST['childs']; }
                if(!isset($_REQUEST['rooms'])){ $_REQUEST['rooms']=$oc['room']; }
                if(!isset($_REQUEST['child_age'])){ $_REQUEST['child_age']=NULL; }
                
                /*echo "adults==="; print_r($_REQUEST['adults']);
                echo "<br><br><pre>age ====";  print_r($_REQUEST['child_age']);
                for($i=0;$i<$_REQUEST['rooms'];$i++){
                    //echo "<br><br><pre>age ".$i."====";  print_r($_REQUEST['age_child_'.$i]);
                }*/     
        $date_range_arr=explode('-',$_REQUEST['date_range']);
        $check_in=trim($date_range_arr[0]);
        $check_out=trim($date_range_arr[1]);    
    
         ?>

<style>
@media only screen and (max-width: 999px) {
.card-item .card-img a {
width: 100%;
max-height: 240px;
}
.c-item-1 {
padding: 0;
}
.c-item-2 {
}
.c-item-2,
.c-item-3 {
padding: 20px 20px 20px !important;
}
.c-item-3 {
border-left: none;
border-top: 1px solid #0000003b;
}
.card-item.card-item-list .row {
margin: 0;
}
.filter-bar-filter {
margin-bottom: 20px;
}
}
</style>
         
        
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








.custom-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 10vh;
  margin: 0;
}

.custom-loader {
  border: 8px solid #f3f3f3; /* Light grey */
  border-top: 8px solid #f75b10;; /* Blue */
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<?php
//
if(!isset($_REQUEST['child_age'])){  $_REQUEST['child_age']=array(NULL); }
$adultsStr='';
foreach($adults as $v){   
      $adultsStr.= $v.",";   
     }
$adults =substr($adultsStr,0,-1);
$childsStr='';
foreach($childs as $v){   
      $childsStr.= $v.",";   
     }
$childs =substr($childsStr,0,-1);




 ?>
 



<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="hero-wrapper hero-wrapper6 Edit_search_sec Edit_search" rel="0" style="display:none">
     <div  @if($device=='Desktop') style="padding-top: 100px;padding-bottom: 100px;background:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.5)),url({{$pageData->image}});background-size: cover;" @endif>        
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="search-fields-container mt-4" style="box-shadow: 2px 2px 20px #dfdfdf;">
                        <div class="tab-content" id="myTabContent3">
                        @include('hotel.hotel-search-box')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






  <div class="custom-container" id="cc">
    <div class="custom-loader"></div>
  </div>
<!-- end breadcrumb-area -->

<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
    START CARD AREA
================================= -->

<section class="card-area not_found" style="display:none">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                    <div class="container" style=" text-align:center;color:#FF0000">Sorry, Hotel Not Found.</div> 
            </div>
        </div>
    </div>
</section>

<section class="card-area section--padding whole_content" >
    <div class="container" >
        <div class="row">
            <div class="col-lg-12">
                <div class="filter-wrap margin-bottom-30px">
                    <div class="filter-top d-flex align-items-center justify-content-between pb-4">
                        <div>
                            <h3 class="title font-size-24"><span class="totalhotel"></span> Hotels found</h3>
                            <p class="font-size-14"><span class="mr-1 pt-1">Book with confidence:</span>No hotel booking fees</p>
                        </div>
                    </div><!-- end filter-top -->

                   <div class="filter-bar d-flex align-items-center justify-content-between">
                   
                        <div class="filter-bar-filter d-flex flex-wrap align-items-center">
                        <div class="filter-option">
                                <h3 class="title font-size-16"> <a href="javascript:void(0)" rel="0" onclick="Edit_search()" class="Edit_search theme-btn theme-btn-small ">Edit</a> </h3>
                            </div>
                        </div><!-- end filter-bar-filter -->

                    <div style="display: flex;align-items: center;justify-content: start;">
                        <button style="border: 1px solid white" data-toggle="modal" data-target="#myModal"><img src="{{url('/')}}/travel/filter.png" style="width: 20px; background: #ffffff; border-radius: 1px solid #ffffff; margin-right: 20px;"></button>
                        
                         <div class="select-contain" >
                            <select class="select-contain-select" name="sort" id="sort" onchange="Show_Hotels('filter')">
                                <option value="lowRate_ASC" selected="selected">Sort Your Hotel</option>
                                <option value="lowRate_ASC">Price: low to high</option>
                                <option value="lowRate_DESC">Price: high to low</option>
                                <option value="hotelRating_ASC">Star Rating: low to high</option>
                                <option value="hotelRating_DESC">Star Airline: high to low</option>
                                <option value="Name_ASC">Duration: A to Z</option>
                                <option value="Name_DESC">Duration: Z to A</option>
                            </select>
                        </div><!-- end select-contain -->
                    </div>

                    </div><!-- end filter-bar -->
                </div><!-- end filter-wrap -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->

       
        <div class="row">
     
<div class="col-lg-4" @if($device!='Desktop') style="display:none" @else style="display:none"  @endif>
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
    
    </div><!-- end col-lg-4 -->
    
    <div class="col-lg-12">
        {{--                <div class="" id="">
            <div class="card-item card-item-list mb-4" style="border-radius: 10px">
                <div class="row">
                    <div class="col-lg-3 col-12 c-item-1">
                        <div class="card-img" style="height: 100%">
                            <span class="badge">ROOM ONLY</span>
                            <a href="http://127.0.0.1:8000/hotel-details/NzYz/OYO%2010274%20Hotel%20Aamara" class="d-block" style="height: 100%">
                                <img src="./hotel-search-results_files/663786a_hb_a_001.jpg" alt="hotel-img" class="img-fluid" style="height: 100%; object-fit: cover" />
                            </a>
                            <div class="add-to-wishlist icon-element" data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark"><i class="la la-heart-o"></i></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 c-item-2" style="padding: 20px 10px 20px">
                        <div class="h-title" style="font-size: 20px">OYO 10274 Hotel Aamara (HOTEL)</div>
                        <div>
                            <span class="ratings mr-3">
                                <i class="la la-star"> </i>
                                <i class="la la-star"> </i>
                                <i class="la la-star-o"> </i>
                                <i class="la la-star-o"> </i>
                                <i class="la la-star-o"> </i>
                            </span>
                            <span class="h-s-title">Block A road no 4 street no 9 Mahipalpur Ext407Air, Delhi</span>
                        </div>
                        <div>
                            <a target="_blank" href="https://www.google.com/maps/search/?api=1&amp;query=OYO%2010274%20Hotel%20Aamara%20Block%20A%20road%20no%204%20street%20no%209%20Mahipalpur%20Ext407Air,%20Delhi" class="">Show on Map</a>
                        </div>
                        <div>
                            <ul style="display: flex; justify-self: start; align-items: center; flex-wrap: wrap">
                                <li class="mr-2"><i class="la la-star"></i> Small pets allowed (under 5 kg)</li>
                                <li class="mr-2"><i class="la la-star"></i> Large pets allowed (over 5 kg)</li>
                                <li class="mr-2"><i class="la la-star"></i> Wheelchair-accessible</li>
                                <li class="mr-2"><i class="la la-star"></i> Car park</li>
                                <li class="mr-2"><i class="la la-star"></i> Garage</li>
                                <li class="mr-2"><i class="la la-star"></i> 24-hour reception</li>
                                <li class="mr-2"><i class="la la-star"></i> Check-in hour</li>
                                <li class="mr-2"><i class="la la-star"></i> Check-out hour</li>
                                <li class="mr-2"><i class="la la-star"></i> Wired Internet</li>
                                <li class="mr-2"><i class="la la-star"></i> Wi-fi</li>
                                <li class="mr-2"><i class="la la-star"></i> Secure parking</li>
                                <li class="mr-2"><i class="la la-star"></i> Room service</li>
                                <li class="mr-2"><i class="la la-star"></i> 24-hour security</li>
                                <li class="mr-2"><i class="la la-star"></i> Air conditioning in public areas</li>
                                <li class="mr-2"><i class="la la-star"></i> Lift access</li>
                                <li class="mr-2"><i class="la la-star"></i> Newspapers</li>
                                <li class="mr-2"><i class="la la-star"></i> Electric kettle</li>
                                <li class="mr-2"><i class="la la-star"></i> Towels and bed linen</li>
                            </ul>
                        </div>
                        <div>
                            <span>
                                <i class="la la-star"></i><i class="la la-star"></i><i class="la la-star"></i><i class="la la-star"></i><i class="la la-star"></i>
                            </span>
                            <span class="text-primary">4179 Reviews</span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-primary btn-sm">Compare</button>
                            <button type="button" class="btn btn-link">Full Description</button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 c-item-3" style="padding: 20px 10px 20px; border-left: 1px solid #0000003b; padding-right: 25px">
                        <div class="card-price">
                            <span class="price__from">From </span>
                            <span class="price__num">$ 61( <span style="text-decoration: line-through"> $ 122 </span> )</span>
                        </div>
                        <span class="theme-btn w-100 text-center margin-top-20px Search_Now">See details<i class="la la-angle-right"></i></span>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="hotellist" id="hotellist">
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
            </div><!-- end card-item -->
            </div><!-- end col-lg-8 -->
            </div><!-- end row -->
            <div class="row load_more" style="display:none">
                <div class="col-lg-12">
                    <div class="btn-box mt-3 text-center">
                        <button type="button" class="theme-btn" onclick="Show_Hotels('load')"><i class="la la-refresh mr-1"></i>Load More</button>
                        <p class="font-size-13 pt-2">Showing 1 - <span class="totalhotel_to"></span> of <span class="totalhotel"></span> Hotels</p>
                        </div><!-- end btn-box -->
                        </div><!-- end col-lg-12 -->
                        </div><!-- end row -->
                        </div><!-- end container -->
                        </section><!-- end card-area -->
                        <!-- ================================
                        END CARD AREA
                        ================================= -->
 












  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" id="mdlcls" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
           <div class="sidebar mt-0" >
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Filter by Rating</h3>
                        <div class="sidebar-review">
                            <div class="custom-checkbox">
                                <input type="checkbox" name="starrating" value="5" onclick="Show_Hotels('filter')" id="s5">
                                <label for="s5">
                                    <span class="ratings d-flex align-items-center">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <span class="color-text-3 font-size-13 ml-1 star5">(...)</span>
                                    </span>
                                </label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" name="starrating" value="4" onclick="Show_Hotels('filter')" id="s4">
                                <label for="s4">
                                    <span class="ratings d-flex align-items-center">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star-o"></i>
                                        <span class="color-text-3 font-size-13 ml-1 star4">(...)</span>
                                    </span>
                                </label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" name="starrating" value="3" onclick="Show_Hotels('filter')" id="s3">
                                <label for="s3">
                                    <span class="ratings d-flex align-items-center">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star-o"></i>
                                        <i class="la la-star-o"></i>
                                        <span class="color-text-3 font-size-13 ml-1 star3">(...)</span>
                                    </span>
                                </label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" name="starrating" value="2"  onclick="Show_Hotels('filter')" id="s2">
                                <label for="s2">
                                    <span class="ratings d-flex align-items-center">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star-o"></i>
                                        <i class="la la-star-o"></i>
                                        <i class="la la-star-o"></i>
                                        <span class="color-text-3 font-size-13 ml-1 star2">(...)</span>
                                    </span>
                                </label>
                            </div>
                            <div class="custom-checkbox mb-0">
                                <input type="checkbox" name="starrating" value="1" onclick="Show_Hotels('filter')" id="s1">
                                <label for="s1">
                                    <span class="ratings d-flex align-items-center">
                                        <i class="la la-star"></i>
                                        <i class="la la-star-o"></i>
                                        <i class="la la-star-o"></i>
                                        <i class="la la-star-o"></i>
                                        <i class="la la-star-o"></i>
                                        <span class="color-text-3 font-size-13 ml-1 star1">(...)</span>
                                    </span>
                                </label>
                            </div>
                        </div>

                    </div><!-- end filter by rating -->
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Filter by Price</h3>
                        <div class="sidebar-price-range">
                            <div class="main-search-input-item">
                                <div class="price-slider-amount padding-bottom-20px">
                                    <label for="amount2" class="filter__label">Price:</label>
                                    <input type="text" id="amount2_1" class="amounts amount2_1">
                                </div><!-- end price-slider-amount -->
                                <div id="slider-range2" class="slider-range2" onclick="Show_Hotels('filter')"></div><!-- end slider-range -->
                            </div><!-- end main-search-input-item -->
                            <div class="btn-box pt-4">
                                <button class="theme-btn theme-btn-small theme-btn-transparent" onclick="Show_Hotels('filter','mdl')" type="button">Apply</button>
                            </div>
                        </div>
                    </div><!-- end filter by price -->
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Search By Hotel Name </h3>
                        <div class="sidebar-category">
                            <div class="custom-checkbox">
                  <input name="findbynamefilter" id="findbynamefilter" placeholder="Search By Hotel Name" type="text" id="ht1"><input id="findbynamebtn" onclick="Show_Hotels('filter')" type="button" value="search" id="ht1">
                            </div>
                        </div>
                    </div><!-- end filter by name -->
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Filter by Board</h3>
                        <div class="sidebar-category board">                            
                        </div>
                    </div><!-- end filter by board --> 
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Filter by Product</h3>
                        <div class="sidebar-category product">                            
                        </div>
                    </div><!-- end filter by board --> 
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Filter by Accommodation Type</h3>
                        <div class="sidebar-category accommodationType">                            
                        </div>
                    </div><!-- end filter by board -->
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Facilities</h3>
                        <div class="sidebar-category amenity">
                        </div>
                    </div><!-- end filter by aminity -->
                </div><!-- end sidebar -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<div class="section-block"></div>



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
                                <script type="text/javascript">
jQuery(".common_beard_comb").hide(); jQuery(".preloader").hide();
var innerHtml=''; var page=0; var search_session='';
var tids=[];
var opcty=0;
function Edit_search(){
jQuery("#hotel").show();
    var rel = jQuery('.Edit_search').attr('rel');
    if(rel==0){ 
            jQuery('.Edit_search_sec').show(500);
            jQuery('.Edit_search').attr('rel','1');
    }else{
            jQuery('.Edit_search_sec').hide(500);
            jQuery('.Edit_search').attr('rel','0');
    }

}


      jQuery(document).ready(function(){   
         jQuery('.sidebsr').hide();
                                    jQuery('.searching').hide(); 
                                    jQuery('.load_more').hide();
                                    jQuery('.loader').hide();
                                    jQuery('.whole_content').hide();
       
                    FindKey();
                     function FindKey() {
                            $.ajax({
                                url:<?php url('');?>'/findsearchkey',
                                type: "GET",
                                data: {
                                    action: "findsearchkey",  
                                    regionid: "<?php echo $_REQUEST['city_code']; ?>",
                                    destination: "<?php echo $_REQUEST['city_name']; ?>",
                                    checkIn: "<?php echo $check_in; ?>",  
                                    checkOut: "<?php echo $check_out; ?>",
                                    rooms: "<?php echo $_REQUEST['rooms']; ?>",
                                    adults: '<?php echo json_encode($adults); ?>',
                                    childs: '<?php echo json_encode($childs); ?>',
                                    rand: Math.random()
                                },
                                dataType: "json",
                                success: function (data) {
                                    search_session=data.search_session;
                                    Upldate_Rates_All_custom()
                                    Upldate_Rates_All();                                    
                                },
                                error: function (error) {
                                    console.log(`Error ${error}`);
                                }
                            });
                     }
                        var page_number=1;
                        var loop =0;
                        
                        function Upldate_Rates_All_custom(){
                        if(opcty==0){
                                jQuery('.hotellist').addClass('opacity_5');
                                }
                         $.ajax({
                                url:<?php url('');?>'/GetHotelListCustom',
                                type: "GET",
                                data: {
                                    action: "GetHotelListCustom",  
                                    regionid: "<?php echo $_REQUEST['city_code']; ?>",
                                    destination: "<?php echo $_REQUEST['city_name']; ?>",
                                    checkIn: "<?php echo $check_in; ?>",  
                                    checkOut: "<?php echo $check_out; ?>",
                                    rooms: "<?php echo $_REQUEST['rooms']; ?>",
                                    adults: '<?php echo json_encode($adults);  ?>',
                                    childs: '<?php echo json_encode($childs); ?>',
                                    childAge: '<?php echo json_encode($_REQUEST['child_age']); ?>',
                                    page_number: page_number,
                                    search_session: search_session, 
                                    rand: Math.random()
                                },
                                dataType: "json",
                                success: function (data) {
                                console.log(1111,data);
                                loop++;
                                    var pageCount=data.pageCount;
                                    var total_records = data.total_records; 
                                    if(data.total_records>0){ 
                                            if( (pageCount>0) && (loop<200) ){ 
                                             page_number++;
                                             setTimeout(function(){Upldate_Rates_All();},100);
                                            }
                                        Show_Hotels('search');
                                         getControls();
                                        //Show_OutBoundFlights(data.search_session);
                                        //Show_InBoundFlights(data.search_session);
                                    }else{
                                        if( (pageCount>0) && (loop<200) ){ 
                                             page_number++;
                                             setTimeout(function(){Upldate_Rates_All();},100);
                                             jQuery('.hotellist').removeClass('opacity_5');
                                        }else{
                                            jQuery('.hotellist').removeClass('opacity_5');
                                        }
                                    }
                                },
                                error: function (error) {
                                    console.log(`Error ${error}`);
                                }
                            });
                            }
                        
                        function Upldate_Rates_All(){
                        if(opcty==0){
                                jQuery('.hotellist').addClass('opacity_5');
                                }
                         $.ajax({
                                url:<?php url('');?>'/GetHotelList',
                                type: "GET",
                                data: {
                                    action: "GetHotelList",  
                                    regionid: "<?php echo $_REQUEST['city_code']; ?>",
                                    destination: "<?php echo $_REQUEST['city_name']; ?>",
                                    checkIn: "<?php echo $check_in; ?>",  
                                    checkOut: "<?php echo $check_out; ?>",
                                    rooms: "<?php echo $_REQUEST['rooms']; ?>",
                                    adults: '<?php echo json_encode($adults);  ?>',
                                    childs: '<?php echo json_encode($childs); ?>',
                                    childAge: '<?php echo json_encode($_REQUEST['child_age']); ?>',
                                    page_number: page_number,
                                    search_session: search_session, 
                                    rand: Math.random()
                                },
                                dataType: "json",
                                success: function (data) {
                                console.log(data);
                                loop++;
                                    var pageCount=data.pageCount;
                                    var total_records = data.total_records; 
                                    if(data.total_records>0){ 
                                            if( (pageCount>0) && (loop<200) ){ 
                                             page_number++;
                                             setTimeout(function(){Upldate_Rates_All();},100);
                                            }
                                        Show_Hotels('search');
                                         getControls();
                                        //Show_OutBoundFlights(data.search_session);
                                        //Show_InBoundFlights(data.search_session);
                                    }else{
                                        if( (pageCount>0) && (loop<200) ){ 
                                             page_number++;
                                             setTimeout(function(){Upldate_Rates_All();},100);
                                        }else{
                                            if(opcty==0){
                                                jQuery('.hotellist').addClass('opacity_5');
                                                }
                                        }
                                    }
                                },
                                error: function (error) {
                                    console.log(`Error ${error}`);
                                }
                            });
                            }

    });  
      















let apiCallsCompleted = 0;

// Array to store unique hotels
const uniqueHotels = [];

  function hideLoader() {
    // console.log("testii");
      // Check if all API calls have been completed
      if (apiCallsCompleted >= 5) {
        // Hide the loader
        // console.log("test");
        $("#cc").hide();
      }
    }

                                
                            function Show_Hotels(type,mdl=null)
                            {   //var search_session='62f0011bf1e94';
                            // if(apiCallsCompleted <=5){
                              apiCallsCompleted++;
                              console.log(mdl)
                               
                                if(opcty==0){
                                jQuery('.hotellist').addClass('opacity_5');
                                }
                                opcty=1;
                                var sortVal= document.getElementById("sort").value;
                                var Cri_Rating = ''; var Cri_board = ''; var Cri_product = ''; var Cri_amenity = '';  var hotel_name='';; var price=''; 
                                var accommodationType='';
                                if(type!='search'){ 
                                    
                                    if(type=='filter'){  innerHtml=''; if(mdl!=null){  $("#mdlcls").click();} } else { page=page+1; }
                                    
                                    jQuery('input[name=starrating]:checked').each(function(i) { 
                                        Cri_Rating[i] = jQuery(this).val();
                                         var a=jQuery(this).val() ;
                                           Cri_Rating +=a+",";
                                    });
                                    
                                    jQuery('input[name=board]:checked').each(function(i) { 
                                        Cri_board[i] = jQuery(this).val();
                                         var a=jQuery(this).val() ;
                                           Cri_board +=a+",";
                                    });
                                    
                                    jQuery('input[name=product]:checked').each(function(i) { 
                                        Cri_product[i] = jQuery(this).val();
                                         var a=jQuery(this).val() ;
                                           Cri_product +=a+",";
                                    });
                                    
                                    jQuery('input[name=accommodationType]:checked').each(function(i) { 
                                        accommodationType[i] = jQuery(this).val();
                                         var a=jQuery(this).val() ;
                                           accommodationType +=a+",";
                                    });
                                    
                                    jQuery('input[name=Cri_amenity]:checked').each(function(i) { 
                                        Cri_amenity[i] = jQuery(this).val();
                                         var a=jQuery(this).val() ;
                                           Cri_amenity +=a+",";
                                    });
                                     hotel_name = document.getElementById('findbynamefilter').value;
                                     price= document.getElementById("amount2_1").value;
                                     // Split the price value into its components
                                    var parts = price.split(' - ');

                                    // Divide each component by 2
                                    var newMinPrice = parseFloat(parts[0]) / 2;
                                    var newMaxPrice = parseFloat(parts[1]) / 2;

                                    // Construct the new price value
                                    if(mdl!=null){
                                        var newPrice = newMinPrice + ' - ' + newMaxPrice;
                                    }else{
                                        var newPrice = price;
                                    }
                                }
                                
                                jQuery('.totalhotel_to').html(page*10); 
                                 $.ajax({
                                url:<?php url('');?>'/Show_Hotels',
                                type: "GET",
                                data: {
                                    action: "Show_Hotels",
                                    search_id: search_session,
                                    page: page,  
                                    sortVal: sortVal,
                                    Cri_Rating: Cri_Rating,
                                    Cri_board: Cri_board, 
                                    Cri_product: Cri_product,
                                    accommodationType: accommodationType, 
                                    Cri_amenity: Cri_amenity,  
                                    hotel_name: hotel_name, 
                                    price: newPrice,
                                    rand: Math.random()
                                },
                                dataType: "json",
                                success: function (data) {
                                    // alert(1)
                                    if (data.hasOwnProperty('result')) {
                                        // console.log(12)

                                    console.log(12,data)
                                    jQuery('.sidebsr').show();
                                    jQuery('.searching').show(); 
                                    jQuery('.load_more').show();
                                    jQuery('.loader').hide();
                                    jQuery('.whole_content').show();
                                    jQuery('.hotellist').removeClass('opacity_5');
                                    // console.log(data.result);
                                    jQuery('.totalhotel').html(data.result[0].total);
                                    //alert(data.result.length); alert(data.result[0].thumbnail);
                                    if(data.result.length>0){ 
                                        
                                    for(var i=0;i<data.result.length;i++){
                                        // console.log("jt",data.result[i])

                                          const existingHotelIndex = uniqueHotels.findIndex(uniqueHotel => uniqueHotel === data.result[i].Name);
                                            // If the hotel name doesn't exist, add the hotel to the unique hotels array
                                            if (existingHotelIndex === -1) {
                                                uniqueHotels.push(data.result[i].Name);
                                            


                                         var book_link='hotel-details/'+btoa(data.result[i].tid)+'/'+data.result[i].Name; 
                                    
                                    
                                          innerHtml +=`<div class="card-item card-item-list mb-4" style="border-radius: 10px">
                                            <div class="row">
                                              <div class="col-lg-3 col-12 c-item-1">
                                                <div class="card-img" style="height: 100%">
                                                  <span class="badge">${data.result[i].boardName}</span>
                                                  <a href="${book_link}" style="height: 100%">`+'<img src="'+data.result[i].thumbnail+'" onerror="this.onerror=null; this.src=\'<?php echo url('');?>/images/nohotel.jpg\'" alt="hotel-img">'+
                                                  `</a>
                                                  <div class="add-to-wishlist icon-element" data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark"><i class="la la-heart-o"></i></div>
                                                </div>
                                              </div>
                                              <div class="col-lg-6 col-12 c-item-2" style="padding: 20px 10px 20px">
                                                <div class="h-title" style="font-size: 20px">${data.result[i].Name}(${data.result[i].accommodationType})</div>
                                                <div>
                                              

                                                   <span class="ratings mr-3">`;
                                            
                                            // Star ratings
                                            for (var ra = 0; ra < data.result[i].StarRating; ra++) {
                                                innerHtml += `<i class="la la-star"> </i>`;
                                            }
                                            for (var ra = data.result[i].StarRating; ra < 5; ra++) {
                                                innerHtml += `<i class="la la-star-o"> </i>`;
                                            }

                                            innerHtml += `</span>

                                                  <span class="h-s-title">${data.result[i].Address1}, ${data.result[i].City}</span>
                                                </div>
                                                <div>
                                                  <a target="_blank" href="https://www.google.com/maps/search/?api=1&amp;query=${data.result[i].Name} ${data.result[i].Address1} ${data.result[i].City}" class="">Show on Map</a>
                                                </div>
                                                <div>
                                                  <ul style="display: flex; justify-self: start; align-items: center; flex-wrap: wrap">
                                                   ${data.result[i].amenetyData}
                                                  </ul>
                                                </div>
                                                <div>
                                                  <span>
                                                    <i class="la la-star"></i><i class="la la-star"></i><i class="la la-star"></i><i class="la la-star"></i><i class="la la-star"></i>
                                                  </span>
                                                  <span class="text-primary">4179 Reviews</span>
                                                </div>
                                                <div>
                                                  



                                                  <button type="button" class="btn btn-link">Full Description</button>
                                                </div>
                                              </div>
                                              <div class="col-lg-3 col-12 c-item-3" style="padding: 20px 10px 20px; border-left: 1px solid #0000003b; padding-right: 25px">
                                                <div class="card-price">
                                                  <span class="price__from">From </span>
                                                  <span class="price__num" style="color: #f75b10;">${data.result[i].currency_symbol} ${data.result[i].LowRate*2} </span><br>
                                                  <span> or <br> buy it free with </span>  <span class="price__num" style="color: #f75b10;"> ${parseInt(data.result[i].no_of_amples)} </span>  <span>  amplepoints </span>
                                                </div>
                                                <a href="${book_link}" class="theme-btn w-100 text-center margin-top-20px Search_Now">See details<i class="la la-angle-right"></i></a>
                                              </div>
                                            </div>
                                          </div>`;
                                      }// end if of dublicate chk

                                    }//end for
                                    }else{
                                         console.log(123);
                                        jQuery('.not_found').show();
                                            jQuery('.loader').hide();
                                            alert("No Hotel Found.");
                                    }
                                    jQuery('.hotellist').html(innerHtml);
                                    }//
                                    else{
                                        // console.log(34);
                                        // jQuery('.sidebsr').hide();
                                        // jQuery('.searching').hide(); 
                                        // jQuery('.load_more').hide();
                                        // jQuery('.loader').hide();
                                        // jQuery('.whole_content').hide();
                                        // jQuery('.hotellist').html('No Data');
                                    }
                                    console.log("api "+apiCallsCompleted)
                                    console.log(uniqueHotels);
                                    // jQuery('.totalhotel').html(uniqueHotels.length);
                                    hideLoader();
                                },
                                error: function (error) {
                                    console.log(`Error ${error}`);
                                }
                               });
                             // }
                            }

                            











                            function getControls() { // var search_session='62f0011bf1e94';
                                 $.ajax({
                                url:<?php url('');?>'/getControls',
                                type: "GET",
                                data: {
                                    action: "getControls",
                                    search_id: search_session,
                                    page: page,  
                                    rand: Math.random()
                                },
                                dataType: "json",
                                success: function (data) {
                                    jQuery('.sidebar').show();
                                    jQuery('.filter_loader').hide();
                                    jQuery('.star0').html('('+data.stars0+')');
                                    jQuery('.star1').html('('+data.stars1+')');
                                    jQuery('.star2').html('('+data.stars2+')');
                                    jQuery('.star3').html('('+data.stars3+')');
                                    jQuery('.star4').html('('+data.stars4+')');
                                    jQuery('.star5').html('('+data.stars5+')');
                                    var cs=data.currency_symbol; 
                                    
                                    var product=data.product;
                                    var productHtml='';  
                                    for(var i=0;i<product.length;i++){  
                                        productHtml+='<div class="custom-checkbox"><input onclick="Show_Hotels(\'filter\')" name="product" value="'+product[i].name+'" type="checkbox" id="p'+i+'"><label for="p'+i+'">'+product[i].name+'</label></div>';
                                    }
                                jQuery('.product').html(productHtml);
                                
                                var accommodationType=data.accommodationType;
                                    var accommodationTypeHtml='';  
                                    for(var i=0;i<accommodationType.length;i++){  
                                        accommodationTypeHtml+='<div class="custom-checkbox"><input onclick="Show_Hotels(\'filter\')" name="accommodationType" value="'+accommodationType[i].name+'" type="checkbox" id="ac'+i+'"><label for="ac'+i+'">'+accommodationType[i].name+'</label></div>';
                                    }
                                jQuery('.accommodationType').html(accommodationTypeHtml);
                                
                                
                                
                                    var boardName=data.boardName; 
                                    var boardNameHtml='';   
                                    for(var i=0;i<boardName.length;i++){  
                                        boardNameHtml+='<div class="custom-checkbox"><input onclick="Show_Hotels(\'filter\')" name="board" value="'+boardName[i].name+'" type="checkbox" id="b'+i+'"><label for="b'+i+'">'+boardName[i].name+'</label></div>';
                                    }
                                jQuery('.board').html(boardNameHtml);
                                    var amenityArr=data.amenityArr;   
                                    var amenityArrHtml='';   var amenityArrHtml_f='';  
                                    for(var i=0;i<amenityArr.length;i++){  
                                        amenityArrHtml+='<div class="custom-checkbox"><input onclick="Show_Hotels(\'filter\')" name="Cri_amenity" value="'+amenityArr[i].val+'" type="checkbox" id="a'+i+'"><label for="a'+i+'">'+amenityArr[i].val+'</label></div>';
                                        amenityArrHtml_f+='<div class="custom-checkbox"><input onclick="Show_Hotels(\'filter\')" name="Cri_amenity" value="'+amenityArr[i].val+'" type="checkbox" id="a'+i+'_f"><label for="a'+i+'_f">'+amenityArr[i].val+'</label></div>';
                                    }
                                jQuery('.amenity').html(amenityArrHtml);
                                jQuery('.amenity_f').html(amenityArrHtml_f);
                                var maxprice=data.maxrate;  
                                    var minprice=data.minrate;  
                                    var rangeSlider =$('.slider-range2');
                                    var rangeSliderAmount =$('.amount2_1'); 
                                    if ($(rangeSlider).length) {
                                        $(rangeSlider).slider({
                                            range: true,
                                            min: minprice,
                                            max: maxprice,
                                            values: [ minprice, maxprice ],
                                            slide: function( event, ui ) {
                                                $(rangeSliderAmount).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                                            }
                                        });
                                    }
                  $(rangeSliderAmount).val($(rangeSlider).slider( "values", 0 ) + " - " + $(rangeSlider).slider( "values", 1 ) );

                                }
                                });
                    };
                    jQuery("#findbynamefilter").keyup(function(event) {
                        if (event.keyCode === 13) {
                            jQuery("#findbynamebtn").trigger('click');
                        }
                    });
      </script>
@include('site.footer')
