@include('site.header')
@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
				$common_data= $data['siteData']['common_data'];
                $device=$data['device'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
                $currency=$data['siteData']['currency']; 
                $currency_symbol=$data['siteData']['currency_symbol'];                
         @endphp
<?php if(isset($_REQUEST['msg'])){ echo "<script>alert('".$_REQUEST['msg']."')</script>";  } 
if($user_type=='agent'){ $status='inactive'; }else{ $status='inactive'; }
?>
<style>
.frm-signup {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
}

    @media only screen and (max-width: 600px) {
      .signup-content {
        width: 95%;
      }
    }
</style>


<!-- signup form -->
<div class="modal-content signup-content" @if($device=='Desktop') style="width:50%; margin:70px auto;box-shadow: 2px 2px 20px #dfdfdf;" @else style="width:90%; margin:70px auto;box-shadow: 2px 2px 20px #dfdfdf;" @endif >
    <div class="modal-header">
        <div>
            <h5 class="modal-title title" id="exampleModalLongTitle">Sign Up</h5>
            <p class="font-size-14">Hello! Welcome Create a New Account</p>
        </div>

    </div>
    <div class="modal-body">
        <div class="contact-form-action">
            <form method="post" class="frm-signup" action="{{ route('signup') }}">
			@csrf 
                <input type="hidden" name="user_type" id="user_type" value="<?php if(isset($user_type)){ echo $user_type; }?>">
                <input type="hidden" name="status" id="status" value="<?php if(isset($status)){ echo $status; }?>">
                <div class="col-lg-12">
                    <div class="" style=" font-weight:900">
                        <input type="radio" @if($user_type=='customer') checked="checked" @endif value="customer" name="user_type" > Customer Sign Up
                        &nbsp; &nbsp; &nbsp;
                        <input type="radio" @if($user_type=='agent') checked="checked"  @endif  value="agent" name="user_type" > Agent Sign Up
                    </div>
                </div>
                <br />

                <div class="input-box col-lg-6">
                    <label class="label-text">First Name</label>
                    <div class="form-group">
                        <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="first_name" placeholder="Type your first name" required>
                    </div>
                </div>
                <div class="input-box col-lg-6">
                    <label class="label-text">Last Name</label>
                    <div class="form-group">
                        <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="last_name" placeholder="Type your last name">
                    </div>
                </div>



                <div class="input-box col-lg-6">
                    <label class="label-text">Email Address</label>
                    <label class="Email_Not_Avalible" style="display:none;color:red">Email Invalid or Already Exist Please Try Other Email</label>
                    <label class="Email_Avalible" style="display:none;color:green">Email Avalible.</label>
                    <div class="form-group">
                        <span class="la la-envelope form-icon"></span>
                        <input class="form-control emailverify" type="text" name="email" id="email" placeholder="Type your email address" required>
                    </div>
                </div>

                <div class="input-box col-lg-6">
                    <label class="label-text">Contact Number</label>
                    <div class="form-group">
                        <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="contact_number" placeholder="Type your contact number" required>
                    </div>
                </div>

                <div class="input-box col-lg-12">
                    <label class="label-text">Address</label>
                    <div class="form-group">
                        <span class="la la-user form-icon"></span>
                        <!-- <input class="form-control" type="text" name="text" placeholder="Type your username"> -->
                        <textarea name="address" id="" class="form-control" placeholder="Type your Address"></textarea>

                    </div>
                </div>

                <div class="input-box col-lg-6">
                    <label class="label-text">Password</label>
                    <div class="form-group">
                        <span class="la la-lock form-icon"></span>
                        <input class="form-control" type="password" name="pass1" placeholder="Type password" required>
                    </div>
                </div>
                <div class="input-box col-lg-6">
                    <label class="label-text">Repeat Password</label>
                    <div class="form-group">
                        <span class="la la-lock form-icon"></span>
                        <input class="form-control" type="password" name="pass2" placeholder="Type again password" required>
                    </div>
                </div>


                <div class="btn-box pt-3 pb-4 col-lg-12">
                    <!--<button type="submit" class="theme-btn w-100">Register Account</button>-->
                   {{-- <button type="button" onclick="alert('Email Invalid or Already Exist Please Try Other Email.')" class="theme-btn w-100 btn1">Email Not Correct</button> --}}
                   <button style="display:" type="submit" class="theme-btn w-100 btn2">Register Account</button>
                </div>
                <!-- <div class="action-box text-center">
                    <p class="font-size-14">Or Sign up Using</p>
                    <ul class="social-profile py-3">
                        <li><a href="#" class="bg-5 text-white"><i class="lab la-facebook-f"></i></a></li>
                        <li><a href="#" class="bg-6 text-white"><i class="lab la-twitter"></i></a></li>
                        <li><a href="#" class="bg-7 text-white"><i class="lab la-instagram"></i></a></li>
                        <li><a href="#" class="bg-5 text-white"><i class="lab la-linkedin-in"></i></a></li>
                    </ul>
                </div> -->
            </form>
        </div>
    </div>
</div>

</body>
</html>

@include('site.footer')


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
emailverify();
	function emailverify(){ 
	 			jQuery('.emailverify').keyup(function (e) {  
				 var email=jQuery('#email').val();
					  $.ajax({
								url:'<?php url(''); ?>/email_verify',
								type: "get",
								data: {
								    _token:"{{csrf_token()}}",
									action: "email_verify",
									email: email,
									user_type: jQuery('#user_type').val(),  
								},
								dataType: "json",
								success: function (data) {
									if(data.exist=='No' && email.indexOf('@') > 0){ 
										jQuery('.Email_Not_Avalible').hide();  jQuery('.Email_Avalible').show();   jQuery('.btn2').show();  jQuery('.btn1').hide(); 
									}else{ 
										jQuery('.Email_Not_Avalible').show();  jQuery('.Email_Avalible').hide(); jQuery('.btn1').show();  jQuery('.btn2').hide(); 
									}									
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							});
					  
				});
	}
	
	
				
</script>