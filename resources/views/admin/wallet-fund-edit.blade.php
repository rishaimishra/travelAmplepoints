 @include('admin.header')
@include('admin.nav')

  @php 
	$profile_pic=''; $id=''; $first_name=''; $last_name=''; $email=''; $phone=''; $address=''; $city=''; $country=''; $user_type=''; $status=''; $is_member='';
  if(isset($walletData)){ 
       $id=$walletData->id; 
       $agent_id=$walletData->agent_id;
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
   }
  
  @endphp
  
 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Wallet Fund Edit</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Wallet Fund Edit</li>
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
  <form action="{{ asset('wallet-fund-update') }}" method="post" enctype="multipart/form-data">
  @csrf


  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Wallet Fund Edit </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">    
              
              	<input type="hidden" name="id" value="<?php echo  $id; ?>" class="custom-file-input" id="">


                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Amount</label>
                  <input type="text" name="amount" value="" class="form-control"  >
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Bank Name</label>
                  <input type="text" name="bank_name" value="" class="form-control"  >
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Payment Reference </label>
                  <input type="text" name="payment_reference" value="" class="form-control"  >
                </div>

                <div class="form-group col-md-6">
                    <label for="exampleInputFile">Proof of Payment</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="proof_of_payment" class="custom-file-input" id="">
                        <label class="custom-file-label" for="exampleInputFile">Upload Proof</label>
                      </div>
                    </div>
                  </div>
                  

                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Remarks</label>
                  <textarea class="form-control" name="remarks" id="" cols="30" rows="4"></textarea>
                </div> 
                        
              
             </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>


  <section><div class="card-footer update" ><button type="submit" class="btn btn-primary">Save</button></div>  </section>
      </form> 
  <!-- /.content -->
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
  

