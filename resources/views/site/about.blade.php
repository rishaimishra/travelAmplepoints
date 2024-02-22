@include('site.header')
@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                
                $other_content=json_decode($pageData->other_content,true);
         @endphp
<!-- ================================
    START INFO AREA
================================= -->
<section class="info-area padding-top-100px padding-bottom-70px">
    <div class="container">
        <div class="row">
        	@for($i=0;$i< 3;$i++)
            <div class="col-lg-4 responsive-column">
                <div class="card-item" data-toggle="tooltip" data-placement="top" title="<?php echo $other_content['heading'][$i]; ?>">
                    <div class="card-img">
                        <img src="{{$other_content['images'][$i]}}" alt="a{{$other_content['alt_text'][$i]}}" height="250" >
                    </div>
                    <div class="card-body">
                        <h3 class="card-title mb-2"><?php echo $other_content['heading'][$i]; ?></h3>
                        <p class="card-text">
                            <?php echo $other_content['content'][$i]; ?>
                        </p>
                    </div>
                </div><!-- end card-item -->
            </div><!-- end col-lg-4 -->
            @endfor
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end info-area -->
<!-- ================================
    END INFO AREA
================================= -->
<!-- ================================
    START ABOUT AREA
================================= -->
<section class="about-area padding-bottom-90px overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading margin-bottom-40px">
                    <h2 class="sec__title">About Us</h2>
                    <!--<h4 class="title font-size-16 line-height-26 pt-4 pb-2"></h4>-->
                    <p class="sec__desc font-size-16 pb-3" ><?php echo $pageData->content; ?></p>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-6 -->
            <div class="col-lg-5 ml-auto">
                <div class="image-box about-img-box">
                    <img src="{{$other_content['main_image_1']}}" alt="{{$other_content['main_image_1_alt_text']}}" class="img__item img__item-1">
                    <img src="{{$other_content['main_image_2']}}" alt="{{$other_content['main_image_2_alt_text']}}-img" class="img__item img__item-2"
                </div>
            </div><!-- end col-lg-5 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end about-area -->
<!-- ================================
    END ABOUT AREA
================================= -->
<!-- ================================
    STAR FUNFACT AREA
================================= -->
<section class="funfact-area padding-bottom-70px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title">Our Numbers Say Everything</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="counter-box counter-box-2 margin-top-60px mb-0">
            <div class="row">
            @for($i=3;$i< 7;$i++)
                <div class="col-lg-3 responsive-column">
                    <div class="counter-item counter-item-layout-2 d-flex">
                        <div class="counter-icon flex-shrink-0">
                             <img src="{{$other_content['images'][$i]}}" alt="a{{$other_content['alt_text'][$i]}}" height="40" width="40" >
                        </div>
                        <div class="counter-content">
                            <div>
                                <span class="counter" data-from="0" data-to="200"  data-refresh-interval="5">{{$other_content['heading'][$i]}}</span>
                                <!--<span class="count-symbol">+</span>-->
                            </div>
                            <p class="counter__title">{{$other_content['content'][$i]}}</p>
                        </div><!-- end counter-content -->
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-3 -->
            @endfor
                
            </div><!-- end row -->
        </div><!-- end counter-box -->
    </div><!-- end container -->
</section>
<!-- ================================
    END FUNFACT AREA
================================= -->
<!-- ================================
       START TESTIMONIAL AREA
================================= -->
<section class="testimonial-area section-bg section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="section-heading">
                    <h2 class="sec__title line-height-50">What our customers are saying us?</h2>
                    <p class="sec__desc padding-top-30px">
                        Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero
                    </p>
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
    START INFO AREA
================================= -->
<section class="info-area padding-top-100px padding-bottom-60px text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="sec__title">Our Dedicated Team</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-100px">
        @foreach($memberData as $key => $data)
            <div class="col-lg-4 responsive-column">
                <div class="card-item team-card">
                    <div class="card-img">
                        <img src="{{$data->profile_pic}}" alt="team-img">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">{{$data->first_name}} {{$data->last_name}}</h3>
                        <p class="card-meta">{{$data->role}}</p>
                        @php
                        	$extra_infoArr=json_decode($data->common_data,true);
                        @endphp
                        <p class="card-text font-size-15 pt-2"><?php echo $extra_infoArr['about'] ?></p>
                        <ul class="social-profile padding-top-20px pb-2">
                            <li><a target="_blank" href="{{$extra_infoArr['fb_link']}}"><i class="lab la-facebook-f"></i></a></li>
                            <li><a target="_blank" href="{{$extra_infoArr['tw_link']}}"><i class="lab la-twitter"></i></a></li>
                            <li><a target="_blank" href="{{$extra_infoArr['insta_link']}}"><i class="lab la-instagram"></i></a></li>
                            <li><a target="_blank" href="{{$extra_infoArr['ld_link']}}"><i class="lab la-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div><!-- end card-item -->
            </div><!-- end col-lg-4 -->
        @endforeach    
           
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end info-area -->
<!-- ================================
    END INFO AREA
================================= -->
<!-- ================================
    START CTA AREA
================================= -->
<?php /*?><section class="cta-area cta-bg-2 bg-fixed section-padding text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="sec__title mb-3 text-white">Interested in a career <br> at Trizen.</h2>
                    <p class="sec__desc text-white">We’re always looking for talented individuals and
                        <br> people who are hungry to do great work.
                    </p>
                </div><!-- end section-heading -->
                <div class="btn-box padding-top-35px">
                    <a href="#" class="theme-btn border-0">Join Our Team</a>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><?php */?><!-- end cta-area -->
<!-- ================================
    END CTA AREA
================================= -->
@include('site.footer')