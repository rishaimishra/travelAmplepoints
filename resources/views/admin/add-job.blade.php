@include('admin.header')
@include('admin.nav')

  @php 
    $name='';
    $location=''; 
    $heading=''; $Salary=''; $Application_Deadline=''; $status='';
    $About_Job=''; $Job_Responsibilities=''; $id=''; $Requirements=''; $What_do_we_offer=''; $Vacancy=''; $Employment_Status=''; $Experience=''; $Gender=''; $Age='';
  if(isset($jobSingel)){ 
       $id=$jobSingel->id; 
       $name=$jobSingel->name; 
       $location=$jobSingel->location;  
       $About_Job=$jobSingel->About_Job;
       $Job_Responsibilities=$jobSingel->Job_Responsibilities; 
       $Requirements=$jobSingel->Requirements; 
       $What_do_we_offer=$jobSingel->What_do_we_offer;  
       
       $Vacancy=$jobSingel->Vacancy; 
       $Employment_Status=$jobSingel->Employment_Status; 
       $Experience=$jobSingel->Experience; 
       $Gender=$jobSingel->Gender; 
       $Age=$jobSingel->Age; 
       $Salary=$jobSingel->Salary; 
       
       $Application_Deadline=$jobSingel->Application_Deadline; 
       $status=$jobSingel->status; 
        
   }
  
  @endphp
  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Job</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Job</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
    <form action="{{ asset('add-job-post') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary" data-select2-id="33">
            <div class="card-header">
              <h3 class="card-title">Add Job </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">   
              
                <input type="hidden" name="id" value="{{$id}}" class="custom-file-input" id="">
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Name</label>  
                  <input type="text" name="name"  class="form-control" value="{{$name}}" required>
                </div>
                
                 <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Location</label>  
                   <input type="text" name="location"  class="form-control" value="{{$location}}" required>
                </div>
                
                	
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">About Job</label>  
                  <textarea name="About_Job" class="form-control summernote"  required>{{$About_Job}}</textarea>
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Job Responsibilities</label>  
                  <textarea name="Job_Responsibilities"  class="form-control summernote"  required>{{$Job_Responsibilities}}</textarea>
                </div>
                
                 <div class="form-group col-md-12">
                  <label for="exampleInputEmail1"> Requirements</label>  
                  <textarea name="Requirements"  class="form-control summernote"  required>{{$Requirements}}</textarea>
                </div>
                
                 <div class="form-group col-md-12">
                  <label for="exampleInputEmail1"> What do we offer</label>  
                  <textarea name="What_do_we_offer"  class="form-control summernote"  required>{{$What_do_we_offer}}</textarea>
                </div>
                
                 <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Vacancy</label>  
                   <input type="text" name="Vacancy"  class="form-control" placeholder="02"  value="{{$Vacancy}}" required>
                </div>
                
                 <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Employment_Status</label>  
                   <input type="text" name="Employment_Status"  class="form-control" placeholder="Full-time"  value="{{$Employment_Status}}" required>
                </div>
                
                 <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Experience</label>  
                   <input type="text" name="Experience"  class="form-control" placeholder="At least 2 year(s)"  value="{{$Experience}}" required>
                </div>
                
                 <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Gender</label>  
                   <input type="text" name="Gender"  class="form-control" placeholder="Male or Female or Both" value="{{$Gender}}" required>
                </div>
                
                 <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Age</label>  
                   <input type="text" name="Age"  class="form-control" placeholder="Age 24 to 32 years" value="{{$Age}}" required>
                </div>
                
                 <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Salary</label>  
                   <input type="text" name="Salary"  class="form-control" placeholder="35000 - 45000 (Monthly)"  value="{{$Salary}}" required>
                </div>
                
                 <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Application_Deadline</label>  
                   <input type="text" name="Application_Deadline" placeholder="26 Nov 2020"  class="form-control" value="{{$Application_Deadline}}" required>
                </div>                
                
                               
                <div class="form-group col-md-3">
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
 