<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Flight;
use App\Http\Controllers\Hotel;
use App\Http\Controllers\CustomHotel;
use App\Http\Controllers\Tours;
use App\Http\Controllers\Transfers; 
use App\Http\Controllers\LangingPageController; 
use App\Models\Crud_Model;  

use App\Http\Controllers\PdfController;
use App\Http\Controllers\EmailController;

use Illuminate\Support\Facades\DB;
// use Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('clear-cache', function () {
	echo "<br>clear==".Artisan::call('config:clear');
	echo "<br>cache==".Artisan::call('config:cache');
});


Route::get('/hotel-voucher', [PdfController::class, 'HotelBedsVoucher']);
Route::get('/hotel-voucher-email', [EmailController::class, 'HotelVouchertEmail']);

Route::get('/tours-voucher', [PdfController::class, 'ToursBedsVoucher']);
Route::get('/tours-voucher-email', [EmailController::class, 'ToursVouchertEmail']);

Route::get('/transfers-voucher', [PdfController::class, 'TransfersBedsVoucher']);
Route::get('/transfers-voucher-email', [EmailController::class, 'TransfersVouchertEmail']);


Route::get('/flight-ticket', [PdfController::class, 'FlightTicket']);
Route::get('/flight-ticket-email', [EmailController::class, 'FlightTicketEmail']); 
Route::get('flight-voucher/{order_id}', function ($order_id) {
$show_price=$_REQUEST['show_price'];
	$bookingsData = crud_model::readOne('bookings',array('order_id'=>$order_id));
	$siteData = crud_model::readOne('user',array('id'=>$bookingsData->user_id)); 
	if($siteData->user_type!='agent'){ $siteData = crud_model::readOne('user',array('id'=>1)); }
	return view('voucher/flight-voucher', array('bookingsData' => $bookingsData,'siteData' => $siteData,'show_price' => $show_price));
});

//site start
//Flight Start
Route::get('/', function () {
	// dd(Auth::user()->id);
	$reviewData = crud_model::readByCondition('customer_review',array('published'=>'Yes'));

	$hotel_data = DB::select("select *,COUNT(hotel_id) as total from twc_booking group by hotel_id order by total DESC LIMIT 10");
	$blogData =  DB::select("SELECT blogs.*, user.* FROM blogs INNER JOIN user ON blogs.user_id=user.id order by blogs.id desc");	
	$pageData = crud_model::readOne('pages',array('page_id'=>'home'));
	
	return view('site/index', array('hotel_data' => $hotel_data,'reviewData' => $reviewData,'blogData' => $blogData,'pageData' => $pageData));
}); // siteData common


Route::get('/get_flights_locations', [Flight::class, 'GetLocations']);

Route::get('/detinations', function () {
 $pageData = crud_model::readOne('pages',array('page_id'=>'home'));
 return view('site/dest_long', array('pageData' => $pageData)); 
}); 

Route::get('/flight-search', function () {
 $pageData = crud_model::readOne('pages',array('page_id'=>'flight-search'));
 return view('site/flight-search', array('pageData' => $pageData)); 
}); 

Route::get('/flight-search-results', function (){
 $pageData = crud_model::readOne('pages',array('page_id'=>'flight-search-results'));
 return view('flight/flight-search-results', array('pageData' => $pageData)); 
});

Route::get('/flightsearchresults', [Flight::class, 'SearchRequestFirst']);
Route::get('/get_flight_search_id', [Flight::class, 'SearchRequest']);
Route::get('/get_flight_list', [Flight::class, 'Show_Flights']);
Route::get('/get_flight_filter_data', [Flight::class, 'FlightController']);
Route::get('/recheck_flight', [Flight::class, 'SelectFlight']);

 
     Route::get('/token', function () {
        return csrf_token(); 
    });


Route::post('/flight-final-checkout', [Flight::class, 'FlightFinalCheckout']);

Route::get('/flight-booking/{id}', function ($id)  
{     $id=base64_decode($id);
	$flightData= crud_model::readOne('flight_results',array('id'=>$id));
	$pageData = crud_model::readOne('pages',array('page_id'=>'flight-booking'));
	$countryData=DB::select("select * from country order by name ASC ");
	return view('flight/flight-booking-form', array('flightData' => $flightData,'pageData' => $pageData,'countryData' => $countryData));
});

Route::get('/get_selected_flight_data', function ()  
{    
	$flightData= crud_model::readOne('flight_results',array('id'=>$_REQUEST['id']));
	echo json_encode($flightData);
});

Route::get('/get_country_list/', function ()  
{    
	$countryData=DB::select("select * from country order by name ASC ");
	echo json_encode($countryData);
});

Route::get('/flight-payment/{order_id}/{amount}', function ($order_id,$amount)  
{     $order_id=base64_decode($order_id); $amount=base64_decode($amount);
 	$pageData = crud_model::readOne('pages',array('page_id'=>'flight-payment'));
	return view('flight/flight-payment-form', array('order_id' => $order_id,'amount' => $amount,'pageData' => $pageData));
});

Route::get('/book-flight', [Flight::class, 'BookFlight']);

Route::get('/flight-confirmation/{order_id}', function ($order_id)  
{     $order_id=base64_decode($order_id);
	$flightData = crud_model::readOne('bookings',array('order_id'=>$order_id));
	$pageData = crud_model::readOne('pages',array('page_id'=>'flight-confirmation'));
	return view('flight/flight-confirmation', array('flightData' => $flightData,'pageData' => $pageData));
});



// Flight End



//Hotel Start

Route::get('/getLocations', [Hotel::class, 'GetLocations']);
Route::get('/GetHotelList', [Hotel::class, 'GetHotelList']);  
Route::get('/GetHotelListCustom', [Hotel::class, 'GetHotelList']); 
// Route::get('/GetHotelListCustom', [CustomHotel::class, 'GetHotelListCustom']); 
Route::get('/Show_Hotels', [Hotel::class, 'Show_Hotels']);
Route::get('/getControls', [Hotel::class, 'getControls']); 
Route::get('/RoomAvailability', [Hotel::class, 'RoomAvailability']);

Route::get('/hotel-search', function (){ 
	$pageData = crud_model::readOne('pages',array('page_id'=>'hotel-search'));
	return view('site/hotel-search',array('pageData' => $pageData)); 
});

Route::get('/hotel-search-results', function (){ 
	$pageData = crud_model::readOne('pages',array('page_id'=>'hotel-search-results'));
	return view('hotel/hotel-search-results',array('pageData' => $pageData)); 
});

Route::get('/hotel-details/{id}/{hotel_name}', function ($id,$hotel_name)  
 {     $id=base64_decode($id);
	 $hotelSearchData = crud_model::readOne('search_results_hotelbeds',array('id'=>$id));
	 $pageData = crud_model::readOne('pages',array('page_id'=>'hotel-details'));
	 if($hotelSearchData->product=='Plistbooking'){ 
	 	return view('hotel/hotel-details-plistbooking', array('hotelSearchData' => $hotelSearchData,'pageData' => $pageData,'hotelData' => '')); 
	 }
		//$hotelObj = crud_model::readOne('hotelbeds_hotels',array('hotel_id'=>$hotelSearchData->EANHotelID));
		
		$apiUrl = "https://dev.plistbooking.travel/travel/hotel-update-rates.php?action=get_single_hotels&hotel_id=".$hotelSearchData->EANHotelID;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $apiUrl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		$hotelObj=json_decode($response);
		
		$hotelData =json_decode($hotelSearchData->hotelDetails,true);
		if(count($hotelData)>0){
			$currency =$hotelData['currency'];
			$hotel_id =$hotelData['code'];
			$RoomType =$hotelData['rooms'];
			$countRoom =count($RoomType);
		
			$contentArr =json_decode($hotelObj->content,true);
			
			$feature_image ='http://photos.hotelbeds.com/giata/xxl/'.$hotelObj->img_path;
			if(isset($contentArr['images'])){
				$images =$contentArr['images'];
				$HotelImages[] =$feature_image;
				foreach($images as $g){
				 if($g['order']!='1'){  
				 $HotelImages[] ='http://photos.hotelbeds.com/giata/xxl/'.$g['path'];  
				 }	
				}
			}else{ $HotelImages[] =array('hotelImageId'=> '','name'=>'','url' =>''); }
		
			$Pointsofinterest='';
			if(isset($contentArr['interestPoints'])){
				$interestPoints=$contentArr['interestPoints']; 
				foreach($interestPoints as $v){
				 $dis_km =($v['distance']/1000);
				 $dis_mile =($dis_km*0.62);	 
				 $Pointsofinterest.=$v['poiName'].' - '.$dis_km.' km / '.($dis_mile).' mi'.'<br />';
				}
			} else { $interestPoints=array(); }
			
			$facilities=array(); 
			$roomDetailDescription=array(); 
			$amenetyData=array();
			$paymentMethods=array();
			$roomFacilities=array(); 
			$businessAmenety=array(); 
			$PointsofinterestArr=array();
			
			if(isset($contentArr['facilities'])){ 
				$facilities =$contentArr['facilities'];
				foreach($facilities as $f){
				 $groupCode =$f['facilityGroupCode'];
				 $facilityCode =$f['facilityCode'];
				 
				 if(isset($f['number'])){ $pre_content =$f['number'];}
				 else if(isset($f['indLogic']) && $f['indLogic']==true){ $pre_content ='Yes';}
				 else if(isset($f['indLogic']) && $f['indLogic']==false){ $pre_content ='No';}
				 else if(isset($f['indYesOrNo']) && $f['indYesOrNo']=true){ $pre_content ='Yes';}
				 else if(isset($f['indYesOrNo']) && $f['indYesOrNo']=false){ $pre_content ='No';}
				 else{ $pre_content ='';}
				 
				/* $fSql =mysqli_query($con,"select content from  hotelbeds_facilities WHERE facilityGroupCode='".$groupCode."' and code='".$facilityCode."'");
				 $fobj =mysqli_fetch_object($fSql);*/	
				 
				 $fobj = crud_model::readOne('hotelbeds_facilities',array('facilityGroupCode'=>$groupCode,'code'=>$facilityCode)); 
				 if(is_object($fobj)){
				 	 $content=$fobj->content;
					  if($groupCode==10){
						$roomDetailDescription[]= trim($content.': '.$pre_content); 
					  }	
					  if($groupCode==70){
						$amenetyData[]= array('id'=>$facilityCode,'amenity'=>$content); 
					  }
					  if($groupCode==30){
						$paymentMethods[]= array('id'=>$facilityCode,'title'=>$content); 
					  }else{ $paymentMethods=array(); }
					 
					  if($groupCode==60){
						$roomFacilities[]=array('id'=>$facilityCode,'title'=>trim($content.': '.$pre_content));
					  }
					  if($groupCode==72){
						$businessAmenety[]= array('id'=>$facilityCode,'businessamenity'=>$content); 
					  }
					  
					  if($groupCode==40){
						$PointsofinterestArr[]= $content; 
					  }
					}
				  
				}
			}
			
			if($Pointsofinterest==''){
			 $Pointsofinterest =@implode("<br />",$PointsofinterestArr);	
			}
		   			 if(isset($contentArr['postalCode'])){ $postalCode=$contentArr['postalCode']; }else{ $postalCode='';}
			 $HotelSummary =array('hotelId'=>$hotelData['code'],'Name'=>$hotelData['name'],'Address1'=>$hotelObj->address,'postalCode'=>$postalCode,'City'=>$hotelObj->city,'Country'=>$hotelObj->country,'hotelRating'=>trim(str_replace("STARS","",$hotelData['categoryName'])),'tripAdvisorRating'=>'','tripAdvisorReviewCount'=>$hotelObj->ranking,'latitude'=>$hotelObj->latitude,'longitude'=>$hotelObj->longitude,'recommended'=>$hotelObj->recommended,'selling_points'=>$hotelObj->selling_points);
			 
			 
			 $HotelDetails =array('numberOfRooms'=>0,'numberOfFloors'=>1,'checkInTime'=>'','checkOutTime'=>'','propertyInformation'=>'','areaInformation'=>$Pointsofinterest,'propertyDescription'=>$contentArr['description']['content'],'hotelPolicy'=>'','roomInformation'=>'','checkInInstructions'=>'','specialCheckInInstructions'=>'','Pointsofinterest'=>$Pointsofinterest,'knowBeforeYouGoDescription'=>'','roomFeesDescription'=>'','locationDescription'=>'','diningDescription'=>'','roomDetailDescription'=>@implode(", ",$roomDetailDescription),'roomFacilities'=>$roomFacilities,'paymentMethods'=>$paymentMethods);
			  
			 $data=array('hotelId'=>$hotelData['code'],
						'customerSessionId'=>'',
						'HotelSummary'=>$HotelSummary,
						'HotelDetails'=>$HotelDetails,
						'Suppliers'=>array(),
						'RoomTypes'=>array('size'=>$countRoom,
										   'RoomGroup'=>$RoomType,
										   'currency'=>$currency
										  ),
						'PropertyAmenities'=>array('size'=>count($amenetyData),
												   'PropertyAmenity'=>$amenetyData 
												   ),
						'BusinessAmenities'=>array('size'=>count($businessAmenety),
												   'BusinessAmenity'=>$businessAmenety 
												   ),						   
						'HotelImages'=>array('size'=>count($HotelImages),
											 'HotelImage'=>$HotelImages,
											 )
						);
		}
		else{
			$status =400;     
		  }
		  
		 //echo "<pre>amenetyData=="; print_r($amenetyData);
	   return view('hotel/hotel-details', array('hotelSearchData' => $hotelSearchData,'pageData' => $pageData,'hotelData' => $data));	 	 
	
});

Route::get('/hotel-booking/{board}/{rateClass}/{roomCodeIds}/{id}', function ($board,$rateClass,$roomCodeIds,$id)  
 {     $board=base64_decode($board);  $rateClass=base64_decode($rateClass);  $roomCodeIds=base64_decode($roomCodeIds); $id=base64_decode($id);
	$hotelSearchData= crud_model::readOne('search_results_hotelbeds',array('id'=>$id));	
	$pageData = crud_model::readOne('pages',array('page_id'=>'hotel-booking'));	
	$countryData=DB::select("select * from country order by name ASC ");
	return view('hotel/hotel-booking-form', array('board' => $board,'rateClass' => $rateClass,'roomCodeIds' => $roomCodeIds,'hotelSearchData' => $hotelSearchData,'pageData' => $pageData,'countryData' => $countryData)); 
});
Route::post('/hotel-final-checkout', [Hotel::class, 'HotelFinalCheckout']);

Route::get('/hotel-booking/{roomid}/{hotelid}', function ($roomid,$hotelid)  
 {     $hotelid=base64_decode($hotelid);  $roomid=base64_decode($roomid); 
	$hotelSearchData= crud_model::readOne('search_results_hotelbeds',array('id'=>$hotelid));	
	$pageData = crud_model::readOne('pages',array('page_id'=>'hotel-booking'));	
	$countryData=DB::select("select * from country order by name ASC ");
	return view('hotel/hotel-booking-form-plistbooking', array('hotelid' => $hotelid,'roomid' => $roomid,'hotelSearchData' => $hotelSearchData,'pageData' => $pageData,'countryData' => $countryData)); 
});

Route::post('/hotel-final-checkout-plistbooking', [CustomHotel::class, 'HotelFinalCheckout']);

Route::get('/book-custom-hotel', [CustomHotel::class, 'BookHotel']);
 

Route::get('/hotel-payment/{order_id}/{amount}', function ($order_id,$amount)  
 {   $order_id=base64_decode($order_id);  $amount=base64_decode($amount);  
 	$pageData = crud_model::readOne('pages',array('page_id'=>'hotel-payment'));
	return view('hotel/hotel-payment-form', array('order_id' => $order_id,'amount' => $amount,'pageData' => $pageData));
});

Route::get('/book-hotel', [Hotel::class, 'BookHotel']);

Route::get('/hotel-confirmation/{order_id}', function ($order_id)  
 {      $order_id=base64_decode($order_id); 
    $hotelData=crud_model::readOne('twc_booking',array('order_id'=>$order_id)); 
	$pageData = crud_model::readOne('pages',array('page_id'=>'hotel-confirmation'));
	return view('hotel/hotel-confirmation', array('hotelData' => $hotelData,'pageData' => $pageData));
});

Route::get('/hotel-cancellation', [Hotel::class, 'BookingCancellation']);

//Hotel End

//Tours Start
Route::get('/get-destination', [Tours::class, 'GetLocations']);

Route::get('/findsearchkey', function (){ 
	return json_encode(array('search_session' => uniqid(), 'exist' => 'No'));
});

Route::get('/tours-search', function (){ 
	$pageData = crud_model::readOne('pages',array('page_id'=>'tours-search'));
	return view('site/tours-search',array('pageData' => $pageData)); 
});

Route::get('/tours-search-results2', [Tours::class, 'SearchRequest']);
Route::get('/Show_Activity', [Tours::class, 'Show_Activity']);
Route::get('/GetControls', [Tours::class, 'GetControls']);
Route::get('/Activity_Description', [Tours::class, 'Activity_Description']);

Route::get('/tours-search-results', function (){ 
	$pageData = crud_model::readOne('pages',array('page_id'=>'tours-search-results'));
	return view('tours/tours-search-results',array('pageData' => $pageData)); 
});

Route::get('/tours-details/{id}', function ($id)  
 {     $id=base64_decode($id);
	 $tourSearchData = crud_model::readOne('search_results_hotelbeds_activity',array('id'=>$id));
	 $pageData = crud_model::readOne('pages',array('page_id'=>'tours-details'));
	return view('tours/tours-details', array('activitySearchData' => $tourSearchData,'pageData' => $pageData));
});

Route::get('/tours-booking/{board}/{rateClass}/{roomCodeIds}/{id}', function ($code,$ratekey,$date,$id)  
 {     $code=base64_decode($code); $ratekey=base64_decode($ratekey); $date=base64_decode($date); $id=base64_decode($id);
 	$tourSearchData= crud_model::readOne('search_results_hotelbeds_activity',array('id'=>$id));	
	$pageData = crud_model::readOne('pages',array('page_id'=>'tours-booking'));	
	$countryData=DB::select("select * from country order by name ASC ");
	return view('tours/tours-booking-form', array('code' => $code,'ratekey' => $ratekey,'date' => $date,'activitySearchData' => $tourSearchData,'pageData' => $pageData,'countryData' => $countryData));
});
Route::post('/tours-final-checkout', [Tours::class, 'ActivityFinalCheckout']); 

Route::get('/tours-payment/{order_id}/{amount}', function ($order_id,$amount)  
 {     $order_id=base64_decode($order_id);  $amount=base64_decode($amount);
 	$pageData = crud_model::readOne('pages',array('page_id'=>'tours-payment'));
	return view('tours/tours-payment-form', array('order_id' => $order_id,'amount' => $amount,'pageData' => $pageData));
});

Route::get('/book-tours', [Tours::class, 'BookActivity']);

Route::get('/tours-confirmation/{order_id}', function ($order_id)  
 {   $order_id=base64_decode($order_id);
    $hotelData=crud_model::readOne('twc_booking',array('order_id'=>$order_id)); 
	$pageData = crud_model::readOne('pages',array('page_id'=>'tours-confirmation'));
	return view('tours/tours-confirmation', array('hotelData' => $hotelData,'pageData' => $pageData));
});

Route::get('/tours-cancellation', [Tours::class, 'BookingCancellation']);

//Tours End


//Transfers Start
Route::get('/get-destination-Transfers', [Transfers::class, 'GetLocations']);

Route::get('/getTerminal', function (){
$cityCode = $_REQUEST['cityCode'];
$country_code = $_REQUEST['country_code'];
$terminal_type = $_REQUEST['terminal_type']; 
$finalData=array();
if($terminal_type=='H'){
		$memberData=DB::select("select * from hotelbeds_transfer_hotels where destinationCode = '".$cityCode."' and countryCode = '".$country_code."' ");
	foreach($memberData as $data){
		$finalData[]=array('code'=>$data->code,'name'=>$data->name);
	}
}else{
	$memberData=DB::select("select atlas_code,terminal_type,terminal_name,country_code from hotelbeds_transfer_terminals where atlas_code = '".$cityCode."' and country_code = '".$country_code."' and terminal_type='".$terminal_type."'");
	foreach($memberData as $data){
		$finalData[]=array('code'=>$data->atlas_code,'name'=>$data->terminal_name);
	}
}
	return json_encode($finalData); 
});


Route::get('/transfers-search', function (){ 
	$pageData = crud_model::readOne('pages',array('page_id'=>'transfers-search'));
	return view('site/transfers-search',array('pageData' => $pageData)); 
});

Route::get('/transfers-search-results2', [Transfers::class, 'SearchRequest']);
Route::get('/Show_Transfers', [Transfers::class, 'Show_Transfers']);
Route::get('/GetControlsTransfers', [Transfers::class, 'GetControls']);
Route::get('/transfers_Description', [Transfers::class, 'Transfers_Description']);

Route::get('/transfers-search-results', function (){ 
	$pageData = crud_model::readOne('pages',array('page_id'=>'transfers-search-results'));
	return view('transfers/transfers-search-results',array('pageData' => $pageData)); 
});

Route::get('/transfers-details/{id}', function ($id)  
 {     $id=base64_decode($id);
	 $TransfersSearchData = crud_model::readOne('search_results_hbd_transfer',array('id'=>$id));
	 $pageData = crud_model::readOne('pages',array('page_id'=>'transfers-details'));
	return view('transfers/transfers-details', array('TransfersSearchData' => $TransfersSearchData,'pageData' => $pageData));
});

Route::get('/transfers-booking/{id}', function ($id)  
 {      $id=base64_decode($id);
 	$TransfersSearchData= crud_model::readOne('search_results_hbd_transfer',array('id'=>$id));	
	$pageData = crud_model::readOne('pages',array('page_id'=>'transfers-booking'));	
	$countryData=DB::select("select * from country order by name ASC ");
	return view('transfers/transfers-booking-form', array('transfersSearchData' => $TransfersSearchData,'countryData' => $countryData,'pageData' => $pageData));
});
Route::post('/transfers-final-checkout', [Transfers::class, 'TransfersFinalCheckout']); 

Route::get('/transfers-payment/{order_id}/{amount}', function ($order_id,$amount)  
 {     $order_id=base64_decode($order_id);  $amount=base64_decode($amount);
 	$pageData = crud_model::readOne('pages',array('page_id'=>'transfers-payment'));
	return view('transfers/transfers-payment-form', array('order_id' => $order_id,'amount' => $amount,'pageData' => $pageData));
});

Route::get('/book-transfers', [Transfers::class, 'BookTransfers']);

Route::get('/transfers-confirmation/{order_id}', function ($order_id)  
 {   $order_id=base64_decode($order_id);
    $hotelData=crud_model::readOne('twc_booking',array('order_id'=>$order_id)); 
	$pageData = crud_model::readOne('pages',array('page_id'=>'transfers-confirmation'));
	return view('transfers/transfers-confirmation', array('hotelData' => $hotelData,'pageData' => $pageData));
});

Route::get('/transfers-cancellation', [Transfers::class, 'BookingCancellation']);

//Transfers End


Route::post('/change-currency', [Site::class, 'ChangeCurrency']); 
Route::get('/about', function ()  
 {  
	$reviewData = crud_model::readByCondition('customer_review',array('published'=>'Yes'));  
	$memberData=DB::select("SELECT * FROM user WHERE status='active' and is_member='Yes' order by id desc ");
	$pageData = crud_model::readOne('pages',array('page_id'=>'about'));
	return view('site/about', array('reviewData' => $reviewData,'pageData' => $pageData,'memberData' => $memberData));
});

Route::get('/contact', function (){
 $pageData = crud_model::readOne('pages',array('page_id'=>'contact'));
 return view('site/contact',array('pageData' => $pageData)); 
 });

Route::post('/enquiry', [Site::class, 'Enquiry'])->name("enq");

Route::get('/services', function () { 
	$sarviceMainData = crud_model::readByCondition('services',array('status'=>'active','type'=>'main'));
	$sarviceAddonData = crud_model::readByCondition('services',array('status'=>'active','type'=>'addon'));
	$pageData = crud_model::readOne('pages',array('page_id'=>'services'));
	return view('site/services', array('sarviceMainData' => $sarviceMainData,'sarviceAddonData' => $sarviceAddonData,'pageData' => $pageData)); 
});

Route::get('/jobs', function (){   
	$jobData = crud_model::readByCondition('jobs',array('status'=>'active'));
	$pageData = crud_model::readOne('pages',array('page_id'=>'jobs'));
	return view('site/jobs', array('jobData' => $jobData,'pageData' => $pageData));
});

Route::get('/job-details/{id}', function ($id)  
 {  
	$jobSingel = crud_model::readOne('jobs',array('id'=>$id));
	$pageData = crud_model::readOne('pages',array('page_id'=>'job-details'));
	return view('site/job-details', array('jobSingel' => $jobSingel,'pageData' => $pageData));
});

Route::get('/help-desk', function ()  
 {     
 	$pageData = crud_model::readOne('pages',array('page_id'=>'help-desk'));
	$faqData=DB::select("SELECT * FROM faqs WHERE status='active' order by id desc LIMIT 5");
	return view('site/help-desk', array('pageData' => $pageData,'faqData' => $faqData));
});

Route::get('/blogs', function ()  
 {  
	$blogData =  DB::select("SELECT blogs.id as blog_id,blogs.*, user.* FROM blogs INNER JOIN user ON blogs.user_id=user.id order by blogs.id desc");
	$pageData = crud_model::readOne('pages',array('page_id'=>'blogs'));
	return view('site/blogs', array('blogData' => $blogData,'pageData' => $pageData));
});

Route::get('/blogs/{id}', function ($id)  
 {   
	$blogData=DB::select("SELECT blogs.id as blog_id,blogs.*, user.* FROM blogs INNER JOIN user ON blogs.user_id=user.id where user_id=".$id."  order by blogs.id desc");
	$pageData = crud_model::readOne('pages',array('page_id'=>'blogs'));
	return view('site/blogs', array('blogData' => $blogData,'pageData' => $pageData));
});

Route::get('/blog-details/{id}', function ($id)  
 {     
	$blogSingel = DB::table('blogs')->join('user', 'blogs.user_id', '=', 'user.id')->select('blogs.id as blog_id','blogs.date_time as blog_date','blogs.*', 'user.*')->where(array('blogs.id'=>$id))->first();	
	$pageData = crud_model::readOne('pages',array('page_id'=>'blog-details'));
	return view('site/blog-details', array('blogSingel' => $blogSingel,'pageData' => $pageData));
});

Route::get('/support', function ()  
 {   
 	$pageData = crud_model::readOne('pages',array('page_id'=>'support'));
	$faqData=DB::select("SELECT * FROM faqs WHERE status='active' order by id desc LIMIT 5");
	return view('site/support', array('pageData' => $pageData,'faqData' => $faqData));
});

Route::get('/terms-and-condition', function ()  
 {     
 	$pageData = crud_model::readOne('pages',array('page_id'=>'terms-and-condition'));
	
	return view('site/terms-and-condition', array('pageData' => $pageData));
});

Route::get('/privacy-policy', function ()  
 {   
 	$pageData = crud_model::readOne('pages',array('page_id'=>'privacy-policy'));
	return view('site/privacy-policy', array('pageData' => $pageData));
});

Route::get('/review', function ()  
 {     
	$reviewData = crud_model::readByCondition('customer_review',array('published'=>'Yes'));
	$pageData = crud_model::readOne('pages',array('page_id'=>'review'));
	return view('site/review', array('reviewData' => $reviewData,'pageData' => $pageData));
});



Route::get('/admin-dashboard', function ()  
 {     
 	if(@Auth::user()->user_type!="admin"){
 		// dd(Auth::user()->user_type);
 		return redirect()->route('customer.dashboard');
 	}
	//$flightCount = DB::table('bookings')->first()->count();
	$flightCount = crud_model::read('bookings')->count(); 
	$hotelCount = crud_model::readByCondition('twc_booking',array('product'=>'hotel'))->count(); 
	$activityCount = crud_model::readByCondition('twc_booking',array('product'=>'activity'))->count();
	$transferCount = crud_model::readByCondition('twc_booking',array('product'=>'transfer'))->count();
	
	$device = DB::select("select device,COUNT(device) as total from visitor group by device order by total DESC ");
	$os = DB::select("select os,COUNT(os) as total from visitor group by os order by total DESC ");
	$browser = DB::select("select browser,COUNT(browser) as total from visitor group by browser order by total DESC ");
	$country = DB::select("select country,COUNT(country) as total from visitor group by country order by total DESC ");
	$ip = DB::select("select ip,COUNT(ip) as total from visitor group by ip order by total DESC ");
		
	return view('admin/index', array('flightCount' => $flightCount,'hotelCount' => $hotelCount,'activityCount' => $activityCount,'transferCount' => $transferCount,'device' => $device,'os' => $os,'browser' => $browser,'country' => $country,'ip' => $ip));  
}); 

Route::get('/agent-dashboard', function ()  
 {     
	$flightCount = crud_model::readByCondition('bookings',array('user_id'=>session()->get('user_id')))->count();  
	$hotelCount = crud_model::readByCondition('twc_booking',array('product'=>'hotel','user_id'=>session()->get('user_id')))->count(); 
	$transferCount = crud_model::readByCondition('twc_booking',array('product'=>'transfer','user_id'=>session()->get('user_id')))->count(); 
	$activityCount = crud_model::readByCondition('twc_booking',array('product'=>'activity','user_id'=>session()->get('user_id')))->count(); 
	
	$device = DB::select("select device,COUNT(device) as total from visitor group by device order by total DESC ");
	$os = DB::select("select os,COUNT(os) as total from visitor group by os order by total DESC ");
	$browser = DB::select("select browser,COUNT(browser) as total from visitor group by browser order by total DESC ");
	$country = DB::select("select country,COUNT(country) as total from visitor group by country order by total DESC ");
	$ip = DB::select("select ip,COUNT(ip) as total from visitor group by ip order by total DESC ");
		
	return view('admin/index', array('flightCount' => $flightCount,'hotelCount' => $hotelCount,'activityCount' => $activityCount,'transferCount' => $transferCount,'device' => $device,'os' => $os,'browser' => $browser,'country' => $country,'ip' => $ip));  
}); 

Route::get('/customer-dashboard', function ()  
 {     
 	// dd(Auth::check(),Session::get('user_id'), Auth::user()->id );
	$flightCount = crud_model::readByCondition('bookings',array('user_id'=>session()->get('user_id')))->count();  
	$hotelCount = crud_model::readByCondition('twc_booking',array('product'=>'hotel','user_id'=>session()->get('user_id')))->count(); 
	$transferCount = crud_model::readByCondition('twc_booking',array('product'=>'transfer','user_id'=>session()->get('user_id')))->count(); 
	$activityCount = crud_model::readByCondition('twc_booking',array('product'=>'activity','user_id'=>session()->get('user_id')))->count(); 
	
	$device = DB::select("select device,COUNT(device) as total from visitor group by device order by total DESC ");
	$os = DB::select("select os,COUNT(os) as total from visitor group by os order by total DESC ");
	$browser = DB::select("select browser,COUNT(browser) as total from visitor group by browser order by total DESC ");
	$country = DB::select("select country,COUNT(country) as total from visitor group by country order by total DESC ");
	$ip = DB::select("select ip,COUNT(ip) as total from visitor group by ip order by total DESC ");
		
	return view('admin/index', array('flightCount' => $flightCount,'hotelCount' => $hotelCount,'activityCount' => $activityCount,'transferCount' => $transferCount,'device' => $device,'os' => $os,'browser' => $browser,'country' => $country,'ip' => $ip));  
})->name('customer.dashboard');  
//site end

//Email Verify
Route::get('/email_verify', function ()  
{   $email=$_REQUEST['email']; $user_type=$_REQUEST['user_type'];
	$userData = crud_model::readByCondition('user',array('email'=>$email,'website'=>str_replace('www.','',$_SERVER['SERVER_NAME'])));
	
	if(count($userData)>0){ echo json_encode(array('exist'=>'Yes')); }else { echo json_encode(array('exist'=>'No')); }
	//return view('flight/flight-confirmation', array('flightData' => $flightData,'pageData' => $pageData));
});


//login signup start
Route::get('/login', function ()  
 {   
 	$pageData = crud_model::readOne('pages',array('page_id'=>'login'));
	return view('site/login',array('pageData' => $pageData)); 
});  

//Admin login signup start
Route::get('/admin-login', function ()  
 {   
 	$pageData = crud_model::readOne('pages',array('page_id'=>'login'));
	return view('site/admin_login',array('pageData' => $pageData)); 
}); 

Route::get('/agent-signup', function ()  
 {     
 	$pageData = crud_model::readOne('pages',array('page_id'=>'agent-signup'));
	return view('site/signup', array('user_type' => 'agent','pageData' => $pageData));
});


Route::get('/customer-signup', function ()  
 {     
 	$pageData = crud_model::readOne('pages',array('page_id'=>'customer-signup'));
	return view('site/signup', array('user_type' => 'customer','pageData' => $pageData)); 
});

Route::get('/forgot-password', function ()  
 {     
 	$pageData = crud_model::readOne('pages',array('page_id'=>'forgot-password'));
	return view('site/forgot-password', array('user_type' => 'customer','pageData' => $pageData)); 
});

Route::post('/signup', [Site::class, 'Signup'])->name('signup');
Route::post('/post-login', [Site::class, 'Login']);
Route::post('/admin-post-login', [Site::class, 'adminLogin']);
Route::post('/post-login-new', [Site::class, 'Login_new']);
Route::get('/test', [Site::class, 'test'])->name('test');
Route::get('/logout', [Site::class, 'Logout']);

Route::get('/send_otp', [EmailController::class, 'SendOtp']);
Route::get('/reset_password', [Site::class, 'reset_password']);


Route::get('/activate-account/{id}', function ($id)  
 {     
 	$id=base64_decode($id);
	$userData = crud_model::readOne('user',array('id'=>$id));
	$value = Crud_Model::updateData('user',array('status'=>'active'),array('id'=>$id));
	$obj = new EmailController(); $obj->AccountActivatedMail($id);
	return redirect('login');
});

//login signup end


//admin start
// Flight Work Start
Route::get('/flight-list', function ()  
 {     
 	$user_type = session()->get('user_type');
	if($user_type=='admin'){
 	 $flightData['data'] = crud_model::read('bookings');
	}
	else{
	$flightData['data'] = crud_model::readByCondition('bookings',array('user_id'=>session()->get('user_id')));
	}
	return view('admin/flight-list', ['flightData' => $flightData]); 
	
});

Route::get('/flight-details/{id}', function ($id)  
 {     
	// $flightData = crud_model::readOne('bookings',array('id'=>$id));
	//return view('admin/flight-details', ['flightData' => $flightData]);
	
		// $flightData = crud_model::readOne('manage_flight_commission',array('id'=>$id));
	 
	    $bookingsData = crud_model::readOne('bookings',array('id'=>$id));
		$pageData = crud_model::readOne('pages',array('page_id'=>'flight-ticket'));
		if(session()->get('user_type')=='agent' ){
	   		$siteData = crud_model::readOne('user',array('id'=>$bookingsData->user_id));
		}else{
			$siteData = crud_model::readOne('user',array('website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),'user_type'=>'admin'));
		}
    	$data = [
			'bookingsData' => $bookingsData,
			'siteData' => $siteData,
			'pageData' => $pageData,
			'show_price' => 'No',
    	];
    	//$view = \View::make('voucher/flight-voucher', $data);
	 
	 
	return view('voucher/flight-voucher', $data);
	
});
Route::post('/update-flight-data', [Admin::class, 'UpdateFlightData']);
// Flight Work End

// Hotel Tour and Transfer Booking Work Start
Route::get('/booking-list/{product}', function ($product)  
 {   
   	$user_type = session()->get('user_type');
	if($user_type=='admin'){
 	 	$BookingData['data'] = crud_model::readByCondition('twc_booking',array('product'=>$product));
	}
	else{
		$BookingData['data'] = crud_model::readByCondition('twc_booking',array('user_id'=>session()->get('user_id'),'product'=>$product));
	}
	return view('admin/booking-list', ['BookingData' => $BookingData,'product' => $product]); 
});

Route::get('/booking-details/{product}/{id}', function ($product,$id)  
 {     
	 $bookingData = crud_model::readOne('twc_booking',array('order_id'=>$id));
	return view('admin/booking-details', ['bookingData' => $bookingData,'product' => $product]);
});

Route::post('/update-hotel-data', [Admin::class, 'UpdateHotelData']);
// Hotel Tour and Transfer Booking  Work End


// Landing Page Work Start

Route::get('/city-list/', function ()  
{      
 	$cityData = crud_model::read('airports'); 
	return view('admin/city-list', array('cityData' => $cityData,'type_name' =>'city'));
});

Route::get('/country-list/', function ()  
{      
	$countryData = DB::select("select * from airports group by country_code order by id DESC ");
	return view('admin/city-list', array('cityData' => $countryData,'type_name' =>'country'));
});

//Route::get('/add-landing-page', [LangingPageController::class, 'Index']);
Route::get('/add-page/{type_name}/{id}', function ($type_name,$id)  
{      
 	$citySingel = crud_model::readOne('airports',array('id'=>$id));
	if($type_name=='city'){ $name=$citySingel->city_name; $page_id=$citySingel->cityUrl; }else{ $name=$citySingel->country_name; $page_id=$citySingel->countryUrl; }
	$pageSingel = crud_model::readOne('pages',array('page_id'=>$page_id));
	if(!is_object($pageSingel)){
		$data = array(
		    'page_id' => $page_id,
			'name' =>$name,  
			'image' => $citySingel->image,
			'title' => $name,
			'meta_keywords' =>$name,
			'type' =>'landing',
			'type_name' =>$type_name, 
			'status' =>'active',
			'meta_description' =>$name,
			'date_time' => date('Y-m-d H:i:s'),
		);
		$status = Crud_Model::insertData('pages',$data);
		$lastid=DB::getPdo()->lastInsertId();
		Crud_Model::updateData('airports',array($type_name.'Landing'=>'Yes'),array($type_name.'Url'=>$page_id));
	}else{ $lastid=$pageSingel->id; }	
	$pageSingel = crud_model::readOne('pages',array('id'=>$lastid));
	return view('admin/add-page', array('pageSingel' => $pageSingel));	
});

Route::get('/landing-page-list/{product}', function ($product)  
 {      
 	$pageData = crud_model::readByCondition('pages',array('type'=>'landing','type_name'=>$product)); 
	return view('admin/landing-page-list', array('pageData' => $pageData,'product' => $product));
});

Route::get('/add-landing-page/{product}', function ($product)  
 { 
	return view('admin/add-landing-page'); 
});

Route::get('/add-landing-page/{product}/{id}', function ($product,$id)  
 { 
 	$pageSingel = crud_model::readOne('pages',array('id'=>$id));
	return view('admin/add-landing-page',['pageSingel' => $pageSingel]); 
});

Route::post('/landing-page-post', [Admin::class, 'LandingPagePost']);

Route::get('/booking-details/{product}/{id}', function ($product,$id)  
 {     
	 $bookingData = crud_model::readOne('twc_booking',array('order_id'=>$id));
	return view('admin/booking-details', ['bookingData' => $bookingData,'product' => $product]);
});
// Landing Page Work End



// Currency Work Start
Route::get('/currency-list', function ()  
 {    
 	$currencyData['data'] = crud_model::read('currency_rates'); 
	return view('admin/currency-list', ['currencyData' => $currencyData]); 
});
Route::get('/currency-details/{id}', function ($id)  
 {     
	 $currencyData = crud_model::readOne('currency_rates',array('id'=>$id));
	return view('admin/currency-details', ['currencyData' => $currencyData]);
});
Route::post('/update-currency-data', [Admin::class, 'UpdateCurrencyData']);
// Currency Work End

// User Work Start
Route::get('/my-profile', function ()  
 {    
 	$currencyData['data'] = crud_model::read('currency_rates'); 
	return view('admin/currency-list', ['currencyData' => $currencyData]); 
});

Route::get('/agents', function ()  
 {     
 	$userData= crud_model::readByCondition('user',array('user_type'=>'agent')); 
	return view('admin/users', ['user_type' => 'agent','userData' => $userData]); 
});

Route::get('/customers', function ()  
 {    
	$userData= crud_model::readByCondition('user',array('user_type'=>'customer')); 
	return view('admin/users', ['user_type' => 'customer','userData' => $userData]); 
});

Route::get('/members', function ()  
 {    
	$userData['data']= crud_model::readByCondition('user',array('user_type'=>'member')); 
	return view('admin/users', ['user_type' => 'customer','userData' => $userData]); 
});

Route::get('/user-details', function ()  
 {     
	 $userData = crud_model::readOne('user',array('id'=>session()->get('user_id')));
	 $currency = crud_model::readByCondition('currency_rates',array('published'=>'Yes'));
	return view('admin/user-details', ['userData' => $userData,'currency' => $currency]);
});
Route::get('/user-details/{id}', function ($id)  
 {     
	 $userData = crud_model::readOne('user',array('id'=>$id));
	$currency = crud_model::readByCondition('currency_rates',array('published'=>'Yes'));
	return view('admin/user-details', ['userData' => $userData,'currency' => $currency]);
});

Route::post('/update-user-data', [Admin::class, 'UpdateUserData']);
// User Work End

// Website Setting Work Start
Route::get('/website-settings', function ()  
 {       
	$currency = crud_model::readByCondition('currency_rates',array('published'=>'Yes'));
	$siteData = crud_model::readOne('website_setting',array('id'=>1));
	return view('admin/website-settings', array('siteData' => $siteData,'currency' => $currency));
});   
Route::post('/website-settings-post', [Admin::class, 'WebsiteSettings']);
// Website Setting Work End

Route::get('/enquiry-list', function ()  
 {    
 	$enquiryData = crud_model::read('enquiry'); 
	return view('admin/enquiry-list', ['enquiryData' => $enquiryData]); 
});



Route::get('/check-url', [Flight::class, 'Check']);

//admin end



//admin widget start
Route::get('/customer-review', function ()  
 {      
 	$reviewData = crud_model::read('customer_review');
	return view('admin/customer-review', array('reviewData' => $reviewData));
});

Route::get('/customer-review/{id}', function ($id)  
 {      
 	$reviewData = crud_model::read('customer_review');
	$reviewSingel = crud_model::readOne('customer_review',array('id'=>$id));
	return view('admin/customer-review', array('reviewData' => $reviewData,'reviewSingel' => $reviewSingel));
});

Route::post('/customer-review-post', [Admin::class, 'ReviewPost']);


Route::get('/blog-category', function ()  
 {      
 	$bcData = crud_model::read('blog_category');
	return view('admin/blog-category', array('bcData' => $bcData));
});

Route::get('/blog-category/{id}', function ($id)  
 {      
 	$bcData = crud_model::read('blog_category');
	$bcSingel = crud_model::readOne('blog_category',array('id'=>$id));
	return view('admin/blog-category', array('bcData' => $bcData,'bcSingel' => $bcSingel));
});

Route::post('/blog-category-post', [Admin::class, 'BlogCategoryPost']);

Route::get('/add-blog', function ()  
 {      
 	$bcData =  crud_model::readByCondition('blog_category',array('status'=>'active'));
	return view('admin/add-blog', array('bcData' => $bcData));
});

Route::get('/add-blog/{id}', function ($id)  
 {      
 	$bcData =  crud_model::readByCondition('blog_category',array('status'=>'active'));
	$blogSingel = crud_model::readOne('blogs',array('id'=>$id));
	return view('admin/add-blog', array('bcData' => $bcData,'blogSingel' => $blogSingel));
});

Route::get('/blog-list/', function ()  
 {   
 	if(session()->get('user_id')=='admin'){   
 		$blogData = crud_model::read('blogs');
	}else{
		$blogData =  crud_model::readByCondition('blogs',array('user_id'=>session()->get('user_id')));
	}
	return view('admin/blog-list', array('blogData' => $blogData));
});

Route::post('/add-blog-post', [Admin::class, 'BlogPost']);

Route::get('/add-job', function ()  
 {      
	return view('admin/add-job');
});

Route::get('/add-job/{id}', function ($id)  
 {      
	$jobSingel = crud_model::readOne('jobs',array('id'=>$id));
	return view('admin/add-job', array('jobSingel' => $jobSingel));
});

Route::get('/job-list/', function ()  
 {      
 	$jobData = crud_model::read('jobs');
	return view('admin/job-list', array('jobData' => $jobData));
});

Route::post('/add-job-post', [Admin::class, 'JobPost']);

Route::get('/add-page', function ()  
 {      
	return view('admin/add-page');
});

Route::get('/add-page/{id}', function ($id)  
 {      
	$pageSingel = crud_model::readOne('pages',array('id'=>$id));
	return view('admin/add-page', array('pageSingel' => $pageSingel));
});

Route::get('/page-list/', function ()  
 {      
 	$pageData = crud_model::read('pages');
	return view('admin/page-list', array('pageData' => $pageData));
});


////////////////
Route::get('/page-list/{city_to_code}', function ($city_to_code)  
 {        
 	$pageData = crud_model::readByCondition('pages',array('city_to_code'=>$city_to_code));
	return view('admin/page-list', array('pageData' => $pageData));
});
////////////////

Route::post('/add-page-post', [Admin::class, 'PagePost']);


Route::get('/add-service', function ()  
 {      
	return view('admin/add-service');
});

Route::get('/add-service/{id}', function ($id)  
 {      
	$serviceSingel = crud_model::readOne('services',array('id'=>$id));
	return view('admin/add-service', array('serviceSingel' => $serviceSingel));
});

Route::get('/service-list/', function ()  
 {      
 	$serviceData = crud_model::read('services');
	return view('admin/service-list', array('serviceData' => $serviceData));
});

Route::post('/add-service-post', [Admin::class, 'ServicePost']);


Route::get('/add-faq', function ()  
 {      
	return view('admin/add-faq');
 });

Route::get('/add-faq/{id}', function ($id)  
 {      
	$faqSingel = crud_model::readOne('faqs',array('id'=>$id));
	return view('admin/add-faq', array('faqSingel' => $faqSingel));
});

Route::get('/faq-list/', function ()  
 {      
 	$faqData = crud_model::read('faqs');
	return view('admin/faq-list', array('faqData' => $faqData));
});

Route::post('/add-faq-post', [Admin::class, 'FAQPost']);

//admin widget end



// manual-wallet-fund-deduct Work Start
Route::get('/wallet-transation-history/{agent_id}', function ($agent_id)  
 {   
	 $walletData = crud_model::readByCondition('wallet_transactions_history',array('agent_id'=>$agent_id));
	 return view('admin/wallet-history', array('walletData' => $walletData));
});
Route::get('/manual-wallet-fund-deduct/{agent_id}', function ($agent_id)  
 {     
	return view('admin/manual-wallet-fund-deduct', ['agent_id' => $agent_id]);
});
Route::post('/manual-wallet-fund-deduct-post', [Admin::class, 'ManualWalletFundDeductPost']);
// manual-wallet-fund-deduct Work End


// -------- Wallet start --------------
Route::get('/wallet-fund-by-pg', function ()  
 {     
	$userData = crud_model::readOne('user',array('id'=>session()->get('user_id')));
	$bankData = DB::select("select * from bank_details WHERE status= 'active' and ac_type = 'PG' ");
	return view('admin/wallet-fund-by-pg', ['userData' => $userData,'bankData' => $bankData]);
});

// manual-wallet-fund-deduct Work Start
Route::get('/wallet-transation-history/{agent_id}', function ($agent_id)  
 {   
	 $walletData = crud_model::readByCondition('wallet_transactions_history',array('agent_id'=>$agent_id));
	 return view('admin/wallet-history', array('walletData' => $walletData));
});
Route::get('/manual-wallet-fund-deduct/{agent_id}', function ($agent_id)  
 {     
	return view('admin/manual-wallet-fund-deduct', ['agent_id' => $agent_id]);
});
Route::post('/manual-wallet-fund-deduct-post', [Admin::class, 'ManualWalletFundDeductPost']);
// manual-wallet-fund-deduct Work End


//bank Details Start
Route::get('/add-bank-details', function ()  
 {      
	return view('admin/add-bank-details');
});
Route::get('/add-bank-details/{id}', function ($id)  
 {      
	$bankSingel = crud_model::readOne('bank_details',array('id'=>$id));
	return view('admin/add-bank-details', array('bankSingel' => $bankSingel));
});

Route::post('/add-bank-details-post', [Admin::class, 'AddBankDetailsPost']);
Route::get('/bank-details-list', function ()  
 {    
    $user_type = session()->get('user_type');
 	if($user_type=='super_admin'){
 	 $where="";
	}else {
 	 	$where=" WHERE website='".str_replace('www.','',$_SERVER['SERVER_NAME'])."' ";
	}
	
	$bankData=DB::select("SELECT * from bank_details $where order by id desc");
	 
	return view('admin/bank-details-list', ['bankData' => $bankData]); 
});
//bank Details End

// -------- Wallet Work start --------------
Route::get('/wallet-fund-request', function ()  
 {     
	 $userData = crud_model::readOne('user',array('id'=>session()->get('user_id')));
	 //$bankData = crud_model::readByCondition('bank_details',array('status'=>'active'));
	 $bankData = DB::select("select * from bank_details WHERE status= 'active' and ac_type!= 'PG' ");
	return view('admin/wallet-fund-request', ['userData' => $userData,'bankData' => $bankData]);
});

Route::get('/wallet-fund-request-list/', function ()  
 {   
 	$user_type = session()->get('user_type');
 	if($user_type=='super_admin'){
 	 $where="WHERE  wallet_fund_request.type='Request'";
	}else if($user_type=='admin'){
 	 	$where=" WHERE wallet_fund_request.website='".str_replace('www.','',$_SERVER['SERVER_NAME'])."' and  wallet_fund_request.type='Request' ";
	}
	else{
		$user_id=session()->get('user_id');
		$where=" where wallet_fund_request.agent_id='".$user_id."' and  wallet_fund_request.type='Request'  ";
	}
	$walletData=DB::select("SELECT wallet_fund_request.id as w_id,wallet_fund_request.status as w_status,wallet_fund_request.*, user.*,bank_details.* FROM wallet_fund_request INNER JOIN user ON wallet_fund_request.agent_id=user.id INNER JOIN bank_details ON wallet_fund_request.bank_name=bank_details.id $where order by wallet_fund_request.id desc");
	return view('admin/wallet-fund-request-list', array('walletData' => $walletData));
});


Route::get('/wallet-fund-edit/{id}', function ($id)  
 {   
	 $walletData = crud_model::readOne('wallet_fund_request',array('id'=>$id));
	 return view('admin/wallet-fund-edit', array('walletData' => $walletData));
});
Route::get('/wallet-fund/{id}', function ($id)  
 {   
	 $walletData = crud_model::readOne('wallet_fund_request',array('id'=>$id));
	 return view('admin/wallet-fund-edit', array('walletData' => $walletData));
});

Route::get('/wallet-transation-history', function ()  
 {   
	 $walletData = crud_model::readByCondition('wallet_transactions_history',array('agent_id'=>session()->get('user_id')));
	 return view('admin/wallet-history', array('walletData' => $walletData));
});


Route::get('/wallet-fund', [Admin::class, 'WalletFund']);
Route::get('/wallet-reject', function ()  
 { 
 	$id = $_REQUEST['id'];  $status_msg = $_REQUEST['status_msg'];
	$status = Crud_Model::updateData('wallet_fund_request',array('status'=>'reject','status_msg'=>$status_msg,'fund_date'=>date('Y-m-d H:i:s')),array('id'=>$id));
	$obj = new EmailController(); $obj->WalletRejectdMail($id);
	echo json_encode(array('error'=>'no','message'=>'Rejected'));
});

Route::post('/wallet-fund-request-post', [Admin::class, 'WalletFundRequestPost']);
// ----- Wallet Work ends ----

Route::post('/wallet-fund-by-pg-post', [Admin::class, 'WalletFundByPGPost']);


// -------- Wallet end --------------



Route::post('/userInserFromAmplepoint', [Site::class, 'userInserFromAmplepoint']);
Route::get('/cronJobForUpdateAmplePoint', [Site::class, 'cronJobForUpdateAmplePoint']);
Route::get('/processcheckoutpayment/{order_id}/{user_id}', [Hotel::class, 'processcheckoutpayment'])->name('processcheckoutpayment');
Route::post('/createstrippayment',[Hotel::class, 'createstrippayment'])->name('createstrippayment');
Route::any('/stripeorderstatus/{order_id}/{customer_id}',[Hotel::class, 'stripeorderstatus'])->name('stripeorderstatus');

