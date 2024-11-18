@include('admin.header')
@include('admin.nav')

  @php 
    $quote='';
    $thumbnail=''; 
    $heading='';
    $sub_heading=''; $content=''; $id=''; $published=''; $category=array(); $quotes='';
  if(isset($blogSingel)){ 
       $id=$blogSingel->id; 
       $heading=$blogSingel->heading; 
       $thumbnail=$blogSingel->thumb_nail;  
       $sub_heading=$blogSingel->sub_heading;
       $content=$blogSingel->content; 
       $published=$blogSingel->published; 
       $quotes=$blogSingel->quotes;  
       $category=json_decode($blogSingel->category,true); 
   }
   
   $sessionval=session()->all();
  
  @endphp
  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Blog</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Blog</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
    <form action="{{ asset('add-blog-post') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary" data-select2-id="33">
            <div class="card-header">
              <h3 class="card-title">Add Blog </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">   
              
              <div class="form-group col-md-12" style="text-align:center">
              <?php if(!isset($thumbnail) || $thumbnail=='' ){  $thumbnail= url('').'/images/noimage.png';   } ?>
                  <img height="200" width="200" src="{{$thumbnail}}" />
                </div>
                
                
                <div class="form-group col-md-12">
                  <label for="exampleInputFile">Thumbnail Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="thumb_nail_pre" value="{{$thumbnail}}" class="custom-file-input" id="">
                      <input type="file" name="thumb_nail" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Thumbnail Image</label>
                    </div>
                  </div>
                </div>
              
                <input type="hidden" name="id" value="{{$id}}" class="custom-file-input" id="">
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Heading</label>  
                  <textarea name="heading"  class="form-control summernote" required>{{$heading}}</textarea>
                </div>
                
                 <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Sub Heading</label>  
                  <textarea name="sub_heading"  class="form-control summernote" placeholder="New York, US" required>{{$sub_heading}}</textarea>
                </div>
                
                	
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Content</label>  
                  <textarea name="content" class="form-control summernote" placeholder="New York, US" required>{{$content}}</textarea>
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Quotes</label>  
                  <textarea name="quotes"  class="form-control summernote" placeholder="New York, US" required>{{$quotes}}</textarea>
                </div>
                
                <div class="form-group col-md-12 ">
 				<label for="exampleInputEmail1">Category</label> <br />
                <div class="row">
                   @foreach($bcData as $key => $data)
                    <div class="icheck-primary d-inline col-md-1" style="margin-right:15px">
                            <input type="checkbox" '@if(in_array($data->category, $category)) checked @endif' name="category[]" value="{{$data->category}}" id="checkboxPrimary{{$data->id}}">
                            <label for="checkboxPrimary{{$data->id}}">
                              {{$data->category}}
                            </label>
                    </div>
                    @endforeach
                     </div>
                </div>
                
                               
                <div class="form-group col-md-1" @if($sessionval['user_type']!='admin') style="display:none" @endif>
                  <label for="exampleInputEmail1">Published</label>
                  <div class="form-check"> 
                          <input type="radio" name="published" value="Yes" @php if($published=='Yes') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Yes</label>		
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="published" value="No" @php if($published=='No' || $sessionval['user_type']!='admin') echo "checked" @endphp class="form-check-input"><label class="form-check-label">No</label>
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
 