<?php if(Session::get('user_id')==''){ return redirect('/login'); } ?>
{{-- @include('admin.header')
@include('admin.nav')
@include('admin.home') --}}
@include('site.header')
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
<style>
	@media (min-width: 768px) {
body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header {
transition: margin-left .3s ease-in-out;
margin-left:0px !important;
}
}
</style>
    <style>
    	.profile-card {
    background-color: #dde6ef;
    padding: 20px;
    border-radius: 10px;
    max-width: 300px;
    margin: auto;
    border: 3px #ffa478 solid;
}

.profile-image img {
    border: 5px solid #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.profile-details h4 {
    margin-top: 15px;
    font-size: 20px;
    font-weight: 600;
    color: #333;
}

.profile-details p {
    margin: 5px 0;
    font-size: 16px;
    color: #555;
}

.profile-details i {
    margin-right: 10px;
    color: #07253F;
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
						<div class="content-header" style="padding: 0px !important;">
							<div class="container-fluid">
								<div class="row mb-2">
									<div class="col-sm-6">
										<h1 class="m-0">Dashboard</h1>
										</div><!-- /.col -->
										</div><!-- /.row -->
										</div><!-- /.container-fluid -->
									</div>
									<!-- /.content-header -->

	<div class="profile-card text-center">
    <div class="profile-image">
        @if(@Auth::user()->user_image)
            <img src="https://amplepoints.com/user_images/32/profile_image/{{@Auth::user()->user_image}}" class="img-circle elevation-2" alt="User Image">
        @else
            <img src=" {{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        @endif
    </div>
    <div class="profile-details mt-3">
        <h4 class="user-name">{{ @Auth::user()->first_name }} {{ @Auth::user()->last_name }}</h4>
        <p class="user-email">
            <i class="fas fa-envelope"></i> {{ @Auth::user()->email }}
        </p>
        <p class="user-phone">
            <i class="fas fa-phone-alt"></i> {{@Auth::user()->mobile  }}
        </p>
    </div>
</div>
<br>
<br>


									<!-- Main content -->
									<section >
										<div class="container-fluid">
											<!-- Small boxes (Stat box) -->
											<div class="row">
												<div class="col-lg-3 col-6">
													<!-- small box -->
													<div class="small-box bg-info">
														<div class="inner">
															<h3>{{$hotelCount}}</h3>
															<p>Hotel Booking</p>
														</div>
														<div class="icon">
															<i class="nav-icon fas fa-bed"></i>
														</div>
														<a href="{{ asset('booking-list/hotel') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
													</div>
												</div>
												<!-- ./col -->
												<div class="col-lg-3 col-6">
													<!-- small box -->
													<div class="small-box bg-success">
														<div class="inner">
															<h3>{{$flightCount}}<sup style="font-size: 20px"></sup></h3>
															<p>Flight Booking</p>
														</div>
														<div class="icon">
															<i class="nav-icon fas fa-plane"></i>
														</div>
														<a href="{{ asset('flight-list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
													</div>
												</div>
												<!-- ./col -->
												<div class="col-lg-3 col-6">
													<!-- small box -->
													<div class="small-box bg-warning">
														<div class="inner">
															<h3>{{$activityCount}}</h3>
															<p>Tours Booking</p>
														</div>
														<div class="icon">
															<i class="nav-icon fas fa-camera"></i>
														</div>
														<a href="{{ asset('booking-list/activity') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
													</div>
												</div>
												<!-- ./col -->
											{{-- 	<div class="col-lg-3 col-6">
													<!-- small box -->
													<div class="small-box bg-danger">
														<div class="inner">
															<h3>{{$transferCount}}</h3>
															<p>Transfer Booking</p>
														</div>
														<div class="icon">
															<i class="nav-icon fas fa-car"></i>
														</div>
														<a href="{{ asset('booking-list/transfer') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
													</div>
												</div> --}}
												@if(@Auth::user()->id && @Auth::user()->user_type!="admin")
												<div class="col-lg-3 col-6" style="height: 142px;">
													<!-- small box -->
													<div class="small-box bg-secondary"style="height: 142px;">
														<div class="inner">
															<h3>{{@Auth::user()->ample}}</h3>
															<p>Your AmplePoints</p>
														</div>
														<div class="icon">
															<i class="nav-icon fas fa-car"></i>
														</div>
														
													</div>
												</div>
												@endif
												<!-- ./col -->
											</div>
											
											@if($sessionval['user_type']=='admin')
											<div class="row">
												<div class="col-md-3">
													<!-- Widget: user widget style 2 -->
													<div class="card card-widget widget-user-2">
														<!-- Add the bg color to the header using any of the bg-* classes -->
														<div class="widget-user-header bg-success">
															<h5 class="widget-user-desc">Device Visitor</h5>
														</div>
														<div class="card-footer p-0">
															<ul class="nav flex-column">
																@foreach($device as $key => $data)
																<li class="nav-item">
																	<a href="#" class="nav-link">
																		{{$data->device}}<span class="float-right badge bg-success">{{$data->total}}</span>
																	</a>
																</li>
																@endforeach
															</ul>
														</div>
													</div>
													<!-- /.widget-user -->
												</div>
												
												<div class="col-md-3">
													<!-- Widget: user widget style 2 -->
													<div class="card card-widget widget-user-2">
														<!-- Add the bg color to the header using any of the bg-* classes -->
														<div class="widget-user-header bg-primary">
															<h5 class="widget-user-desc">OS Visitor</h5>
														</div>
														<div class="card-footer p-0">
															<ul class="nav flex-column">
																@foreach($os as $key => $data)
																<li class="nav-item">
																	<a href="#" class="nav-link">
																		{{$data->os}}<span class="float-right badge bg-primary">{{$data->total}}</span>
																	</a>
																</li>
																@endforeach
															</ul>
														</div>
													</div>
													<!-- /.widget-user -->
												</div>
												
												<div class="col-md-3">
													<!-- Widget: user widget style 2 -->
													<div class="card card-widget widget-user-2">
														<!-- Add the bg color to the header using any of the bg-* classes -->
														<div class="widget-user-header bg-warning">
															<h5 class="widget-user-desc">Browser Visitor</h5>
														</div>
														<div class="card-footer p-0">
															<ul class="nav flex-column">
																@foreach($browser as $key => $data)
																<li class="nav-item">
																	<a href="#" class="nav-link">
																		{{$data->browser}}<span class="float-right badge bg-warning">{{$data->total}}</span>
																	</a>
																</li>
																@endforeach
															</ul>
														</div>
													</div>
													<!-- /.widget-user -->
												</div>
												
												<div class="col-md-3">
													<!-- Widget: user widget style 2 -->
													<div class="card card-widget widget-user-2">
														<!-- Add the bg color to the header using any of the bg-* classes -->
														<div class="widget-user-header bg-info">
															<h5 class="widget-user-desc">Country Visitor</h5>
														</div>
														<div class="card-footer p-0">
															<ul class="nav flex-column">
																@foreach($country as $key => $data)
																<li class="nav-item">
																	<a href="#" class="nav-link">
																		{{$data->country}}<span class="float-right badge bg-info">{{$data->total}}</span>
																	</a>
																</li>
																@endforeach
															</ul>
														</div>
													</div>
													<!-- /.widget-user -->
												</div>
												
												
												
											</div>
											@endif
											
											
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