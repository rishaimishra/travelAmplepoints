@include('admin.header')
@include('admin.nav')

  @php 
    $from_iata='';
    $to_iata=''; 
    $fly_from='';
    $fly_to=''; $id=''; $airline='';
    $flight_type='return'; $outbound_days=''; $inbound_days=''; $adult='1'; $child=''; $infant=''; $price=''; $currency=''; $published='Yes';
  if(isset($flightSingel)){ 
       $id=$flightSingel->id; 
       $from_iata=$flightSingel->from_iata; 
       $to_iata=$flightSingel->to_iata; 
       $fly_from=$flightSingel->fly_from; 
       $fly_to=$flightSingel->fly_to;
       $flight_type=$flightSingel->flight_type;
       $outbound_days=$flightSingel->outbound_days; 
       $inbound_days=$flightSingel->inbound_days; 
       $adult=$flightSingel->adult; 
       $child=$flightSingel->child;
       $infant=$flightSingel->infant; 
       $price=$flightSingel->price; 
       $currency=$flightSingel->currency; 
       $published=$flightSingel->published;
       $airline=$flightSingel->airline;   
       
   }
  
  @endphp
  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Flight Widget Set UP</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Flight Widget Set UP</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
    <form action="{{ asset('flight-widget-post') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">User Data </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">   
                <input type="hidden" name="id" value="{{$id}}" class="custom-file-input" id="">
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">From IATA</label>
                  <input type="text" name="from_iata" value="{{$from_iata}}" class="form-control" placeholder="i.e DEL" required>
                </div>
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">To IATA</label>
                  <input type="text" name="to_iata" value="{{$to_iata}}" class="form-control" placeholder="i.e BOM" required>
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Fly From</label>
                  <input type="text" name="fly_from" value="{{$fly_from}}" class="form-control" placeholder="i.e Delgi" required>
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Fly To</label>
                  <input type="text" name="fly_to" value="{{$fly_to}}" class="form-control" placeholder="i.e Mumbai" required>
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Flight Type </label>
                  <div class="form-check">
                          <input type="radio" name="flight_type" value="oneway" @php if($flight_type=='oneway') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Oneway</label>		
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="flight_type" value="return" @php if($flight_type=='return') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Return</label>
                  </div>
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Outbond Days </label>
                  <input type="number" name="outbound_days" value="{{$outbound_days}}" class="form-control" placeholder="i.e 2" required>
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Inbound Days</label>
                  <input type="number" name="inbound_days" value="{{$inbound_days}}" class="form-control" placeholder="i.e 2" required> 
                </div>
                
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">Adult</label>
                  <input type="number" name="adult" value="{{$adult}}" class="form-control" placeholder="i.e 1" required>
                </div>
                
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">Child</label>
                  <input type="number" name="child" value="{{$child}}" class="form-control" placeholder="i.e 1" required>
                </div>
                
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">Infant</label>
                  <input type="numbar" name="infant" value="{{$infant}}" class="form-control" placeholder="i.e 1" required>
                </div>
                
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">Price</label>
                  <input type="text" name="price" value="{{$price}}" class="form-control" placeholder="i.e 296" required>
                </div>
                
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">Currency</label>
                  <input type="text" name="currency" value="{{$currency}}" class="form-control" placeholder="i.e INR" required>
                </div>
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">airline</label>
                  <input type="text" name="airline" value="{{$airline}}" class="form-control" placeholder="i.e AI" required>
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
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Flight List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                  <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">SN</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly From: activate to sort column ascending">Fly From</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">Fly To</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="PNR: activate to sort column ascending">Type</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Customer Email: activate to sort column ascending">Outbound Days</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Booking Date: activate to sort column ascending">Inbound Days</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Payment Method: activate to sort column ascending">Passenger</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Publish</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Price</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Date Time</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th></tr>
                  </thead>
                  <tbody>	 @php $i=1; @endphp
                  @foreach($flightData as $key => $data)
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0"> {{$data->id}}  </td>
                    <td>{{$data->fly_from}} <br />({{$data->from_iata}}) </td>
                    <td>{{$data->fly_to}} <br /> ({{$data->to_iata}})</td>
                    <td>{{$data->flight_type}}</td>
                    <td>{{$data->outbound_days}}</td>
                    <td>{{$data->inbound_days}} </td>
                    <td>ADT: {{$data->adult}}<br /> CHD: {{$data->child}}<br /> INF: {{$data->infant}}</td>
                    <td>{{$data->published}}</td>
                    <td>{{$data->currency}} {{$data->price}}</td>
                    <td>{{$data->date_time}}</td>
                     <td><div class="btn-group btn-group-sm">
                         <a href="{{ asset('flight-widget') }}/{{$data->id}}" class="btn btn-info"><i class="fas fa-edit"></i></a>&nbsp;
                      </div></td>
                  </tr> @php $i++; @endphp
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr><th rowspan="1" colspan="1">SN</th><th rowspan="1" colspan="1">Fly From</th><th rowspan="1" colspan="1">Fly To</th><th rowspan="1" colspan="1">Type </th><th rowspan="1" colspan="1">Outbound Day</th><th rowspan="1" colspan="1">Inbound Day</th><th rowspan="1" colspan="1">Passenger</th><th rowspan="1" colspan="1">Publish</th><th rowspan="1" colspan="1">Price</th><th rowspan="1" colspan="1">DateTime</th><th rowspan="1" colspan="1">Action</th></tr>
                  </tfoot>
                </table></div></div></div>
              </div>
              <!-- /.card-body -->
            </div>
        <!-- /.row -->
        <!-- Main row -->
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  
@include('admin.footer')
 