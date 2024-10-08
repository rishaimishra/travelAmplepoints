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
          .layout-fixed .brand-link{
  background: #FF5722;
}
[class*=sidebar-dark] .user-panel {
    margin-top: -2px !important;
    padding-top: 18px !important;
    background: #FF5722;
}
.layout-fixed .main-sidebar{
 background: #dee5ec;
}
.nav-sidebar{}.nav-sidebar .nav-link.active{background:gray!important;color:#000!important;}.nav-sidebar .nav-link{background:transparent!important;color:#000!important;}.nav-sidebar .nav.nav-treeview{background:transparent!important;}
         </style>
  
    <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset(Session::get('user_type').'-dashboard') }}" class="brand-link">
      <img src="{{asset($images['icon'])}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{$data['siteData']['website_name']}} </span>
    </a>

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image"><!--{{ asset('admin/dist/img/user2-160x160.jpg') }}-->
          @if(@Auth::user()->user_image)
          <img src="https://amplepoints.com/user_images/32/profile_image/{{@Auth::user()->user_image}}" class="img-circle elevation-2" alt="User Image">
          @else
           <img src="@if(Session::get('user_image')!='') {{ asset(Session::get('user_image')) }}@else {{ asset('admin/dist/img/user2-160x160.jpg') }} @endif" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="{{ asset('user-details') }}" class="d-block" style="color: white !important;">{{ Session::get('first_name') }} {{ Session::get('last_name') }} ({{ ucfirst(Session::get('user_type')) }})</a>
        </div>
      </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->


      <!-- SidebarSearch Form -->
      <!--<div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open" style="color:black;"> 
            <a href="{{ asset(Session::get('user_type').'-dashboard') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!--<i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
            
            <!--<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>-->
          </li> 
                   
          @if($sessionval['user_type']=='admin')
          
          <li class="nav-item" style="display:none">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                CMS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;background: rgb(2, 9, 15);border-radius: 5px;">
               <!--<li class="nav-item">
                <a href="{{ asset('website-settings') }}" class="nav-link">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    Website Settings
                    <span class="right badge badge-danger">New</span>
                  </p>
                </a>
              </li>-->
         	 <li class="nav-item">
                <a href="{{ asset('page-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Page List </p>
                </a>
              </li>  
              
              <li class="nav-item">
                    <a href="{{ asset('customer-review') }}" class="nav-link">
                      <i class="nav-icon fas fa-comments"></i>
                      <p>
                        Customer Review
                        <span class="right badge badge-danger">New</span>
                      </p>
                    </a>
                  </li>            
          
			  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-blog"></i>
              <p>
                Manage Blog
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none; background: rgb(2, 9, 15);border-radius: 5px;">
              <li class="nav-item">
                <a href="{{ asset('add-blog') }}" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Add Blog </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ asset('blog-list') }}" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Blog List </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ asset('blog-category') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Category</p>
                </a>
              </li>
            </ul>
          </li>		
               
             <li class="nav-item">
                <a href="{{ asset('add-job') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Job </p>
                </a>
              </li>
             <li class="nav-item">
                <a href="{{ asset('job-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Job List </p>
                </a>
              </li>
              
              <li class="nav-item" style="display:none">
                <a href="{{ asset('add-page') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Page </p>
                </a>
              </li>
              
              
              <li class="nav-item">
                <a href="{{ asset('add-service') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Service </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ asset('service-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Service List </p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ asset('add-faq') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add FAQ </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ asset('faq-list') }}" class="nav-link">
                  <i class="fas fa-question nav-icon"></i>
                  <p>FAQ List </p>
                </a>
              </li>
              
            </ul>
          </li>
          	
          <li class="nav-item" style="display:none">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Landing Page
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;background: rgb(2, 9, 15);border-radius: 5px;">
            	    <li class="nav-item">
                    <a href="{{ asset('city-list') }}" class="nav-link">
                      <i class="nav-icon fas fa-city"></i>
                      <p>
                        City List 
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ asset('country-list') }}" class="nav-link">
                      <i class="nav-icon fas fa-democrat"></i>
                      <p>
                        Country List 
                      </p>
                    </a>
                  </li>
                                    
                   <li class="nav-item">
                    <a href="{{ asset('landing-page-list/flights') }}" class="nav-link">
                      <i class="nav-icon fas fa-plane"></i>
                      <p>
                        Flight Landing Page
                      </p>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="{{ asset('landing-page-list/hotels') }}" class="nav-link">
                      <i class="nav-icon fas fa-bed"></i>
                      <p>
                        Hotel Landing Page
                      </p>
                    </a>
                  </li>  
                  
                  <li class="nav-item">
                    <a href="{{ asset('landing-page-list/tours') }}" class="nav-link">
                      <i class="nav-icon fas fa-plane"></i>
                      <p>
                        Tour Landing Page
                      </p>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="{{ asset('landing-page-list/transfers') }}" class="nav-link">
                      <i class="nav-icon fas fa-bed"></i>
                      <p>
                        Transfer Landing Page
                      </p>
                    </a>
                  </li>  
                   
            </ul>
          </li>
          
          <li class="nav-item" style="display:none">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Manage Bank 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;background: rgb(2, 9, 15);border-radius: 5px;">
             <li class="nav-item">
                <a href="{{ asset('add-bank-details') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Bank Details </p>
                </a>
              </li>
             <li class="nav-item">
                <a href="{{ asset('bank-details-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Details List </p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;background: rgb(2, 9, 15);border-radius: 5px;">
                   <li class="nav-item" style="display:none">
                    <a href="{{ asset('agents') }}" class="nav-link">
                      <i class="nav-icon fas fa-user"></i>
                      <p>
                        Agents
                      </p>
                    </a>
                  </li>
                 
         <li class="nav-item">
                    <a href="{{ asset('customers') }}" class="nav-link">
                      <i class="nav-icon fas fa-user"></i>
                      <p>
                        Customers
                      </p>
                    </a>
                  </li>          
            </ul>
          </li>


            <li class="nav-item"> 
            <a href="{{ asset('users/from/travel') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               Travel User
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
         
          <li class="nav-item" style="display:none">
                    <a href="{{ asset('wallet-fund-request-list') }}" class="nav-link">
                      <i class="nav-icon fas fa-comments"></i>
                      <p>
                         Fund Wallet Request
                        <span class="right badge badge-danger">New</span>
                      </p>
                    </a>
          </li>

         <li class="nav-item" style="display:none">
            <a href="{{ asset('currency-list') }}" class="nav-link">
              <i class="nav-icon fas fa-money-bill-alt"></i>
              <p>
                Currency List
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          	
            <li class="nav-item">
            <a href="{{ asset('enquiry-list') }}" class="nav-link">
              <i class="nav-icon fas fa-question"></i>
              <p>
                Enquiry List
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          
          @endif 
          
        @if($sessionval['user_type']=='agent') 
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                My Wallet
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;background: rgb(2, 9, 15);border-radius: 5px;">
            
             <li class="nav-item"> 
                    <a href="{{ asset('wallet-fund-by-pg') }}" class="nav-link">
                      <i class="nav-icon fas fa-wallet"></i>
                      <p>
                        Fund Wallet BY PG
                      </p>
                    </a>
                  </li>
            
                  <li class="nav-item"> 
                    <a href="{{ asset('wallet-fund-request') }}" class="nav-link">
                      <i class="nav-icon fas fa-wallet"></i>
                      <p>
                        Fund Wallet Request
                      </p>
                    </a>
                  </li>
                  
                  <li class="nav-item"> 
                    <a href="{{ asset('wallet-transation-history') }}" class="nav-link">
                      <i class="nav-icon fas fa-wallet"></i>
                      <p>
                        Wallet Transation History
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ asset('wallet-fund-request-list') }}" class="nav-link">
                      <i class="nav-icon fas fa-comments"></i>
                      <p>
                        Fund Wallet Status
                      </p>
                    </a>
                 </li>
                 
            </ul>
          </li>
        @endif 
          
          <li class="nav-item"> 
            <a href="{{ asset('user-details') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                My Profile
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
                    <a href="{{ asset('flight-widget') }}" class="nav-link">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Flight Widgets
                        <span class="right badge badge-danger">New</span>
                      </p>
                    </a>
            </li>-->
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Booking
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display:;background: rgb(2, 9, 15);border-radius: 5px;">
                   <li class="nav-item" >
                    <a href="{{ asset('flight-list') }}" class="nav-link">
                      <i class="nav-icon fas fa-plane"></i>
                      <p>
                        Flight Booking
                      </p>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="{{ asset('booking-list/hotel') }}" class="nav-link">
                      <i class="nav-icon fas fa-bed"></i>
                      <p>
                        Hotel Booking
                      </p>
                    </a>
                  </li>   
                  
                  <li class="nav-item" style="display:none">
                    <a href="{{ asset('booking-list/activity') }}" class="nav-link">
                      <i class="nav-icon fas fa-camera"></i>
                      <p>
                        Tours Booking
                      </p>
                    </a>
                  </li>   
                  
                  <li class="nav-item" style="display:none">
                    <a href="{{ asset('booking-list/transfer') }}" class="nav-link">
                      <i class="nav-icon fas fa-car"></i>
                      <p>
                        Transfer Booking
                      </p>
                    </a>
                  </li> 
                       
            </ul>
          </li>

           <li class="nav-item">
            <a href="{{ asset('logout') }}" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>