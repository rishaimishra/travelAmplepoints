<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud_Model;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Auth;




class Tours extends Controller
{
   		public $currency='';  public $currency_symbol=''; public $signature=''; public $headerData='';
		public $hotelbeds_key='88013eb226283db1bd72df7fb137e9cf';
		public $hotelbeds_secret='e9c8421e54'; 
		public $endpoint= "https://api.test.hotelbeds.com/activity-api/3.0";
		
		public function __construct(){
		    $data= crud_model::readOne('user',array('id'=>1)); //$this->crud_model->readOne('website_setting',1);
		   	$common_data= $data->common_data;
			$common_dataArr= json_decode($common_data,true);
			$this->currency=$data->currency;
			$this->currency_symbol=$data->currency_symbol;
			$signature = hash("sha256", $this->hotelbeds_key.$this->hotelbeds_secret.time());
			$this->headerData=array('Content-Type: application/json','Accept:application/json','Api-key:'.$this->hotelbeds_key, 'X-Signature:'.$signature);
		}
		
		public function GetLocations(Request $request) 
		{
			$request= $request->input();
			
			$query = DB::select("select city_code,city_name,countryCode,countryName from hotelbeds_activity_destinations WHERE city_name LIKE '%".$request['term']."%' limit 10");
			$locations =array();
			foreach($query as $obj){
			  $country =$obj->countryName;	
			  $locations[] =array('countryCode'=>$obj->countryCode,'country'=>$country,'latinFullName'=>$obj->city_name.', '.$obj->countryCode,'fullname'=>$obj->city_name.', '.$country,'city'=>$obj->city_name,'locationId'=>$obj->city_code);
			}
			$data['cities']=$locations; 
			return json_encode($data);
		}

		public function SearchRequest(Request $request) 
		{
			$request= $request->input();
			// dd($request['city_code']);
			
			  $checkIn = str_replace('/', '-', $request['travel_date']);
			  $checkIn=date('Y-m-d',strtotime($checkIn));
			$search_id=$request['search_session'];
			$adults=$request['adults'];
			$childs=$request['childs'];
			
			 $actionUrl=$this->endpoint.'/activities';
			$dest[] =array('type'=>'destination','value'=>$request['city_code']); 
			$desti[] =array('searchFilterItems'=>$dest);
			$postdata =array('filters'=>$desti,'from'=>$checkIn,'to'=>$checkIn);

			// dd($actionUrl,$postdata,$this->headerData);
						
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $actionUrl);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerData);
			 $contents = curl_exec($ch); 
			curl_close($ch);	
			
			$this->createLogFile('Search',json_encode($postdata),$contents);	
			//die;
				$Response_Arr = json_decode($contents, true);

			$pagination = $Response_Arr['pagination'];
			$totalItems = $pagination['totalItems'];
		
			$activity_results = $Response_Arr['activities'];
			// dd($activity_results);
		
			$Total_LowestRate = 0;
		
			for ($i = 0; $i < count($activity_results); $i++) {
				$activitycode = $activity_results[$i]['code'];
				$activitytype = $activity_results[$i]['type'];
				$countryCode = $activity_results[$i]['countryCode'];
				$api_currency = $activity_results[$i]['currency'];
				$activityname = $activity_results[$i]['name'];
		
				$countrylist = $activity_results[$i]['country'];
				$destinationArr = $countrylist['destinations'][0];
				$destinationCode = $destinationArr['code'];
				$destinationName = $destinationArr['name'];
		
		
				$amountsFromArr = $activity_results[$i]['amountsFrom'];
		
				$priceArr = array();
				foreach ($amountsFromArr as $amountsFrom) {
					if ($amountsFrom['paxType'] == 'ADULT') {
						$amount = $amountsFrom['amount'];
						$priceArr['ADULT'] = $amount;
					}
					if ($amountsFrom['paxType'] == 'CHILD') {
						$ageFrom = $amountsFrom['ageFrom'];
						$ageTo = $amountsFrom['ageTo'];
						$amount = $amountsFrom['amount'];
						$priceArr['CHILD'][$ageFrom . '-' . $ageTo] = $amount;
					}
				}
		
				//$Total_LowestRate =($priceArr['ADULT']*$adults);
				$Total_LowestRate = $priceArr['ADULT'];
				$childAge='';
				$childAgestr = str_replace('0_', '', $childAge);
				$childAgeArr = explode(",", $childAgestr);
		
				if(isset($priceArr['CHILD'])){
				$children=0;
					$ChildPrice = $priceArr['CHILD'];
				
					//$pricelaga ='ADULT:'.$priceArr['ADULT'];
					for ($c = 0; $c < $children; $c++) {
						$age = $childAgeArr[$c];
						$AgeExist = 'No';
						foreach ($ChildPrice as $k => $v) {
							$kArr = explode("-", $k);
							$minage = $kArr[0];
							$maxage = $kArr[1];
							if (($age >= $minage) && ($age <= $maxage)) {
								$child_amount = $v;
								$AgeExist = 'Yes';
							}
						}
						if ($AgeExist == 'Yes') {
							$Total_LowestRate = ($Total_LowestRate + $child_amount);
						}
					}
				}
				/*
				 echo "<pre> Total Price:".$Total_LowestRate.' pricelaga:'.$pricelaga.'<br>';
				 print_r($priceArr);
				 */
				$Actual_Rate =$Total_LowestRate;
				$LowestRate = $this->convertCurrencyRateFlight($api_currency,$Total_LowestRate);
				$boxOfficeAmount = $amountsFrom['boxOfficeAmount'];
		
				$content = $activity_results[$i]['content']; 
		
				if(isset($content['description'])){ $description = $content['description']; } else { $description = ''; }
		
				if(isset($content['featureGroups'])){ $featureGroups = $content['featureGroups']; } else { $featureGroups = ''; }
				if(isset($content['media']['images'])){ 
					$images = $content['media']['images'];								
					$thumbNail = $images[0]['urls'][4]['resource']; 
					$findArr = array('http:', 'https:');
					$replaceArr = array('http://', 'https://');
					$thumbNailUrl = str_replace($findArr, $replaceArr, $thumbNail);					
				 } else { $thumbNailUrl='/images/nohotel.jpg'; $images=''; }
			
				//$thumbNailUrl=$this->checkThumbNail($thumbNailUrl);
				
				/* echo"<pre>";
				 print_r($images);die; */
				 
				$categorySegArr = array();
				$durationSegArr = array();
				$activityforSegArr = array();
		
				if(isset($content['segmentationGroups'])){  $segmentationGroups = $content['segmentationGroups'];
					foreach ($segmentationGroups as $s) {
						$groupCode = $s['code'];
						$groupName = $s['name'];
						$groupSegments = $s['segments'];
						$d = array();
						foreach ($groupSegments as $k => $v) {
							$d[] = $v['name'];
						}
			
						if ($groupCode == 1) {
							$categorySegArr =	$d;
						}
						if ($groupCode == 2) {
							$durationSegArr =	$d;
						}
						if ($groupCode == 3) {
							$activityforSegArr =	$d;
						}
					}
				} else { $segmentationGroups = ''; }
				
				$language='en';
				$data=array(
				'code'=>$activity_results[$i]['code'],
				'name'=>$activity_results[$i]['name'],
				'activity_type'=>$activity_results[$i]['type'],
				'source'=>$activity_results[$i]['source'],
				'thumbNailUrl'=>$thumbNailUrl,
				'country'=>$activity_results[$i]['country']['name'],
				'destination'=>$destinationName,
				'countryCode'=>$activity_results[$i]['country']['code'],
				'destinationCode'=>$destinationCode,
				'currency'=>$this->currency,
				'price'=>$LowestRate,
				'api_currency'=>$activity_results[$i]['currency'],
				'api_price'=>$Actual_Rate,
				'amountsFrom'=>json_encode($activity_results[$i]['amountsFrom']),
				'description'=>$description,
				'images'=>json_encode($images),
				'categories'=>@implode(',', $categorySegArr),
				'activity_for'=>@implode(',', $activityforSegArr),
				'duration'=>@implode(',', $durationSegArr),
				'featureGroups'=>json_encode($featureGroups),
				'modalities'=>json_encode($activity_results[$i]['modalities']),
				'content'=>json_encode($content) ,
				'checkin'=>$checkIn,
				'checkout'=>$checkIn,
				'language'=>$language,
				'adults'=>$adults,
				'childs'=>$childs,
				'search_session'=>$search_id,
				'date_time'=>date('Y-m-d H:i:s'),
			);
			
			$status = Crud_Model::insertData('search_results_hotelbeds_activity',$data);
		
			}
			// dd($destinationCode,$data['currency'],$data['price']);
			$this->createLanding(@$destinationCode,$data['currency'],$data['price'],$search_id,$data['thumbNailUrl']);
		
			$data = array('totalItems' => $totalItems);
			echo json_encode($data);

				  die;
		}
		
		public function Show_Activity(Request $request){
			$data = array();
			$limit = 15;
			if (($request["page"] <= 1) || ($request["page"] == '')) {
				$page = 0;
			} else {
				$page = (($request["page"] - 1) * $limit);
			}
		
			$moreCod = " and price>0 ";
		
			if ($request['Cri_Categories'] != '' && $request['Cri_Categories'] != 'undefined') {
				$request['Cri_Categories']=substr($request['Cri_Categories'], 0, -1);
				$Cri_GroupArr = explode(",", $request['Cri_Categories']);
				$moreCod .= " and ( ";
				$groupStr = '';
				foreach ($Cri_GroupArr as $v) {
					$groupStr .= "categories LIKE '%" . str_replace('~', '&', $v) . "%' || ";
				}
				$groupStr = substr($groupStr, 0, -3);
				$moreCod .= $groupStr . " ) ";
			}
		
			if ($request['Cri_Price'] != '') {
				$Cri_PriceArr = explode("-", $request['Cri_Price']);
				$moreCod .= " and ( price BETWEEN '" . $Cri_PriceArr[0] . "' and '" . $Cri_PriceArr[1] . "' ) ";
			}
		
			//// Filter by Recommended Activity For
			if (($request['Cri_Activity'] != 'undefined') && ($request['Cri_Activity'] != '')) {
				$Cri_Activity = explode(",", $request['Cri_Activity']);
				$a = 0;
				$moreCod .= " and (";
				foreach ($Cri_Activity as $val) {
					$moreCod .= " activity_for like '%" . $val . "%'";
					if ($a < count($Cri_Activity) - 1) {
						$moreCod .= " OR ";
					}
					$a++;
				}
				$moreCod .= " ) ";
			}

			//// Filter by Activity Duartion
			if (($request['Cri_Duration'] != 'undefined') && ($request['Cri_Duration'] != '')) {
					$request['Cri_Duration']=substr($request['Cri_Duration'], 0, -1);
				$Cri_Duration = explode(",", $request['Cri_Duration']);
				$a = 0;
				$moreCod .= " and (";
				foreach ($Cri_Duration as $val) {
					$moreCod .= " duration like '%" . $val . "%'";
					if ($a < count($Cri_Duration) - 1) {
						$moreCod .= " OR ";
					}
					$a++;
				}
				$moreCod .= " ) ";
			}
		
			if ($request['activity_name'] != '') {
				$moreCod .= " and LCASE(name) like '%" . strtolower($request['activity_name']) . "%'";
			}
		
			/// Orderby
			$orderby_val = $request['orderby_val'];
			$orderBy = '';
		
			if ($request['orderby_fild'] == 'price') {
				$orderBy .= 'order by price ' . $orderby_val;
			} else if ($request['orderby_fild'] == 'activity') {
				$orderBy .= 'order by name ' . $orderby_val;
			} else {
				$orderBy = ' order by price ASC';
			}
			$search_id=$request['search_id'];
			$res =DB::select("select count(*) as totalCount from search_results_hotelbeds_activity where search_session='".trim($search_id)."'".$moreCod." ".$orderBy."");
			$totalcount = $res[0]->totalCount;
		
			$Sqls = "select * from search_results_hotelbeds_activity where search_session='".trim($search_id)."'".$moreCod." ".$orderBy." LIMIT ".$page.", $limit";
			$results=DB::select($Sqls);
			foreach ($results as $Objs) {
				$data['result'][] = array('total' => $totalcount, 'code' => $Objs->code, 'Name' => $Objs->name, 'activity_type' => $Objs->activity_type, 'source' => $Objs->source, 'thumbNailUrl' => $Objs->thumbNailUrl, 'country' => $Objs->country, 'destination' => $Objs->destination, 'countryCode' => $Objs->countryCode, 'destinationCode' => $Objs->destinationCode, 'price' => $Objs->price, 'amountsFrom' => json_decode($Objs->amountsFrom), 'description' => $Objs->description, 'ActivityImages' => json_decode($Objs->images), 'segmentationGroups' => json_decode($Objs->content), 'featureGroups' => json_decode($Objs->featureGroups), 'modalities' => json_decode($Objs->modalities), 'checkin' => $Objs->checkin, 'checkout' => $Objs->checkout, 'search_session' => $Objs->search_session, 'categories' => $Objs->categories, 'tid' => $Objs->id, 'duration' => $Objs->duration);
			}
			$datastr = json_encode($data);
			return $datastr;
			die;
	} 
	
		public function GetControls(Request $request){
		$search_id=$request['search_id'];
		$moreCod = ' AND price >0';
	/*=== Categories Name ===*/
		
		$categResults  = DB::select("select distinct categories,count(categories) as categoryCount from search_results_hotelbeds_activity where search_session='" .  $search_id. "' group by categories");
		
	$categoryList = array();
	foreach ($categResults as $catlist) {
		$categoryList[] = array('name' => $catlist->categories, 'value' => str_replace('&', '~', $catlist->categories), 'categoryCount' => $catlist->categoryCount);
	}

	/*=== Recommended Activity For ===*/
	$actResults = DB::select("select activity_for from search_results_hotelbeds_activity where search_session='" . $search_id . "'");
	$activityStr = '';
	foreach ($actResults as $obj) {
		$activityStr .= $obj->activity_for . ',';
	}
	
	$activityArr = explode(",", $activityStr);
	$activityArr = array_unique($activityArr);
	$activityArr = array_filter($activityArr);
	$activityList = array();
	foreach ($activityArr as $v) {
		$res = DB::select("SELECT count(*) as countactivity FROM search_results_hotelbeds_activity where concat(',', activity_for, ',') like '%," . $v . ",%'  and search_session='" . $search_id . "'");
		$aobj = $res[0];
		$activityList[] = array('title' => $v, 'count' => $aobj->countactivity);
	}

	/*=== Duration For Activity ===*/
	$durResults =  DB::select("select duration from search_results_hotelbeds_activity where search_session='" . $search_id . "'");
	$durationStr = '';
	foreach ($durResults as $dObj) {
		$durationStr .= $dObj->duration . ',';
	}
	$durationArr = explode(",", $durationStr);
	$durationArr = array_unique($durationArr);
	$durationArr = array_filter($durationArr);
			
	$durationList = array();
	foreach ($durationArr as $dt) {
		$dRes =  DB::select("SELECT count(*) as countduration FROM search_results_hotelbeds_activity where concat(',', duration, ',') like '%," . $dt . ",%'  and search_session='" . $search_id . "'");
		$dtObj = $dRes[0];
		$durationList[] = array('title' => $dt, 'count' => $dtObj->countduration);
	}	

	$sql = "SELECT count(code) as totalrecords, 
(select min(price) from search_results_hotelbeds_activity where search_session='" . $search_id . "' $moreCod)  as minrate , 
(select max(price) as maxrate from search_results_hotelbeds_activity where search_session='" . $search_id . "' $moreCod)  as maxrate
FROM search_results_hotelbeds_activity where search_session='" . $search_id . "' $moreCod";

	$resutls =  DB::select($sql);
	$obj = $resutls[0];

	$data = array('totalrecords' => $obj->totalrecords, 'minrate' => floor(preg_replace('/[^0-9^.]/', '', $obj->minrate)), 'maxrate' => ceil(preg_replace('/[^0-9^.]/', '', $obj->maxrate)), 'category_List' => $categoryList, 'activity_List' => $activityList, 'duration_List' => $durationList, 'currency_symbol' => $this->currency_symbol);
	
	echo json_encode($data);
	}
	
		public function Activity_Description(Request $request){			
									 
			 $actionUrl=$this->endpoint.'/activities/details/full';
			 for($b=0;$b<$request["adults"];$b++){
			 $packs[] =array('age'=>(30+$b));
			 }
			 
			 if($request["childs"]>0){	
			  for($d=0;$d<$request["childs"];$d++){	 
				 $packs[] =array('age'=> (4+$d));
				}
			 }
			
			$postdata =array('code'=>$request["code"],'from'=>$request["checkIn"],'to'=>$request["checkOut"],'language'=>'en','paxes'=>$packs);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $actionUrl);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerData);
			$contents = curl_exec($ch);
			curl_close($ch);				
			$this->createLogFile('Description',json_encode($postdata),$contents);
			$data=array(
				'code'=>$request["code"],
				'search_session'=>$request["search_session"],
				'request'=> json_encode($postdata),
				'response'=>$contents,
				'date_time'=>date('Y-m-d H:i:s'),
			);
			$status = Crud_Model::insertData('hotelbeds_activity_details',$data);
						
			
				$jsonData = $contents;
		
			$response = json_decode($jsonData, true);
		
			$operationId = $response['operationId'];
		
			$ActivityResponseArr = $response['activity'];
		
			$contentArr = $ActivityResponseArr['content'];
		
			$contentId = $contentArr['contentId'];
			$description = $contentArr['description'];
		
			$datadescription = preg_replace('#(?:<br\s*/?>\s*?){2,}#', '</p><p>', $description);
		
			if(isset($contentArr['detailedInfo'][0])){ $detailedInfo = str_replace("\\n", '', $contentArr['detailedInfo'][0]); } else{ $detailedInfo=''; }
		
			$featureGroups = $contentArr['featureGroups'];
			if(isset($contentArr['guidingOptions']['guideType'])){ $guidingOptions = $contentArr['guidingOptions']['guideType']; }else{ $guidingOptions =''; }
		
			$segmentationGroups = $contentArr['segmentationGroups'];
			$ActivityImages = $contentArr['media']['images'][0]['urls'];
		
			$activityFor = array();
			$Categories = array();
			$Duration = array();
				$ActivitiesFor='';
			foreach ($segmentationGroups as $s) {
		
				$groupCode = $s['code'];
				$groupName = $s['name'];
				$groupSegments = $s['segments'];
		
				if ($groupCode == 1) {
					$Categories = array('code' => $groupCode, 'name' => $groupName, 'segments' => $groupSegments);
		
					//$Categories =$s['segments'];
				}
				if ($groupCode == 2) {
					$Duration = array('code' => $groupCode, 'name' => $groupName, 'segments' => $groupSegments);
				}
				if ($groupCode == 3) {
					$ActivitiesFor = array('code' => $groupCode, 'name' => $groupName, 'segments' => $groupSegments);
				}
			}
		
			$excludedArr = array();
			$includedArr = array();
		
			for ($i = 0; $i < count($featureGroups); $i++) {
				$excluded = array();
		
				$groupCode = $featureGroups[$i]['groupCode'];
				if(isset($featureGroups[$i]['excluded'])){ $excluded = $featureGroups[$i]['excluded'];  }else { $excluded='';  }
				 
				if(isset($excluded[0]['featureType'])){  $featureType = $excluded[0]['featureType']; }else { $featureType='';  }
				if(isset($excluded[0]['description'])){  $Exdescription = $excluded[0]['description']; }else { $Exdescription='';  }
				 
				if(isset($featureGroups[$i]['included'])){  $included = $featureGroups[$i]['included']; }else { $included='';  }
				if(isset($included[0]['featureType'])){  $incfeatureType = $included[0]['featureType']; }else { $incfeatureType='';  }
				if(isset($included[0]['description'])){  $incdescription = $included[0]['description']; }else { $incdescription='';  }
		
				if ($featureType) {
					$excludedArr[]  = array('groupCode' => $groupCode, 'excluded' => $featureType);
				}
				if ($included) {
					$includedArr[] = array('groupCode' => $groupCode, 'included' => $incfeatureType);
				}
			}
			//echo json_encode($excludedarr).'<br>';
			//echo json_encode($includedarr).'<br>'; 
		
		
			$ActivitySummary = array('code' => $ActivityResponseArr['code'], 'activityCode' => $ActivityResponseArr['activityCode'], 'Name' => $ActivityResponseArr['name'], 'type' => $ActivityResponseArr['type'], 'currency' => $ActivityResponseArr['currency'], 'contentId' => $contentId, 'description' => str_replace("\\n", '', $datadescription), 'currencycl' => $this->currency, 'detailedInfo' => strip_tags($detailedInfo), 'guidingOptions' => $guidingOptions);
		
			$api_currency = $ActivityResponseArr['currency']; //Api currency
		
			//$conversion_rate =conversionRate($currency);
			$conversion_rate = 0;//getConversionRate($api_currency, $currency, 'Hotelbed');
			$response_date['Response']['adh_conversion_rate'] = array('currency' => $this->currency, 'conversion_rate' => $conversion_rate);
		
		
			$modalitiesArr = $ActivityResponseArr['modalities'];
		
			for ($i = 0; $i < count($modalitiesArr); $i++) {
				$Total_LowestRate  = $modalitiesArr[$i]['rates'][0]['rateDetails'][0]['totalAmount']['amount'];
		
				$Contract_Remarks = $modalitiesArr[$i]['comments'][0]['text'];
	
		
				$Actual_Rate = $Total_LowestRate; 
				$Total_Rate = $this->convertCurrencyRateFlight($api_currency,$Total_LowestRate); 
		
				$ActivityResponseArr['modalities'][$i]['Without_Convert_Actual_Rate'] = $Total_LowestRate;
				$ActivityResponseArr['modalities'][$i]['Actual_Rate'] = $Actual_Rate;
				$ActivityResponseArr['modalities'][$i]['total_price'] = $Total_Rate;
				$ActivityResponseArr['modalities'][$i]['price_frame'] = '';//$PriceFrameConverted;
				$ActivityResponseArr['modalities'][$i]['comments'] = explode("//", $Contract_Remarks);
			}
		
		
		
			$ActivityFareResponse = $ActivityResponseArr['modalities'][0]['amountsFrom'];
			for ($i = 0; $i < count($ActivityFareResponse); $i++){
				$ActivityList = $ActivityFareResponse[$i];
				/* overrite price only ==*/
				//$api_currency ='INR';
				$amount = $ActivityList['amount'];
				$amount = $this->convertCurrencyRateFlight($api_currency,$amount);  
		
				$boxOfficeAmount = $ActivityList['boxOfficeAmount'];
				$boxOfficeAmount = $this->convertCurrencyRateFlight($api_currency,$boxOfficeAmount); 
		
				$ActivityList['amount'] = $amount;
				$ActivityList['boxOfficeAmount'] = $boxOfficeAmount;
				$ActivityTypes[] = $ActivityList;
			}
			$ActivityArrList = array('size' => count($ActivityTypes), 'ActivityTypes' => $ActivityTypes);
		
			$data = array(
				'ActivitySummary' => $ActivitySummary,
				'country' => $ActivityResponseArr['country'],
				'amountsFrom' => $ActivityResponseArr['amountsFrom'],
				'modalities' => $ActivityResponseArr['modalities'],
				'featureGroups' => $featureGroups,
				'segmentationGroups' => $segmentationGroups,
				'Categories' => $Categories,
				'Duration' => $Duration,
				'ActivitiesFor' => $ActivitiesFor,
				'featureIncluded' => $includedArr,
				'featureExcluded' => $excludedArr,
				'ActivityImages' => array(
					'size' => count($ActivityImages),
					'ActivityImage' => $ActivityImages,
				),
				'ActivityFare' => $ActivityArrList,
				'conversion_rate' => $conversion_rate,
				'currency' => $this->currency,
			);
			
			$data = array('status' => 200, 'status_message' => 'OK', 'responseData' => $data);		
			echo json_encode($data);
	}
	
	
	public function ActivityFinalCheckout(Request $request)  
    {
		$request_data=array();
		$request_data=$request->input();
		$activitySearchData=crud_model::readOne('search_results_hotelbeds_activity',array('id'=>$request->input('ref_id'))); 
		$code[]=$request_data['code'];
		$total_amount=$request_data['apiPrice'];
		$total_currency=$request_data['currency'];
	 	$paxes =array();	
	 
	 	$adults =$activitySearchData->adults;
	 	$childs =$activitySearchData->childs;
	 
	 for($a=0;$a<$adults;$a++){
	  $age=date_diff(date_create($request_data['passenger']['adult']['dob'][$a]), date_create(date("Y-m-d")))->format('%y');
	  $titles =$request_data['passenger']['adult']['title'][$a];
	  $fname =$request_data['passenger']['adult']['first_name'][$a];	
      $lname =$request_data['passenger']['adult']['last_name'][$a];	  
	  $paxes[] =array('age'=>$age,'type'=>'ADULT','name'=>$fname,'surname'=>$lname);
	 }
	 for($c=0;$c<$childs;$c++){
	  $age=date_diff(date_create($request_data['passenger']['child']['dob'][$a]), date_create(date("Y-m-d")))->format('%y');
	  $titles =$request_data['passenger']['child']['titles'][$c];
	  $fname =$request_data['passenger']['child']['first_name'][$c];	
      $lname =$request_data['passenger']['child']['last_name'][$c];	 
	  $paxes[] =array('roomId'=>$age,'type'=>'CHILDREN','name'=>$fname,'surname'=>$lname);
	 }
		$pre_title=$request_data['passenger']['adult']['title'][0];
		$firstName=$request_data['passenger']['adult']['first_name'][0];
		$lastName=$request_data['passenger']['adult']['last_name'][0];
		$username=$firstName.' '.$lastName;
		$order_id=strtoupper(uniqid());
		
		$booking_mode='Test';
		$paymentType=$request_data['paymentType'];
		
		$Tolerance='';
		$isTolerance='Yes';   
		if($isTolerance=='Yes'){
		$Tolerance ='2';  
		}
		
		$answers[] = array('question' => 
			array("code" => "HOTEL_NAME", 
            "text" => "Pleaseadvisethenameofyourhotel", 
            "required" => true ), 'answer' => "oyohotel");
		$rateKey=$request_data['ratekey'];
		$from=$activitySearchData->checkin;
		$to=$activitySearchData->checkout;
		$departureDate=$activitySearchData->checkin;
		$request_data['passenger']['country']='IN';
		$postArr = array(
			'language' => 'en',
			'clientReference' => $order_id,  
			'holder' => array('title' => $pre_title, 'name' => $firstName, 'surname' => $lastName, 'email' => $request_data['passenger']['email'], 'address' => $request_data['passenger']['address'], 'zipCode' => $request_data['passenger']['pin_code'], 'country' => $request_data['passenger']['country'], 'mailing' => true, 'mailUpdDate' => $departureDate, 'telephones' => [$request_data['passenger']['phone']]),
			'activities' => array(array('answers' => $answers, 'preferedLanguage' => 'en', 'serviceLanguage' => 'en', 'rateKey' => $rateKey, 'from' => $from, 'to' => $to, 'paxes' => $paxes))
		);
   
    $request_xml = json_encode($postArr);
	$user_id=$request_data['user_id'];
	if($user_id==''){
			$user_id=$this->createUser($firstName,$lastName,$request_data['passenger']['email'],$request_data['passenger']['phone'],$request_data['passenger']['address'],$request_data['passenger']['country'],$request_data['passenger']['country']);
		}

		$data=array(
		'order_id'=>$order_id,
		'booking_status'=>'Pending',
		'hotel_img'=>$activitySearchData->thumbNailUrl,
		'hotel_id'=>$activitySearchData->code,
		'hotelName'=>$activitySearchData->name,
		'hotelAddress'=>$activitySearchData->destination,
		'hotelCity'=>$activitySearchData->destination,
		'hotelCountryCode'=>$activitySearchData->countryCode,
		'user_name'=>$username,
		'login_id'=>$user_id,
		'user_id'=>$user_id,
		'user_email'=>$request_data['passenger']['email'],
		'user_contactno'=>$request_data['passenger']['phone'],
		'request_xml'=>$request_xml,
		'check_in'=>$activitySearchData->checkin,
		'check_out'=>$activitySearchData->checkout,
		'chargable_rate'=>$request_data['chargeableRate'],
		'adh_chargable'=>$request_data['chargeableRate'],
		'currency_code'=>$this->currency,
		'api_currency'=>$request_data['api_currency'],
		'api_price'=>$request_data['apiPrice'],
		'language'=>'en',
		'adults'=>$activitySearchData->adults,
		'children'=>$activitySearchData->childs,
		'booking_mode'=>$booking_mode,
		'payment_status'=>'Pendind',
		'product'=>'activity',
		'supplier'=>'Hotelbeds',
		'date_time'=>date('Y-m-d H:i:s'),
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
		'ip_address'=>$_SERVER['REMOTE_ADDR']
		);
		$value = Crud_Model::insertData('twc_booking',$data);
		//return redirect('/tours-payment/'.base64_encode($order_id)."/".base64_encode($request_data['chargeableRate']));
		
		$redirect_page=url('/')."/travel/payment/".$request_data['payment_type']."/?order_id=".$order_id."&module=tours";
		if($request_data['payment_type']=='wallet'){
			$return=$this->WalletDeduct($request_data['chargeableRate'],$request_data['api_currency'],$user_id,$order_id);
			$redirect_page=url('/')."/book-hotel?order_id=".$order_id;
		}
		
		//return redirect($redirect_page);
		
		Crud_Model::updateData('twc_booking',array('payment_status'=>'Confirmed'),array('order_id'=>$order_id));
		$redirect_page=url('/')."/book-tours?order_id=".$order_id;
		
		
		return redirect($redirect_page);
		
	}
		
		
		//  Book Flight Start 
	public function BookActivity(Request $request){
	   $order_id=$request->input('order_id');
	   $hotel_book_req=crud_model::readOne('twc_booking',array('order_id'=>$request['order_id']));
	   $request_xml=$hotel_book_req->request_xml;
	   $payment_status=$hotel_book_req->payment_status;
	   
	   if($payment_status=='Confirmed'){
			$actionUrl=$this->endpoint.'/bookings';
			$data= crud_model::readOne('twc_booking',array('order_id'=>$order_id)); 
		    $requestBody=$data->request_xml;
		    $hotelbeds_key='88013eb226283db1bd72df7fb137e9cf';
		    $hotelbeds_secret='e9c8421e54'; 
			
		    $signature = hash("sha256", $this->hotelbeds_key.$this->hotelbeds_secret.time());
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $actionUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept:application/json','Content-Length:' .strlen($requestBody),'Api-key:'.$hotelbeds_key, 'X-Signature:'.$signature));
		$contents = curl_exec($ch);
		$this->createLogFile('BookActivity_'.$order_id,$requestBody,$contents);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
			  $ResonseArr = json_decode($contents, true);
			  if (isset($ResonseArr['errors']) || isset($ResonseArr['error'])) {
				$booking_status = 'Failed';
				$itineraryId = '-1';
				$confirmationNumbers = '-1';
			  } else {
			  	$status = $ResonseArr['booking']['status'];
			  	$reference = $ResonseArr['booking']['reference'];
				$booking_status = 'Confirmed';
				$itineraryId = $ResonseArr['booking']['reference'];
				$confirmationNumbers = $ResonseArr['booking']['clientReference'];
			  }
			  
			 $data=array(
				'itineraryId'=>$itineraryId ,
				'confirmationNumbers'=>$confirmationNumbers,
				'booking_status'=>$booking_status,
				'payment_status'=>$payment_status,
				'response_xml'=>$contents,	
			 );
			  
			 $value = Crud_Model::updateData('twc_booking',$data,array('order_id'=>$order_id));		
		}
		return redirect('/tours-confirmation/'.base64_encode($order_id));	
 }	
 
 
	public function BookingCancellation(Request $request){
	$obj=crud_model::readOne('twc_booking',array('order_id'=>$request['order_id']));
	   $itineraryId=$obj->itineraryId;
		
		$signature = hash("sha256", $this->hotelbeds_key.$this->hotelbeds_secret.time());
	
		$actionUrl=$this->endpoint.'/bookings/es/'.$itineraryId.'?cancellationFlag=CANCELLATION';
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $actionUrl);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept:application/json','Api-key:'.$this->hotelbeds_key, 'X-Signature:'.$signature));
		 $contents = curl_exec($ch);
		curl_close($ch);
		$this->createLogFile('Cancellation-'.$request['order_id'],$actionUrl,$contents);
			$Response_Arr = json_decode($contents, true);
		
		 if(isset($Response_Arr['errors'])) {
				$ResponseStatus = 'Failed';
				$itineraryId = '-1';
				$confirmationNumbers = '-1';
				$return=array('error'=>'Yes','msg'=>str_replace('\'','',$Response_Arr['errors'][0]['text']));
				$booking_status=$obj->booking_status;
				
		} else {
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
			  
			 $value = Crud_Model::updateData('twc_booking',$data,array('order_id'=>$request['order_id']));	
		echo json_encode($return);	
	}	

	//  create user start
	public function createUser($first_name,$last_name,$email,$phone,$address,$city,$country){
		$obj= crud_model::readOne('user',array('email'=>$email)); 

		if(!is_object($obj)){
			$password=rand();
			$data=array(
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

	public function convertCurrencyRateFlight($from,$price){
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
		$price=number_format($price,2, '.', '');
		return $price;
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
				  'txn_detail' => 'Wallet Deduct for Tours Booking Regarding order id '.$order_id,
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
	
	public function createLogFile($action,$request,$response){  
		$credentials="hotelbeds_key=".$this->hotelbeds_key."\r\n hotelbeds_secret=".$this->hotelbeds_secret."\r\n endpoint=".$this->endpoint; 
		$file_name =$action.'-'.date('dmy his');	
		$log_filename = "travel/LogFileTours"; 
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
			if (strpos($query, 'NoSuchKey')== true){ $thumbnail= url('').'images/nohotel.jpg';  } else{   }
			
			return $thumbnail; }
		
		
		public function createLanding($toIATA,$api_currency,$total_amount,$search_id,$image){
			$citySingelTO = crud_model::readOne('airports',array('code'=>$toIATA));
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
					'page_id' => 'tours-in-'.$toIATA,
					'name' =>'Tours In '.$citySingelTO->city_name,
					'image' => $image,
					'title' => 'Tours In '.$citySingelTO->city_name,
					'meta_keywords' =>'Tours In '.$citySingelTO->city_name,
					'meta_description' =>'Tours In '.$citySingelTO->city_name,
					'content' =>'Tours In '.$citySingelTO->city_name,
					'other_content' => json_encode($other_content),
					'status' => 'active',
					'type' => 'landing',
					'type_name' => 'tours',
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
			$flightData=crud_model::readOne('pages',array('city_to_code'=>$citySingelTO->code,'type'=>'landing','type_name'=>'tours'));
			if(!is_object($flightData)){  
				$status = Crud_Model::insertData('pages',$data); 				
			}else{ 
				$status = Crud_Model::updateData('pages',$data,array('city_to_code'=>$citySingelTO->code,'type'=>'landing','type_name'=>'tours'));
			}
	}
		
}


