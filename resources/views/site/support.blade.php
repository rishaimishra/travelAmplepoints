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
                 $other_content=json_decode($pageData->other_content,true);          
         @endphp
         


<div class="section-block"></div>

<section class="info-area section-bg padding-top-200px padding-bottom-100px text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="sec__title">Why be a Local Expert</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-60px">
        @for($i=0;$i< 3;$i++)
            <div class="col-lg-4 responsive-column">
                <div class="icon-box">
                    <div class="info-icon">
                        <img src="{{$other_content['images'][$i]}}" alt="a{{$other_content['alt_text'][$i]}}" height="40" width="40" >
                    </div><!-- end info-icon-->
                    <div class="info-content">
                        <h4 class="info__title">{{$other_content['heading'][$i]}}</h4>
                        <p class="info__desc">
                             {{$other_content['content'][$i]}}
                        </p>
                    </div><!-- end info-content -->
                </div><!-- end icon-box -->
            </div><!-- end col-lg-4 -->
        @endfor

        </div><!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-box">
                    <a href="{{ asset('customer-signup')}}" class="theme-btn">Register Now</a>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<div class="section-block"></div>

<section class="info-area info-bg padding-top-100px padding-bottom-60px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title">How Plist work?</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-50px">
        <?php  $a=1; ?>
        @for($i=3;$i< 6;$i++) 
            <div class="col-lg-4 responsive-column">
                <div class="icon-box icon-layout-3 d-flex">
                    <div class="info-icon flex-shrink-0">
                        <img src="{{$other_content['images'][$i]}}" alt="a{{$other_content['alt_text'][$i]}}" height="40" width="40" >
                    </div><!-- end info-icon-->
                    <div class="info-content">
                        <h4 class="info__title">{{$other_content['heading'][$i]}}</h4>
                        <p class="info__desc">
                            {{$other_content['content'][$i]}}
                        </p>
                        <span class="info__num"><?php echo $a; ?></span>
                    </div><!-- end info-content -->
                </div><!-- end icon-box -->
            </div><!-- end col-lg-4 -->
            <?php $a=$a+1; ?>
        @endfor
        </div><!-- end row -->
    </div><!-- end container -->
</section>



<div class="section-block"></div>

<section class="faq-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="sec__title">Frequently Asked Questions</h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row padding-top-40px">
            <div class="col-lg-7">
                <div class="accordion accordion-item" id="accordionExample">
                <?php $arr=array('1'=>'One','2'=>'Two','3'=>'Three','4'=>'Four','5'=>'Five'); $a=1; ?>
                @foreach($faqData as $key => $data)
                    <div class="card">
                        <div class="card-header" id="faqHeading{{$arr[$a]}}">
                            <h2 class="mb-0">
                                <button class="btn btn-link d-flex align-items-center justify-content-between collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse{{$arr[$a]}}" aria-expanded="true" aria-controls="faqCollapse{{$arr[$a]}}">
                                    <span><?php echo $data->question; ?></span>
                                    <i class="la la-minus"></i>
                                    <i class="la la-plus"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="faqCollapse{{$arr[$a]}}" class="collapse" aria-labelledby="faqHeading{{$arr[$a]}}" data-parent="#accordionExample">
                            <div class="card-body">
                                <p><?php echo $data->answer; ?></p>
                            </div>
                        </div>
                    </div><!-- end card -->
                   <?php $a=$a+1; ?>
                    @endforeach
                    
                </div>
                <div class="accordion-help-text pt-2">
                    <p class="font-size-14 font-weight-regular">Any questions? Just visit our <a href="help-desk" class="color-text">Help center</a> or <a href="contact" class="color-text">Contact Us</a></p>
                </div>
            </div><!-- end col-lg-7 -->
            <div class="col-lg-5">
                <div class="faq-forum pl-4">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">Still have question?</h3>
                        </div><!-- form-title-wrap -->
                        <div class="form-content">
                            <div class="contact-form-action">
                                <form action="{{ asset('add-faq-post') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control" type="hidden" name="by" value="site" placeholder="Your name">
                                    <div class="input-box">
                                        <label class="label-text">Your Name</label>
                                        <div class="form-group">
                                            <span class="la la-user form-icon"></span>
                                            <input class="form-control" type="text" name="name" placeholder="Your name">
                                        </div>
                                    </div>
                                    <div class="input-box">
                                        <label class="label-text">Your Email</label>
                                        <div class="form-group">
                                            <span class="la la-envelope-o form-icon"></span>
                                            <input class="form-control" type="email" name="email" placeholder="Email address">
                                        </div>
                                    </div>
                                    <div class="input-box">
                                        <label class="label-text">Question</label>
                                        <div class="form-group">
                                            <span class="la la-pencil form-icon"></span>
                                            <textarea class="message-control form-control" name="question" placeholder="Write message"></textarea>
                                        </div>
                                    </div>
                                    <div class="btn-box">
                                        <button type="submit" class="theme-btn">Send Question</button>
                                    </div>
                                </form>
                            </div><!-- end contact-form-action -->
                        </div><!-- end form-content -->
                    </div><!-- end form-box -->
                </div><!-- end faq-forum -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@include('site.footer')

