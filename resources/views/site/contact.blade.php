@include('site.header')
@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
      
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
         @endphp
         


    <!-- ================================
    START CONTACT AREA
================================= -->
    <section class="contact-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">We'd love to hear from you</h3>
                            <p class="font-size-15">Send us a message and we'll respond as soon as possible</p>
                        </div><!-- form-title-wrap -->
                        <div class="form-content ">
                            <div class="contact-form-action">
<!--                                <form class="row messenger-box-form" method="post" action="{{ asset('enquiry') }}">
                                @csrf-->
                                <form class="row" action="{{ asset('enquiry') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="redirectUrl" value="{{url()->full()}}" />
                                <input type="hidden" name="type" value="enquiry" />
                                    <div class="alert alert-success messenger-box-contact__msg col-lg-12"
                                        style="display: none" role="alert">
                                        Thank You! Your message has been sent.
                                    </div>
                                    <div class="col-lg-6 responsive-column">
                                        <div class="input-box messenger-box-input-wrap">
                                            <label class="label-text" for="name">Your Name</label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input class="form-control" type="text" id="name" name="name" placeholder="Your name" required>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6 responsive-column">
                                        <div class="input-box messenger-box-input-wrap">
                                            <label class="label-text" for="email">Your Email</label>
                                            <div class="form-group">
                                                <span class="la la-envelope-o form-icon"></span>
                                                <input class="form-control" type="email" name="email" placeholder="Email address" required>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-12">
                                        <div class="input-box messenger-box-input-wrap">
                                            <label class="label-text" for="message">Message</label>
                                            <div class="form-group">
                                                <span class="la la-pencil form-icon"></span>
                                                <textarea class="message-control form-control" name="message" placeholder="Write message" required></textarea>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-12 -->
                                    <div class="col-lg-12">
                                        <div class="btn-box messenger-box-input-wrap">
                                            <input type="submit" name="submit" value="Send Message" class="theme-btn send-message-btn">
                                        </div>
                                    </div><!-- end col-lg-12 -->
                                </form>
                            </div><!-- end contact-form-action -->
                        </div><!-- end form-content -->
                    </div><!-- end form-box -->
                </div><!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">Contact Us</h3>
                        </div><!-- form-title-wrap -->
                        <div class="form-content">
                            <div class="address-book">
                                <ul class="list-items contact-address">
                                    <li>
                                        <i class="la la-map-marker icon-element"></i>
                                        <h5 class="title font-size-16 pb-1">Address</h5>
                                        <p class="map__desc">
                                            <?php echo $common['address1'] ?>
                                        </p>
                                    </li>
                                    <li>
                                        <i class="la la-phone icon-element"></i>
                                        <h5 class="title font-size-16 pb-1">Phone</h5>
                                        <p class="map__desc">Telephone: {{$common['contact1']}}</p>
                                        <p class="map__desc">Mobile: {{$common['contact2']}}</p>
                                    </li>
                                    <li>
                                        <i class="la la-envelope-o icon-element"></i>
                                        <h5 class="title font-size-16 pb-1">Email</h5>
                                        <p class="map__desc">{{$common['email1']}}</p>
                                        <p class="map__desc">{{$common['email2']}}</p>
                                    </li>
                                </ul>
                                <ul class="social-profile text-center">
                                    <li><a target="_blank" href="{{$common['fb_link']}}"><i class="lab la-facebook-f"></i></a></li>
                                    <li><a target="_blank" href="{{$common['tw_link']}}"><i class="lab la-twitter"></i></a></li>
                                    <li><a target="_blank" href="{{$common['insta_link']}}"><i class="lab la-instagram"></i></a></li>
                                    <li><a target="_blank" href="{{$common['ld_link']}}"><i class="lab la-linkedin-in"></i></a></li>
                                    <li><a target="_blank" href="{{$common['ld_link']}}"><i class="lab la-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div><!-- end form-content -->
                    </div><!-- end form-box -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end contact-area -->
    <!-- ================================
    END CONTACT AREA
================================= -->
@include('site.footer')

