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
  <form action="{{ asset('update-currency-data') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Currency Data </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">                
            
                  <input type="hidden" name="id" value="{{$currencyData->id}}" class="form-control" disabled >
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Currency</label>
                  <input type="text" name="currency" value="{{$currencyData->currency}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Currency Name</label>
                  <input type="text" name="currency_name" value="{{$currencyData->currency_name}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Currency Symbol </label>
                  <input type="text" name="currency_symbol" value="{{$currencyData->currency_symbol}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Rate</label>
                  <input type="text" name="rate" value="{{$currencyData->rate}}" class="form-control" disabled >
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Published</label>
                  <input type="text" name="published" value="{{$currencyData->published}}" class="form-control" disabled >
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