@include('site.header')
@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
      
				$common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images=  $data['siteData']['images'];
                $images=json_decode($images,true);
                $sessionval=session()->all();
         @endphp

<section id="news_main_arae" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Latest travel news</h2>
                    </div>
                </div>
            </div>            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-hotels" role="tabpanel" aria-labelledby="nav-hotels-tab">
                            <div class="row">
                            @foreach($blogData as $key => $data)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="theme_common_box_two img_hover">
                                        <div class="theme_two_box_img">
                                            <a href="{{ asset('blog-details') }}/{{$data->blog_id}}"><img src="{{$data->thumb_nail}}" alt="img"></a>
                                            <!--<p><i class="fas fa-map-marker-alt"></i>New beach, Thailand</p>-->
                                        </div>
                                        <div class="theme_two_box_content">
                                            <h4><a href="{{ asset('blog-details') }}/{{$data->blog_id}}"><?php echo $data->heading; ?>
                                    </a></h4>
                                            <p><span class="review_rating"><?php echo $data->sub_heading; ?></span></p>
                                            <div class="news_author_area">
                                <div class="news_author_img">
                                    <img src="{{$data->profile_pic}}" alt="img">
                                </div>
                                <div class="news_author_area_name">
                                    <h4><a href="{{ asset('blogs') }}/{{$data->user_id}}" class="author__title">{{$data->first_name}} {{$data->last_name}}</a></h4>
                                    <p><a href="{{ asset('blog-details') }}/{{$data->blog_id}}">{{ date('d M Y',strtotime($data->date_time))}} </a> <i class="fas fa-circle"></i> 8 min read</p>
                                </div>
                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach 
                            </div>
                            <div class="col-lg-12" style="display:none">
                                <div class="pagination_area">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">«</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">»</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </section>


    




@include('site.footer')

