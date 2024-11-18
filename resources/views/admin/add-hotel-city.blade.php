@include('admin.header')
@include('admin.nav')

  @php 
    $city_code='';
    $city_name='';
    $countryCode='';
    $latitude=''; $longitude=''; $image=''; $content=''; $priority=''; 
    
  if(isset($citySingel)){ 
       $id=$citySingel->id; 
       $city_code=$citySingel->city_code; 
       $city_name=$citySingel->city_name; 
       $countryCode=$citySingel->countryCode; 
       $latitude=$citySingel->latitude;
       $longitude=$citySingel->longitude; 
       $image=$citySingel->image;
       $content=$citySingel->content; 
       $priority=$citySingel->priority;

       
 
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
            <h1 class="m-0">Add/Update Hotel City</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add/Update Hotel City</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
    <form action="{{ asset('hotel-city-post') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Hotel City  </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
              <div class="card-body">
              <div class="row">   

                <input type="hidden" name="id" value="{{$id}}" class="custom-file-input" id="">                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">City Code</label>
                  <input type="text" name="city_code" value="{{$city_code}}" id="city_code" class="form-control" readonly="readonly" placeholder="DEL" required>
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">City Name</label>
                  <input type="text" name="city_name" value="{{$city_name}}" class="form-control" id="city_name" readonly="readonly" placeholder="Delhi" required>
                </div>                
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Country Code </label>
                  <input type="text" name="countryCode" value="{{$countryCode}}" class="form-control" readonly="readonly" placeholder="IN" required>
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Latitude</label>
                  <input type="text" name="latitude" value="{{$latitude}}" class="form-control" readonly="readonly" placeholder="27.58521" required> 
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Longitude </label>
                  <input type="text" name="longitude" value="{{$longitude}}" class="form-control" readonly="readonly" placeholder="11.58964" required>
                </div>
                                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Priority</label>
                  <input type="text" name="priority" value="{{$priority}}" class="form-control"  placeholder="1" required>
                </div>
                
                <br />
                <br />
                <hr /> 
                
                <div class="form-group col-md-12">
                <div style="text-align:center">
                  <img class="from_city_image image" height="200" width="200" src="{{asset($image)}}?{{rand()}}"  onclick="getElementById('image').click()" style="cursor: pointer;" /><br />
                  <label for="exampleInputFile">Image</label>
                </div>                
                  <div class="input-group" style="display:none">
                    <div class="custom-file">
                    <input type="hidden" name="image_pre" value="{{$image}}"  class="custom-file-input" id="">
                      <input type="file" name="image" accept="image/gif, image/jpeg, image/png" class="custom-file-input" onchange="changeImage(this,'image');" id="image">
                    </div>
                  </div>
                </div>
              
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Content</label>  
                  <textarea name="content" class="form-control summernote" placeholder="content" required><?php echo $content; ?></textarea>
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
										var name=data[i].AirportName+", "+data[i].CountryName+" ("+data[i].AirportCode+")"; 
										var IATA=data[i].AirportCode; var City=data[i].CityName;  var Country=data[i].CountryCode;
									 innerHtml +='<li  class="iataAKM" IATA="'+IATA+'" city="'+City+'" counrty="'+Country+'" name="'+name+'" type="'+type+'" style="cursor: pointer;">'+name+'</li>';
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
 