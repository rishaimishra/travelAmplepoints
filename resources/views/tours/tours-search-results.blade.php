@include('site.header')
<div class="loader"><svg class="spinner" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg><br />Loading...</div>
<div class="container not_found" style="display:none">Sorry, Activity Not Found.</div>

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

<style>
.fade:not(.show) {
    opacity: 1;
}
.opacity_5 {
  opacity: 0.3;
}
</style>

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<div class="whole_content" style="display:none">
<section class="breadcrumb-area bread-bg-6">
<div class="video-bg" style="background:url({{$pageData->image}});background-size: cover;">
    </div>
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="sec__title text-white">Tours List</h2>
                        </div>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="breadcrumb-list text-right">
                        <ul class="list-items">
                            <li><a href="<?php echo url('');?>">Home</a></li>
                            <li>Tours</li>
                            <li>Tours List</li>
                        </ul>
                    </div><!-- end breadcrumb-list -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
            <div class="search-fields-container" style="margin-top:10px">
              @include('tours.tours-search-box')
            </div>
        </div><!-- end container -->
    </div><!-- end breadcrumb-wrap -->
    <!--<div class="bread-svg-box">
        <svg class="bread-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none"><polygon points="100 0 50 10 0 0 0 10 100 10"></polygon></svg>
    </div>--><!-- end bread-svg -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
    START CARD AREA
================================= -->
<section class="card-area section--padding">


    <div class="container " >
        <div class="row">
            <div class="col-lg-12">
                <div class="filter-wrap margin-bottom-30px">
                    <div class="filter-top d-flex align-items-center justify-content-between pb-4">
                        <div>
                            <h3 class="title font-size-24"><span class="totalhotel"></span> Activity found</h3>
                            <p class="font-size-14"><span class="mr-1 pt-1">Book with confidence:</span>No Activity booking fees</p>
                        </div>
                       <!-- <div class="layout-view d-flex align-items-center">
                            <a href="hotel-grid.html" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="la la-th-large"></i></a>
                            <a href="hotel-list.html" data-toggle="tooltip" data-placement="top" title="List View" class="active"><i class="la la-th-list"></i></a>
                        </div>-->
                    </div><!-- end filter-top -->
                   <div class="filter-bar d-flex align-items-center justify-content-between">
                        <div class="filter-bar-filter d-flex flex-wrap align-items-center">
                            <div class="filter-option">
                                <h3 class="title font-size-16">Filter by:</h3>
                            </div>
                            <div class="filter-option">
                                <div class="dropdown dropdown-contain">
                                    <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button" data-toggle="dropdown">

                                        Filter Price

                                    </a>

                                    <div class="dropdown-menu dropdown-menu-wrap">

                                        <div class="dropdown-item">

                                            <div class="slider-range-wrap">

                                                <div class="price-slider-amount padding-bottom-20px">

                                                    <label for="amount" class="filter__label">Price:</label>

                                                    <input type="text" id="amount2_1" class="amounts amount2_1">

                                                </div><!-- end price-slider-amount -->

                                                <div id="slider-range2"  class="slider-range2" onclick="Show_Activity('filter')"></div><!-- end slider-range -->

                                            </div><!-- end slider-range-wrap -->

                                            <div class="btn-box pt-4">

                                                <button class="theme-btn theme-btn-small theme-btn-transparent" type="button">Apply</button>

                                            </div>

                                        </div><!-- end dropdown-item -->

                                    </div><!-- end dropdown-menu -->

                                </div><!-- end dropdown -->

                                

                                

                                

                                

                            </div>
                            <div class="filter-option">

                                <div class="dropdown dropdown-contain">

                                    <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button" data-toggle="dropdown">

                                        Duration

                                    </a>

                                    <div class="dropdown-menu dropdown-menu-wrap">

                                        <div class="dropdown-item">

                                            <div class="checkbox-wrap duration_List_f">

                                                

                                            </div>

                                        </div><!-- end dropdown-item -->

                                    </div><!-- end dropdown-menu -->

                                </div><!-- end dropdown -->

                            </div>

                            <div class="filter-option">

                                <div class="dropdown dropdown-contain">

                                    <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button" data-toggle="dropdown">

                                        Category

                                    </a>

                                    <div class="dropdown-menu dropdown-menu-wrap">

                                        <div class="dropdown-item">

                                            <div class="checkbox-wrap category_List_f">

                                                

                                            </div>

                                        </div><!-- end dropdown-item -->

                                    </div><!-- end dropdown-menu -->

                                </div><!-- end dropdown -->

                            </div>

                        </div><!-- end filter-bar-filter -->

                         <div class="select-contain">

                            <select class="select-contain-select" name="sort" id="sort" onchange="Show_Activity('filter')">

                                <option value="lowRate_ASC" selected="selected">Sort Your Activity</option>

                                <option value="lowRate_ASC">Price: low to high</option>

                                <option value="lowRate_DESC">Price: high to low</option>

                                <option value="hotelRating_ASC">Star Rating: low to high</option>

                                <option value="hotelRating_DESC">Star Airline: high to low</option>

                                <option value="Name_ASC">Duration: A to Z</option>

                                <option value="Name_DESC">Duration: Z to A</option>

                            </select>

                        </div><!-- end select-contain -->

                    </div><!-- end filter-bar -->

                </div><!-- end filter-wrap -->

            </div><!-- end col-lg-12 -->

        </div><!-- end row -->

        <div class="row">

            <div class="col-lg-4">

                <div class="sidebar mt-0">

                    <div class="sidebar-widget">

                        <h3 class="title stroke-shape">Filter by Price</h3>

                        <div class="sidebar-price-range">

                            <div class="main-search-input-item">

                                <div class="price-slider-amount padding-bottom-20px">

                                    <label for="amount2" class="filter__label">Price:</label>

                                    <input type="text" id="amount2_1" class="amounts amount2_1">

                                </div><!-- end price-slider-amount -->

                                <div id="slider-range2" class="slider-range2" onclick="Show_Activity('filter')"></div><!-- end slider-range -->

                            </div><!-- end main-search-input-item -->

                            <div class="btn-box pt-4">

                                <button class="theme-btn theme-btn-small theme-btn-transparent" onclick="Show_Activity('filter')" type="button">Apply</button>

                            </div>

                        </div>

                    </div><!-- end filter by price -->

                    <div class="sidebar-widget">

                        <h3 class="title stroke-shape">Search By Activity Name </h3>

                        <div class="sidebar-category">

                            <div class="custom-checkbox">

          <input name="findbynamefilter" id="findbynamefilter" placeholder="Search By Activity Name" type="text" id="ht1"><input id="findbynamebtn" onclick="Show_Activity('filter')" type="button" value="search" id="ht1">

                            </div>

                        </div>

                    </div><!-- end filter by name -->

                    <div class="sidebar-widget">

                        <h3 class="title stroke-shape">Filter by Duration </h3>

                        <div class="sidebar-category duration_List">

                            

                            

                        </div>

                    </div><!-- end filter by board -->

                    <div class="sidebar-widget">

                        <h3 class="title stroke-shape">Category</h3>

                        <div class="sidebar-category category_List">

                        </div>

                    </div><!-- end filter by aminity -->

                </div><!-- end sidebar -->

            </div><!-- end col-lg-4 -->

            <div class="col-lg-8">

                <div class="hotellist" id="hotellist">

                </div><!-- end card-item -->

            </div><!-- end col-lg-8 -->

        </div><!-- end row -->

        <div class="row">

            <div class="col-lg-12">

                <div class="btn-box mt-3 text-center">

                    <button type="button" class="theme-btn" onclick="Show_Activity('load')"><i class="la la-refresh mr-1"></i>Load More</button>

                    <p class="font-size-13 pt-2">Showing 1 - <span class="totalhotel_to"></span> of <span class="totalhotel"></span> Activity</p>

                </div><!-- end btn-box -->

            </div><!-- end col-lg-12 -->

        </div><!-- end row -->

    </div><!-- end container -->

</section><!-- end card-area -->

<!-- ================================

    END CARD AREA

================================= -->



<div class="section-block"></div>











<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

                                <script type="text/javascript">

jQuery(".common_beard_comb").hide(); jQuery(".preloader").hide();

var innerHtml=''; var page=0; var search_session='';

      jQuery(document).ready(function(){   

	  var innerHtml='<div class="loader"><svg class="spinner" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg></div>';   

	  

	  				FindKey();

					

					 function FindKey() {
					 		$.ajax({
								url:'<?php url(''); ?>/findsearchkey',
								type: "GET",
								data: {
									action: "findsearchkey",  
									regionid: "<?php echo $_REQUEST['city_code']; ?>",
									destination: "<?php echo $_REQUEST['city_name']; ?>",
									travel_date: "<?php echo $_REQUEST['travel_date']; ?>",  
									adults: "<?php echo $_REQUEST['adults']; ?>",
									childs: "<?php echo $_REQUEST['childs']; ?>",
									rand: Math.random()
								},
								dataType: "json",
								success: function (data) {
									search_session=data.search_session;
									Upldate_Rates_All();									
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							});
					 }
	 					var page_number=1;
						var loop =0;
						
						function Upldate_Rates_All(){
			   			 $.ajax({
								url:<?php url('');?>'/tours-search-results2',
								type: "GET",
								data: {
									action: "Upldate_Rates_All",  
									city_code: "<?php echo $_REQUEST['city_code']; ?>",
									destination: "<?php echo $_REQUEST['city_name']; ?>",
									travel_date: "<?php echo $_REQUEST['travel_date']; ?>",  
									adults: "<?php echo $_REQUEST['adults']; ?>",
									childs: "<?php echo $_REQUEST['childs']; ?>",
									page_number: page_number,
									search_session: search_session,	
									rand: Math.random()
								},
								dataType: "json",
								success: function (data) {
								console.log(data);
								loop++;
									var pageCount=0;;
									var total_records = data.totalItems;	
									if(total_records>0){ 
											if( (pageCount>0) && (loop<200) ){ 
											 page_number++;
											 setTimeout(function(){Upldate_Rates_All();},100);
											}
										Show_Activity('filter');

										 getControls();
									}else{

										if( (pageCount>0) && (loop<200) ){ 

											 page_number++;

											 setTimeout(function(){Upldate_Rates_All();},100);

										}else{

											jQuery('.not_found').show();

											jQuery('.loader').hide();

											alert("No Activity Found.");

										}

									}

								},

								error: function (error) {

									console.log(`Error ${error}`);

								}

							});

							

							

							}

		

      });	   

/*	  var search_session="6223c765639ec"; 

	  Show_Activity();

	  getControls();*/

	  

	 						function Show_Activity(type)
							{    
								jQuery('.hotellist').addClass('opacity_5');
								var sortVal= document.getElementById("sort").value;
								if(type=='filter'){  innerHtml=''; } else { page=page+1; }
								
								var duration_List = '';
								jQuery('input[name=duration_List]:checked').each(function(i) { 
									duration_List[i] = jQuery(this).val();
									 var a=jQuery(this).val() ;
									   duration_List +=a+",";
								});
								
								var category_List = '';
								jQuery('input[name=category_List]:checked').each(function(i) { 
									category_List[i] = jQuery(this).val();
									 var a=jQuery(this).val() ;
									   category_List +=a+",";
								});
								
								var activity_name = document.getElementById('findbynamefilter').value;
								var price= document.getElementById("amount2_1").value;
								jQuery('.totalhotel_to').html(page*10); 
								 $.ajax({
								url:<?php url('');?>'/Show_Activity',
								type: "GET",
								data: {
									action: "Show_Activity",
									search_id: search_session,
									page: page,  
									sortVal: sortVal,
									Cri_Duration: duration_List,
									Cri_Categories: category_List,
									activity_name: activity_name, 
									Cri_Price: price,
									rand: Math.random()
								},
								dataType: "json",
								success: function (data) {
									jQuery('.whole_content').show();
									jQuery('.loader').hide();
								    jQuery('.hotellist').removeClass('opacity_5');
									console.log(data.result);
									jQuery('.totalhotel').html(data.result[0].total);																	
									//alert(data.result.length); alert(data.result[0].thumbnail);
									for(var i=0;i<data.result.length;i++){
									var price=parseFloat(data.result[i].price);
										 innerHtml +='<div class="card-item card-item-list"><div class="card-img"><a href="tours-details/'+btoa(data.result[i].tid)+'"  class="d-block"><img src="'+data.result[i].thumbNailUrl+'" onerror="this.onerror=null; this.src=\'<?php echo url('');?>assets/images/nohotel.jpg\'" alt="hotel-img"></a><span class="badge">'+data.result[i].categories+'</span>  <div class="add-to-wishlist icon-element" data-toggle="tooltip" data-placement="top" title="Bookmark"><i class="la la-heart-o"></i></div></div><div class="card-body"><h3 class="card-title"><a href="tours-details/'+btoa(data.result[i].tid)+'" >'+data.result[i].Name+' ('+data.result[i].duration+')</a></h3><b><i><p class="card-meta">'+data.result[i].destination+', '+data.result[i].country+'</i></b></p><p class="card-meta">'+data.result[i].description.substr(0, 200)+'...</p><div class="card-price d-flex align-items-center justify-content-between"><p><span class="price__from">From </span><span class="price__num" style="color:#287dfa"><?php echo $currency_symbol; ?> '+price.toLocaleString()+'</span><span class="price__text">Per/person</span></p><a href="tours-details/'+btoa(data.result[i].tid)+'" class="btn-text"><span class="theme-btn w-100 text-center margin-top-20px Search_Now">See details<i class="la la-angle-right"></i></span></a></div></div></div>';
									}
									jQuery('.hotellist').html(innerHtml);
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							   });
							}
							function getControls() {
								 $.ajax({
								url:<?php url('');?>'/GetControls',
								type: "GET",
								data: {
									action: "getControls",
									search_id: search_session,
									page: page,  
									rand: Math.random()
								},
								dataType: "json",
								success: function (data) {
									
									var duration_List=data.duration_List;  
									var cs=data.currency_symbol; 
									var duration_ListHtml='';     var duration_ListHtml_f=''; 
									for(var i=0;i<duration_List.length;i++){  
										duration_ListHtml+='<div class="custom-checkbox"><input onclick="Show_Activity(\'filter\')" name="duration_List" value="'+duration_List[i].title+'" type="checkbox" id="b'+i+'"><label for="b'+i+'">'+duration_List[i].title+' ('+duration_List[i].count+')</label></div>';
										duration_ListHtml_f+='<div class="custom-checkbox"><input onclick="Show_Activity(\'filter\')" name="duration_List" value="'+duration_List[i].title+'" type="checkbox" id="b'+i+'_f"><label for="b'+i+'_f">'+duration_List[i].title+' ('+duration_List[i].count+')</label></div>';
									}
								jQuery('.duration_List').html(duration_ListHtml); 
								jQuery('.duration_List_f').html(duration_ListHtml_f);
								
									var category_List=data.category_List;  
									
									var category_ListHtml='';   var category_ListHtml_f='';  
									for(var i=0;i<category_List.length;i++){  
										category_ListHtml+='<div class="custom-checkbox"><input onclick="Show_Activity(\'filter\')" name="category_List" value="'+category_List[i].value+'" type="checkbox" id="a'+i+'"><label for="a'+i+'">'+category_List[i].name+' ('+category_List[i].categoryCount+')</label></div>';
										category_ListHtml_f+='<div class="custom-checkbox"><input onclick="Show_Activity(\'filter\')" name="category_List" value="'+category_List[i].value+'" type="checkbox" id="a'+i+'_f"><label for="a'+i+'_f">'+category_List[i].name+' ('+category_List[i].categoryCount+')</label></div>';
									}
								jQuery('.category_List').html(category_ListHtml);
								jQuery('.category_List_f').html(category_ListHtml_f);
								
								    var maxprice=data.maxrate;  
									var minprice=data.minrate;  
									var rangeSlider	=$('.slider-range2');
									var rangeSliderAmount =$('.amount2_1');	
									if ($(rangeSlider).length) {
            							$(rangeSlider).slider({
											range: true,
											min: minprice,
											max: maxprice,
											values: [ minprice, maxprice ],
											slide: function( event, ui ) {
												$(rangeSliderAmount).val(  ui.values[ 0 ] + " - "+ ui.values[ 1 ] );
											}
										});
									}
				  $(rangeSliderAmount).val(  $(rangeSlider).slider( "values", 0 ) + " - " + $(rangeSlider).slider( "values", 1 ) );
								
								}

								});

								

                   

							

                         

                    };

					

					

					jQuery("#findbynamefilter").keyup(function(event) {

						if (event.keyCode === 13) {

							jQuery("#findbynamebtn").trigger('click');

						}

					});



	  

      </script>

@include('site.footer')

</div>