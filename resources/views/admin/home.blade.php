
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
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
          <div class="col-lg-3 col-6">
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
          </div>
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
 