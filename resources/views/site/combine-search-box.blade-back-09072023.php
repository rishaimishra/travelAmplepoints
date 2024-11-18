<style>
.bgc{
	border-radius: 8px 8px 0 0;
    background-color: rgb(40 125 250);
}
</style>
@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
      
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                $currency=$data['currency'];               
         @endphp
<!-- ================================
    START HERO-WRAPPER AREA
================================= -->
<section class="" >
    <div class="notMobile" style="padding-top: 100px;padding-bottom: 100px;background:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.5)),url({{asset($pageData->image)}});background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero-content pb-5">
                        <div class="section-heading">
                            <h2 class="sec__title cd-headline zoom">
                                Amazing <span class="cd-words-wrapper">
                                <b class="is-visible">Tours</b>
                                <b>Adventures</b>
                                <b>Flights</b>
                                <b>Hotels</b>
                                <b>Cars</b>
                                <b>Cruises</b>
                                <b>Package Deals</b>
                                <b>Fun</b>
                                <b>People</b>
                                </span>
                                Waiting for You
                            </h2>
                        </div>
                    </div><!-- end hero-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="section-tab text-center pl-4">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item bgc">
                                    <a class="nav-link d-flex align-items-center active" id="hotel-tab" data-toggle="tab" href="#hotel" role="tab" aria-controls="hotel" aria-selected="false">
                                    <span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="icon/bed-white.png" alt="" style="width: 20px;"></span>
                                  <span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="icon/bed-blue.png" alt="" style="width: 20px;"></span>Hotels / Stays
                                    </a>
                                </li>
                                <li class="nav-item bgc">
                                    <a class="nav-link d-flex align-items-center " id="flight-tab" data-toggle="tab" href="#flight" role="tab" aria-controls="flight" aria-selected="true">
                                        <span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="icon/flight-white.png" alt="" style="width: 20px;"></span><span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="icon/flight-blue.png" alt="" style="width: 20px;"></span>Flights
                                    </a>
                                </li>
                                <li class="nav-item bgc">
                                    <a class="nav-link d-flex align-items-center" id="tour-tab" data-toggle="tab" href="#tour" role="tab" aria-controls="tour" aria-selected="false">
                                        <span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img  src="icon/globe-white.png" alt="" style="width: 20px;"></span><span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="icon/globe-blue.png" alt="" style="width: 20px;"></span>Tours
                                    </a>
                                </li>
                                <li class="nav-item bgc">
                                    <a class="nav-link d-flex align-items-center" id="car-tab" data-toggle="tab" href="#car" role="tab" aria-controls="car" aria-selected="true">
                                        <span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="icon/car-white.png" alt="" style="width: 20px;"></span><span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="icon/car-blue.png" alt="" style="width: 20px;"></span>Transfers
                                    </a>
                                </li>
                                <li style="display:none" class="nav-item bgc">
                                    <a class="nav-link d-flex align-items-center" id="package-tab" data-toggle="tab" href="#package" role="tab" aria-controls="package" aria-selected="false">
                                        <span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="icon/bag-white.png" alt="" style="width: 20px;"></span><span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="icon/bag-blue.png" alt="" style="width: 20px;"></span>Vacation Packages
                                    </a>
                                </li>
                                
                                <!--<li class="nav-item bgc">
                                    <a class="nav-link d-flex align-items-center" id="cruise-tab" data-toggle="tab" href="#cruise" role="tab" aria-controls="cruise" aria-selected="false">
                                        <span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0; "><img src="icon/cruise-white.png" alt="" style="width: 20px;"></span><span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="icon/cruise-blue.png" alt="" style="width: 20px;"></span>Cruises
                                    </a>
                                </li>-->
                            </ul>
                        </div>
                    <div class="search-fields-container">
                        <div class="tab-content" id="myTabContent3">
                        <!-- end section-tab -->
                        
                        <div class="tab-content search-fields-container" id="myTabContent">
                            @include('hotel.hotel-search-box')
                            @include('flight.flight-search-box')
							@include('tours.tours-search-box')
                            @include('transfers.transfers-search-box')
                            <div  class="tab-pane fade" id="package" role="tabpanel" aria-labelledby="package-tab">
                                <div class="section-tab section-tab-2 pb-3">
                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="flight-hotel-tab" data-toggle="tab" href="#flight-hotel" role="tab" aria-controls="flight-hotel" aria-selected="true">
                                                Flight + Hotel
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="flight-hotel-car-tab" data-toggle="tab" href="#flight-hotel-car" role="tab" aria-controls="flight-hotel-car" aria-selected="false">
                                                Flight + Hotel + Car
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="flight-car-tab" data-toggle="tab" href="#flight-car" role="tab" aria-controls="flight-car" aria-selected="false">
                                                Flight + Car
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="hotel-car-tab" data-toggle="tab" href="#hotel-car" role="tab" aria-controls="hotel-car" aria-selected="true">
                                                Hotel + Car
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="flight-hotel" role="tabpanel" aria-labelledby="flight-hotel-tab">
                                        <div class="contact-form-action">
                                            <form action="#" class="row align-items-center">
                                                <div class="col-lg-3 pr-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Flying from</label>
                                                        <div class="form-group">
                                                            <span class="form-icon an-plane-from an-custom-img-icon">
                                                                <img src="<?php url('') ?>icon/flight-black.png" alt="">
                                                            </span>
                                                            <input class="form-control" type="text" placeholder="City or airport">
                                                        </div>
                                                    </div>
                                                </div><!-- end col-lg-3 -->
                                                <div class="col-lg-3 pr-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Flying to</label>
                                                        <div class="form-group">
                                                            <span class="form-icon an-plane-to an-custom-img-icon">
                                                                <img src="<?php url('') ?>icon/flight-black.png" alt="">
                                                            </span>
                                                            <input class="form-control" type="text" placeholder="City or airport">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 pr-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Departing - Returning</label>
                                                        <div class="form-group">
                                                            <span class="form-icon an-custom-img-icon">
                                                                <img src="<?php url('') ?>icon/calender-black.png" alt="">
                                                            </span>
                                                            <input class="date-picker-multiple form-control" type="text" name="daterange" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="input-box">
                                                        <label class="label-text">Guests</label>
                                                        <div class="form-group">
                                                            <div class="dropdown dropdown-contain gty-container">

                                                                <a class="dropdown-toggle dropdown-btn" href="#" role="button" data-toggle="dropdown" aria-expanded="false">

                                                                    <span class="adult" data-text="Adult" data-text-multi="Adults">0 Adult</span>

                                                                    -

                                                                    <span class="children" data-text="Child" data-text-multi="Children">0 Children</span>

                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-wrap">

                                                                    <div class="dropdown-item">

                                                                        <div class="qty-box d-flex align-items-center justify-content-between">

                                                                            <label>Rooms</label>

                                                                            <div class="qtyBtn d-flex align-items-center">

                                                                                <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                                <input type="text" name="room_number" value="0" class="qty-input">

                                                                                <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                    <div class="dropdown-item">

                                                                        <div class="qty-box d-flex align-items-center justify-content-between">

                                                                            <label>Adults</label>

                                                                            <div class="qtyBtn d-flex align-items-center">

                                                                                <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                                <input type="text" name="adult_number" value="0">

                                                                                <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                    <div class="dropdown-item">

                                                                        <div class="qty-box d-flex align-items-center justify-content-between">

                                                                            <label>Children</label>

                                                                            <div class="qtyBtn d-flex align-items-center">

                                                                                <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                                <input type="text" name="child_number" value="0">

                                                                                <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div><!-- end dropdown -->

                                                        </div>

                                                    </div>

                                                </div><!-- end col-lg-3 -->

                                            </form>

                                        </div>

                                        <div class="checkmark-wrap">

                                            <div class="custom-checkbox d-inline-block mb-0 mr-3">

                                                <input type="checkbox" id="directFlightChb">

                                                <label for="directFlightChb">Direct flights only</label>

                                            </div>

                                            <div class="custom-checkbox d-inline-block mb-0">

                                                <input type="checkbox" id="onlyHotelChb">

                                                <label for="onlyHotelChb">I only need a hotel for part of my stay</label>

                                            </div>

                                        </div><!-- end checkmark-wrap -->

                                        <div class="btn-box pt-3">

                                            <a href="activity-search-result.html" class="theme-btn">Search Now</a>

                                        </div>

                                    </div><!-- end tab-pane -->

                                    <div class="tab-pane fade" id="flight-hotel-car" role="tabpanel" aria-labelledby="flight-hotel-car-tab">

                                        <div class="contact-form-action">

                                            <form action="#" class="row align-items-center">

                                                <div class="col-lg-3 pr-0">

                                                    <div class="input-box">

                                                        <label class="label-text">Flying from</label>

                                                        <div class="form-group">

                                                            <span class="form-icon an-plane-from an-custom-img-icon">

                                                                <img src="<?php url('') ?>icon/flight-black.png" alt="">

                                                            </span>

                                                            <input type="text" class="form-control" placeholder="City or airport">

                                                        </div>

                                                    </div>

                                                </div><!-- end col-lg-3 -->

                                                <div class="col-lg-3 pr-0">

                                                    <div class="input-box">

                                                        <label class="label-text">Flying to</label>

                                                        <div class="form-group">

                                                            <span class="form-icon an-plane-to an-custom-img-icon">

                                                                <img src="<?php url('') ?>icon/flight-black.png" alt="">

                                                            </span>

                                                            <input class="form-control" type="text" placeholder="City or airport">

                                                        </div>

                                                    </div>

                                                </div><!-- end col-lg-3 -->

                                                <div class="col-lg-3 pr-0">

                                                    <div class="input-box">

                                                        <label class="label-text">Departing - Returning</label>

                                                        <div class="form-group">

                                                            <span class="form-icon an-custom-img-icon">

                                                                <img src="<?php url('') ?>icon/calender-black.png" alt="">

                                                            </span>

                                                            <input class="date-picker-multiple form-control" type="text" name="daterange" readonly>

                                                        </div>

                                                    </div>

                                                </div><!-- end col-lg-3 -->

                                                <div class="col-lg-3">

                                                    <div class="input-box">

                                                        <label class="label-text">Guests</label>

                                                        <div class="form-group">

                                                            <div class="dropdown dropdown-contain gty-container">

                                                                <a class="dropdown-toggle dropdown-btn" href="#" role="button" data-toggle="dropdown" aria-expanded="false">

                                                                    <span class="adult" data-text="Adult" data-text-multi="Adults">0 Adult</span>

                                                                    -

                                                                    <span class="children" data-text="Child" data-text-multi="Children">0 Children</span>

                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-wrap">

                                                                    <div class="dropdown-item">

                                                                        <div class="qty-box d-flex align-items-center justify-content-between">

                                                                            <label>Rooms</label>

                                                                            <div class="qtyBtn d-flex align-items-center">

                                                                                <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                                <input type="text" name="room_number" value="0" class="qty-input">

                                                                                <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                    <div class="dropdown-item">

                                                                        <div class="qty-box d-flex align-items-center justify-content-between">

                                                                            <label>Adults</label>

                                                                            <div class="qtyBtn d-flex align-items-center">

                                                                                <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                                <input type="text" name="adult_number" value="0">

                                                                                <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                    <div class="dropdown-item">

                                                                        <div class="qty-box d-flex align-items-center justify-content-between">

                                                                            <label>Children</label>

                                                                            <div class="qtyBtn d-flex align-items-center">

                                                                                <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                                <input type="text" name="child_number" value="0">

                                                                                <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div><!-- end dropdown -->

                                                        </div>

                                                    </div>

                                                </div><!-- end col-lg-3 -->

                                            </form>

                                        </div>

                                        <div class="checkmark-wrap">

                                            <div class="custom-checkbox d-inline-block mb-0 mr-3">

                                                <input type="checkbox" id="directFlightChb2">

                                                <label for="directFlightChb2">Direct flights only</label>

                                            </div>

                                            <div class="custom-checkbox d-inline-block mb-0">

                                                <input type="checkbox" id="onlyHotelChb2">

                                                <label for="onlyHotelChb2">I only need a hotel for part of my stay</label>

                                            </div>

                                        </div><!-- end checkmark-wrap -->

                                        <div class="btn-box pt-3">

                                            <a href="activity-search-result.html" class="theme-btn">Search Now</a>

                                        </div>

                                    </div><!-- end tab-pane -->

                                    <div class="tab-pane fade" id="flight-car" role="tabpanel" aria-labelledby="flight-car-tab">

                                        <div class="contact-form-action">

                                            <form action="#" class="row align-items-center">

                                                <div class="col-lg-3 pr-0">

                                                    <div class="input-box">

                                                        <label class="label-text">Flying from</label>

                                                        <div class="form-group">

                                                            <span class="form-icon an-plane-from an-custom-img-icon">

                                                                <img src="<?php url('') ?>icon/flight-black.png" alt="">

                                                            </span>

                                                            <input class="form-control" type="text" placeholder="City or airport">

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-lg-3 pr-0">

                                                    <div class="input-box">

                                                        <label class="label-text">Flying to</label>

                                                        <div class="form-group">

                                                            <span class="form-icon an-plane-to an-custom-img-icon">

                                                                <img src="<?php url('') ?>icon/flight-black.png" alt="">

                                                            </span>

                                                            <input class="form-control" type="text" placeholder="City or airport">

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-lg-3 pr-0">

                                                    <div class="input-box">

                                                        <label class="label-text">Departing - Returning</label>

                                                        <div class="form-group">

                                                            <span class="form-icon an-custom-img-icon">

                                                                <img src="<?php url('') ?>icon/calender-black.png" alt="">

                                                            </span>

                                                            <input class="date-picker-multiple form-control" type="text" name="daterange" readonly>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-lg-3">

                                                    <div class="input-box">

                                                        <label class="label-text">Passengers</label>

                                                        <div class="form-group">

                                                            <div class="dropdown dropdown-contain gty-container">

                                                                <a class="dropdown-toggle dropdown-btn" href="#" role="button" data-toggle="dropdown" aria-expanded="false">

                                                                    <span class="adult" data-text="Adult" data-text-multi="Adults">0 Adult</span>

                                                                    -

                                                                    <span class="children" data-text="Child" data-text-multi="Children">0 Children</span>

                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-wrap">

                                                                    <div class="dropdown-item">

                                                                        <div class="qty-box d-flex align-items-center justify-content-between">

                                                                            <label>Adults</label>

                                                                            <div class="qtyBtn d-flex align-items-center">

                                                                                <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                                <input type="text" name="adult_number" value="0">

                                                                                <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                    <div class="dropdown-item">

                                                                        <div class="qty-box d-flex align-items-center justify-content-between">

                                                                            <label>Children</label>

                                                                            <div class="qtyBtn d-flex align-items-center">

                                                                                <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                                <input type="text" name="child_number" value="0">

                                                                                <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                    <div class="dropdown-item">

                                                                        <div class="qty-box d-flex align-items-center justify-content-between">

                                                                            <label>Infants</label>

                                                                            <div class="qtyBtn d-flex align-items-center">

                                                                                <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                                <input type="text" name="infants_number" value="0" class="qty-input">

                                                                                <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div><!-- end dropdown -->

                                                        </div>

                                                    </div>

                                                </div>

                                            </form><!-- end row -->

                                        </div>

                                        <div class="checkmark-wrap">

                                            <div class="custom-checkbox d-inline-block mb-0">

                                                <input type="checkbox" id="directFlightChb3">

                                                <label for="directFlightChb3">Direct flights only</label>

                                            </div>

                                        </div><!-- end checkmark-wrap -->

                                        <div class="btn-box pt-3">

                                            <a href="activity-search-result.html" class="theme-btn">Search Now</a>

                                        </div>

                                    </div><!-- end tab-pane -->

                                    <div class="tab-pane fade" id="hotel-car" role="tabpanel" aria-labelledby="hotel-car-tab">

                                        <div class="contact-form-action">

                                            <form action="#" class="row align-items-center">

                                                <div class="col-lg-3 pr-0">

                                                    <div class="input-box">

                                                        <label class="label-text">Going to</label>

                                                        <div class="form-group">

                                                            <span class="la la-map-marker form-icon"></span>

                                                            <input class="form-control" type="text" placeholder="Enter City or property">

                                                        </div>

                                                    </div>

                                                </div><!-- end col-lg-3 -->

                                                <div class="col-lg-3 pr-0">

                                                    <div class="input-box">

                                                        <label class="label-text">Check in - Check-out</label>

                                                        <div class="form-group">

                                                            <span class="la la-calendar form-icon"></span>

                                                            <input class="date-picker-multiple form-control" type="text" name="daterange" readonly>

                                                        </div>

                                                    </div>

                                                </div><!-- end col-lg-3 -->

                                                <div class="col-lg-3 pr-0">

                                                    <div class="input-box">

                                                        <label class="label-text">Room Type</label>

                                                        <div class="form-group">

                                                            <div class="select-contain w-auto">

                                                                <select class="select-contain-select">

                                                                    <option value="0">Select Type</option>

                                                                    <option value="1">Single</option>

                                                                    <option value="2">Double</option>

                                                                    <option value="3">Triple</option>

                                                                    <option value="4">Quad</option>

                                                                    <option value="5">Queen</option>

                                                                    <option value="6">King</option>

                                                                    <option value="7">Twin</option>

                                                                    <option value="8">Double-double</option>

                                                                    <option value="9">Studio</option>

                                                                    <option value="10">Suite</option>

                                                                    <option value="11">Mini Suite</option>

                                                                    <option value="12">President Suite</option>

                                                                    <option value="13">President Suite</option>

                                                                    <option value="14">Apartments</option>

                                                                    <option value="15">Connecting rooms</option>

                                                                    <option value="16">Murphy Room</option>

                                                                    <option value="17">Accessible Room</option>

                                                                    <option value="18">Cabana</option>

                                                                    <option value="19">Adjoining rooms</option>

                                                                    <option value="20">Adjacent rooms</option>

                                                                    <option value="21">Villa</option>

                                                                    <option value="22">Executive Floor</option>

                                                                    <option value="23">Smoking room</option>

                                                                    <option value="24">Non-Smoking Room</option>

                                                                </select>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div><!-- end col-lg-3 -->

                                                <div class="col-lg-3">

                                                    <div class="input-box">

                                                        <label class="label-text">Guests</label>

                                                        <div class="form-group">

                                                            <div class="dropdown dropdown-contain gty-container">

                                                                <a class="dropdown-toggle dropdown-btn" href="#" role="button" data-toggle="dropdown" aria-expanded="false">

                                                                    <span class="adult" data-text="Adult" data-text-multi="Adults">0 Adult</span>

                                                                    -

                                                                    <span class="children" data-text="Child" data-text-multi="Children">0 Children</span>

                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-wrap">

                                                                    <div class="dropdown-item">

                                                                        <div class="qty-box d-flex align-items-center justify-content-between">

                                                                            <label>Rooms</label>

                                                                            <div class="qtyBtn d-flex align-items-center">

                                                                                <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                                <input type="text" name="room_number" value="0" class="qty-input">

                                                                                <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                    <div class="dropdown-item">

                                                                        <div class="qty-box d-flex align-items-center justify-content-between">

                                                                            <label>Adults</label>

                                                                            <div class="qtyBtn d-flex align-items-center">

                                                                                <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                                <input type="text" name="adult_number" value="0">

                                                                                <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                    <div class="dropdown-item">

                                                                        <div class="qty-box d-flex align-items-center justify-content-between">

                                                                            <label>Children</label>

                                                                            <div class="qtyBtn d-flex align-items-center">

                                                                                <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                                <input type="text" name="child_number" value="0">

                                                                                <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div><!-- end dropdown -->

                                                        </div>

                                                    </div>

                                                </div><!-- end col-lg-3 -->

                                            </form>

                                        </div>

                                        <div class="btn-box pt-2">

                                            <a href="activity-search-result.html" class="theme-btn">Search Now</a>

                                        </div>

                                    </div><!-- end tab-pane -->

                                </div>

                            </div><!-- end tab-pane -->
                            <?php /*?><div class="tab-pane fade" id="cruise" role="tabpanel" aria-labelledby="cruise-tab">

                                <div class="contact-form-action">

                                    <form action="#" class="row align-items-center">

                                        <div class="col-lg-3 pr-0">

                                            <div class="input-box">

                                                <label class="label-text">Going to</label>

                                                <div class="form-group">

                                                    <div class="select-contain w-auto">

                                                        <select class="select-contain-select">

                                                            <option value="">Select destination</option>

                                                            <optgroup label="Most Popular">

                                                                <option value="caribbean">Caribbean</option>

                                                                <option value="bahamas">Bahamas</option>

                                                                <option value="mexico">Mexico</option>

                                                                <option value="alaska">Alaska</option>

                                                                <option value="europe">Europe</option>

                                                                <option value="bermuda">Bermuda</option>

    

                                                                <option value="hawaii">Hawaii</option>

                                                                <option value="nepal">Nepal</option>

                                                                <option value="italy">Italy</option>

                                                                <option value="canada-new-england">Canada / New England</option>

                                                            </optgroup>

                                                            <optgroup label="Other Destinations">

                                                                <option value="arctic-antarctic">Arctic / Antarctic</option>

                                                                <option value="middle-east">Middle East</option>

                                                                <option value="africa">Africa</option>

                                                                <option value="panama-canal">Panama Canal</option>

                                                                <option value="asia">Asia</option>

                                                                <option value="pacific-coastal">Pacific Coastal</option>

                                                                <option value="australia-new-zealand">Australia / New Zealand</option>

                                                                <option value="central-america">Central America</option>

                                                                <option value="galapagos">Galapagos</option>

                                                                <option value="getaway-at-sea">Getaway at Sea</option>

                                                                <option value="transatlantic">Transatlantic</option>

                                                                <option value="world-cruise">World</option>

                                                                <option value="south-america">South America</option>

                                                                <option value="south-pacific">South Pacific</option>

                                                                <option value="transpacific">Transpacific</option>

                                                            </optgroup>

                                                        </select>

                                                    </div>

                                                </div>

                                            </div>

                                        </div><!-- end col-lg-3 -->

                                        <div class="col-lg-3 pr-0">

                                            <div class="input-box">

                                                <label class="label-text">Departs as early as</label>

                                                <div class="form-group">

                                                    <span class="form-icon an-custom-img-icon">

                                                        <img src="<?php url('') ?>icon/calender-black.png" alt="">

                                                    </span>

                                                    <input class="date-picker-single form-control" type="text" name="daterange-single" readonly>

                                                </div>

                                            </div>

                                        </div><!-- end col-lg-3 -->

                                        <div class="col-lg-3 pr-0">

                                            <div class="input-box">

                                                <label class="label-text">Departs as late as</label>

                                                <div class="form-group">

                                                    <span class="form-icon an-custom-img-icon">

                                                        <img src="<?php url('') ?>icon/calender-black.png" alt="">

                                                    </span>

                                                    <input class="date-picker-single form-control" type="text" name="daterange-single" readonly>

                                                </div>

                                            </div>

                                        </div><!-- end col-lg-3 -->

                                        <div class="col-lg-3">

                                            <div class="input-box">

                                                <label class="label-text">Travelers in the cabin</label>

                                                <div class="form-group">

                                                    <div class="dropdown dropdown-contain gty-container">

                                                        <a class="dropdown-toggle dropdown-btn" href="#" role="button" data-toggle="dropdown" aria-expanded="false">

                                                            <span class="adult" data-text="Adult" data-text-multi="Adults">0 Adult</span>

                                                            -

                                                            <span class="children" data-text="Child" data-text-multi="Children">0 Children</span>

                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-wrap">

                                                            <div class="dropdown-item">

                                                                <div class="qty-box d-flex align-items-center justify-content-between">

                                                                    <label>Adults</label>

                                                                    <div class="qtyBtn d-flex align-items-center">

                                                                        <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                        <input type="text" name="adult_number" value="0">

                                                                        <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="dropdown-item">

                                                                <div class="qty-box d-flex align-items-center justify-content-between">

                                                                    <label>Children</label>

                                                                    <div class="qtyBtn d-flex align-items-center">

                                                                        <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                        <input type="text" name="child_number" value="0">

                                                                        <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="dropdown-item">

                                                                <div class="qty-box d-flex align-items-center justify-content-between">

                                                                    <label>Infants</label>

                                                                    <div class="qtyBtn d-flex align-items-center">

                                                                        <div class="qtyDec"><i class="la la-minus"></i></div>

                                                                        <input type="text" name="infants_number" value="0" class="qty-input">

                                                                        <div class="qtyInc"><i class="la la-plus"></i></div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div><!-- end dropdown -->

                                                </div>

                                            </div>

                                        </div><!-- end col-lg-3 -->

                                    </form>

                                </div>

                                <div class="btn-box">

                                    <a href="cruise-search-result.html" class="theme-btn">Search Now</a>

                                </div>

                            </div><?php */?><!-- end tab-pane -->
                            <!-- end tab-pane -->
                        </div>
                        </div>
                    </div><!-- end main-search-input -->
                </div>
            </div><!-- end row -->

        </div><!-- end container -->

        <!--<svg class="hero-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
            <path d="M761.9,40.6L643.1,24L333.9,93.8L0.1,1H0v99h1000V1"></path>
        </svg>-->
    </div>
    
       <div class="container mobile">
            <!-- end row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="search-fields-container mt-4" style="box-shadow: 2px 2px 20px #dfdfdf;">
                        <div class="tab-content" id="myTabContent3">
                         @include('flight.flight-search-box')
                         <!-- end tab-pane -->
                        </div>
                    </div><!-- end main-search-input -->
                </div>
            </div><!-- end row -->
        </div>
    
</section>
</section><!-- end hero-wrapper -->

<!-- ================================
    END HERO-WRAPPER AREA
================================= -->

     <script type="text/javascript">
		  jQuery(document).ready(function(){
			jQuery(".common_beard_comb").hide();
		  });
	  </script>

