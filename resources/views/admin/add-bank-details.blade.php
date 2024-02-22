@include('admin.header')
@include('admin.nav')

  @php 
    $id='';
    $user_id=''; 
    $bank_name='';
    $ac_number=''; $ac_holder=''; $branch_name=''; $ac_type=''; $NEFT_IFSC=''; $more_details=''; $date_time=''; $status='';
  if(isset($bankSingel)){ 
       $id=$bankSingel->id; 
       $user_id=$bankSingel->user_id; 
       $bank_name=$bankSingel->bank_name;
       $ac_number=$bankSingel->ac_number; 
       $ac_holder=$bankSingel->ac_holder;  
       $branch_name=$bankSingel->branch_name; 
       $ac_type=$bankSingel->ac_type; 
       $NEFT_IFSC=$bankSingel->NEFT_IFSC;  
       $status=$bankSingel->status; 
       $more_details=$bankSingel->more_details; 
       $date_time=$bankSingel->date_time; 
       $status=$bankSingel->status; 
   }
  @endphp
  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add/Update Bank Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add/Update Bank Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
    <form action="{{ asset('add-bank-details-post') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary" data-select2-id="33">
            <div class="card-header">
              <h3 class="card-title">Add/Update Bank Details</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if (Session::has('message'))
               <div class="alert alert-info">{{-- Session::get('message') --}}</div>
            @endif
                        
              <div class="card-body">
              <div class="row">   
              
                <input type="hidden" name="id" value="{{$id}}" class="custom-file-input" id="">
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Bank Name</label>  
                  <input type="text" name="bank_name"  class="form-control" value="{{$bank_name}}" required placeholder="Bank Name" > 
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Account Holder / Beneficiary</label>  
                  <input type="text" name="ac_holder"  class="form-control" value="{{$ac_holder}}" required placeholder="Account Holder / Beneficiary" > 
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Branch Name</label>  
                  <input type="text" name="branch_name"  class="form-control" value="{{$branch_name}}" required placeholder="Branch Name" > 
                </div>
                
                 <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Account Number</label>  
                  <input type="text" name="ac_number"  class="form-control" value="{{$ac_number}}" required placeholder="Account Number" > 
                </div>                
             
                <div  class="form-group col-md-6">
                  <label for="exampleInputEmail1">Account type</label>  
                  <input type="text"  name="ac_type" class="form-control" value="<?php echo $ac_type; ?>"  required placeholder="Account Type" > 
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">IBAN / SWIFT / BIC CODE</label>  
                   <input type="text" name="NEFT_IFSC" class="form-control" value="{{$NEFT_IFSC}}" required placeholder="IBAN / SWIFT / BIC CODE" > 
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">More Details</label>  
                  <textarea name="more_details" class="form-control summernote" required><?php if(isset($more_details)){ echo $more_details; } ?></textarea>
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Status</label>
                  <div class="form-check"> 
                          <input type="radio" name="status" value="active" @php if($status=='active') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Active</label>		
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="status" value="inactive" @php if($status=='inactive') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Inactive</label>
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
    
    <!-- /.content -->
  </div>
  

  
  
@include('admin.footer')




<script>
function changeImage(input,targetImg){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {			
				var image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    var height = this.height; 
                    var width = this.width;
					var l=1024; var w= 1024;
                    if (height > l || width > w) {
                       // alert("Height and Width must not exceed "+l);
					//	$('#'+targetImg).val(''); 
                     //   return false;  
                    }
					$('.'+targetImg).attr('src', e.target.result);
                    return true;
              	};
        }
        reader.readAsDataURL(input.files[0]);	
    }	
}
</script>
 