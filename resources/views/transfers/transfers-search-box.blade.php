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
.transfer_list {
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
.transfer_list li{
    padding: 2px 40px;
}
.transfer_list li:hover, .to_list li:hover{
    background: #287dfa;
    color:#fff;
}
</style>


<?php 
      if(isset($_REQUEST['city_code'])) { $city_code=$_REQUEST['city_code']; }else{ $city_code='DEL'; } 
	  if(isset($_REQUEST['city_name'])) { $city_name=$_REQUEST['city_name']; }else{ $city_name='Delhi and NCR, India'; }
	  if(isset($_REQUEST['pick_date'])) { $pick_date=$_REQUEST['pick_date']; }else{ $pick_date=date('d/m/Y ', strtotime(date('m/d/Y').' +3 day')); }
	  if(isset($_REQUEST['pick_time'])) { $pick_time=$_REQUEST['pick_time']; }else{ $pick_time='10:00'; }
	  
	  if(isset($_REQUEST['return_date'])) { $return_date=$_REQUEST['return_date']; }else{ $return_date=date('d/m/Y ', strtotime(date('m/d/Y').' +6 day')); }
	  if(isset($_REQUEST['return_time'])) { $return_time=$_REQUEST['return_time']; }else{ $return_time='11:00'; }
	  
      if(isset($_REQUEST['adult'])) { $adults=$_REQUEST['adults']; }else{ $adults=1; }
      if(isset($_REQUEST['childs'])) { $childs=$_REQUEST['childs']; }else{ $childs=0; }   $countryCode='IN'; 
	  if(isset($_REQUEST['infants'])) { $infants=$_REQUEST['infants']; }else{ $infants=0; }
	  
	  if(isset($_REQUEST['transfertype'])) { $transfertype=$_REQUEST['transfertype']; }else{ $transfertype='round'; }
	  
	  $timeArr=array("00:00","00:30","01:00","01:30","02:00","02:30","03:00","03:30","04:00","04:30","05:00","05:30","06:00","06:30","07:00","07:30","08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30","17:00","17:30","18:00","18:30","19:00","19:30","20:00","20:30","21:00","21:30","22:00","22:30","23:00","23:30");
	  
?>
<div class="transferstab tab-pane fade show" id="car" role="tabpanel" aria-labelledby="car-tab">
                                <div class="contact-form-action">
                                    <form method="get" action="{{ asset('transfers-search-results') }}" class="row align-items-center">
                                    @csrf
                                    <div class="section-tab section-tab-2 pb-3 col-lg-12">
                                        <ul class="nav nav-tabs" id="myTab3" role="tablist">
                                            <li class="nav-item onewayradio" style="cursor: pointer;">
                                                <input type="radio" id="oneway" <?php if($transfertype=='oneway' || $transfertype==''){ echo "checked='checked'"; }?>  name="transfertype" value="oneway">
                                                    One way
                                            </li>
                                            <li class="nav-item retirnradio" style="cursor: pointer;">
                                                <input type="radio" id="round" <?php if($transfertype=='round'){ echo "checked='checked'"; }; ?> name="transfertype" value="round" >
                                                    Round-trip
                                            </li>
                                         </ul>
                               	 </div>
                                    <div class="col-lg-4 pr-0">
                                        <div class="input-box">
                                            <label class="label-text">Destination </label>
                                            <div class="form-group">
                                                <span class="la la-map-marker form-icon">
                                                </span>
                                                <input class="form-control autosuggestion_transfer" name="city_code" id="city_code_transfer" type="hidden" value="<?php echo $city_code;  ?>" >
                                                 <input class="form-control autosuggestion_transfer" name="countryCode" id="countryCode_transfer" type="hidden" value="<?php echo $countryCode;  ?>" >
                                                <input class="form-control autosuggestion_transfer"  name="city_name" id="city_name_transfer" type="text" value="<?php echo $city_name;  ?>" placeholder="Enter city or property" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="input-box transfer_list" style="display:none"></div>
                                    </div>                                        
                                    
                                        <div class="col-lg-2">
                                            <div class="input-box">
                                                <label class="label-text">Pick Up</label>
                                                <div class="form-group">
                                                 
                                                
                                                    <div class="select-contain w-auto">
                                                        <select class="select-contain-select" id="pick" name="pick_type" onchange="selectsTypes('pick')">
                                                            <option value="IATA">Airport</option>
                                                            <option value="ATLAS">Accommodation</option>
                                                            <option value="STATION">Train Station</option>
                                                            <option value="PORT">Port </option>                                                        
                                                         </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="input-box">
                                                <label class="label-text"><span class="pick">Airport<span></label>
                                                <div class="form-group">
                                                    <div class="select-contain w-auto" id="pickOption">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="col-lg-2">
                                            <div class="input-box">
                                                <label class="label-text">Drop Off</label>
                                                <div class="form-group">
                                                    <div class="select-contain w-auto">
                                                        <select class="select-contain-select" id="drop" name="drop_type" onchange="selectsTypes('drop')">
                                                        	<option value="ATLAS">Accommodation</option>
                                                            <option value="IATA">Airport</option>
                                                            <option value="STATION">Train Station</option>
                                                            <option value="PORT">Port </option>                                                        
                                                         </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="input-box">
                                                <label class="label-text"><span class="drop">Accommodation</span></label>
                                                <div class="form-group">
                                                    <div class="select-contain w-auto" id="dropOption">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2 pr-0">
                                            <div class="input-box">
                                                <label class="label-text">Pick-up date</label>
                                                <div class="form-group">
                                                    <span class="la la-calendar form-icon">
                                                    </span>
                                                    <input class="date-picker-single form-control" type="text" value="{{$pick_date}}" name="pick_date" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="input-box">
                                                <label class="label-text">Pick-up Time</label>
                                                <div class="form-group">
                                                    <div class="select-contain w-auto">
                                                        <select class="select-contain-select" name="pick_time">
                                                          @foreach($timeArr as $t)
                                                          <option @if($pick_time==$t) selected @endif value="{{$t}}" >{{$t}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                         
                                        <div class="col-lg-2 round_trip pr-0" id="round_trip"<?php if($transfertype=='oneway' || $transfertype==''){ echo 'style="display:none"'; } ?> >
                                            <div class="input-box">
                                                <label class="label-text">Return Date</label>
                                                <div class="form-group">
                                                    <span class="la la-calendar form-icon">
                                                    </span>
                                                    <input class="date-picker-single form-control" type="text" value="{{$return_date}}" name="return_date" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        
                                 
                                        <div class="col-lg-2 round_trip pr-0" id="round_trip"<?php if($transfertype=='oneway' || $transfertype==''){ echo 'style="display:none"'; } ?> >
                                            <div class="input-box">
                                                <label class="label-text">Return Time</label>
                                                <div class="form-group">
                                                    <div class="select-contain w-auto">
                                                        <select class="select-contain-select" name="return_time">
                                                           @foreach($timeArr as $t)
                                                          <option @if($return_time==$t) selected @endif value="{{$t}}" >{{$t}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-4 -->
                                        
                                        <div class="col-lg-3 pr-0">
                                                <div class="input-box">
                                                    <label class="label-text">Passengers</label>
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
                                        
                                        
                                 <div class="col-lg-3 pr-0">
                                    <div class="input-box">       
                                        <div class="btn-box pt-3">
                                            <input type="submit" class="theme-btn" value="Search Now">
                                        </div>
                                	</div>
                                </div>
                                
                                    </form><!-- end row -->
                                </div>
                                
</div>
                        
                        <!---->
                        
                       
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript">
					 
        	 jQuery(document).ready(function(){	
			 
			 jQuery(".onewayradio").click(function(){ 
					jQuery("#oneway").prop('checked', true);
					jQuery(".round_trip").hide();
				});
				jQuery(".retirnradio").click(function(){
				    jQuery("#round").prop('checked', true);
					jQuery(".round_trip").show();
				});
			 
			  
	         jQuery('.autosuggestion_transfer').keyup(function (e) {
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
				                        innerHtml +='<li  class="iataAKM" countryCode="'+data[i].countryCode+'" destinationCode="'+data[i].city_code+'" destinationName="'+destinationName+'" style="cursor: pointer;">'+destinationName+'</li>';
									}
									 innerHtml +='</ul>';
									 
									jQuery('.transfer_list').html(innerHtml);
									iata();
									
									jQuery('.transfer_list').show();
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
							var countryCode= jQuery(this).attr('countryCode'); 
							document.getElementById("city_code_transfer").value = destinationCode;
							document.getElementById("city_name_transfer").value = destinationName;
							document.getElementById("countryCode_transfer").value = countryCode;
							
							selectsTypes('pick');  selectsTypes('drop');
							jQuery('.transfer_list').hide();
					  });
			   }
			   	   
      });	
	  
	   selectsTypes('pick');  selectsTypes('drop');
	  function selectsTypes(type) {  
		val=jQuery("#"+type).val();   
		
		if(val=='PORT'){ var terminal_type='P'; var val2='Port'; }
		else if(val=='IATA'){ var terminal_type='A'; var val2='Airport'; }
		else if(val=='STATION'){ var terminal_type='T';  var val2='Train Station';  } 
		else if(val=='ATLAS'){ var terminal_type='H';  var val2='Accommodation'; }
		
		jQuery("."+type).html(val2);
		
		var city_code=jQuery("#city_code_transfer").val();	  var countryCode=jQuery("#countryCode_transfer").val();	
		var  innerHtml=''; 
		innerHtml +='<select class="select-contain-select akmakm" ><option  value="">...</option></select>'; 
		jQuery("#"+type+"Option").html(innerHtml); 
					   $.ajax({
								url: '<?php url('');?>/getTerminal',
								type: "GET",
								data: {
									action: 'getTerminal',	
									cityCode: city_code,  
									country_code: countryCode,
									terminal_type: terminal_type,
								},
								dataType: "json",
								success: function (data) { 
						var	innerHtml='<select class="ropdown bootstrap-select select-contain-select dropup select-contain-select akmakm" name="'+type+'_type_name" >'; 								
									if(data.length>0){  
										for(var i=0;i<data.length;i++){
											innerHtml +='<option  value="'+data[i].code+'">'+data[i].name+'</option>';
										}
									}else { innerHtml +='<option  value="">Not Found</option>'; }
									
									innerHtml +='</select>';
									
									jQuery("#"+type+"Option").html(innerHtml); 
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
						});
			   }
			   
	    
</script>               
               <style>    
			   .akmakm{
			   		padding: 14px 20px;
					border-color: rgba(128, 137, 150, 0.2) !important;
					background-color: #fff !important;
					color: #0d233e !important;
					font-size: 14px;
					position: relative;
				}
    
    </style>                 