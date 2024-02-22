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
				$DOB=date('Y/m/d ', strtotime(date('m/d/Y').' -19 year')); 
                
                $user_type=$sessionval['user_type'];
         @endphp

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Fund Wallet Request List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Fund Wallet Request List</li>
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
                <h3 class="card-title"> Fund Wallet Request List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                  <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">SN</th><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">Agent Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly From: activate to sort column ascending">Amount</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending">Bank Name /  Type</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Payment Reference</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Proof of Payment</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Remarks</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Status</th>@if($user_type=='admin')<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th>@endif</tr>
                  </thead>

                  <tbody>	 @php $i=1; @endphp 
                  @foreach($walletData as $key => $data)
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0"> {{$i}}  </td>
                    <td><?php echo $data->first_name." ".$data->last_name; ?> </td>
                    <td><?php echo $data->price ?> </td>
                    <td><?php echo $data->bank_name ?> <br /><b> <?php echo $data->type ?>  </b></td>
                    <td><?php echo $data->banktranscationid ?> </td>
                     <td> <a href="{{$data->attachemnt}}" target="_blank" class="btn btn-success">View</a> </td>
                     <td><?php echo $data->customer_remarks ?> </td>
                     
                    <td>@if($data->w_status=='pending')<span class="badge bg-info">{{$data->w_status}}</span>@endif
                    @if($data->w_status=='complete')<span class="badge bg-success">{{$data->w_status}}</span>@endif
                    @if($data->w_status=='reject')<span class="badge bg-danger">{{$data->w_status}}</span> <br />{{$data->status_msg}}@endif</td>
                    @if($user_type=='admin')
                     <td><div class="btn-group btn-group-sm">
                         <!--<a href="wallet-fund-edit/{{$data->w_id}}" class="btn btn-info"><i class="fas fa-edit"></i></a>&nbsp;-->
                         @if($data->w_status=='pending')
                        <a href="wallet-fund/?id={{$data->w_id}}&type=Request" onclick="return confirm('Are you sure to fund!')" class="btn btn-info">Fund</a>&nbsp;
                        <a href="javascript:void(0)" id="reject_{{$data->w_id}}"  onclick="reject_request({{$data->w_id}})" class="btn btn-danger">Reject</a>
                        <a href="javascript:void(0)" style="display:none" id="rejecting_{{$data->w_id}}"  class="btn btn-danger">Rejecting...</a>
                        @endif
                        @if($data->w_status=='complete')
                        <a href="#" onclick="return alert('Fund Complete!')" class="btn btn-success">Funded</a>&nbsp;
                        @endif
                        @if($data->w_status=='reject')
                        <a href="#" onclick="return alert('Fund Rejected!')" class="btn btn-danger">Rejected</a>&nbsp;
                        @endif
                      </div></td>
                      @endif
                  </tr>  @php $i++; @endphp
                  	
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr><th rowspan="1" colspan="1">SN</th><th rowspan="1" colspan="1">Agent Name</th><th rowspan="1" colspan="1">Amount</th><th rowspan="1" colspan="1">Bank Name</th><th rowspan="1" colspan="1">Payment Reference</th><th rowspan="1" colspan="1">Proof of Payment</th><th rowspan="1" colspan="1">Remarks</th></th><th rowspan="1" colspan="1">Status</th></th>@if($user_type=='admin')<th rowspan="1" colspan="1">Action</th>@endif</tr>
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
 
 
 <script type="text/javascript">
 
 function reject_request(id){
   				var status_msg= prompt('Enter Reason of reject.'); 
				if (status_msg == null || status_msg == "") {
				}
				else{
							$("#rejecting_"+id).show();
						    $("#reject_"+id).hide();
					$.ajax({
										url:'<?php url(''); ?>/wallet-reject',
										type: "GET",
										data: {
											action: "wallet-reject",
											id: id,
											status_msg: status_msg,
											rand: "<?php echo rand(); ?>",
										},
										dataType: "json",  
										success: function (data) {
											alert(data.message);
										if(data.error=='yes'){
											$("#rejecting_"+id).hide();
											$("#reject_"+id).show();	
										}else{
											window.location.href = "http://airzain.com/wallet-fund-request-list";
										}
										},
										error: function (error) {
											console.log(`Error ${error}`);
										}
									});
				}
	}
</script> 
  
@include('admin.footer')
 