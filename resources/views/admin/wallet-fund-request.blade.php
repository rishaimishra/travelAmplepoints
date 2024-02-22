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
               
   }
  
  @endphp
  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Fund Wallet Request</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Fund Wallet Request</li>
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
 	<form action="{{ asset('wallet-fund-request-post') }}" method="post" enctype="multipart/form-data">
  				@csrf 
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Fund Wallet Request </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->     
              <div class="card-body">
              <div class="row">    
             
              	<input type="hidden" name="id" value="<?php echo  $id; ?>" class="custom-file-input" id="">
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Amount</label>
                  <input type="hidden" name="type" value="Request" class="form-control" required>
                  <input type="number" name="amount" value="" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Select Bank</label>
                  <select class="form-control select2" name="bank_name" required >
                  @foreach($bankData as $key => $data)
                  		<option value="{{$data->id}}">{{$data->bank_name}}(A/C- {{$data->ac_number}} )</option>
                  @endforeach
                  </select>
                  <!--<input type="text" name="bank_name" value="" class="form-control"  >-->
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Payment Reference / Trasanction ID</label>
                  <input type="text" name="payment_reference" value="" class="form-control"  required>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputFile">Proof of Payment</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="proof_of_payment" class="custom-file-input" id="" required>
                        <label class="custom-file-label" for="exampleInputFile">Upload Proof</label>
                      </div>
                    </div>
                  </div>
                  
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Remarks</label>
                  <textarea class="form-control" name="remarks" id="" cols="30" rows="4"></textarea>
                </div> 
                
                
                 <div class="card-footer update" ><button type="submit" class="btn btn-primary">Send</button></div>                 
                        
              
             </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
   </form> 

    <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Note:- For wallet fund you need to transfer amount to following bank account then sfter submit request by above form . After that within 24 hour fund is transfer in you wallet.</h3>
            </div>
         </div>
      </div>
    </div>
   </div>
   </section>

  <div style="display:flex;">
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->@php $i=1; @endphp
        @foreach($bankData as $key => $data)
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Payment Option {{$i}}</h3>
            </div>
              <div class="card-body">
              <div class="row">    
                <p class="form-control">Bank: {{ $data->bank_name }}</p> 
                <p class="form-control">A/C Number: {{ $data->ac_number }}</p>
                <p class="form-control">A/C Holder Name: {{ $data->ac_holder }}</p>
                <p class="form-control">Branch Name: {{ $data->branch_name }}</p>
                <p class="form-control">A/C Type: {{ $data->bank_name }}</p>
                <p class="form-control">IBAN / SWIFT / BIC CODE: {{ $data->NEFT_IFSC }}</p>
                <?php echo $data->more_details; ?>
             </div>
            </div>
          </div>
          
        </div>
        @php $i++; @endphp
        @endforeach
      </div>
    </div>
  </section>
 
  </div>
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