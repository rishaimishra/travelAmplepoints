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

.from_list, .to_list{
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

.from_list li, .to_list li{
    padding: 2px 40px;
}

.from_list li:hover, .to_list li:hover{
    background: #287dfa;
    color:#fff;
}


</style>

<?php 
      if(isset($_REQUEST['IATA_from'])) { $IATA_from=$_REQUEST['IATA_from']; }else{ $IATA_from='DEL'; } 
	  if(isset($_REQUEST['IATA_to'])) { $IATA_to=$_REQUEST['IATA_to']; }else{ $IATA_to='BOM'; }
	  if(isset($_REQUEST['origin'])) { $origin=$_REQUEST['origin']; }else{ $origin='Delhi, India'; }
	  if(isset($_REQUEST['destination'])) { $destination=$_REQUEST['destination']; }else{ $destination='Mumbai, India'; }  
	if(isset($_REQUEST['departure_date'])) { $departure_date=$_REQUEST['departure_date']; }else{ $departure_date=date('d/m/Y ', strtotime(date('m/d/Y').' +6 month')); }
	  if(isset($_REQUEST['return_date'])) { $return_date=$_REQUEST['return_date']; }else{ $return_date=date('d/m/Y ', strtotime(date('m/d/Y').' +7 month'));; }
	  
      if(isset($_REQUEST['adults'])) { $adults=$_REQUEST['adults']; }else{ $adults=1; }
      if(isset($_REQUEST['childs'])) { $childs=$_REQUEST['childs']; }else{ $childs=0; }   
	  if(isset($_REQUEST['infants'])) { $infants=$_REQUEST['infants']; }else{ $infants=0; }
	  if(isset($_REQUEST['flighttype'])) { $flighttype=$_REQUEST['flighttype']; }else{ $flighttype='round'; }
	   if(isset($_REQUEST['cabin_class'])) { $cabin_class=$_REQUEST['cabin_class']; }else{ $cabin_class='economy'; }  
	   if(isset($_REQUEST['direct'])) { $direct=$_REQUEST['direct']; }else{ $direct=''; }
											 ?>
	<div class="flighttab tab-pane fade show " id="flight" role="tabpanel" aria-labelledby="flight-tab">

                       <form method="get" id="frm" action="{{ asset('flight-search-results') }}"  >
                       @csrf
                            <div class="section-tab section-tab-2 pb-3">
                                <ul class="nav nav-tabs" id="myTab3" role="tablist">
                                    <li class="nav-item onewayradio" style="cursor: pointer;">
                                        <input type="radio" id="oneway" <?php if($flighttype=='oneway' || $flighttype==''){ echo "checked='checked'"; }?>  name="flighttype" value="oneway">
                                            One way
                                    </li>
                                    <li class="nav-item retirnradio" style="cursor: pointer;">
                                        <input  type="radio" id="round" <?php if($flighttype=='round'){ echo "checked='checked'"; }; ?> name="flighttype" value="round" >
                                            Round-trip
                                    </li>
                                    
                                     <li class="nav-item retirnradio" style="cursor: pointer;">
                                        <input  type="checkbox" id="direct" <?php if($direct=='direct'){ echo "checked='checked'"; }?> name="direct" value="direct" >
                                            Direct Flight
                                    </li>
                                    
                                    
                                    <!--<li class="nav-item">
                                        <a class="nav-link" id="multi-city-tab" data-toggle="tab" href="#multi-city" role="tab" aria-controls="multi-city" aria-selected="false">
                                            Multi-city
                                        </a>
                                    </li>-->
                                </ul>
                            </div><!-- end section-tab -->
                            <div class="tab-content" id="myTabContent3">
                                <div class="tab-pane fade show active" id="one-way" role="tabpanel" aria-labelledby="one-way-tab">
                                    <div class="contact-form-action">
                                        
                                        <div class="row align-items-center">
                                            <div class="col-lg-3 pr-0">
                                                <div class="input-box">
                                                    <label class="label-text">Flying from</label>
                                                    
                                                    <div class="form-group">
                                                        <span class="la la-map-marker form-icon">
                                                        </span>

                                              <input type="hidden" class="form-control autosuggestion" id="IATA_from" name="IATA_from" value="<?php echo $IATA_from;  ?>" >
                                                        <input type="text" class="form-control autosuggestion an-from" id="autosuggestion_from" fly="from" name="origin" placeholder="City or airport" value="<?php echo $origin; ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="input-box from_list" style="display:none"></div>
                                            </div><!-- end col-lg-3 -->
                                            <div class="col-lg-3">
                                                <div class="input-box">
                                                    <label class="label-text">Flying to</label>
                                                    <div class="form-group">
                                                        
                                                        <span class="la la-map-marker form-icon">
                                                        </span>
                                                        
                                                <input type="hidden" class="form-control autosuggestion" id="IATA_to" name="IATA_to"  value="<?php echo $IATA_to; ?>">
                                                        <input type="text" class="form-control autosuggestion an-to" id="autosuggestion_to" fly="to" name="destination"  placeholder="City or airport" value="<?php echo $destination;  ?>"  autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="input-box to_list" style="display:none"></div>
                                            </div><!-- end col-lg-3 -->
                                           
                                            <div class="col-lg-2 pr-0">
                                                <div class="input-box">
                                                    <label class="label-text">Departing</label>
                                                    <div class="form-group">
                                                        
                                                        <span class="la la-calendar form-icon">
                                                        </span>
                                       <input class="date-picker-single form-control" onchange="set_returnDate1()" id="departure_date" type="text" name="departure_date" value="<?php echo $departure_date; ?>" readonly>
                                       
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-3 -->
                                            <div class="col-lg-2 pr-0 round_trip"  id="round_trip" <?php if($flighttype=='oneway' || $flighttype==''){ echo 'style="display:none"'; } ?> >
                                                <div class="input-box">
                                                    <label class="label-text">Return</label>
                                                    <div class="form-group">
                                                        <span class="la la-calendar form-icon">
                                                        </span>
                                        <input class="date-picker-single form-control" id="return_date" type="text" name="return_date" value="<?php echo $return_date; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 pr-0">
                                                <div class="input-box">
                                                    <label class="label-text">Traveller</label>
                                           			<div class="input-box">
                                                    <!--<label class="label-text">Passengers</label>-->
                                                    <div class="form-group">
                                                        <div class="dropdown dropdown-contain gty-container">
                                                            <a class="dropdown-toggle dropdown-btn" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="adult" data-text="Adult" data-text-multi="Adults"><span class="adults">{{$adults}}</span> Adult(s)</span>
                                                                -
                                                                <span class="children" data-text="Child" data-text-multi="Children"><span class="childs">{{$childs}}</span> Children</span>
                                                                -
                                                                <span class="children" data-text="infants" data-text-multi="infants"><span class="infants">{{$infants}}</span> Infant(s)</span>
                                                            </a>
                                                    <div class="dropdown-menu dropdown-menu-wrap">
                                                        <div class="dropdown-item">
                                                            <div class="qty-box d-flex align-items-center justify-content-between">
                                                                <label><b>Adult(s)</b></label>
                                                                <div class="qtyBtn d-flex align-items-center">
                                                                    <div class="qtyDec"><i class="la la-minus"></i></div>
                                      <input type="numbar" onchange="managePax('adults')" name="adults" id="adults" min="1" max="4" value="{{$adults}}" class="qty-input">
                                                                    <div class="qtyInc"><i class="la la-plus"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-item">
                                                            <div class="qty-box d-flex align-items-center justify-content-between">
                                                                <label><b>Children</b></label>
                                                                <div class="qtyBtn d-flex align-items-center">
                                                                    <div class="qtyDec"><i class="la la-minus"></i></div>
                                      <input type="numbar" onchange="managePax('childs')" name="childs" id="childs" min="0" max="4" value="{{$childs}}" class="qty-input">
                                                                    <div class="qtyInc"><i class="la la-plus"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-item">
                                                            <div class="qty-box d-flex align-items-center justify-content-between">
                                                                <label><b>Infant(s)</b></label>
                                                                <div class="qtyBtn d-flex align-items-center">
                                                                    <div class="qtyDec"><i class="la la-minus"></i></div>
                                   <input type="numbar"  onchange="managePax('infants')" name="infants" id="infants" min="0" max="4" value="{{$infants}}" class="qty-input">
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
                                                </div>
                                             </div>
                                            
                                            <!-- end col-lg-3 -->
                                            <div class="col-lg-2 pr-0">
                                                <div class="input-box">
                                                    <label class="label-text">Coach</label>
                                                    <div class="form-group">
                                                    <select class="form-control" name="cabin_class">
                                                                <option <?php if($cabin_class=='economy'){ echo "selected"; }?> value="economy" >Economy</option>
                                                                <option <?php if($cabin_class=='premium'){ echo "selected"; }?> value="premium">Premium</option>
                                                                <option <?php if($cabin_class=='firstclass'){ echo "selected"; }?>value="firstclass">First Class</option>
                                                                
                                                    </select>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-3 -->
                                            <div class="col-lg-2">
                                                <input type="submit" class="theme-btn w-100 text-center margin-top-20px Search_Now" value="Search Now">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div><!-- end tab-pane -->
                            </div>
                        </form>    
                            
    </div><!-- end tab-pane -->
                        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
                                <script type="text/javascript">
	  jQuery(".common_beard_comb").hide();

      jQuery(document).ready(function(){
	  			jQuery(".onewayradio").click(function(){ 
					jQuery("#oneway").prop('checked', true);
					jQuery(".round_trip").hide();
				});
				jQuery(".retirnradio").click(function(){
				    jQuery("#round").prop('checked', true);
					jQuery(".round_trip").show();
				});
	  
	          jQuery('.autosuggestion').keyup(function (e) {
					 
					 var type= jQuery(this).attr('fly');
					  
					  term=jQuery(this).val();
					  
					  console.log("type=="+type); 
					   /*return xhr=$http.get('https://www.jetradar.com/autocomplete/places',*/
					   
					   $.ajax({
					   			url:'<?php url(''); ?>/get_flights_locations',
								type: "GET",
								data: {
								    _token:"{{csrf_token()}}",
									locale: "en",
									max: "7",
									limit: "5",
									term: term
								},
								dataType: "json",
								success: function (data) {
									
									
									var innerHtml='</ul>';
									
									for(var i=0;i<data.length;i++){
										var name=data[i].name+", "+data[i].country_code+" ("+data[i].code+")"; 
										var IATA=data[i].code;
									 innerHtml +='<li  class="iataAKM" IATA="'+IATA+'" name="'+name+'" type="'+type+'" style="cursor: pointer;">'+name+'</li>';
									}
									 innerHtml +='</ul>';
									 
									jQuery('.'+type+'_list').html(innerHtml);
									iata();
									jQuery('.'+type+'_list').show();
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							});
							

					 
					   
       		 });
			
			 function iata() {  
					 jQuery(".iataAKM").click(function(){
							var IATA= jQuery(this).attr('IATA');
							var type= jQuery(this).attr('type');
							var name= jQuery(this).attr('name');
							document.getElementById("IATA_"+type).value = IATA;
							document.getElementById("autosuggestion_"+type).value = name;
							jQuery('.'+type+'_list').hide();
					  });
			   }
			   
			 
		
			   			/* $.ajax({
								url:'https://travelsdev.plistbooking.com/travel/apiflight_update_rates.php',
								type: "GET",
								data: {
									action: "findSearchKey",
									origin: "DEL",
									destination: "BOM",
									departure_date: "findSearchKey",
									return_date: "2022-05-06",
									return_date: "2022-05-16",
									isReturn: "Yes",
									isDomestic: "Yes",
								},
								dataType: "json",
								success: function (data) {
								console.log(data);
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							});*/
		
      });
	   function set_returnDate1(){  
			 		var departure_date = document.getElementById("departure_date").value;
					 myArray = departure_date.split("/");  
					 date=parseInt(myArray[0])+1;
  					var  newdate=date+'/'+myArray[1]+"/"+myArray[2]; 
					 document.getElementById("return_date").value = newdate;
					 
					 var  newdate2=myArray[2]+'-'+myArray[1]+"-"+date; 
						$("#return_date").daterangepicker({ 
							singleDatePicker: true,
							opens: 'right',
							minDate:new Date(newdate2),
							locale: {
								format: 'DD/MM/YYYY',
							}
						});
			
			   }
	  
	   //function myFunction(){ alert("call"); }   onclick="myFunction()"
	   

	  
      </script>
      
