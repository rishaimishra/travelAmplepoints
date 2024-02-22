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
    START CONTACT AREA
================================= -->
    
    <section class="job-area section-padding" id="job-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <p class="sec__desc pb-2">Open Positions</p>
                    <h2 class="sec__title">Let's Make Something <br> Awesome Together</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-60px">
        @foreach($jobData as $key => $data)
            <div class="col-lg-4">
                <div class="deal-card">
                    <div class="deal-title">
                        <h3 class="deal__title font-size-24">
                            <a href="job-details"><?php echo $data->name; ?></a>
                        </h3>
                    </div>
                    <p class="deal__meta pl-0 font-weight-regular font-size-15"><?php echo $data->location; ?></p>
                    <div class="deal-action-box pt-2">
                        <a href="{{ asset('job-details') }}/{{$data->id}}" class="btn-text">Read More<i class="la la-arrow-right ml-1"></i></a>
                    </div>
                </div><!-- end deal-card -->
            </div><!-- end col-lg-4 -->
        @endforeach
        </div><!-- end row -->
        <div class="row padding-top-100px">
            <div class="col-lg-12">
                <div class="discount-box">
                    <div class="discount-img">
                        <img src="images/discount-hotel-img.jpg" alt="discount img">
                    </div><!-- end discount-img -->
                    <div class="discount-content">
                        <div class="section-heading">
                            <h2 class="sec__title line-height-50 text-white">Didn't find the perfect <br> role for you?</h2>
                            <p class="sec__desc text-white pt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. exercitationem.</p>
                        </div><!-- end section-heading -->
                        <div class="btn-box pt-4">
                            <a href="contact.html" class="theme-btn border-0">Apply Here <i class="la la-arrow-right ml-1"></i></a>
                        </div>
                    </div><!-- end discount-content -->
                </div>
            </div><!-- end col-lg-12 -->
        </div>
    </div><!-- end container -->
</section>
    <!-- ================================
    END CONTACT AREA
================================= -->
@include('site.footer')

