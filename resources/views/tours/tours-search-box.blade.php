<style>
.an-from, .an-to{
    position: relative;
}
.an-plane-from{
    transform: rotate(45deg);
}
.an-plane-to{
    transform: rotate(135deg);
}
.hotel_list {
    border: 1px solid #287dfa;
    position: absolute;
    top: 90px;
    background: rgb(255, 255, 255);
    z-index: 2;
    font-size: 13px;
    color: rgb(13, 35, 62);
    text-decoration: none;
    list-style-type: none;
    width: 97%;
    border-radius: 4px;
    /* padding: 0 40px; */
}
.form-icon{
    z-index: 1;
}
.hotel_list li{
    padding: 2px 40px;
}
.hotel_list li:hover, .to_list li:hover{
    background: #287dfa;
    color:#fff;
}
</style>
<?php 
      if(isset($_REQUEST['city_code'])) { $city_code=$_REQUEST['city_code']; }else{ $city_code='DEL'; } 
	  if(isset($_REQUEST['city_name'])) { $city_name=$_REQUEST['city_name']; }else{ $city_name='Delhi and NCR, India'; }
	  if(isset($_REQUEST['travel_date'])) { $travel_date=$_REQUEST['travel_date']; }else{ $travel_date=date('d/m/Y ', strtotime(date('m/d/Y').' +3 day')); }
      if(isset($_REQUEST['adult'])) { $adults=$_REQUEST['adults']; }else{ $adults=1; }
      if(isset($_REQUEST['childs'])) { $childs=$_REQUEST['childs']; }else{ $childs=0; }   
?>
<div class="activitytab tab-pane fade show" id="tour" role="tabpanel" aria-labelledby="tour-tab">
                            <div class="contact-form-action">
                                <form method="get" action="{{ asset('tours-search-results') }}" class="row align-items-center">
                                @csrf
                                    <div class="col-lg-3 pr-0">
                                        <div class="input-box">
                                            <label class="label-text">Destination </label>
                                            <div class="form-group">
                                                <span class="la la-map-marker form-icon">
                                                </span>
                                                <input class="form-control autosuggestion_tours" name="city_code" id="city_code_tour" type="hidden" value="<?php echo $city_code;  ?>" >
                                                <input class="form-control autosuggestion_tours"  name="city_name" id="city_name_tour" type="text" value="<?php echo $city_name;  ?>" placeholder="Enter city or property" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="input-box hotel_list" style="display:none"></div>
                                    </div><!-- end col-lg-3 -->

                                    <div class="col-lg-3 pr-0">
                                        <div class="input-box">
                                            <label class="label-text">Travel Date</label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon">
                                                </span>
                                                <input class="date-picker-single form-control" id="travel_date" name="travel_date" value="<?php echo $travel_date;  ?>" type="text"  readonly>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-3 -->
                                    <div class="col-lg-3 pr-0">
                                                <div class="input-box">
                                                    <label class="label-text">Passengers</label>
                                                    <div class="form-group">
                                                        <div class="dropdown dropdown-contain gty-container">
                                                            <a class="dropdown-toggle dropdown-btn" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                                 <span class="adult" data-text="Adult" data-text-multi="Adults"><span class="adultsA">{{$adults}}</span> Adult(s)</span>
                                                                -
                                                                 <span class="children" data-text="Child" data-text-multi="Children"><span class="childsA">{{$childs}}</span> Children</span>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-wrap">
                                                        <div class="dropdown-item">
                                                            <div class="qty-box d-flex align-items-center justify-content-between">
                                                                <label><b>Adult(s)</b></label>
                                                                <div class="qtyBtn d-flex align-items-center">
                                                                    <div class="qtyDec"><i class="la la-minus"></i></div>
                                      <input type="numbar" onchange="managePax('adultsA')" name="adults" id="adultsA" min="1" max="4" value="{{$adults}}" class="qty-input">
                                                                    <div class="qtyInc"><i class="la la-plus"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-item">
                                                            <div class="qty-box d-flex align-items-center justify-content-between">
                                                                <label><b>Children</b></label>
                                                                <div class="qtyBtn d-flex align-items-center">
                                                                    <div class="qtyDec"><i class="la la-minus"></i></div>
                                      <input type="numbar" onchange="managePax('childsA')" name="childs" id="childsA" min="0" max="4" value="{{$childs}}" class="qty-input">
                                                                    <div class="qtyInc"><i class="la la-plus"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="dropdown-item">
                                                        <div class="hidefun" onclick="hidefun()">OK</div>
                                                        </div>
                                                    </div>
                                                        </div><!-- end dropdown -->
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-3 -->

                                     <div class="col-lg-3">

                                                <input type="submit" class="theme-btn w-100 text-center margin-top-20px Search_Now" value="Search Now">

                                     </div>

                                </form>

                            </div>
 </div>
                        
                        <!---->
                        
                       
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript">
					 
        	 jQuery(document).ready(function(){	 
	         jQuery('.autosuggestion_tours').keyup(function (e) {
					  term=jQuery(this).val();
					   $.ajax({
								url: '<?php url('');?>/getLocations',
								type: "GET",
								data: {
									action:"getLocations",	
									lang: 'en',
									limit: "5",
									term: term
								},
								dataType: "json",
								success: function (data) { //var data=data.zonegroup;
									var innerHtml='</ul>';
									for(var i=0;i<data.length;i++){
										destinationName=data[i].city_name+", "+data[i].countryName; 
				                        innerHtml +='<li  class="iataAKM" destinationCode="'+data[i].city_code+'" destinationName="'+destinationName+'" style="cursor: pointer;">'+destinationName+'</li>';
									}
									 innerHtml +='</ul>';
									 
									jQuery('.hotel_list').html(innerHtml);
									iata();
									jQuery('.hotel_list').show();
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							});
       		 });
		
			 function iata() {  
					 jQuery(".iataAKM").click(function(){
							var destinationCode= jQuery(this).attr('destinationCode');
							var destinationName= jQuery(this).attr('destinationName');  
							document.getElementById("city_code_tour").value = destinationCode;
							document.getElementById("city_name_tour").value = destinationName;
							jQuery('.hotel_list').hide();
					  });
			   }
      });	  
</script>               
                                