@include('admin.header')
@include('admin.nav')

  @php 
    $id='';
    $page_id=''; 
    $name='';
    $title=''; $meta_keywords=''; $meta_description=''; $status=''; $b_image=''; $content=''; $type_name=''; $type='';
  if(isset($pageSingel)){ 
       $id=$pageSingel->id; 
       $page_id=$pageSingel->page_id;
       $name=$pageSingel->name; 
       $title=$pageSingel->title;  
       $meta_keywords=$pageSingel->meta_keywords; 
       $meta_description=$pageSingel->meta_description; 
       $content=$pageSingel->content;  
       $status=$pageSingel->status; 
       $b_image=$pageSingel->image; 
       $type_name=$pageSingel->type_name; 
       $type=$pageSingel->type; 
       $oc=json_decode($pageSingel->other_content,true); 
   }
  @endphp
  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add/Update Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add/Update Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
    <form action="{{ asset('add-page-post') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary" data-select2-id="33">
            <div class="card-header">
              <h3 class="card-title">Add/Update Page </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if (Session::has('message'))
               <div class="alert alert-info">{{-- Session::get('message') --}}</div>
            @endif
                        
              <div class="card-body">
              <div class="row">   
              
                <div class="form-group col-md-12" onclick="getElementById('b_image').click()" style="cursor:pointer">
                <div style="text-align:center">
                  <img class="b_image" height="200" width="200" src="{{asset($b_image)}}" />
                </div>                
                  <div class="input-group" style="display:none">
                    <div class="custom-file">
                    <input type="hidden" name="image_pre" value="{{$b_image}}" class="custom-file-input" id="">
                      <input type="file"  name="b_image" id="b_image" accept="image/png" onchange="changeImage(this,'b_image');" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Beard Comb Image</label>
                    </div>
                  </div>
                </div>
                
               <div class="form-group col-md-12 " style="display:none">
 				<label for="exampleInputEmail1">Select Page</label> <br />
                <div class="row">
                    <input type="hidden" name="type" value="{{$type}}" class="custom-file-input" id=""> 
                    <input type="hidden" name="type_name" value="{{$type_name}}" class="custom-file-input" id=""> 
                    <input type="hidden" name="redirect_url" value="add-page" class="custom-file-input" id="">        
                     </div>
                </div>
              
                <input type="hidden" name="id" value="{{$id}}" class="custom-file-input" id="">
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Page ID</label>  
                  <input name="page_id"  class="form-control " value="{{$page_id}}" readonly="readonly" required> 
                </div>
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Name</label>  
                  <input name="name"  class="form-control " value="{{$name}}" > 
                </div>
                
                 <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Meta Title</label>  
                  <input name="title"  class="form-control " value="{{$title}}" required> 
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Meta keywords</label>  
                  <input name="meta_keywords"  class="form-control " value="{{$meta_keywords}}" required> 
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Meta Description</label>  
                  <textarea name="meta_description"  class="form-control " value="" required > {{$meta_description}}</textarea> 
                </div>
             
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Main Content</label>  
                  <textarea name="content" class="form-control summernote" placeholder="New York, US" required><?php echo $content; ?></textarea>
                </div>
                
                @if($type=='landing' && ($type_name=='city' || $type_name=='country') )
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Hotel Page Content</label>  
                  <textarea name="$oc[hotel]" class="form-control summernote" required><?php if(isset($oc['hotel'])){ echo $oc['hotel']; } ?></textarea>
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Flihgt Page Content</label>  
                  <textarea name="oc[flight]" class="form-control summernote" required><?php if(isset($oc['flight'])){ echo $oc['flight']; } ?></textarea>
                </div>
                @endif
                
                <?php $count=-1; if($page_id=='about'){ $count=7; }else if($page_id=='support'){ $count=6; }else if($page_id=='home'){ $count=3; } ?>
                  @for($i=0;$i< $count;$i++)
                    <div class="form-group col-md-4" >
                    <div style="background: antiquewhite;border-radius: 10px;padding: 10px; margin:2px">
                    	<label for="exampleInputFile">Column {{$i+1}}</label>
                        <div style="text-align:center;cursor:pointer" onclick="getElementById('image{{$i}}').click()" ><?php if(!isset($oc['images'][$i])){ $oc['images'][$i]=''; } ?>
                          <img class="image{{$i}}" height="200" width="200" src="{{ asset($oc['images'][$i]) }} " />
                        </div>                                      
                      <div class="input-group" style="display:none">
                        <div class="custom-file"> 
                        <input type="hidden" name="image_pre_{{$i}}" value="<?php echo $oc['images'][$i]; ?>" class="custom-file-input" id="">
                          <input type="file" id="image{{$i}}" onchange="changeImage(this,'image{{$i}}');" name="image_{{$i}}" class="custom-file-input" id="">
                          <label class="custom-file-label" for="exampleInputFile">Column {{$i+1}} Image</label>
                        </div>
                      </div>
                      <label for="exampleInputEmail1">Image alt Text</label> <?php if(!isset($oc['alt_text'][$i])){ $oc['alt_text'][$i]=''; } ?>
                      <input type="text" name="oc[alt_text][]" value="<?php echo $oc['alt_text'][$i]; ?>" class="form-control" id="">
                      <div class="form-group">
                  		<label for="exampleInputEmail1">Heading</label> <?php if(!isset($oc['heading'][$i])){ $oc['heading'][$i]=''; } ?>
                      <input type="text" name="oc[heading][]" value="<?php echo $oc['heading'][$i]; ?>" class="form-control" id="">
                      <label for="exampleInputEmail1">Link</label> <?php if(!isset($oc['link'][$i])){ $oc['link'][$i]=''; } ?>
                      <input type="text" name="oc[link][]" value="<?php echo $oc['link'][$i]; ?>" class="form-control" id="">
                      <label for="exampleInputEmail1">content</label> <?php if(!isset($oc['content'][$i])){ $oc['content'][$i]=''; } ?>
                     <textarea name="oc[content][]" class="form-control" placeholder="" ><?php echo $oc['content'][$i]; ?></textarea>
                     </div>
                     </div>
                    </div> 
                    @endfor
                    
                     @if($page_id=='home')
                     <div class="form-group col-md-4"><?php if(!isset($oc['flight_heading'])){ $oc['flight_heading']=''; } ?>               
                      <label for="exampleInputEmail1">Flight Heading</label>
                      <input type="text" name="oc[flight_heading]" value="<?php echo $oc['flight_heading']; ?>" class="form-control" id="">
                     </div>
                     <div class="form-group col-md-4">                      
                      <label for="exampleInputEmail1">Hotel Heading</label><?php if(!isset($oc['hotel_heading'])){ $oc['hotel_heading']=''; } ?>
                      <input type="text" name="oc[hotel_heading]" value="<?php echo $oc['hotel_heading']; ?>" class="form-control" id="">
                     </div>
                     
                     <div class="form-group col-md-4"><?php if(!isset($oc['blog_heading'])){ $oc['blog_heading']=''; } ?>               
                      <label for="exampleInputEmail1">Blog Heading</label>
                      <input type="text" name="oc[blog_heading]" value="<?php echo $oc['blog_heading']; ?>" class="form-control" id="">
                     </div>
                     <div class="form-group col-md-4">                      
                      <label for="exampleInputEmail1">Review Heading</label><?php if(!isset($oc['review_heading'])){ $oc['review_heading']=''; } ?>
                      <input type="text" name="oc[review_heading]" value="<?php echo $oc['review_heading']; ?>" class="form-control" id="">
                     </div>
                     <div class="form-group col-md-4">                      
                      <label for="exampleInputEmail1">Other Heading</label><?php if(!isset($oc['other_heading'])){ $oc['other_heading']=''; } ?>
                      <input type="text" name="oc[other_heading]" value="<?php echo $oc['other_heading']; ?>" class="form-control" id="">
                     </div>
                     
                     @endif
                    
                   @if($page_id=='about') 
                    <div class="form-group col-md-4">
                    <div style="text-align:center">
                      <img height="200" width="200" src="{{ asset($oc['main_image_1']) }}" />
                    </div>                
                      <label for="exampleInputFile">Main Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                        <input type="hidden" name="main_image_1_pre" value="<?php echo $oc['main_image_1']; ?>" class="custom-file-input" id="">
                          <input type="file" name="main_image_1" class="custom-file-input" id="">
                          <label class="custom-file-label" for="exampleInputFile">Main Image 1</label>
                        </div>
                      </div>
                      <label for="exampleInputEmail1">Main Image alt Text</label>
                      <input type="text" name="oc[main_image_1_alt_text]" value="<?php echo $oc['main_image_1_alt_text']; ?>" class="form-control" id="">
                     </div>
                    <div class="form-group col-md-4">
                    <div style="text-align:center">
                      <img height="200" width="200" src=" {{ asset($oc['main_image_2']) }} " />
                    </div>                
                      <label for="exampleInputFile">Main Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                        <input type="hidden" name="main_image_2_pre" value="<?php echo $oc['main_image_2']; ?>" class="custom-file-input" id="">
                          <input type="file" name="main_image_2" class="custom-file-input" id="">
                          <label class="custom-file-label" for="exampleInputFile">Main Imag 2</label>
                        </div>
                      </div>
                      <label for="exampleInputEmail1">Main Image alt Text</label>
                      <input type="text" name="oc[main_image_2_alt_text]" value="<?php echo $oc['main_image_2_alt_text']; ?>" class="form-control" id="">
                     </div>
                    @endif
                     
                     
                    
                     
                    
                   
                 
             
         
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


<script src='https://www.abengines.com/wp-content/themes/adivaha_main/js/tinymce.min.js' referrerpolicy="origin"></script>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

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
 