@include('admin.header')
@include('admin.nav')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Currency List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Currency List</li>
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
                <h3 class="card-title">Currency List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                  <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">SN</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly From: activate to sort column ascending">Currency</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">Currency Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="PNR: activate to sort column ascending">Currency Symbol</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Customer Email: activate to sort column ascending">Rate</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Booking Date: activate to sort column ascending">Published</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th></tr>
                  </thead>
                  <tbody>	 @php $i=1; @endphp
                  @foreach($currencyData['data'] as $key => $data)
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0"> {{$i}}  </td>
                    <td>{{$data->currency}} </td>
                    <td>{{$data->currency_name}}</td>
                    <td>{{$data->currency_symbol}}</td>
                    <td>{{$data->rate}}</td>
                    <td>@if($data->published=='No')<span class="badge bg-danger">{{$data->published}}@endif</span>
                    @if($data->published=='Yes')<span class="badge bg-success">{{$data->published}}@endif</span></td>
                     <td><div class="btn-group btn-group-sm">
                        <a href="currency-details/{{$data->id}}" class="btn btn-info"><i class="fas fa-edit"></i></a>&nbsp;
                        <a href="currency-details/{{$data->id}}" class="btn btn-success"><i class="fas fa-eye"></i></a>&nbsp;
                      </div></td>
                  </tr>  @php $i++; @endphp
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr><th rowspan="1" colspan="1">Id</th><th rowspan="1" colspan="1">Currency</th><th rowspan="1" colspan="1">Currency Name</th><th rowspan="1" colspan="1">Currency Symbol </th><th rowspan="1" colspan="1">Rate</th><th rowspan="1" colspan="1">Published</th><th rowspan="1" colspan="1">Action</th></tr>
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
 