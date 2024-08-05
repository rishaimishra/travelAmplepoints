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
	  if(isset($_REQUEST['city_name'])) { $city_name=$_REQUEST['city_name']; }else{ $city_name='Delhi'; }
	  if(isset($_REQUEST['dest_name'])) { $dest_name=$_REQUEST['dest_name']; }else{ $dest_name='Delhi and NCR, India'; }
	  if(isset($_REQUEST['date_range'])) { $date_range=$_REQUEST['date_range']; }else{ $date_range=date('d/m/Y ', strtotime(date('m/d/Y').' +3 day')); }
	  
      if(isset($_REQUEST['adult'])) { $adult=$_REQUEST['adult']; }else{ $adult=1; }
      if(isset($_REQUEST['child'])) { $child=$_REQUEST['child']; }else{ $child=0; }   
	  if(isset($_REQUEST['rooms'])) { $rooms=$_REQUEST['rooms']; }else{ $rooms=1; }
	  $guests=$adult+$child;
?>
<div class="tab-pane fade show active" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
                            <div class="contact-form-action">
                                <form method="get" action="{{ asset('hotel-search-results') }}" class="row align-items-center">
                                @csrf
                                    <div class="col-lg-3 pr-0">
                                        <div class="input-box">
                                            <label class="label-text">Destination </label>
                                            <div class="form-group">
                                                <span class="la la-map-marker form-icon">
                                                </span>
                                      <input class="form-control autosuggestion_hotel" name="city_code" id="city_code" type="hidden" value="<?php echo $city_code;  ?>" >
                                      <input class="form-control autosuggestion_hotel" name="city_name" id="city_name" type="hidden" value="<?php echo $city_name;  ?>" >
    <input class="form-control autosuggestion_hotel"  name="dest_name" id="dest_name" type="text" value="<?php echo $dest_name;  ?>" placeholder="Enter city or property">
                                            </div>
                                        </div>
                                        <div class="input-box hotel_list" style="display:none"></div>
                                    </div><!-- end col-lg-3 -->
                                    <div class="col-lg-3 pr-0">
                                        <div class="input-box">
                                            <label class="label-text">Check In - Check Out</label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon">
                                                </span>
                                                <input class="form-control" id="date_range" name="date_range" value="<?php echo $date_range;  ?>" type="text"  readonly>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-3 -->
                                    <!--<div class="col-lg-3 pr-0">
                                        <div class="input-box">
                                            <label class="label-text">Check out</label>
                                            <div class="form-group">
                                                <span class="form-icon an-custom-img-icon">
                                                    <img src="<?php url('') ?>icon/calender-black.png" alt="">
                                                </span>
                                                <input class="date-picker-single form-control" id="check_out" name="check_out" value="" type="text"  readonly>
                                            </div>
                                        </div>
                                    </div> end col-lg-3 -->
                                    <div class="col-lg-3">
                                        <div class="input-box">
                                            <label class="label-text">Guests</label>
                                            <div class="form-group">
                                                <div class="dropdown dropdown-contain gty-container">
                                                    <a class="dropdown-toggle dropdown-btn" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="adult" data-text="Rooms" data-text-multi="Rooms"><span class="rooms">{{$rooms}}</span> Room(s)</span>
                                                        -
                                                        <span class="children" data-text="Guests" data-text-multi="Guests"><span class="guests">{{$guests}}</span> Guest(s)</span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-wrap">
                                                        <div class="dropdown-item">
                                                            <div class="qty-box d-flex align-items-center justify-content-between">
                                                                <label><b>Rooms</b></label>
                                                                <div class="qtyBtn d-flex align-items-center">
                                                                    <div class="qtyDec"><i  class="la la-minus"></i></div>
                                                                    <input type="numbar" onchange="addPax('rooms')" name="rooms" id="rooms" min="1" max="4" value="<?php echo $rooms;  ?>" class="qty-input">
                                                                    <div class="qtyInc"><i  class="la la-plus"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <div class="addPax"></div>  
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


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
jQuery(".common_beard_comb").hide();

        jQuery(document).ready(function(){
		
		var start = moment().add(2, 'days');
    		  var end = moment().add(4, 'days');
		 $("#date_range").daterangepicker({ 
                    singleDatePicker: false,
					autoUpdateInput: true,
                    opens: 'right',
					autoApply: true,
					minDate:new Date(),
					startDate: start,
        			endDate: end,
                    locale: {
                        format: 'YYYY/MM/DD',
				  }
         });
		
		
				addPax('rooms');
	          jQuery('.autosuggestion_hotel').keyup(function (e) {
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
								success: function (data) {
									var innerHtml='</ul>';
									for(var i=0;i<data.length;i++){
										destinationName=data[i].city_name+", "+data[i].countryName; 
				                        innerHtml +='<li  class="iataAKM" city_name="'+data[i].city_name+'" destinationCode="'+data[i].city_code+'" destinationName="'+destinationName+'" style="cursor: pointer;">'+destinationName+'</li>';
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
							var city_name= jQuery(this).attr('city_name');
							document.getElementById("city_code").value = destinationCode;
							document.getElementById("city_name").value = city_name; 
							document.getElementById("dest_name").value = destinationName;
							jQuery('.hotel_list').hide();
					  });
			   }
      });	  
	  function addPax(type)
	  { 	
	   managePax(type);
	  		var rooms=document.getElementById("rooms").value;
			var innerHtml='';  
			for(var i=0;i<rooms;i++){ var rn=i+1; var adultId='adult_'+i; var clildId='child_'+i;
				 	
					innerHtml+='<div class="dropdown-item"><b>Room '+(i+1)+'</b></div>';
					innerHtml+='<div class="dropdown-item">';
						innerHtml+='<div class="qty-box d-flex align-items-center justify-content-between">';
							innerHtml+='<label>Adults</label>';
							innerHtml+='<div class="qtyBtn d-flex align-items-center">';
								innerHtml+='<div class="qtyDec"><i class="la la-minus"></i></div>';
								innerHtml+='<input type="text" name="adults[]" value="<?php echo $adult;  ?>" onchange="managePax(\''+adultId+'\')" id="'+adultId+'" min="1" max="4" >';
								innerHtml+='<div class="qtyInc"><i class="la la-plus"></i></div>';
							innerHtml+='</div>';
						innerHtml+='</div>';
					innerHtml+='</div>';
					
					
					innerHtml+='<div class="dropdown-item">';
						innerHtml+='<div class="qty-box d-flex align-items-center justify-content-between">';
							innerHtml+='<label>Children</label>';
							innerHtml+='<div class="qtyBtn d-flex align-items-center">';
								innerHtml+='<div class="qtyDec" ><i class="la la-minus"></i></div>';
								innerHtml+='<input type="text" onchange="addChildAge(\''+clildId+'\',\''+i+'\')" name="childs[]" value="<?php echo $child;  ?>" id="'+clildId+'" min="0" max="4">';
								innerHtml+='<div class="qtyInc" ><i  class="la la-plus"></i></div>';
							innerHtml+='</div>';
						innerHtml+='</div>';
						innerHtml+='<div id="age_'+clildId+'"></div>';
					innerHtml+='</div>';
					
					
						if(i<(rooms-1)){ innerHtml+='<hr>' };
				 }
				 
				 jQuery('.addPax').html(innerHtml);
	    managePax(type);					
	  }
	  function addChildAge(id,room){
	  		managePax(id);
	  		var ch=parseInt(document.getElementById(id).value);
			var innerHtml='<br>';
			for(var i=0;i<ch;i++){ innerHtml+='<p>Child '+(parseInt(i)+1)+' Age - <select name="child_age['+room+'][]"><option value="0">0</option><option selected="selected" value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select></p>' }
			jQuery('#age_'+id).html(innerHtml);
	  }

	    
	   
</script>

                        

                                