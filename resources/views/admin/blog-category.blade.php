@include('admin.header')
@include('admin.nav')

  @php 
    $category='';
    $status=''; 
    $parent_id='';
    $id='';
  if(isset($bcSingel)){ 
       $id=$bcSingel->id; 
       $category=$bcSingel->category; 
       $status=$bcSingel->status;  
       $parent_id=$bcSingel->parent_id;
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
            <h1 class="m-0">Blog Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blog Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
    <form action="{{ asset('blog-category-post') }}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Blog Category </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">   
              
                <input type="hidden" name="id" value="{{$id}}" class="custom-file-input" id="">
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Category Name</label>  
                  <input type="text" name="category" value="{{$category}}" class="form-control" placeholder="Travel" required>
                </div>
                 <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Parent Category</label>  
                  <input type="text" name="parent_id" value="{{$parent_id}}" class="form-control" >
                </div>
                
                  
                  <div class="form-group col-md-2" @if($sessionval['user_type']!='admin') style="display:none" @endif>
                  <label for="exampleInputEmail1">Status</label>
                  <div class="form-check"> 
                          <input type="radio" name="status" value="active" @php if($status=='active' || $sessionval['user_type']!='admin') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Active</label>		
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
    @if($sessionval['user_type']=='admin')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Blog Category List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                  <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">Id</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly From: activate to sort column ascending">Parent Category</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">Category</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="PNR: activate to sort column ascending">Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Date Time</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th></tr>
                  </thead>
                  <tbody>	

                  @foreach($bcData as $key => $data)
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0"> {{$data->id}}  </td>
                    <td>{{$data->parent_id}}</td>
                    <td>{{$data->category}}</td>
                    <td>{{$data->status}}</td>
                    <td>{{$data->date_time}} </td>
                     <td><div class="btn-group btn-group-sm">
                         <a href="{{ asset('blog-category') }}/{{$data->id}}" class="btn btn-info"><i class="fas fa-edit"></i></a>&nbsp;
                      </div></td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr><th rowspan="1" colspan="1">Id</th><th rowspan="1" colspan="1">Parent Category</th><th rowspan="1" colspan="1">Category</th><th rowspan="1" colspan="1">Status</th><th rowspan="1" colspan="1">DateTime</th><th rowspan="1" colspan="1">Action</th></tr>
                  </tfoot>
                </table></div></div></div>
              </div>
              <!-- /.card-body -->
            </div>
        <!-- /.row -->
        <!-- Main row -->
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @endif
  </div>
  
  
@include('admin.footer')
 