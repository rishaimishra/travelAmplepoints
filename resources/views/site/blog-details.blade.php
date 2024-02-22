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
            <div class="col-lg-12">
                <div class="card-item blog-card blog-card-layout-2 blog-single-card mb-5">
                <h2 class="card-title font-size-28"><?php echo $blogSingel->heading; ?></h2>
                    <div class="card-img before-none">
                        <img src="{{$blogSingel->thumb_nail}}" alt="blog-img">
                    </div>
                    <div class="card-body px-0 pb-0">
                    
                        <div class="post-categories">
                             @php $category=json_decode($blogSingel->category,true); @endphp
                             @foreach($category as $key=>$c)
                                <a href="#" class="badge">{{$c}}</a>
                             @endforeach
                        </div>
                        <h3 class="card-title font-size-28"><?php echo $blogSingel->sub_heading; ?></h3>
                        <p class="card-meta pb-3">
                            <span class="post__author">By <a href="#" class="text-gray">{{$blogSingel->first_name}} {{$blogSingel->last_name}}</a></span>
                            <span class="post-dot"></span>
                            <span class="post__date"> {{ date('d M Y',strtotime($blogSingel->blog_date))}}</span>
                            <!--<span class="post-dot"></span>
                            <span class="post__time"><a href="#" class="text-gray">{{$blogSingel->comments}} Comments</a></span>
                            <span class="post-dot"></span>
                            <span class="post__time"><a href="#" class="text-gray">{{$blogSingel->likes}} Likes</a></span>-->
                        </p>
                        <div class="section-block"></div>
                        <p class="card-text py-3"><?php echo $blogSingel->content; ?></p>
                        
   
                        <div class="blockquote-item margin-bottom-35px">
                            <blockquote class="mb-0">
                                <p class="blockquote__text"><?php echo $blogSingel->quotes; ?></p>
                            </blockquote>
                        </div>

                        <div class="section-block"></div>
                        <div class="post-tag-wrap d-flex align-items-center justify-content-between py-4">
                            <ul class="tag-list">
                             @php $category=json_decode($blogSingel->category,true); @endphp
                             @foreach($category as $key=>$c)
                                <li><a href="#">{{$c}}</a></li>
                             @endforeach
                            </ul>
                            <div class="post-share">
                                <ul>
                                    <li>
                                        <i class="la la-share icon-element"></i>
                                        <!--<ul class="post-share-dropdown d-flex align-items-center">
                                            <li><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="lab la-twitter"></i></a></li>
                                            <li><a href="#"><i class="lab la-instagram"></i></a></li>
                                        </ul>-->
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="section-block"></div>
                        <!--<div class="post-navigation d-flex justify-content-between py-4">
                            <a href="#" class="btn theme-btn-hover-gray line-height-35"><i class="la la-arrow-left mr-2"></i>The best hotels in Europe: 2020</a>
                            <a href="#" class="btn theme-btn-hover-gray line-height-35">The 10 best flight journeys in the world<i class="la la-arrow-right ml-2"></i></a>
                        </div>-->
                        <div class="section-block"></div>
                        <div class="post-author-wrap">
                            <div class="author-content pt-5">
                                <div class="d-flex">
                                    <div class="author-img author-img-md mr-4">
                                        <a href="#"><img src="{{$blogSingel->profile_pic}}" alt="testimonial image"></a>
                                    </div>
                                    <div class="author-bio">
                                        <h4 class="author__title"><a href="#">{{$blogSingel->first_name}} {{$blogSingel->last_name}}</a></h4>
                                        <span class="author__meta">About the Author</span>
                                       <!-- <p class="author__text pt-1">Donec vehicula nunc in turpis rutrum porta. Nullam lacinia ante non turpis aliquam mattis. Pellentesque luctus leo eget metus egestas egestas.</p>
                                        <ul class="social-profile pt-3">
                                            <li><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="lab la-twitter"></i></a></li>
                                            <li><a href="#"><i class="lab la-instagram"></i></a></li>
                                            <li><a href="#"><i class="lab la-linkedin-in"></i></a></li>
                                        </ul>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end card-item -->
                <div class="section-block"></div>
                <div class="related-posts pt-5 pb-4">
                    <h3 class="title">Latest Posts</h3>
                    <div class="row pt-4">
                        <div class="col-lg-6 responsive-column">
                            <div class="card-item blog-card">
                                <div class="card-img">
                                    <img src="images/blog-img.jpg" alt="blog-img">
                                    <div class="post-format icon-element">
                                        <i class="la la-photo"></i>
                                    </div>
                                    <div class="card-body">
                                        <div class="post-categories">
                                            <a href="#" class="badge">Travel</a>
                                            <a href="#" class="badge">lifestyle</a>
                                        </div>
                                        <h3 class="card-title line-height-26"><a href="blog-single.html">When Traveling Avoid Expensive Hotels &amp; Resorts</a></h3>
                                        <p class="card-meta">
                                            <span class="post__date"> 1 January, 2020</span>
                                            <span class="post-dot"></span>
                                            <span class="post__time">5 Mins read</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="author-content d-flex align-items-center">
                                        <div class="author-img">
                                            <img src="images/small-team1.jpg" alt="testimonial image">
                                        </div>
                                        <div class="author-bio">
                                            <a href="#" class="author__title">Leroy Bell</a>
                                        </div>
                                    </div>
                                    <div class="post-share">
                                        <ul>
                                            <li>
                                                <i class="la la-share icon-element"></i>
                                                <ul class="post-share-dropdown d-flex align-items-center">
                                                    <li><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="lab la-twitter"></i></a></li>
                                                    <li><a href="#"><i class="lab la-instagram"></i></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- end card-item -->
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-6 responsive-column">
                            <div class="card-item blog-card">
                                <div class="card-img">
                                    <img src="images/blog-img2.jpg" alt="blog-img">
                                    <div class="post-format icon-element">
                                        <i class="la la-play"></i>
                                    </div>
                                    <div class="card-body">
                                        <div class="post-categories">
                                            <a href="#" class="badge">Video</a>
                                        </div>
                                        <h3 class="card-title line-height-26"><a href="blog-single.html">My Best Travel Tips: The Ultimate Travel Guide</a></h3>
                                        <p class="card-meta">
                                            <span class="post__date"> 1 February, 2020</span>
                                            <span class="post-dot"></span>
                                            <span class="post__time">4 Mins read</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="author-content d-flex align-items-center">
                                        <div class="author-img">
                                            <img src="images/small-team2.jpg" alt="testimonial image">
                                        </div>
                                        <div class="author-bio">
                                            <a href="#" class="author__title">Phillip Hunt</a>
                                        </div>
                                    </div>
                                    <div class="post-share">
                                        <ul>
                                            <li>
                                                <i class="la la-share icon-element"></i>
                                                <ul class="post-share-dropdown d-flex align-items-center">
                                                    <li><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="lab la-twitter"></i></a></li>
                                                    <li><a href="#"><i class="lab la-instagram"></i></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- end card-item -->
                        </div><!-- end col-lg-6 -->
                    </div><!-- end row -->
                </div>
                <div class="section-block"></div>
                <?php /*?><div class="comments-list pt-5">
                    <h3 class="title">Showing 3 Comments</h3>
                    <div class="comment pt-5">
                        <div class="comment-avatar">
                            <img class="avatar__img" alt="" src="images/team8.jpg">
                        </div>
                        <div class="comment-body">
                            <div class="meta-data">
                                <h3 class="comment__author">Jenny Doe</h3>
                                <div class="meta-data-inner">
                                    <p class="comment__date">April 5, 2019</p>
                                </div>
                            </div>
                            <p class="comment-content">
                                Lorem ipsum dolor sit amet, dolores mandamus moderatius ea ius, sed civibus vivendum imperdiet ei, amet tritani sea id. Ut veri diceret fierent mei, qui facilisi suavitate euripidis
                            </p>
                            <div class="comment-reply">
                                <a class="theme-btn" href="#" data-toggle="modal" data-target="#replayPopupForm">
                                    <span class="la la-mail-reply mr-1"></span>Reply
                                </a>
                            </div>
                        </div>
                    </div><!-- end comments -->
                    <div class="comment comment-reply-item">
                        <div class="comment-avatar">
                            <img class="avatar__img" alt="" src="images/team9.jpg">
                        </div>
                        <div class="comment-body">
                            <div class="meta-data">
                                <h3 class="comment__author">Jenny Doe</h3>
                                <div class="meta-data-inner">
                                    <p class="comment__date">April 5, 2019</p>
                                </div>
                            </div>
                            <p class="comment-content">
                                Lorem ipsum dolor sit amet, dolores mandamus moderatius ea ius, sed civibus vivendum imperdiet ei, amet tritani sea id. Ut veri diceret fierent mei, qui facilisi suavitate euripidis
                            </p>
                            <div class="comment-reply">
                                <a class="theme-btn" href="#" data-toggle="modal" data-target="#replayPopupForm">
                                    <span class="la la-mail-reply mr-1"></span>Reply
                                </a>
                            </div>
                        </div>
                    </div><!-- end comments -->
                    <div class="comment">
                        <div class="comment-avatar">
                            <img class="avatar__img" alt="" src="images/team10.jpg">
                        </div>
                        <div class="comment-body">
                            <div class="meta-data">
                                <h3 class="comment__author">Jenny Doe</h3>
                                <div class="meta-data-inner">
                                    <p class="comment__date">April 5, 2019</p>
                                </div>
                            </div>
                            <p class="comment-content">
                                Lorem ipsum dolor sit amet, dolores mandamus moderatius ea ius, sed civibus vivendum imperdiet ei, amet tritani sea id. Ut veri diceret fierent mei, qui facilisi suavitate euripidis
                            </p>
                            <div class="comment-reply">
                                <a class="theme-btn" href="#" data-toggle="modal" data-target="#replayPopupForm">
                                    <span class="la la-mail-reply mr-1"></span>Reply
                                </a>
                            </div>
                        </div>
                    </div><!-- end comments -->
                    <div class="btn-box load-more text-center">
                        <button class="theme-btn theme-btn-small theme-btn-transparent" type="button">Load More Comment</button>
                    </div>
                </div><!-- end comments-list -->
                <div class="comment-forum pt-5">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">Add a Comment</h3>
                        </div><!-- form-title-wrap -->
                        <div class="form-content">
                            <div class="contact-form-action">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">Name</label>
                                                <div class="form-group">
                                                    <span class="la la-user form-icon"></span>
                                                    <input class="form-control" type="text" name="text" placeholder="Your name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">Email</label>
                                                <div class="form-group">
                                                    <span class="la la-envelope-o form-icon"></span>
                                                    <input class="form-control" type="email" name="email" placeholder="Email address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">Message</label>
                                                <div class="form-group">
                                                    <span class="la la-pencil form-icon"></span>
                                                    <textarea class="message-control form-control" name="message" placeholder="Write message"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="chbyes">
                                                    <label for="chbyes">Save my name, email, and website in this browser for the next time I comment.</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="btn-box">
                                                <button type="button" class="theme-btn">Leave a Comment</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- end contact-form-action -->
                        </div><!-- end form-content -->
                    </div><!-- end form-box -->
                </div><!-- end comment-forum --><?php */?>
            </div><!-- end col-lg-8 -->
            <?php /*?><div class="col-lg-4">
                <div class="sidebar mb-0">
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Search Post</h3>
                        <div class="contact-form-action">
                            <form action="#">
                                <div class="input-box">
                                    <div class="form-group mb-0">
                                        <input class="form-control pl-3" type="text" placeholder="Type your keywords...">
                                        <button class="search-btn" type="submit"><i class="la la-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- end sidebar-widget -->
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Categories</h3>
                        <div class="sidebar-category">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="cat1">
                                <label for="cat1">All <span class="font-size-13 ml-1">(55)</span></label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="cat2">
                                <label for="cat2">Active Adventure Tours <span class="font-size-13 ml-1">(8)</span></label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="cat3">
                                <label for="cat3">Ecotourism <span class="font-size-13 ml-1">(5)</span></label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="cat4">
                                <label for="cat4">Escorted Tours <span class="font-size-13 ml-1">(2)</span></label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="cat5">
                                <label for="cat5">Group Tours <span class="font-size-13 ml-1">(11)</span></label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="cat6">
                                <label for="cat6">Ligula <span class="font-size-13 ml-1">(3)</span></label>
                            </div>
                            <div class="collapse" id="categoryMenu">
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="cat7">
                                    <label for="cat7">Family Tours <span class="font-size-13 ml-1">(4)</span></label>
                                </div>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="cat8">
                                    <label for="cat8">City Trips <span class="font-size-13 ml-1">(5)</span></label>
                                </div>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="cat9">
                                    <label for="cat9">National Parks Tours <span class="font-size-13 ml-1">(3)</span></label>
                                </div>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="cat10">
                                    <label for="cat10">Vacations <span class="font-size-13 ml-1">(3)</span></label>
                                </div>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="cat11">
                                    <label for="cat11">Early booking <span class="font-size-13 ml-1">(7)</span></label>
                                </div>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="cat12">
                                    <label for="cat12">Last minute <span class="font-size-13 ml-1">(2)</span></label>
                                </div>
                            </div><!-- end collapse -->
                            <a class="btn-text" data-toggle="collapse" href="#categoryMenu" role="button" aria-expanded="false" aria-controls="categoryMenu">
                                <span class="show-more">Show More <i class="la la-angle-down"></i></span>
                                <span class="show-less">Show Less <i class="la la-angle-up"></i></span>
                            </a>
                        </div>
                    </div><!-- end sidebar-widget -->
                    <div class="sidebar-widget">
                        <div class="section-tab section-tab-2 pb-3">
                            <ul class="nav nav-tabs" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="recent-tab" data-toggle="tab" href="#recent" role="tab" aria-controls="recent" aria-selected="true">
                                        Recent
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="popular-tab" data-toggle="tab" href="#popular" role="tab" aria-controls="popular" aria-selected="false">
                                        Popular
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="new-tab" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="false">
                                        New
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane " id="recent" role="tabpanel" aria-labelledby="recent-tab">
                                <div class="card-item card-item-list recent-post-card">
                                    <div class="card-img">
                                        <a href="blog-single.html" class="d-block">
                                            <img src="images/small-img4.jpg" alt="blog-img">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="blog-single.html">Pack wisely before traveling</a></h3>
                                        <p class="card-meta">
                                            <span class="post__date"> 1 March, 2020</span>
                                            <span class="post-dot"></span>
                                            <span class="post__time">3 Mins read</span>
                                        </p>
                                    </div>
                                </div><!-- end card-item -->
                                <div class="card-item card-item-list recent-post-card">
                                    <div class="card-img">
                                        <a href="blog-single.html" class="d-block">
                                            <img src="images/small-img5.jpg" alt="blog-img">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="blog-single.html">Change your place and get the fresh air</a></h3>
                                        <p class="card-meta">
                                            <span class="post__date"> 1 March, 2020</span>
                                            <span class="post-dot"></span>
                                            <span class="post__time">3 Mins read</span>
                                        </p>
                                    </div>
                                </div><!-- end card-item -->
                                <div class="card-item card-item-list recent-post-card mb-0">
                                    <div class="card-img">
                                        <a href="blog-single.html" class="d-block">
                                            <img src="images/small-img6.jpg" alt="blog-img">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="blog-single.html">Introducing this amazing city</a></h3>
                                        <p class="card-meta">
                                            <span class="post__date"> 1 March, 2020</span>
                                            <span class="post-dot"></span>
                                            <span class="post__time">3 Mins read</span>
                                        </p>
                                    </div>
                                </div><!-- end card-item -->
                            </div><!-- end tab-pane -->
                            <div class="tab-pane fade show active" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                                <div class="card-item card-item-list recent-post-card">
                                    <div class="card-img">
                                        <a href="blog-single.html" class="d-block">
                                            <img src="images/small-img7.jpg" alt="blog-img">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="blog-single.html">The Castle on the Cliff: Majestic, Magic</a></h3>
                                        <p class="card-meta">
                                            <span class="post__date"> 1 March, 2020</span>
                                            <span class="post-dot"></span>
                                            <span class="post__time">3 Mins read</span>
                                        </p>
                                    </div>
                                </div><!-- end card-item -->
                                <div class="card-item card-item-list recent-post-card">
                                    <div class="card-img">
                                        <a href="blog-single.html" class="d-block">
                                            <img src="images/small-img8.jpg" alt="blog-img">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="blog-single.html">Change your place and get the fresh air</a></h3>
                                        <p class="card-meta">
                                            <span class="post__date"> 1 March, 2020</span>
                                            <span class="post-dot"></span>
                                            <span class="post__time">3 Mins read</span>
                                        </p>
                                    </div>
                                </div><!-- end card-item -->
                                <div class="card-item card-item-list recent-post-card mb-0">
                                    <div class="card-img">
                                        <a href="blog-single.html" class="d-block">
                                            <img src="images/small-img9.jpg" alt="blog-img">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="blog-single.html">All Aboard the Rocky Mountaineer</a></h3>
                                        <p class="card-meta">
                                            <span class="post__date"> 1 March, 2020</span>
                                            <span class="post-dot"></span>
                                            <span class="post__time">3 Mins read</span>
                                        </p>
                                    </div>
                                </div><!-- end card-item -->
                            </div><!-- end tab-pane -->
                            <div class="tab-pane " id="new" role="tabpanel" aria-labelledby="new-tab">
                                <div class="card-item card-item-list recent-post-card">
                                    <div class="card-img">
                                        <a href="blog-single.html" class="d-block">
                                            <img src="images/small-img7.jpg" alt="blog-img">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="blog-single.html">The Castle on the Cliff: Majestic, Magic</a></h3>
                                        <p class="card-meta">
                                            <span class="post__date"> 1 March, 2020</span>
                                            <span class="post-dot"></span>
                                            <span class="post__time">3 Mins read</span>
                                        </p>
                                    </div>
                                </div><!-- end card-item -->
                                <div class="card-item card-item-list recent-post-card">
                                    <div class="card-img">
                                        <a href="blog-single.html" class="d-block">
                                            <img src="images/small-img8.jpg" alt="blog-img">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="blog-single.html">Change your place and get the fresh air</a></h3>
                                        <p class="card-meta">
                                            <span class="post__date"> 1 March, 2020</span>
                                            <span class="post-dot"></span>
                                            <span class="post__time">3 Mins read</span>
                                        </p>
                                    </div>
                                </div><!-- end card-item -->
                                <div class="card-item card-item-list recent-post-card mb-0">
                                    <div class="card-img">
                                        <a href="blog-single.html" class="d-block">
                                            <img src="images/small-img9.jpg" alt="blog-img">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="blog-single.html">All Aboard the Rocky Mountaineer</a></h3>
                                        <p class="card-meta">
                                            <span class="post__date"> 1 March, 2020</span>
                                            <span class="post-dot"></span>
                                            <span class="post__time">3 Mins read</span>
                                        </p>
                                    </div>
                                </div><!-- end card-item -->
                            </div><!-- end tab-pane -->
                        </div>
                    </div><!-- end sidebar-widget -->
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Archives</h3>
                        <div class="sidebar-list">
                            <ul class="list-items">
                                <li><i class="la la-dot-circle mr-2 text-color"></i><a href="#">June 2015</a></li>
                                <li><i class="la la-dot-circle mr-2 text-color"></i><a href="#">May 2016</a></li>
                                <li><i class="la la-dot-circle mr-2 text-color"></i><a href="#">April 2017</a></li>
                                <li><i class="la la-dot-circle mr-2 text-color"></i><a href="#">February 2019</a></li>
                            </ul>
                        </div>
                    </div><!-- end sidebar-widget -->
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Tag Cloud</h3>
                        <ul class="tag-list">
                            <li><a href="#">Travel</a></li>
                            <li><a href="#">Adventure</a></li>
                            <li><a href="#">Tour</a></li>
                            <li><a href="#">Nature</a></li>
                            <li><a href="#">Island</a></li>
                            <li><a href="#">Parks</a></li>
                            <li><a href="#">Cruise</a></li>
                            <li><a href="#">Mountains</a></li>
                            <li><a href="#">Bar</a></li>
                            <li><a href="#">Beaches</a></li>
                            <li><a href="#">Nightlife</a></li>
                        </ul>
                    </div><!-- end sidebar-widget -->
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">About us</h3>
                        <div class="sidebar-about">
                            <div class="sidebar-about-img">
                                <img src="images/destination-img3.jpg" alt="">
                                <p class="font-size-28 font-weight-bold text-white">Trizen</p>
                            </div>
                            <p class="pt-3">Sed ut perspiciatis unde omnis iste natus error sit voluptatem eaque ipsa quae ab illo inventore incididunt ut labore et dolore magna</p>
                        </div>
                    </div><!-- end sidebar-widget -->
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Follow &amp; Connect</h3>
                        <ul class="social-profile">
                            <li><a href="#"><i class="lab la-facebook-f"></i></a></li>
                            <li><a href="#"><i class="lab la-twitter"></i></a></li>
                            <li><a href="#"><i class="lab la-instagram"></i></a></li>
                            <li><a href="#"><i class="lab la-linkedin-in"></i></a></li>
                        </ul>
                    </div><!-- end sidebar-widget -->
                </div><!-- end sidebar -->
            </div><?php */?><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@include('site.footer')

