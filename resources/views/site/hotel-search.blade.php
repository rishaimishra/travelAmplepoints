@include('site.header')

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
<section class="hero-wrapper hero-wrapper6">
     <div  @if($device=='Desktop') style="padding-top: 100px;padding-bottom: 100px;background:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.5)),url({{$pageData->image}});background-size: cover;" @endif>        
        <div class="container">
            <div class="row" @if($device!='Desktop') style="display:none" @endif >
                <div class="col-lg-12">
                    <div class="hero-content">
                        <div class="section-heading">
                            <h2 class="sec__title cd-headline slide d-flex align-items-center">
                                It's the Time to
                                <span class="cd-words-wrapper pl-2">
                                <b class="is-visible">discover</b>
                                <b>fly far</b>
                                <b>explore</b>
                                <b>travel</b>
                                <b>meet</b>
                                <b>have fun</b>
                                <b>run away</b>
                                <b>rejuvenate</b>
                                <b>live</b>
                                <b>relax</b>
                                <b>enjoy life</b>
                                </span>
                            </h2>
                        </div>
                    </div><!-- end hero-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
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

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript">
		  jQuery(document).ready(function(){
		  checkPosition();
			jQuery("#hotel").show();
			jQuery(".common_beard_comb").hide();
		  });
	   </script>
@include('site.footer')



