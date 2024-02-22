@include('admin.header')
@include('admin.nav')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ucfirst($type_name)}} List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ucfirst($type_name)}} List</li>
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
                <h3 class="card-title">{{ucfirst($type_name)}} List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                  <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">SN</th>@if($type_name=='city')<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly From: activate to sort column ascending">Airport</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">City</th>@endif<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">Country</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">Is Landing</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th></tr>
                  </thead>
                  <tbody>	 @php $i=1; @endphp
                  @foreach($cityData as $key => $data)
                  <tr class="odd"> 
                    <td class="dtr-control sorting_1" tabindex="0"> {{$i}}  </td>
                   @if($type_name=='city')<td><?php echo $data->name." (".$data->code.")"; ?></td>  
                    <td><?php echo $data->city_name." (".$data->city_code.")"; ?></td> @endif
                    <td><?php echo $data->country_name." (".$data->country_code.")"; ?></td>  
                    
                   @if($type_name=='city')
                   <td>
                   		@if($data->cityLanding=='No')<span class="badge bg-danger">{{strtoupper($data->cityLanding)}}@endif</span>
                    	@if($data->cityLanding=='Yes')<span class="badge bg-success">{{strtoupper($data->cityLanding)}}@endif</span>
                   </td>
                   @endif
                    
                    @if($type_name=='country')
                    <td>
                        @if($data->countryLanding=='No')<span class="badge bg-danger">{{strtoupper($data->countryLanding)}}@endif</span>
                        @if($data->countryLanding=='Yes')<span class="badge bg-success">{{strtoupper($data->countryLanding)}}@endif</span>
                    </td>
                    @endif
                    
                     <td><div class="btn-group btn-group-sm"> 
                        <a href="{{ asset('add-page/'.$type_name.'/'.$data->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>&nbsp;
                        <a href="{{ asset('page-list/'.$data->code) }} " class="btn btn-success"><i class="fas fa-eye"></i></a>&nbsp;
                      </div></td>
                  </tr>@php $i++; @endphp
                  @endforeach
                  </tbody>
                  <tfoot> 
                  <tr><th rowspan="1" colspan="1">SN</th>@if($type_name=='city')<th rowspan="1" colspan="1">Airport</th><th rowspan="1" colspan="1">City</th>@endif<th rowspan="1" colspan="1">Country</th><th rowspan="1" colspan="1">Is Landing</th><th rowspan="1" colspan="1">Action</th></tr>
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
 