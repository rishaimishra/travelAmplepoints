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
         




<section class="faq-area section-bg padding-top-100px padding-bottom-60px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title">Frequently Asked Questions</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-60px">
        
            <div class="col-lg-6">
                <div class="faq-item mb-5">
                    <h1 class="title font-weight-bold" style="color:#FF0000"><b>Cancellations</b></h1>
                    <ul class="toggle-menu list-items list-items-flush pt-4">
                    @foreach($faqData as $key => $data)
                        <li>
                            <a href="#" class="toggle-menu-icon d-flex justify-content-between align-items-center">
                                <?php echo $data->question; ?>
                                <i class="la la-angle-down"></i>
                            </a>
                            <ul class="toggle-drop-menu pt-2">
                                <li class="line-height-26"><?php echo $data->answer; ?></li>
                            </ul>
                        </li>
                    @endforeach
                    </ul>
                </div><!-- end faq-item -->
            </div><!-- end col-lg-6 -->
             
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<section class="cta-area cta-bg-2 bg-fixed padding-top-60px padding-bottom-60px">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="section-heading">
                    <h2 class="sec__title font-size-30 text-white">Couldn't Find a Solution?</h2>
                    <p class="sec__desc text-white pt-1">Submit a ticket to our support desk.</p>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-7 -->
            <div class="col-lg-5">
                <div class="btn-box btn--box text-right">
                    <a href="{{ asset('support')}}" class="theme-btn border-0">Submit a Ticket</a>
                </div><!-- end btn-box -->
            </div><!-- end col-lg-5 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>


@include('site.footer')

