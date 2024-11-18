 @include('admin.header')
@include('admin.nav')
  @php 
	$profile_pic=''; $id=''; $first_name=''; $last_name=''; $email=''; $phone=''; $address=''; $city=''; $country=''; $user_type=''; $status=''; $is_member='';
  if(isset($userData)){ 
       $id=$userData->id; 
       $profile_pic=$userData->profile_pic;
       $first_name=$userData->first_name; 
       $last_name=$userData->last_name;  
       $email=$userData->email; 
       $phone=$userData->phone; 
       $address=$userData->address;  
       $city=$userData->city; 
       $country=$userData->country; 
       $user_type=$userData->user_type; 
       $status=$userData->status;  
       $is_member= $userData->is_member; 
       $role= $userData->role;
       
                 $common=json_decode($userData->common_data,true);
                $images=json_decode($userData->images,true);
                $sessionval=session()->all();
                $currency=$data['siteData']['currency']; 
                $currency_symbol=$data['siteData']['currency_symbol']; 
   }
  
  @endphp
  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Fund Wallet By Payment Gateway</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Fund Wallet By Payment Gateway</li>
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
 	<form action="{{ asset('wallet-fund-by-pg-post') }}" method="post" enctype="multipart/form-data">
  				@csrf 
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Fund Wallet By Payment Gateway </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->     
              <div class="card-body">
              <div class="row">    
             
              	<input type="hidden" name="id" value="<?php echo  $id; ?>" class="custom-file-input" id="">
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Amount</label>
                  <input type="number" name="amount" value="" class="form-control"  required>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Select Payment Gateway</label>
                  <select class="form-control select2" name="bank_name" required>
                  		@foreach($bankData as $key => $data)
                  		<option value="{{$data->id}}">{{$data->bank_name}}</option>
                  		@endforeach
                  </select>
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Remarks</label>
                  <textarea class="form-control" name="remarks" id="" cols="30" rows="4"></textarea>
                </div> 
                
                 <div class="card-footer update" ><button type="submit" class="btn btn-primary">Next</button></div> 
             

             </div>

            </div>

          </div>

          <!-- /.card -->

        </div>

      </div>

    </div>

  </section>

</div>



@include('admin.footer')



  <script src="https://js.braintreegateway.com/web/dropin/1.32.1/js/dropin.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://www.abengines.com/javascript/iframeConsoleUI.min.js"/></script>



  <script type="text/javascript">

    changeCurrency();

	function changeCurrency(){

	 var currency=document.getElementById('currency').value;

	 

	 jQuery(".currency_symbol").removeAttr("selected"); 

	 jQuery("."+currency).attr('selected','selected');



	}

	

	function showhideMember(x){

		if(x==1){  jQuery(".member").show(); }

		else{ jQuery(".member").hide();  }

	 }

	

  </script>

  



