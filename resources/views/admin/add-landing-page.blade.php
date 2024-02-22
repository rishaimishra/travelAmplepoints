@include('admin.header')
@include('admin.nav')

  @php 
  	$id='';
    $published='Yes';
    $page_id=''; 
    $name=''; 
    $title=''; $meta_keywords=''; $meta_description=''; $content=''; $b_image='';
  if(isset($pageSingel)){ 
       $id=$pageSingel->id; 
       $page_id=$pageSingel->page_id;
       $name=$pageSingel->name; 
       $title=$pageSingel->title;  
       $meta_keywords=$pageSingel->meta_keywords; 
       $meta_description=$pageSingel->meta_description; 
       $content=$pageSingel->content;  
       $b_image=$pageSingel->image; 
       $oc=json_decode($pageSingel->other_content,true); 
   }
  
  @endphp
  
  
 <style>
.an-from, .an-to{
    position: relative;
}
.bg_image{
	background:url('/images/noimage.png');
	background-repeat: no-repeat;
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
    padding: 10px 10px;
	border-bottom:thick;
}

.from_list li:hover, .to_list li:hover{
    background: #287dfa;
    color:#fff;
}


</style> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add/Update Flight Landing Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add/Update Flight Landing Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
    <form action="{{ asset('add-page-post') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add/Update Flight Landing Page</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">   
                <input type="hidden" name="id" value="{{$id}}" class="custom-file-input" id="">  
                <input type="hidden" name="type" value="landing" class="custom-file-input" id=""> 
                <input type="hidden" name="type_name" value="flight" class="custom-file-input" id=""> 
                <input type="hidden" name="redirect_url" value="add-flight-landing-page" class="custom-file-input" id="">              
                <div class="form-group col-md-6" style="display:none">
                  <label for="exampleInputEmail1">Fly From</label> <?php  if(!isset($oc['IATA_from'])){ $oc['IATA_from']=''; } ?>
                  <input type="hidden" id="IATA_from" name="oc[IATA_from]"  value="{{$oc['IATA_from']}}" class="form-control" >
                  												   <?php  if(!isset($oc['city_from'])){ $oc['city_from']=''; } ?>
                  <input type="hidden" id="city_from" name="oc[city_from]"  value="{{$oc['city_from']}}" class="form-control" >
                 												 <?php  if(!isset($oc['cityFromUrl'])){ $oc['cityFromUrl']=''; } ?>
                  <input type="hidden" id="cityUrl_from" name="oc[cityFromUrl]"  value="{{$oc['cityFromUrl']}}" class="form-control" >
																 <?php  if(!isset($oc['countryFromUrl'])){ $oc['countryFromUrl']=''; } ?>
                  <input type="hidden" id="countryUrl_from" name="oc[countryFromUrl]"  value="{{$oc['countryFromUrl']}}" class="form-control" >
                  												   <?php  if(!isset($oc['country_from'])){ $oc['country_from']=''; } ?>
                  <input type="hidden" id="country_from" name="oc[country_from]"  value="{{$oc['country_from']}}" class="form-control" >
                  												   <?php  if(!isset($oc['fly_from'])){ $oc['fly_from']=''; } ?>
                  <input type="text" name="oc[fly_from]" value="{{$oc['fly_from']}}" fly="from" id="autosuggestion_from" class="form-control autosuggestion" placeholder="i.e Delhi" required>
                  <div class="input-box from_list" style="display:none"></div>
                </div>
                <div class="form-group col-md-6" style="display:none">
                  <label for="exampleInputEmail1">Fly To</label><?php  if(!isset($oc['IATA_to'])){ $oc['IATA_to']=''; } ?>
                  <input type="hidden" id="IATA_to" name="oc[IATA_to]"  value="{{$oc['IATA_to']}}" class="form-control" >
         														<?php  if(!isset($oc['city_to'])){ $oc['city_to']=''; } ?>         
                  <input type="hidden" id="city_to" name="oc[city_to]"  value="{{$oc['city_to']}}" class="form-control" >
																<?php  if(!isset($oc['cityToUrl'])){ $oc['cityToUrl']=''; } ?>
                  <input type="hidden" id="cityUrl_to" name="oc[cityToUrl]"  value="{{$oc['cityToUrl']}}" class="form-control" >
																 <?php  if(!isset($oc['countryToUrl'])){ $oc['countryToUrl']=''; } ?>
                  <input type="hidden" id="countryUrl_to" name="oc[countryToUrl]"  value="{{$oc['countryToUrl']}}" class="form-control" >
         														<?php  if(!isset($oc['country_to'])){ $oc['country_to']=''; } ?>         
                  <input type="hidden" id="country_to" name="oc[country_to]"  value="{{$oc['country_to']}}" class="form-control" >
         														<?php  if(!isset($oc['fly_to'])){ $oc['fly_to']=''; } ?>         
                  <input type="text" name="oc[fly_to]" value="{{$oc['fly_to']}}" fly="to" class="form-control autosuggestion" id="autosuggestion_to" placeholder="i.e Mumbai" required>
                   <div class="input-box to_list" style="display:none"></div>
                </div>

                <br />
                <hr />
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Flight Type </label>
                  <div class="form-check"><?php  if(!isset($oc['flight_type'])){ $oc['flight_type']=''; } ?>         
                          <input type="radio" name="oc[flight_type]" value="oneway" @php if($oc['flight_type']=='oneway') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Oneway</label>	<?php  if(!isset($oc['flight_type'])){ $oc['flight_type']=''; } ?> 	
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="oc[flight_type]" value="return" @php if($oc['flight_type']=='return') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Return</label>
                  </div>
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Outbond Days </label> <?php  if(!isset($oc['outbound_days'])){ $oc['outbound_days']=''; } ?>
                  <input type="number" name="oc[outbound_days]" value="{{$oc['outbound_days']}}" class="form-control" placeholder="i.e 2" required>
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Inbound Days</label>  <?php  if(!isset($oc['inbound_days'])){ $oc['inbound_days']=''; } ?>
                  <input type="number" name="oc[inbound_days]" value="{{$oc['inbound_days']}}" class="form-control" placeholder="i.e 2" required> 
                </div>
                
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">Adult</label>  <?php  if(!isset($oc['adult'])){ $oc['adult']=''; } ?>
                  <input type="number" name="oc[adult]" value="{{$oc['adult']}}" class="form-control" placeholder="i.e 1" required>
                </div>
                
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">Child</label><?php  if(!isset($oc['child'])){ $oc['child']=''; } ?>
                  <input type="number" name="oc[child]" value="{{$oc['child']}}" class="form-control" placeholder="i.e 1" required>
                </div>
                
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">Infant</label><?php  if(!isset($oc['infant'])){ $oc['infant']=''; } ?>
                  <input type="numbar" name="oc[infant]" value="{{$oc['infant']}}" class="form-control" placeholder="i.e 1" required>
                </div>
                
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">Price</label><?php  if(!isset($oc['price'])){ $oc['price']=''; } ?>
                  <input type="text" name="oc[price]" value="{{$oc['price']}}" class="form-control" placeholder="i.e 296" required>
                </div>
                
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">Currency</label><?php  if(!isset($oc['currency'])){ $oc['currency']=''; } ?>
                  <input type="text" name="oc[currency]" value="{{$oc['currency']}}" class="form-control" placeholder="i.e INR" required>
                </div>
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">airline</label><?php  if(!isset($oc['airline'])){ $oc['airline']=''; } ?>
                  <input type="text" name="oc[airline]" value="{{$oc['airline']}}" class="form-control" placeholder="i.e AI" required>
                </div>
                
                <div class="form-group col-md-12">
                <div style="text-align:center">
                  <img class="image" height="200" width="200" src="{{asset($b_image)}}"  onclick="getElementById('image').click()" style="cursor: pointer;" /><br />
                   <label for="exampleInputFile">Image</label>
                </div>                
                  <div class="input-group" style="display:none">
                    <div class="custom-file">
                    <input type="hidden" name="image_pre" value="{{$b_image}}" class="custom-file-input" id="">
                    <input type="file" name="b_image" accept="image/gif, image/jpeg, image/png" class="custom-file-input" onchange="changeImage(this,'image');" id="image">
                    </div>
                  </div>
                </div>
                
                
                
                <div class="form-group col-md-12 " >
 				<label for="exampleInputEmail1">Page URL</label> <br />
                	<input type="text" name="page_id" value="{{$page_id}}" class="form-control" id="">
                </div>
              
                <input type="hidden" name="id" value="{{$id}}" class="form-control" id="">
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Name</label>  
                  <input name="name"  class="form-control " value="{{$name}}" required> 
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Meta Title</label>  
                  <input name="title"  class="form-control " value="{{$title}}" required> 
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Meta keywords</label>  
                  <input name="meta_keywords"  class="form-control " value="{{$meta_keywords}}" required> 
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Meta Description</label>  
                  <textarea name="meta_description"  class="form-control " value="" required > {{$meta_description}}</textarea> 
                </div>
             
                <div class="form-group col-md-12" style="display:none">
                  <label for="exampleInputEmail1">Content</label>  
                  <textarea name="content" class="form-control summernote" placeholder="New York, US" ><?php echo $content; ?></textarea>
                </div>                
                
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">Published</label>
                  <div class="form-check">
                          <input type="radio" name="published" value="Yes" @php if($published=='Yes') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Yes</label>		
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="published" value="No" @php if($published=='No') echo "checked" @endphp class="form-check-input"><label class="form-check-label">No</label>
                  </div>
                </div>
                
                <div class="card-footer update">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                           
              
             </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  
      </form>
    
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
					   			url:'<?php url(''); ?>/getLocationsFlights',
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
									
									for(var i=0;i<data.length;i++){
										var name=data[i].name+", "+data[i].country_code+" ("+data[i].code+")"; 
										var IATA=data[i].code; var City=data[i].CityName;  var Country=data[i].CountryCode; 
										var cityUrl=data[i].cityUrl;  var countryUrl=data[i].countryUrl;
									 innerHtml +='<li  class="iataAKM" cityURL="'+cityUrl+'" counrtyURL="'+countryUrl+'" IATA="'+IATA+'" city="'+City+'" counrty="'+Country+'" name="'+name+'" type="'+type+'" style="cursor: pointer;">'+name+'</li>';
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
							document.getElementById("city_"+type).value = jQuery(this).attr('city');
							document.getElementById("country_"+type).value = jQuery(this).attr('counrty');
							document.getElementById("cityUrl_"+type).value = jQuery(this).attr('cityURL');
							document.getElementById("countryUrl_"+type).value = jQuery(this).attr('counrtyURL');
							document.getElementById("autosuggestion_"+type).value = name;
							jQuery('.'+type+'_list').hide();
					  });
			   }			 
      });
	  
	  
	   
function changeImage(input,targetImg){

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.'+targetImg).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
  
	  
      </script>
      


  
  
@include('admin.footer')
 