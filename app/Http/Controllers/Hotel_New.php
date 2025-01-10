<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud_Model;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Markup;
use App\Models\User;
use Stripe\StripeClient;
use App\Models\AllHotelModel;
use App\Jobs\ProcessHotels;



class Hotel_New extends Controller
{    
		public $RateClassArr = array('NOR' => 'REFUNDABLE', 'NRF' => 'NON-REFUNDABLE', 'SPE' => 'SPECIAL', 'OFE' => 'OFFERES', 'PAQ' => 'PAQ');	
		public $errorResponse =array('200'=>'OK',
						  '301'=>'Moved Permanently',
						  '400'=>'Invalid Request',
						  'ERH01'=>'Invalid Request:checkin date should be greater than current date',
						  'ERH02'=>'Invalid Request:checkin checkout is not valid',
						  'ERH03'=>'Invalid Request:room is not valid',
						  '404'=>'Not Found',
						  '414'=>'URI Too Long',
						  '429'=>'Too many Requests',
						  '500'=>'Internal Server Error',
						  '600'=>'Booking Has Been Confirmed',
						  '601'=>'No Results Found',
						  '602'=>'Invalid Request',
						  '603'=>'Session TraceId is expired',
						  '605'=>'Booking Has Been cancelled');
	   	public $currency='';  public $currency_symbol=''; public $signature=''; public $headerData='';
		public $hotelbeds_key='';
		public $hotelbeds_secret=''; 
		public $endpoint='https://api.test.hotelbeds.com/hotel-api/1.0';  //'https://api.test.hotelbeds.com/hotel-api/1.0';
		//'https://api.test.hotelbeds.com/hotel-api/1.0';
		//'https://api.hotelbeds.com/hotel-api/1.0';
		
		public function __construct(){
			$this->emailObj= new EmailController();
			$this->markupObj = new Markup();
		    $data= crud_model::readOne('users',array('user_id'=>1)); //
		    // dd($data);
		    // $this->crud_model->readOne('website_setting',1);
		   	$common_data= $data->common_data;
			$common_dataArr= json_decode($common_data,true);
			$this->currency=$data->currency;
			$this->currency_symbol=$data->currency_symbol;
			$this->hotelbeds_key=  '273483fe031816b44f248428a028d28c'; 

			//'216ed78bd01d216eb6d4261178bc2eb8'; live
			// '273483fe031816b44f248428a028d28c'; test
			$this->hotelbeds_secret='bee7c61cbf'; 

			// b14ebd32e7 live
			// bee7c61cbf test

			//$common_dataArr['hotelbeds_secret'];//bee7c61cbf
			$signature = hash("sha256", $this->hotelbeds_key.$this->hotelbeds_secret.time());
			$this->headerData=array('Content-Type: application/json','Accept:application/json','Api-key:'.$this->hotelbeds_key, 'X-Signature:'.$signature);
		}
// GetLocations Start   
	public function GetLocations(Request $request){
		$term = trim($request['term']);
		// dd($term);

		if($term!=''){
			/*$header = array("Content-Type: application/json;charset=utf-8","accept-encoding: gzip,deflate,br","Cache-Control: no-cache","Pragma: no-cache"); 
			$url = 'https://www.bedsonline.com/api/solrClient?callback=jQuery22409297699824492913_1603534264523';
			$postdata =array("query"=>array("destination"=>$term,"language"=>"ENG","service"=>"H","hotels"=>10,"locations"=>3,"minLength"=>2,"multilanguage"=>0) );
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_ENCODING, '');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
			curl_setopt($ch, CURLOPT_POST, true ); 
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			 $contents = curl_exec($ch);
			curl_close($ch);
			$this->createLogFile('GetLocations',json_encode($postdata),$contents);
			$data =json_decode($contents,true);*/
			
			$res =DB::select("select * from hotelbeds_destinations WHERE LCASE(city_name) LIKE '".strtolower($term)."%' OR LCASE(city_code) LIKE '".strtolower($term)."'  limit 5");
			// dd($res);
			
			//$data_arr =  array('zonegroup' => $data['destinationResultList'],'zone' => '','hotels' => '');
		 }else{ $data_arr =  array('zonegroup' => '','zone' => '','hotels' => '');  }
		 
		 echo json_encode($res);
		
	}
// GetLocations End













// // GetHotelListNew Start
// 	public function GetHotelListNew(Request $request){	

// 	// dd($this->signature,$this->headerData);	
// 		$search_Session_Id=$request["search_session"];
// 		$regionid=$request['regionid'];
// 		$zonecode=$request['zonecode'];
// 		$destination=$request['destination'];
// 		$checkIn=$request['checkIn'];
// 		$checkOut=$request['checkOut'];
// 		$rooms=$request['rooms'];
// 		$adults=$request['adults'];
// 		$childs=$request['childs'];
// 		$childAge=$request['childAge'];
// 		$pageno=$request['page_number'];
// 		$Hotel_maukup_user=$request['Hotel_maukup'];
// 		$language='en';
// 		$orderfld ='LowRate';
// 		$orderby ='ASC';
	  
// 	   $FormattedCheckIn=\DateTime::createFromFormat('m/d/Y', $checkIn)->format('Y/m/d');
// 		$formattedCheckOut=\DateTime::createFromFormat('m/d/Y', $checkOut)->format('Y/m/d');
		
// 	  	//dd($checkIn,$checkOut,	$FormattedCheckIn,	$formattedCheckOut);
	  	
// 		$checkIn = str_replace('/', '-', 	$FormattedCheckIn);
// 		$checkIn=date('Y-m-d',strtotime($checkIn));
// 		$checkOut = str_replace('/', '-', 	$formattedCheckOut);
// 		$checkOut=date('Y-m-d',strtotime($checkOut));
		
//    		$actionUrl=$this->endpoint.'/hotels';
// 		$adultArr =json_decode($adults,true);  
// 		$childArr = json_decode($childs,true); 	
// 		$childAgeArr =json_decode($childAge,true); 
// 		$occupancies =array();

// 		// =================================================



//          // ================== new code for occupanc start =====================//

// 	// Convert JSON string to array, or set to empty array if not convertible
// 			$decodedChildAge = json_decode($childAge, true) ?: [];

// 			// Ensure each room has its own array of child ages
// 			$childAges = [];
// 			for ($i = 0; $i < $rooms; $i++) {
// 			    // Extract inner array if present, or use an empty array
// 			    $innerArray = isset($decodedChildAge[$i]) ? $decodedChildAge[$i] : [];
// 			    $childAges[] = $innerArray;
// 			}

// 			// Convert child ages array to JSON
// 			$desiredChildAge = json_encode($childAges);

// 			// Construct the form request array
// 			$formRequest = [
// 			    "rooms" => $rooms,
// 			    "adults" => $adultArr,
// 			    "childs" => $childArr,
// 			    "childAge" => $desiredChildAge,
// 			];

// 			// Convert string data to arrays
// 			$rooms = (int) $formRequest['rooms'];
// 			$adults = array_map('intval', explode(',', $formRequest["adults"]));
// 			$children = array_map('intval', explode(',', $formRequest["childs"]));
// 			$childAges = json_decode($formRequest["childAge"], true);
// 			$adultNames = json_decode($request['adultNames'], true);

// 			// Initialize the occupancies array
// 			$occupancies = [];

// 			// Loop through the data to build the occupancies array
// 			for ($i = 0; $i < $rooms; $i++) {
// 			    $occupancy = [
// 			        'rooms' => 1,
// 			        'adults' => $adults[$i],
// 			        'children' => $children[$i],
// 			        'paxes' => []
// 			    ];

// 			    // Add adults to the paxes array
// 			    for ($j = 0; $j < $adults[$i]; $j++) {
// 			        $name = isset($adultNames[$i]) ? $adultNames[$i] : 'AdultName' . ($j + 1);
// 			        $occupancy['paxes'][] = [
// 			            'roomId' => $i + 1,
// 			            'type' => 'AD', // AD = Adult
// 			            'name' => $name,// Placeholder name, replace with actual name if available
// 			            'surname' => 'Surname' . ($j + 1) // Placeholder surname, replace with actual surname if available
// 			        ];
// 			    }

// 			    // Add children to the paxes array
// 			    for ($j = 0; $j < $children[$i]; $j++) {
// 			        $age = isset($childAges[$i][$j]) ? $childAges[$i][$j] : ''; // Get child's age
// 			        $occupancy['paxes'][] = [
// 			            'roomId' => $i + 1,
// 			            'type' => 'CH', // CH = Child
// 			            'age' => $age,
// 			            'name' => 'ChildName' . ($j + 1), // Placeholder name, replace with actual name if available
// 			            'surname' => 'Surname' . ($j + 1) // Placeholder surname, replace with actual surname if available
// 			        ];
// 			    }

// 			    // Add the occupancy to the occupancies array
// 			    $occupancies[] = $occupancy;
// 			}


// 			// Print the occupancies array (or use it in your payload)
// 			// print_r($occupancies);
// 			// dd($occupancies);
// 	         // dd($request->all(),$adultArr,$childArr,$childAgeArr,$occupancies);
// 	        // ================== new code for occupanc end =====================//

// 			$start = ($request['startno'] - 1) * 5 + 1; // This will give you 1, 6, 11, etc.
// 			$limit = ($request['startno'] - 1) * 5 + 5; // This will give you 5, 10, 15, etc.
// 			$size=5;
// 			// dd($start);

// 			$page=$request['page_number'];
// 			if($page>1){
// 			 $size =($page*$limit);	
// 			 $start =($page-1)*$limit;	
// 			}

// 			$LogStr ='';
// 			$LogStr.=' Page:'.$page.'<br>';
		
// 			$hotel =array();
// 			$len = strlen($regionid);
		
// 			// cURL initialization    //////////
// 			$apiUrl = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels?fields=code&language=ENG&from=".$start."&to=".$limit."&useSecondaryLanguage=false&destinationCode=".$regionid."";
// 			// dd($apiUrl,$regionid);
// 			$curl = curl_init();
// 			curl_setopt($curl, CURLOPT_URL, $apiUrl);
// 			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// 			curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headerData);
// 			$response = curl_exec($curl);
// 			$data=json_decode($response,true);
// 			// dd($data);


// 		// Check if the 'hotels' key exists and is an array
// 		if (isset($data['hotels']) && is_array($data['hotels'])) {
// 		    // Extract hotel codes
// 		    $hotelCodes = array_map(function($hotel) {
// 		        return $hotel['code'];
// 		    }, $data['hotels']);

// 		    // Prepare the transformed data
// 		    $transformedData = [
		       
// 		            'hotel' => $hotelCodes
		        
// 		    ];

// 		    // Print or use the transformed data
// 		    // print_r($transformedData);
// 		    $hotel=$transformedData;
// 		    $PropertyCount=count($hotel);
// 		    // dd($transformedData,$hotel['hotel']);

// 		} else {
// 		    echo 'Invalid response or no hotels found.';
// 		}



		
		
		
	
// 		if(isset($hotel['hotel'])){ $totalsendhotel = count($hotel['hotel']); } 
// 		else{  $data =array('isFind'=>'No','pageCount'=>0,'total_records'=>0,'search_Session_Id'=>''); echo json_encode($data); die; }
// 		/* -------- */

// 		$brdlist=array('RO','BB','AI','HB','FB','RR','AB','DB','GB','IB','LB');
// 		$boardarr =array('included'=>true,'board'=>$brdlist);
		
		
// 		$reviewsArr[] =array('type'=>'TRIPADVISOR','maxRate'=>5,'minReviewCount'=>1);
// 		$accommodationsArr=array('HOTEL','RESORT','HOSTEL','HOMES','APTHOTEL','APARTMENT');
// 		$postdata =array('language'=>'ENG',
// 	                     'currency'=>'USD', 
// 		                 'stay'=>array('checkIn'=>$checkIn,'checkOut'=>$checkOut),  //,'shiftDays'=>0
// 		                 'occupancies'=>$occupancies,
// 	                     'hotels'=>$hotel,//['893849','893839']
// 						 'filter'=>array('packaging'=>true,"deal"=> true),
// 						 'boards'=>$boardarr,
// 						 'sourceMarket'=> "US",
// 						 'remark' => 'Require non-smoking room',
					
// 					 //'filter'=>array('accommodations'=>$accommodationsArr)
// 					 //'accommodations'=>$accommodationsArr
// 	                );
//                    // dd($postdata);

			     

// 			     //echo "<pre>postdata=="; print_r($postdata);
// 				$ch = curl_init();
// 				curl_setopt($ch, CURLOPT_URL, $actionUrl);
// 				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
// 				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// 				curl_setopt($ch, CURLOPT_POST, 1);
// 				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
// 				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// 				curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerData);
// 			     $response = curl_exec($ch);
// 				curl_close($ch);	
// 					$this->createLogFile('GetHotelListNew',json_encode($postdata),$response);		
// 			    $results =json_decode($response,true);	
// 			   // dd($results,$actionUrl,$postdata,$this->headerData);
// 			    // dd($results);
				
// 				// $this->createLogFile('Search',json_encode($postdata).$endpoint.'('.$size.'--sendHotels-'.$totalsendhotel.')'.'---'.'(getHotels-'.count($hotelData).')',$response);

// 	        $data=array();
// 	   if(isset($results['hotels']['hotels'])){
// 		// dd(1270);
// 		// dd($postdata,$results);
// 		$hotelData =$results['hotels']['hotels']; 
// 		$dd=count($hotelData);
// 		// dd($dd);
// 		$status =200; 
		
// 		for($i=0;$i<count($hotelData);$i++){	
// 		// for($i=0;$i<10;$i++){	
			
// 		if(isset($hotelData[$i]['rooms'][0]['rates'][0]['rateClass'])){
// 		 $hotel_id =$hotelData[$i]['code'];
// 		 $RoomTypes =$hotelData[$i]['rooms'];  
// 		  // dd( $rooms , $adultArr , $childArr , $hotelData[$i]['currency'] , $RoomTypes);

// 		 $RoomConbination=$this->ManageRoomType($rooms,$adultArr,$childArr,$hotelData[$i]['currency'],$RoomTypes);

// 		// echo "<pre>RoomConbination==".json_encode($RoomConbination); 
		 
// 		//$RoomConbination =ManageRoomType($rooms,$adults,$children,$api_currency,$RoomTypes); 
// 			$boardkeyArr=array_keys($RoomConbination[0]['rates']);
// 			$boardkey =$boardkeyArr[0];  // RO 
// 			$roomData =$RoomConbination[0]['rates'][$boardkey];
// 			$keyArr=array_keys($roomData);

// 			// This section is taking more than 2.5 seconds
// 			if(in_array('NOR',$keyArr)){$firstKey ='NOR';}
// 			else{$firstKey = $keyArr[0];}
// 			$roomArr =@$roomData[$firstKey];
// 			$lowRate=0;
// 			$base_price=0;
// 			$adminPrice =0;
// 			$api_price =0;
			
			
// 				for($r=0;$r<count($roomArr);$r++){ 
// 					$api_price=(@$api_price+@$roomArr[$r]['rates']['api_price']);
// 					$base_price=($base_price+@$roomArr[$r]['rates']['base_price_in_live_currency']);
// 					$adminPrice=($adminPrice+@$roomArr[$r]['rates']['adminPrice']);
// 					$lowRate=($lowRate+@$roomArr[$r]['rates']['net']);
// 					//$discount_price =($highRate-$lowRate);
// 					$nonRefundable=0;
// 					if($firstKey=='NRF'){
// 					  $nonRefundable =1; 
// 					} 		   
// 				}  // This section is taking more than 2.5 seconds
// 				// dd(1,$api_price);
				
		 
// 		 if(isset($hotelData[$i]['reviews'])){ $tripAdvisorArr =$hotelData[$i]['reviews'][0]; } else { $tripAdvisorArr=array('rate'=>0.0,'reviewCount'=>0); }
		
		 
// 		 // hotel details
// 		$apiUrl = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels/".$hotel_id."/details?language=ENG&useSecondaryLanguage=False";
// 		$curl = curl_init();
// 		curl_setopt($curl, CURLOPT_URL, $apiUrl);
// 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// 		curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headerData);
// 		$response = curl_exec($curl);
// 		$obj=json_decode($response);
		
		 
		 
// 		 $findArr =array('STARS','STAR','STAR AND A HALF','AND A HALF','HISTORICAL HOTEL LUXURIOUS','BOUTIQUE','LUXURY','SUPERIOR');
// 	     $replaceArr =array('','','','','','','');
		 
// 		 $StarRating1 =trim(str_replace($findArr,$replaceArr,$hotelData[$i]['categoryName']));
// 		 $StarRating = str_replace('*', '', $StarRating1);
// 		 $rates =$hotelData[$i]['rooms'][0]['rates'][0];		 
// 		 $latitude =$hotelData[$i]['latitude'];
// 		 $longitude =$hotelData[$i]['longitude'];
// 		 $distance =''; //$this->distance($latitude, $longitude, $lat, $lng, '');

		
// 		 $accommodationTypeCode=$obj->hotel->accommodationType->typeMultiDescription->content;
		
// 		 $facilities =$obj->hotel->facilities;
		
// 		 $facilityStr='';
// 		 foreach($facilities as $v){
// 		 	// dd($v->facilityGroupCode);
// 		  if($v->facilityGroupCode==70){
// 			$facilityStr .=$v->facilityCode.",";	
// 		   } 
// 		 }
// 		 // dd($facilityStr);
// 		$facilityStr= substr($facilityStr, 0, -1);
// 		// dd($facilityStr);
// 		$valueAdds='';
// 		if($facilityStr!=''){
// 			 $dquery =DB::select("select GROUP_CONCAT(content SEPARATOR ', ') as valueAdds from hotelbeds_facilities WHERE facilityGroupCode='70' and facilityTypologyCode IN (".$facilityStr.")");
// 			 $dobj =$dquery[0];
// 			 $valueAdds =$dobj->valueAdds; // all facility
// 		 }
// 		 // dd( $valueAdds);
// 		     $nonRefundable=0;
// 			 if($rates['rateClass']!='NOR'){
// 			  $nonRefundable=1;	 
// 			 }

// 		  $api_currency=$hotelData[$i]['currency'];

		
// 		   if (isset($obj->hotel->images) && is_array($obj->hotel->images) && count($obj->hotel->images) > 0) {
// 			    $imgage_path = $this->checkThumbNail('http://photos.hotelbeds.com/giata/' . $obj->hotel->images[0]->path);
// 			    $imgAllow=true;
// 			} 
// 			else {
// 			    $imgAllow=false;
// 			}
// 		 if($lowRate<100000 && $imgAllow==true){
		 
// 		 	  // Initialize session key if it doesn't exist
// 			    if (!session()->has('hotel_data')) {
// 			        session(['hotel_data' => []]);
// 			    }

// 			   $data=array(
// 					'EANHotelID'=>$hotel_id,
// 					'Name'=>$this->clean($hotelData[$i]['name']),//
// 					'address1'=>$this->clean($obj->hotel->address->content),//
// 					'address2'=>$this->clean($obj->hotel->address->content),
// 					'city'=>$this->clean($obj->hotel->city->content),
// 					'postalCode'=>'',
// 					'countryCode'=>$obj->hotel->country->code,
// 					'propertyCategory'=>'',
// 					'hotelRating'=>$StarRating,
	
// 					'hotelRatingDisplay'=>'Star',
// 					'confidenceRating'=>'',
// 					'amenityMask'=>'',
// 					'tripAdvisorRating'=>$tripAdvisorArr['rate'],
// 					'tripAdvisorReviewCount'=>$tripAdvisorArr['reviewCount'],
// 					'tripAdvisorRatingUrl'=>'',
// 					'promoDescription'=>'',
// 					'currentAllotment'=>$rates['allotment'],
// 					'shortDescription'=>'',
									
// 					'api_currency'=>$api_currency,
// 					'api_price'=>$api_price,
// 					'currency'=>$this->currency,
// 					'base_price'=>$base_price, 
// 					'admin_price'=>$adminPrice,
// 					'lowRate'=>$lowRate,
// 					'highRate'=>$lowRate,
// 					'discount_price'=>$lowRate,
// 					'nonRefundable'=>$nonRefundable,
// 					'latitude'=>$latitude,
// 					'longitude'=>$longitude,
// 					'proximityDistance'=>$distance,
					
// 					'proximityUnit'=>'MI',
// 					'hotelInDestination'=>$distance,
// 					'thumbNailUrl'=>$imgage_path,
// 					'desti_lat_lon'=>$regionid,
// 					'boardName'=>$rates['boardName'],
// 					'valueAdds'=>$valueAdds,
// 					'rateClass'=>$rates['rateClass'],
// 					'rateType'=>$rates['rateType'],
// 					'paymentType'=>$rates['paymentType'],
					
// 					'accommodationTypeCode'=>$accommodationTypeCode,
// 					'date_time'=>date("Y-m-d h:i:s"),
// 					'checkin'=>$checkIn,
// 					'checkout'=>$checkOut,
// 					'language'=>'en',
// 					'search_session'=>$search_Session_Id,
// 					'recommended'=> 0, //$obj->recommended,
					
// 					'selling_points'=>'', //$obj->selling_points,
// 					'room_details'=>json_encode($RoomTypes),
// 					'hotelDetails'=>json_encode($hotelData[$i]),
// 					'sort_order'=>0,
// 					'rooms'=>$rooms,

// 					'Cri_Adults'=>'"'.implode(',', $adults).'"',
// 					'Cri_Childs'=>$childs,
// 					'child_age'=>$childAge,
// 					'product'=>'Hotelbeds',
// 				);

// 			    // Append directly to session without manually fetching and reassigning
//                 session()->push('hotel_data', $data);


			    
// 			     // dd($adults);
// 				// echo "<pre>"; print_r($i); 
// 				//chk if name exisit or not

// 				// $chk=DB::table('search_results_hotelbeds')->where('search_session',$search_Session_Id)->where('name',$this->clean($hotelData[$i]['name']))->first();
// 				// if(!$chk){
// 				// 	//db insert code
// 				//     $status = Crud_Model::insertData('search_results_hotelbeds',$data);
// 			    // }

				
// 			}// avoid unwanted hotel
		 
// 		} // end if
// 			$isFind='Yes';
// 		}// end for
// 		        // $this->convertCurrencyRate($api_currency,$hotelData[$i]['minRate']),
// 		 $this->createLanding($regionid,@$data['currency'],@$data['lowRate'],$search_Session_Id,@$data['thumbNailUrl']);
// 		 $isFind='Yes';
		 
		
// 	} //end if of  isset($results['hotels']['hotels'])
// 	else{
// 		// dd("no 2nd api work");
// 	    $isFind='No';
// 		$status =400; 
// 	  }	

// 	  $pageCount=0;
// 	   if($PropertyCount > $size){
// 		  $pageCount =ceil($PropertyCount/$size);
// 		}
// 		else if ($size > $PropertyCount){
// 			$pageCount =0;	
// 		}
// 		else{
// 		 $pageCount =ceil($PropertyCount/$dd);
// 		}
	  
// 	  $data =array('isFind'=>$isFind,'pageCount'=>$pageCount,'total_records'=>$PropertyCount,'search_Session_Id'=>$search_Session_Id,'teststatus'=>$status);
// 	  echo json_encode($data);	 
// 	} 
// // GetHotelListNew List End
	









// GetHotelListNew Start
	public function GetHotelListNew(Request $request){	

	// dd($this->signature,$this->headerData);	
		$search_Session_Id=$request["search_session"];
		$regionid=$request['regionid'];
		$zonecode=$request['zonecode'];
		$destination=$request['destination'];
		$checkIn=$request['checkIn'];
		$checkOut=$request['checkOut'];
		$rooms=$request['rooms'];
		$adults=$request['adults'];
		$childs=$request['childs'];
		$childAge=$request['childAge'];
		$pageno=$request['page_number'];
		$Hotel_maukup_user=$request['Hotel_maukup'];
		$language='en';
		$orderfld ='LowRate';
		$orderby ='ASC';
	  
	   $FormattedCheckIn=\DateTime::createFromFormat('m/d/Y', $checkIn)->format('Y/m/d');
		$formattedCheckOut=\DateTime::createFromFormat('m/d/Y', $checkOut)->format('Y/m/d');
		
	  	//dd($checkIn,$checkOut,	$FormattedCheckIn,	$formattedCheckOut);
	  	
		$checkIn = str_replace('/', '-', 	$FormattedCheckIn);
		$checkIn=date('Y-m-d',strtotime($checkIn));
		$checkOut = str_replace('/', '-', 	$formattedCheckOut);
		$checkOut=date('Y-m-d',strtotime($checkOut));
		
   		$actionUrl=$this->endpoint.'/hotels';
		$adultArr =json_decode($adults,true);  
		$childArr = json_decode($childs,true); 	
		$childAgeArr =json_decode($childAge,true); 
		$occupancies =array();

		// =================================================



         // ================== new code for occupanc start =====================//

	// Convert JSON string to array, or set to empty array if not convertible
			$decodedChildAge = json_decode($childAge, true) ?: [];

			// Ensure each room has its own array of child ages
			$childAges = [];
			for ($i = 0; $i < $rooms; $i++) {
			    // Extract inner array if present, or use an empty array
			    $innerArray = isset($decodedChildAge[$i]) ? $decodedChildAge[$i] : [];
			    $childAges[] = $innerArray;
			}

			// Convert child ages array to JSON
			$desiredChildAge = json_encode($childAges);

			// Construct the form request array
			$formRequest = [
			    "rooms" => $rooms,
			    "adults" => $adultArr,
			    "childs" => $childArr,
			    "childAge" => $desiredChildAge,
			];

			// Convert string data to arrays
			$rooms = (int) $formRequest['rooms'];
			$adults = array_map('intval', explode(',', $formRequest["adults"]));
			$children = array_map('intval', explode(',', $formRequest["childs"]));
			$childAges = json_decode($formRequest["childAge"], true);
			$adultNames = json_decode($request['adultNames'], true);

			// Initialize the occupancies array
			$occupancies = [];

			// Loop through the data to build the occupancies array
			for ($i = 0; $i < $rooms; $i++) {
			    $occupancy = [
			        'rooms' => 1,
			        'adults' => $adults[$i],
			        'children' => $children[$i],
			        'paxes' => []
			    ];

			    // Add adults to the paxes array
			    for ($j = 0; $j < $adults[$i]; $j++) {
			        $name = isset($adultNames[$i]) ? $adultNames[$i] : 'AdultName' . ($j + 1);
			        $occupancy['paxes'][] = [
			            'roomId' => $i + 1,
			            'type' => 'AD', // AD = Adult
			            'name' => $name,// Placeholder name, replace with actual name if available
			            'surname' => 'Surname' . ($j + 1) // Placeholder surname, replace with actual surname if available
			        ];
			    }

			    // Add children to the paxes array
			    for ($j = 0; $j < $children[$i]; $j++) {
			        $age = isset($childAges[$i][$j]) ? $childAges[$i][$j] : ''; // Get child's age
			        $occupancy['paxes'][] = [
			            'roomId' => $i + 1,
			            'type' => 'CH', // CH = Child
			            'age' => $age,
			            'name' => 'ChildName' . ($j + 1), // Placeholder name, replace with actual name if available
			            'surname' => 'Surname' . ($j + 1) // Placeholder surname, replace with actual surname if available
			        ];
			    }

			    // Add the occupancy to the occupancies array
			    $occupancies[] = $occupancy;
			}


			// Print the occupancies array (or use it in your payload)
			// print_r($occupancies);
			// dd($occupancies);
	         // dd($request->all(),$adultArr,$childArr,$childAgeArr,$occupancies);
	        // ================== new code for occupanc end =====================//

			$start = ($request['startno'] - 1) * 5 + 1; // This will give you 1, 6, 11, etc.
			$limit = ($request['startno'] - 1) * 5 + 5; // This will give you 5, 10, 15, etc.
			$size=5;
			// dd($start);

			$page=$request['page_number'];
			if($page>1){
			 $size =($page*$limit);	
			 $start =($page-1)*$limit;	
			}

			$LogStr ='';
			$LogStr.=' Page:'.$page.'<br>';
		
			$hotel =array();
			$len = strlen($regionid);
		
			// cURL initialization    //////////
			// $apiUrl = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels?fields=code&language=ENG&from=".$start."&to=".$limit."&useSecondaryLanguage=false&destinationCode=".$regionid."";
			// // dd($apiUrl,$regionid);
			// $curl = curl_init();
			// curl_setopt($curl, CURLOPT_URL, $apiUrl);
			// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			// curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headerData);
			// $response = curl_exec($curl);
			// $data=json_decode($response,true);
			// dd($data['hotels']);

			//db query to get hotel ids
			$data['hotels'] = AllHotelModel::where('region', 'US')
		     ->whereBetween('id', [$start,$limit])
		    ->get(['code']) // Fetch only the 'code' column
		    ->map(function ($item) {
		        return ['code' => (int)$item->code];
		    })
		    ->toArray();
			// dd($data['hotels'],$start,$limit);


		// Check if the 'hotels' key exists and is an array
		if (isset($data['hotels']) && is_array($data['hotels'])) {
		    // Extract hotel codes
		    $hotelCodes = array_map(function($hotel) {
		        return $hotel['code'];
		    }, $data['hotels']);

		    // Prepare the transformed data
		    $transformedData = [
		            'hotel' => $hotelCodes
		    ];

		    $hotel=$transformedData;
		    $PropertyCount=count($hotel);
		    // dd($transformedData,$hotel['hotel'],$data['hotels'],$start,$limit);

		} else {
		    echo 'Invalid response or no hotels found.';
		}



		
		
		
	
		if(isset($hotel['hotel'])){ $totalsendhotel = count($hotel['hotel']); } 
		else{  $data =array('isFind'=>'No','pageCount'=>0,'total_records'=>0,'search_Session_Id'=>''); echo json_encode($data); die; }
		/* -------- */

		$brdlist=array('RO','BB','AI','HB','FB','RR','AB','DB','GB','IB','LB');
		$boardarr =array('included'=>true,'board'=>$brdlist);
		
		
		$reviewsArr[] =array('type'=>'TRIPADVISOR','maxRate'=>5,'minReviewCount'=>1);
		$accommodationsArr=array('HOTEL','RESORT','HOSTEL','HOMES','APTHOTEL','APARTMENT');
		$postdata =array('language'=>'ENG',
	                     'currency'=>'USD', 
		                 'stay'=>array('checkIn'=>$checkIn,'checkOut'=>$checkOut),  //,'shiftDays'=>0
		                 'occupancies'=>$occupancies,
	                     'hotels'=>$hotel,//['893849','893839']
						 'filter'=>array('packaging'=>true,"deal"=> true),
						 'boards'=>$boardarr,
						 'sourceMarket'=> "US",
						 'remark' => 'Require non-smoking room',
					
					 //'filter'=>array('accommodations'=>$accommodationsArr)
					 //'accommodations'=>$accommodationsArr
	                );
                   // dd($postdata);

			     

			     //echo "<pre>postdata=="; print_r($postdata);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $actionUrl);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerData);
			     $response = curl_exec($ch);
				curl_close($ch);	
					$this->createLogFile('GetHotelListNew',json_encode($postdata),$response);		
			    $results =json_decode($response,true);	
			   // dd($results,$actionUrl,$postdata,$this->headerData);
			    // dd($results);
				
				// $this->createLogFile('Search',json_encode($postdata).$endpoint.'('.$size.'--sendHotels-'.$totalsendhotel.')'.'---'.'(getHotels-'.count($hotelData).')',$response);

	   $data=array();
	   if(isset($results['hotels']['hotels'])){
		// dd(1270);
		// dd($postdata,$results['hotels']['hotels']);
		$hotelData =$results['hotels']['hotels']; 
		$dd=count($hotelData);
		// dd($dd);
		$status =200; 
		
		for($i=0;$i<count($hotelData);$i++){	
		// for($i=0;$i<10;$i++){	
			
		if(isset($hotelData[$i]['rooms'][0]['rates'][0]['rateClass'])){
		 $hotel_id =$hotelData[$i]['code'];
		 $RoomTypes =$hotelData[$i]['rooms'];  
		  // dd( $rooms , $adultArr , $childArr , $hotelData[$i]['currency'] , $RoomTypes);

		 $RoomConbination=$this->ManageRoomType($rooms,$adultArr,$childArr,$hotelData[$i]['currency'],$RoomTypes);

		// echo "<pre>RoomConbination==".json_encode($RoomConbination); 
		 
		//$RoomConbination =ManageRoomType($rooms,$adults,$children,$api_currency,$RoomTypes); 
			$boardkeyArr=array_keys($RoomConbination[0]['rates']);
			$boardkey =$boardkeyArr[0];  // RO 
			$roomData =$RoomConbination[0]['rates'][$boardkey];
			$keyArr=array_keys($roomData);

			// This section is taking more than 2.5 seconds
			if(in_array('NOR',$keyArr)){$firstKey ='NOR';}
			else{$firstKey = $keyArr[0];}
			$roomArr =@$roomData[$firstKey];
			$lowRate=0;
			$base_price=0;
			$adminPrice =0;
			$api_price =0;
			
			
				for($r=0;$r<count($roomArr);$r++){ 
					$api_price=(@$api_price+@$roomArr[$r]['rates']['api_price']);
					$base_price=($base_price+@$roomArr[$r]['rates']['base_price_in_live_currency']);
					$adminPrice=($adminPrice+@$roomArr[$r]['rates']['adminPrice']);
					$lowRate=($lowRate+@$roomArr[$r]['rates']['net']);
					//$discount_price =($highRate-$lowRate);
					$nonRefundable=0;
					if($firstKey=='NRF'){
					  $nonRefundable =1; 
					} 		   
				}  // This section is taking more than 2.5 seconds
				// dd(1,$api_price);
				
		 
		 if(isset($hotelData[$i]['reviews'])){ $tripAdvisorArr =$hotelData[$i]['reviews'][0]; } else { $tripAdvisorArr=array('rate'=>0.0,'reviewCount'=>0); }
		
		 
		 // hotel details
		// $apiUrl = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels/".$hotel_id."/details?language=ENG&useSecondaryLanguage=False";
		// $curl = curl_init();
		// curl_setopt($curl, CURLOPT_URL, $apiUrl);
		// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headerData);
		// $response = curl_exec($curl);
		// $obj=json_decode($response);
		// dd($obj);

		//hoteldetail from api
		$obj1=AllHotelModel::where('code',$hotel_id)->first();
		// dd($obj,$obj1);

		
		 
		 
		 $findArr =array('STARS','STAR','STAR AND A HALF','AND A HALF','HISTORICAL HOTEL LUXURIOUS','BOUTIQUE','LUXURY','SUPERIOR');
	     $replaceArr =array('','','','','','','');
		 
		 $StarRating1 =trim(str_replace($findArr,$replaceArr,$hotelData[$i]['categoryName']));
		 $StarRating = str_replace('*', '', $StarRating1);
		 $rates =$hotelData[$i]['rooms'][0]['rates'][0];		 
		 $latitude =$hotelData[$i]['latitude'];
		 $longitude =$hotelData[$i]['longitude'];
		 $distance =''; //$this->distance($latitude, $longitude, $lat, $lng, '');

		
		 // $accommodationTypeCode=$obj->hotel->accommodationType->typeMultiDescription->content;
		$accommodationTypeCode = $obj1->accommodationType == "H" ? "Hotel" : 
                         ($obj1->accommodationType == "A" ? "Apartment" : 
                         ($obj1->accommodationType == "R" ? "Resort" : 
                         ($obj1->accommodationType == "V" ? "Villa" : 
                         ($obj1->accommodationType == "P" ? "Pension" : 
                         ($obj1->accommodationType == "B" ? "Bed & Breakfast" : 
                         ($obj1->accommodationType == "C" ? "Camping" : "Unknown"))))));

		 // dd($accommodationTypeCode);
		
		 // $facilities =$obj->hotel->facilities;
         $facilities =json_decode($obj1->facilities);
		 // dd($facilities);
		
		 $facilityStr='';
		 foreach($facilities as $v){
		 	// dd($v->facilityGroupCode);
		  if($v->facilityGroupCode==70){
			$facilityStr .=$v->facilityCode.",";	
		   } 
		 }

		 // dd($facilityStr);
		$facilityStr= substr($facilityStr, 0, -1);
		// dd($facilityStr);
		$valueAdds='';
		if($facilityStr!=''){
			 $dquery =DB::select("select GROUP_CONCAT(content SEPARATOR ', ') as valueAdds from hotelbeds_facilities WHERE facilityGroupCode='70' and facilityTypologyCode IN (".$facilityStr.")");
			 $dobj =$dquery[0];
			 $valueAdds =$dobj->valueAdds; // all facility
		 }
		 // dd( $valueAdds);
		     $nonRefundable=0;
			 if($rates['rateClass']!='NOR'){
			  $nonRefundable=1;	 
			 }

		  $api_currency=$hotelData[$i]['currency'];

		  
		   $allimg=json_decode($obj1->images);

		   // dd(isset($obj1->images),is_array($allimg));
		   if (isset($obj1->images) && is_array($allimg) ) {
		   	
			    // $imgage_path = $this->checkThumbNail('http://photos.hotelbeds.com/giata/' . $obj->hotel->images[0]->path);

			    $imgage_path = $this->checkThumbNail('http://photos.hotelbeds.com/giata/' . $allimg[0]->path);

			    // dd($imgage_path);
			    $imgAllow=true;
			} 
			else {
			    $imgAllow=false;
			}


		 if($lowRate<100000 && $imgAllow==true){
		 
		 	  // Initialize session key if it doesn't exist
			    if (!session()->has('hotel_data')) {
			        session(['hotel_data' => []]);
			    }

			    


			   $data=array(
					'EANHotelID'=>$hotel_id,
					'Name'=>$this->clean($hotelData[$i]['name']),//
					'address1'=>$this->clean($obj1->address1),//
					'address2'=>$this->clean($obj1->address2),
					'city'=>$this->clean($obj1->city),
					'postalCode'=>'',
					'countryCode'=>$obj1->country,
					'propertyCategory'=>'',
					'hotelRating'=>$StarRating,
	
					'hotelRatingDisplay'=>'Star',
					'confidenceRating'=>'',
					'amenityMask'=>'',
					'tripAdvisorRating'=>$tripAdvisorArr['rate'],
					'tripAdvisorReviewCount'=>$tripAdvisorArr['reviewCount'],
					'tripAdvisorRatingUrl'=>'',
					'promoDescription'=>'',
					'currentAllotment'=>$rates['allotment'],
					'shortDescription'=>'',
									
					'api_currency'=>$api_currency,
					'api_price'=>$api_price,
					'currency'=>$this->currency,
					'base_price'=>$base_price, 
					'admin_price'=>$adminPrice,
					'lowRate'=>$lowRate,
					'highRate'=>$lowRate,
					'discount_price'=>$lowRate,
					'nonRefundable'=>$nonRefundable,
					'latitude'=>$latitude,
					'longitude'=>$longitude,
					'proximityDistance'=>$distance,
					
					'proximityUnit'=>'MI',
					'hotelInDestination'=>$distance,
					'thumbNailUrl'=>$imgage_path,
					'desti_lat_lon'=>$regionid,
					'boardName'=>$rates['boardName'],
					'valueAdds'=>$valueAdds,
					'rateClass'=>$rates['rateClass'],
					'rateType'=>$rates['rateType'],
					'paymentType'=>$rates['paymentType'],
					
					'accommodationTypeCode'=>$accommodationTypeCode,
					'date_time'=>date("Y-m-d h:i:s"),
					'checkin'=>$checkIn,
					'checkout'=>$checkOut,
					'language'=>'en',
					'search_session'=>$search_Session_Id,
					'recommended'=> 0, //$obj->recommended,
					
					'selling_points'=>'', //$obj->selling_points,
					'room_details'=>json_encode($RoomTypes),
					'hotelDetails'=>json_encode($hotelData[$i]),
					'sort_order'=>0,
					'rooms'=>$rooms,

					'Cri_Adults'=>'"'.implode(',', $adults).'"',
					'Cri_Childs'=>$childs,
					'child_age'=>$childAge,
					'product'=>'Hotelbeds',
				);

			  // Check if data with the same EANHotelID and search_session already exists
				if (array_search($hotel_id, array_column(session()->get('hotel_data', []), 'EANHotelID')) === false || 
				    !array_search(true, array_map(fn($hotel) => $hotel['EANHotelID'] == $hotel_id && $hotel['search_session'] == $search_Session_Id, session()->get('hotel_data', [])))) {
				    session()->push('hotel_data', $data);
				}


			    
			     // dd($adults);
				// echo "<pre>"; print_r($i); 
				//chk if name exisit or not

				// $chk=DB::table('search_results_hotelbeds')->where('search_session',$search_Session_Id)->where('name',$this->clean($hotelData[$i]['name']))->first();
				// if(!$chk){
				// 	//db insert code
				//     $status = Crud_Model::insertData('search_results_hotelbeds',$data);
			    // }

				
			}// avoid unwanted hotel
		 
		} // end if
			$isFind='Yes';
		}// end for
		        // $this->convertCurrencyRate($api_currency,$hotelData[$i]['minRate']),
		 $this->createLanding($regionid,@$data['currency'],@$data['lowRate'],$search_Session_Id,@$data['thumbNailUrl']);
		 $isFind='Yes';
		 
		
	} //end if of  isset($results['hotels']['hotels'])
	else{
		// dd("no 2nd api work");
	    $isFind='No';
		$status =400; 
	  }	

	  $pageCount=0;
	   if($PropertyCount > $size){
		  $pageCount =ceil($PropertyCount/$size);
		}
		else if ($size > $PropertyCount){
			$pageCount =0;	
		}
		else{
		 $pageCount =ceil($PropertyCount/$dd);
		}
	  
	  $data =array('isFind'=>$isFind,'pageCount'=>$pageCount,'total_records'=>$PropertyCount,'search_Session_Id'=>$search_Session_Id,'teststatus'=>$status,"s"=>$start,"l"=>$limit);
	  echo json_encode($data);	 
	} 
// GetHotelListNew List End
	












public function getdetails($id){
	$id=$id;
	 $hotelSearchData = crud_model::readOne('search_results_hotelbeds',array('id'=>$id));
	 $pageData = crud_model::readOne('pages',array('page_id'=>'hotel-details'));
	 if($hotelSearchData->product=='Plistbooking'){ 
	 	return view('hotel/hotel-details-plistbooking', array('hotelSearchData' => $hotelSearchData,'pageData' => $pageData,'hotelData' => '')); 
	 }
		
	    $apiUrl = "https://api.hotelbeds.com/hotel-content-api/1.0/hotels/".$hotelSearchData->EANHotelID."/details?language=ENG&useSecondaryLanguage=False";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $apiUrl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headerData);
		$response = curl_exec($curl);
		$hotelObj=json_decode($response);
		

		$this->createLogFile('GetHotelDetails',$apiUrl,$response);		
		
		$hotelData =json_decode($hotelSearchData->hotelDetails,true);
		if(count($hotelData)>0){
			$currency =$hotelData['currency'];
			$hotel_id =$hotelData['code'];
			$RoomType =$hotelData['rooms'];
			$countRoom =count($RoomType);

			if (isset($hotelObj->hotel)) {
				    // Hotel is present
				$h='<li class="mr-2"><i class="la la-star"></i>Car park</li>
				<li class="mr-2"><i class="la la-star"></i>Car park</li>
				<li class="mr-2"><i class="la la-star"></i>24-hour reception</li>
				<li class="mr-2"><i class="la la-star"></i>Wi-fi</li>
				<li class="mr-2"><i class="la la-star"></i>Car hire</li>
				<li class="mr-2"><i class="la la-star"></i>Late Check-out</li>';
				return $h;
                }
			  

			$contentArr =$hotelObj->hotel;
			$facilities=array(); 
			$roomDetailDescription=array(); 
			$amenetyData=array();
			$paymentMethods=array();
			$roomFacilities=array(); 
			$businessAmenety=array(); 
			$PointsofinterestArr=array();
			// dd($contentArr->facilities);
			
			if(isset($contentArr->facilities)){ 
				$facilities =$contentArr->facilities;
				foreach($facilities as $f){
				 $groupCode =$f->facilityGroupCode;
				 $facilityCode =$f->facilityCode;
				 
				 if(isset($f->number)){ $pre_content =$f->number;}
				 else if(isset($f->indLogic) && $f->indLogic==true){ $pre_content ='Yes';}
				 else if(isset($f->indLogic) && $f->indLogic==false){ $pre_content ='No';}
				 else if(isset($f->indYesOrNo) && $f->indYesOrNo=true){ $pre_content ='Yes';}
				 else if(isset($f->indYesOrNo) && $f->indYesOrNo=false){ $pre_content ='No';}
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
						$amenetyData[]= array($content); 
						// dd($amenetyData);
					  }
					  if($groupCode==30){
						$paymentMethods[]= array('title'=>$content); 
					  }else{ $paymentMethods=array(); }
					 
					  if($groupCode==60){
						$roomFacilities[]=array('title'=>trim($content.': '.$pre_content));
					  }
					  if($groupCode==72){
						$businessAmenety[]= array('businessamenity'=>$content); 
					  }
					  
					  if($groupCode==40){
						$PointsofinterestArr[]= $content; 
					  }
					}
				  
				}
			}
			$data['amenetyData']=$amenetyData;
			// dd($amenetyData);
			// return $amenetyData;

			$html = '';
	        foreach ($amenetyData as $key=> $item) {
	        	//dd($item[0]);
	        	if($key<8){
	             $html .= '<li class="mr-2"><i class="la la-star"></i>' . $item[0] . '</li>';
	            }
	        }
	        $html .= '';

            return $html;

			// return $data;
			//<div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
            //<i class="la la-check"></i>
            //</div>
			
    }
}


























// Show_Hotels_New Start
	// public function Show_Hotels_New(Request $request){
	// 	$limit =30;
	// 	if(($request["page"]<1) || ($request["page"]=='')){
	// 		$page = 0;
	// 	}else{
	// 		$page = ( ($request["page"]) * $limit);
	// 	}

	// 	// dd($page,$limit);
	// 	$sortValArr=explode('_',$request["sortVal"]);
	// 	$search_session=$request['search_id'];
	// 	$orderBy=' order by '.$sortValArr[0].' '.$sortValArr[1];
	// 	$moreQuery=" where search_session='".$search_session."' ";
	// 	$data = array();
	// 	if($request['price']!=''){
	// 		$price =str_replace(' ','',$request['price']);
	// 		$priceArr =explode('-',$price);
	// 		$minPrice =$priceArr[0];
	// 		$maxPrice =$priceArr[1];
	// 		$moreQuery.= " AND (lowRate >= ".$minPrice." AND lowRate<=".$maxPrice.")";
	// 		 $page=0;
	// 	     $limit =70;
	// 	} 
		
	// 	$Cri_Rating=substr($request['Cri_Rating'],0,-1);
	// 	$Cri_Rating =explode(",",$request['Cri_Rating']); 
	// 	$Cri_Rating =array_filter($Cri_Rating);
	// 	if(count($Cri_Rating)>0) {
	// 	 $moreQuery.= " AND hotelRating IN (";	
	// 	 $RatingStr ='';
	// 	 foreach($Cri_Rating as $v){   
	// 	  $RatingStr.= " '".$v."',"; 	 
	// 	 }
	// 	 $rating =substr($RatingStr,0,-1);
	// 	 $moreQuery.=$rating;
	// 	 $moreQuery.= " )";   
	// 	 $page=0;
	// 	 $limit =70;
	// 	}
		
		
	// 	$Cri_board=substr($request['Cri_board'],0,-1);
	// 	$Cri_board =explode(",",$request['Cri_board']); 
	// 	$Cri_board =array_filter($Cri_board);
	// 	if(count($Cri_board)>0) {
	// 	 $moreQuery.= " AND boardName IN (";	
	// 	 $boardStr ='';
	// 	 foreach($Cri_board as $v){   
	// 	  $boardStr.= " '".$v."',"; 	 
	// 	 }
	// 	 $board =substr($boardStr,0,-1);
	// 	 $moreQuery.=$board;
	// 	 $moreQuery.= " )";   
	// 	}
		
	// 	$Cri_product=substr($request['Cri_product'],0,-1);
	// 	$Cri_product =explode(",",$request['Cri_product']); 
	// 	$Cri_product =array_filter($Cri_product);
	// 	if(count($Cri_product)>0) {
	// 	 $moreQuery.= " AND product IN (";	
	// 	 $productStr ='';
	// 	 foreach($Cri_product as $v){   
	// 	  $productStr.= " '".$v."',"; 	 
	// 	 }
	// 	 $product =substr($productStr,0,-1);
	// 	 $moreQuery.=$product;
	// 	 $moreQuery.= " )";   
	// 	}
		
	// 	$accommodationType=substr($request['accommodationType'],0,-1);
	// 	$accommodationType =explode(",",$request['accommodationType']); 
	// 	$accommodationType =array_filter($accommodationType);
	// 	if(count($accommodationType)>0) {
	// 	 $moreQuery.= " AND accommodationTypeCode IN (";	
	// 	 $accommodationTypeStr ='';
	// 	 foreach($accommodationType as $v){   
	// 	  $accommodationTypeStr.= " '".$v."',"; 	 
	// 	 }
	// 	 $accommodation =substr($accommodationTypeStr,0,-1);
	// 	 $moreQuery.=$accommodation;
	// 	 $moreQuery.= " )";   
	// 	}
				
	// 	$Cri_amenity=substr($request['Cri_amenity'],0,-1);
	// 	$Cri_amenity =explode(",",$request['Cri_amenity']); 
	// 	$Cri_amenity =array_filter($Cri_amenity);
	// 	if(count($Cri_amenity)>0) {
	// 	 foreach($Cri_amenity as $v){  $moreQuery.= " AND valueAdds like '%".$v."%' ";	 }
	// 	}
		
	// 	// if($request['hotel_name']!='') {
	// 	// $hotel_name=trim($request['hotel_name']);
	// 	//  $moreQuery.= " AND Name like '%".$hotel_name."%' ";
	// 	//  $page=1;	 
	// 	// }

	// 	if (!empty($request['hotel_name'])) {
	// 	    $hotel_name = trim($request['hotel_name']);

	// 	    // Create the three variations: lowercase, capitalize first letter, uppercase
	// 	    $lower_name = strtolower($hotel_name);
	// 	    $capital_name = ucfirst(strtolower($hotel_name));
	// 	    $upper_name = strtoupper($hotel_name);
	// 	     $title_case_name = ucwords(strtolower($hotel_name)); 

	// 	    // Add conditions to check for all three variations
	// 	    $moreQuery .= " AND (Name LIKE '%" . $lower_name . "%' 
	// 	                    OR Name LIKE '%" . $capital_name . "%' 
	// 	                    OR Name LIKE '%" . $upper_name . "%'
	// 	                      OR Name LIKE '%" . $title_case_name . "%'
	// 	                    OR Name like '%".$hotel_name."%' )";
	// 	    $page = 0;
	// 	    $limit =70;
	// 	}

		
	// 	$totalresults = DB::select("select count(*) as totalcount from search_results_hotelbeds ".$moreQuery." ");
	// 	$totalObjs =$totalresults[0]; $totalcount=$totalObjs->totalcount;	
		
	// 	$results = DB::select("select * from search_results_hotelbeds ".$moreQuery." ".$orderBy." LIMIT ".$page.", $limit");  
	// 	// dd($results,"select * from search_results_hotelbeds ".$moreQuery." ".$orderBy." LIMIT ".$page.", $limit");
	// 	$datatype=''; $promoDescription=''; $isFavourate=''; $hotelFlight=''; $policyMatch=''; $inpolicy=''; $apply_rule_on=''; $currentAllotment='';



	// 	        $admin_model_obj = new \App\Models\CommonFunctionModel;
 //                $toCurrencyRate = $admin_model_obj->getFromToCurrencyRate(1.00,'USD', 'USD');
               


	// 	foreach($results as $Objs ){ 
	// 		$amenetyData= ""; //$this->getdetails($Objs->id);

	// 		 $OfferedPriceRoundedOff = $admin_model_obj->displayFinalRates($Objs->lowRate, $toCurrencyRate);

 //                //dd($original_single_price,$OfferedPriceRoundedOff);
 //                $single_price = (($OfferedPriceRoundedOff) * 2);
 //                $wholesale_price = ($single_price / 2);
 //                $free_with_amples = 0.00;
 //                $no_of_amples = 0.00;
 //                $discount_price = 0.00;
 //                $discount = 0.00;
 //                $FinalTextAmount = 0.00;
 //                $calculateDiscount = ((($single_price - $wholesale_price) * 100) / $single_price);
 //                $discount = round($calculateDiscount, 2);
 //                $discount_price = (($single_price * $discount) / 100);
 //                $discount_margin = $discount_price;
 //                $buyandearnamples = ($discount_margin / .12);
 //                $no_of_amples = $buyandearnamples;
 //                $buyandearn=$admin_model_obj->DisplayAmplePoints($no_of_amples);
 //                 $reward=$discount_price;
 //                 $youearn=$discount."%";

 //                 $free_with_amples = ($single_price / .12);
 //                 $free=$admin_model_obj->DisplayAmplePoints($free_with_amples);


	// 		// dd($amenetyData);
	// 			$data['result'][] =array('free'=>$free,'buyandearn'=>$buyandearn,'reward'=>$reward,'youearn'=>$youearn,'no_of_amples'=>$no_of_amples,'amenetyData'=>$amenetyData,'tid'=>$Objs->id,'total'=>$totalcount,'datatype'=>$datatype,'EANHotelID'=>$Objs->EANHotelID,'Name'=>$Objs->Name,'thumbnail'=>$Objs->thumbNailUrl,'StarRating'=>round((int)$Objs->hotelRating),'popularity'=>$Objs->confidenceRating,'tripAdvisorRating'=>$Objs->tripAdvisorRating,'tripAdvisorReviewCount'=>$Objs->tripAdvisorReviewCount,'tripAdvisorRatingUrl'=>'','Address1'=>$Objs->address1,'Address2'=>$Objs->address2,'City'=>$Objs->city,'locationDescription'=>$Objs->locationDescription, 'LowRate'=>$Objs->lowRate,'currency_symbol'=>$this->currency_symbol,'HighRate'=>round((int)$Objs->highRate,0),'discount_price'=>$Objs->discount_price,'nonRefundable'=>$Objs->nonRefundable,'Latitude'=>$Objs->latitude,'Longitude'=>$Objs->longitude,'rateClass_Name'=>$Objs->rateClass,'rateClass'=>$Objs->rateClass,'rateType'=>$Objs->rateType,'paymentType'=>$Objs->paymentType,'promoDescription'=>$promoDescription,'currentAllotment'=>$currentAllotment,'is_custom'=>$Objs->is_custom,'isActive'=>$Objs->isActive,'isFavourate'=>$isFavourate,'hotelFlight'=>$hotelFlight,'policyMatch'=>$policyMatch,'inpolicy'=>$inpolicy,'apply_rule_on'=>$apply_rule_on,'boardName'=>$Objs->boardName,'recommended'=>$Objs->recommended,'selling_points'=>$Objs->selling_points,'valueAdds'=>explode(',',$Objs->valueAdds),'product'=>$Objs->product,'accommodationType'=>$Objs->accommodationTypeCode); 	 
	// 	}
	// $datastr = json_encode($data);    
	// echo $datastr;
	// die;
	// }  
// Show_hotel() End
	








public function Show_Hotels_New(Request $request) {
    $limit = 30;
    $page = ($request->input('page', 1) < 1) ? 0 : ($request->input('page') - 1) * $limit;

    // $sortValArr = explode('_', $request->input("sortVal", "Name_asc"));
    $search_session = $request->input('search_id');
    $data = [];

    // Retrieve the hotel data from the session
    $hotels = collect(session()->get('hotel_data', []))->filter(function ($hotel) use ($search_session) {
        return $hotel['search_session'] == $search_session;
    });

    // dd(count($hotels),$hotels);

    // Filter by price range if provided
    if ($request->filled('price')) {
        [$minPrice, $maxPrice] = explode('-', str_replace(' ', '', $request->input('price')));
        // $minPrice=1;
        // $maxPrice=500;
        $hotels = $hotels->filter(function ($hotel) use ($minPrice, $maxPrice) {
            return $hotel['lowRate'] >= $minPrice && $hotel['lowRate'] <= $maxPrice;
        });
        $page = 0;
        $limit = 70;
    }

    // dd(count($hotels),$hotels);

    // Filter by rating
    if ($request->filled('Cri_Rating')) {
    	// dd(1);
        $Cri_Rating = array_filter(explode(",", $request->input('Cri_Rating')));
        $hotels = $hotels->filter(function ($hotel) use ($Cri_Rating) {
            return in_array($hotel['hotelRating'], $Cri_Rating);
        });
        $page = 0;
        $limit = 70;
        // dd(count($hotels));
    }
    // dd(count($hotels));

    // Filter by board type
    if ($request->filled('Cri_board')) {
        $Cri_board = array_filter(explode(",", $request->input('Cri_board')));
        $hotels = $hotels->filter(function ($hotel) use ($Cri_board) {
            return in_array($hotel['boardName'], $Cri_board);
        });
    }

    // Filter by product type
    if ($request->filled('Cri_product')) {
        $Cri_product = array_filter(explode(",", $request->input('Cri_product')));
        $hotels = $hotels->filter(function ($hotel) use ($Cri_product) {
            return in_array($hotel['product'], $Cri_product);
        });
    }

    // Filter by accommodation type
    if ($request->filled('accommodationType')) {
        $accommodationTypes = array_filter(explode(",", $request->input('accommodationType')));
        $hotels = $hotels->filter(function ($hotel) use ($accommodationTypes) {
            return in_array($hotel['accommodationTypeCode'], $accommodationTypes);
        });
    }

    // Filter by amenities
    if ($request->filled('Cri_amenity')) {
        $Cri_amenity = array_filter(explode(",", $request->input('Cri_amenity')));
        foreach ($Cri_amenity as $amenity) {
            $hotels = $hotels->filter(function ($hotel) use ($amenity) {
                return str_contains($hotel['valueAdds'], $amenity);
            });
        }
    }

    // Filter by hotel name with case variations
    if ($request->filled('hotel_name')) {
        $hotel_name = trim($request->input('hotel_name'));
        $nameVariants = [
            strtolower($hotel_name),
            ucfirst(strtolower($hotel_name)),
            strtoupper($hotel_name),
            ucwords(strtolower($hotel_name)),
            $hotel_name
        ];
        $hotels = $hotels->filter(function ($hotel) use ($nameVariants) {
            return collect($nameVariants)->contains(function ($variant) use ($hotel) {
                return stripos($hotel['Name'], $variant) !== false;
            });
        });
        $page = 0;
        $limit = 70;
    }

    // Apply sorting
 if($request["sortVal"]!=""){
    $sortValArr = explode('_', $request->input("sortVal"));
    $sortField = $sortValArr[0];
    $sortDirection = strtolower($sortValArr[1]) === 'desc' ? 'desc' : 'asc';
    $hotels = $hotels->sortBy($sortField, SORT_REGULAR, $sortDirection === 'desc');
}

    // Paginate results
    $totalcount = $hotels->count();
    $hotels = $hotels->slice($page, $limit);

    // Initialize the admin model
    $admin_model_obj = new \App\Models\CommonFunctionModel;
    $toCurrencyRate = $admin_model_obj->getFromToCurrencyRate(1.00, 'USD', 'USD');
   	$datatype=''; $promoDescription=''; $isFavourate=''; $hotelFlight=''; $policyMatch=''; $inpolicy=''; $apply_rule_on=''; $currentAllotment='';


  // dd(count($hotels),$hotels);
    // Build response data
    foreach ($hotels as $hotel) {
    	// dd($hotel['lowRate'],$hotel['thumbNailUrl']);
              $OfferedPriceRoundedOff = $admin_model_obj->displayFinalRates(@$hotel['lowRate'], $toCurrencyRate);
                //dd($original_single_price,$OfferedPriceRoundedOff);
                $single_price = (($OfferedPriceRoundedOff) * 2);
                $wholesale_price = ($single_price / 2);
                $free_with_amples = 0.00;
                $no_of_amples = 0.00;
                $discount_price = 0.00;
                $discount = 0.00;
                $FinalTextAmount = 0.00;
                $calculateDiscount = ((($single_price - $wholesale_price) * 100) / $single_price);
                $discount = round($calculateDiscount, 2);
                $discount_price = (($single_price * $discount) / 100);
                $discount_margin = $discount_price;
                $buyandearnamples = ($discount_margin / .12);
                $no_of_amples = $buyandearnamples;
                $buyandearn=$admin_model_obj->DisplayAmplePoints($no_of_amples);
                 $reward=$discount_price;
                 $youearn=$discount."%";

                 $free_with_amples = ($single_price / .12);
                 $free=$admin_model_obj->DisplayAmplePoints($free_with_amples);

      $data['result'][] = [
		    'free' => $admin_model_obj->DisplayAmplePoints($free_with_amples),
            'buyandearn' => $admin_model_obj->DisplayAmplePoints($buyandearnamples),
            'reward' => $discount_price,
            'youearn' => $discount . "%",
            'no_of_amples' => $buyandearnamples,
            'tid' => @$hotel['EANHotelID'],
            'total' => $totalcount,
            'Name' => @$hotel['Name'],
            'thumbnail'=>@$hotel['thumbNailUrl'],
            'StarRating' => round((int)@$hotel['hotelRating']),
            'LowRate' => @$hotel['lowRate'],
            'HighRate' => round((int)@$hotel['highRate'], 0),
            'Latitude' => @$hotel['latitude'],
            'Longitude' => @$hotel['longitude'],
            'Address1' => @$hotel['address1'],
		    'Address2' => @$hotel['address2'], // If you have this field


		    'City' => @$hotel['city'],
		    'locationDescription' => @$hotel['locationDescription'], // Add if exists
		    'LowRate' => @$hotel['lowRate'],
		    'currency_symbol' => $this->currency_symbol, // Assuming you have this method
		    'HighRate' => round((int)@$hotel['highRate'], 0),
		    'discount_price' => @$hotel['discount_price'], // Assuming this exists
		    'nonRefundable' => @$hotel['nonRefundable'], // If applicable
		    'currentAllotment' => $currentAllotment, // Assuming you have this value
		    'is_custom' => @$hotel['is_custom'],
		    'isActive' => @$hotel['isActive'],
		    'isFavourate' => $isFavourate, // Add logic to set this as needed
		    'hotelFlight' => $hotelFlight, // If you have this logic
		    'policyMatch' => $policyMatch, // Assuming you have this variable set
		    'inpolicy' => $inpolicy, // Assuming you have this variable set
		    'apply_rule_on' => $apply_rule_on, // Assuming you have this variable set
		    'boardName' => @$hotel['boardName'],
		    'recommended' => @$hotel['recommended'], // If applicable
		    'selling_points' => @$hotel['selling_points'], // If applicable
		    'valueAdds' => explode(',', @$hotel['valueAdds']), // Assuming this is a comma-separated list
		    'product' => @$hotel['product'],
		    'accommodationType' => @$hotel['accommodationTypeCode'],
		    // Add other fields as needed based on your database structure
        ];

    }
    // dd($data);


    return response()->json($data);
}

















// // getControls Start	
// 	public function getControls(Request $request){
		
// 	$search_id=$request['search_id'];
// 	$moreCod =" and lowRate >0 ";
	
// 	$pre_sql =DB::select("SELECT count(Eanhotelid) as totalrecords FROM search_results_hotelbeds WHERE search_session='".$search_id."' $moreCod ");
// 	$obj = $pre_sql[0];
	
// 	$pre_sql1 =DB::select("select count(Eanhotelid) as stars5 from search_results_hotelbeds where search_session='".$search_id."' $moreCod and hotelRating IN(4.5,5.0)");
// 	$obj1 = $pre_sql1[0];
	
// 	$pre_sql2 =DB::select("select count(Eanhotelid) as stars4 from search_results_hotelbeds where search_session='".$search_id."' $moreCod and hotelRating IN(3.5,4.0)");
// 	$obj2 =$pre_sql2[0];
	
// 	$pre_sql3 =DB::select("select count(Eanhotelid) as stars3 from search_results_hotelbeds where search_session='".$search_id."' $moreCod and hotelRating IN(2.5,3.0)");
// 	$obj3 =$pre_sql3[0];
	
// 	$pre_sql4 =DB::select("select count(Eanhotelid) as stars2 from search_results_hotelbeds where search_session='".$search_id."' $moreCod and hotelRating IN(1.5,2.0)");
// 	$obj4 =$pre_sql4[0];
	
// 	$pre_sql5 =DB::select("select count(Eanhotelid) as stars1 from search_results_hotelbeds where search_session='".$search_id."' $moreCod and hotelRating IN('1.0') ");
// 	$obj5 =$pre_sql5[0];
	
// 	$pre_sql6 =DB::select("select count(Eanhotelid) as stars0 from search_results_hotelbeds where search_session='".$search_id."' $moreCod and hotelRating IN('0.0') ");
// 	$obj6 =$pre_sql6[0];


// 	$pre_sql7 =DB::select("select valueAdds from search_results_hotelbeds where search_session='".$search_id."' $moreCod  ");
// 	$amenityStr='';
// 	foreach($pre_sql7 as $obj7){ 
// 			$amenityStr.=$obj7->valueAdds.',';
// 	}
// 	$amenities =explode(',',$amenityStr);
// 	$amenityArr =array_filter(array_unique($amenities)); 
// 	$ami=array();
// 	foreach($amenityArr as $val){ $ami[]=array('val'=>$val); }
	
// 	/*=== Board Name ===*/
// 	$boardNameArr =array();
// 	$results =DB::select("select distinct boardName from search_results_hotelbeds WHERE search_session='".$search_id."' ");
// 	foreach($results as $bObj){ 
// 	 $boardNameArr[]=array('name'=>$bObj->boardName,'display_name'=>$bObj->boardName); 
// 	}
	
// 	/*=== Product Name ===*/
// 	$productArr =array();
// 	$results =DB::select("select distinct product from search_results_hotelbeds WHERE search_session='".$search_id."' ");
// 	foreach($results as $bObj){ 
// 	 $productArr[]=array('name'=>$bObj->product,'display_name'=>$bObj->product); 
// 	}
	
// 	/*=== accommodationType  ===*/
// 	$accommodationTypeArr =array();
// 	$results =DB::select("select distinct accommodationTypeCode from search_results_hotelbeds WHERE search_session='".$search_id."' ");
// 	foreach($results as $bObj){ 
// 	 $accommodationTypeArr[]=array('name'=>$bObj->accommodationTypeCode,'display_name'=>$bObj->accommodationTypeCode); 
// 	}



// 	$pre_sql12 =DB::select("select MIN(lowRate) as minrate,MAX(lowRate) as maxrate,MIN(tripAdvisorRating) as minguest,MAX(tripAdvisorRating) as maxguest from search_results_hotelbeds WHERE search_session='".$search_id."' $moreCod  ");
// 	$obj12 =$pre_sql12[0];
	
// 	//'distance5'=>$obj8->distance5,'distance10'=>$obj9->distance10,'distance20'=>$obj10->distance20,'distance50'=>$obj11->distance50,'distance2'=>$obj7->distance2,
// 	$activePropertyCount='12';
// 	$data =array('totalrecords'=>$obj->totalrecords,'stars5'=>$obj1->stars5,'stars4'=>$obj2->stars4,'stars3'=>$obj3->stars3,'stars2'=>$obj4->stars2,'stars1'=>$obj5->stars1,'stars0'=>$obj6->stars0,'minrate'=>floor($obj12->minrate)*2,'maxrate'=>ceil($obj12->maxrate)*2,'minguest'=>floor($obj12->minguest),'maxguest'=>ceil($obj12->maxguest), 'activePropertyCount'=>$activePropertyCount,'boardName'=>$boardNameArr,'product'=>$productArr,'accommodationType'=>$accommodationTypeArr,'amenityArr'=>$ami,'currency_symbol'=>$this->currency_symbol);
// 	echo json_encode($data);

// 	}
// getControls End	







// getControls_New Start	
public function getControls_New(Request $request)
{
    $search_id = $request['search_id'];
    $moreCod = function ($hotel) {
        return $hotel['lowRate'] > 0;
    };

    // Retrieve session data
    $sessionData = session()->get('hotel_data', []);

    // Filter data based on `search_id` and `$moreCod` logic
    $filteredHotels = array_filter($sessionData, function ($hotel) use ($search_id, $moreCod) {
        return $hotel['search_session'] === $search_id && $moreCod($hotel);
    });

    // Calculate counts for star ratings
    $starCounts = [
        'stars5' => count(array_filter($filteredHotels, fn($hotel) => in_array($hotel['hotelRating'], [5.0, 5.1]))),
        'stars4' => count(array_filter($filteredHotels, fn($hotel) => in_array($hotel['hotelRating'], [3.5, 4.0]))),
        'stars3' => count(array_filter($filteredHotels, fn($hotel) => in_array($hotel['hotelRating'], [2.5, 3.0]))),
        'stars2' => count(array_filter($filteredHotels, fn($hotel) => in_array($hotel['hotelRating'], [1.5, 2.0]))),
        'stars1' => count(array_filter($filteredHotels, fn($hotel) => in_array($hotel['hotelRating'], [1.0]))),
        'stars0' => count(array_filter($filteredHotels, fn($hotel) => in_array($hotel['hotelRating'], [0.0]))),
    ];

    // Aggregate amenities
    $amenityStr = implode(',', array_column($filteredHotels, 'valueAdds'));
    $amenities = array_filter(array_unique(explode(',', $amenityStr)));
    $ami = array_map(fn($val) => ['val' => $val], $amenities);

    // Board names
    $boardNameArr = array_map(
        fn($boardName) => ['name' => $boardName, 'display_name' => $boardName],
        array_unique(array_column($filteredHotels, 'boardName'))
    );

    // Product names
    $productArr = array_map(
        fn($product) => ['name' => $product, 'display_name' => $product],
        array_unique(array_column($filteredHotels, 'product'))
    );

    // Accommodation types
    $accommodationTypeArr = array_map(
        fn($type) => ['name' => $type, 'display_name' => $type],
        array_unique(array_column($filteredHotels, 'accommodationTypeCode'))
    );

    // Min and Max values for rates and ratings
    $rates = array_column($filteredHotels, 'lowRate');
    $guestRatings = array_column($filteredHotels, 'tripAdvisorRating');
    $minRate = floor(min($rates)) * 2;
    $maxRate = ceil(max($rates)) * 2;
    $minGuest = floor(min($guestRatings));
    $maxGuest = ceil(max($guestRatings));

    $activePropertyCount = count($filteredHotels);

    // Response structure
    $data = array_merge(
        ['totalrecords' => $activePropertyCount],
        $starCounts,
        [
            'minrate' => $minRate,
            'maxrate' => $maxRate,
            'minguest' => $minGuest,
            'maxguest' => $maxGuest,
            'activePropertyCount' => $activePropertyCount,
            'boardName' => $boardNameArr,
            'product' => $productArr,
            'accommodationType' => $accommodationTypeArr,
            'amenityArr' => $ami,
            'currency_symbol' => $this->currency_symbol,
        ]
    );

    return response()->json($data);
}

// getControls_New End	


















	
// HotelFinalCheckout Start	
	public function HotelFinalCheckout(Request $request)  
    {
    	// dd($request->all(),$request['passenger']['adult'],$request->roomName[0]);       

		$request_data=array();
		$request_data=$request->input();


		
		$hotelSearchData=crud_model::readOne('search_results_hotelbeds',array('id'=>$request->input('ref_id'))); 
		$rooms=$hotelSearchData->rooms;
				
		$EANHotelID[]=$request_data['EANHotelID'];
		
		$total_amount=$request_data['apiPrice'];
		$total_currency=$request_data['currency'];
		 
	 $adultArr =json_decode($hotelSearchData->Cri_Adults,true);
	 $adultArr = explode(',', $adultArr);
	 $childArr =json_decode($hotelSearchData->Cri_Childs,true);
	 $childArr = explode(',', $childArr);
	 $childAgeArr =json_decode($hotelSearchData->child_age,true);
	  $rateKeyArr =$request_data['rateKey'];
	  // dd($rateKeyArr);
	  // dd($adultArr);
	for($i=0;$i<$rooms;$i++){
	 $paxes =array();	
	 $roomId =1;	
	 $adults =$adultArr[$i];
	 $childs =$childArr[$i];
	 
	 for($a=0;$a<1;$a++){
	  // $titles =$request_data['passenger']['adult']['title'][$i][$a];
	  $fname =$request_data['passenger']['adult']['first_name'][$i][$a];	
      $lname =$request_data['passenger']['adult']['last_name'][$i][$a];	  
	  $paxes[] =array('roomId'=>$roomId,'type'=>'AD','name'=>$fname,'surname'=>$lname);
	 }
	 for($c=0;$c<$childs;$c++){
	  // $titles =$request_data['passenger']['child']['title'][$i][$c];
	  // $fname =$request_data['passenger']['child']['first_name'][$i][$c];	
      // $lname =$request_data['passenger']['child']['last_name'][$i][$c];	 
	  $paxes[] =array('roomId'=>$roomId,'type'=>'CH',/*'name'=>$fname,'surname'=>$lname*/);
	 }
	 
	 $rateKey =nl2br(trim($rateKeyArr[$i]));
	 $roomsArr[] =array('rateKey'=>$rateKey,'paxes'=>$paxes);
	}
	// dd(count($adultArr),$adults);
		$firstName=$request_data['passenger']['adult']['first_name'][0][0];
		$lastName=$request_data['passenger']['adult']['last_name'][0][0];
		$username=$firstName.' '.$lastName;
		$order_id=strtoupper(uniqid());
		
		$booking_mode='Test';
		$paymentType=$request_data['paymentType'];
		
		$Tolerance='';
		$isTolerance='Yes';   
		if($isTolerance=='Yes'){
		$Tolerance ='2';  
		}
		
    if($paymentType=='AT_HOTEL'){
	#$actionUrl='https://api-secure.test.hotelbeds.com/hotel-api/1.0/bookings';	
	$postArr =array('holder'=>array('name'=>$firstName,'surname'=>$lastName),
					'rooms'=>$roomsArr,
					'paymentData'=>array('paymentCard'=>array('cardHolderName'=>$creditCardFirstName.' '.$creditCardLastName,'cardType'=>$creditCardType,'cardNumber'=>$creditCardNumber,'expiryDate'=>$CardExpiryDate,'cardCVC'=>$creditCardIdentifier),
										 'contactData'=>array('email'=>'integration@test.com','phoneNumber'=>'654654654'), 
										 ),
					'clientReference'=>$order_id,
					'remark'=>"Booking remarks are to be written here.",
					'tolerance'=>$Tolerance			
					);
	}
	else{
	#$actionUrl='https://api.test.hotelbeds.com/hotel-api/1.0/bookings';	
	$postArr =array('holder'=>array('name'=>$firstName,'surname'=>$lastName),
					'rooms'=>$roomsArr,
					'clientReference'=>$order_id,
					'remark'=>"No Remark.",
					'tolerance'=>$Tolerance			
					);	
	}
    $request_xml = json_encode($postArr);
	$user_id=$request_data['user_id'];
	if($user_id==''){
			$user_id=$this->createUser($firstName,$lastName,$request_data['passenger']['email'],$request_data['passenger']['phone'],$request_data['passenger']['address'],$request_data['passenger']['country'],$request_data['passenger']['country']);
		}
				$hotelRating=$hotelSearchData->hotelRating;
				if($hotelRating==''){ $hotelRating=0.0; }
		$data=array(
		'order_id'=>$order_id,
		'booking_status'=>'Pending',
		'hotel_img'=>$hotelSearchData->thumbNailUrl,
		'hotel_id'=>$hotelSearchData->EANHotelID,
		'hotelName'=>$hotelSearchData->Name,
		'hotelRating'=>$hotelRating,
		'hotelAddress'=>$hotelSearchData->address1,
		'hotelCity'=>$hotelSearchData->city,
		'hotelCountryCode'=>$hotelSearchData->countryCode,
		'user_name'=>$username,
		'login_id'=>$user_id,
		'user_id'=>$user_id,
		'user_email'=>$request_data['passenger']['email'],
		'user_contactno'=>$request_data['passenger']['phone'],
		'request_xml'=>$request_xml,
		'check_in'=>$hotelSearchData->checkin,
		'check_out'=>$hotelSearchData->checkout,
		'chargable_rate'=>$request_data['chargeableRate'],
		'adh_chargable'=>$request_data['chargeableRate'],
		'currency_code'=>$request_data['currency'],
		'api_currency'=>$request_data['api_currency'],
		'api_price'=>$request_data['apiPrice'],
		'language'=>'en',
		'rooms'=>$hotelSearchData->rooms,
		'adults'=>$hotelSearchData->Cri_Adults,
		'children'=>$hotelSearchData->Cri_Childs,
		'booking_mode'=>$booking_mode,
		'payment_status'=>'Pendind',
		'product'=>'hotel',
		'supplier'=>$hotelSearchData->product,
		'PaymentType'=>json_encode($paymentType),
		'date_time'=>date('Y-m-d H:i:s'),
		'payment_type'=>json_encode($paymentType),
		'booking_checksum'=>'',
		'IsPayLater'=>'',
		'txn_number'=>'',
		'fb_email'=>'',
		'response_xml'=>'',
		'checkInInstructions'=>'',
		'rest_data'=>'',
		'propertyCategory'=>0,
		'itineraryId'=>'',
		'confirmationNumbers'=>'',
		'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
		'ip_address'=>$_SERVER['REMOTE_ADDR'],
		'booked_ample' =>$request->booked_ample,
		);
		$value = Crud_Model::insertData('twc_booking',$data);

// dd(3);

	
	for($i=0;$i<$rooms;$i++){
	 $paxes =array();	
	 $roomId =1;	
	 $adults =$adultArr[$i];
	 
	 for($a=0;$a<1;$a++){  //$adults 
      $data = [
		        	'room_no'=>$i+1,
		        	'room_name'=>$request->roomName[$i],
		        	'order_id'=>$order_id,
			        'fname' => $request_data['passenger']['adult']['first_name'][$i][$a],
			        'lname' => $request_data['passenger']['adult']['last_name'][$i][$a],
			        // 'dob' => $request_data['passenger']['adult']['dob'][$i][$a],
			        // 'title' => $request_data['passenger']['adult']['title'][$i][$a],
			        // 'gender' => $request_data['passenger']['adult']['gender'][$i][$a],
			        'updated_at' => now()
			    ];

			    // Insert data into the table
			    DB::table('hotel_book_adults')->insert($data);
	 }
	
	}
		

		$redirect_page=url('/')."/travel/payment/".$request_data['payment_type']."/?order_id=".$order_id."&module=hotel";

		if($request_data['payment_type']=='wallet'){
			$return=$this->WalletDeduct($request_data['chargeableRate'],$request_data['api_currency'],$user_id,$order_id);
			$redirect_page=url('/')."/book-hotel?order_id=".$order_id;
		}
		
		
		//Crud_Model::updateData('twc_booking',array('payment_status'=>'Confirmed'),array('order_id'=>$order_id));
		// $redirect_page=url('/')."/book-hotel?order_id=".$order_id; //****************
		// dd( @Auth::user()->id);

		 return redirect()->route('processcheckoutpayment', ['order_id' => $order_id, 'user_id' => @Auth::user()->user_id]);
		
		// dd($request->all(),$paymentType);
		// return redirect($redirect_page); //****************
	}
// HotelFinalCheckout End
	









	public function processcheckoutpayment($order_id,$user_id){
    // dd($transaction_id,$user_id);
        $bookingDetails=DB::table('twc_booking')->where('order_id',$order_id)->first();
        $totaldata = $bookingDetails->chargable_rate;

        // Passing data to the view
        return view('payment.payment', [
            'totaldata' => $totaldata,
            'orderDetail' => $bookingDetails,
        ]);
}












 public function createstrippayment(Request $request)
    {
           // dd($request->all());
            // This is your test Secret API key.

           //$stripe = new \Stripe\StripeClient("sk_test_51NpOZ4GY4n5u6WbIGKHcQBoih6sUZRXtG2a3qWq6NKqOMLrdPSo1DElWPfc0N4cBMrYLYmlUj25gqGHn1tmlmkoL00kNdf7OkS");

            // This is your Live Secret API key.

            // $stripe = new \Stripe\StripeClient("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");


        // Ensure you have your Stripe API key set in your .env file
        $stripe = new StripeClient("sk_test_51NpOZ4GY4n5u6WbIGKHcQBoih6sUZRXtG2a3qWq6NKqOMLrdPSo1DElWPfc0N4cBMrYLYmlUj25gqGHn1tmlmkoL00kNdf7OkS");

        try {
            // Retrieve JSON from POST body
            $jsonObj = json_decode($request->getContent());

            $totalAmount = $jsonObj->total_amount;
            $order_id = $jsonObj->order_id;
            $customer_id = $jsonObj->customer_id;
            $customer_name = $jsonObj->customer_name;

            $finalAmount = round($totalAmount) * 100;

            // Create a PaymentIntent with amount and currency
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $finalAmount,
                'currency' => 'usd',
                'description' => "Payment for Amplepoints Order ID $order_id",
                'metadata' => [
                    'order_id' => $order_id,
                    'customer_id' => $customer_id,
                    'customer_name' => $customer_name,
                    'payment_from' => 'Amplepoints',
                ],
            ]);

            return response()->json(['clientSecret' => $paymentIntent->client_secret]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }













     public function stripeorderstatus($order_id,$customer_id,Request $request){
        // dd($order_id,$customer_id,$request->all());
       

        $order_id = $order_id;
        $customer_id = $customer_id;
        $payment_intent = $request->payment_intent;
        $payment_intent_client_secret = $request->payment_intent_client_secret;
        $redirect_status = $request->redirect_status;

        // dd($data,$order_id,$customer_id,$payment_intent,$payment_intent_client_secret,$redirect_status,$request->all());
       // dd(1);
        if (isset($redirect_status) && $redirect_status == 'succeeded') {

        	Crud_Model::updateData('twc_booking',array('payment_status'=>'Confirmed','payment_intent'=>$payment_intent),array('order_id'=>$order_id));
        	$redirect_page=url('/')."/book-hotel?order_id=".$order_id; 
        	return redirect($redirect_page);

    
           // $paymentDetail = array(
           //      'payment_intent' => $payment_intent,
           //      'payment_intent_client_secret' => $payment_intent_client_secret,
           //      'redirect_status' => $redirect_status
           //  );

        } else {
            // $this->_redirect("/ordersuccess/msg/2/order_id/$order_id/user_id/$customer_id");
            dd("payment not done");
        }

    }
















// Book Hotel Start 
	public function BookHotel(Request $request){
		// dd($request->all());// *********************

		// =================================================
		$bookingDetails=DB::table('twc_booking')->where('order_id',$request->order_id)->first();

		// dd($bookingDetails->chargable_rate);

		 $admin_model_obj = new \App\Models\CommonFunctionModel;
        $toCurrencyRate = $admin_model_obj->getFromToCurrencyRate(1.00,'USD', 'USD');
        $original_single_price = (int)$bookingDetails->chargable_rate;
        $OfferedPriceRoundedOff = $admin_model_obj->displayFinalRates((int)$bookingDetails->chargable_rate, $toCurrencyRate);

        //dd($original_single_price,$OfferedPriceRoundedOff);
        $single_price = (($OfferedPriceRoundedOff) * 2);
        $wholesale_price = ($single_price / 2);
        $free_with_amples = 0.00;
        $no_of_amples = 0.00;
        $discount_price = 0.00;
        $discount = 0.00;
        $FinalTextAmount = 0.00;
        $calculateDiscount = ((($single_price - $wholesale_price) * 100) / $single_price);
        $discount = round($calculateDiscount, 2);
        $discount_price = (($single_price * $discount) / 100);
        $discount_margin = $discount_price;
        $buyandearnamples = ($discount_margin / .12);
        $no_of_amples = $buyandearnamples;
        // dd( $no_of_amples);
        if(@Auth::user()->user_id || Session::get('user_id') ){
        	// dd(1);
        	//update ample
        	$userDetail = User::where('user_id', @Auth::user()->user_id)
		    ->orWhere('user_id', Session::get('user_id'))
		    ->first();
		    // dd($userDetail);
		    // dd((int)($userDetail->total_ample) , round($no_of_amples), (int)$bookingDetails->booked_ample);
		    if(@$userDetail->total_ample){
		    	$newAmple=(int)($userDetail->total_ample) + round($no_of_amples)-(int)@$bookingDetails->booked_ample;
		    }else{
                $newAmple=round($no_of_amples)-(int)@$bookingDetails->booked_ample;
		    }
        	
        	$up=User::where('user_id', @Auth::user()->user_id)->orWhere('user_id', Session::get('user_id'))->update(['total_ample'=>$newAmple]);
        }

        // dd($request->input(),round($no_of_amples),$request->chargeableRate,$request->user_id);

		// =================================================
	$request_data=$request->input('');  
	   $order_id=$request->input('order_id');
	   $hotel_book_req=crud_model::readOne('twc_booking',array('order_id'=>$request['order_id']));
	   $request_xml=$hotel_book_req->request_xml;
	   $payment_status=$hotel_book_req->payment_status;
	   // dd($request->all(),$paymentType);
	   
	   if($payment_status=='Confirmed'){
	   $bookingMode='Live';  //'Test';
			if($hotel_book_req->PaymentType=='"AT_HOTEL"'){
			  if($bookingMode=='Live'){	
				$actionUrl='https://api-secure.hotelbeds.com/hotel-api/1.2/bookings';
			  }
			  else{
			   $actionUrl='https://api-secure.test.hotelbeds.com/hotel-api/1.0/bookings';	  
			  }
			 
			}
			else{
			  if($bookingMode=='Live'){	
			   $actionUrl='https://api.hotelbeds.com/hotel-api/1.2/bookings';
			  }
			  else{
			  $actionUrl='https://api.test.hotelbeds.com/hotel-api/1.0/bookings';
					  
			  }	  
			}	
	
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $actionUrl);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request_xml);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerData);
		 $contents = curl_exec($ch);
		curl_close($ch);
									
			$this->createLogFile('BookHotel-'.$request['order_id'],$request_xml,$contents);
			
			$response=json_decode($contents,true);
			// dd($response);
			
			if(isset($response['booking'])){
				$booking=$response['booking'];
				$reference=$booking['reference'];
				$booking_status='Confirmed';
				$api_booking_status=$booking['status']; 
				$error='';
			}else if(isset($response['error'])){
				$booking='';
				$reference='';
				$booking_status='Failed';
				$api_booking_status='Error';
				$error=$response['error']['code'].'-'.$response['error']['message'];
			}
			else
			{
				$booking='';
				$reference='';
				$booking_status='Failed';
				$api_booking_status='Error';
				$error='UnLnown Error';
			}
			
		    $data=array(
				'response_xml'=>$contents,
				'itineraryId'=>$reference,
				'booking_status'=>$booking_status,
				'error_message'=>$error,
			);
			Crud_Model::updateData('twc_booking',$data,array('order_id'=>$order_id));			
			
		}
		
		return redirect('/hotel-confirmation/'.base64_encode($order_id));	
	
 }
// Book Hotel end	
















// Cancel Hotel Start 
	public function BookingCancellation(Request $request){

		$obj=crud_model::readOne('twc_booking',array('order_id'=>$request['order_id']));
	    $itineraryId=$obj->itineraryId;

		$actionUrl=$this->endpoint.'/bookings/'.$itineraryId.'?cancellationFlag=CANCELLATION';
		$booking_status='Cancelled Pending';
		$return=array('error'=>'No','msg'=>'Cancellation Request Successfully Send To Admin.');
		
		
		$data=array(
				'booking_status'=>$booking_status,
				'cancelled_by'=>session()->get('user_id'),
				'cancellationNumber'=>rand(),
				'cancellation_date'=>date('Y-m-d H:i:s'),
				'cancellation_request'=>$actionUrl,	
				'cancellation_response'=>"Customer Request",
			 );
	    Crud_Model::updateData('twc_booking',$data,array('order_id'=>$request['order_id']));
		echo json_encode($return);		
	
	}
// Cancel Hotel end	



	public function BookingCancellationFD($id){
		// dd($id);
		$obj=crud_model::readOne('twc_booking',array('order_id'=>$id));
	    $itineraryId=$obj->itineraryId;

		$actionUrl=$this->endpoint.'/bookings/'.$itineraryId.'?cancellationFlag=CANCELLATION';
		$booking_status='Cancelled Pending';
		$return=array('error'=>'No','msg'=>'Cancellation Request Successfully Send To Admin.');
		
		
		$data=array(
				'booking_status'=>$booking_status,
				'cancelled_by'=>session()->get('user_id'),
				'cancellationNumber'=>rand(),
				'cancellation_date'=>date('Y-m-d H:i:s'),
				'cancellation_request'=>$actionUrl,	
				'cancellation_response'=>"Customer Request",
			 );
	    Crud_Model::updateData('twc_booking',$data,array('order_id'=>$id));
		return back()->with('success','Cancellation Request Successfully Send To Admin.');
	}








public function BookingCancellationFromAdmin($id){
	  // dd($id);

		$obj=crud_model::readOne('twc_booking',array('order_id'=>$id));
	    $itineraryId=$obj->itineraryId;
	
		$actionUrl=$this->endpoint.'/bookings/'.$itineraryId.'?cancellationFlag=CANCELLATION';

		// dd($obj,$itineraryId,$actionUrl);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $actionUrl);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerData);
		$content = curl_exec($ch);
		curl_close($ch);
		$this->createLogFile('Cancelled-'.$id,$actionUrl,$content);
		$res=json_decode($content,true);
		// dd($res);
		if(isset($res['error'])){ 
			$return=array('error'=>'Yes','msg'=>$res['error']['message']); 
			$booking_status=$obj->booking_status;
		}
		else {
			  	$responseData = $res['booking'];
				$ResponseStatus = $responseData['status'];
				$booking_status='Cancelled';
				$return=array('error'=>'No','msg'=>'Cancellation Successfully.');
		}
		
		$data=array(
				'booking_status'=>$booking_status,
				'cancelled_by'=>session()->get('user_id'),
				'cancellationNumber'=>rand(),
				'cancellation_date'=>date('Y-m-d H:i:s'),
				'cancellation_request'=>$actionUrl,	
				'cancellation_response'=>$content,
			 );
	    Crud_Model::updateData('twc_booking',$data,array('order_id'=>$id));


	    // =========================================================
	    $bookingDetails=DB::table('twc_booking')->where('order_id',$id)->first();
	    // dd($bookingDetails,$data);

		// dd($bookingDetails->chargable_rate);

		 $admin_model_obj = new \App\Models\CommonFunctionModel;
        $toCurrencyRate = $admin_model_obj->getFromToCurrencyRate(1.00,'USD', 'USD');
        $original_single_price = (int)$bookingDetails->chargable_rate;
        $OfferedPriceRoundedOff = $admin_model_obj->displayFinalRates((int)$bookingDetails->chargable_rate, $toCurrencyRate);

        //dd($original_single_price,$OfferedPriceRoundedOff);
        $single_price = (($OfferedPriceRoundedOff) * 2);
        $wholesale_price = ($single_price / 2);
        $free_with_amples = 0.00;
        $no_of_amples = 0.00;
        $discount_price = 0.00;
        $discount = 0.00;
        $FinalTextAmount = 0.00;
        $calculateDiscount = ((($single_price - $wholesale_price) * 100) / $single_price);
        $discount = round($calculateDiscount, 2);
        $discount_price = (($single_price * $discount) / 100);
        $discount_margin = $discount_price;
        $buyandearnamples = ($discount_margin / .12);
        $no_of_amples = $buyandearnamples;
        // dd( $no_of_amples);
        if(@$bookingDetails->user_id){
        	// dd(1);
        	//update ample
        	$userDetail = User::where('user_id', $bookingDetails->user_id)
		    ->first();
		    // dd($userDetail);
		    // dd((int)($userDetail->total_ample) , round($no_of_amples), (int)$bookingDetails->booked_ample);
		     if( @$userDetail->total_ample < round($no_of_amples)){
		    	return back()->with('error','This request can not be cancel as user account amplepoint is less that that of booking reward ample and we can not deduct that reward ample from user account due to less account amplepoints. when user will have sufficient amplepoints to deduct that reward ample , at that time this requst can be cancel.');
		    }
		    
		    if(@$userDetail->total_ample){
		    	$newAmple=(int)($userDetail->total_ample) - round($no_of_amples)+(int)@$bookingDetails->booked_ample;
		    }else{
                $newAmple= - round($no_of_amples)+(int)@$bookingDetails->booked_ample;
		    }
        	
        	$up=User::where('user_id', $bookingDetails->user_id)->update(['total_ample'=>$newAmple]);
        }

        // dd($request->input(),round($no_of_amples),$request->chargeableRate,$request->user_id);

		

		 // $stripe = new StripeClient("sk_test_51NpOZ4GY4n5u6WbIGKHcQBoih6sUZRXtG2a3qWq6NKqOMLrdPSo1DElWPfc0N4cBMrYLYmlUj25gqGHn1tmlmkoL00kNdf7OkS");

		//refund code 
		 // $refund = $stripe->refunds->create([
   //      'payment_intent' => $bookingDetails->payment_intent,
   //      ]);
	   // dd($refund);

        // =================================================
		// echo json_encode($return);	
		// dd($res);
		return back()->with('success','Order Cancel Successfully');	
}
















	public function RoomAvailability(Request $request){	
		// dd($request->all());
		$obj = crud_model::readOne('search_results_hotelbeds',array('id'=>$_REQUEST['tid']));
		$obj->hotelDetails;
		$hotelData =json_decode($obj->hotelDetails,true);
		// dd($request->all(),$hotelData);
		
		$api_currency =$hotelData['currency'];
		$RoomTypes =$hotelData['rooms'];
		
		$RoomConbination =$this->ManageRoomType($request['rooms'],json_decode($request['adults'],true),json_decode($request['childs'],true),$api_currency,$RoomTypes);

		// dd(count($RoomConbination),$RoomConbination);
		
		 $SelectedRoom=array();
		 
		 //selected Room Work Start
		 if( ( $request['boardCode'])!='' && ( $request['rateClass']!='') ){
			 $boardCode =$request['boardCode'];
			 $rateClass =$request['rateClass'];
			 $roomCodeArr =explode('~~~~',$request['roomCodeIds']);
			 
			 for($i=0;$i<count($RoomConbination);$i++){
					$ratesArr =$RoomConbination[$i]['rates'][$boardCode][$rateClass];
					$checkMatch=0;
					if(is_array($ratesArr)){
						foreach($ratesArr as $rates){
						  if(!in_array($rates['code'],$roomCodeArr)){
							$checkMatch=1;
							break;				
						  } 	
						}
					}
				   if($checkMatch==0){
					$SelectedRoom =$ratesArr;
					break;			
				   }	
				 }
		  }


		 /////// Check RECHEK//
	     if(is_countable($SelectedRoom)){
			   if(count($SelectedRoom)>0){	
					for($i=0;$i<count($SelectedRoom);$i++){
					  $rateType =$SelectedRoom[$i]['rates']['rateType'];
					  $rateKey =$SelectedRoom[$i]['rates']['rateKey'];
					  $old_net =$SelectedRoom[$i]['rates']['net'];
					  $a=$this->CheckRates($rateKey);
					  // dd($a);

					  if($rateType=='RECHECK'){ 
						$results =$this->CheckRates($rateKey);
				// 		dd($results);
						if(count($results)!==0){
				// 		$cResponse =json_decode($results,true);	
						$cResponse =$results;	
						$api_currency =$cResponse['RateResponse']['currency'];		
						$crateKey =$cResponse['RateResponse']['rooms'][0]['rates'][0]['rateKey'];
						if($crateKey!=''){
						  $rates=$cResponse['RateResponse']['rooms'][0]['rates'][0];
						  /*$net =$rates['net'];
						  
						  $rates['old_net'] =$old_net;
						  $rates['net'] = $net;*/  
						  
						  $base_price_in_live_currency =  $this->markupObj->convertCurrencyRate($api_currency,$rates['net']);
						  $adminPrice=$this->markupObj->calAdminPrice($base_price_in_live_currency,'hotel');
						  $TotalFare=$adminPrice;
						  $agentPrice=0;
						  if(session()->get('user_type')=='agent'){
								$agentPrice=$this->markupObj->calAgentPrice($adminPrice,'hotel');
								$TotalFare=$agentPrice;
						  }
						  $rates['api_price'] = $rates['net'];
						  $rates['base_price_in_live_currency'] = $base_price_in_live_currency;
						  $rates['adminPrice'] = $adminPrice;
						  $rates['net'] = $TotalFare;
	
						  $SelectedRoom[$i]['rates'] =$rates;
						}
					   }// endif
					  }////
					}
					$obj = crud_model::readOne('search_results_hotelbeds',array('id'=>$_REQUEST['tid'])); 
					$selectObj=crud_model::readByCondition('selected_room',array('search_session'=>$_REQUEST['search_session'])); 
					//echo "<pre>"; print_r($selectObj);
					$data_1=array(
						'search_session'=>$_REQUEST['search_session'],
						'tid'=>$_REQUEST['tid'],
						'SelectedRoom'=>json_encode($SelectedRoom),
						'date_time'=>date('Y-m-d H:i:s'),
						'search_data'=>json_encode($obj),
					);
					if(isset($selectObj[0])){ 
						$value = Crud_Model::updateData('selected_room',$data_1,array('search_session'=>$_REQUEST['search_session']));
						$selectTid=$selectObj[0]->id;
					}else{ 
						$selectTid = Crud_Model::insertData('selected_room',$data_1);
					}
					
			  } 
		}


		  // dd(count($SelectedRoom));
		 //selected Room Work End	
		  $selectTid='';
		 
	   $RoomList =array('RoomTypes'=>array('size'=>count($RoomConbination),'RoomGroup'=>$RoomConbination),'SelectedRoom'=>$SelectedRoom,'selectTid'=>$selectTid);
	   $data =array('status'=>200,'status_message'=>'OK','currency'=>$this->currency,'currency_symbol'=>$this->currency_symbol,'responseData'=>$RoomList);
	   // dd($data);
	   echo json_encode($data);
}














 function ManageRoomType($rooms,$adultArr,$childrenArr,$api_currency,$RoomTypes){
  $RoomConbination =array();
  $adultArr =explode(',',$adultArr);
  $childrenArr =explode(',',$childrenArr);
  $checkArr =array();
  // dd($adultArr,$childrenArr);
  // dd($RoomTypes);	
  
// echo  json_encode($RoomTypes); die;
  if(is_countable($RoomTypes) && $RoomTypes!=''){  
	  for($m=0;$m<count($RoomTypes);$m++){
			$code=$RoomTypes[$m]['code'];
			$name=$RoomTypes[$m]['name'];
			$ratesArr=$RoomTypes[$m]['rates'];
			$boardArr=array();
			$nameArr =array();
			// room loop start		
			for($r=0;$r<$rooms;$r++){
				  $adult =$adultArr[$r];
				  // dd($adultArr[1],$rooms);
				  $children =$childrenArr[$r];	
				  if($children==''){$children=0;}
				  //rates loop start
				  // dd($adultArr,$childrenArr);
				  for($n=0;$n<count($ratesArr);$n++){
				  	  $rates = $ratesArr[$n];
					  $boardCode =$rates['boardCode'];
					  $rateClass =$rates['rateClass'];
					  $radults =$rates['adults'];
					  $rchildren =$rates['children'];
					  // dd($rates,$boardCode,$rateClass,$radults,$rchildren );
					  if($rchildren==''){$rchildren=0;}

					  if(((int)$adult==(int)$radults) && ((int)$children==(int)$rchildren) ){
					  	  
						  $base_price_in_live_currency =  $this->markupObj->convertCurrencyRate($api_currency,$rates['net']);
						  $adminPrice=$this->markupObj->calAdminPrice($base_price_in_live_currency,'hotel');
						  $TotalFare=$adminPrice;
						  $agentPrice=0;
						  if(session()->get('user_type')=='agent'){
								$agentPrice=$this->markupObj->calAgentPrice($adminPrice,'hotel');
								$TotalFare=$agentPrice;
						  }
						  $rates['api_price'] = $rates['net'];
						  $rates['base_price_in_live_currency'] = $base_price_in_live_currency;
						  $rates['adminPrice'] = $adminPrice;
						  $rates['net'] = $TotalFare;
						  
						  
						  			  
						  $rateClass ="NOR";
						  if(isset($rates['cancellationPolicies'])){ $cancellationPolicies =$rates['cancellationPolicies']; } else{ $cancellationPolicies=''; }
						  
					      $nameArr[$boardCode][$rateClass][$r] =array('code'=>$code,'name'=>$name);	  
					      $boardArr[$boardCode][$rateClass][$r] =array('code'=>$code,'name'=>$name,'rates'=>$rates);
					  }
					  else{
					  	// dd($adult,$radults,$children,$rchildren);
						$return =$this->FindNextRoom($r,$adult,$children,$boardCode,$rateClass,$RoomTypes); 
						// dd($return);
						$boardCode =@$return['boardCode'];
						$rateClass =@$return['rateClass'];
						$code =@$return['code'];
						$name =@$return['name'];
						$rates =@$return['rates'];
						
						$net =@$rates['net'];
						$rates['net'] = @$net;
						
						if($boardCode!=''){
						 $nameArr[$boardCode][$rateClass][$r] =array('code'=>$code,'name'=>$name);
						 $boardArr[$boardCode][$rateClass][$r] =array('code'=>$code,'name'=>$name,'rates'=>$rates);
						}
					  } 
				   }
				  //rates loop end
			} 
			// room loop end
			// dd(count( $nameArr[$boardCode][$rateClass]));
			$checker ='';
			foreach($nameArr as $k=>$v){
				$checker.=$k.'~';
				foreach($v as $ke=>$ve){
				 $checker.=$ke.'~';	
				 foreach($ve as $kee=>$vee){
				  $checker.=$vee['code'].'~';	 
				 }
				}
			}
			// dd($checker);
					
			if(!in_array($checker,$checkArr)){
			  $checkArr[] =$checker;	
			  $RoomConbination[]=array('name'=>$nameArr,'rates'=>$boardArr);	
			}	
			
		  } // RoomTypes loop end
		} // is_countable($RoomTypes) end
// dd($RoomConbination);
 return $RoomConbination; 	  
	}
	
	










	
	function FindNextRoom($r, $adult, $children, $boardCode, $rateClass, $RoomTypes)
	{
		if ($children == '') {
			$children = 0;
		}
		for ($m = 0; $m < count($RoomTypes); $m++) {   
			$code = $RoomTypes[$m]['code'];
			$name = $RoomTypes[$m]['name'];
			$ratesArr = $RoomTypes[$m]['rates'];
			$boardArr = array();
			for ($n = 0; $n < count($ratesArr); $n++) {  
				$rboardCode = $ratesArr[$n]['boardCode'];
				$rrateClass = $ratesArr[$n]['rateClass'];
				$radults = $ratesArr[$n]['adults'];
				$rchildren = $ratesArr[$n]['children'];
	
				if ($rchildren == '') {  
					$rchildren = 0;
				}
				//echo 'MME'.$adult.'-'.$radults.'=>'.$children.'-'.$rchildren.'<br>';
				if (($adult == $radults) && ($children == $rchildren) && ($boardCode == $rboardCode) && ($rateClass == $rrateClass)) {  //echo "<br> 2 if";
					$return = array('code' => $code, 'name' => $name, 'boardCode' => $boardCode, 'rateClass' => $rateClass, 'rates' => $ratesArr[$n]);
					return $return;
					break;
				} else if (($adult == $radults) && ($children == $rchildren) && ($boardCode == $rboardCode)) { // echo "<br> 3 if";
					$return = array('code' => $code, 'name' => $name, 'boardCode' => $boardCode, 'rateClass' => $rateClass, 'rates' => $ratesArr[$n]);
					return $return;
					break;
				} else {
					echo '';
				}
			}
		}
	}
	
	
	public function WalletDeduct($amount,$currency,$user_id,$order_id){ 
		 $userData = crud_model::readOne('users',array('user_id'=>$user_id));
		 $walletAmt=$userData->wallet;
		 $finalAmt=$walletAmt-$amount;
		 		
		 $walletAmt=$this->getWalletBal($user_id);
		 if($amount<=$walletAmt){
		 	  $status = Crud_Model::updateData('users',array('wallet'=>$finalAmt),array('user_id'=>$user_id));
			  $data = array(
				  'agent_id' => $user_id,
				  'currency' =>$currency,
				  'amount' => $amount,
				  'final_amount' => $finalAmt,
				  'txn_detail' => 'Wallet Deduct for Hotel Booking Regarding order id '.$order_id,
				  'txn_number'=>$order_id,
				  'payment_status' => 'Confirmed',
				  'transaction_type' => 'DEBITED',
				  'published' => 'Yes',
				  'date_time'=>date('Y-m-d H:i:s'),
			  );
		 	  $status =Crud_Model::insertData('wallet_transactions_history',$data); 
			  $payment_status='Confirmed';
			  $error_msg="";
		  }else{
		  	$payment_status='Failed';
			$error_msg="Insufficent Balance";
		  }
		  	  $data = array(
				  'payment_status' => $payment_status,
				  'payment_method' =>"wallet",
				  'error_message' => $error_msg,
			  );
		 	  $status =Crud_Model::updateData('twc_booking',$data,array('order_id'=>$order_id));
			  
			return 1;
		  
	}
	
	public function getWalletBal($user_id){ 
		 $userData = crud_model::readOne('users',array('user_id'=>$user_id));
		 $walletAmt=$userData->wallet;
		 return $walletAmt;
	}
	
	
	
	
	

	//  create user start
	public function createUser($first_name,$last_name,$email,$phone,$address,$city,$country){
		$obj= crud_model::readOne('users',array('email'=>$email)); 

		if(!is_object($obj)){
			$password=rand();
			$data=array(
				'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
				'first_name'=>$first_name,
				'last_name'=>$last_name,
				'phone'=>$phone,
				'email'=>$email,
				'password'=>$password,
				'address'=>$address,
				'city'=>$city,
				'country'=>$country,
				'user_type'=>'customer',
				'status'=>'active',
				'date_time'=>date('Y-m-d H:i:s')
			);
			$value = Crud_Model::insertData('users',$data);
			$this->UserCreateMailSend($email,$password,$first_name);
			return DB::getPdo()->lastInsertId();
		}else{ return $obj->id; }
	}
	//  create user end		
	
	public function convertCurrencyRate($from,$price){
	$to=$this->currency;
		$usdRate =1;
		if($from!=$to){  
			//$currObj=$this->crud_model->customQuery($from,$to);
			$currObj = DB::select("select rate as fromRate, (select rate from  currency_rates where `currency`='".$to."')  as toRate  from currency_rates where `currency`='".$from."'");
			$fromRate =$currObj[0]->fromRate; 
			$toRate =$currObj[0]->toRate;
			if($usdRate>$fromRate){
			 $usdPrice =($price*$fromRate);	
			}else{
			 $usdPrice =($price/$fromRate);	
			}
			$price =($usdPrice*$toRate);
		}
		return $price;
	}
	
	
	public function createLogFile($action,$request,$response){  
		$credentials="hotelbeds_key=".$this->hotelbeds_key."\r\n hotelbeds_secret=".$this->hotelbeds_secret."\r\n endpoint=".$this->endpoint; 
		$file_name =$action.'-'.date('dmy his');	
		$log_filename = "travel/LogFileHotel"; 
		if (!file_exists($log_filename)) {  
			mkdir($log_filename, 0777);  
		}   
		$log_file_data = $log_filename.'/'.$file_name.'.txt';
		
		$log_data ="===========Credentials($action)========="."\r\n";
		$log_data.=$credentials."\r\n";
		$log_data.="===========Request($action)========="."\r\n";
		$log_data.=$request."\r\n";
		$log_data.="===========Response($action)========="."\r\n";
		$log_data.=$response."\r\n";
		
		file_put_contents($log_file_data, $log_data . "\r\n", FILE_APPEND);
	}
	
	public function UserCreateMailSend($email,$password,$name){  
	
		$content ='<h3>Hi '.$name.'</h3><br>';
		
		$content .='<h5>Your Profile Create During Booking on our Site.Following Are Your Login Details.You Can use it for Manage Your Booking and New Booking.</h5><br>';
 
		$content .='<p>Username: '.$email.'</p><br>';
		$content .='<p>Password: '.$password.'</p><br>';
		$content .='<p>Thank You</p><br>';
		$subject="New User Creation (".$email.")";

		$to = "bhai.kumaramit@gmail.com,".$email.",info@akmtechie.in";
		
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers .= 'From: <techieakm@gmai.com>' . "\r\n";
		$headers .= 'Cc: amit4comp@gmail.com' . "\r\n";
		// mail($to,$subject,$content,$headers);
	}	

// clean Start	
	private function clean($str){
		  $utf8 = array(
    '/[áàâãªä]/u'   =>   'a',
    '/[ÁÀÂÃÄ]/u'    =>   'A',
    '/[ÍÌÎÏ]/u'     =>   'I',
    '/[íìîï]/u'     =>   'i',
    '/[éèêë]/u'     =>   'e',
    '/[ÉÈÊË]/u'     =>   'E',
    '/[óòôõºö]/u'   =>   'o',
    '/[ÓÒÔÕÖ]/u'    =>   'O',
    '/[úùûü]/u'     =>   'u',
    '/[ÚÙÛÜ]/u'     =>   'U',
    '/ç/u'           =>   'c',
    '/Ç/u'           =>   'C',
    '/ñ/u'           =>   'n',
    '/Ñ/u'           =>   'N',
    '/[\²&~#"\'{(\[|`_\^\)°+=}*;:!§?%’,;]/u'    =>   '', //J'enleve les caracteres speciaux
    '/–/u'           =>   '-', // UTF-8 hyphen to "normal" hyphen
    '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
    '/[“”«»„]/u'    =>   ' ', // Double quote
    '/ /u'           =>   ' ', // nonbreaking space (equiv. to 0x160)
    );
  // $str = preg_replace(array_keys($utf8), array_values($utf8), $str);
   return trim($str);
 }
// clean End

// checkThumbNail Start	
 	private function checkThumbNail($thumbnail){
//echo "<br>".$thumbnail;
			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$thumbnail);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
			$query = curl_exec($curl_handle);
			curl_close($curl_handle);
			//echo "<br>".$query;
			if (strpos($query, 'NoSuchKey')== true){ $thumbnail= url('').'/images/nohotel.jpg';  } else{   }
			
			return $thumbnail; }
// checkThumbNail End



public function createLanding($toIATA,$api_currency,$total_amount,$search_id,$image){
			$citySingelTO = crud_model::readOne('airports',array('code'=>$toIATA));
			if(is_object($citySingelTO)){
				$other_content=array(
				   "outbound_days" => "3", 
				   "inbound_days" => "4", 
				   "room" => "1", 
				   "adult" => "1",
				   "child" => "0", 
				   "infant" => "0", 
				   "price" => $total_amount, 
				   "currency" => $api_currency, 
				   "airline" => "AI", 
				   "flight_type" => "oneway",
				);
				$data = array(
					'page_id' => 'hotels-in-'.$citySingelTO->city_name,
					'name' =>'Hotels In '.$citySingelTO->city_name,
					'image' => $image,
					'title' => 'Hotels In '.$citySingelTO->city_name,
					'meta_keywords' =>'Hotels In '.$citySingelTO->city_name,
					'meta_description' =>'Hotels In '.$citySingelTO->city_name,
					'content' =>'Hotels In '.$citySingelTO->city_name,
					'other_content' => json_encode($other_content),
					'status' => 'active',
					'type' => 'landing',
					'type_name' => 'hotels',
					'city_from_code' => '',
					'city_from' => '',
					'cityFromUrl' => '',
					'countryFromUrl' =>'',
					'county_from_code' => '', 
					'city_to_code' =>$citySingelTO->code,
					'city_to' =>$citySingelTO->city_name,
					'cityToUrl' => $citySingelTO->cityUrl,
					'countryToUrl' => $citySingelTO->countryUrl,
					'county_to_code' =>$citySingelTO->country_code, 
					'search_id' =>$search_id,
					'date_time' => date('Y-m-d H:i:s')
				);
			$flightData=crud_model::readOne('pages',array('city_to_code'=>$citySingelTO->code,'type'=>'landing','type_name'=>'hotels'));
			if(!is_object($flightData)){  
				$status = Crud_Model::insertData('pages',$data); 				
			}else{ 
				$status = Crud_Model::updateData('pages',$data,array('city_to_code'=>$citySingelTO->code,'type'=>'landing','type_name'=>'hotels'));
			}
			}
	}
















	public function HotelDetails($id,$hotel_name){

	 // $id=base64_decode($id);

	 $searchId = $id;
     $hotelData = Session::get('hotel_data', []);
     $matchedHotel = collect($hotelData)->firstWhere('EANHotelID', $searchId);

     // dd($hotelData,$matchedHotel,$searchId);
     
     if ($matchedHotel) {
    $data = array(
        'EANHotelID' => $matchedHotel['EANHotelID'],
        'Name' => $matchedHotel['Name'],
        'address1' => $matchedHotel['address1'],
        'address2' => $matchedHotel['address2'],
        'city' => $matchedHotel['city'],
        'postalCode' => '',
        'countryCode' => $matchedHotel['countryCode'],
        'propertyCategory' => '',
        'hotelRating' => $matchedHotel['hotelRating'] ?? null,
        'hotelRatingDisplay' => 'Star',
        'confidenceRating' => '',
        'amenityMask' => '',
        'tripAdvisorRating' => $matchedHotel['tripAdvisorRating'] ?? null,
        'tripAdvisorReviewCount' => $matchedHotel['tripAdvisorReviewCount'] ?? null,
        'tripAdvisorRatingUrl' => '',
        'promoDescription' => '',
        'currentAllotment' => $matchedHotel['currentAllotment'] ?? null,
        'shortDescription' => '',
        'api_currency' => $matchedHotel['api_currency'] ?? null,
        'api_price' => $matchedHotel['api_price'] ?? null,
        'currency' => $this->currency,
        'base_price' => $matchedHotel['base_price'] ?? null,
        'admin_price' => $matchedHotel['admin_price'] ?? null,
        'lowRate' => $matchedHotel['lowRate'] ?? null,
        'highRate' => $matchedHotel['lowRate'] ?? null,
        'discount_price' => $matchedHotel['lowRate'] ?? null,
        'nonRefundable' => $matchedHotel['nonRefundable'] ?? null,
        'latitude' => $matchedHotel['latitude'] ?? null,
        'longitude' => $matchedHotel['longitude'] ?? null,
        'proximityDistance' => $matchedHotel['proximityDistance'] ?? null,
        'proximityUnit' => 'MI',
        'hotelInDestination' => $matchedHotel['hotelInDestination'] ?? null,
        'thumbNailUrl' => $matchedHotel['thumbNailUrl'] ?? null,
        'desti_lat_lon' => $matchedHotel['desti_lat_lon'] ?? null,
        'boardName' => $matchedHotel['boardName'] ?? null,
        'valueAdds' => $matchedHotel['valueAdds'] ?? null,
        'rateClass' => $matchedHotel['rateClass'] ?? null,
        'rateType' => $matchedHotel['rateType'] ?? null,
        'paymentType' => $matchedHotel['paymentType'] ?? null,
        'accommodationTypeCode' => $matchedHotel['accommodationTypeCode'] ?? null,
        'date_time' => date("Y-m-d h:i:s"),
        'checkin' => $matchedHotel['checkin'] ?? null,
        'checkout' => $matchedHotel['checkout'] ?? null,
        'language' => 'en',
        'search_session' => $matchedHotel['search_session'] ?? null,
        'recommended' => 0,
        'selling_points' => '',
        'room_details' => $matchedHotel['room_details'] ?? [],
        'hotelDetails' => $matchedHotel['hotelDetails'],
        'sort_order' => 0,
        'rooms' => $matchedHotel['rooms'] ?? null,
        'Cri_Adults' =>$matchedHotel['Cri_Adults'] ?? [],
        'Cri_Childs' => $matchedHotel['Cri_Childs'] ?? null,
        'child_age' => $matchedHotel['child_age'] ?? null,
        'product' => 'Hotelbeds',
    );
    // dd($data);

    // Insert data
    // DB::table('search_results_hotelbeds')->insert($data);
    $status = Crud_Model::insertData('search_results_hotelbeds', $data);
}


// dd($hotelData,$matchedHotel,$searchId,$status);
$id=$status;




	 $hotelSearchData = crud_model::readOne('search_results_hotelbeds',array('id'=>$id));
	 // dd($hotelSearchData);
	 $pageData = crud_model::readOne('pages',array('page_id'=>'hotel-details'));
	 if($hotelSearchData->product=='Plistbooking'){ 
	 	return view('hotel/hotel-details-plistbooking', array('hotelSearchData' => $hotelSearchData,'pageData' => $pageData,'hotelData' => '')); 
	 }
		//$hotelObj = crud_model::readOne('hotelbeds_hotels',array('hotel_id'=>$hotelSearchData->EANHotelID));
		
		// $apiUrl = "https://dev.plistbooking.travel/travel/hotel-update-rates.php?action=get_single_hotels&hotel_id=".$hotelSearchData->EANHotelID;
		// $curl = curl_init();
		// curl_setopt($curl, CURLOPT_URL, $apiUrl);
		// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		// $response = curl_exec($curl);
		// $hotelObj=json_decode($response);


	 //    $apiUrl = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels/".$hotelSearchData->EANHotelID."/details?language=ENG&useSecondaryLanguage=False";
		// $curl = curl_init();
		// curl_setopt($curl, CURLOPT_URL, $apiUrl);
		// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headerData);
		// $response = curl_exec($curl);
		// $hotelObj=json_decode($response);

		$hotelObj1=AllHotelModel::where('code',$hotelSearchData->EANHotelID)->first();

		
		$hotelData = json_decode($hotelSearchData->hotelDetails, true);
        // dd($hotelData);

		if(count($hotelData)>0){
			$currency =$hotelData['currency'];
			$hotel_id =$hotelData['code'];
			$RoomType =$hotelData['rooms'];
			$countRoom =count($RoomType);
		
			// $contentArr =json_decode($hotelObj->content,true);
			// $contentArr=$hotelObj;
			// dd($contentArr);

			$allimg=json_decode($hotelObj1->images);
			// $feature_image ='http://photos.hotelbeds.com/giata/xxl/'.$contentArr->hotel->images[0]->path;
			$feature_image ='http://photos.hotelbeds.com/giata/xxl/'.$allimg[0]->path;
			// dd($contentArr,$feature_image);


			// if(isset($contentArr->hotel->images)){
			// 	$images =$contentArr->hotel->images;
			// 	$HotelImages[] =$feature_image;
			// 	foreach($images as $g){
			// 	 if($g->order!='1'){  
			// 	 $HotelImages[] ='http://photos.hotelbeds.com/giata/'.$g->path;  
			// 	 }	
			// 	}
			// }else{ 
			// 	$HotelImages[] =array('hotelImageId'=> '','name'=>'','url' =>''); 
			// }

			if(isset($allimg)){
				$images =$allimg;
				$HotelImages[] =$feature_image;
				foreach($images as $g){
				 if($g->order!='1'){  
				 $HotelImages[] ='http://photos.hotelbeds.com/giata/'.$g->path;  
				 }	
				}
			}else{ 
				$HotelImages[] =array('hotelImageId'=> '','name'=>'','url' =>''); 
			}

			// dd($HotelImages);



			// $Pointsofinterest='';
			// if(isset($contentArr->hotel->interestPoints)){
			// 	$interestPoints=$contentArr->hotel->interestPoints; 
			// 	foreach($interestPoints as $v){
			// 	 $dis_km =($v->distance/1000);
			// 	 $dis_mile =($dis_km*0.62);	 
			// 	 $Pointsofinterest.=$v->poiName.' - '.$dis_km.' km / '.($dis_mile).' mi'.'<br />';
			// 	}
			// } else { 
			// 	$interestPoints=array(); 
			// }

            
            $allallinterestPoints=json_decode($hotelObj1->interestPoints);
			$Pointsofinterest='';
			if(isset($allallinterestPoints)){
				$interestPoints=$allallinterestPoints; 
				foreach($interestPoints as $v){
				 $dis_km =($v->distance/1000);
				 $dis_mile =($dis_km*0.62);	 
				 $Pointsofinterest.=$v->poiName.' - '.$dis_km.' km / '.($dis_mile).' mi'.'<br />';
				}
			} else { 
				$interestPoints=array(); 
			}
			// dd($Pointsofinterest);



			$facilities=array(); 
			$roomDetailDescription=array(); 
			$amenetyData=array();
			$paymentMethods=array();
			$roomFacilities=array(); 
			$businessAmenety=array(); 
			$PointsofinterestArr=array();

			// dd($contentArr->hotel->facilities,json_decode($hotelObj1->facilities));

			$allfacility=json_decode($hotelObj1->facilities);
			
			if(isset($allfacility)){ 
				$facilities =$allfacility;
				// dd($facilities);
				foreach($facilities as $f){
				 $groupCode =$f->facilityGroupCode;
				 $facilityCode =$f->facilityCode;
				 $facilityAmont =@$f->amount;
				 // dd($facilityAmont);
				 
				 if(isset($f->number)){ $pre_content =$f->number;}
				 else if(isset($f->indLogic) && $f->indLogic==true){ $pre_content ='Yes';}
				 else if(isset($f->indLogic) && $f->indLogic==false){ $pre_content ='No';}
				 else if(isset($f->indYesOrNo) && $f->indYesOrNo=true){ $pre_content ='Yes';}
				 else if(isset($f->indYesOrNo) && $f->indYesOrNo=false){ $pre_content ='No';}
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
						$amenetyData[]= array('id'=>$facilityCode,'amenity'=>$content,'amount'=>$facilityAmont); 

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


			// dd($roomDetailDescription,$amenetyData,$paymentMethods,$roomFacilities,$businessAmenety,$PointsofinterestArr,$facilities);
			
			if($Pointsofinterest==''){
			 $Pointsofinterest =@implode("<br />",$PointsofinterestArr);	
			}
			// dd($Pointsofinterest);
		   	


		   	// if(isset($contentArr->hotel->postalCode)){ $postalCode=$contentArr->hotel->postalCode; }else{ $postalCode='';}

		   	if(isset($hotelObj1->postalCode)){ $postalCode=$hotelObj1->postalCode; }else{ $postalCode='';}
		   	$coordinate=json_decode($hotelObj1->coordinates);


			 $HotelSummary =array('hotelId'=>$hotelData['code'],'Name'=>$hotelData['name'],'Address1'=>$hotelObj1->address1,'postalCode'=>$postalCode,'City'=>$hotelObj1->city,'Country'=>$hotelObj1->country,'hotelRating'=>trim(str_replace("STARS","",$hotelData['categoryName'])),'tripAdvisorRating'=>'','tripAdvisorReviewCount'=>5,'latitude'=>$coordinate->latitude,'longitude'=>$coordinate->longitude,'recommended'=>0/*$hotelObj->recommended*/,'selling_points'=>""/*$hotelObj->selling_points*/);

			 // dd($postalCode,$HotelSummary );
			 
			 
			 $HotelDetails =array('numberOfRooms'=>0,'numberOfFloors'=>1,'checkInTime'=>'','checkOutTime'=>'','propertyInformation'=>'','areaInformation'=>$Pointsofinterest,'propertyDescription'=>$hotelObj1->description,'hotelPolicy'=>'','roomInformation'=>'','checkInInstructions'=>'','specialCheckInInstructions'=>'','Pointsofinterest'=>$Pointsofinterest,'knowBeforeYouGoDescription'=>'','roomFeesDescription'=>'','locationDescription'=>'','diningDescription'=>'','roomDetailDescription'=>@implode(", ",$roomDetailDescription),'roomFacilities'=>$roomFacilities,'paymentMethods'=>$paymentMethods);

			 // dd($HotelDetails);
			  
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
			 // dd($data);
		}
		else{
			$status =400;     
		  }
		  // dd($data);
		  // dd($contentArr['phones']);
		 //echo "<pre>amenetyData=="; print_r($amenetyData);
		 

		  // if(isset($contentArr->hotel->phones)){
		  // 	$ph=$contentArr->hotel->phones;
		  // }else{
		  // 	$ph=[];
		  // }

		  $allPh=json_decode($hotelObj1->phones);

		  if(isset($allPh)){
		  	$ph=$allPh;
		  }else{
		  	$ph=[];
		  }

		  // dd($data);
	   return view('hotel/hotel-details', array('hotelSearchData' => $hotelSearchData,'pageData' => $pageData,'hotelData' => $data,'phones'=>[]));	 	 
	}
	
	











// insert all hotel in db
	public function insert_all_hotel(){
		//1st get all hotel codes from https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels api
		//2nd call hotel details content api using that code.
		//3rd insert to db.


        //all code api
        $url = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels";
        $iterations = 43; // Total number of loops
        $batchSize = 1000; // Number of hotels per batch
        $results = [];

      

            $queryParams = http_build_query([
                'language' => 'ENG',
                'from' => 42001,
                'to' =>   43000,
                'countryCode' => 'US',
                // 'fields' => 'code',
            ]);

            $requestUrl = "{$url}?{$queryParams}";

            // Initialize cURL
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $requestUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER =>$this->headerData
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);

            $data=json_decode($response, true);
            // dd($data['hotels']);
             $results[] = json_decode($response, true);

	            foreach($data['hotels'] as $val){
	            	// dd($val['code'],$val,$val['name']['content'],$val['description']['content'],json_encode(@$val['images']));

					 // Create a new instance of the Hotel model
				        $hotel = new AllHotelModel();

				        // Assign data to fields
				        $hotel->code = @$val['code'];
				        $hotel->region = 'US';
				        $hotel->name = @$val['name']['content'];
				        $hotel->description = @$val['description']['content'];
				        $hotel->country = @$val['countryCode'];
				        $hotel->state = @$val['stateCode'];
				        $hotel->destination = @$val['destinationCode'];
				        $hotel->zone = @$val['zoneCode'];
				        $hotel->address1 = @$val['address']['content'];
				        $hotel->address2 = @$val['address']['content'];

				        $hotel->images =  json_encode(@$val['images']);
				        $hotel->facilities =  json_encode(@$val['facilities']);
				        $hotel->interestPoints =  json_encode(@$val['interestPoints']);
				        $hotel->rooms =  json_encode(@$val['rooms']);
				        $hotel->phones = json_encode(@$val['phones']);

				        $hotel->email =@$val['email'];
				        $hotel->city = @$val['city']['content'];
				        $hotel->postalCode = @$val['postalCode'];
				        $hotel->segments = json_encode(@$val['segmentCodes']);
				        $hotel->boards = json_encode(@$val['boardCodes']);
				        $hotel->accommodationType = @$val['accommodationTypeCode'];
				        $hotel->coordinates = json_encode(@$val['coordinates']);

				        // Save the hotel to the database
				        $hotel->save();

				        // dd(1);
	            } //foreach end

           sleep(1);

        return response()->json("done");
            // echo $from." ".$to;
            // echo "</br>";
    }










 
}
