
@include('site.header')
@inject('provider', 'App\Http\Controllers\Site')
@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $sessionval=session()->all();
                
                $currency=$data['siteData']['currency']; 
                $currency_symbol=$data['siteData']['currency_symbol'];  
                
                
                if(isset($pageData)){ $other_content=json_decode($pageData->other_content,true); }
         @endphp
<?php $fromDate=date('d/m/Y', strtotime(date('m/d/Y').' +5 day'));
	  $toDate=date('d/m/Y', strtotime(date('m/d/Y').' +7 day'));
	  //print_r($hotel_data);
 ?>
 
  @if(isset($flightData) && count($flightData)>0)
 <section class="destination-area padding-top-100px padding-bottom-80px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title">Featured Flight Deals 1</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-60px">
        <?php   foreach($flightData as $fd) { $oc=json_decode($fd->other_content,true); 
		if($oc['flight_type']=='return'){ $arrow="la la-arrows-h"; }else{ $arrow="la la-arrow-right"; }
		$fromDate=date('M d, Y', strtotime(date('m/d/Y').' +'.$oc["outbound_days"].' day'));
        $toDate=date('M d, Y', strtotime(date('m/d/Y').' +'.$oc["inbound_days"].' day'));
									 ?>
        
           <div class="col-lg-4 responsive-column">
               <div class="card-item flight-card">
                   <div class="card-img">
                       <a href="{{ asset($fd->page_id) }}" class="d-block">
                           <img src=" {{ asset($fd->image) }}" alt="destination-img">
                           <span class="badge"><?php echo ucfirst($oc['flight_type']); ?> </span>
                       </a>
                   </div>
                   <div class="card-body">
                       <!--<img src="images/american-airline.png" alt="" class="flight-logo">-->
                       <h3 class="card-title"><a href="{{ asset($fd->page_id) }}"><?php echo $fd->city_from; ?> 
									<i class="{{$arrow}}"></i> <?php echo $fd->city_to; ?></a></h3>
                       <p class="card-meta">{{$fromDate}} @if($oc['flight_type']=='return')- {{$toDate}} @endif </p>
                       <div class="card-price d-flex align-items-center justify-content-between">
                           <p>
                               <span class="price__from">From</span>
                               <span class="price__num"><?php echo $currency_symbol." ".$provider::convertCurrencyRateFlight($oc['currency'],$oc['price']);  ?></span>
                           </p>
                           <a href="{{ asset($fd->page_id) }}" class="btn-text">Read details<i class="la la-angle-right"></i></a>
                       </div>
                   </div>
               </div><!-- end card-item -->
           </div><!-- end col-lg-4 -->
           
           <?php } ?>
           
        </div><!-- end row -->
    </div><!-- end container -->
</section>
  @endif

  @if(isset($hotelData) &&  count($hotelData)>0)
 <section class="hotel-area section-bg padding-top-100px padding-bottom-200px overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title line-height-55">Popular Hotel Destinations <br> You Might Like</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-50px">
            <div class="col-lg-12">
                <div class="hotel-card-wrap">
                    <div class="hotel-card-carousel-2 carousel-action">
                        <?php   foreach($hotelData as $hd) { $oc=json_decode($hd->other_content,true); ?>
                        <div class="card-item">
                            <div class="card-img">
                                <a href="{{ asset('hotel/details/'.$hd->page_id) }}" class="d-block">
                                    <img src="<?php echo $oc['hotel_image']; ?>" height="200px" alt="hotel-img">
                                </a>
                                <span class="badge"><?php echo ucfirst($oc['city_to']); ?>  </span>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><a href="{{ asset('hotel/details/'.$hd->page_id) }}"><?php echo $oc['hotel_name']; ?></a></h3>
                                <p class="card-meta"><?php echo $oc['city_to'].", ".$oc['hotel_address']; ?></p>
                                <div class="card-rating">
                                    <!--<span class="badge text-white">4.4/5</span>
                                    <span class="review__text">Average</span>
                                    <span class="rating__text">(30 Reviews)</span>-->
                                </div>
                                <div class="card-price d-flex align-items-center justify-content-between">
                                    <p>
                                        <span class="price__num"><?php echo $provider::convertCurrencyRateFlight($oc['currency'],$oc['price']);  ?></span>
                                        <span class="price__num before-price color-text-3"><?php echo $provider::convertCurrencyRateFlight($oc['currency'],$oc['price']);  ?></span>
                                        <span class="price__text">Per night</span>
                                    </p>
                                    <a href="hotel-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                </div>
                            </div>
                        </div><!-- end card-item -->
                          <?php } ?> 
                          
                           <?php   foreach($hotelData as $hd) { $oc=json_decode($hd->other_content,true); ?>
                        <div class="card-item">
                            <div class="card-img">
                                <a href="{{ asset('hotel/details/'.$hd->page_id) }}" class="d-block">
                                    <img src="<?php echo $oc['hotel_image']; ?>" height="200px" alt="hotel-img">
                                </a>
                                <span class="badge"><?php echo ucfirst($oc['city_to']); ?>  </span>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><a href="{{ asset('hotel/details/'.$hd->page_id) }}"><?php echo $oc['hotel_name']; ?></a></h3>
                                <p class="card-meta"><?php echo $oc['city_to'].", ".$oc['hotel_address']; ?></p>
                                <div class="card-rating">
                                    <!--<span class="badge text-white">4.4/5</span>
                                    <span class="review__text">Average</span>
                                    <span class="rating__text">(30 Reviews)</span>-->
                                </div>
                                <div class="card-price d-flex align-items-center justify-content-between">
                                    <p>
                                        <span class="price__num"><?php echo $provider::convertCurrencyRateFlight($oc['currency'],$oc['price']);  ?></span>
                                        <span class="price__num before-price color-text-3"><?php echo $provider::convertCurrencyRateFlight($oc['currency'],$oc['price']);  ?></span>
                                        <span class="price__text">Per night</span>
                                    </p>
                                    <a href="hotel-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                </div>
                            </div>
                        </div><!-- end card-item -->
                          <?php } ?>
                           
                    </div><!-- end hotel-card-carousel -->
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container-fluid -->
</section>
 @endif 
 
 
 
 

<div class="section-block"></div>
<!-- ================================
    START Content AREA
================================= -->
<section class="blog-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-justify">
                    <?php if(isset($pageData->content)){ echo $pageData->content; } ?>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
            @if(isset($flightData))
            <div class="col-lg-12">
                <div class="section-heading text-justify">
                    <?php  if(isset($other_content['flight'])){ echo $other_content['flight']; }?>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
            @endif
            @if(isset($hotelData))
            <div class="col-lg-12">
                <div class="section-heading text-justify">
                    <?php  if(isset($other_content['hotel'])){ echo $other_content['hotel']; } ?>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
            @endif
        </div><!-- end row -->
    </div>
</section>
<!-- ================================
    END Content AREA
================================= -->
@include('site.footer')
