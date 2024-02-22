
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
                       <h3 class="card-title"><a href="{{ asset($fd->page_id) }}"><?php echo $fd->city_from; ?> 
									<i class="{{$arrow}}"></i> <?php echo $fd->city_to; ?></a></h3>
                       <p class="card-meta">{{$fromDate}} @if($oc['flight_type']=='return')- {{$toDate}} @endif </p>
                       <div class="card-price d-flex align-items-center justify-content-between">
                           <p>
                               <span class="price__from">From</span>
                               <span class="price__num"><?php echo $currency_symbol." ".$provider::convertCurrencyRateFlight($oc['currency'],$oc['price']);?></span>
                           </p>
                           <a href="{{ asset($fd->page_id) }}" class="btn-text">Read details<i class="la la-angle-right"></i></a>
                       </div>
                   </div>
               </div>
           </div>
           
           <?php } ?>
           
        </div><!-- end row -->
    </div><!-- end container -->
</section>
  @endif


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
jQuery(".common_beard_comb").hide(); 
var innerHtml=''; var page=0; var search_session='';

      jQuery(document).ready(function(){
	  	
		<?php $departure_date=date('d/m/Y ', strtotime(date('m/d/Y').' +6 month')); ?>
			   			 $.ajax({
								url:'<?php url(''); ?>/flightsearchresults',
								type: "get",
								data: {
								    _token:"{{csrf_token()}}",
									action: "flight-search-results",
									flighttype: "<?php echo $_REQUEST['flighttype']; ?>",
									origin: "<?php echo $_REQUEST['origin']; ?>",  
									destination: "<?php echo $_REQUEST['destination']; ?>",
									IATA_from: "<?php echo $_REQUEST['IATA_from']; ?>",  
									IATA_to: "<?php echo $_REQUEST['IATA_to']; ?>",
									departure_date: "<?php $departure_date; ?>",
									return_date: "",
									adults: "1",
									childs: "0",
									infants: "0",
									cabin_class: "economy",  
									user_id: "",
									rand: "<?php echo rand(); ?>",
									isDomestic: "No",
								},
								dataType: "json",
								success: function (data) {
								console.log(data);
																
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							});
							Show_Search();	
							
						 
      });	   
	  			   function Show_Search()
					{
						$.ajax({
								url:'<?php url(''); ?>/flight-search-results2',
								type: "get",
								data: {
								    _token:"{{csrf_token()}}",
									action: "findSearchKey",
									flighttype: "<?php echo $_REQUEST['flighttype']; ?>",
									origin: "<?php echo $_REQUEST['origin']; ?>",  
									destination: "<?php echo $_REQUEST['destination']; ?>",
									IATA_from: "<?php echo $_REQUEST['IATA_from']; ?>",  
								},
								dataType: "json",
								success: function (data) {
								
								}
							});
					}					
      </script>

</div>
