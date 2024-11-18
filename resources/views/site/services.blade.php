@include('site.header')
@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
      
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                $currency=$data['siteData']['currency']; 
                $currency_symbol=$data['siteData']['currency_symbol'];                
         @endphp         
<!-- ================================
    START SERVICE AREA
================================= -->
<section class="service-area section--padding text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title">Services We Provide</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-80px">
         @foreach($sarviceMainData as $key => $data)
            <div class="col-lg-3 responsive-column">
                <div class="icon-box icon-layout-4">
                    <div class="info-icon">
                        <!--<i class="la la-plane"></i>-->
                        <img src="<?php echo $data->icon_image; ?> " height="50px" width="50px" />
                    </div><!-- end info-icon-->
                    <div class="info-content">
                        <h4 class="info__title"><a href="#"><?php echo $data->service_name; ?> </a></h4>
                        <p class="info__desc">
                           <?php echo $data->short_description; ?> 
                        </p>
                    </div><!-- end info-content -->
                </div><!-- end icon-box -->
            </div><!-- end col-lg-3 -->
         @endforeach

        </div><!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content-info mt-n4 d-flex justify-content-between align-items-center">
                    <p class="font-size-15">Do not hesitate to contact us for better help and service.</p>
                    <a href="{{ asset('contact')}}" class="btn-text font-size-15">Contact us <i class="la la-arrow-right ml-1"></i></a>
                </div><!-- end tab-content-info -->
            </div>
        </div>
    </div><!-- end container -->
</section><!-- end service-area -->
<!-- ================================
    END SERVICE AREA
================================= -->

<!-- ================================
    START SERVICE AREA
================================= -->
<section class="service-area section-bg section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title">Services Also We Offer</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-50px">
        @foreach($sarviceMainData as $key => $data)
            <div class="col-lg-4 responsive-column">
                <div class="card-item ">
                    <div class="card-img">
                        <img src="<?php echo $data->image; ?>" height="200px" alt="<?php echo $data->image_alt_text; ?>">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title mb-2"><?php echo $data->service_name; ?></h3>
                        <p class="card-meta">
                            <?php echo $data->short_description; ?>
                        </p>
                        <!--<div class="card-rating">
                            <span class="badge text-white">4.4/5</span>
                            <span class="review__text">Average</span>
                            <span class="rating__text">(30 Reviews)</span>
                        </div>
                        <div class="card-price d-flex align-items-center justify-content-between">
                            <p>
                                <span class="price__from">From</span>
                                <span class="price__num">$100.00</span>
                            </p>
                            <span class="tour-hour"><i class="la la-clock-o mr-1"></i>7 days</span>
                        </div>
                        <div class="btn-box pt-3">
                            <a href="#" class="theme-btn theme-btn-small">I want this</a>
                        </div>-->
                    </div>
                </div><!-- end card-item -->
            </div><!-- end col-lg-4 -->
        @endforeach
            
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end service-area -->
<!-- ================================
    END SERVICE AREA
================================= -->

<!-- ================================
    START CTA AREA
================================= -->
<section class="cta-area subscriber-area section-bg-2 padding-top-60px padding-bottom-60px">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="section-heading">
                    <h2 class="sec__title font-size-30 text-white">Subscribe to Get Updates & Offers</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-7 -->
            <div class="col-lg-5">
                <div class="subscriber-box">
                    <div class="contact-form-action">
                        <form action="#">
                            <div class="input-box">
                                <label class="label-text text-white">Enter email address</label>
                                <div class="form-group mb-0">
                                    <span class="la la-envelope form-icon"></span>
                                    <input class="form-control" type="email" name="email" placeholder="Email address">
                                    <button class="theme-btn theme-btn-small submit-btn" type="submit">Subscribe</button>
                                    <span class="font-size-14 pt-1 text-white-50"><i class="la la-lock mr-1"></i>Don't worry your information is safe with us.</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-5 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end cta-area -->
<!-- ================================
    END CTA AREA
================================= -->
@include('site.footer')