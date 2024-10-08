<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">

<link rel="icon" href="https://amplepoints.com/images/favicon.ico">
<style>
	body{
		background-color: #e6ebf1;
	}
.container-fluid-card {
display: flex;
}
.content {
flex: 1;
padding: 20px;
}
.sidebar-nw {
width: 186px;
padding: 18px;
background-color: #f8f9fa;
}
.card.neww{
width: 145px;
height: 65px;
margin-bottom: 0;
border: none;
}
.card-body.neww {
background: #07253F;
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
height: 85%;
padding: 10px;
border-radius: 0;
color: #fff;
transition: background-color 0.3s, transform 0.3s;
}
/* Hover Effect on Card Body */
.card-body.neww:hover {
background-color: #f75b10;
transform: scale(1.05);
cursor: pointer;
}
.card-body.neww i {
color: white;
font-size: 17px;
margin-top: 8px;
}
.card-body.neww h5 {
margin-top: -13px;
}
.card-title.neww{
	font-size: 15px;
}
.card-body.neww.text-center.active{
	background-color: #f75b10;
}
.card-link.neww {
text-decoration: none; /* Remove underline */
color: white; /* Inherit color from parent element */
}
.card-link.neww:hover {
color: white; /* Ensure hover color matches */
}
</style>
<div class="sidebar-nw">
	
		<a class="card neww" href="{{route('customer.dashboard')}}">
			<div @if (Route::currentRouteName() === 'customer.dashboard') class="card-body neww text-center active" @else class="card-body neww text-center" @endif >
				<i class="fas fa-tachometer-alt fa-2x mb-3"></i>
				<h5 class="card-title neww">Dashboard</h5>
			</div>
		</a>
	
	
		<a class="card neww" href="{{route('customer.details')}}">
			<div @if (Route::currentRouteName() === 'customer.details') class="card-body neww text-center active" @else class="card-body neww text-center" @endif >
				<i class="nav-icon fas fa-user fa-2x mb-3"></i>
				<h5 class="card-title neww">My Profile</h5>
			</div>
		</a>
	
	
		<a class="card neww" href="{{route('customer.flight.list')}}">
			<div @if (Route::currentRouteName() === 'customer.flight.list') class="card-body neww text-center active" @else class="card-body neww text-center" @endif >
				<i class="nav-icon fas fa-plane fa-2x mb-3"></i>
				<h5 class="card-title neww">Flight Booking</h5>
			</div>
		</a>
	
	
		<a class="card neww" href="{{route('customer.hotel.list','hotel')}}">
			<div @if (Route::currentRouteName() === 'customer.hotel.list' || Route::currentRouteName() === 'customer.hotel.details') class="card-body neww text-center active" @else class="card-body neww text-center" @endif >
				<i class="nav-icon fas fa-bed fa-2x mb-3"></i>
				<h5 class="card-title neww">Hotel Booking</h5>
			</div>
			
		</a>

		<a class="card neww" href="{{ asset('logout') }}">
			<div class="card-body neww text-center">
				<i class="fas fa-sign-out-alt fa-2x mb-3"></i>
				<h5 class="card-title neww">Logout</h5>
			</div>
			
		</a>
	
</div>