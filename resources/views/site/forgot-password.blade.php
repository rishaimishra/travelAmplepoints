@include('site.header')
<!-- Login form -->

<?php if(isset($_REQUEST['msg'])){ echo "<script>alert('".$_REQUEST['msg']."')</script>";  } ?>

    
    
<div class="modal-content" id="forgot" style="width:50%; margin:70px auto;">
    <div class="modal-header">
        <div>
            <h5 class="modal-title title" id="exampleModalLongTitle2">Forgot Password</h5>
            <p class="font-size-14"></p>
        </div>

    </div>
    <div class="modal-body">
        <div class="contact-form-action">
            <form method="post"  id="frm">
            @csrf 
                <div class="input-box">
                    <label class="label-text">Email</label>
                    <div class="form-group col-xs-3">
                        <span class="la la-user form-icon"></span>
                        <input type="text" id="email" class="form-control" placeholder="Enter Email" required>
                    </div>
                </div>
                <div class="btn-box pt-3 pb-4">
                    <button type="button" onclick="formValidation()" class="theme-btn w-100">Send code</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
    <div class="modal-content" id="process1" style="display:none;width:50%; margin:70px auto;">
        <div class="modal-body">
        <div class="contact-form-action">
                <div class="btn-box pt-3 pb-4">
                    <button type="button" onclick="formValidation()" class="theme-btn w-100">Processing...</button>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
<div class="modal-content" id="otp" style="width:50%; margin:70px auto;display:none">
    <div class="modal-header">
        <div>
            <h5 class="modal-title title" id="exampleModalLongTitle2">Verify OTP</h5>
            <p class="font-size-14"></p>
        </div>

    </div>
    <div class="modal-body">
        <div class="contact-form-action">
            <form action="#" id="main_author_form">
            @csrf 
                <center><div class="input-box">
                    <label class="label-text">Enter OTP</label>
                    <div class="form-group col-xs-3">
                        <input style="width:15%!important" class="form-control" name="otp" type="text" maxlength="5">
                    </div>
                </div></center>
                <div class="btn-box pt-3 pb-4">
                    <button type="button" onclick="otpValidation()" class="theme-btn w-100">Send code</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
    
    
    
    
    <div class="modal-content" id="reset" style="width:50%; margin:70px auto;display:none">
    <div class="modal-header">
        <div>
            <h5 class="modal-title title" id="exampleModalLongTitle2">Reset Password</h5>
            <p class="font-size-14"></p>
        </div>

    </div>
    <div class="modal-body">
        <div class="contact-form-action">
            <form action="#" id="main_author_form">
            @csrf 
                <div class="input-box">
                    <label class="label-text">New password</label>
                    <div class="form-group col-xs-3">
                        <input type="text" class="form-control" id="password" placeholder="New password">
                    </div>
                     <label class="label-text">Confirm Password</label>
                    <div class="form-group col-xs-3">
                       <input type="text" class="form-control" id="password2" placeholder="Confirm password">
                    </div>
                    
                </div>
                <div class="btn-box pt-3 pb-4">
                    <button onclick="resetValidation()" class="theme-btn w-100">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('site.footer')


        <script type="text/javascript">
		var otp='';
		var website='';
		function formValidation(){ 
			var email=jQuery('#email').val();
			var msg='This is Otp for reset Password.';
			if(email==''){ alert("Enter Email."); }
			else{			
							$("#process1").show();
						    $("#forgot").hide();
			
								$.ajax({
										url:'<?php url(''); ?>/send_otp',
										type: "GET",
										data: {
											action: "send_otp",
											email: email,
											msg: msg,
											rand: "<?php echo rand(); ?>",
										},
										dataType: "json",  
										success: function (data) {
											msg=data.msg;
											otp=data.otp;
											website=data.website;
											if(data.error=='Yes'){
												alert('Email Not Valid');	
											}else{
												alert('Otp Send');
												$("#otp").show();
												$("#process1").hide();
											}
										},
										error: function (error) {
											console.log(`Error ${error}`);
										}
									});
				}
		
		  }
		  
		  function otpValidation(){
		  	var form_otp=$("input[name='otp']").val();
			
			if(form_otp==otp){
				$("#otp").hide();
			    $("#reset").show();
				alert('OTP Verified');
			}else{ alert('OTP NOT Verified'); }
		  }
		  
		  function resetValidation(){
		  	var email=$("#email").val();
			var password=$("#password").val();
			var password2=$("#password2").val();
			
			if(password==password2){				
				                  $.ajax({
										url:'<?php url(''); ?>/reset_password',
										type: "GET",
										data: {
											action: "reset_password",
											email: email,
											password: password,
											rand: "<?php echo rand(); ?>",
										},
										dataType: "json",  
										success: function (data) { 
											alert('Password Reset. Now Redirect to '+"https://<?php echo $_SERVER['SERVER_NAME']; ?>/login");	
											window.location.replace("https://<?php echo $_SERVER['SERVER_NAME']; ?>/login");											
										},
										error: function (error) {
											alert('Password Reset.. Now Redirect to '+"https://<?php echo $_SERVER['SERVER_NAME']; ?>/login");	
											window.location.replace("https://<?php echo $_SERVER['SERVER_NAME']; ?>/login");
											console.log(`Error ${error}`);
										}
									});
				
				
			}else{ alert('passsword Not ok'); }
		  }
		  
	  </script>