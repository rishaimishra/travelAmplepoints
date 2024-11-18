@include('admin.header')
@include('admin.nav')

  @php 
    $id='';
    $question=''; 
    $answer='';
    $category=''; $status=''; 
  if(isset($faqSingel)){ 
       $id=$faqSingel->id; 
       $question=$faqSingel->question; 
       $answer=$faqSingel->answer;  
       $category=$faqSingel->category; 
       $status=$faqSingel->status;   
   }
  
  @endphp
  <?php if(isset($_GET['msg'])){ echo "<script>alert('".$_GET['msg']."'); </script>";  } ?>


  <!-- Content Wrapper. Contains faq content -->
  <div class="content-wrapper">
    <!-- Content Header (FAQ header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add FAQ</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add FAQ</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
    <form action="{{ asset('add-faq-post') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary" data-select2-id="33">
            <div class="card-header">
              <h3 class="card-title">Add FAQ </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">   
                              
               <div class="form-group col-md-12 " >
 				<label for="exampleInputEmail1">Select Category</label> <br />
                <div class="row">
                            <select type="checkbox"  name="category" class="form-control select2">
                            
                    </select>
                     </div>
                </div>
              
                <input type="hidden" name="id" value="{{$id}}" class="custom-file-input" id="">
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Question</label>  
                  <input name="question"  class="form-control " value="{{$question}}" required> 
                </div>
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Answer</label>  
                  <input name="answer"  class="form-control " value="{{$answer}}" required> 
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
 