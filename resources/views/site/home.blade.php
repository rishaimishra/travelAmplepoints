@inject('provider', 'App\Http\Controllers\Site')
@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $sessionval=session()->all();
                $other_content=json_decode($pageData->other_content,true);
                
                $currency=$data['siteData']['currency']; 
                $currency_symbol=$data['siteData']['currency_symbol'];  
                
         @endphp
<?php $fromDate=date('d/m/Y', strtotime(date('m/d/Y').' +5 day'));
	  $toDate=date('d/m/Y', strtotime(date('m/d/Y').' +7 day'));
	  //print_r($hotel_data);
 ?>
<!-- ================================
    START INFO AREA
================================= -->
<section class="info-area info-bg padding-top-50px padding-bottom-50px text-center">
    <div class="container">
        <div class="row">
        @for($i=0;$i< 3;$i++)
            <div class="col-lg-4">
                <div class="icon-box">
                    <div class="info-icon">
                        <img src="{{$other_content['images'][$i]}}" alt="a{{$other_content['alt_text'][$i]}}" height="40" width="40" >
                    </div><!-- end info-icon-->
                    <div class="info-content">
                        <h4 class="info__title">{{$other_content['heading'][$i]}}</h4>
                        <p class="info__desc">
                         {{$other_content['content'][$i]}}
                        </p>
                    </div><!-- end info-content -->
                </div><!-- end icon-box -->
            </div>
            @endfor
            <!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end info-area -->
<!-- ================================
    END INFO AREA
================================= -->

<div class="section-block"></div>
<!-- ================================
    START HOTEL AREA
================================= -->
<section class="hotel-area section-bg section-padding overflow-hidden padding-right-100px padding-left-100px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title line-height-55">{{$other_content['hotel_heading']}}</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-50px">
            <div class="col-lg-12">
                <div class="hotel-card-wrap">
                    <div class="hotel-card-carousel carousel-action">
                    <?php  $noImage=url('').'/images/nohotel.jpg';  foreach($hotel_data as $hd) { ?>
                        <div class="card-item mb-0">
                            <div class="card-img">
<?php
$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL,$hd->hotel_img);
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
$query = curl_exec($curl_handle);
curl_close($curl_handle);
?>
                                <a href="hotel-details/<?php echo base64_encode($hd->hotel_id); ?>" class="d-block">
                                    <img height="200px" src="<?php if (strpos($query, 'NoSuchKey')== false){ echo $hd->hotel_img ;} else{ echo  $noImage; } ?>" alt="hotel-img">
                                </a>
                                <span class="badge"><?php echo $hd->total; ?> Sell</span>
                                <div class="add-to-wishlist icon-element" data-toggle="tooltip" data-placement="top" title="Bookmark">
                                    <i class="la la-heart-o"></i>
                                </div>
                            </div>
                            <div class="card-body">  
                                <h3 class="card-title"><a href="hotel-details/<?php echo $hd->hotel_id; ?>">
					<?php if(strlen($hd->hotelName)> 22){ echo substr_replace($hd->hotelName, "...", 22);}else{ echo $hd->hotelName;} ?></a></h3>
                                <p class="card-meta">
					<?php if(strlen($hd->hotelAddress)> 30){ echo substr_replace($hd->hotelAddress, "...", 22); }else{ echo $hd->hotelName; } ?></p>
                                <div class="card-rating">
                                    <span class="badge text-white"><?php echo $hd->hotelRating; ?>/5</span>
                                    <!--<span class="review__text">Average</span>
                                    <span class="rating__text">(30 Reviews)</span>-->
                                </div>
                                <div class="card-price d-flex align-items-center justify-content-between">
                                    <p>
                                        <span class="price__from">From</span>
                                        <span class="price__num"><?php echo $provider::convertCurrencyRateFlight($hd->currency_code,$hd->chargable_rate);  ?></span>
                                        <span class="price__text">Per night</span>
                                    </p>
                                    <a href="hotel-details/<?php echo $hd->hotel_id; ?>" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                </div>
                            </div>
                        </div><!-- end card-item -->
                    <?php } ?>
                    </div><!-- end hotel-card-carousel -->
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container-fluid -->
</section><!-- end hotel-area -->
<!-- ================================
    END HOTEL AREA
================================= -->



<!-- ================================
       START TESTIMONIAL AREA
================================= -->
<section class="testimonial-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-heading">
                    <h2 class="sec__title line-height-50">{{$other_content['review_heading']}}</h2>
                    <p class="sec__desc padding-top-30px">
                    </p>
                    <div class="btn-box padding-top-35px">
                        <a href="{{ asset('review') }}" class="theme-btn">Explore All</a>
                    </div>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-8">
                <div class="testimonial-carousel carousel-action">
                @foreach($reviewData as $key => $data)
                    <div class="testimonial-card">
                        <div class="testi-desc-box">
                            <p class="testi__desc">{{$data->review}}</p>
                        </div>
                        <div class="author-content d-flex align-items-center">
                            <div class="author-img">
                                <img src="{{$data->profile_pic}}" alt="testimonial image">
                            </div>
                            <div class="author-bio">
                                <h4 class="author__title">{{$data->customer_name}}</h4>
                                <span class="author__meta">{{$data->customer_address}}</span>
                                <span class="ratings d-flex align-items-center">
                                @for($i=1;$i<=$data->rating;$i++)
                                    <i class="la la-star"></i>
                                @endfor
                                </span>
                            </div>
                        </div>
                    </div><!-- end testimonial-card -->
                @endforeach
                   
                </div><!-- end testimonial-carousel -->
            </div><!-- end col-lg-8 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end testimonial-area -->
<!-- ================================
       START TESTIMONIAL AREA
================================= -->


<!-- ================================
    START CTA AREA
================================= -->
<section class="cta-area padding-top-100px padding-bottom-180px text-center">
<div class="video-bg" style="background:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.5)),url({{$pageData->image}});background-size: cover;">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="sec__title text-white line-height-55">{{$other_content['other_heading']}}</h2>
                </div><!-- end section-heading -->
                <div class="btn-box padding-top-35px">
                    <a href="{{ asset('agent-signup')}}" class="theme-btn border-0">Become an Agent</a>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
    <svg class="cta-svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M-31.31,170.22 C164.50,33.05 334.36,-32.06 547.11,196.88 L500.00,150.00 L0.00,150.00 Z"></path></svg>
</section><!-- end cta-area -->
<!-- ================================
    END CTA AREA
================================= -->


<!-- ================================
       START BLOG AREA
================================= -->
<section class="blog-area padding-top-30px padding-bottom-90px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title line-height-55">{{$other_content['blog_heading']}}</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-50px">
        @foreach($blogData as $key => $data)
            <div class="col-lg-4 responsive-column">
                <div class="card-item blog-card">
                    <div class="card-img">
                        <img src="{{$data->thumb_nail}}" height="200" alt="blog-img">
                        <div class="post-format icon-element">
                            <i class="la la-photo"></i>
                        </div>
                        <div class="card-body">
                            <div class="post-categories">
                             @php $category=json_decode($data->category,true); @endphp
                             @foreach($category as $key=>$c)
                                <a href="#" class="badge">{{$c}}</a>
                             @endforeach
                            </div>
                            
                            <h3 class="card-title line-height-26"><a href="{{ asset('blog-details') }}/{{$data->id}}"><?php echo $data->heading; ?></a></h3>
                            <p class="card-meta">
                                <span class="post__date">  {{ date('d M Y',strtotime($data->date_time))}}</span>
                                <span class="post-dot"></span>
                                <span class="post__time">{{$data->views}} Views</span>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="author-content d-flex align-items-center">
                            <div class="author-img">
                                <img src="{{$data->profile_pic}}" alt="testimonial image">
                            </div>
                            <div class="author-bio">
                                <a href="{{ asset('blogs') }}/{{$data->user_id}}" class="author__title">{{$data->first_name}} {{$data->last_name}}</a>
                            </div>
                        </div>
                        <div class="post-share">
                            <ul>
                                <li>
                            	    <a href="{{ asset('blog-details') }}/{{$data->id}}"><i class="la la-share icon-element"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- end card-item -->
            </div><!-- end col-lg-4 -->
		@endforeach
        </div><!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-box text-center pt-4">
                    <a href="{{ asset('blogs') }}" class="theme-btn">Read More Post</a>
                </div>
            </div>
        </div>
    </div><!-- end container -->
</section><!-- end blog-area -->
<!-- ================================
       START BLOG AREA
================================= -->




<section class="round-trip-flight section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title line-height-55">Most Popular Round-trip <br> Flight Destinations</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-50px">
            <div class="col-lg-12">
               <div class="flight-filter-tab text-center">
                   <div class="section-tab section-tab-3">
                       <ul class="nav nav-tabs justify-content-center" id="myTab4" role="tablist">
                           <li class="nav-item">
                               <a class="nav-link active" id="new-york-tab" data-toggle="tab" href="#new-york" role="tab" aria-controls="new-york" aria-selected="false">
                                   New York
                               </a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" id="hong-kong-tab" data-toggle="tab" href="#hong-kong" role="tab" aria-controls="hong-kong" aria-selected="false">
                                   Hong Kong
                               </a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" id="beijing-tab" data-toggle="tab" href="#beijing" role="tab" aria-controls="beijing" aria-selected="false">
                                   Beijing
                               </a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" id="tokyo-tab" data-toggle="tab" href="#tokyo" role="tab" aria-controls="tokyo" aria-selected="false">
                                   Tokyo
                               </a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" id="seoul-tab" data-toggle="tab" href="#seoul" role="tab" aria-controls="seoul" aria-selected="false">
                                   Seoul
                               </a>
                           </li>
                       </ul>
                   </div><!-- end section-tab -->
               </div><!-- end flight-filter-tab -->
                <div class="popular-round-trip-wrap padding-top-40px">
                    <div class="tab-content" id="myTabContent4">
                        <div class="tab-pane fade show active" id="new-york" role="tabpanel" aria-labelledby="new-york-tab">
                            <div class="row">
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    New York<i class="la la-exchange mx-2"></i>Los Angeles
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$340</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img2.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    New York<i class="la la-exchange mx-2"></i>Barcelona
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$740</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img3.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    New York<i class="la la-exchange mx-2"></i>Dallas
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$140</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img4.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    New York<i class="la la-exchange mx-2"></i>San Francisco
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$340</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img5.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    New York<i class="la la-exchange mx-2"></i>Miami
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$100</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img6.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    New York<i class="la la-exchange mx-2"></i>London
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$640</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                            </div>
                        </div><!-- end tab-pane -->
                        <div class="tab-pane fade" id="hong-kong" role="tabpanel" aria-labelledby="hong-kong-tab">
                            <div class="row">
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Hong Kong<i class="la la-exchange mx-2"></i>Singapore
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$340</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img2.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                   Hong Kong<i class="la la-exchange mx-2"></i>Tokyo
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$740</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img3.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                   Hong Kong<i class="la la-exchange mx-2"></i>Seoul
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$140</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img4.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                   Hong Kong<i class="la la-exchange mx-2"></i>Manila
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$340</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img5.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                   Hong Kong<i class="la la-exchange mx-2"></i>Nepal
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$100</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img6.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                   Hong Kong<i class="la la-exchange mx-2"></i>Beijing
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$640</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                            </div>
                        </div><!-- end tab-pane -->
                        <div class="tab-pane fade" id="seoul" role="tabpanel" aria-labelledby="seoul-tab">
                            <div class="row">
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Seoul<i class="la la-exchange mx-2"></i>Nepal
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$340</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img2.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Seoul<i class="la la-exchange mx-2"></i>Taipei
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$740</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img3.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Seoul<i class="la la-exchange mx-2"></i>Beijing
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$140</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img4.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Seoul<i class="la la-exchange mx-2"></i>Tokyo
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$340</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img5.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Seoul<i class="la la-exchange mx-2"></i>Hong kong
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$100</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img6.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Seoul<i class="la la-exchange mx-2"></i>Bangkok
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$640</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                            </div>
                        </div><!-- end tab-pane -->
                        <div class="tab-pane fade" id="tokyo" role="tabpanel" aria-labelledby="tokyo-tab">
                            <div class="row">
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Tokyo<i class="la la-exchange mx-2"></i>Taipei
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$340</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img2.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Tokyo<i class="la la-exchange mx-2"></i>Taipei
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$740</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img3.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Tokyo<i class="la la-exchange mx-2"></i>Beijing
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$140</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img4.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Tokyo<i class="la la-exchange mx-2"></i>Tokyo
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$340</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img5.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Tokyo<i class="la la-exchange mx-2"></i>Hong kong
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$100</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img6.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Tokyo<i class="la la-exchange mx-2"></i>Hanoi
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$640</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                            </div>
                        </div><!-- end tab-pane -->
                        <div class="tab-pane fade" id="beijing" role="tabpanel" aria-labelledby="beijing-tab">
                            <div class="row">
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Beijing<i class="la la-exchange mx-2"></i>Taipei
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$340</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img2.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Beijing<i class="la la-exchange mx-2"></i>Taipei
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$740</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img3.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Beijing<i class="la la-exchange mx-2"></i>Beijing
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$140</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img4.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Beijing<i class="la la-exchange mx-2"></i>Tokyo
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$340</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img5.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Beijing<i class="la la-exchange mx-2"></i>Hong kong
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$100</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4 responsive-column">
                                    <div class="deal-card">
                                        <div class="deal-title d-flex align-items-center">
                                            <img src="images/airline-img6.png" alt="air-line-img">
                                            <h3 class="deal__title">
                                                <a href="flight-single.html" class="d-flex align-items-center">
                                                    Beijing<i class="la la-exchange mx-2"></i>Hanoi
                                                </a>
                                            </h3>
                                        </div>
                                        <p class="deal__meta">Tue, Jul 14-Fri, Jul 24</p>
                                        <div class="deal-action-box d-flex align-items-center justify-content-between">
                                            <div class="price-box d-flex align-items-center"><span class="price__from mr-1">From</span><span class="price__num">$640</span></div>
                                            <a href="flight-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                        </div>
                                    </div><!-- end deal-card -->
                                </div><!-- end col-lg-4 -->
                            </div>
                        </div><!-- end tab-pane -->
                    </div><!-- end tab-content -->
                    <div class="tab-content-info d-flex justify-content-between align-items-center">
                        <p class="font-size-15"><i class="la la-question-circle mr-1"></i>Average round-trip price per person, taxes and fees included.</p>
                        <a href="#" class="btn-text font-size-15">Discover More <i class="la la-angle-right"></i></a>
                    </div><!-- end tab-content-info -->
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>


<!-- ================================
    START DESTINATION AREA
================================= -->
<section class="destination-area section--padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="section-heading">
                    <h2 class="sec__title">Top Visited Places</h2>
                    <p class="sec__desc pt-3">Morbi convallis bibendum urna ut viverra Maecenas quis
                </div><!-- end section-heading -->
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="btn-box btn--box text-right">
                    <a href="tour-grid.html" class="theme-btn">Discover More</a>
                </div>
            </div>
        </div><!-- end row -->
        <div class="row padding-top-50px">
            <div class="col-lg-4">
                <div class="card-item destination-card">
                    <div class="card-img">
                        <img src="images/destination-img2.jpg" alt="destination-img">
                        <span class="badge">new york</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title"><a href="tour-details.html">Main Street Park</a></h3>
                        <div class="card-rating d-flex align-items-center">
                            <span class="ratings d-flex align-items-center mr-1">
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star-o"></i>
                                <i class="la la-star-o"></i>
                            </span>
                            <span class="rating__text">(70694 Reviews)</span>
                        </div>
                        <div class="card-price d-flex align-items-center justify-content-between">
                            <p class="tour__text">
                                50 Tours
                            </p>
                            <p>
                                <span class="price__from">Price</span>
                                <span class="price__num">$58.00</span>
                            </p>
                        </div>
                    </div>
                </div><!-- end card-item -->
                <div class="card-item destination-card">
                    <div class="card-img">
                        <img src="images/destination-img3.jpg" alt="destination-img">
                        <span class="badge">chicago</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title"><a href="tour-details.html">Chicago Cultural Center</a></h3>
                        <div class="card-rating d-flex align-items-center">
                            <span class="ratings d-flex align-items-center mr-1">
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star-o"></i>
                            </span>
                            <span class="rating__text">(70694 Reviews)</span>
                        </div>
                        <div class="card-price d-flex align-items-center justify-content-between">
                            <p class="tour__text">
                                50 Tours
                            </p>
                            <p>
                                <span class="price__from">Price</span>
                                <span class="price__num">$68.00</span>
                            </p>
                        </div>
                    </div>
                </div><!-- end card-item -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-4">
                <div class="card-item destination-card">
                    <div class="card-img">
                        <img src="images/destination-img4.jpg" alt="destination-img">
                        <span class="badge">Hong Kong</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title"><a href="tour-details.html">Lugard Road Lookout</a></h3>
                        <div class="card-rating d-flex align-items-center">
                            <span class="ratings d-flex align-items-center mr-1">
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star-o"></i>
                                <i class="la la-star-o"></i>
                            </span>
                            <span class="rating__text">(70694 Reviews)</span>
                        </div>
                        <div class="card-price d-flex align-items-center justify-content-between">
                            <p class="tour__text">
                                150 Tours
                            </p>
                            <p>
                                <span class="price__from">Price</span>
                                <span class="price__num">$79.00</span>
                                <span class="price__num before-price">$89.00</span>
                            </p>
                        </div>
                    </div>
                </div><!-- end card-item -->
                <div class="card-item destination-card">
                    <div class="card-img">
                        <img src="images/destination-img5.jpg" alt="destination-img">
                        <span class="badge">Las Vegas</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title"><a href="tour-details.html">Planet Hollywood Resort</a></h3>
                        <div class="card-rating d-flex align-items-center">
                            <span class="ratings d-flex align-items-center mr-1">
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star-o"></i>
                            </span>
                            <span class="rating__text">(70694 Reviews)</span>
                        </div>
                        <div class="card-price d-flex align-items-center justify-content-between">
                            <p class="tour__text">
                                50 Tours
                            </p>
                            <p>
                                <span class="price__from">Price</span>
                                <span class="price__num">$88.00</span>
                            </p>
                        </div>
                    </div>
                </div><!-- end card-item -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-4">
                <div class="card-item destination-card">
                    <div class="card-img">
                        <img src="images/destination-img.jpg" alt="destination-img">
                        <span class="badge">Shanghai</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title"><a href="tour-details.html">Oriental Pearl TV Tower</a></h3>
                        <div class="card-rating d-flex align-items-center">
                            <span class="ratings d-flex align-items-center mr-1">
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                            </span>
                            <span class="rating__text">(70694 Reviews)</span>
                        </div>
                        <div class="card-price d-flex align-items-center justify-content-between">
                            <p class="tour__text">
                                50 Tours
                            </p>
                            <p>
                                <span class="price__from">Price</span>
                                <span class="price__num">$58.00</span>
                            </p>
                        </div>
                    </div>
                </div><!-- end card-item -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end destination-area -->
<!-- ================================
    END DESTINATION AREA
================================= -->


<!-- ================================
    START CAR AREA
================================= -->
<section class="car-area section-bg section-padding ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title">Recommended Car Rentals</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-50px">
            <div class="col-lg-12">
                <div class="car-wrap">
                    <div class="car-carousel carousel-action">
                        <div class="card-item car-card mb-0">
                            <div class="card-img">
                                <a href="car-single.html" class="d-block">
                                    <img src="images/car-img.png" alt="car-img">
                                </a>
                                <span class="badge">Bestseller</span>
                                <div class="add-to-wishlist icon-element" data-toggle="tooltip" data-placement="top" title="Save for later">
                                    <i class="la la-heart-o"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-meta">Compact SUV</p>
                                <h3 class="card-title"><a href="car-single.html">Toyota Corolla or Similar</a></h3>
                                <div class="card-rating">
                                    <span class="badge text-white">4.4/5</span>
                                    <span class="review__text">Average</span>
                                    <span class="rating__text">(30 Reviews)</span>
                                </div>
                                <div class="card-attributes">
                                    <ul class="d-flex align-items-center">
                                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Passenger"><i class="la la-users"></i><span>4</span></li>
                                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Luggage"><i class="la la-suitcase"></i><span>1</span></li>
                                    </ul>
                                </div>
                                <div class="card-price d-flex align-items-center justify-content-between">
                                    <p>
                                        <span class="price__from">From</span>
                                        <span class="price__num">$23.00</span>
                                        <span class="price__text">Per day</span>
                                    </p>
                                    <a href="car-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                </div>
                            </div>
                        </div><!-- end card-item -->
                        <div class="card-item car-card mb-0">
                            <div class="card-img">
                                <a href="car-single.html" class="d-block">
                                    <img src="images/car-img2.png" alt="car-img">
                                </a>
                                <div class="add-to-wishlist icon-element" data-toggle="tooltip" data-placement="top" title="Save for later">
                                    <i class="la la-heart-o"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-meta">Standard</p>
                                <h3 class="card-title"><a href="car-single.html">Volkswagen Jetta 2 Doors or Similar</a></h3>
                                <div class="card-rating">
                                    <span class="badge text-white">4.4/5</span>
                                    <span class="review__text">Average</span>
                                    <span class="rating__text">(30 Reviews)</span>
                                </div>
                                <div class="card-attributes">
                                    <ul class="d-flex align-items-center">
                                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Passenger"><i class="la la-users"></i><span>4</span></li>
                                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Luggage"><i class="la la-suitcase"></i><span>1</span></li>
                                    </ul>
                                </div>
                                <div class="card-price d-flex align-items-center justify-content-between">
                                    <p>
                                        <span class="price__from">From</span>
                                        <span class="price__num">$33.00</span>
                                        <span class="price__text">Per day</span>
                                    </p>
                                    <a href="car-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                </div>
                            </div>
                        </div><!-- end card-item -->
                        <div class="card-item car-card mb-0">
                            <div class="card-img">
                                <a href="car-single.html" class="d-block">
                                    <img src="images/car-img3.png" alt="car-img">
                                </a>
                                <span class="badge">featured</span>
                                <div class="add-to-wishlist icon-element" data-toggle="tooltip" data-placement="top" title="Save for later">
                                    <i class="la la-heart-o"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-meta">Compact Elite</p>
                                <h3 class="card-title"><a href="car-single.html">Toyota Yaris or Similar</a></h3>
                                <div class="card-rating">
                                    <span class="badge text-white">4.4/5</span>
                                    <span class="review__text">Average</span>
                                    <span class="rating__text">(30 Reviews)</span>
                                </div>
                                <div class="card-attributes">
                                    <ul class="d-flex align-items-center">
                                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Passenger"><i class="la la-users"></i><span>4</span></li>
                                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Luggage"><i class="la la-suitcase"></i><span>1</span></li>
                                    </ul>
                                </div>
                                <div class="card-price d-flex align-items-center justify-content-between">
                                    <p>
                                        <span class="price__from">From</span>
                                        <span class="price__num">$23.00</span>
                                        <span class="price__text">Per day</span>
                                    </p>
                                    <a href="car-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                </div>
                            </div>
                        </div><!-- end card-item -->
                        <div class="card-item car-card mb-0">
                            <div class="card-img">
                                <a href="car-single.html" class="d-block">
                                    <img src="images/car-img4.png" alt="car-img">
                                </a>
                                <span class="badge">Bestseller</span>
                                <div class="add-to-wishlist icon-element" data-toggle="tooltip" data-placement="top" title="Save for later">
                                    <i class="la la-heart-o"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-meta">Fullsize Van</p>
                                <h3 class="card-title"><a href="car-single.html">Seat Alhambra or Similar</a></h3>
                                <div class="card-rating">
                                    <span class="badge text-white">4.4/5</span>
                                    <span class="review__text">Average</span>
                                    <span class="rating__text">(30 Reviews)</span>
                                </div>
                                <div class="card-attributes">
                                    <ul class="d-flex align-items-center">
                                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Passenger"><i class="la la-users"></i><span>6</span></li>
                                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Luggage"><i class="la la-suitcase"></i><span>2</span></li>
                                    </ul>
                                </div>
                                <div class="card-price d-flex align-items-center justify-content-between">
                                    <p>
                                        <span class="price__from">From</span>
                                        <span class="price__num">$45.00</span>
                                        <span class="price__text">Per day</span>
                                    </p>
                                    <a href="car-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                </div>
                            </div>
                        </div><!-- end card-item -->
                        <div class="card-item car-card mb-0">
                            <div class="card-img">
                                <a href="car-single.html" class="d-block">
                                    <img src="images/car-img5.png" alt="car-img">
                                </a>
                                <div class="add-to-wishlist icon-element" data-toggle="tooltip" data-placement="top" title="Save for later">
                                    <i class="la la-heart-o"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-meta">Luxury</p>
                                <h3 class="card-title"><a href="car-single.html">Mercedes E Class or Similar</a></h3>
                                <div class="card-rating">
                                    <span class="badge text-white">4.4/5</span>
                                    <span class="review__text">Average</span>
                                    <span class="rating__text">(30 Reviews)</span>
                                </div>
                                <div class="card-attributes">
                                    <ul class="d-flex align-items-center">
                                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Passenger"><i class="la la-users"></i><span>5</span></li>
                                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Luggage"><i class="la la-suitcase"></i><span>3</span></li>
                                    </ul>
                                </div>
                                <div class="card-price d-flex align-items-center justify-content-between">
                                    <p>
                                        <span class="price__from">From</span>
                                        <span class="price__num">$58.00</span>
                                        <span class="price__text">Per day</span>
                                    </p>
                                    <a href="car-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                </div>
                            </div>
                        </div><!-- end card-item -->
                        <div class="card-item car-card mb-0">
                            <div class="card-img">
                                <a href="car-single.html" class="d-block">
                                    <img src="images/car-img6.png" alt="car-img">
                                </a>
                                <span class="badge">featured</span>
                                <div class="add-to-wishlist icon-element" data-toggle="tooltip" data-placement="top" title="Save for later">
                                    <i class="la la-heart-o"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-meta">Mini</p>
                                <h3 class="card-title"><a href="car-single.html">Fiat Fiesta 2 Doors or Similar</a></h3>
                                <div class="card-rating">
                                    <span class="badge text-white">4.4/5</span>
                                    <span class="review__text">Average</span>
                                    <span class="rating__text">(30 Reviews)</span>
                                </div>
                                <div class="card-attributes">
                                    <ul class="d-flex align-items-center">
                                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Passenger"><i class="la la-users"></i><span>4</span></li>
                                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Luggage"><i class="la la-suitcase"></i><span>1</span></li>
                                    </ul>
                                </div>
                                <div class="card-price d-flex align-items-center justify-content-between">
                                    <p>
                                        <span class="price__from">From</span>
                                        <span class="price__num">$23.00</span>
                                        <span class="price__text">Per day</span>
                                    </p>
                                    <a href="car-single.html" class="btn-text">See details<i class="la la-angle-right"></i></a>
                                </div>
                            </div>
                        </div><!-- end card-item -->
                    </div><!-- end car-carousel -->
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end car-area -->
<!-- ================================
    END CAR AREA
================================= -->



<!-- ================================
    START MOBILE AREA
================================= -->
<section class="mobile-app padding-top-100px padding-bottom-50px section-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="mobile-app-content">
                    <div class="section-heading">
                        <h2 class="sec__title line-height-55">Plist Android and IOS App is Available!</h2>
                    </div><!-- end section-heading -->
                    <ul class="info-list padding-top-30px">
                        <li class="d-flex align-items-center mb-3"><span class="la la-check icon-element flex-shrink-0 ml-0"></span> Access and change your itinerary on-the-go</li>
                        <li class="d-flex align-items-center mb-3"><span class="la la-check icon-element flex-shrink-0 ml-0"></span> Free cancellation on select hotels</li>
                        <li class="d-flex align-items-center mb-3"><span class="la la-check icon-element flex-shrink-0 ml-0"></span> Get real-time trip updates</li>
                    </ul>
                    <div class="btn-box padding-top-30px">
                        <a href="#" class="d-inline-block mr-3">
                            <img src="images/app-store.png" alt="">
                        </a>
                        <a href="#" class="d-inline-block">
                            <img src="images/google-play.png" alt="">
                        </a>
                    </div><!-- end btn-box -->
                </div>
            </div><!-- end col-lg-6 -->
            <div class="col-lg-6">
                <div class="mobile-img">
                    <img src="images/mobile-app.png" alt="mobile-img">
                </div>
            </div><!-- end col-lg-5 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end mobile-app -->
<!-- ================================
    END MOBILE AREA
================================= -->



<!-- ================================
       START CLIENTLOGO AREA
================================= -->
<section class="clientlogo-area padding-top-80px padding-bottom-80px text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="client-logo">
                    <div class="client-logo-item">
                        <img src="images/client-logo.png" alt="brand image">
                    </div><!-- end client-logo-item -->
                    <div class="client-logo-item">
                        <img src="images/client-logo2.png" alt="brand image">
                    </div><!-- end client-logo-item -->
                    <div class="client-logo-item">
                        <img src="images/client-logo3.png" alt="brand image">
                    </div><!-- end client-logo-item -->
                    <div class="client-logo-item">
                        <img src="images/client-logo4.png" alt="brand image">
                    </div><!-- end client-logo-item -->
                    <div class="client-logo-item">
                        <img src="images/client-logo5.png" alt="brand image">
                    </div><!-- end client-logo-item -->
                    <div class="client-logo-item">
                        <img src="images/client-logo6.png" alt="brand image">
                    </div><!-- end client-logo-item -->
                </div><!-- end client-logo -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end clientlogo-area -->
<!-- ================================
       START CLIENTLOGO AREA
================================= -->