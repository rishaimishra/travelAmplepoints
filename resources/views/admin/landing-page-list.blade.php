@include('admin.header')
@include('admin.nav')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ucfirst($product)}} Landing Page List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ucfirst($product)}} Landing Page List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ucfirst($product)}} Landing Page List</h3>
                &nbsp;&nbsp;&nbsp;&nbsp;<!--<a href="{{ asset('add-landing-page/'.$product) }}">Add Page</a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                  <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">SN</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly From: activate to sort column ascending">Page Url</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">Page Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">City</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">Country</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">Price</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Date Time</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th></tr>
                  </thead>
                  <tbody>	 @php $i=1; @endphp
                  @foreach($pageData as $key => $data) @php $oc=json_decode($data->other_content,true);  @endphp
                  <tr class="odd"> 
                    <td class="dtr-control sorting_1" tabindex="0"> {{$i}}  </td>
                    <td><?php echo $data->page_id; ?> </td>   
                    <td><?php echo $data->name; ?></td> 
                    <td><?php echo $data->city_to; ?></td>  
                    <td><?php echo $data->county_to_code; ?></td>
                    <td><?php  if(isset($oc['currency'])){ echo $oc['currency']." "; } if(isset($oc['price'])){ echo $oc['price']; }  ?></td>
                    <td>@if($data->status=='active')<span class="badge bg-danger">{{$data->status}}@endif</span>
                    @if($data->status=='inactive')<span class="badge bg-success">{{$data->status}}@endif</span></td>
                     <td>{{$data->date_time}}</td>
                     <td><div class="btn-group btn-group-sm">
                        <a href="{{ asset('add-landing-page/'.$data->type_name.'/'.$data->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>&nbsp;
                        <!--<a href="add-landing-page/{{$data->id}}" class="btn btn-success"><i class="fas fa-eye"></i></a>&nbsp;-->
                      </div></td>
                  </tr>@php $i++; @endphp
                  @endforeach
                  </tbody>
                  <tfoot> 
                  <tr><th rowspan="1" colspan="1">SN</th><th rowspan="1" colspan="1">Page Url</th><th rowspan="1" colspan="1">Page Name</th><th rowspan="1" colspan="1">City</th><th rowspan="1" colspan="1">Country</th><th rowspan="1" colspan="1">Price</th><th rowspan="1" colspan="1">Status</th><th rowspan="1" colspan="1">Date Time</th><th rowspan="1" colspan="1">Action</th></tr>
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
  </div>
  
  
@include('admin.footer')
 