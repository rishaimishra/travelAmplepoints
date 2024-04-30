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



class Hotel extends Controller
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
		public $endpoint='https://api.test.hotelbeds.com/hotel-api/1.0';
		
		public function __construct(){
			$this->emailObj= new EmailController();
			$this->markupObj = new Markup();
		    $data= crud_model::readOne('user',array('id'=>1)); //$this->crud_model->readOne('website_setting',1);
		   	$common_data= $data->common_data;
			$common_dataArr= json_decode($common_data,true);
			$this->currency=$data->currency;
			$this->currency_symbol=$data->currency_symbol;
			$this->hotelbeds_key=$common_dataArr['hotelbeds_key'];
			$this->hotelbeds_secret=$common_dataArr['hotelbeds_secret'];
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













// GetHotelList Start
	public function GetHotelList(Request $request){		
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
	  
		$checkIn = str_replace('/', '-', $_REQUEST['checkIn']);
		$checkIn=date('Y-m-d',strtotime($checkIn));
		$checkOut = str_replace('/', '-', $_REQUEST['checkOut']);
		$checkOut=date('Y-m-d',strtotime($checkOut));

   		$actionUrl=$this->endpoint.'/hotels';
		$adultArr =json_decode($adults,true);  
		$childArr = json_decode($childs,true); 	
		$childAgeArr =json_decode($childAge,true); 
		$occupancies =array();
		
		for($i=0;$i<$rooms;$i++){
			 $total_adults=0;
			 $total_childs=0;
			 $packs =array();	

			 $adt =$adultArr[$i];
			 $chd =$childArr[$i];
		
			 for($b=0;$b<$adt;$b++){
			 $packs[] =array('type'=>'AD','age'=>(40+$b));
			 }
			 
			 if($chd>0){	
			  for($d=0;$d<$chd;$d++){	 
				 $packs[] =array('type'=>'CH','age'=> $childAgeArr[$i][$d]);
				}
			 }
			 $occupancies[] =array('rooms'=>1,'adults'=>$adt,'children'=>$chd,'paxes'=>$packs);	
		}

		$limit =200;
		$size=200;
		$start =0;
		$page=$request['page_number'];
		if($page>1){
		 $size =($page*$limit);	
		 $start =($page-1)*$limit;	
		}
		$LogStr ='';
		$LogStr.=' Page:'.$page.'<br>';
	
		$hotel =array();
		$len = strlen($regionid);
	
		/*$query =DB::select("select count(hotel_id) as totalproduct from hotelbeds_hotels WHERE destinationCode='".$regionid."'  and status_deleted=0 " );
		$obj= $query[0];
		$PropertyCount =$obj->totalproduct;

		$dquery =DB::select("select hotel_id from hotelbeds_hotels WHERE destinationCode='".$regionid."'  and status_deleted=0 ORDER BY id DESC limit $start,$limit");
		foreach($dquery as $dobj){
		 $hotel['hotel'][]=	trim($dobj->hotel_id);
		}*/
		
		$apiUrl = "https://dev.plistbooking.travel/travel/hotel-update-rates.php?action=get_hotels&regionid=".$regionid."&start=".$start."&limit=".$limit."";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $apiUrl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		$res=json_decode($response,true);
		$PropertyCount=$res['PropertyCount'];
		$hotel=$res['hotel'];
		// dd($res,$hotel);
		
		
		
	
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
					 'filter'=>array('packaging'=>true),
					 'boards'=>$boardarr,
					 //'filter'=>array('accommodations'=>$accommodationsArr)
					 //'accommodations'=>$accommodationsArr
	                );


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
		$this->createLogFile('GetHotelList',json_encode($postdata),$response);		
    $results =json_decode($response,true);	
   // dd($results,$actionUrl,$postdata,$this->headerData);
    // dd($results);
	
	// $this->createLogFile('Search',json_encode($postdata).$endpoint.'('.$size.'--sendHotels-'.$totalsendhotel.')'.'---'.'(getHotels-'.count($hotelData).')',$response);

	$data=array();
	if(isset($results['hotels']['hotels'])){
		// dd(1270);
		$hotelData =$results['hotels']['hotels']; 
		$dd=count($hotelData);
		$status =200; 
		//$data=array('regionid'=>$regionid,'destination'=>$destination,'rooms'=>$rooms,'adults'=>$adults,'childs'=>$childs,'checkIn'=>$checkIn,'checkOut'=>$checkOut);
		//$data['HotelLists'] =array('size'=>$size,'PropertyCount'=>$PropertyCount);
		
		for($i=0;$i<count($hotelData);$i++){	
			
		if(isset($hotelData[$i]['rooms'][0]['rates'][0]['rateClass'])){
		 $hotel_id =$hotelData[$i]['code'];
		 $RoomTypes =$hotelData[$i]['rooms'];  
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
			$roomArr =$roomData[$firstKey];
			$lowRate=0;
			$base_price=0;
			$adminPrice =0;
			$api_price =0;
			
			
				for($r=0;$r<count($roomArr);$r++){ 
					$api_price=($api_price+$roomArr[$r]['rates']['api_price']);
					$base_price=($base_price+$roomArr[$r]['rates']['base_price_in_live_currency']);
					$adminPrice=($adminPrice+$roomArr[$r]['rates']['adminPrice']);
					$lowRate=($lowRate+$roomArr[$r]['rates']['net']);
					//$discount_price =($highRate-$lowRate);
					$nonRefundable=0;
					if($firstKey=='NRF'){
					  $nonRefundable =1; 
					} 		   
				}  // This section is taking more than 2.5 seconds
				
		 
		 if(isset($hotelData[$i]['reviews'])){ $tripAdvisorArr =$hotelData[$i]['reviews'][0]; } else { $tripAdvisorArr=array('rate'=>0.0,'reviewCount'=>0); }
		// $query =DB::select("select rating,address,city,country,img_path,content,recommended,selling_points from hotelbeds_hotels WHERE hotel_id='".$hotel_id."'");
		//$obj =$query[0];
		 
		 
		$apiUrl = "https://dev.plistbooking.travel/travel/hotel-update-rates.php?action=get_single_hotels&hotel_id=".$hotel_id;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $apiUrl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		$obj=json_decode($response);
		 
		 
		 $findArr =array('STARS','STAR','STAR AND A HALF','AND A HALF','HISTORICAL HOTEL LUXURIOUS','BOUTIQUE','LUXURY');
	     $replaceArr =array('','','','','','','');
		 
		 $StarRating =trim(str_replace($findArr,$replaceArr,$hotelData[$i]['categoryName']));
		 $rates =$hotelData[$i]['rooms'][0]['rates'][0];		 
		 $latitude =$hotelData[$i]['latitude'];
		 $longitude =$hotelData[$i]['longitude'];
		 $distance =''; //$this->distance($latitude, $longitude, $lat, $lng, '');
		 
		 $content =json_decode($obj->content,true);
		 
		 $accommodationTypeCode =$content['accommodationTypeCode'];
		
		 $facilities =$content['facilities'];
		
		 $facilityStr='';
		 foreach($facilities as $v){
		  if($v['facilityGroupCode']==70){
			$facilityStr .=$v['facilityCode'].",";	
		   } 
		 }
		$facilityStr= substr($facilityStr, 0, -1);
		$valueAdds='';
		if($facilityStr!=''){
			 $dquery =DB::select("select GROUP_CONCAT(content SEPARATOR ', ') as valueAdds from hotelbeds_facilities WHERE facilityGroupCode='70' and facilityTypologyCode IN (".$facilityStr.")");
			 $dobj =$dquery[0];
			 $valueAdds =$dobj->valueAdds;
		 }
		     $nonRefundable=0;
			 if($rates['rateClass']!='NOR'){
			  $nonRefundable=1;	 
			 }

		  $api_currency=$hotelData[$i]['currency'];

		 $imgage_path=$this->checkThumbNail('http://photos.hotelbeds.com/giata/'.$obj->img_path);
		 // dd(12);
		 if($lowRate<100000){
		 	// dd(1,$obj);
			 $data=array(
					'EANHotelID'=>$hotel_id,
					'Name'=>$this->clean($hotelData[$i]['name']),//
					'address1'=>$this->clean($obj->address),//
					'address2'=>$this->clean($obj->address),
					'city'=>$this->clean($obj->city),
					'postalCode'=>'',
					'countryCode'=>$obj->country,
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
					'recommended'=>$obj->recommended,
					'selling_points'=>$obj->selling_points,
					'room_details'=>json_encode($RoomTypes),
					'hotelDetails'=>json_encode($hotelData[$i]),
					'sort_order'=>0,
					'rooms'=>$rooms,
					'Cri_Adults'=>$adults,
					'Cri_Childs'=>$childs,
					'child_age'=>$childAge,
					'product'=>'Hotelbeds',
				);
				//echo "<pre>"; print_r($data); 
				$status = Crud_Model::insertData('search_results_hotelbeds',$data);
				
			}// avoid unwanted hotel
		 
		} // end if
			$isFind='Yes';
		}// end for
		        // $this->convertCurrencyRate($api_currency,$hotelData[$i]['minRate']),
		 $this->createLanding($regionid,$data['currency'],$data['lowRate'],$search_Session_Id,$data['thumbNailUrl']);
		 
		
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
	  
	  $data =array('isFind'=>$isFind,'pageCount'=>$pageCount,'total_records'=>$PropertyCount,'search_Session_Id'=>$search_Session_Id,'teststatus'=>$status);
	  echo json_encode($data);	 
	} 
// GetHotelList List End
	






public function getdetails($id){
	$id=$id;
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
			// return $amenetyData;

			$html = '';
	        foreach ($amenetyData as $item) {
	        	//dd($item[0]);
	            $html .= '<li class="mr-2"><i class="la la-star"></i>' . $item[0] . '</li>';
	        }
	        $html .= '';

            return $html;

			// return $data;
			//<div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
            //<i class="la la-check"></i>
            //</div>
			
    }
}


























// Show_Hotels Start
	public function Show_Hotels(Request $request){
		$limit =10;
		if(($request["page"]<=1) || ($request["page"]=='')){
			$page = 0;
		}else{
			$page = ( ($request["page"]-1) * $limit);
		}
		$sortValArr=explode('_',$request["sortVal"]);
		$search_session=$request['search_id'];
		$orderBy=' order by '.$sortValArr[0].' '.$sortValArr[1];
		$moreQuery=" where search_session='".$search_session."' ";
		$data = array();
		if($request['price']!=''){
			$price =str_replace(' ','',$request['price']);
			$priceArr =explode('-',$price);
			$minPrice =$priceArr[0];
			$maxPrice =$priceArr[1];
			$moreQuery.= " AND (lowRate >= ".$minPrice." AND lowRate<=".$maxPrice.")";
		} 
		
		$Cri_Rating=substr($request['Cri_Rating'],0,-1);
		$Cri_Rating =explode(",",$request['Cri_Rating']); 
		$Cri_Rating =array_filter($Cri_Rating);
		if(count($Cri_Rating)>0) {
		 $moreQuery.= " AND hotelRating IN (";	
		 $RatingStr ='';
		 foreach($Cri_Rating as $v){   
		  $RatingStr.= " '".$v."',"; 	 
		 }
		 $rating =substr($RatingStr,0,-1);
		 $moreQuery.=$rating;
		 $moreQuery.= " )";   
		}
		
		
		$Cri_board=substr($request['Cri_board'],0,-1);
		$Cri_board =explode(",",$request['Cri_board']); 
		$Cri_board =array_filter($Cri_board);
		if(count($Cri_board)>0) {
		 $moreQuery.= " AND boardName IN (";	
		 $boardStr ='';
		 foreach($Cri_board as $v){   
		  $boardStr.= " '".$v."',"; 	 
		 }
		 $board =substr($boardStr,0,-1);
		 $moreQuery.=$board;
		 $moreQuery.= " )";   
		}
		
		$Cri_product=substr($request['Cri_product'],0,-1);
		$Cri_product =explode(",",$request['Cri_product']); 
		$Cri_product =array_filter($Cri_product);
		if(count($Cri_product)>0) {
		 $moreQuery.= " AND product IN (";	
		 $productStr ='';
		 foreach($Cri_product as $v){   
		  $productStr.= " '".$v."',"; 	 
		 }
		 $product =substr($productStr,0,-1);
		 $moreQuery.=$product;
		 $moreQuery.= " )";   
		}
		
		$accommodationType=substr($request['accommodationType'],0,-1);
		$accommodationType =explode(",",$request['accommodationType']); 
		$accommodationType =array_filter($accommodationType);
		if(count($accommodationType)>0) {
		 $moreQuery.= " AND accommodationTypeCode IN (";	
		 $accommodationTypeStr ='';
		 foreach($accommodationType as $v){   
		  $accommodationTypeStr.= " '".$v."',"; 	 
		 }
		 $accommodation =substr($accommodationTypeStr,0,-1);
		 $moreQuery.=$accommodation;
		 $moreQuery.= " )";   
		}
				
		$Cri_amenity=substr($request['Cri_amenity'],0,-1);
		$Cri_amenity =explode(",",$request['Cri_amenity']); 
		$Cri_amenity =array_filter($Cri_amenity);
		if(count($Cri_amenity)>0) {
		 foreach($Cri_amenity as $v){  $moreQuery.= " AND valueAdds like '%".$v."%' ";	 }
		}
		
		if($request['hotel_name']!='') {
		$hotel_name=trim($request['hotel_name']);
		 $moreQuery.= " AND Name like '%".$hotel_name."%' ";	 
		}
		
		$totalresults = DB::select("select count(*) as totalcount from search_results_hotelbeds ".$moreQuery." ");
		$totalObjs =$totalresults[0]; $totalcount=$totalObjs->totalcount;	
		
		$results = DB::select("select * from search_results_hotelbeds ".$moreQuery." ".$orderBy." LIMIT ".$page.", $limit");  
		$datatype=''; $promoDescription=''; $isFavourate=''; $hotelFlight=''; $policyMatch=''; $inpolicy=''; $apply_rule_on=''; $currentAllotment='';
		foreach($results as $Objs ){ 
			$amenetyData=$this->getdetails($Objs->id);
			// dd($amenetyData);
				$data['result'][] =array('amenetyData'=>$amenetyData,'tid'=>$Objs->id,'total'=>$totalcount,'datatype'=>$datatype,'EANHotelID'=>$Objs->EANHotelID,'Name'=>$Objs->Name,'thumbnail'=>$Objs->thumbNailUrl,'StarRating'=>round($Objs->hotelRating),'popularity'=>$Objs->confidenceRating,'tripAdvisorRating'=>$Objs->tripAdvisorRating,'tripAdvisorReviewCount'=>$Objs->tripAdvisorReviewCount,'tripAdvisorRatingUrl'=>'','Address1'=>$Objs->address1,'Address2'=>$Objs->address2,'City'=>$Objs->city,'locationDescription'=>$Objs->locationDescription, 'LowRate'=>$Objs->lowRate,'currency_symbol'=>$this->currency_symbol,'HighRate'=>round($Objs->highRate,0),'discount_price'=>$Objs->discount_price,'nonRefundable'=>$Objs->nonRefundable,'Latitude'=>$Objs->latitude,'Longitude'=>$Objs->longitude,'rateClass_Name'=>$Objs->rateClass,'rateClass'=>$Objs->rateClass,'rateType'=>$Objs->rateType,'paymentType'=>$Objs->paymentType,'promoDescription'=>$promoDescription,'currentAllotment'=>$currentAllotment,'is_custom'=>$Objs->is_custom,'isActive'=>$Objs->isActive,'isFavourate'=>$isFavourate,'hotelFlight'=>$hotelFlight,'policyMatch'=>$policyMatch,'inpolicy'=>$inpolicy,'apply_rule_on'=>$apply_rule_on,'boardName'=>$Objs->boardName,'recommended'=>$Objs->recommended,'selling_points'=>$Objs->selling_points,'valueAdds'=>explode(',',$Objs->valueAdds),'product'=>$Objs->product,'accommodationType'=>$Objs->accommodationTypeCode); 	 
		}
	$datastr = json_encode($data);    
	echo $datastr;
	die;
	}  
// Show_hotel() End
	

















// getControls Start	
	public function getControls(Request $request){
		
	$search_id=$request['search_id'];
	$moreCod =" and lowRate >0 ";
	
	$pre_sql =DB::select("SELECT count(Eanhotelid) as totalrecords FROM search_results_hotelbeds WHERE search_session='".$search_id."' $moreCod ");
	$obj = $pre_sql[0];
	
	$pre_sql1 =DB::select("select count(Eanhotelid) as stars5 from search_results_hotelbeds where search_session='".$search_id."' $moreCod and hotelRating IN(4.5,5.0)");
	$obj1 = $pre_sql1[0];
	
	$pre_sql2 =DB::select("select count(Eanhotelid) as stars4 from search_results_hotelbeds where search_session='".$search_id."' $moreCod and hotelRating IN(3.5,4.0)");
	$obj2 =$pre_sql2[0];
	
	$pre_sql3 =DB::select("select count(Eanhotelid) as stars3 from search_results_hotelbeds where search_session='".$search_id."' $moreCod and hotelRating IN(2.5,3.0)");
	$obj3 =$pre_sql3[0];
	
	$pre_sql4 =DB::select("select count(Eanhotelid) as stars2 from search_results_hotelbeds where search_session='".$search_id."' $moreCod and hotelRating IN(1.5,2.0)");
	$obj4 =$pre_sql4[0];
	
	$pre_sql5 =DB::select("select count(Eanhotelid) as stars1 from search_results_hotelbeds where search_session='".$search_id."' $moreCod and hotelRating IN('1.0') ");
	$obj5 =$pre_sql5[0];
	
	$pre_sql6 =DB::select("select count(Eanhotelid) as stars0 from search_results_hotelbeds where search_session='".$search_id."' $moreCod and hotelRating IN('0.0') ");
	$obj6 =$pre_sql6[0];


	$pre_sql7 =DB::select("select valueAdds from search_results_hotelbeds where search_session='".$search_id."' $moreCod  ");
	$amenityStr='';
	foreach($pre_sql7 as $obj7){ 
			$amenityStr.=$obj7->valueAdds.',';
	}
	$amenities =explode(',',$amenityStr);
	$amenityArr =array_filter(array_unique($amenities)); 
	$ami=array();
	foreach($amenityArr as $val){ $ami[]=array('val'=>$val); }
	
	/*=== Board Name ===*/
	$boardNameArr =array();
	$results =DB::select("select distinct boardName from search_results_hotelbeds WHERE search_session='".$search_id."' ");
	foreach($results as $bObj){ 
	 $boardNameArr[]=array('name'=>$bObj->boardName,'display_name'=>$bObj->boardName); 
	}
	
	/*=== Product Name ===*/
	$productArr =array();
	$results =DB::select("select distinct product from search_results_hotelbeds WHERE search_session='".$search_id."' ");
	foreach($results as $bObj){ 
	 $productArr[]=array('name'=>$bObj->product,'display_name'=>$bObj->product); 
	}
	
	/*=== accommodationType  ===*/
	$accommodationTypeArr =array();
	$results =DB::select("select distinct accommodationTypeCode from search_results_hotelbeds WHERE search_session='".$search_id."' ");
	foreach($results as $bObj){ 
	 $accommodationTypeArr[]=array('name'=>$bObj->accommodationTypeCode,'display_name'=>$bObj->accommodationTypeCode); 
	}



	$pre_sql12 =DB::select("select MIN(lowRate) as minrate,MAX(lowRate) as maxrate,MIN(tripAdvisorRating) as minguest,MAX(tripAdvisorRating) as maxguest from search_results_hotelbeds WHERE search_session='".$search_id."' $moreCod  ");
	$obj12 =$pre_sql12[0];
	
	//'distance5'=>$obj8->distance5,'distance10'=>$obj9->distance10,'distance20'=>$obj10->distance20,'distance50'=>$obj11->distance50,'distance2'=>$obj7->distance2,
	$activePropertyCount='12';
	$data =array('totalrecords'=>$obj->totalrecords,'stars5'=>$obj1->stars5,'stars4'=>$obj2->stars4,'stars3'=>$obj3->stars3,'stars2'=>$obj4->stars2,'stars1'=>$obj5->stars1,'stars0'=>$obj6->stars0,'minrate'=>floor($obj12->minrate),'maxrate'=>ceil($obj12->maxrate),'minguest'=>floor($obj12->minguest),'maxguest'=>ceil($obj12->maxguest), 'activePropertyCount'=>$activePropertyCount,'boardName'=>$boardNameArr,'product'=>$productArr,'accommodationType'=>$accommodationTypeArr,'amenityArr'=>$ami,'currency_symbol'=>$this->currency_symbol);
	echo json_encode($data);

	}
// getControls End	


















	
// HotelFinalCheckout Start	
	public function HotelFinalCheckout(Request $request)  
    {
    	// dd($request->all());       

		$request_data=array();
		$request_data=$request->input();
		
		$hotelSearchData=crud_model::readOne('search_results_hotelbeds',array('id'=>$request->input('ref_id'))); 
		$rooms=$hotelSearchData->rooms;
				
		$EANHotelID[]=$request_data['EANHotelID'];
		
		$total_amount=$request_data['apiPrice'];
		$total_currency=$request_data['currency'];
		 
	 $adultArr =json_decode($hotelSearchData->Cri_Adults,true);
	 $childArr =json_decode($hotelSearchData->Cri_Childs,true);
	 $childAgeArr =json_decode($hotelSearchData->child_age,true);
	  $rateKeyArr =$request_data['rateKey'];
	for($i=0;$i<$rooms;$i++){
	 $paxes =array();	
	 $roomId =1;	
	 $adults =$adultArr[$i];
	 $childs =$childArr[$i];
	 
	 for($a=0;$a<$adults;$a++){
	  $titles =$request_data['passenger']['adult']['title'][$i][$a];
	  $fname =$request_data['passenger']['adult']['first_name'][$i][$a];	
      $lname =$request_data['passenger']['adult']['last_name'][$i][$a];	  
	  $paxes[] =array('roomId'=>$roomId,'type'=>'AD','name'=>$fname,'surname'=>$lname);
	 }
	 for($c=0;$c<$childs;$c++){
	  $titles =$request_data['passenger']['child']['title'][$i][$c];
	  $fname =$request_data['passenger']['child']['first_name'][$i][$c];	
      $lname =$request_data['passenger']['child']['last_name'][$i][$c];	 
	  $paxes[] =array('roomId'=>$roomId,'type'=>'CH','name'=>$fname,'surname'=>$lname);
	 }
	 
	 $rateKey =nl2br(trim($rateKeyArr[$i]));
	 $roomsArr[] =array('rateKey'=>$rateKey,'paxes'=>$paxes);
	}
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
		'ip_address'=>$_SERVER['REMOTE_ADDR']
		);
		$value = Crud_Model::insertData('twc_booking',$data);
		$redirect_page=url('/')."/travel/payment/".$request_data['payment_type']."/?order_id=".$order_id."&module=hotel";

		if($request_data['payment_type']=='wallet'){
			$return=$this->WalletDeduct($request_data['chargeableRate'],$request_data['api_currency'],$user_id,$order_id);
			$redirect_page=url('/')."/book-hotel?order_id=".$order_id;
		}
		
		
		//Crud_Model::updateData('twc_booking',array('payment_status'=>'Confirmed'),array('order_id'=>$order_id));
		// $redirect_page=url('/')."/book-hotel?order_id=".$order_id; //****************
		// dd( @Auth::user()->id);
		dd(1);

		 return redirect()->route('processcheckoutpayment', ['order_id' => $order_id, 'user_id' => @Auth::user()->id]);
		
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

        	Crud_Model::updateData('twc_booking',array('payment_status'=>'Confirmed'),array('order_id'=>$order_id));
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
        if(@Auth::user()->id || Session::get('user_id') ){
        	// dd(1);
        	//update ample
        	$userDetail = User::where('id', @Auth::user()->id)
		    ->orWhere('id', Session::get('user_id'))
		    ->first();
		    // dd($userDetail);
		    if(@$userDetail->ample){
		    	$newAmple=(int)($userDetail->ample) + round($no_of_amples);
		    }else{
                $newAmple=round($no_of_amples);
		    }
        	
        	$up=User::where('id', @Auth::user()->id)->orWhere('id', Session::get('user_id'))->update(['ample'=>$newAmple]);
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
	   $bookingMode='Test';
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
		$this->createLogFile('Cancelled-'.$request['order_id'],$actionUrl,$content);
		$res=json_decode($content,true);
		if(isset($res['error'])){ 
			$return=array('error'=>'Yes','msg'=>$res['error']['message']); 
			$booking_status=$obj->booking_status;
		}
		else {
			  	$responseData = $Response_Arr['booking'];
				$ResponseStatus = $responseData['status'];
				$booking_status='Cancelled';
				$return=array('error'=>'No','msg'=>'Cancellation Successfull');
		}
		
		$data=array(
				'booking_status'=>$booking_status,
				'cancelled_by'=>session()->get('user_id'),
				'cancellationNumber'=>rand(),
				'cancellation_date'=>date('Y-m-d H:i:s'),
				'cancellation_request'=>$actionUrl,	
				'cancellation_response'=>$contents,
			 );
	    Crud_Model::updateData('twc_booking',$data,array('order_id'=>$request['order_id']));
	
		echo json_encode($return);		
	
	}
// Cancel Hotel end	


	public function RoomAvailability(Request $request){	
		$obj = crud_model::readOne('search_results_hotelbeds',array('id'=>$_REQUEST['tid']));
		$obj->hotelDetails;
		$hotelData =json_decode($obj->hotelDetails,true);
		
		$api_currency =$hotelData['currency'];
		$RoomTypes =$hotelData['rooms'];
		
		$RoomConbination =$this->ManageRoomType($request['rooms'],json_decode($request['adults'],true),json_decode($request['childs'],true),$api_currency,$RoomTypes);
		
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
					  if($rateType=='RECHECK'){ 
						$results =$this->CheckRates($rateKey);
						$cResponse =json_decode($results,true);	
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
					  }
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
		 //selected Room Work End	
		  $selectTid='';
		 
	   $RoomList =array('RoomTypes'=>array('size'=>count($RoomConbination),'RoomGroup'=>$RoomConbination),'SelectedRoom'=>$SelectedRoom,'selectTid'=>$selectTid);
	   $data =array('status'=>200,'status_message'=>'OK','currency'=>$this->currency,'currency_symbol'=>$this->currency_symbol,'responseData'=>$RoomList);
	   
	   echo json_encode($data);
}


 function ManageRoomType($rooms,$adultArr,$childrenArr,$api_currency,$RoomTypes){
  $RoomConbination =array();
  /*$adultArr =explode(',',$adults);
  $childrenArr =explode(',',$children);*/
  $checkArr =array();	
  
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
				  $children =$childrenArr[$r];	
				  if($children==''){$children=0;}
				  //rates loop start
				  for($n=0;$n<count($ratesArr);$n++){
				  	  $rates = $ratesArr[$n];
					  $boardCode =$rates['boardCode'];
					  $rateClass =$rates['rateClass'];
					  $radults =$rates['adults'];
					  $rchildren =$rates['children'];
					  if($rchildren==''){$rchildren=0;}
					  if(($adult==$radults) && ($children==$rchildren) ){
					  	  
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
						  
						  
						  			  
						  $rateClass =$rates['rateClass'];
						  if(isset($rates['cancellationPolicies'])){ $cancellationPolicies =$rates['cancellationPolicies']; } else{ $cancellationPolicies=''; }
						  
					      $nameArr[$boardCode][$rateClass][$r] =array('code'=>$code,'name'=>$name);	  
					      $boardArr[$boardCode][$rateClass][$r] =array('code'=>$code,'name'=>$name,'rates'=>$rates);
					  }
					  else{
						$return =$this->FindNextRoom($r,$adult,$children,$boardCode,$rateClass,$RoomTypes); 
						$boardCode =$return['boardCode'];
						$rateClass =$return['rateClass'];
						$code = $return['code'];
						$name = $return['name'];
						$rates = $return['rates'];
						
						$net =$rates['net'];
						$rates['net'] = $net;
						
						if($boardCode!=''){
						 $nameArr[$boardCode][$rateClass][$r] =array('code'=>$code,'name'=>$name);
						 $boardArr[$boardCode][$rateClass][$r] =array('code'=>$code,'name'=>$name,'rates'=>$rates);
						}
					  } 
				   }
				  //rates loop end
			} 
			// room loop end
			
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
					
			if(!in_array($checker,$checkArr)){
			  $checkArr[] =$checker;	
			  $RoomConbination[]=array('name'=>$nameArr,'rates'=>$boardArr);	
			}	
			
		  } // RoomTypes loop end
		} // is_countable($RoomTypes) end

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
				if (($adult == $radults) && ($children == $rchildren) && ($boardCode == $rboardCode) && ($rateClass == $rrateClass)) {  echo "<br> 2 if";
					$return = array('code' => $code, 'name' => $name, 'boardCode' => $boardCode, 'rateClass' => $rateClass, 'rates' => $ratesArr[$n]);
					return $return;
					break;
				} else if (($adult == $radults) && ($children == $rchildren) && ($boardCode == $rboardCode)) {  echo "<br> 3 if";
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
		 $userData = crud_model::readOne('user',array('id'=>$user_id));
		 $walletAmt=$userData->wallet;
		 $finalAmt=$walletAmt-$amount;
		 		
		 $walletAmt=$this->getWalletBal($user_id);
		 if($amount<=$walletAmt){
		 	  $status = Crud_Model::updateData('user',array('wallet'=>$finalAmt),array('id'=>$user_id));
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
		 $userData = crud_model::readOne('user',array('id'=>$user_id));
		 $walletAmt=$userData->wallet;
		 return $walletAmt;
	}
	
	
	
	
	

	//  create user start
	public function createUser($first_name,$last_name,$email,$phone,$address,$city,$country){
		$obj= crud_model::readOne('user',array('email'=>$email)); 

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
			$value = Crud_Model::insertData('user',$data);
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
	
	function CheckRates($rateKey){		
		$actionUrl=$this->endpoint.'/checkrates?rateKey='.$rateKey;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $actionUrl);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerData);
		$content = curl_exec($ch);
		curl_close($ch);				
		$results =json_decode($content,true);
				
		$hotelResults =$results['hotel'];
		$data =array();
		if($hotelResults['code']>0){
		 $status =200;	
		 $data =array('size'=>1,'RateResponse'=>$hotelResults); 
		}
		else{
		  $status =400;     
		}
		
		return $data;		
	}


 
}
