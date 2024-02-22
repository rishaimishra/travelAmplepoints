<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud_Model;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Auth;




class Transfers extends Controller
{
   		public $currency='';  public $currency_symbol=''; public $signature=''; public $headerData='';
		public $hotelbeds_key='c55c8d967d5e397eade586aa4b06c8e4';
		public $hotelbeds_secret='85e16b438a'; 
		public $endpoint="https://api.test.hotelbeds.com/transfer-api/1.0";
		
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
			$search_id=$request['search_session'];
			$adults=$request['adults'];
			$childs=$request['childs'];
			$infants=$request['infants']; 
			$countryCode=$request['countryCode'];
			$regionid=$request['city_code'];  
			
			$origin_type=$request['origin_type'];
			$origin_code=$request['origin_code'];
			$destination_type=$request['destination_type'];
			$destination_code=$request['destination_code'];
			
			$departure_date = str_replace('/', '-', $request['departure_date']);
			$departure_date=date('Y-m-d',strtotime($departure_date));
			$pickupTime=$request['pickupTime'];

			$retutn_date = str_replace('/', '-', $request['retutn_date']);
			$retutn_date=date('Y-m-d',strtotime($retutn_date));
			$returnTime=$request['returnTime'];
			
			$isoneway=$request['isoneway'];

			if($childs==''){$childs=0;}
			if($infants==''){$infants=0;}

			$DepartureTime=$departure_date.'T'.$pickupTime.':00';
			$ArrivalTime=$retutn_date.'T'.$returnTime.':00';
			
			$URL=$this->endpoint.'/availability/en/from/'.$origin_type.'/'.$origin_code.'/to/'.$destination_type.'/'.$destination_code.'/'.$DepartureTime.'/'.$adults.'/'.$childs.'/'.$infants;
			
			if($isoneway=='No'){		
			$URL=$this->endpoint.'/availability/en/from/'.$origin_type.'/'.$origin_code.'/to/'.$destination_type.'/'.$destination_code.'/'.$DepartureTime.'/'.$ArrivalTime.'/'.$adults.'/'.$childs.'/'.$infants;			
			} 
	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $URL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerData);
			$contents = curl_exec($ch);
			curl_close ($ch);
	
			$this->createLogFile('Search-'.$this->hotelbeds_key,$URL,$contents);
			 $contents;
			
			$Response_Arr =json_decode($contents, true);
			
			$error='';
			if(isset($Response_Arr['fieldErrors'])){
				$error=$Response_Arr['fieldErrors'][0]['message'];
			}
			else{
				$Search_data =$Response_Arr['search'];
				$TransferList_arr =$Response_Arr['services'];
				for($i=0;$i<count($TransferList_arr);$i++){
				   $isReturn=0;
				   if($TransferList_arr[$i]['direction']=='RETURN'){
					$isReturn=1;
			}
		
		$mustCheckPickupTime=$TransferList_arr[$i]['pickupInformation']['pickup']['checkPickup']['mustCheckPickupTime'];
		
		$content =$TransferList_arr[$i]['content'];
		$imagesUrl =$content['images'][2]['url'];
		$transferDetailInfo =$content['transferDetailInfo']; 
		$customerTransferTimeInfo =$content['customerTransferTimeInfo'];
		$supplierTransferTimeInfo =$content['supplierTransferTimeInfo'];
		$api_currency=$TransferList_arr[$i]['price']['currencyId'];
		
		$lowRate = $this->convertCurrencyRateFlight($api_currency,$TransferList_arr[$i]['price']['totalAmount']); 
		$NetAmount = $this->convertCurrencyRateFlight($api_currency,$TransferList_arr[$i]['price']['netAmount']); 
		$actual_price =$TransferList_arr[$i]['price']['totalAmount'];
	
			
			$data=array(
			'Name'=>$TransferList_arr[$i]['vehicle']['name'],
			'desti_code'=>$regionid,
			'TransferType'=>$TransferList_arr[$i]['transferType'],
			'Category'=>$content['category']['name'],
			'Direction'=>$TransferList_arr[$i]['direction'],
			'FromType'=>$TransferList_arr[$i]['pickupInformation']['from']['type'],
			'origin_name'=>$Search_data['from']['description'],
			'FromCode'=>$TransferList_arr[$i]['pickupInformation']['from']['code'],
			'ToType'=>$TransferList_arr[$i]['pickupInformation']['to']['type'],
			'destination_name'=>$Search_data['to']['description'],
			'ToCode'=>$TransferList_arr[$i]['pickupInformation']['to']['code'],
			'mustCheckPickupTime'=>$mustCheckPickupTime,
			'minPaxCapacity'=>$TransferList_arr[$i]['minPaxCapacity'],
			'maxPaxCapacity'=>$TransferList_arr[$i]['maxPaxCapacity'],
			'rateKey'=>$TransferList_arr[$i]['rateKey'],
			'actual_price'=>$actual_price,
			'lowRate'=>$lowRate, 
			'countryCode'=>$countryCode, 
			'NetAmount'=>$NetAmount,
			'api_currency'=>$api_currency,
			'TransferDetailInfo'=>json_encode($transferDetailInfo),
			'CustomerTransferTimeInfo'=>json_encode($customerTransferTimeInfo),
			'SupplierTransferTimeInfo'=>json_encode($supplierTransferTimeInfo),
			'ImageUrl'=>$imagesUrl,
			'CancellationPolicies'=>json_encode($TransferList_arr[$i]['cancellationPolicies']),
			'PickupInformation'=>json_encode($TransferList_arr[$i]['pickupInformation']),
			'isReturn'=>$isReturn,
			'return_date'=>$retutn_date,
			'departure_date'=>$departure_date,
			'currency'=>$this->currency,
			'adults'=>$adults,
			'childs'=>$childs,
			'infants'=>$infants,
			'language'=>'en',
			'search_session'=>$search_id,
			'date_time'=>date("Y-m-d h:i:s"),
			);
			$value = Crud_Model::insertData('search_results_hbd_transfer',$data);
	
		}
		$total_records =count($TransferList_arr);
	}
	
	$data =array('error'=>$error,'total_records'=>$total_records);
	echo json_encode($data);

		}
		
		public function Show_Transfers(Request $request){
			
		$data = array();
		$limit =15;
		if(($request["page"]<=1) || ($request["page"]=='')){
			$page = 0;
		}else{
			$page = ( ($request["page"]-1) * $limit);
		}
		$moreCod='';
		//$moreCod =" and currency ='".$currency."' and language='".$language."' and lowRate>0 ";
		$moreCod.= "and Direction='DEPARTURE'";
	
		//// Price filter
		if($request['Cri_Price']!=''){
		   $Cri_PriceArr=explode("-",$request['Cri_Price']);
		   $moreCod.= " and ( lowRate BETWEEN '".$Cri_PriceArr[0]."' and '".$Cri_PriceArr[1]."' ) ";
		 }
		
		//// Vehicle filter
/*		if($request['Cri_Tag']!='' && $request['Cri_Tag']!='undefined'){
		  $request['Cri_Tag']=substr($request['Cri_Tag'], 0, -1);
		  $moreCod.= " and ( ";
		   $groupStr='';
			$groupStr.= " `Name` in (".$request['Cri_Tag'].")";
		  $moreCod.= $groupStr." ) ";
		 }*/
		 
		 if ($request['Cri_Tag'] != '' && $request['Cri_Tag'] != 'undefined') {
				$request['Cri_Tag']=substr($request['Cri_Tag'], 0, -1);
				$Cri_TagArr = explode(",", $request['Cri_Tag']);
				$moreCod .= " and ( ";
				$groupStr = '';
				foreach ($Cri_TagArr as $v) {
					$groupStr .= "Name LIKE '%" .  $v . "%' || ";
				}
				$groupStr = substr($groupStr, 0, -3);
				$moreCod .= $groupStr . " ) ";
			}
		 
		//// Category filter
		 /*if($request['Category_Tag']!='' && $request['Category_Tag']!='undefined'){
		  $request['Category_Tag']=substr($request['Category_Tag'], 0, -1);
		  $moreCod.= " and ( ";
		   $groupStr='';
			$groupStr.= " `Category` in (".$request['Category_Tag'].")";
		  $moreCod.= $groupStr." ) ";
		 }*/
		  if ($request['Category_Tag'] != '' && $request['Category_Tag'] != 'undefined') {
				$request['Category_Tag']=substr($request['Category_Tag'], 0, -1);
				$Category_TagArr = explode(",", $request['Category_Tag']);
				$moreCod .= " and ( ";
				$groupStr = '';
				foreach ($Category_TagArr as $v) {
					$groupStr .= "Category LIKE '%" .  $v . "%' || ";
				}
				$groupStr = substr($groupStr, 0, -3);
				$moreCod .= $groupStr . " ) ";
			}
		 
		 //// Transfer Type filter
		 /*if($request['Cri_Groups']!='' && $request['Cri_Groups']!='undefined'){
		    $request['Cri_Groups']=substr($request['Cri_Groups'], 0, -1);
		   $moreCod.= " and ( ";
		   $groupStr='';
			$groupStr.= " `TransferType` in (".$request['Cri_Groups'].")";
		  $moreCod.= $groupStr." ) ";
		 }*/
		 if ($request['Cri_Groups'] != '' && $request['Cri_Groups'] != 'undefined') {
				$request['Cri_Groups']=substr($request['Cri_Groups'], 0, -1);
				$Cri_GroupArr = explode(",", $request['Cri_Groups']);
				$moreCod .= " and ( ";
				$groupStr = '';
				foreach ($Cri_GroupArr as $v) {
					$groupStr .= "TransferType LIKE '%" .  $v . "%' || ";
				}
				$groupStr = substr($groupStr, 0, -3);
				$moreCod .= $groupStr . " ) ";
			}
	
		/// Orderby
		$orderby_val =$request['orderby_val']; 
		$orderBy='';
		
		if($request['orderby_fild']=='price'){
			$orderBy.='order by lowRate '.$orderby_val;
		}
		else if($request['orderby_fild']=='transfer_name'){
			$orderBy.='order by Name '.$orderby_val;
		}
		else if($request['orderby_fild']=='seat'){
			$orderBy.='order by maxPaxCapacity '.$orderby_val;
		}
		else{
			$orderBy =' order by lowRate ASC';
		}	
		
	    	$search_Session_Id=$request['search_id'];				
			$Sqqls = "select count(Name) as totalCount from search_results_hbd_transfer where search_session='".trim($search_Session_Id)."' ".$moreCod." ".$orderBy."";
			$res =DB::select($Sqqls);
			$totalcount = $res[0]->totalCount;
		
			$Sqls = "select * from search_results_hbd_transfer where search_session='".trim($search_Session_Id)."'".$moreCod." ".$orderBy." LIMIT ".$page.", $limit";

			$results=DB::select($Sqls);
			foreach ($results as $Objs){
				$TransferDetailInfo =json_decode($Objs->TransferDetailInfo,true);
				$TransferDetailInfoArr = array();
				for($i=0;$i<count($TransferDetailInfo);$i++){
					$Transferdescription=$TransferDetailInfo[$i]['description'];
					if($Transferdescription==null){
					$Transferdescription=$TransferDetailInfo[$i]['name'];
					}
					$TransferDetailInfoArr[]  =array('id'=>$TransferDetailInfo[$i]['id'],'type'=>$TransferDetailInfo[$i]['type'],'description'=>$Transferdescription);
				}
	
				$SupplierTransferTimeInfo =json_decode($Objs->SupplierTransferTimeInfo,true);
				$SupplierTransferArr = array();
				for($i=0;$i<count($SupplierTransferTimeInfo);$i++){
					$supp_type=$SupplierTransferTimeInfo[$i]['type'];
					$waitingType = substr($supp_type, strrpos( $supp_type, '_' )+1 );
					$SupplierTransferArr[]  =array('value'=>$SupplierTransferTimeInfo[$i]['value'],'type'=>$supp_type,'metric'=>$SupplierTransferTimeInfo[$i]['metric'],'waitingType'=>$waitingType);
				}
	
				$CancellationPolicies =json_decode($Objs->CancellationPolicies,true);
				
				$cancellationPolicyArr =$CancellationPolicies;	
				$Ob_cancellationPolicy=''; 
				foreach($cancellationPolicyArr as $v){
					$cancamount =$v['amount'];
					$api_currency =$v['currencyId'];
					$cancamount =ConvertCurrencyRate($api_currency,$currency,$cancamount);
					$cancamount =convertCustomRate($cancamount);
				$Ob_cancellationPolicy.=$currency.' '.$cancamount.' Amount that will be charged from '. date('d M Y',strtotime($v['from'])).'.';  
				}

				$data['result'][] =array('total'=>$totalcount,'Name'=>$Objs->Name,'TransferType'=>$Objs->TransferType,'Category'=>$Objs->Category,'Direction'=>$Objs->Direction,'isReturn'=>$Objs->isReturn,'mustCheckPickupTime'=>$Objs->mustCheckPickupTime,'minPaxCapacity'=>$Objs->minPaxCapacity,'maxPaxCapacity'=>$Objs->maxPaxCapacity,'rateKey'=>$Objs->rateKey,'LowRate'=>$Objs->lowRate,'NetAmount'=>$Objs->NetAmount,'TransferDetailInfo'=>$TransferDetailInfoArr,'thumbnail'=>$Objs->ImageUrl,'CustomerTransferTimeInfo'=>json_decode($Objs->CustomerTransferTimeInfo),'SupplierTransferTimeInfo'=>$SupplierTransferArr,'PickupInformation'=>json_decode($Objs->PickupInformation),'CancellationPolicies'=>$Ob_cancellationPolicy,'departure_date'=>$Objs->departure_date,'return_date'=>$Objs->return_date,'id'=>$Objs->id,'search_session'=>$Objs->search_session);
			}
			$datastr = json_encode($data);
			return $datastr;
			die;
	} 
	
		public function GetControls(Request $request){

			$moreCod =' AND lowRate >0';
			$search_Session_Id=$request['search_id'];
			/*=== Transfer list Name ===*/
			$carLists =array();
			$carResults= DB::select("select distinct Name,count(Name) as carCount from search_results_hbd_transfer where search_session='".$search_Session_Id."' group by Name");
			foreach($carResults as $carResult){
			$carLists[]=array('name'=>$carResult->Name,'count'=>$carResult->carCount); 
			}
			asort($carLists);
			
			
			/*=== Category list Name ===*/
			$categoryLists =array();
			$categoryResults= DB::select("select distinct Category,count(Category) as sCount from search_results_hbd_transfer where search_session='".$search_Session_Id."' group by Category");
			foreach($categoryResults as $categoryResult){
			$categoryLists[]=array('name'=>$categoryResult->Category,'count'=>$categoryResult->sCount); 
			}
			asort($categoryLists);
			
			/*=== TransferType type list ===*/
			$groupLists =array();
			$transferResults= DB::select("select distinct TransferType,count(TransferType) as sCount from search_results_hbd_transfer where search_session='".$search_Session_Id."' group by TransferType");
			foreach($transferResults as $transferResult){
			$groupLists[]=array('name'=>$transferResult->TransferType,'count'=>$transferResult->sCount); 
			}
			asort($groupLists);
			
			$sql ="SELECT count(Name) as totalrecords, 
			(select min(lowRate) from search_results_hbd_transfer where search_session='".$search_Session_Id."' $moreCod)  as minrate , 
			(select max(lowRate) as maxrate from search_results_hbd_transfer where search_session='".$search_Session_Id."' $moreCod)  as maxrate
			
			FROM search_results_hbd_transfer where search_session='".$search_Session_Id."' $moreCod";
			
			
			$resutls = DB::select($sql); 
			$obj = $resutls[0];
			
			$data =array('totalrecords'=>$obj->totalrecords,'minrate'=>floor($obj->minrate),'maxrate'=>ceil($obj->maxrate),'tagLists'=>$carLists,'categoryLists'=>$categoryLists,'groupLists'=>$groupLists);
			
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
	
	
	public function TransfersFinalCheckout(Request $request)  
    {
		$request_data=array();
		$request_data=$request->input();
		$transferSearchData=crud_model::readOne('search_results_hbd_transfer',array('id'=>$request->input('ref_id'))); 

		$total_amount=$request_data['apiPrice'];
		$total_currency=$request_data['currency'];
	 	$paxes =array();	
		
		$order_id=uniqid();
	 	$adults =$transferSearchData->adults;
	 	$childs =$transferSearchData->childs;
		$Outbound_rateKey=$transferSearchData->rateKey;
		
		$rateKeyArray=explode("|",$Outbound_rateKey);
		$Outbound_direction=$rateKeyArray[0];
		
			$transferTyepArr =array('STATION'=>'TRAIN','IATA'=>'FLIGHT','PORT'=>'CRUISE');
			$pickupType=$transferSearchData->FromType;
			$dropoffType=$transferSearchData->ToType;
		
			if( ($pickupType=='STATION') || ($pickupType=='IATA')||($pickupType=='PORT') ){
			$rideType=$transferTyepArr[$pickupType];
			}
		
			if($pickupType=='ATLAS' ){
			$rideType=$transferTyepArr[$dropoffType];
			}
		
		$s_from_travelnumber=$request_data['ride_identification_number'];
		
		
		
		$paxes =array();
		for($a=0;$a<$adults;$a++){ 
		  $fname =$request_data['passenger']['adult']['first_name'][$a];	
		  $lname =$request_data['passenger']['adult']['last_name'][$a];	  
		  $paxes[] =array('age'=>(30+$a),'type'=>'ADULT','name'=>$fname,'surname'=>$lname);
		 }
		 
		 for($c=0;$c<$childs;$c++){
		  $fname =$request_data['passenger']['child']['first_name'][$c];	
		  $lname =$request_data['passenger']['child']['last_name'][$c];	 
		  $paxes[] =array('type'=>'CHILD','name'=>$fname,'surname'=>$lname);
		 }
		 
	/*=== Create Booking ===*/ 
	$clientReference =$order_id;
	
	$Transfers =array();
	$OnewayTransfersDetails =array();
	$RoundtripTransfersDetails =array();
	
	$OnewayTransfersDetails[]=array('type'=>$rideType,'direction'=>$Outbound_direction,'code'=>$s_from_travelnumber,'companyName'=>null);
	
	
	$isoneway='Yes';
	    if($isoneway=='Yes'){
            $Transfers =array(array('rateKey'=>$Outbound_rateKey,
					                'transferDetails'=>$OnewayTransfersDetails
					               )		
					         );
	        }
	        else{	
			$RoundtripTransfersDetails[]=array('type'=>$rideType,'direction'=>$Inbound_direction,'code'=>$s_to_travelnumber,'companyName'=>null);		
			$Transfers =array(array('rateKey'=>$Outbound_rateKey,
					                'transferDetails'=>$OnewayTransfersDetails
					               ),
                              array('rateKey'=>$Inbound_rateKey,
					                'transferDetails'=>$RoundtripTransfersDetails
					               ),							   
					   );
            }		
					   $firstName=$request_data['passenger']['adult']['first_name'][0];
					   $lastName=$request_data['passenger']['adult']['last_name'][0]; 
					   $email_id=$request_data['passenger']['email']; 
					   $homePhone=$request_data['passenger']['phone'];
	$postArr =array('clientReference'=>$clientReference,
	                'holder'=>array('name'=>$firstName,'surname'=>$lastName,'email'=>$email_id,'phone'=>$homePhone),
					'language'=>"en",
					'welcomeMessage'=>"Welcome".$firstName,
					'remark'=>"Booking remarks go here",
					'transfers'=>$Transfers		
					);
					
					///////////////////////////////////
    $request_xml = json_encode($postArr);
	
	$user_id=$request_data['user_id'];
	
	if($user_id==''){
			$user_id=$this->createUser($firstName,$lastName,$request_data['passenger']['email'],$request_data['passenger']['phone'],$request_data['passenger']['address'],$request_data['passenger']['country'],$request_data['passenger']['country']);
		}
		

$booking_mode='Test';

		$data=array(
		'order_id'=>$order_id,
		'booking_status'=>'Pending',
		'hotel_img'=>$transferSearchData->ImageUrl,
		'hotel_id'=>$transferSearchData->rateKey,
		'hotelName'=>$transferSearchData->TransferType." ".$transferSearchData->Category." ".$transferSearchData->Name,
		'hotelAddress'=>$transferSearchData->origin_name,
		'hotelCity'=>$transferSearchData->destination_name,
		'user_name'=>$firstName." ".$lastName,
		'login_id'=>$user_id,
		'user_id'=>$user_id,
		'user_email'=>$email_id,
		'user_contactno'=>$homePhone,
		'request_xml'=>$request_xml,
		'check_in'=>$transferSearchData->departure_date,
		'check_out'=>$transferSearchData->return_date,
		'chargable_rate'=>$transferSearchData->lowRate,
		'adh_chargable'=>$transferSearchData->lowRate,
		'currency_code'=>$transferSearchData->currency,
		'api_currency'=>$transferSearchData->api_currency,
		'api_price'=>$transferSearchData->actual_price,
		'language'=>'en',
		'adults'=>$transferSearchData->adults,
		'children'=>$transferSearchData->childs,
		'booking_mode'=>$booking_mode,
		'payment_status'=>'Pendind',
		'product'=>'transfer',
		'supplier'=>'Hotelbeds',
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
		'date_time'=>date('Y-m-d H:i:s'),
		'ip_address'=>$_SERVER['REMOTE_ADDR']
		);
		$value = Crud_Model::insertData('twc_booking',$data);
		
		$redirect_page=url('/')."/travel/payment/".$request_data['payment_type']."/?order_id=".$order_id."&module=transfers";
		if($request_data['payment_type']=='wallet'){
			$return=$this->WalletDeduct($request_data['chargeableRate'],$request_data['api_currency'],$user_id,$order_id);
			$redirect_page=url('/')."/book-hotel?order_id=".$order_id;
		}
		//return redirect($redirect_page);
		
		Crud_Model::updateData('twc_booking',array('payment_status'=>'Confirmed'),array('order_id'=>$order_id));
		$redirect_page=url('/')."/book-transfers?order_id=".$order_id;
		
		
		return redirect($redirect_page);
	}
		
		
		//  Book Flight Start 
	public function BookTransfers(Request $request){
	   $order_id=$request->input('order_id');
	   $hotel_book_req=crud_model::readOne('twc_booking',array('order_id'=>$request['order_id']));
	   $request_xml=$hotel_book_req->request_xml;
	   $payment_status=$hotel_book_req->payment_status;
	   
	   if($payment_status=='Confirmed'){
			$actionUrl=$this->endpoint.'/bookings';
			$data= crud_model::readOne('twc_booking',array('order_id'=>$order_id)); 
		    $requestBody=$data->request_xml;
		    $hotelbeds_key='526a0b6f4d07cf75e5ed2c272babd21a';
		    $hotelbeds_secret='4d796cc468'; 
		    $signature = hash("sha256", $this->hotelbeds_key.$this->hotelbeds_secret.time());
		
			$actionUrl=$this->endpoint.'/bookings';
	
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $actionUrl);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerData);
				$contents = curl_exec($ch);
				curl_close($ch);
				//echo "response==".$contents; 
			  $ResonseArr = json_decode($contents, true);
			  //echo "<pre>ResonseArr==";  print_r($ResonseArr);
			  if (isset($ResonseArr['errors'])) {
				$booking_status = 'Failed';
				$itineraryId = '-1';
				$confirmationNumbers = '-1';
			  } else {
			  	$status = $ResonseArr['bookings'][0]['status'];
			  	$reference = $ResonseArr['bookings'][0]['reference'];
				$booking_status = 'Confirmed';
				$itineraryId = $ResonseArr['bookings'][0]['reference'];
				$confirmationNumbers = $ResonseArr['bookings'][0]['clientReference'];
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
		return redirect('/transfers-confirmation/'.base64_encode($order_id));	
 }	
 
 
	public function BookingCancellation(Request $request){
		
		$signature = hash("sha256", $this->hotelbeds_key.$this->hotelbeds_secret.time());
	
		$actionUrl=$this->endpoint.'/bookings/es/'.$request['itineraryId'].'?cancellationFlag=CANCELLATION';
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $actionUrl);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept:application/json','Api-key:'.$this->hotelbeds_key, 'X-Signature:'.$signature));
		echo $contents = curl_exec($ch);
		curl_close($ch);
		$this->createLogFile('Cancellation',$actionUrl,$contents);
			$Response_Arr = json_decode($contents, true);
		
		 if(isset($Response_Arr['errors'])) {
				$ResponseStatus = 'Failed';
				$itineraryId = '-1';
				$confirmationNumbers = '-1';
				$text=str_replace('\'','',$Response_Arr['errors'][0]['text']);
				$booking_status='Confirmed';
				
		} else {
			  	$responseData = $Response_Arr['booking'];
				$ResponseStatus = $responseData['status'];
				$booking_status='Cancelled';
				$text='Cancelled Success';
		}
		
		//$SQL = "update twc_booking SET booking_status='Cancelled',cancelled_by='" . $user_current . "', cancellationNumber='" . $cancellationNumber . "',cancellation_date='" . date('Y-m-d H:i:s') . "' WHERE order_id='" . $order_id . "'";
		
		$data=array(
				'booking_status'=>$booking_status,
				'cancelled_by'=>session()->get('user_id'),
				'cancellationNumber'=>rand(),
				'cancellation_date'=>date('Y-m-d H:i:s'),
				'cancellation_request'=>$actionUrl,	
				'cancellation_response'=>$contents,
			 );
			  
			 $value = Crud_Model::updateData('twc_booking',$data,array('itineraryId'=>$request['itineraryId']));	
		//$this->createLogFile($itineraryId.'-BookingCancellation','EndPoint:'.$actionUrl,$content);
		return redirect('/tours-confirmation/'.base64_encode($request['order_id']).'/?msg='.base64_encode($text)); die;
 
	
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
				  'txn_detail' => 'Wallet Deduct for Transfer Booking Regarding order id '.$order_id,
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
	
	public function createLogFile($action,$request,$response){  
		$credentials="hotelbeds_key=".$this->hotelbeds_key."\r\n hotelbeds_secret=".$this->hotelbeds_secret."\r\n endpoint=".$this->endpoint; 
		$file_name =$action.'-'.date('dmy his');	
		$log_filename = "travel/LogFileTransfer"; 
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
		mail($to,$subject,$content,$headers);
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
			if (strpos($query, 'NoSuchKey')== true){ $thumbnail='https://travelsdevlaravel.plistbooking.com/images/nohotel.jpg';  } else{   }
			
			return $thumbnail; }
		
		
}


