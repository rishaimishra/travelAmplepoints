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
         
         <style>
             #loadingModal2{background:#fff!important;color:#111;padding:0!important;height:auto!important;width:600px;max-width:500px;z-index:999999}#loadingModal2 p#timeline2,#loadingModal2 .div-title{color:#111}#loadingModal2{padding:0!important;height:auto;overflow:hidden;width:100%;max-width:600px!important}#loadingModal2 .modal-content2{padding:0!important;border:1px solid #00000033;box-shadow:0 0 10px -5px #000;width:100%}#loadingModal2 .div-title{font-size:28px;padding:9px 0 9px;border-bottom:1px solid #00000030;line-height:40px;font-weight:500}#loadingModal2 .modal-c-body{padding:10px 10px 10px}#loadingModal2 .c-l-middle-main{position:relative;height:100px}#loadingModal2 .modal-c-footer{display:flex;align-items:center;justify-content:center;background:#fff;color:#000000c2;padding:8px 10px 8px}@media only screen and (max-width:600px){#loadingModal2{max-width:400px!important}}
         </style>
<section class="hero-wrapper hero-wrapper6" >
	
    <div @if($device=='Desktop') style="padding-top: 100px;padding-bottom: 100px;background:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.5)),url({{$pageData->image}});background-size: cover;" @endif >
 
        <div  class="container">
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
                            @include('flight.flight-search-box')<!-- end tab-pane -->
                        </div>
                    </div><!-- end main-search-input -->
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div>
</section>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript">

		  jQuery(document).ready(function(){
		  jQuery(".flighttab").addClass('active');
		  checkPosition();
			jQuery("#flight").show();
			jQuery(".common_beard_comb").hide();
		  });
	  </script>

@include('site.footer')







