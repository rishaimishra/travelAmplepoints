@include('admin.header')
@include('admin.nav')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Flight Booking List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Flight List</li>
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
                <h3 class="card-title">Flight List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                  <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">SN</th><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">Order Id</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly From: activate to sort column ascending">Destinations</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="PNR: activate to sort column ascending">PNR</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Customer Email: activate to sort column ascending">Customer Email</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Booking Date: activate to sort column ascending">Booking Date</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Payment Method: activate to sort column ascending">Payment Method</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Payment Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Booking Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th></tr>
                  </thead>
                  <tbody>	  @php $i=1; @endphp
                  @foreach($flightData['data'] as $key => $data) 
                  <?php $fs=json_decode($data->FlightsSegment,true); $ob=$fs['outbound'];  if(isset($fs['inbound'])){ $ib=$fs['inbound']; }else{ $ib='';} ?>
                  <tr class="odd">
                  	<td class="dtr-control sorting_1" tabindex="0"> {{$i}}  </td>
                    <td class="dtr-control sorting_1" tabindex="0"> {{$data->order_id}}  </td>
                    <td><b>@if(is_array($ib)) Outbound:- <br /> @endif<?php for($a=0;$a<count($ob);$a++){ echo $ob[$a]['flyFrom']."&rarr;".$ob[$a]['flyTo']."<br>"; } ?> 
                    	@if(is_array($ib)) 
                        <br /> <br /> Inbound:- <br /><?php  for($a=0;$a<count($ib);$a++){ echo $ib[$a]['flyFrom']."&rarr;".$ib[$a]['flyTo']."<br>"; } ?>
                        @endif
                        </b>
                    </td>
                        
                    <td>{{$data->pnr}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->created_at}}</td>
                    <td>{{-- {{$data->payment_type}} --}}Online</td>
                    <td>@if($data->payment_status=='Failed')<span class="badge bg-danger">{{$data->payment_status}}@endif</span>
                    @if($data->payment_status=='Confirmed')<span class="badge bg-success">{{$data->payment_status}}@endif</span>
                    @if($data->payment_status=='Pending')<span class="badge bg-warning">{{$data->payment_status}}@endif</span></td>

                    <td>@if($data->booking_status=='Failed')<span class="badge bg-danger">{{$data->booking_status}}@endif</span>
                    @if($data->booking_status=='Confirmed')<span class="badge bg-success">{{$data->booking_status}}@endif</span>
                    @if($data->booking_status=='Pending')<span class="badge bg-warning">{{$data->booking_status}}@endif</span>
                  </td>
                     <td><div class="btn-group btn-group-sm">
                         <a href="flight-details/{{$data->id}}" target="_blank" class="btn btn-info"><i class="fas fa-edit"></i></a>&nbsp;
                        <a href="flight-ticket?order_id={{$data->order_id}}" class="btn btn-success"><i class="fas fa-download"></i></a>&nbsp;
                      </div>
                      @if($data->booking_status=='Cancelled Pending' && @Auth::user()->user_type=="admin")
                        <a href="{{route('admin.flight.cancel',$data->order_id)}}"><button class="btn btn-warning">Approve Cancellation</button></a>&nbsp;
                        @endif
                    </td>
                  </tr>  @php $i++; @endphp
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr><th rowspan="1" colspan="1">SN</th><th rowspan="1" colspan="1">Order Id</th><th rowspan="1" colspan="1">Destinations</th><th rowspan="1" colspan="1">PNR </th><th rowspan="1" colspan="1">Customer Email</th><th rowspan="1" colspan="1">Booking Date</th><th rowspan="1" colspan="1">Payment Method</th><th rowspan="1" colspan="1">Payment Status</th><th rowspan="1" colspan="1">Booking Status</th><th rowspan="1" colspan="1">Action</th></tr>
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
 