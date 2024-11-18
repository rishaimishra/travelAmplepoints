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
                            <h2 class="sec__title text-white">Transfers List</h2>
                        </div>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="breadcrumb-list text-right">
                        <ul class="list-items">
                            <li><a href="<?php echo url('');?>">Home</a></li>
                            <li>Transfers</li>
                            <li>Transfers List</li>
                        </ul>
                    </div><!-- end breadcrumb-list -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
            <div class="search-fields-container" style="margin-top:10px">
              @include('transfers.transfers-search-box')
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
                            <h3 class="title font-size-24"><span class="totalhotel"></span> Transfers found</h3>
                            <p class="font-size-14"><span class="mr-1 pt-1">Book with confidence:</span>No Transfers booking fees</p>
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
                                                <div id="slider-range2"  class="slider-range2" onclick="Show_Transfers('filter')"></div><!-- end slider-range -->
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
                                        Transfer Type
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-wrap">
                                        <div class="dropdown-item">
                                            <div class="checkbox-wrap transfer_type_f">
                                                
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
                            <select class="select-contain-select" name="sort" id="sort" onchange="Show_Transfers('filter')">
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
                                <div id="slider-range2" class="slider-range2" onclick="Show_Transfers('filter')"></div><!-- end slider-range -->
                            </div><!-- end main-search-input-item -->
                            <div class="btn-box pt-4">
                                <button class="theme-btn theme-btn-small theme-btn-transparent" onclick="Show_Transfers('filter')" type="button">Apply</button>
                            </div>
                        </div>
                    </div><!-- end filter by price -->
                    
					<div class="sidebar-widget">
                        <h3 class="title stroke-shape">Transfer Name</h3>
                        <div class="sidebar-category transfer_name">
                        </div>
                    </div><!-- end filter by aminity -->
                    <div class="sidebar-widget">
                        <h3 class="title stroke-shape">Transfer Type</h3>
                        <div class="sidebar-category transfer_type">
                        </div>
                    </div><!-- end filter by aminity -->
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
        <div class="row" style="display:none">
            <div class="col-lg-12">
                <div class="btn-box mt-3 text-center">
                    <button type="button" class="theme-btn" onclick="Show_Transfers('load')"><i class="la la-refresh mr-1"></i>Load More</button>
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
						<?php if($_REQUEST['transfertype']=='oneway'){ $isoneway='Yes'; } else{ $isoneway='No'; } ?>
						
						function Upldate_Rates_All(){
			   			 $.ajax({
								url:<?php url('');?>'/transfers-search-results2',
								type: "GET",
								data: {
									action: "Upldate_Rates_All",  
									page_number: page_number,
									search_session: search_session,	
									adults: '<?php  echo $_REQUEST['adults']; ?>',
									childs: '<?php  echo $_REQUEST['childs']; ?>',	
									infants: '<?php   echo $_REQUEST['infants']; ?>',
									origin_type: '<?php echo $_REQUEST['pick_type']; ?>',	
									origin_code: '<?php echo $_REQUEST['pick_type_name']; ?>',
									destination_type: '<?php echo $_REQUEST['drop_type']; ?>',	
									destination_code: '<?php echo $_REQUEST['drop_type_name']; ?>',
									departure_date: '<?php echo $_REQUEST['pick_date']; ?>',	
									retutn_date: '<?php echo $_REQUEST['return_date']; ?>',
									pickupTime: '<?php echo $_REQUEST['pick_time']; ?>',
									returnTime: '<?php echo $_REQUEST['return_time']; ?>', 
									countryCode: '<?php echo $_REQUEST['countryCode']; ?>',
									city_code: '<?php echo $_REQUEST['city_code']; ?>',
									isoneway: '<?php echo $isoneway; ?>',
									rand: Math.random()
								},
								dataType: "json",
								success: function (data) {
								console.log(data);
								loop++;
									var pageCount=0;;
									var total_records = data.total_records;	
									if(total_records>0){ 
											if( (pageCount>0) && (loop<200) ){ 
											 page_number++;
											 setTimeout(function(){Upldate_Rates_All();},100);
											}
										Show_Transfers('filter');
										 getControls();
									}else{
										if( (pageCount>0) && (loop<200) ){ 
											 page_number++;
											 setTimeout(function(){Upldate_Rates_All();},100);
										}else{
											jQuery('.not_found').show();
											jQuery('.loader').hide();
											alert("No Transfers Found.");
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

	  Show_Transfers();

	  getControls();*/

	  

	 						function Show_Transfers(type)
							{    
								jQuery('.hotellist').addClass('opacity_5');
								var sortVal= document.getElementById("sort").value;
								if(type=='filter'){  innerHtml=''; } else { page=page+1; }
								
								var transfer_name = '';
								jQuery('input[name=transfer_name]:checked').each(function(i) { 
									transfer_name[i] = jQuery(this).val();
									 var a=jQuery(this).val() ;
									   transfer_name +=a+",";
								});
								
								var category_List = '';
								jQuery('input[name=category_List]:checked').each(function(i) { 
									category_List[i] = jQuery(this).val();
									 var a=jQuery(this).val() ;
									   category_List +=a+",";
								});
								
								var transfer_type='';
								
								jQuery('input[name=transfer_type]:checked').each(function(i) { 
									transfer_type[i] = jQuery(this).val();
									 var a=jQuery(this).val() ;
									   transfer_type +=a+",";
								});
								
								var price= document.getElementById("amount2_1").value;
								jQuery('.totalhotel_to').html(page*10); 
								 $.ajax({
								url:<?php url('');?>'/Show_Transfers',
								type: "GET",
								data: {
									action: "Show_Transfers",
									search_id: search_session,
									page: page,  
									sortVal: sortVal,
									Cri_Tag: transfer_name,
									Category_Tag: category_List,
									Cri_Groups: transfer_type, 
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
									var price=parseFloat(data.result[i].LowRate);
										 innerHtml +='<div class="card-item card-item-list"><div class="card-img" style="background: url('+data.result[i].thumbnail+');background-position: center;background-repeat: no-repeat; "><span class="badge">'+data.result[i].Category+'</span>  <div class="add-to-wishlist icon-element" data-toggle="tooltip" data-placement="top" title="Bookmark"><i class="la la-heart-o"></i></div></div><div class="card-body"><h3 class="card-title"><a href="transfers-booking/'+btoa(data.result[i].id)+'" >'+data.result[i].TransferType+' '+data.result[i].Category+' '+data.result[i].Name+' ('+data.result[i].PickupInformation.date+' '+data.result[i].PickupInformation.time+')</a></h3><b><i><p class="card-meta">'+data.result[i].PickupInformation.from.description+' To '+data.result[i].PickupInformation.to.description+'</i></b></p><div class="row"><div class="col-lg-6 responsive-column"><div class="single-tour-feature d-flex align-items-center mb-3"><div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3"><i class="la la-check"></i></div><div class="single-feature-titles"><h3 class="title font-size-15 font-weight-medium">Min Pax Capacity : '+data.result[i].minPaxCapacity+'</h3></div></div></div><div class="col-lg-6 responsive-column"><div class="single-tour-feature d-flex align-items-center mb-3"><div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3"><i class="la la-check"></i></div><div class="single-feature-titles"><h3 class="title font-size-15 font-weight-medium">Max Pax Capacity : '+data.result[i].maxPaxCapacity+'</h3></div></div></div></div><div class="card-price d-flex align-items-center justify-content-between"><p><span class="price__from">From </span><span class="price__num" style="color:#287dfa"><?php echo $currency_symbol; ?> '+price.toLocaleString()+'</span><span class="price__text">Total Price</span></p><a href="javascript:void(0)" class="theme-btn text-center margin-top-20px Search_Now theme-btn-transparent mr-1" onclick="dis_show_hide(Description_'+data.result[i].id+')">View Details <i class="la la-angle-down"></i></a><a href="transfers-booking/'+btoa(data.result[i].id)+'" class="btn-text"><span class="theme-btn w-100 text-center margin-top-20px Search_Now">Book Now<i class="la la-angle-right"></i></span></a></div></div></div>';
										 								
								
							innerHtml +='<div style="display:none; margin-bottom:20px -webkit-box-shadow: 0 0 40px rgb(82 85 90 / 10%); padding: 20px;" rel="0" id="Description_'+data.result[i].id+'"><div id="amenities" class="page-scroll"><div class="single-content-item "><div class="single-content-item "><h3 class="title font-size-20">Description</h3><p class="py-3 Hotel_description" style="text-align: justify;">'+data.result[i].PickupInformation.pickup.description+'</p></div><div class="section-block"></div><h3 class="title font-size-20">Details Info</h3><div class="amenities-feature-item pt-4"><div class="row">';
							
								for(var t=0;t<data.result[i].TransferDetailInfo.length;t++){
						        innerHtml +='<div class="col-lg-12 responsive-column"><div class="single-tour-feature d-flex align-items-center mb-3"><div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3"><i class="la la-check"></i></div><div class="single-feature-titles"><h3 class="title font-size-15 font-weight-medium">'+data.result[i].TransferDetailInfo[t].description+'</h3></div></div></div>';
								}
								
								innerHtml +='</div></div><h3 class="title font-size-20">Supplier Transfer Time Info</h3><div class="amenities-feature-item pt-4"><div class="row">';
								for(var s=0;s<data.result[i].SupplierTransferTimeInfo.length;s++){
								innerHtml +='<div class="col-lg-12 responsive-column"><div class="single-tour-feature d-flex align-items-center mb-3"><div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3"><i class="la la-check"></i></div><div class="single-feature-titles"><h3 class="title font-size-15 font-weight-medium">'+(data.result[i].SupplierTransferTimeInfo[s].type).replace(/_/g, ' ')+' - '+data.result[i].SupplierTransferTimeInfo[s].value+' '+data.result[i].SupplierTransferTimeInfo[s].metric+'</h3></div></div></div>';
								}
																
								innerHtml +='</div></div></div></div></div>';
								
							}
									
									
									jQuery('.hotellist').html(innerHtml);
									
								},
								error: function (error) {
									console.log(`Error ${error}`);
								}
							   });
							}
							
							
							function dis_show_hide(des_id){
							
								var rel= jQuery(des_id).attr('rel');
								if(rel==0){
									jQuery(des_id).show();
									jQuery(des_id).attr('rel',1);
								}
								if(rel==1){
									jQuery(des_id).hide();
									jQuery(des_id).attr('rel',0);
								}
								
							}
							
							
							function getControls() {
								 $.ajax({
								url:<?php url('');?>'/GetControlsTransfers',
								type: "GET",
								data: {
									action: "GetControlsTransfers",
									search_id: search_session,
									page: page,  
									rand: Math.random()
								},
								dataType: "json",
								success: function (data) {
									var cs=data.currency_symbol;
									
									var tagLists=data.tagLists;  
									var tagListsHtml='';     var tagListsHtml_f=''; 
									for(var i=0;i<tagLists.length;i++){  
										tagListsHtml+='<div class="custom-checkbox"><input onclick="Show_Transfers(\'filter\')" name="transfer_name" value="'+tagLists[i].name+'" type="checkbox" id="b'+i+'"><label for="b'+i+'">'+tagLists[i].name+' ('+tagLists[i].count+')</label></div>';
										tagListsHtml_f+='<div class="custom-checkbox"><input onclick="Show_Transfers(\'filter\')" name="transfer_name" value="'+tagLists[i].name+'" type="checkbox" id="b'+i+'_f"><label for="b'+i+'_f">'+tagLists[i].name+' ('+tagLists[i].count+')</label></div>';
									}
								jQuery('.transfer_name').html(tagListsHtml); 
								jQuery('.transfer_name_f').html(tagListsHtml_f);
								
									var category_List=data.categoryLists;  
									var category_ListHtml='';   var category_ListHtml_f='';  
									for(var i=0;i<category_List.length;i++){  
										category_ListHtml+='<div class="custom-checkbox"><input onclick="Show_Transfers(\'filter\')" name="category_List" value="'+category_List[i].name+'" type="checkbox" id="a'+i+'"><label for="a'+i+'">'+category_List[i].name+' ('+category_List[i].count+')</label></div>';
										category_ListHtml_f+='<div class="custom-checkbox"><input onclick="Show_Transfers(\'filter\')" name="category_List" value="'+category_List[i].name+'" type="checkbox" id="a'+i+'_f"><label for="a'+i+'_f">'+category_List[i].name+' ('+category_List[i].count+')</label></div>';
									}
								jQuery('.category_List').html(category_ListHtml);
								jQuery('.category_List_f').html(category_ListHtml_f);
								
								var transfer_type=data.groupLists;  
									var transfer_typeHtml='';   var transfer_typeHtml_f='';  
									for(var i=0;i<transfer_type.length;i++){  
										transfer_typeHtml+='<div class="custom-checkbox"><input onclick="Show_Transfers(\'filter\')" name="transfer_type" value="'+transfer_type[i].name+'" type="checkbox" id="t'+i+'"><label for="t'+i+'">'+transfer_type[i].name+' ('+transfer_type[i].count+')</label></div>';
										transfer_typeHtml_f+='<div class="custom-checkbox"><input onclick="Show_Transfers(\'filter\')" name="transfer_type" value="'+transfer_type[i].name+'" type="checkbox" id="t'+i+'_f"><label for="t'+i+'_f">'+transfer_type[i].name+' ('+transfer_type[i].count+')</label></div>';
									}
								jQuery('.transfer_type').html(transfer_typeHtml);
								jQuery('.transfer_type_f').html(transfer_typeHtml_f);
								
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