@include('site.header')



<?php // $contentArr=json_decode($hotelData->content,true);
//die;
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

<style>
  .my-row {
    display: flex;
    flex-wrap: wrap;
    /* margin: 0 -10px; */
  }

  .my-col {
    width: 33.33%;
    padding: 10px 10px;
    margin: 0 0 20px 0px;
        border: 1px solid #f75b10;
    border-radius: 12px;
    box-shadow: -4px 5px 6px #ed9b73;
  }
  @media only screen and (max-width: 800px) {
    .my-col {
      width: 50%;
    }
  }
  @media only screen and (max-width: 600px) {
    .my-col {
      width: 100%;
    }
  }
</style>



<style>
    .bread-bg-7 {
    height: 681px !important;
}
</style>

  <style>
        .loader-htl {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            margin: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        #loader-container-htl {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
        }
        .bread-bg-7 {
             background-image: inherit !important; 
        }


        .custom-container-ld {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: white; /* Solid white background */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Ensures it appears above all other content */
}

.custom-loader-ld {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

    </style>



    <!-- new banner CSS -->
<style>
  .banner-new-c {
    height: auto !important;
    position: relative;
    cursor: pointer;
    overflow: hidden;
  }
  .banner-new-c div {
    padding: 0;
    margin: 0;
  }
  .banner-new-c .c-688 {
  }
  .banner-new-c img {
    width: 100%;
    transform: scale(1);
    transition: all 0.3s;
  }
  .banner-new-c img:hover {
    transform: scale(1.05);
  }
  .banner-new-c .col-b-1,
  .banner-new-c .col-b-2,
  .banner-new-c .col-b-3,
  .banner-new-c .col-b-4 {
    border: 2px solid #fff;
    overflow: hidden;
  }
  .banner-new-c .col-b-1 {
    border-width: 0 2px 2px 2px;
  }
  .banner-new-c .col-b-2 {
    border-width: 0 0 2px 0px;
  }
  .banner-new-c .col-b-3 {
    border-width: 0 2px 2px 2px;
  }
  .banner-new-c .col-b-4 {
    border-width: 0 0 0 0;
  }

  .badge-img-info {
    position: absolute;
    top: auto;
    left: 20px;
    bottom: 20px;
    z-index: 9;
    background: #00000096;
    color: #dedede;
    border-radius: 40px;
    padding: 5px 15px !important;
    display: block;
  }
  .badge-img-info svg {
    margin: 0 5px 0 0;
  }
  .badge-img-info span {
  }
  .modal-backdrop.fade.show {
    z-index: 99999;
  }
  #imgGroupModal {
    z-index: 9999999999999999999;
  }
  #imgGroupModal .modal-body {
    max-height: 80vh;
    overflow: auto;
  }
  #imgGroupModal .modal-body img {
    width: 100%;
  }
  #imgGroupModal .modal-body .col-6 {
    margin: 0;
    padding: 5px;
  }
  #imgGroupModal .modal-body span {
    font-size: 14px;
    color: #222;
  }
  
  .row.c-688 .img-fluid,#imgGroupModal .img-fluid{height:100%;object-fit:cover;}
  @media screen and (max-width: 600px) {
    .c-d-sm-none {
      display: none !important;
    }
  }
  
  
:root{--banner-h-card:250px}@media only screen and (max-width:1100px){:root{--banner-h-card:200px}}@media only screen and (max-width:1000px){:root{--banner-h-card:190px}}@media only screen and (max-width:900px){:root{--banner-h-card:180px}}@media only screen and (max-width:800px){:root{--banner-h-card:170px}}@media only screen and (max-width:700px){:root{--banner-h-card:160px}}@media only screen and (max-width:600px){:root{--banner-h-card:150px}}@media only screen and (max-width:500px){:root{--banner-h-card:200px}}.col-6.c-d-sm-none img{height:var(--banner-h-card)!important;;}.row.c-688>div:not(.c-d-sm-none) img{height:calc(var(--banner-h-card) * 2);}.breadcrumb-area::before{background:#fff;background:transparent;}

</style>




@php
 // dd(explode(",",$hotelSearchData->Cri_Adults));
@endphp

  @php
    use App\Helpers\ImageHelper;

    $originalImageUrl = isset($images[0]) ? $images[0] : '';
    $fallbackImageUrl = str_replace('/xxl', '', $originalImageUrl);

    $backgroundImageUrl = '';

    if (ImageHelper::isValidImageUrl($originalImageUrl)) {
        $backgroundImageUrl = $originalImageUrl;
    } elseif (ImageHelper::isValidImageUrl($fallbackImageUrl)) {
        $backgroundImageUrl = $fallbackImageUrl;
    }

@endphp

 <div id="loader-container-htl">
        <div class="loader-htl"></div>
    </div>

 <div class="custom-container-ld" id="cc">
    <div class="custom-loader-ld"></div>
  </div>




{{-- old banner start --}}
<section class="breadcrumb-area bread-bg-7 py-0" style="display:none">
    <div class="video-bg" id="htl-img" style="background:url('{{ $backgroundImageUrl }}'); background-size: cover; display: none;">
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
                            <a class="theme-btn" data-src="<?php if(isset($images[0])){ echo  $backgroundImageUrl; }//$images[0]; } ?>"
                               data-fancybox="hotel-single-main-gallery"
                               data-caption="Showing image - 01"
                               data-speed="700">
                                <i class="la la-photo mr-2"></i>More Photos
                            </a>
                        </div>
                        <?php for($i=1;$i<count($images);$i++){ ?>

                        <a class="d-none"
                             data-fancybox="hotel-single-main-gallery"
                             data-src="<?php echo $images[$i]  ?>"
                             data-caption="Showing image - <?php if($i<9){ echo "0"; } echo $i+1; ?>"
                             data-speed="700"></a>
                        <?php } ?>
                    </div><!-- end breadcrumb-btn -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end breadcrumb-wrap -->
</section><!-- end breadcrumb-area -->
{{-- old banner end --}}








{{-- new banner start --}}
<!-- new banner HTML -->
<section class="breadcrumb-area bread-bg-7 py-0 banner-new-c" data-toggle="modal" data-target="#imgGroupModal">
  <div class="row c-688">
    <div class="col-md-6 col-12"><img class="img-fluid" @if(isset($images[0])) src="{{$backgroundImageUrl}}" @else src="http://photos.hotelbeds.com/giata/48/489320/489320a_hb_a_050.jpg" @endif alt="" /></div>
    <div class="col-6 c-d-sm-none">
      <div class="row">
        {{-- <div class="col-md-6 col-b-1"><img class="img-fluid" @if(isset($images[1])) src="{{$images[1]}}" @else src="http://photos.hotelbeds.com/giata/48/489320/489320a_hb_w_009.jpg" @endif alt="" /></div> --}}
        <div class="col-md-6 col-b-2"><img class="img-fluid" @if(isset($images[2])) src="{{$images[2]}}" @else src="http://photos.hotelbeds.com/giata/48/489320/489320a_hb_a_051.jpg" @endif alt="" /></div>
        <div class="col-md-6 col-b-3"><img class="img-fluid" @if(isset($images[3])) src="{{$images[3]}}" @else src="http://photos.hotelbeds.com/giata/48/489320/489320a_hb_w_008.jpg" @endif alt="" /></div>
        <div class="col-md-6 col-b-4"><img class="img-fluid" @if(isset($images[4])) src="{{$images[4]}}" @else src="http://photos.hotelbeds.com/giata/48/489320/489320a_hb_a_052.jpg" @endif alt="" /></div>
        <div class="col-md-6 col-b-1"><img class="img-fluid" @if(isset($images[5])) src="{{$images[5]}}" @else src="http://photos.hotelbeds.com/giata/48/489320/489320a_hb_w_009.jpg" @endif alt="" /></div>
      </div>
    </div>
  </div>
  <div class="badge-img-info">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
      <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
      <path
        d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"
      />
    </svg>
    <span>{{count($images)}}+</span>
  </div>
</section>




<!-- new banner HTML MODAL-->
<div class="modal fade" id="imgGroupModal" tabindex="-1" role="dialog" aria-labelledby="imgGroupModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imgGroupModalTitle">{{ $hotelSearchData->Name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
         @for($i=1;$i<count($images);$i++)
          <div class="col-6">
            <img src="{{$images[$i]}}" class="img-fluid" />
          </div>
          @endfor         
          
        </div>
      </div>
    </div>
  </div>
</div>


{{-- end of banner img --}}







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
                                @if(count($phones)>0)
                                 <p class="mr-2 hotel_full_address">Mobile Numbers

                                        @foreach($phones as $ph)
                                        <span>{{$ph->phoneNumber}}</span>
                                        @endforeach
                                    </p> 
                                    @endif
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
                           
                            @if(@Auth::user()->id && @Auth::user()->user_type!="admin")
                             <h4>Total Room selected <span id="tm">0</span> </h4>
                             <br><button class="btn btn-warning" onclick="roomsee()">See Rooms</button>
                              <button style="display:none" id="bn" class="btn btn-primary bn" onclick="roomBook()">Book Now</button>
                             @endif

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
                                                    <h3 class="title font-size-15 font-weight-medium">{{$PropertyAmenity[$i]['amenity']}} @if($PropertyAmenity[$i]['amount'])  (${{$PropertyAmenity[$i]['amount']}})@endif</h3>
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
                <div class="col-lg-4" id="sidepanel" style="display:none">
                    <div class="sidebar single-content-sidebar mb-0">
                        <div class="sidebar-widget single-content-widget">
                            <div class="sidebar-widget-item">
                                <div class="sidebar-book-title-wrap mb-3">
                                    <h3>Popular</h3>
                                    <p><span class="text-form">From</span><span class="text-value ml-2 mr-1"><?php echo $currency_symbol." ".($hotelSearchData->lowRate*2) ?></span>  
                                     {{--   ( <span style="text-decoration: line-through;" class="text-value ml-2 mr-1"> <?php echo $currency_symbol." ".($hotelSearchData->lowRate)*2; ?> </span> )  --}}</p>
                                       
                                       @php
                                       $admin_model_obj = new \App\Models\CommonFunctionModel;
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
                                                <input class=" form-control" type="text" name="checkin" value="{{ \Carbon\Carbon::parse($hotelSearchData->checkin)->format('m-d-Y') }}" readonly>
                                            </div>
                                        </div>
                                        {{-- <?php echo $hotelSearchData->checkout; ?> --}}
                                        <div class="input-box">
                                            <label class="label-text"> Check out</label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon"></span>
                                                <input class=" form-control" type="text" name="checkout"  value="{{ \Carbon\Carbon::parse($hotelSearchData->checkout)->format('m-d-Y') }}" readonly>
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
                            $AdultsArr = explode(',', $AdultsArr);
                            //echo $AdultsArr[1];

                            $ChildsArr=json_decode($hotelSearchData->Cri_Childs,true);
                            $ChildsArr=explode(',', $ChildsArr);
                            //echo $ChildsArr;
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
                                        <input class=" form-control" type="text" name="Cri_Adults"  value="Child {{$c+1}} Age : <?php echo $ChildAgeArr[$i][$c]; ?>" readonly>  </div></div>
                                        <?php } ?>
                            </div><!-- end sidebar-widget-item -->
                            <?php } ?>
                        </div><!-- end sidebar-widget -->
                       
                    </div><!-- end sidebar -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->








<style>
  .bg-success {
    background-color: #28a745 !important; /* Green background color */
    color: #fff; /* White text color */
  }
</style>





<!-- Toast HTML -->
<!-- Toast HTML -->
<div id="successToast" class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000" style="position: absolute; z-index: 1055;">
  <div class="toast-header">
    <strong class="mr-auto">Success</strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    Room successfully added!
  </div>
</div>



        <!-- Modal HTML -->
<div id="roomsModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Selected Rooms</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Room No</th>
              <th>Board</th>
              <th>Rate Class</th>
              <th>Price</th>
              {{-- <th>Rate Key</th>
              <th>Hotel ID</th> --}}
            </tr>
          </thead>
          <tbody id="roomsTableBody">
            <!-- Dynamic rows will be added here -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button style="display:none" id="bn" class="btn btn-primary bn" onclick="roomBook()">Book Now</button>
      </div>
    </div>
  </div>
</div>




<form id="arrayForm" method="get" action="{{route('hotel.booking.new')}}" style="display: none;">
    @csrf
        <div class="form-group">
            <label for="arrayInput">Enter array values (comma-separated):</label>
            <input type="text" class="form-control" id="arrayInput" name="arryinput" placeholder="e.g. 1,2,3,4">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>















    </div><!-- end single-content-box -->
</section><!-- end tour-detail-area -->
<!-- ================================
    END TOUR DETAIL AREA
================================= -->

      

      <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imgDiv = document.getElementById('htl-img');
            const loaderContainer = document.getElementById('loader-container-htl');


            // After 3 seconds, hide loader and show image
            setTimeout(function () {
                loaderContainer.style.display = 'none';
                imgDiv.style.display = 'block';
            }, 3000);
        });
    </script>



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
                                    rooms: "<?php echo 1; ?>",
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

                                    // console.log(response.responseData.RoomTypes.RoomGroup)
                                    
                                    /*=== RoomList ====*/
                                    var htmlRoomlist=''; 
                                    if(countRoomCombination<1){  htmlRoomlist +='No Room Available';  }
                                    htmlRoomlist+='<div class="cabin-type padding-top-30px"><div class="cabin-type-item seat-selection-item d-flex"><div class="my-row" style="border: 1px solid rgba(128, 137, 150, 0.2);">';

                                    // console.log("p1"+countRoomCombination)

                                    for(var i=0;i<countRoomCombination;i++){
                                      var boardArr = Object.keys(RoomGroup[i].name);
                                      // console.log(boardArr)
                                      for(var j=0;j<boardArr.length;j++){
                                      
                                      //cabin-type-detail
                                      var tax="0";
                                        var board =boardArr[j];
                                        if(board=="BB"){
                                            tax=RoomGroup[i]?.rates?.BB.NOR[0]?.rates?.taxes?.taxes[0]?.amount;

                                        }else if(board=="HB"){
                                            tax=RoomGroup[i].rates?.HB?.NOR[0]?.rates?.taxes?.taxes[0]?.amount;
                                        }else{
                                           tax = RoomGroup[i].rates?.[board]?.NOR[0]?.rates?.taxes?.taxes[0]?.amount || 0;
                                        }

                                        var offersPresent = RoomGroup[i]?.rates?.[board]?.NOR[0]?.rates?.hasOwnProperty('offers');
                                        if(offersPresent){
                                            var offerName=RoomGroup[i].rates?.[board]?.NOR[0]?.rates?.offers[0]?.name || "";
                                            var offerRate= RoomGroup[i].rates?.[board]?.NOR[0]?.rates?.offers[0]?.amount || "";
                                            var offerString = "Offer: "+offerName + " (" + offerRate + ") ";
                                       }else{
                                         var offerString = "";
                                       }



                                       var childAge=RoomGroup[i]?.rates?.[board]?.NOR[0]?.rates?.hasOwnProperty('childrenAges');
                                        var chldAge="";
                                       if(childAge){
                                         chldAge="Children age "+RoomGroup[i]?.rates?.[board]?.NOR[0]?.rates?.childrenAges;

                                       }else{
                                          chldAge="";
                                       }

                                       // console.log(chldAge)

                                        // console.log(offerName,offerRate,offerString);

                                        // console.log(tax)
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
                                         var roomCombineName =  CountRoomName(nameA);
                                    htmlRoomlist+=' <div class="my-col"><h3 class="title" style="background-color:rgba(128, 137, 150, 0.2); padding:5px 15px;height: 52px;">'+roomCombineName+'</h3>';
                                    // console.log(nameA,roomCombineName)   
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
                                         var CPArr =ratesA[l].rates?.cancellationPolicies;
                                         // console.log(ratesA[l].rates)
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
                                        else if(CPArr?.length>0){
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
                     // console.log(board)
                     var hid={{$hotelSearchData->id}};
                    htmlRoomlist+='<div class="row" style="margin:0; border-top: 1px solid rgba(128, 137, 150, 0.2); margin-bottom: 5px;"><div class="col-12 responsive-column">'+boardName+'('+board+')</div><div class="col-12 responsive-column">'+cancellationLebel+'<br> Exclude tax:'+tax+'</div><div class="col-12 responsive-column"style="color:RED"> '+leastAllotment+' Room(s) Left</div><div class="col-12 responsive-column"><p class="text-uppercase font-size-14">Per/night<strong class="mt-n1 text-black font-size-18 font-weight-black d-block"><?php echo $currency_symbol; ?> '+parseInt(roomPrice)*2+'</strong> <span style="text-decoration: line-through; display:none"><?php echo $currency_symbol; ?>  '+2*roomPrice+'</span></p></div><div class="col-12 responsive-column cabin-price"><div class="custom-checkbox mb-0"><input style="display:none" type="radio" name="akm" id="selectChb'+i+''+j+'"><!--<label for="selectChb'+i+''+j+'" class="theme-btn theme-btn-small">Select</label>-->@if(@Auth::user()->id && @Auth::user()->user_type!="admin")<button onclick="arrayInsetFun(\'' + board + '\',\'' + rateClass + '\', \'' + roomCodeIds + '\',\'' + rateKeyIds + '\',\'' + hid + '\',\'' + roomCombineName + '\',\'' + boardName + '\',\'' + roomPrice + '\',event)" class="theme-btn theme-btn-small" style="width:100px; text-align:center; padding:0;">Add</button>@elseif(@Auth::user()->id && @Auth::user()->user_type=="admin") @else <a href="{{ asset("login") }}" class="theme-btn theme-btn-small" style="width:100px; text-align:center; padding:0;">Login To Book</a> @endif</div></div></div>';
                                        if (j == boardArr.length - 1) {
            htmlRoomlist += `</div>`
        }
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
                              result+= current+'+ ';    
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
                              result+= current+'+ ';    
                              }
                    }  
                    return result.slice(0,-2);
            }









var arr = [];
var rooms = {{ $hotelSearchData->rooms }};

function arrayInsetFun(board, rateClass, roomCodeIds, rateKeyIds, hotelid,roomCombineName,boardName,roomPrice,event) {
    // console.log(board, rateClass, roomCodeIds, rateKeyIds, hotelid,roomCombineName,roomPrice);
    if (arr.length < rooms) {
        var obj = {
            'board': board,
            'rateClass': rateClass,
            'roomCodeIds': roomCodeIds,
            'rateKeyIds': rateKeyIds,
            'hotelid': hotelid,
            'roomCombineName': roomCombineName,
            'boardName':boardName,
            'roomPrice':roomPrice
        };
        arr.push(obj);
        updateModalContent();
        showToast(event);
        $("#tm").html(arr.length)
        var jsonString = JSON.stringify(arr);
        $('#arrayInput').val(jsonString);
    } else {
        alert("You can not add more rooms than what you have requested");
        return false;
    }
    console.log(arr);
}




function updateModalContent() {
    var tbody = document.getElementById('roomsTableBody');
    tbody.innerHTML = ''; // Clear existing rows

    arr.forEach(function(item, index) {
        var row = document.createElement('tr');

          var boardCell = document.createElement('td');
        boardCell.textContent = index+1;
        row.appendChild(boardCell);

        var boardCell = document.createElement('td');
        boardCell.textContent = item.boardName + "(" + item.board + ")";
        row.appendChild(boardCell);

        var rateClassCell = document.createElement('td');
        rateClassCell.textContent = item.roomCombineName;
        row.appendChild(rateClassCell);

        var roomCodeCell = document.createElement('td');
        roomCodeCell.textContent = "$" + parseInt(item.roomPrice)*2;
        row.appendChild(roomCodeCell);

        var deleteCell = document.createElement('td');
        var deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.className = 'btn btn-danger btn-sm';
        deleteButton.onclick = function() {
            deleteRow(index);
        };
        deleteCell.appendChild(deleteButton);
        row.appendChild(deleteCell);

        tbody.appendChild(row);
    });

    if (arr.length == rooms) {
        $('#roomsModal').modal('show'); // Show the modal
        $(".bn").show();
    }else{
        $(".bn").hide();
    }
}



function deleteRow(index) {
    arr.splice(index, 1); // Remove the element at the specified index
    updateModalContent(); // Update the modal content after deletion
    $("#tm").html(arr.length); // Update the count display
}







function showToast(event) {
    var toast = $('#successToast');
    var offset = $(event.target).offset();
    toast.css({
        top: offset.top + 20, // Adjust the position as needed
        left: offset.left - 50 // Adjust the position as needed
    });
    toast.toast('show');
}



function roomsee(){
     $('#roomsModal').modal('show'); 
}



function roomBook(){
    $("#arrayForm").submit();
}



// Function to hide the loader after 6 seconds
setTimeout(function() {
    document.getElementById('cc').style.display = 'none';
    $("#sidepanel").show();
}, 4000); // 6000 milliseconds = 6 seconds



      </script>


@php
// dd($images);
@endphp

@include('site.footer')
@php    
//dd($images);
@endphp