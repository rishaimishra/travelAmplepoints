<style>
.bgc{
	border-radius: 8px 8px 0 0;
    background-color: rgb(40 125 250);
}
</style>
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
         @endphp
 @if($device=='Desktop')        
<section>
    <div style="padding-top: 100px;padding-bottom: 100px;background:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.5)),url({{asset($pageData->image)}});background-size: cover;">
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
            </div>
            <div class="row">
                <div class="col-lg-12">
                	<div class="section-tab text-center pl-4">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item bgc">
                                    <a class="nav-link d-flex align-items-center active" id="hotel-tab" data-toggle="tab" href="#hotel" role="tab" aria-controls="hotel" aria-selected="false">
                                    <i class="la la-bed"></i>&nbsp;&nbsp;Hotels
                                    </a>
                                </li>
                                <li class="nav-item bgc"  >
                                    <a class="nav-link d-flex align-items-center " id="flight-tab" data-toggle="tab" href="#flight" role="tab" aria-controls="flight" aria-selected="true">
                                        <i class="la la-plane"></i>&nbsp;&nbsp;Flights
                                    </a>
                                </li>
                                {{-- <li class="nav-item bgc">
                                    <a class="nav-link d-flex align-items-center" id="tour-tab" data-toggle="tab" href="#tour" role="tab" aria-controls="tour" aria-selected="false">
                                        <i class="la la-camera"></i>&nbsp;&nbsp;Tours
                                    </a>
                                </li>
                                <li class="nav-item bgc">
                                    <a class="nav-link d-flex align-items-center" id="car-tab" data-toggle="tab" href="#car" role="tab" aria-controls="car" aria-selected="true">
                                       <i class="la la-car"></i>&nbsp;&nbsp;Transfers
                                    </a>
                                </li> --}}
                                <li  class="nav-item bgc" style="display:none">
                                    <a class="nav-link d-flex align-items-center" id="package-tab" data-toggle="tab" href="#package" role="tab" aria-controls="package" aria-selected="false">
                                        <span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="icon/bag-white.png" alt="" style="width: 20px;"></span><span class="form-icon an-custom-img-icon" style="margin: 0 10px 0 0;"><img src="icon/bag-blue.png" alt="" style="width: 20px;"></span>Vacation Packages
                                    </a>
                                </li>                                
                            </ul>
                        </div>
                    <div class="search-fields-container">
                        <div class="tab-content" id="myTabContent3">
                        <div class="tab-content search-fields-container" id="myTabContent">
                            @include('hotel.hotel-search-box')
                            @include('flight.flight-search-box')
                           {{--  @include('tours.tours-search-box')
                            @include('transfers.transfers-search-box') --}}
							
                            
                            <!-- end tab-pane -->
                        
						
                            
                         </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
@else

<section class="hero-wrapper hero-wrapper6 Edit_search_sec Edit_search" rel="0" >
     <div>        
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
@endif

<script type="text/javascript">
 	jQuery(document).ready(function(){
	 jQuery("#hotel").show(); 
		jQuery(".common_beard_comb").hide();
	});
</script>

