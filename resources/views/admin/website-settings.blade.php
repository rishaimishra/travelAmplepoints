 @include('admin.header')
@include('admin.nav')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <!-- Main content -->
  <form action="website-settings-post" method="post" enctype="multipart/form-data">
  @csrf
	
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Website Settings</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
      
         @php
				$common_data=  $siteData->common_data;
                $common=json_decode($common_data,true);
                
                $images=  $siteData->images;
                $images=json_decode($images,true);
         @endphp
      

              <div class="card-body">
              <div class="row">
              	<div class="form-group col-md-6" style="text-align:center">
                  <img height="200" width="200" src="{{$images['logo']}}" />
                </div>
                <div class="form-group col-md-6"  style="text-align:center">
                  <img height="200" width="200" src="{{$images['icon']}}" />
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputFile">Update Logo</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="website_logo_pre" value="{{$images['logo']}}" class="custom-file-input" id="">
                      <input type="file" name="website_logo" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Update Logo</label>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputFile">Update Icon</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="website_icon_pre" value="{{$images['icon']}}" class="custom-file-input" id="">
                      <input type="file" name="website_icon" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Update Icon</label>
                    </div>
                  </div>
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Website Name</label>
                  <input  type="hidden" name="common[website]" value="<?php echo url(''); ?>" >
                  <input type="text" name="common[website_name]" value="{{ $common['website_name'] }}" class="form-control" id="exampleInputEmail1" placeholder="Enter Website Name">
                </div>
                           
              
             </div>
            </div>
            
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Company Info </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Contact No 1</label>
                  <input type="text" name="common[contact1]" value="{{ $common['contact1'] }}" class="form-control" id="exampleInputEmail1" placeholder="Contact No 1">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Contact No 2</label>
                  <input type="text" name="common[contact2]" value="{{ $common['contact2'] }}" class="form-control" id="exampleInputEmail1" placeholder="Contact No 2">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Email 1</label>
                  <input type="email" name="common[email1]" value="{{ $common['email1'] }}" class="form-control" id="exampleInputEmail1" placeholder="Email 1">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Email 2</label>
                  <input type="email" name="common[email2]" value="{{ $common['email2'] }}" class="form-control" id="exampleInputEmail1" placeholder="Email 2">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Address 1</label>
                  <textarea  type="text" name="common[address1]" class="form-control summernote" >{{ $common['address1'] }}</textarea>
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Address 2</label>
                  <textarea name="common[address2]"  type="text" class="form-control summernote"  >{{ $common['address2'] }}</textarea>
                </div>
                           
              
             </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">             
            <div class="card-header">
              <h3 class="card-title">Website Content</h3>
            </div>
              <div class="card-body">
              <div class="row">
              	<div class="form-group col-md-12">
                  <label for="exampleInputEmail1">About Us</label>
                  <textarea  name="common[about]"  class="form-control summernote"  >{{ $common['about'] }}</textarea>
                </div>
              </div>
              <div class="row">
              	<div class="form-group col-md-2" style="text-align:center">
                  <img height="200" width="200" src="{{$images['about']}}" />
                  <label for="exampleInputFile">Update About Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="about_image_pre" value="{{$images['about']}}" class="custom-file-input" id="">
                      <input type="file" name="about_image" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Update About Image</label>
                    </div>
                  </div>
                </div>
                
                <div class="form-group col-md-2" style="text-align:center">
                  <img height="200" width="200" src="{{$images['service']}}" />
                  <label for="exampleInputFile">Update Service Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="service_image_pre" value="{{$images['service']}}" class="custom-file-input" id="">
                      <input type="file" name="service_image" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Update Service Image</label>
                    </div>
                  </div>
                </div> 
              	
                <div class="form-group col-md-2" style="text-align:center">
                  <img height="200" width="200" src="{{$images['home']}}" />
                  <label for="exampleInputFile">Update Home Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="home_image_pre" value="{{$images['home']}}" class="custom-file-input" id="">
                      <input type="file" name="home_image" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Update Home Image</label>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-2" style="text-align:center">
                  <img height="200" width="200" src="{{$images['flight']}}" />
                  <label for="exampleInputFile">Update Flight Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="flight_image_pre" value="{{$images['flight']}}" class="custom-file-input" id="">
                      <input type="file" name="flight_image" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Update Flight Image</label>
                    </div>
                  </div>
                </div> 
                <div class="form-group col-md-2" style="text-align:center">
                  <img height="200" width="200" src="{{$images['hotel']}}" />
                  <label for="exampleInputFile">Update Hotel Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="hotel_image_pre" value="{{$images['hotel']}}" class="custom-file-input" id="">
                      <input type="file" name="hotel_image" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Update Hotel Image</label>
                    </div>
                  </div>
                </div> 
                <div class="form-group col-md-2" style="text-align:center">
                  <img height="200" width="200" src="{{$images['car']}}" />
                  <label for="exampleInputFile">Update Car Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="car_image_pre" value="{{$images['car']}}" class="custom-file-input" id="">
                      <input type="file" name="car_image" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Update Car Image</label>
                    </div>
                  </div>
                </div> 
                
               </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Hotelbeds Settings </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Hotelbeds Secret</label>
                  <input type="text" class="form-control" name="common[hotelbeds_secret]" value="{{ $common['hotelbeds_secret'] }}"  placeholder="Hotelbeds Secret">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Hotelbeds Key</label>
                  <input type="text" class="form-control" name="common[hotelbeds_key]" value="{{ $common['hotelbeds_key'] }}" placeholder="Hotelbeds Key">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Hotel Markup</label>
                  <input type="text" class="form-control" name="common[hotel_markup]" value="{{ $common['hotel_markup'] }}" placeholder="Hotel Markup">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Hotel Markup For Agent</label>
                  <input type="text" class="form-control" name="common[hotel_markup_agent]" value="{{ $common['hotel_markup_agent'] }}" placeholder="Hotel Markup For Agent">
                </div>          
              
             </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Flight Settings </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
            <div class="card-body">
              <div class="row">                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Flight Duffel Token</label>
                  <input type="text" class="form-control" name="common[flight_duffel_token]" value="{{ $common['flight_duffel_token'] }}" placeholder="Hotelbeds Secret">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Flight Markup</label>
                  <input type="text" class="form-control" name="common[flight_markup]" value="{{ $common['flight_markup'] }}" placeholder="Hotel Markup">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Flight Markup For Agent</label>
                  <input type="text" class="form-control" name="common[flight_markup_agent]" value="{{ $common['flight_markup_agent'] }}" placeholder="Flight Markup">
                </div>
             
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    </div>
  </section>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Currency Settings </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->            
              <div class="card-body">
              <div class="row">                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Currency </label>
                  <select name="common[currency]" id='currency'  onChange="changeCurrency()"class="form-control select2">
                  @foreach($currency as $key => $data)
                  <option "@if($common['currency'] ==  $data->currency)  selected @endif" value="{{$data->currency}}">{{$data->currency}}</option>
                  @endforeach
                  </select>
                </div>
                
                 <div class="form-group col-md-6" >
                  <label for="exampleInputEmail1">Currency Symbol </label>
                  <select name="common[currency_symbol]" onChange="changeCurrency()" class="form-control select2">
                   @foreach($currency as $key => $data)
                  <option class="{{$data->currency}} currency_symbol" value="{{$data->currency_symbol}}">{{$data->currency_symbol}}</option>
                  @endforeach
                  </select>
                </div>
             </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Set Flight Widget </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->            
              <div class="card-body">
              <div class="row">  
                  
                  @for($i=1;$i<6;$i++)         
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Column {{$i}} </label>
                  <select name="common[flight_widget_col{{$i}}]" id='currency' class="form-control select2">
                  @foreach($flightData as $key => $data)
                  {{$val='flight_widget_col'.$i}}
                  <option "@if($common[$val] ==  $data->fly_from)  selected @endif" value="{{$data->fly_from}}">{{$data->fly_from}}</option>
                  @endforeach
                  </select>
                </div>
                @endfor
                              
             </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  
  <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Social Link </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->                
                  <div class="card-body">
                  <div class="row">                
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Facebook Link</label>
                      <input type="text" name="common[fb_link]"  value="{{ $common['fb_link'] }}" class="form-control" placeholder="Facebook Link">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Twitter Link</label>
                      <input type="text" name="common[tw_link]" value="{{ $common['tw_link'] }}" class="form-control"  placeholder="Twitter Link">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Instagram Link</label>
                      <input type="text" name="common[insta_link]" value="{{ $common['insta_link'] }}" class="form-control"  placeholder="Instagram Link">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Linkdin Link</label>
                      <input type="text"  name="common[ld_link]" value="{{ $common['ld_link'] }}" class="form-control"  placeholder="Linkdin Link">
                    </div>
                               
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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
  <!-- /.content -->
</div>
@include('admin.footer')


  <script src="https://js.braintreegateway.com/web/dropin/1.32.1/js/dropin.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://www.abengines.com/javascript/iframeConsoleUI.min.js"/></script>

  <script type="text/javascript">
    // call braintree.dropin.create code here
	changeCurrency();
	function changeCurrency(){
	 var currency=document.getElementById('currency').value;
	 
	 jQuery(".currency_symbol").removeAttr("selected"); 
	 jQuery("."+currency).attr('selected','selected');
	
	}
	
  </script>