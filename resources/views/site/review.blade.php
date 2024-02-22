@include('site.header')
@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
      
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                               
         @endphp
<!-- ================================
    START INFO AREA
================================= -->





<!-- ================================
       START TESTIMONIAL AREA
================================= -->
<section class="testimonial-area section-bg section-padding">
    <div class="container">
        <div class="row align-items-center">
            <!-- end col-lg-4 -->
            
                   @foreach($reviewData as $key => $data)
                   <div class="col-lg-4" style="margin-top:20px">
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
                                @for($i=0;$i<$data->rating;$i++)
                                    <i class="la la-star"></i>
                                @endfor
                                </span>
                            </div>
                        </div>
                    </div><!-- end testimonial-card -->
                    </div><!-- end col-lg-4 -->
                	@endforeach
                <!-- end testimonial-carousel -->
            
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end testimonial-area -->
<!-- ================================
       START TESTIMONIAL AREA
================================= -->


@include('site.footer')