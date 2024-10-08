 @include('admin.header')
@include('admin.nav')

  @php 
	$profile_pic=''; $id=''; $first_name=''; $last_name=''; $email=''; $phone=''; $address=''; $city=''; $country=''; $user_type=''; $status=''; $is_member='';
  if(isset($userData)){ 
       $id=$userData->user_id; 
       $profile_pic=$userData->profile_pic;
       $first_name=$userData->first_name; 
       $last_name=$userData->last_name;  
       $email=$userData->email; 
       $phone=$userData->phone; 
       $address=$userData->address;  
       $city=@$userData->city; 
       $country=@$userData->country; 
       $user_type=$userData->user_type; 
       $status=$userData->status;  
       $is_member= $userData->is_member; 
       $role= $userData->role;
                 $common=json_decode($userData->common_data,true);
                $images=json_decode($userData->images,true);
                $sessionval=session()->all();
                //$currency=$data['currency']; 
   }
  
  @endphp
 <style>
			   .imgcls{
			   		cursor:pointer;background:#1a6a7b;border-radius:10px;margin:50px;
			   }
               </style>
                
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <!-- Main content -->
  <form action="{{ asset('update-user-data') }}" method="post" enctype="multipart/form-data">
  @csrf
  
  @if($user_type=='admin' || $user_type=='agent')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Brand Data </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
              <div class="card-body">
              <div class="row">                
                <div class="form-group col-md-3 imgcls" onclick="getElementById('profile_pic').click()">
                <div class="form-group col-md-12" style="text-align:center">
                <?php if(!isset($profile_pic) || $profile_pic=='' ){ $profile_pic= url('').'/images/noimage.png';   } ?>
                  <img class="profile_pic" height="200" width="200" src="<?php echo  $profile_pic; ?>" />
                </div>
                  <label for="exampleInputFile">Profile Pic</label>
                  <div class="input-group" style="display:none">
                    <div class="custom-file">
                    <input type="hidden" name="profile_pic_pre" value="<?php echo  $profile_pic; ?>" class="custom-file-input" id="">
                    <input type="file" name="profile_pic" id="profile_pic" accept="image/png" onchange="changeImage(this,'profile_pic');" class="custom-file-input" >
                      <label class="custom-file-label" for="exampleInputFile">Update Profile Pic</label>
                    </div>
                  </div>
                </div>
                
                <div class="form-group col-md-3 imgcls" onclick="getElementById('website_logo').click()" >
                <div class="form-group col-md-12" style="text-align:center">
                <?php if(!isset($images['logo'])  || $images['logo']=='' ){ $images['logo']= url('').'/images/noimage.png';   } ?>
                  <img class="website_logo" height="200" width="200" src="{{$images['logo']}}" />
                </div>
                  <label for="exampleInputFile">Update Logo</label>
                  <div class="input-group" style="display:none">
                    <div class="custom-file">
                    <input type="hidden" name="website_logo_pre" value="{{$images['logo']}}" class="custom-file-input" id="">
                    <input type="file" name="website_logo" id="website_logo" accept="image/png" onchange="changeImage(this,'website_logo');" class="custom-file-input" >
                      <label class="custom-file-label" for="exampleInputFile">Update Logo</label>
                    </div>
                  </div>
                </div>
               
                
                 <div class="form-group col-md-3 imgcls" onclick="getElementById('website_icon').click()" >
                 <div class="form-group col-md-12" style="text-align:center">
                 <?php if(!isset($images['icon'])  || $images['icon']=='' ){ $images['icon']= url('').'/images/noimage.png';   } ?>
                  <img height="200" class="website_icon" width="200" src="{{$images['icon']}}" />
                </div>
                  <label for="exampleInputFile">Update Icon</label>
                  <div class="input-group" style="display:none">
                    <div class="custom-file">
                    <input type="hidden" name="website_icon_pre" value="{{$images['icon']}}" class="custom-file-input" id="">
                    <input type="file" name="website_icon" id="website_icon" accept="image/png" onchange="changeImage(this,'website_icon');" class="custom-file-input" >
                      <label class="custom-file-label" for="exampleInputFile">Update Icon</label>
                    </div>
                  </div>
                </div>

                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Brand Name</label>
                  <input  type="hidden" name="common[website]" value="<?php echo url(''); ?>" ><?php  if(!isset($common['website_name'])){ $common['website_name']=''; } ?>
                  <input type="text" name="common[website_name]" value="{{ $common['website_name'] }}" class="form-control" id="exampleInputEmail1" placeholder="Enter Website Name">
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
  </section>
  @endif
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Contact Info </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row">    
              	@if($user_type=='customer')
                <div class="form-group col-md-12">
                <div class="form-group col-md-12" style="text-align:center">
                <?php if(!isset($profile_pic) || $profile_pic=='' ){ $profile_pic= url('').'/images/noimage.png';   } ?>
                  <img height="200" width="200" src="<?php echo  $profile_pic; ?>" />
                </div>
                  <label for="exampleInputFile">Profile Pic</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="profile_pic_pre" value="<?php echo  $profile_pic; ?>" class="custom-file-input" id="">
                      <input type="file" name="profile_pic" class="custom-file-input" id="">
                      <label class="custom-file-label" for="exampleInputFile">Update Profile Pic</label>
                    </div>
                  </div>
                </div>
                @endif 
              	<input type="hidden" name="id" value="<?php echo  $id; ?>" class="custom-file-input" id="">
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">First Name</label>
                  <input type="text" name="first_name" value="{{$first_name}}" class="form-control"  >
                </div>
                
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Last Name</label>
                  <input type="text" name="last_name" value="{{$last_name}}" class="form-control"  >
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Username </label>
                  <input type="email" name="email" value="{{$email}}" class="form-control"  >
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="text" name="password" value="{{$userData->password}}" class="form-control"  >
                </div> 
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Site Main Color</label> <?php if(!isset($common['color'])){ $common['color']='#8B3EEA'; } ?>
                  <input type="color" name="common[color]" value="{{$common['color']}}" class="form-control"  >
                </div> 
                
                <div class="form-group col-md-3" >
                  <label for="exampleInputEmail1">Contact No 1</label>  <?php if(!isset($common['contact1'])){ $common['contact1']=$phone; } ?>
                  <input type="text" name="common[contact1]" value="{{$common['contact1']}}" class="form-control" id="exampleInputEmail1" placeholder="Contact No 1">
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Contact No 2</label> <?php if(!isset($common['contact2'])){ $common['contact2']=''; } ?>
                  <input type="text" name="common[contact2]" value="{{ $common['contact2'] }}" class="form-control" id="exampleInputEmail1" placeholder="Contact No 2">
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Email 1</label> <?php if(!isset($common['email1'])){ $common['email1']=$email;   } ?>
                  <input type="email" name="common[email1]" value="{{ $common['email1'] }}" class="form-control" id="exampleInputEmail1" placeholder="Email 1">
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Email 2</label> <?php if(!isset($common['email2'])){ $common['email2']='';   } ?>
                  <input type="email" name="common[email2]" value="{{ $common['email2'] }}" class="form-control" id="exampleInputEmail1" placeholder="Email 2">
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Address 1</label> <?php if(!isset($common['address1'])){ $common['address1']=$address;   } ?>
                  <textarea  type="text" name="common[address1]" class="form-control summernote" >{{ $common['address1'] }}</textarea>
                </div>
               
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Address 2</label> <?php if(!isset($common['address2'])){ $common['address2']='';   } ?>
                  <textarea name="common[address2]"  type="text" class="form-control summernote"  >{{ $common['address2'] }}</textarea>
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">About Us</label> <?php if(!isset($common['about'])){ $common['about']=''; } ?>
                  <textarea  name="common[about]"  class="form-control summernote"  >{{ $common['about'] }}</textarea>
                </div>           
              
             </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  

  <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Social Link </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->                
                  <div class="card-body">
                  <div class="row">                
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Facebook Link</label> <?php if(!isset($common['fb_link'])){ $common['fb_link']='';   } ?>
                      <input type="text" name="common[fb_link]"  value="{{ $common['fb_link'] }}" class="form-control" placeholder="Facebook Link">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Twitter Link</label> <?php if(!isset($common['tw_link'])){ $common['tw_link']='';   } ?>
                      <input type="text" name="common[tw_link]" value="{{ $common['tw_link'] }}" class="form-control"  placeholder="Twitter Link">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Instagram Link</label> <?php if(!isset($common['insta_link'])){ $common['insta_link']='';   } ?>
                      <input type="text" name="common[insta_link]" value="{{ $common['insta_link'] }}" class="form-control"  placeholder="Instagram Link">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Linkdin Link</label>  <?php if(!isset($common['ld_link'])){ $common['ld_link']='';   } ?>
                      <input type="text"  name="common[ld_link]" value="{{ $common['ld_link'] }}" class="form-control"  placeholder="Linkdin Link">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Ticktok Link</label>  <?php if(!isset($common['ticktok_link'])){ $common['ticktok_link']='';   } ?>
                      <input type="text"  name="common[ticktok_link]" value="{{ $common['ticktok_link'] }}" class="form-control"  placeholder="Ticktok Link">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Telegram Link</label>  <?php if(!isset($common['telegram_link'])){ $common['telegram_link']='';   } ?>
                      <input type="text"  name="common[telegram_link]" value="{{ $common['telegram_link'] }}" class="form-control"  placeholder="Telegram  Link">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Youtube Link</label>  <?php if(!isset($common['youtube_link'])){ $common['youtube_link']='';   } ?>
                      <input type="text"  name="common[youtube_link]" value="{{ $common['youtube_link'] }}" class="form-control"  placeholder="Youtube  Link">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Whats App Link</label>  <?php if(!isset($common['wh_link'])){ $common['wh_link']='';   } ?>
                      <input type="text"  name="common[wh_link]" value="{{ $common['wh_link'] }}" class="form-control"  placeholder="Whats App Link">
                    </div>

                  <!-- /.card-body -->
                 </div>
                </div>
                
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </section>
      
  <section class="content" @if($sessionval['user_type']!='admin') style="display:none" @endif>
    <div class="container-fluid">
   
      <div class="row">
       <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Manage By Admin</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
              <div class="card-body">
              <div class="row" @if($user_type=='customer') style="display:none" @endif >  
              	<div class="col-md-12"><h4>Credentials Settings</h4> </div>  
                           
                <div class="form-group col-md-6" >
                  <label for="exampleInputEmail1">Hotelbeds Hotel Secret</label> <?php if(!isset($common['hotelbeds_secret'])){ $common['hotelbeds_secret']=''; } ?> 
                  <input type="text" class="form-control" name="common[hotelbeds_secret]" value="{{ $common['hotelbeds_secret'] }}"  placeholder="Hotelbeds Secret">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Hotelbeds Hotel Key</label> <?php  if(!isset($common['hotelbeds_key'])) { $common['hotelbeds_key']=''; }  ?>
                  <input type="text" class="form-control" name="common[hotelbeds_key]" value="{{ $common['hotelbeds_key'] }}" placeholder="Hotelbeds Key">
                </div>
                
                <span style="display:none"> 
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Hotelbeds Tours  Secret</label> <?php if(!isset($common['hotelbeds_tours_secret'])){ $common['hotelbeds_tours_secret']=''; } ?> 
                  <input type="text" class="form-control" name="common[hotelbeds_tours_secret]" value="{{ $common['hotelbeds_tours_secret'] }}"  placeholder="Hotelbeds Tours Secret">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Hotelbeds Tours Key</label> <?php  if(!isset($common['hotelbeds_tours_key'])) { $common['hotelbeds_tours_key']=''; }  ?>
                 <input type="text" class="form-control" name="common[hotelbeds_tours_key]" value="{{ $common['hotelbeds_tours_key'] }}" placeholder="Hotelbeds Tours Key">
                </div>
                
                
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Hotelbeds Transfer  Secret</label> <?php if(!isset($common['hotelbeds_transfer_secret'])){ $common['hotelbeds_transfer_secret']=''; } ?> 
                  <input type="text" class="form-control" name="common[hotelbeds_transfer_secret]" value="{{ $common['hotelbeds_transfer_secret'] }}"  placeholder="Hotelbeds Transfer Secret">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Hotelbeds Transfer Key</label> <?php  if(!isset($common['hotelbeds_transfer_key'])) { $common['hotelbeds_transfer_key']=''; }  ?>
                 <input type="text" class="form-control" name="common[hotelbeds_transfer_key]" value="{{ $common['hotelbeds_transfer_key'] }}" placeholder="Hotelbeds Transfer Key">
                </div>
				</span>
                
                 <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Flight Duffel Token</label><?php if(!isset($common['flight_duffel_token'])){ $common['flight_duffel_token']=''; } ?>
                  <input type="text" class="form-control" name="common[flight_duffel_token]" value="{{ $common['flight_duffel_token'] }}" placeholder="Hotelbeds Secret">
                </div>
             </div>
             

             <div class="row">                 

               

               <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">User Type</label>
                  <div class="form-check"> 
                          <input type="radio" name="user_type" value="admin" @php if($user_type=='admin') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Admin</label>		
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="user_type" value="agent" @php if($user_type=='agent') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Agent</label>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="user_type" value="customer" @php if($user_type=='customer') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Customer</label>
                  </div>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Status</label>
                  <div class="form-check"> 
                          <input type="radio" name="status" value="active" @php if($status=='active') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Active</label>		
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="status" value="inactive" @php if($status=='inactive') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Inactive</label>
                  </div>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Is Member</label>
                  <div class="form-check"> 
                          <input type="radio" name="is_member" onclick="showhideMember(1)" value="Yes" @php if($is_member=='Yes') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Yes</label>		
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="is_member" onclick="showhideMember(0)" value="no" @php if($is_member!='Yes') echo "checked" @endphp class="form-check-input"><label class="form-check-label">No</label>
                  </div>
                </div>
                
                <div @if($is_member!='Yes') style="display:none" @endif class="form-group col-md-12 member">
                  <label for="exampleInputEmail1">Role</label>
                  <div class="form-check"> 
                          <input type="radio" name="role" value="Founder & Director" @php if($role=='Founder & Director') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Founder & Director</label>		
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="role" value="Chief Operating Officer" @php if($role=='Chief Operating Officer') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Chief Operating Officer</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="role" value="Account Manager" @php if($role=='Account Manager') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Account Manager</label>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="role" value="Sales Support" @php if($role=='Sales Support') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Sales Support</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="role" value="Order Manager" @php if($role=='Order Manager') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Order Manager</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="role" value="Head of Design" @php if($role=='Head of Design') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Head of Design</label>
                          
                  </div>
                </div>
                
             </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  
  @if(($sessionval['user_type']=='admin' || $sessionval['user_type']=='agent')   ) 
  <section class="content" style="display:none" >
    <div class="container-fluid" >
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Currency Settings </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->            
              <div class="card-body">
              <div class="row">                
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Currency </label> <?php if(!isset($common['currency'])) { $common['currency']='';  } ?>
                  <select name="common[currency]" id='currency'  onChange="changeCurrency()"class="form-control select2">
                  @foreach($currency as $key => $data)
                  <option "@if($common['currency'] ==  $data->currency)  selected @endif" value="{{$data->currency}}">{{$data->currency}}</option>
                  @endforeach
                  </select>
                </div>
                
                 <div class="form-group col-md-6" >
                  <label for="exampleInputEmail1">Currency Symbol </label>
                  <select name="common[currency_symbol]" onChange="changeCurrency()" class="form-control select2">
                   @foreach($currency as $key => $data)
                  <option class="{{$data->currency}} currency_symbol" value="{{$data->currency_symbol}}">{{$data->currency_symbol}}</option>
                  @endforeach
                  </select>
                </div>
             </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Settings</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
          
              <div class="card-body">
              @if($sessionval['user_type']=='agent' || $user_type=='admin')
              <div class="row">   
               <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Flight Markup</label> <?php if(!isset($common['flight_markup'])){ $common['flight_markup']='';  } ?>
                  <input type="text" class="form-control" name="common[flight_markup]" value="{{ $common['flight_markup'] }}" placeholder="Flight Markup">
               </div>
               <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Flight Markup Type</label> <?php if(!isset($common['flight_markup_type'])){ $common['flight_markup_type']='';  } ?>
                  <select type="text" class="form-control" name="common[flight_markup_type]" >
                  <option @if($common['flight_markup_type']=='%') selected="selected" @endif value="%">%</option>
                  <option @if($common['flight_markup_type']=='flat') selected="selected" @endif value="flat">Flat</option>
                  </select>
                </div>
                
               <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Hotel Markup</label> <?php if(!isset($common['hotel_markup'])){ $common['hotel_markup']=''; } ?>
                  <input type="text" class="form-control" name="common[hotel_markup]" value="{{ $common['hotel_markup'] }}" placeholder="Hotel Markup">
               </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Hotel Markup Type</label> <?php if(!isset($common['hotel_markup_type'])){ $common['hotel_markup_type']='';  } ?>
                  <select type="text" class="form-control" name="common[hotel_markup_type]" >
                  <option @if($common['hotel_markup_type']=='%') selected="selected" @endif value="%">%</option>
                  <option @if($common['hotel_markup_type']=='flat') selected="selected" @endif value="flat">Flat</option>
                  </select>
                </div>
               </div>
              <div class="row">   
               <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Tours Markup</label> <?php if(!isset($common['tours_markup'])){ $common['tours_markup']='';  } ?>
                  <input type="text" class="form-control" name="common[tours_markup]" value="{{ $common['tours_markup'] }}" placeholder="Tours Markup">
               </div>
               <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Tours Markup Type</label> <?php if(!isset($common['tours_markup_type'])){ $common['tours_markup_type']='';  } ?>
                  <select type="text" class="form-control" name="common[tours_markup_type]" >
                  <option @if($common['tours_markup_type']=='%') selected="selected" @endif value="%">%</option>
                  <option @if($common['tours_markup_type']=='flat') selected="selected" @endif value="flat">Flat</option>
                  </select>
                </div>              
               <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Transfer Markup</label> <?php if(!isset($common['transfer_markup'])){ $common['transfer_markup']=''; } ?>
                  <input type="text" class="form-control" name="common[transfer_markup]" value="{{ $common['transfer_markup'] }}" placeholder="Transfer Markup">
               </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Transfer Markup Type</label> <?php if(!isset($common['transfer_markup_type'])){ $common['transfer_markup_type']='';  } ?>
                  <select type="text" class="form-control" name="common[transfer_markup_type]" >
                  <option @if($common['transfer_markup_type']=='%') selected="selected" @endif value="%">%</option>
                  <option @if($common['transfer_markup_type']=='flat') selected="selected" @endif value="flat">Flat</option>
                  </select>
                </div>
               </div>
               @endif
               <hr /><hr />
              
				<div @if($sessionval['user_type']=='admin' ) style="display:block" @else style="display:none" @endif>
               <div class="row">
                <div class="form-group col-md-3" style="display:none">
                  <label for="exampleInputEmail1">Flight Markup  @if($user_type=='admin' ) For Agent @endif </label> <?php if(!isset($common['flight_markup_agent'])){ $common['flight_markup_agent']='';  } ?>
                  <input type="text" class="form-control" name="common[flight_markup_agent]" value="{{ $common['flight_markup_agent'] }}" placeholder="Flight Markup">
                </div>
               <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Flight Markup Type @if($user_type=='admin' ) For Agent @endif</label> <?php if(!isset($common['flight_markup_agent_type'])){ $common['flight_markup_agent_type']='';  } ?>
                  <select type="text" class="form-control" name="common[flight_markup_agent_type]" >
                  <option @if($common['flight_markup_agent_type']=='%') selected="selected" @endif value="%">%</option>
                  <option @if($common['flight_markup_agent_type']=='flat') selected="selected" @endif value="flat">Flat</option>
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Hotel Markup  @if($user_type=='admin' ) For Agent @endif </label> <?php if(!isset($common['hotel_markup_agent'])){ $common['hotel_markup_agent']='';  } ?>
               <input type="text" class="form-control" name="common[hotel_markup_agent]" value="{{ $common['hotel_markup_agent'] }}" placeholder="Hotel Markup">
                </div>  
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Hotel Markup Type @if($user_type=='admin' ) For Agent @endif </label> <?php if(!isset($common['hotel_markup_agent_type'])){ $common['hotel_markup_agent_type']='';  } ?>
                  <select type="text" class="form-control" name="common[hotel_markup_agent_type]" >
                  <option @if($common['hotel_markup_agent_type']=='%') selected="selected" @endif value="%">%</option>
                  <option @if($common['hotel_markup_agent_type']=='flat') selected="selected" @endif value="flat">Flat</option>
                  </select>
                </div>
             </div>
               <div class="row">

                <div class="form-group col-md-3">

                  <label for="exampleInputEmail1">Tours Markup  @if($user_type=='admin' ) For Agent @endif </label> <?php if(!isset($common['tours_markup_agent'])){ $common['tours_markup_agent']='';  } ?>

                  <input type="text" class="form-control" name="common[tours_markup_agent]" value="{{ $common['tours_markup_agent'] }}" placeholder="Tours Markup">

                </div>

                <div class="form-group col-md-3">

                  <label for="exampleInputEmail1">Tours Markup Type @if($user_type=='admin' ) For Agent @endif</label> <?php if(!isset($common['tours_markup_agent_type'])){ $common['tours_markup_agent_type']='';  } ?>

                  <select type="text" class="form-control" name="common[tours_markup_agent_type]" >

                  <option @if($common['tours_markup_agent_type']=='%') selected="selected" @endif value="%">%</option>

                  <option @if($common['tours_markup_agent_type']=='flat') selected="selected" @endif value="flat">Flat</option>

                  </select>

                </div>



                <div class="form-group col-md-3">

                  <label for="exampleInputEmail1">Transfer Markup  @if($user_type=='admin' ) For Agent @endif </label> <?php if(!isset($common['transfer_markup_agent'])){ $common['transfer_markup_agent']='';  } ?>

               <input type="text" class="form-control" name="common[transfer_markup_agent]" value="{{ $common['transfer_markup_agent'] }}" placeholder="Transfer Markup">

                </div>  

                <div class="form-group col-md-3">

                  <label for="exampleInputEmail1">Transfer Markup Type @if($user_type=='admin' ) For Agent @endif </label> <?php if(!isset($common['transfer_markup_agent_type'])){ $common['transfer_markup_agent_type']='';  } ?>

                  <select type="text" class="form-control" name="common[transfer_markup_agent_type]" >

                  <option @if($common['transfer_markup_agent_type']=='%') selected="selected" @endif value="%">%</option>

                  <option @if($common['transfer_markup_agent_type']=='flat') selected="selected" @endif value="flat">Flat</option>

                  </select>

                </div>

             </div>             
             <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Status</label>
                  <div class="form-check"> 
                          <input type="radio" name="status" value="active" @php if($status=='active') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Active</label>		
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 		  <input type="radio" name="status" value="inactive" @php if($status=='inactive') echo "checked" @endphp class="form-check-input"><label class="form-check-label">Inactive</label>
                  </div>
                </div>
                </div>

             

            </div>

          </div>

          <!-- /.card -->

        </div>

      </div>

    </div>

  </section>

  

  

  

  

  @endif

  <section><div class="card-footer update" ><button type="submit" class="btn btn-primary">Save</button></div>  </section>

      </form> 

  <!-- /.content -->

</div>



@include('admin.footer')



  <script src="https://js.braintreegateway.com/web/dropin/1.32.1/js/dropin.min.js"></script>

  <script type="text/javascript">
    changeCurrency();
	function changeCurrency(){
	 var currency=document.getElementById('currency').value;
	 jQuery(".currency_symbol").removeAttr("selected"); 
	 jQuery("."+currency).attr('selected','selected');
	}

	function showhideMember(x){
		if(x==1){  jQuery(".member").show(); }
		else{ jQuery(".member").hide();  }
	 }
	 
	 
	 function changeImage(input,targetImg){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {			
				var image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    var height = this.height; 
                    var width = this.width;
					var l=1024; var w= 1024;
                    if (height > l || width > w) {
                       // alert("Height and Width must not exceed "+l);
					//	$('#'+targetImg).val(''); 
                     //   return false;  
                    }
					$('.'+targetImg).attr('src', e.target.result);
                    return true;
              	};
        }
        reader.readAsDataURL(input.files[0]);	
    }	
}
	 
	 
  </script>

  



