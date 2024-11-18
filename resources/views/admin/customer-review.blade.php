@include('admin.header')
@include('admin.nav')

  @php 
    $customer_name='';
    $profile_pic=''; 
    $customer_address='';
    $rating=''; $review=''; $id=''; $published='';
    $flight_type='return'; $outbound_days=''; $inbound_days=''; $adult='1'; $child=''; $infant=''; $price=''; $currency=''; $published='Yes';
  if(isset($reviewSingel)){ 
       $id=$reviewSingel->id; 
       $customer_name=$reviewSingel->customer_name; 
       $profile_pic=$reviewSingel->profile_pic;  
       $customer_address=$reviewSingel->customer_address;
       $rating=$reviewSingel->rating; 
       $review=$reviewSingel->review;
       $published=$reviewSingel->published; 
   }
  
  @endphp
  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Flight Booking List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Flight List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
    <form action="{{ asset('customer-review-post') }}" method="post" enctype="multipart/form-data">
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
              
              <div class="form-group col-md-12" style="text-align:center">
              <?php if(!isset($profile_pic) || $profile_pic=='' ){  $profile_pic= url('').'/images/noimage.png';   } ?>
                  <img height="200" width="200" src="{{$profile_pic}}" />
                </div>
                
                
                <div class="form-group col-md-12">
                  <label for="exampleInputFile">Profile Pic</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="profile_pic_pre" value="{{$profile_pic}}" class="custom-file-input" id="">
                      <input type="file" name="profile_pic" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Customer Profile Pic</label>
                    </div>
                  </div>
                </div>
              
                <input type="hidden" name="id" value="{{$id}}" class="custom-file-input" id="">
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Customer Name</label>  
                  <input type="text" name="customer_name" value="{{$customer_name}}" class="form-control" placeholder="Amit Kumar" required>
                </div>
                 <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Customer Address</label>  
                  <input type="text" name="customer_address" value="{{$customer_address}}" class="form-control" placeholder="New York, US" required>
                </div>
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Rating</label> 
                  <input type="text" name="rating" value="{{$rating}}" class="form-control" placeholder="5" required>
                </div>
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Review</label>  
                  <textarea type="text" name="review" class="form-control" placeholder="Customer Review" required>{{$review}}</textarea>
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
                  <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">Id</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly From: activate to sort column ascending">Customer Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">Profile Pic </th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="PNR: activate to sort column ascending">Address</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Customer Email: activate to sort column ascending">Rating</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Booking Date: activate to sort column ascending">Review</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Publish</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Date Time</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th></tr>
                  </thead>
                  <tbody>	

                  @foreach($reviewData as $key => $data)
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0"> {{$data->id}}  </td>
                    <td>{{$data->customer_name}}</td>
                    <td> <img src="{{$data->profile_pic}}" height="50" width="50"/></td>
                    <td>{{$data->customer_address}}</td>
                    <td>{{$data->rating}}</td>
                    <td>{{$data->review}} </td>
                    <td>{{$data->published}}</td>
                    <td>{{$data->date_time}}</td>
                     <td><div class="btn-group btn-group-sm">
                         <a href="{{ asset('customer-review') }}/{{$data->id}}" class="btn btn-info"><i class="fas fa-edit"></i></a>&nbsp;
                      </div></td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr><th rowspan="1" colspan="1">Id</th><th rowspan="1" colspan="1">Customer Name</th><th rowspan="1" colspan="1">Profile Pic</th><th rowspan="1" colspan="1">Address </th><th rowspan="1" colspan="1">Rating</th><th rowspan="1" colspan="1">Review</th><th rowspan="1" colspan="1">Publish</th><th rowspan="1" colspan="1">DateTime</th><th rowspan="1" colspan="1">Action</th></tr>
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
 