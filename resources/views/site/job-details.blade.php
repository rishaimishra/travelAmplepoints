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
         


    <!-- ================================
    START CONTACT AREA
================================= -->
    
    <section class="job-details-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="form-box">
                    <div class="form-title-wrap">
                        <h3 class="title"><i class="la la-user mr-2 text-gray"></i>About Job</h3>
                    </div><!-- form-title-wrap -->
                    <div class="form-content contact-form-action">
                        <?php echo $jobSingel->About_Job; ?>
                    </div><!-- end form-content -->
                </div><!-- end form-box -->
                 <div class="form-box">
                    <div class="form-title-wrap">
                        <h3 class="title"><i class="la la-briefcase mr-2 text-gray"></i>Job Responsibilities</h3>
                    </div><!-- form-title-wrap -->
                    <div class="form-content contact-form-action">
                        <?php echo $jobSingel->Job_Responsibilities; ?>
                    </div><!-- end form-content -->
                </div><!-- end form-box -->
                <div class="form-box">
                    <div class="form-title-wrap">
                        <h3 class="title"><i class="la la-thumbs-up mr-2 text-gray"></i>Requirements</h3>
                    </div><!-- form-title-wrap -->
                    <div class="form-content contact-form-action">
                        <?php echo $jobSingel->Requirements; ?>
                    </div><!-- end form-content -->
                </div><!-- end form-box -->
                <div class="form-box">
                    <div class="form-title-wrap">
                        <h3 class="title"><i class="la la-gift mr-2 text-gray"></i>What do we offer?</h3>
                    </div><!-- form-title-wrap -->
                    <div class="form-content contact-form-action">
                        <?php echo $jobSingel->What_do_we_offer; ?>
                    </div><!-- end form-content -->
                </div><!-- end form-box -->
                <form action="{{ asset('enquiry') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="job" />
                <input type="hidden" name="tid" value="<?php echo $jobSingel->id; ?>" />
                <input type="hidden" name="redirectUrl" value="{{url()->full()}}" />
                <div class="form-box">
                    <div class="form-title-wrap">
                        <h3 class="title d-flex align-items-center justify-content-between">
                            <span><i class="la la-briefcase mr-2 text-gray"></i>Apply for this Job</span>
                            <span class="font-size-13 text-gray"><span class="text-danger">*</span> Required</span>
                        </h3>
                    </div><!-- form-title-wrap -->
                    <div class="form-content contact-form-action">
                        
                        <div class="row">
                            <div class="col-lg-6 responsive-column">
                                <div class="input-box">
                                    <label class="label-text">First Name</label>
                                    <div class="form-group">
                                        <span class="la la-user form-icon"></span>
                                        <input class="form-control" type="text" name="name" placeholder="First name">
                                    </div>
                                </div>
                            </div><!-- end col-lg-6 -->
                             <div class="col-lg-6 responsive-column">
                                <div class="input-box">
                                    <label class="label-text">Last Name</label>
                                    <div class="form-group">
                                        <span class="la la-user form-icon"></span>
                                        <input class="form-control" type="text" name="lname" placeholder="Last name">
                                    </div>
                                </div>
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-6 responsive-column">
                                <div class="input-box">
                                    <label class="label-text">Your Email</label>
                                    <div class="form-group">
                                        <span class="la la-envelope-o form-icon"></span>
                                        <input class="form-control" type="email" name="email" placeholder="Your email">
                                    </div>
                                </div>
                            </div><!-- end col-lg-6 -->
                             <div class="col-lg-6 responsive-column">
                                <div class="input-box">
                                    <label class="label-text">Phone Number</label>
                                    <div class="form-group">
                                        <span class="la la-phone form-icon"></span>
                                        <input class="form-control" type="text" name="phone" placeholder="Phone number">
                                    </div>
                                </div>
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-12">
                                <div class="input-box">
                                    <label class="label-text">Address</label>
                                    <div class="form-group">
                                        <span class="la la-map-marker form-icon"></span>
                                        <input class="form-control" type="text" name="address" placeholder="Address">
                                    </div>
                                </div>
                            </div><!-- end col-lg-12 -->
                            
                            <div class="col-lg-6 responsive-column">
                                <div class="input-box">
                                    <label class="label-text">How did you hear about this job?</label>
                                    <div class="form-group select-contain w-100">
                                        <div class="dropdown bootstrap-select select-contain-select">
                                            <div class="dropdown bootstrap-select select-contain-select">
                                            <select class="select-contain-select" name="how_know_me" tabindex="-98">
                                                <option value="">Please Select</option>
                                                <option value="Plist's job page">Plist's job page</option>
                                                <option value="Plist's Linkedin">Plist's Linkedin</option>
                                                <option value="Plist's Facebook">Plist's Facebook</option>
                                                <option value="Plist's Twitter">Plist's Twitter</option>
                                                <option value="Other">Other</option>
                                            </select></div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-12 responsive-column">
                                <div class="input-box">
                                    <label class="label-text">Tell us, in 150 words or less, why you'd love to join the Plist crew.</label>
                                   <div class="form-group">
                                       <textarea name="message" class="form-control message-control"></textarea>
                                   </div>
                                </div>
                            </div><!-- end col-lg-12 -->
                        </div>
                    </div><!-- end form-content -->
                </div><!-- end form-box -->
                <div class="submit-box">
                    <h3 class="title pb-3">Submit this CV</h3>
                    <div class="custom-checkbox">
                        <input type="checkbox" id="agreeChb">
                        <label for="agreeChb" class="line-height-24">We care about your privacy. By submitting your application you are agreeing to our Privacy Policy. If you're into reading legal documents or you're keen to know more about how we handle your personal information read our
                            <a href="#">Privacy Policy</a> before you submit your application. </label>
                    </div>
                    <div class="btn-box pt-3">
                        <button type="submit" class="theme-btn">Submit Application <i class="la la-arrow-right ml-1"></i></button>
                    </div>
                </div>
				</form>
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar mb-0">
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Job Summary</h3>
                        <ul class="list-items list-items-flush">
                            <li><span class="text-black mr-2"><i class="la la-calendar mr-2 text-color font-size-18"></i>Published on:</span> <?php echo $jobSingel->date_time; ?></li>
                            <li><span class="text-black mr-2"><i class="la la-glass mr-2 text-color font-size-18"></i>Vacancy:</span> <?php echo $jobSingel->Vacancy; ?></li>
                            <li><span class="text-black mr-2"><i class="la la-laptop mr-2 text-color font-size-18"></i>Employment Status:</span><?php echo $jobSingel->Employment_Status; ?></li>
                            <li><span class="text-black mr-2"><i class="la la-lightbulb mr-2 text-color font-size-18"></i>Experience:</span><?php echo $jobSingel->Experience; ?></li>
                            <li><span class="text-black mr-2"><i class="la la-users mr-2 text-color font-size-18"></i>Gender:</span><?php echo $jobSingel->Gender; ?></li>
                            <li><span class="text-black mr-2"><i class="la la-user mr-2 text-color font-size-18"></i>Age:</span><?php echo $jobSingel->Age; ?></li>
                            <li><span class="text-black mr-2"><i class="la la-map-marker mr-2 text-color font-size-18"></i>Job Location:</span><?php echo $jobSingel->location; ?></li>
                            <li><span class="text-black mr-2"><i class="la la-money mr-2 text-color font-size-18"></i>Salary:</span><?php echo $jobSingel->Salary; ?></li>
                            <li><span class="text-black mr-2"><i class="la la-hourglass-1 mr-2 text-color font-size-18"></i>Application Deadline:</span><?php echo $jobSingel->Application_Deadline; ?></li>
                        </ul>
                    </div><!-- end sidebar-widget -->
                </div><!-- end sidebar -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
    <!-- ================================
    END CONTACT AREA
================================= -->
@include('site.footer')

