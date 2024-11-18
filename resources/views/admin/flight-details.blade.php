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
  <form action="{{ asset('update-flight-data') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Flight Data </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Order Id</label>
                  <input type="text" name="id" value="{{$flightData->id}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Booking Mode</label>
                  <input type="text" name="booking_mode" value="{{$flightData->booking_mode}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">PNR</label>
                  <input type="text" name="pnr_number" value="{{$flightData->pnr_number}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Email </label>
                  <input type="email" name="email" value="{{$flightData->email}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Contact Number</label>
                  <input type="text" name="contact_number" value="{{$flightData->contact_number}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Address</label>
                  <input type="text" name="address" value="{{$flightData->address}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">City</label>
                  <input type="text" name="city" value="{{$flightData->city}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Country</label>
                  <input type="text" name="country" value="{{$flightData->country}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Postal Code</label>
                  <input type="text" name="postal_code" value="{{$flightData->postal_code}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Adult</label>
                  <input type="text" name="adult" value="{{$flightData->adult}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Children</label>
                  <input type="text" name="children" value="{{$flightData->children}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Infant</label>
                  <input type="text" name="infant" value="{{$flightData->infant}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Airlines</label>
                  <input type="text" name="airlines" value="{{$flightData->airlines}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Price</label>
                  <input type="text" name="price" value="{{$flightData->price}}" class="form-control" disabled >
                </div>
                
                
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Currency</label>
                  <input type="text" name="currency" value="{{$flightData->currency}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Fly From</label>
                  <input type="text" name="origon_airport" value="{{$flightData->origon_airport}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Fly To </label>
                  <input type="text" name="destination_airport" value="{{$flightData->destination_airport}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Oneway Departure Date</label>
                  <input type="text" name="oneway_departure_date" value="{{$flightData->oneway_departure_date}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Oneway Departure Time</label>
                  <input type="text" name="oneway_departure_time" value="{{$flightData->oneway_departure_time}}" class="form-control"disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Oneway Arrival Date</label>
                  <input type="text" name="oneway_arrival_date" value="{{$flightData->oneway_arrival_date}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Oneway Arrival Time</label>
                  <input type="text"   name="oneway_arrival_time" value="{{$flightData->oneway_arrival_time}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Booking Status </label>
                  <input type="text" "@if($flightData->booking_status ==  'Confirmed'){ style='background:#00FF00;color:#FFFFFF' } @else{ style='background:#FF0000;color:#FFFFFF' } @endif"  name="booking_status" value="{{$flightData->booking_status}}" class="form-control" disabled >
                </div>
                @if($flightData->booking_status=='Failed')
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Reason: </label> 
                  				@php
                                        $response_data=  $flightData->response_data;
                                        $response_dataArr=json_decode($response_data,true);
                                 @endphp
                  <?php echo "<pre>"; print_r($response_dataArr['errors'][0]); ?>
                </div>
                @endif
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Payment Status</label>
                  <input type="text" "@if($flightData->payment_status ==  'Confirmed'){ style='background:#00FF00;color:#FFFFFF' } @else{ style='background:#FF0000;color:#FFFFFF' } @endif" name="payment_status" value="{{$flightData->payment_status}}" class="form-control " disabled >
                </div>
                
                
                <div class="card-footer edit">
                    <button type="button" onclick="removeDisable()" class="btn btn-primary">Edit</button>
                  </div>
                
                <div class="card-footer update" style="display:none">
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