@include('admin.header')
@include('admin.nav')

  @php 
    $service_name='';
    $icon_image=''; 
    $icon_image_alt_text='';
    $image='';
    $image_alt_text=''; $short_description=''; $type=''; $status='';  $id='';
  if(isset($serviceSingel)){ 
       $id=$serviceSingel->id; 
       $service_name=$serviceSingel->service_name; 
       $icon_image=$serviceSingel->icon_image;  
       $icon_image_alt_text=$serviceSingel->icon_image_alt_text;
       $image=$serviceSingel->image; 
       $image_alt_text=$serviceSingel->image_alt_text; 
       $short_description=$serviceSingel->short_description;  
       $type=$serviceSingel->type; 
       $status=$serviceSingel->status; 
   }
  
  @endphp
  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add service</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add service</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
    <form action="{{ asset('add-service-post') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary" data-select2-id="33">
            <div class="card-header">
              <h3 class="card-title">Add Service </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">   
              
              	<div class="form-group col-md-6" style="text-align:center">
                  <img height="200" width="200" src="{{$icon_image}}" /><br />
                   <input type="text" name="icon_image_alt_text" class="form-control" id="" placeholder="Enter icon image alt text">

                  <label for="exampleInputFile">Icon Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="icon_image_pre" value="{{$icon_image}}" class="custom-file-input" id="">
                      <input type="file" name="icon_image" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Icon Image</label>
                    </div>
                  </div>
                </div>
                
                 <div class="form-group col-md-6" style="text-align:center">
                  <img height="200" width="200" src="{{$image}}" /><br />
                   <input type="text" name="image_alt_text" class="form-control" id="" placeholder="Enter image alt text">

                  <label for="exampleInputFile">Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="image_pre" value="{{$image}}" class="custom-file-input" id="">
                      <input type="file" name="image" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Image</label>
                    </div>
                  </div>
                </div>

              
                <input type="hidden" name="id" value="{{$id}}" class="custom-file-input" id="">
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Service Name</label>  
                  <input type="text" name="service_name"  class="form-control" value="{{$service_name}}" required>
                </div>
                
                 <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Short Description</label>  
                  <textarea name="short_description"  class="form-control"  required>{{$short_description}}</textarea>
                </div>
                
        
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Type</label>
                  <div class="form-check"> 
                          <input type="radio" name="type" value="main" @php if($type=='main') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Main</label>		
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="type" value="addon" @php if($type=='addon') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Addon</label>
                  </div>
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Status</label>
                  <div class="form-check"> 
                          <input type="radio" name="status" value="active" @php if($status=='active') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Active</label>		
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="status" value="inactive" @php if($status=='inactive') echo "checked" @endphp class="form-check-input"><label class="form-check-label">In Active</label>
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
 