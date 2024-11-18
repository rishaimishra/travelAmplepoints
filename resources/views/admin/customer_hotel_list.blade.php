<?php if(Session::get('user_id')==''){ return redirect('/login'); } ?>
@include('site.header')
<style>
	
	@media (min-width: 768px) {
body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header {
transition: margin-left .3s ease-in-out;
margin-left:0px !important;
}
}
</style>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-12" style="margin-top:100px">
			<div class="container-fluid-card">
				<!-- Sidebar Area -->
				@include('admin.customer_sidebar')
				<!-- Content Area -->
				<div class="content" style="background-color: #e6ebf1;">
					<div class="content-wrapper">
						<!-- Content Header (Page header) -->
						<div class="content-header">
							<div class="container-fluid">
								<div class="row mb-2">
									<div class="col-sm-6">
										<h1 class="m-0">{{ucfirst($product)}} Booking List</h1>
										</div><!-- /.col -->
										
										</div><!-- /.row -->
										</div><!-- /.container-fluid -->
									</div>
									<!-- /.content-header -->
									<!-- Main content -->
									<section class="content">
										<div class="container-fluid">
											@if(Session::has('success'))
											<div class="alert alert-success">
												<a href="#" class="close" data-dismiss="alert">&times;</a>
												<strong>
												{!!Session::get('success')!!}
												</strong>
											</div>
											@endif
											<!-- Small boxes (Stat box) -->
											<div class="card">
												
												<!-- /.card-header -->
												<div class="card-body">
													<div id="example11_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12"><table id="example11" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example11_info">
														<thead>
															<tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example11" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">SN</th><th class="sorting sorting_asc" tabindex="0" aria-controls="example11" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order Id: activate to sort column descending">Order Id</th><th class="sorting" tabindex="0" aria-controls="example11" rowspan="1" colspan="1" aria-label="Fly From: activate to sort column ascending">Itinerary Id</th><th class="sorting" tabindex="0" aria-controls="example11" rowspan="1" colspan="1" aria-label="Fly To: activate to sort column ascending"> Name</th><th class="sorting" tabindex="0" aria-controls="example11" rowspan="1" colspan="1" aria-label="PNR: activate to sort column ascending">Email</th><th class="sorting" tabindex="0" aria-controls="example11" rowspan="1" colspan="1" aria-label="Customer Email: activate to sort column ascending">Price</th><th class="sorting" tabindex="0" aria-controls="example11" rowspan="1" colspan="1" aria-label="Booking Date: activate to sort column ascending">Booking Date</th><th class="sorting" tabindex="0" aria-controls="example11" rowspan="1" colspan="1" aria-label="Payment Method: activate to sort column ascending">Payment Method</th><th class="sorting" tabindex="0" aria-controls="example11" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Status</th><th class="sorting" tabindex="0" aria-controls="example11" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th></tr>
														</thead>
														<tbody> @php $i=1; @endphp
															@foreach($BookingData['data'] as $key => $data)
															<tr class="odd">
																<td class="dtr-control sorting_1" tabindex="0"> {{$i}}  </td>
																<td class="dtr-control sorting_1" tabindex="0"> {{$data->order_id}}  </td>
																<td>{{$data->itineraryId}} </td>
																<td>{{$data->hotelName}}</td>
																<td>{{$data->user_email}}</td>
																<td>{{$data->chargable_rate}}</td>
																<td>{{$data->date_time}}</td>
																<td>{{-- {{$data->payment_method}} --}}Online</td>
																<td>@if($data->booking_status=='Failed')<span class="badge bg-danger">{{$data->booking_status}}@endif</span>
																@if($data->booking_status=='Confirmed')<span class="badge bg-success">{{$data->booking_status}}@endif</span>
																@if($data->booking_status=='Cancelled')<span class="badge bg-danger">{{$data->booking_status}}@endif</span>
																@if($data->booking_status=='Cancelled Pending')<span class="badge bg-warning">cancellation Pending @endif</span>
															</td>
															<td><div class="btn-group btn-group-sm">
																<a href="{{asset('booking-details/'.$product.'/'.$data->order_id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>&nbsp;
																<a href="{{asset('booking-details/'.$product.'/'.$data->order_id)}}" class="btn btn-success"><i class="fas fa-eye"></i></a>&nbsp;

																 @if( (int) $data->chargable_rate > 0)
																 @if($data->booking_status=='Confirmed' && @Auth::user()->user_type !=="admin")
									                               <a href="{{route('hc',$data->order_id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>&nbsp;
									                                @endif
									                                @endif



																@if($data->booking_status=='Cancelled Pending' && @Auth::user()->user_type=="admin")
																<a href="{{route('admin.booking.cancel',$data->order_id)}}"><button class="btn btn-warning">Approve Cancellation</button></a>&nbsp;
																@endif


															</div></td>
														</tr> @php $i++; @endphp
														@endforeach
													</tbody>
													<tfoot>
													<tr><th rowspan="1" colspan="1">SN</th><th rowspan="1" colspan="1">Order Id</th><th rowspan="1" colspan="1">Itinerary Id</th><th rowspan="1" colspan="1"> Name</th><th rowspan="1" colspan="1">Email </th><th rowspan="1" colspan="1">Price</th><th rowspan="1" colspan="1">Booking Date</th><th rowspan="1" colspan="1">Payment Method</th><th rowspan="1" colspan="1">Status</th><th rowspan="1" colspan="1">Action</th></tr>
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
								
								
								
							</div>
						</div>
					</div>
				</div>
				
			</div>
			@include('admin.footer')
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
			<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
			<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
			<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
			<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
			<script>
			$(document).ready(function() {
			$('#example11').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			"order": [[0, 'asc']],  // Order by the first column (SN)
			"columnDefs": [
			{ "orderable": false, "targets": 9 } // Disable ordering on the 'Action' column
			],
			"language": {
			"search": "Filter records:", // Customize search label
			"lengthMenu": "Display _MENU_ records per page",
			"info": "Showing page _PAGE_ of _PAGES_",
			"infoEmpty": "No records available",
			"infoFiltered": "(filtered from _MAX_ total records)",
			"paginate": {
			"first": "First",
			"last": "Last",
			"next": "Next",
			"previous": "Previous"
			}
			}
			});
			});






				 function cancel(id){
				 	alert(id);
				 	return;
								 	$(".cancel").hide();
									$(".canceling").show();	
	 									$.ajax({
										url:'<?php url(''); ?>/hotel-cancellation',
										type: "GET",
										data: {
											action: "hotel-cancellation",
											order_id: id,
											rand: "<?php echo rand(); ?>",
										},
										dataType: "json",  
										success: function (data) {
											alert(data.msg);
										
											$(".cancel").show();
											$(".canceling").hide();	
                                              location.reload();
									
										},
										error: function (error) {
											console.log(`Error ${error}`);
										}
									});	
	 	
								} 
			</script>