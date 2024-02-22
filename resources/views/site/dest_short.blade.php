

@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
      
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                $currency=$data['siteData']['currency']; 
                $currency_symbol=$data['siteData']['currency_symbol']; 
                
                $dest=json_decode($siteData1::GetDest(5),true); 
                
    $Africa = $dest['Africa'];
	$Asia = $dest['Asia'];
	$Europe = $dest['Europe'];
	$North_America = $dest['North_America'];
	$South_America = $dest['South_America'];
	$Oceania = $dest['Oceania'];
	$Antarctica = $dest['Antarctica'];
         @endphp
<!-- ================================
       START FOOTER AREA
================================= -->
<section class="faq-area section-bg padding-top-100px padding-bottom-60px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title">Cheap flights from Nigeria</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-60px">
            <div class="col-lg-3">
                <div class="faq-item mb-5">
                    <h3 class="title font-weight-bold">African Flights</h3>
                    <ul class="toggle-menu list-items list-items-flush pt-4">
                      @for($i=0;$i<count($Africa);$i++)
                        <li>
                            <a href="{{url('')}}/en/{{$Africa[$i]['countryUrl']}}/{{$Africa[$i]['cityUrl']}}/flights" class="">
                             Flight to  <?php echo $Africa[$i]['city_name']; ?>
                            </a>
                        </li>
                       @endfor
                    </ul>
                </div><!-- end faq-item -->
            </div>
            <div class="col-lg-3">
                <div class="faq-item mb-5">
                    <h3 class="title font-weight-bold">European Flights Flights</h3>
                     <ul class="toggle-menu list-items list-items-flush pt-4">
                      @for($i=0;$i<count($Europe);$i++)
                        <li>
                            <a href="{{url('')}}/en/{{$Europe[$i]['countryUrl']}}/{{$Europe[$i]['cityUrl']}}/flights" class="">
                             Flight to  <?php echo $Europe[$i]['city_name']; ?>
                            </a>
                        </li>
                       @endfor
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="faq-item mb-5">
                    <h3 class="title font-weight-bold">Asian Flights</h3>
                     <ul class="toggle-menu list-items list-items-flush pt-4">
                      
                       @for($i=0;$i<count($Asia);$i++)
                        <li>
                            <a href="{{url('')}}/en/{{$Asia[$i]['countryUrl']}}/{{$Asia[$i]['cityUrl']}}/flights" class="">
                             Flight to  <?php echo $Asia[$i]['city_name']; ?>
                            </a>
                        </li>
                       @endfor
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="faq-item mb-5">
                    <h3 class="title font-weight-bold">North American Flights</h3>
                     <ul class="toggle-menu list-items list-items-flush pt-4">
                      
                       @for($i=0;$i<count($North_America);$i++)
                        <li>
                            <a href="{{url('')}}/en/{{$North_America[$i]['countryUrl']}}/{{$North_America[$i]['cityUrl']}}/flights" class="">
                             Flight to  <?php echo $North_America[$i]['city_name']; ?>
                            </a>
                        </li>
                       @endfor
                    </ul>
                </div>
            </div>
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title">Cheap hotels in popular destinations</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-60px">
            <div class="col-lg-3">
                <div class="faq-item mb-5">
                    <h3 class="title font-weight-bold">African Hotels</h3>
                    <ul class="toggle-menu list-items list-items-flush pt-4">
                      @for($i=0;$i<count($Africa);$i++)

                        <li>
                            <a href="{{url('')}}/en/{{$Africa[$i]['countryUrl']}}/{{$Africa[$i]['cityUrl']}}/hotels" class="">
                             Hotels in  <?php echo $Africa[$i]['city_name']; ?>
                            </a>
                        </li>
                       @endfor
                    </ul>
                </div><!-- end faq-item -->
            </div>
            <div class="col-lg-3">
                <div class="faq-item mb-5">
                    <h3 class="title font-weight-bold">European Hotels </h3>
                     <ul class="toggle-menu list-items list-items-flush pt-4">
                      @for($i=0;$i<count($Europe);$i++)
                        <li>
                            <a href="{{url('')}}/en/{{$Europe[$i]['countryUrl']}}/{{$Europe[$i]['cityUrl']}}/hotels" class="">
                             Hotels in  <?php echo $Europe[$i]['city_name']; ?>
                            </a>
                        </li>
                       @endfor
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="faq-item mb-5">
                    <h3 class="title font-weight-bold">Asian Hotels</h3>
                     <ul class="toggle-menu list-items list-items-flush pt-4">
                      
                       @for($i=0;$i<count($Asia);$i++)
                        <li>
                            <a href="{{url('')}}/en/{{$Asia[$i]['countryUrl']}}/{{$Asia[$i]['cityUrl']}}/hotels" class="">
                             Hotels in  <?php echo $Asia[$i]['city_name']; ?>
                            </a>
                        </li>
                       @endfor
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="faq-item mb-5">
                    <h3 class="title font-weight-bold">North American Hotels</h3>
                     <ul class="toggle-menu list-items list-items-flush pt-4">
                      
                       @for($i=0;$i<count($North_America);$i++)
                        <li>
                            <a href="{{url('')}}/en/{{$North_America[$i]['countryUrl']}}/{{$North_America[$i]['cityUrl']}}/hotels" class="">
                             Hotels in  <?php echo $North_America[$i]['city_name']; ?>
                            </a>
                        </li>
                       @endfor
                    </ul>
                </div>
            </div>
        </div><!-- end row -->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title">Cheap tours in popular destinations</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-60px">
            <div class="col-lg-3">
                <div class="faq-item mb-5">
                    <h3 class="title font-weight-bold">African Tours</h3>
                    <ul class="toggle-menu list-items list-items-flush pt-4">
                      @for($i=0;$i<count($Africa);$i++)
                        <li>
                            <a href="{{url('')}}/en/{{$Africa[$i]['countryUrl']}}/{{$Africa[$i]['cityUrl']}}/tours" class="">
                             Tours in  <?php echo $Africa[$i]['city_name']; ?>
                            </a>
                        </li>
                       @endfor
                    </ul>
                </div><!-- end faq-item -->
            </div>
            <div class="col-lg-3">
                <div class="faq-item mb-5">
                    <h3 class="title font-weight-bold">European Tours </h3>
                     <ul class="toggle-menu list-items list-items-flush pt-4">
                      @for($i=0;$i<count($Europe);$i++)
                        <li>
                            <a href="{{url('')}}/en/{{$Europe[$i]['countryUrl']}}/{{$Europe[$i]['cityUrl']}}/tours" class="">
                             Tours in  <?php echo $Europe[$i]['city_name']; ?>
                            </a>
                        </li>
                       @endfor
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="faq-item mb-5">
                    <h3 class="title font-weight-bold">Asian Tours</h3>
                     <ul class="toggle-menu list-items list-items-flush pt-4">
                      
                       @for($i=0;$i<count($Asia);$i++)
                        <li>
                            <a href="{{url('')}}/en/{{$Asia[$i]['countryUrl']}}/{{$Asia[$i]['cityUrl']}}/tours" class="">
                             Tours in  <?php echo $Asia[$i]['city_name']; ?>
                            </a>
                        </li>
                       @endfor
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="faq-item mb-5">
                    <h3 class="title font-weight-bold">North American Tours</h3>
                     <ul class="toggle-menu list-items list-items-flush pt-4">
                      
                       @for($i=0;$i<count($North_America);$i++)
                        <li>
                            <a href="{{url('')}}/en/{{$North_America[$i]['countryUrl']}}/{{$North_America[$i]['cityUrl']}}/tours" class="">
                             Tours in  <?php echo $North_America[$i]['city_name']; ?>
                            </a>
                        </li>
                       @endfor
                    </ul>
                </div>
            </div>
        </div><!-- end row -->
        
    </div><!-- end container -->
</section>