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







/* CSS for the loading modal */

#loadingModal2 {

  display: none; 

  position: fixed; 

  top: 50%; 

  left: 50%; 

  transform: translate(-50%, -50%); 

  width: 410px;

  height: 519px;

  background-color: rgb(247 91 16);

  z-index: 9999; 

  color: white; 

  text-align: center; /* Center-align the content */

  border-radius: 10px; /* Add some border radius for rounded corners */

  padding-top: 20px; /* Adjust vertical spacing as needed */

}

#loadingModal2{background:#fff!important;color:#111;padding:0!important;height:auto!important;width:600px;max-width:500px;z-index:999999}#loadingModal2 p#timeline2,#loadingModal2 .div-title{color:#111}#loadingModal2{padding:0!important;height:auto;overflow:hidden;width:100%;max-width:600px!important}#loadingModal2 .modal-content2{padding:0!important;border:1px solid #00000033;box-shadow:0 0 10px -5px #000;width:100%}#loadingModal2 .div-title{font-size:28px;padding:9px 0 9px;border-bottom:1px solid #00000030;line-height:40px;font-weight:500}#loadingModal2 .modal-c-body{padding:10px 10px 10px}#loadingModal2 .c-l-middle-main{position:relative;height:100px}#loadingModal2 .modal-c-footer{display:flex;align-items:center;justify-content:center;background:#fff;color:#000000c2;padding:8px 10px 8px}@media only screen and (max-width:600px){#loadingModal2{max-width:400px!important}}

#loadingModal2 .modal-c-footer{background:#f75b10!important}#loadingModal2 .modal-c-footer b p{color:#fff!important}

.modal2-content3 {

  background-color: #f75b10;

  padding: 20px;

  border-radius: 10px; /* Add some border radius for rounded corners */

  /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Add a subtle shadow effect */*/

}



.loader2 {

  border: 1px solid green; /* Light grey */

  border-top: 1px solid #3498db; /* Blue */

  border-radius: 50%;

  width: 50px;

  height: 50px;

  animation: spin2 2s linear infinite;

 /*margin: 9px 155px;*/

     margin: -24px 76px 0px 155px;

}



/* Loader animation */

@keyframes spin2 {

  0% { transform: rotate(0deg); }

  100% { transform: rotate(360deg); }

}



</style>



<?php 

      //if(isset($_REQUEST['IATA_from'])) { $IATA_from=$_REQUEST['IATA_from']; }else{ $IATA_from='DEL'; } 

	  //if(isset($_REQUEST['IATA_to'])) { $IATA_to=$_REQUEST['IATA_to']; }else{ $IATA_to='BOM'; }

	  //if(isset($_REQUEST['origin'])) { $origin=$_REQUEST['origin']; }else{ $origin='Delhi, India'; }

	  //if(isset($_REQUEST['destination'])) { $destination=$_REQUEST['destination']; }else{ $destination='Mumbai, India'; }  





      if(isset($_REQUEST['IATA_from'])) { $IATA_from=$_REQUEST['IATA_from']; }else{ $IATA_from='LAS'; } 

      if(isset($_REQUEST['IATA_to'])) { $IATA_to=$_REQUEST['IATA_to']; }else{ $IATA_to='LAX'; }

      if(isset($_REQUEST['origin'])) { $origin=$_REQUEST['origin']; }else{ $origin='McCarran Intl, US (LAS)'; }

      if(isset($_REQUEST['destination'])) { $destination=$_REQUEST['destination']; }else{ $destination='Los Angeles Intl Arpt, US (LAX)'; } 



	if(isset($_REQUEST['departure_date'])) { $departure_date=$_REQUEST['departure_date']; }else{ $departure_date=date('d/m/Y ', strtotime(date('m/d/Y').' +1 month')); }

	  if(isset($_REQUEST['return_date'])) { $return_date=$_REQUEST['return_date']; }else{ $return_date=date('d/m/Y ', strtotime(date('m/d/Y').' +2 month'));; }

	  

      if(isset($_REQUEST['adults'])) { $adults=$_REQUEST['adults']; }else{ $adults=1; }

      if(isset($_REQUEST['childs'])) { $childs=$_REQUEST['childs']; }else{ $childs=0; }   

	  if(isset($_REQUEST['infants'])) { $infants=$_REQUEST['infants']; }else{ $infants=0; }

	  if(isset($_REQUEST['flighttype'])) { $flighttype=$_REQUEST['flighttype']; }else{ $flighttype='round'; }

	   if(isset($_REQUEST['cabin_class'])) { $cabin_class=$_REQUEST['cabin_class']; }else{ $cabin_class='economy'; }  

	   if(isset($_REQUEST['direct'])) { $direct=$_REQUEST['direct']; }else{ $direct=''; }

											 ?>

	<div class="flighttab tab-pane fade show " id="flight" role="tabpanel" aria-labelledby="flight-tab">



                       <form method="get" id="frm2" action="{{ asset('flight-search-results') }}" onsubmit="formSubmit2()"   >

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

                                                    <select class="form-control" name="cabin_class" id="cabin_class">

                                                                <option <?php if($cabin_class=='economy'){ echo "selected"; }?> value="economy" >Economy</option>

                                                                <option <?php if($cabin_class=='premium_economy'){ echo "selected"; }?> value="premium_economy">Premium</option>

                                                                <option <?php if($cabin_class=='first'){ echo "selected"; }?>value="first">First Class</option>

                                                                 <option <?php if($cabin_class=='business'){ echo "selected"; }?>value="business">Business</option>

                                                                

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







        <!-- HTML for the loading modal -->

             {{--    <div id="loadingModal2" class="modal2">

                    <div class="modal2-content3">

                        <div class="loader2"></div>

                        Searching Flights in..

                        <p>Please Wait...</p>

                        <br>

               

                        From: <h3 id="autosuggestion_from_html"></h3> 

                        <br>

                        To: <h3 id="autosuggestion_to_html"></h3> 

                        <p id="timeline2"></p>

                        <br>

                        <p id="cabin_class"></p>

                        <br>

                        <p id="flighttype"></p>

                        <br>

                        Members: <p id="members"></p>

                    </div>

                </div>

 --}}





    <div id="loadingModal2" class="modal" aria-modal="true" style="display: none">

  <div class="modal-content2">

    <div class="div-title">Travel AmplePoints</div>



    <div class="modal-c-body">

      <p>Searching Flights in..</p>

      <!-- new loader start -->

      <style>

          div#loadingModal2 {

                background: transparent;

                height: 643px;

            }

        .c-l-middle {

          top: 50%;

          left: 50%;

          transform: translate(-50%, -50%);

          position: absolute;

        }

        .c-l-bar {

          width: 10px;

          height: 70px;

          background: #fff;

          display: inline-block;

          transform-origin: bottom center;

          border-top-right-radius: 20px;

          border-top-left-radius: 20px;

          animation: c_l_loader 1.2s linear infinite;

        }

        .c-l-bar1 {

          animation-delay: 0.1s;

        }

        .c-l-bar2 {

          animation-delay: 0.2s;

        }

        .c-l-bar3 {

          animation-delay: 0.3s;

        }

        .c-l-bar4 {

          animation-delay: 0.4s;

        }

        .c-l-bar5 {

          animation-delay: 0.5s;

        }

        .c-l-bar6 {

          animation-delay: 0.6s;

        }

        .c-l-bar7 {

          animation-delay: 0.7s;

        }

        .c-l-bar8 {

          animation-delay: 0.8s;

        }

        @keyframes c_l_loader {

          0% {

            transform: scaleY(0.1);

            background: transparent;

          }

          50% {

            transform: scaleY(1);

            background: #f75b10;

            /*background: #ffffff;*/

          }

          100% {

            transform: scaleY(0.1);

            background: transparent;

          }

        }

      </style>

      <div class="c-l-middle-main">

        <div class="c-l-middle">

          <div class="c-l-bar c-l-bar1"></div>

          <div class="c-l-bar c-l-bar2"></div>

          <div class="c-l-bar c-l-bar3"></div>

          <div class="c-l-bar c-l-bar4"></div>

          <div class="c-l-bar c-l-bar5"></div>

          <div class="c-l-bar c-l-bar6"></div>

          <div class="c-l-bar c-l-bar7"></div>

          <div class="c-l-bar c-l-bar8"></div>

        </div>

      </div>

      <!-- new loader end -->

      <p style="padding: 10px 0 0">Please Wait...</p>

      <br />

      From: <h4 id="autosuggestion_from_html"></h4> 

                        

                        To: <h4 id="autosuggestion_to_html"></h4> 

                        {{-- <p id="timeline2"></p> --}}

                        

                        <p id="cabin_class"></p>

                        

                        <p id="flighttype"></p>

                        

                        Members: <p id="members"></p>

    </div>

    <div class="modal-c-footer" style="color:white;">

     <b>    <p id="timeline2"></p>  </b>

    </div></div>

</div>





                        

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

	   



	   function formSubmit2() {

        // Prevent the default form submission behavior

        event.preventDefault();

        // Show the loading modal

        document.getElementById("loadingModal2").style.display = "block";

        var flighttype=$('input[name="flighttype"]').val();



        var autosuggestion_from=$("#autosuggestion_from").val();



        var autosuggestion_to=$("#autosuggestion_to").val();



        var departure_date=$("#departure_date").val();



        var return_date=$("#return_date").val();



        var cabin_class= $('#cabin_class').val();



        var adults=$("#adults").val();



        var childs=$("#childs").val();



        var infants=$("#infants").val();



        $("#autosuggestion_from_html").html(autosuggestion_from);

        $("#autosuggestion_to_html").html(autosuggestion_to);

        $("#timeline2").html("time span: "+ departure_date + " - "+ return_date);

        $("#flighttype").html("flight type: "+ flighttype);

        $("#cabin_class").html("cabin class: "+ cabin_class);

        $("#members").html("Adults: "+ adults + " , Childs: "+childs+" ,infants: "+infants);





console.log(flighttype,

autosuggestion_from, 

autosuggestion_to,

departure_date,

return_date,

cabin_class,

adults,

childs,

infants);



// return false





        // return false;

        // Set a timeout to submit the form after 5 seconds

        setTimeout(function() {

        document.getElementById("loadingModal2").style.display = "none"; // Hide the loading modal

        document.getElementById("frm2").submit(); // Submit the form with ID "frm2"

        }, 5000);

        }





      </script>

      

