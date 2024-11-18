 @include('admin.header')
@include('admin.nav')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manual Wallet Fund Deduct</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Manual Wallet Fund Deduct</li>
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
 	<form action="{{ asset('manual-wallet-fund-deduct-post') }}" method="post" enctype="multipart/form-data">
  				@csrf 
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Manual Wallet Fund Deduct </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->     
              <div class="card-body">
              <div class="row">    
             
              	<input type="hidden" name="agent_id" value="<?php echo  $agent_id; ?>" class="custom-file-input" id="">
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Amount</label>
                  <input type="text" name="amount" value="" class="form-control"  >
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Deduct or Fund</label>
                  <select class="form-control select2" name="transaction_type">
                  		<option value="CREDITED">Fund (CREDIT)</option>
                        <option value="DEBITED">Deduct (DEBIT)</option>
                  </select>
                  <!--<input type="text" name="bank_name" value="" class="form-control"  >-->
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Payment Reference/ TXN Number / Order Id</label>
                  <input type="text" name="payment_reference" value="" class="form-control"  >
                </div>


                  
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">TXN Detail</label>
                  <textarea class="form-control" name="txn_detail" id="" cols="30" rows="4"></textarea>
                </div> 

                 <div class="card-footer update" ><button type="submit" class="btn btn-primary">Submit</button></div> 

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

  



