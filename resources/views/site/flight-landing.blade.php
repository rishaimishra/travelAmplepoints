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


<section class="card-area section--padding">
    <div class="container">
        <div class="row">
         @foreach($blogData as $key => $data)
            <div class="col-lg-4 responsive-column">
                <div class="card-item blog-card">
                <a href="{{ asset('blog-details') }}/{{$data->blog_id}}">
                    <div class="card-img">
                        <img src="{{$data->thumb_nail}}" alt="blog-img">
                        <div class="post-format icon-element">
                            <i class="la la-photo"></i>
                        </div>
                        <div class="card-body">
                            <div class="post-categories">
                             @php $category=json_decode($data->category,true); @endphp
                             @foreach($category as $key=>$c)
                                <a href="#" class="badge">{{$c}}</a>
                             @endforeach
                            </div>
                            <h3 class="card-title line-height-26"><a href="{{ asset('blog-details') }}/{{$data->id}}"><?php echo $data->heading; ?></a></h3>
                            <p class="card-meta">
                                <span class="post__date"> {{ date('d M Y',strtotime($data->date_time))}} </span>
                                <span class="post-dot"></span>
                                <span class="post__time">{{$data->views}} Views</span>
                               <!-- <span class="post__time">{{$data->likes}} Likes</span>
                                <span class="post__time">{{$data->comments}} Comments</span>-->
                            </p>
                        </div>
                    </div>
                </a>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="author-content d-flex align-items-center">
                            <div class="author-img">
                                <img src="{{$data->profile_pic}}" alt="testimonial image">
                            </div>
                            <div class="author-bio">
                                <a href="{{ asset('blogs') }}/{{$data->user_id}}" class="author__title">{{$data->first_name}} {{$data->last_name}}</a>
                            </div>
                        </div>
                        <div class="post-share">
                            <ul>
                                <li>
                                    <a href="{{ asset('blog-details') }}/{{$data->blog_id}}"><i class="la la-share icon-element"></i></a>
                                    <!--<ul class="post-share-dropdown d-flex align-items-center">
                                        <li><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="lab la-twitter"></i></a></li>
                                        <li><a href="#"><i class="lab la-instagram"></i></a></li>
                                    </ul>-->
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- end card-item -->
            </div><!-- end col-lg-4 -->
         @endforeach  
        </div><!-- end row -->
        <!--<div class="row">
            <div class="col-lg-12">
                <div class="btn-box mt-3 text-center">
                    <button type="button" class="theme-btn"><i class="la la-refresh mr-1"></i>Load More</button>
                    <p class="font-size-13 pt-2">Showing 1 - 6 of 44 Posts</p>
                </div>
            </div>
        </div> end row -->
    </div><!-- end container -->
</section>
@include('site.footer')

