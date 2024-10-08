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
<?php if(isset($_REQUEST['msg'])){ echo "<script>alert('".$_REQUEST['msg']."')</script>";  } ?>

<style>
    @media only screen and (max-width: 600px) {
      .login-content {
        width: 95%;
      }
    }
</style>


<div class="modal-content login-content"  @if($device=='Desktop') style="width:50%; margin:70px auto;box-shadow: 2px 2px 20px #dfdfdf; border:4px #f75b10 solid" @else style="width:90%; margin:70px auto;box-shadow: 2px 2px 20px #dfdfdf;" @endif >

    <div class="modal-header">
        <div>
            <h5 class="modal-title title" id="exampleModalLongTitle2">Member Login</h5>
            {{-- <p class="font-size-14">Hello! Welcome to your account</p> --}}

        </div>
    </div>
    <div class="modal-body">

        <div class="contact-form-action" >
            <form method="post" action="{{ asset('post-login') }}">
            @csrf 
            <input type="hidden" name="prevUrl" value="{{@$prevUrl}}">
                <div class="input-box">
                    <label class="label-text">Email</label>
                    <div class="form-group col-xs-3">
                        <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="email" placeholder="Type your username" required>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box">
                    <label class="label-text">Password</label>
                    <div class="form-group mb-2">
                        <span class="la la-lock form-icon"></span>
                        <input class="form-control" type="password" name="password" placeholder="Type your password" required>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="custom-checkbox mb-0">
                            <input type="checkbox" id="rememberchb">
                            <label for="rememberchb">Remember me</label>
                        </div>
                        <p class="forgot-password">
                            <a href="{{ asset('forgot-password') }}">Forgot Password?</a>
                        </p>
                    </div>
                </div><!-- end input-box -->
                <div class="btn-box pt-3 pb-4">
                    <button type="submit" class="theme-btn w-100">Login Account</button>
                </div>
                <!-- <div class="action-box text-center">
                    <p class="font-size-14">Or Login Using</p>
                    <ul class="social-profile py-3">
                        <li><a href="#" class="bg-5 text-white"><i class="lab la-facebook-f"></i></a></li>
                        <li><a href="#" class="bg-6 text-white"><i class="lab la-twitter"></i></a></li>
                        <li><a href="#" class="bg-7 text-white"><i class="lab la-instagram"></i></a></li>
                        <li><a href="#" class="bg-5 text-white"><i class="lab la-linkedin-in"></i></a></li>
                    </ul>
                </div> -->
            </form>
        </div><!-- end contact-form-action -->
    </div>
</div>



<!-- Login form End -->


    
</body>
</html>

@include('site.footer')