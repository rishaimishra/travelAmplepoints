@include('admin.header')

@include('admin.nav')

@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                $currency=$data['siteData']['currency']; 
                $currency_symbol=$data['siteData']['currency_symbol'];               
         @endphp

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo ucfirst($user_type);  ?>'s List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo ucfirst($user_type);  ?>'s List</li>
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
                <h3 class="card-title"><?php echo ucfirst($user_type);  ?>'s List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                  <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="SN: activate to sort column descending">SN</th><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="SN: activate to sort column descending">User ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending">Phone</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                  @if($user_type!='customer')<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending">Currency</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="City: activate to sort column ascending">Wallet</th>@endif<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th></tr>

                  </thead>

                  <tbody>	 
					@php $i=1; @endphp
                  @foreach($userData as $key => $data)
                  @php $com=json_decode($data->common_data,true); @endphp
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0"> {{$i}}  </td>
                    <td> {{$data->user_id}}  </td>
                    <td>{{$data->first_name}} {{$data->last_name}}</td>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->email}}</td>
                    @if($user_type!='customer')
                    <td>{{$data->currency;}} (<?php echo $data->currency_symbol; ?>)</td>
                    <td>   {{$data->wallet}}</td>
                    @endif
                    <td>@if($data->status=='inactive')<span class="badge bg-danger">{{strtoupper($data->status)}}@endif</span>
                    @if($data->status=='active')<span class="badge bg-success">{{strtoupper($data->status)}}@endif</span></td>
                     <td><div class="btn-group btn-group-sm">
                        <a href="user-details/{{$data->user_id}}" class="btn btn-info"><i class="fas fa-edit"></i></a>&nbsp;
                        @if($user_type!='customer')
                        <a href="manual-wallet-fund-deduct/{{$data->user_id}}" class="btn btn-success"><i class="fas fa-wallet"></i> CR/DR</a>&nbsp;  
                        <a href="wallet-transation-history/{{$data->user_id}}" class="btn btn-info"><i class="fas fa-wallet"></i> History </a>&nbsp; 
                        @endif
                      </div></td>
                  </tr>
                  @php $i++; @endphp
                  @endforeach
                  </tbody>
                  <tfoot>

                  <tr><th rowspan="1" colspan="1">SN</th><th rowspan="1" colspan="1">User ID</th><th rowspan="1" colspan="1">Name</th><th rowspan="1" colspan="1">Phone</th><th rowspan="1" colspan="1">Email </th>@if($user_type!='customer')<th rowspan="1" colspan="1">Currency</th><th rowspan="1" colspan="1">Wallet</th>@endif<th rowspan="1" colspan="1">Status</th><th rowspan="1" colspan="1">Action</th></tr>

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

 