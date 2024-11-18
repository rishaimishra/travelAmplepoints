@include('admin.header')
@include('admin.nav')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Enquiry  List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Enquiry List</li>
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
                <h3 class="card-title">Enquiry List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                  <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">SN</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly From: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">Email</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">Phone</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="PNR: activate to sort column ascending">Message</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Type</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Date Time</th><!--<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th>--></tr>
                  </thead>
                  <tbody>	@php $i=1; @endphp 
                  @foreach($enquiryData as $key => $data)
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0"> {{$i}}  </td>
                    <td>{{$data->name}} </td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->message}}</td>
                    <td>@if($data->type=='job')<span class="badge bg-info">{{ucfirst($data->type)}}@endif</span>
                    @if($data->type=='enquiry')<span class="badge bg-success">{{ucfirst($data->type)}}@endif</span></td>
                    <td>{{$data->date_time}}</td>
                     <!--<td><div class="btn-group btn-group-sm">
                        <a href="enquiry-details/{{$data->id}}" class="btn btn-info"><i class="fas fa-edit"></i></a>&nbsp;
                        <a href="enquiry-details/{{$data->id}}" class="btn btn-success"><i class="fas fa-eye"></i></a>&nbsp;
                      </div></td>-->
                  </tr> @php $i++ @endphp
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr><th rowspan="1" colspan="1">SN</th><th rowspan="1" colspan="1">Name</th><th rowspan="1" colspan="1">Email</th><th rowspan="1" colspan="1">Phone</th><th rowspan="1" colspan="1">Type</th><th rowspan="1" colspan="1">Message </th><th rowspan="1" colspan="1">Date Time </th><!--<th rowspan="1" colspan="1">Action</th>--></tr>
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
 