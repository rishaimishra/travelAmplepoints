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
  <form action="{{ asset('update-hotel-data') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{ucfirst($product)}} Data </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Order Id</label>
                  <input type="text" name="order_id" value="{{$bookingData->order_id}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Booking Mode</label>
                  <input type="text" name="booking_mode" value="{{$bookingData->booking_mode}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Itinerary Id</label>
                  <input type="text" name="itineraryId" value="{{$bookingData->itineraryId}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Email </label>
                  <input type="email" name="user_email" value="{{$bookingData->user_email}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Hotel Name</label>
                  <input type="text" name="hotelName" value="{{$bookingData->hotelName}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Address</label>
                  <input type="text" name="hotelAddress" value="{{$bookingData->hotelAddress}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">City</label>
                  <input type="text" name="hotelCity" value="{{$bookingData->hotelCity}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Country</label>
                  <input type="text" name="hotelCountryCode" value="{{$bookingData->hotelCountryCode}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">User Name</label>
                  <input type="text" name="user_name" value="{{$bookingData->user_name}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Adult</label>
                  <input type="text" name="adults" value="{{$bookingData->adults}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Children</label>
                  <input type="text" name="children" value="{{$bookingData->children}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Rooms</label>
                  <input type="text" name="rooms" value="{{$bookingData->rooms}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Hotel Rating</label>
                  <input type="text" name="hotelRating" value="{{$bookingData->hotelRating}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Price</label>
                  <input type="text" name="chargable_rate" value="{{$bookingData->chargable_rate}}" class="form-control" disabled >
                </div>
                
                
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Currency</label>
                  <input type="text" name="currency_code" value="{{$bookingData->currency_code}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Payment Type</label>
                  <input type="text" name="PaymentType" value="{{$bookingData->PaymentType}}" class="form-control" disabled >
                </div>
                
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Check In</label>
                  <input type="text" name="check_in" value="{{$bookingData->check_in}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Check Out</label>
                  <input type="text" name="check_out" value="{{$bookingData->check_out}}" class="form-control"disabled >
                </div>
                
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Booking Status </label>
                  <input type="text" "@if($bookingData->booking_status ==  'Confirmed'){ style='background:#00FF00;color:#FFFFFF' } @else{ style='background:#FF0000;color:#FFFFFF' } @endif"  name="booking_status" value="{{$bookingData->booking_status}}" class="form-control" disabled >
                </div>
                @if($bookingData->booking_status=='Failed')
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Reason: </label> 
                  				@php
                                        $response_data=  $bookingData->response_xml;
                                 @endphp
                  <?php echo "<pre>"; print_r($response_data); ?>
                </div>
                @endif
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Payment Status</label>
                  <input type="text" "@if($bookingData->payment_status ==  'Confirmed'){ style='background:#00FF00;color:#FFFFFF' } @else{ style='background:#FF0000;color:#FFFFFF' } @endif" name="payment_status" value="{{$bookingData->payment_status}}" class="form-control " disabled >
                </div>
                
                
                <!--<div class="card-footer edit">
                    <button type="button" onclick="removeDisable()" class="btn btn-primary">Edit</button>
                  </div>
                
                <div class="card-footer update" style="display:none">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>-->
                           
              
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
    
	function removeDisable()
	{
		 var inputs = document.getElementsByClassName('form-control');
		for(var i = 0; i < inputs.length; i++) {
			inputs[i].disabled = false;
		}
		
		jQuery(".update").show(); 
		jQuery(".edit").hide(); 
	}
	

	
  </script>