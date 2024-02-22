<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud_Model;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Markup;


class Flight extends Controller
{ 	
		public $currency='';  public $currency_symbol='';
		public $ACCESS_TOKEN='';
		
		public function __construct(){
			$this->emailObj= new EmailController();
			$this->markupObj= new Markup(); 
		    $data= crud_model::readOne('user',array('website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),'user_type'=>'admin')); 
			//$this->crud_model->readOne('website_setting',1);
		   	$common_data= $data->common_data;
			$common_dataArr= json_decode($common_data,true);
			
			$this->ACCESS_TOKEN=$common_dataArr['flight_duffel_token'];
			$this->flight_markup=$common_dataArr['flight_markup'];
			$this->flight_markup_type=$common_dataArr['flight_markup_type'];
			$this->flight_markup_agent=$common_dataArr['flight_markup_agent'];
			$this->flight_markup_agent_type=$common_dataArr['flight_markup_agent_type'];
			
			$this->currency=$data->currency;
			$this->currency_symbol=$data->currency_symbol;
		}
	
	public function GetLocations(Request $request) 
    {
	 $term=$request['term'];
$res =DB::select("select * from airports WHERE LCASE(city_name) LIKE '".strtolower($term)."%' OR LCASE(code) LIKE '".strtolower($term)."'  limit 5");
	    echo json_encode($res);
	}
	
	public function SearchRequestFirst(Request $request) 
    {
		$request= $request->input();
		$search_session=uniqid();
		$TokenId=uniqid();
		$OfferId=uniqid();
		if($request['flighttype']=='round'){ $isReturn='Yes'; }else{ $isReturn='No'; }
		$IATA_from=$request['IATA_from'];
		$IATA_to=$request['IATA_to'];
		$isDomestic='No';
		$adults=$request['adults'];
		$childs=$request['childs'];
		$infants=$request['infants'];
		$cabin_class=$request['cabin_class'];		
		$date = str_replace('/', '-', $request['departure_date']);
		$departure_date= date('Y-m-d', strtotime($date));
		$date = str_replace('/', '-', $request['return_date']);
		$return_date= date('Y-m-d', strtotime($date));
		
		  $slices[]=array("origin"=>$IATA_from,"destination"=> $IATA_to,"departure_date"=>$departure_date);
	  
		  if($isReturn=='Yes' && $isDomestic!='Yes'){
			  $slices[]=array("origin"=>$IATA_to,"destination"=>$IATA_from,"departure_date"=>$return_date);
		  }

   for($a=0;$a<$adults;$a++){ $passengers[]=array("type"=>"adult"); }
   for($c=0;$c<$childs;$c++){ $passengers[]=array("type"=>"child"); }
   for($in=0;$in<$infants;$in++){ $passengers[]=array("type"=>"infant"); }
	  
   $getFlightRequest = array('data'=>array('slices'=>$slices,'passengers'=>$passengers,'cabin_class'=>$cabin_class),'limit'=>200); 
   $actionUrl='https://api.duffel.com/air/offer_requests';	
   	
	json_encode($getFlightRequest);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $actionUrl);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($getFlightRequest));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json','Duffel-Version: beta','Authorization: Bearer '.$this->ACCESS_TOKEN));
      $contents = curl_exec($ch);
	
			$res=json_decode($contents,true);
	$this->createLogFile('search_'.rand(),json_encode($getFlightRequest),$contents);
	//echo "res========<pre>";   print_r($res);  
	if(isset($res['data'])){	
		$offers=$res['data']['offers'];
		//$data=$this->unique_key($offers,'marketing_carrier_flight_number');
		echo json_encode($offers);
	}{ echo 0; }
	
	 
	 }
	
	public function SearchRequest(Request $request) 
    {
		$request= $request->input();
		$search_session=uniqid();
		$TokenId=uniqid();
		$OfferId=uniqid();
		if($request['flighttype']=='round'){ $isReturn='Yes'; }else{ $isReturn='No'; }
		$IATA_from=$request['IATA_from'];
		$IATA_to=$request['IATA_to'];
		$isDomestic='No';
		$adults=$request['adults'];
		$childs=$request['childs'];
		$infants=$request['infants'];
		$cabin_class=$request['cabin_class'];		
		$date = str_replace('/', '-', $request['departure_date']);
		$departure_date= date('Y-m-d', strtotime($date));
		$date = str_replace('/', '-', $request['return_date']);
		$return_date= date('Y-m-d', strtotime($date));
		
		  $slices[]=array("origin"=>$IATA_from,"destination"=> $IATA_to,"departure_date"=>$departure_date);
	  
		  if($isReturn=='Yes' && $isDomestic!='Yes'){
			  $slices[]=array("origin"=>$IATA_to,"destination"=>$IATA_from,"departure_date"=>$return_date);
		  }

   for($a=0;$a<$adults;$a++){ $passengers[]=array("type"=>"adult"); }
   for($c=0;$c<$childs;$c++){ $passengers[]=array("type"=>"child"); }
   for($in=0;$in<$infants;$in++){ $passengers[]=array("type"=>"infant"); }
	  
   $getFlightRequest = array('data'=>array('slices'=>$slices,'passengers'=>$passengers,'cabin_class'=>$cabin_class)); 
   $actionUrl='https://api.duffel.com/air/offer_requests';	
   	
	json_encode($getFlightRequest);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $actionUrl);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($getFlightRequest));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json','Duffel-Version: beta','Authorization: Bearer '.$this->ACCESS_TOKEN));
     $contents = curl_exec($ch);
	curl_close($ch);
			$res=json_decode($contents,true);
	$this->createLogFile('search_'.rand(),json_encode($getFlightRequest),$contents);
	//echo "res========<pre>";   print_r($res);  
	if(isset($res['data'])){	
		$offers=$res['data']['offers'];
		
		if(count($offers)>0){ $count=20; }else { $count =0; }  $count=count($offers);
		for($i=0;$i<$count;$i++)
		{
			$api_currency=$offers[$i]['base_currency'];   
			//$base_amount= $this->convertCurrencyRateFlight($api_currency,$offers[$i]['base_amount']);
			//$tax_amount= $this->convertCurrencyRateFlight($api_currency,$offers[$i]['tax_amount']);
			//$total_amount= $this->convertCurrencyRateFlight($api_currency,$offers[$i]['total_amount']);
			$api_price=$offers[$i]['total_amount'];
			
			$base_price_in_live_currency =  $this->markupObj->convertCurrencyRate($api_currency,$offers[$i]['total_amount']);
			$adminPrice=$this->markupObj->calAdminPrice($base_price_in_live_currency,'flight');
			$TotalFare=$adminPrice;
			
			$agentPrice=0;
			if(session()->get('user_type')=='agent'){
				$agentPrice=$this->markupObj->calAgentPrice($adminPrice,'flight');
				$TotalFare=$agentPrice;
			}
			$tax_amount=$TotalFare-$base_price_in_live_currency;
			
			$OfferId=$offers[$i]['id'];
			
			$slices=$offers[$i]['slices'][0]; 
			$origin=$slices['origin'];
			$destination=$slices['destination'];
			$segments=$slices['segments'];
			$onewayFlights=array();
			$onewayStops=(count($segments)-1);
			$final_departure_datetime=strtotime($segments[0]['departing_at']);
			$final_arrival_datetime=strtotime($segments[$onewayStops]['arriving_at']);
			for($s=0;$s<count($segments);$s++)   
			{
				$departing_atArr=explode("T",$segments[$s]['departing_at']);
				$departDate=$departing_atArr[0];  $departTime=$departing_atArr[1];  
				$arriving_atArr=explode("T",$segments[$s]['arriving_at']); 
				$arrivelDate=$arriving_atArr[0];  $arrivelTime=$arriving_atArr[1];   
				
				$cityFrom=$segments[$s]['origin']['city_name'];
				$FromAirportName=$segments[$s]['origin']['name'];
				$cityTo=$segments[$s]['destination']['city_name'];
				$ToAirportName=$segments[$s]['destination']['name'];
				
				$OriginTerminal=$segments[$s]['origin_terminal'];
				$DestinationTerminal=$segments[$s]['destination_terminal'];
				
				//$baggage=$segments[$s]['passengers'][0]['baggages'][0]['quantity'].' '.$segments[$s]['passengers'][0]['baggages'][0]['type'];
				$baggage='';
				$CabinClass=$segments[$s]['passengers'][0]['cabin_class'];
				
				$duration=str_replace(array('PT','H','M'),array('',':',''),$segments[$s]['duration']);
				$fare_brand_name='';//$segments[$s]['fare_brand_name']; 
				 $IsRefundable=0;
				$flight_no=$segments[$s]['marketing_carrier_flight_number'];
				$flyFrom=$segments[$s]['origin']['iata_code'];
				$flyTo=$segments[$s]['destination']['iata_code'];
				
				$operating_carrier=$segments[$s]['operating_carrier']['iata_code'];
				$NoOfSeatAvailable=0;
				$id=$segments[$s]['id'];
				
				$onewayFlights[]=array('operating_carrier'=>$operating_carrier,'airline_code'=>$operating_carrier,'airline_name'=>$segments[$s]['operating_carrier']['name'],'arrivelDate'=>$arrivelDate,'arrivelTime'=>$arrivelTime,'departDate'=>$departDate,'departTime'=>$departTime,'cityFrom'=>$cityFrom,'cityTo'=>$cityTo,'FromAirportName'=>$FromAirportName,'ToAirportName'=>$ToAirportName,'OriginTerminal'=>$OriginTerminal,'DestinationTerminal'=>$DestinationTerminal,'baggage'=>$baggage,'CabinClass'=>$CabinClass,'duration'=>$duration,'flight_no'=>$flight_no,'flyFrom'=>$flyFrom,'flyTo'=>$flyTo,'NoOfSeatAvailable'=>$NoOfSeatAvailable,'id'=>$id);
				
			$final_duration=($final_arrival_datetime-$final_departure_datetime);
			$IsLCC=0; $is_return=0; $FareBreakdown=array();			
			}
			
			if(isset($offers[$i]['slices'][1])){
				$return_slices=$offers[$i]['slices'][1]; 
				$return_origin=$return_slices['origin'];
				$return_destination=$return_slices['destination'];
				$segments=$return_slices['segments'];
				
				$return_Flights=array();
				$returnStops=(count($segments)-1);
				$final_return_departure_datetime=strtotime($segments[0]['departing_at']);
				$final_return_arrival_datetime=strtotime($segments[$returnStops]['arriving_at']);
				for($s=0;$s<count($segments);$s++)   
				{
					$departing_atArr=explode("T",$segments[$s]['departing_at']);
					$departDate=$departing_atArr[0];  $departTime=$departing_atArr[1];  
					$arriving_atArr=explode("T",$segments[$s]['arriving_at']); 
					$arrivelDate=$arriving_atArr[0];  $arrivelTime=$arriving_atArr[1];   
					
					$cityFrom=$segments[$s]['origin']['city_name'];
					$FromAirportName=$segments[$s]['origin']['name'];
					$cityTo=$segments[$s]['destination']['city_name'];
					$ToAirportName=$segments[$s]['destination']['name'];
					
					$OriginTerminal=$segments[$s]['origin_terminal'];
					$DestinationTerminal=$segments[$s]['destination_terminal'];
					
					//$baggage=$segments[$s]['passengers'][0]['baggages'][0]['quantity'].' '.$segments[$s]['passengers'][0]['baggages'][0]['type'];
					$baggage='';
					$CabinClass=$segments[$s]['passengers'][0]['cabin_class'];
					
					$duration=str_replace(array('PT','H','M'),array('',':',''),$segments[$s]['duration']);
					$fare_brand_name='';//$segments[$s]['fare_brand_name']; 
					 $IsRefundable=0;
					$flight_no=$segments[$s]['marketing_carrier_flight_number'];
					$flyFrom=$segments[$s]['origin']['iata_code'];
					$flyTo=$segments[$s]['destination']['iata_code'];
					
					$operating_carrier=$segments[$s]['operating_carrier']['iata_code'];
					$return_validating_carrier=$operating_carrier;
					$NoOfSeatAvailable=0;
					$id=$segments[$s]['id'];
					
					$return_Flights[]=array('operating_carrier'=>$operating_carrier,'airline_code'=>$operating_carrier,'airline_name'=>$segments[$s]['operating_carrier']['name'],'arrivelDate'=>$arrivelDate,'arrivelTime'=>$arrivelTime,'departDate'=>$departDate,'departTime'=>$departTime,'cityFrom'=>$cityFrom,'cityTo'=>$cityTo,'FromAirportName'=>$FromAirportName,'ToAirportName'=>$ToAirportName,'OriginTerminal'=>$OriginTerminal,'DestinationTerminal'=>$DestinationTerminal,'baggage'=>$baggage,'CabinClass'=>$CabinClass,'duration'=>$duration,'flight_no'=>$flight_no,'flyFrom'=>$flyFrom,'flyTo'=>$flyTo,'NoOfSeatAvailable'=>$NoOfSeatAvailable,'id'=>$id);
					
				}
				$return_duration=($final_return_arrival_datetime-$final_return_departure_datetime);			
			}else{
				$return_Flights='';
				$return_validating_carrier='';
				$returnStops=0;
				$final_return_departure_datetime=0;
				$final_return_arrival_datetime=0;
				$return_duration=0;
			}
			
			$data[]=array(
					'TokenId'=>$TokenId,
					'OfferId'=>$OfferId,
					'IsLCC'=>$IsLCC,
					'IsRefundable'=>$IsRefundable,
					'onewayFlights'=>json_encode($onewayFlights),
					'api_currency'=>$api_currency,
					'api_price'=>$api_price,
					'currency'=>$this->currency,
					'price'=>$TotalFare,
					'base_fare'=>$base_price_in_live_currency,
					'tax'=>$tax_amount,
					'adminPrice'=>$adminPrice,
					'validating_carrier'=>$operating_carrier,
					'max_stops'=>$onewayStops,
					'origon_airport'=>$origin['iata_code'],
					'destination_airport'=>$destination['iata_code'],
					'cityFrom'=>$origin['city_name'],
					'cityTo'=>$destination['city_name'],
					'countryFrom'=>$origin['iata_country_code'],
					'countryTo'=>$destination['iata_country_code'],
					'departure_datetime'=>$final_departure_datetime,
					'arrival_datetime'=>$final_arrival_datetime,
					'duration'=>$final_duration,
					'flight_no'=>$onewayFlights[0]['flight_no'],
					'airlines'=>$operating_carrier,
					'baglimit'=>'',
					'search_id'=>$search_session,
					'datetime'=>date('Y-m-d H:i:s'),
					'is_return'=>$is_return,
					'FareBreakdown'=>json_encode($FareBreakdown),
					'isDomestic'=>$isDomestic,
					'adults'=>$adults,
					'children'=>$childs,
					'infants'=>$infants,
					'CabinClass'=>$cabin_class,
					'returnFlights'=>json_encode($return_Flights),
					'return_validating_carrier'=>$return_validating_carrier,
					'return_max_stops'=>$returnStops,
					'return_departure_datetime'=>$final_return_departure_datetime,
					'return_arrival_datetime'=>$final_return_arrival_datetime,
					'return_duration'=>$return_duration,
				);
		}
		//echo "<pre>"; print_r($data);
		
			//$data=$this->unique_key($offers,'flight_number');
			$status = Crud_Model::insertBulkData('flight_results',$data);		
		$isFind='Yes'; $contents='';
		
		 $columns = array_column($data, "price");
		 array_multisort($columns, SORT_ASC, $data);
		 $this->createLanding($origin['iata_code'],$destination['iata_code'],$data[0]['currency'],$data[0]['price'],$search_session);
		
	}else{ $isFind='No'; }
	
	 $data=array('isFind'=>$isFind,'search_id'=>$search_session); 
	 echo json_encode($data);		
		
	}// Flight SearchRequest end
	
	
	
	public function Show_Flights(Request $request) 
    {
	$search_id =trim($request['search_id']); 
	
	$limit =20;
	if(($request["page"]<=1) || ($request["page"]=='')){
		$page = 0;
	}else{
		$page = ( ($request["page"]-1) * $limit);
	}
	$sortValArr=explode('_',$request["sortVal"]);
	
	$orderBy=' order by '.$sortValArr[0].' '.$sortValArr[1];
	$moreQuery=" where search_id='".$search_id."' ";
	
	if($request['price']!=''){
		$price =str_replace(' ','',$request['price']);
		$priceArr =explode('-',$price);
		$minPrice =$priceArr[0];
		$maxPrice =$priceArr[1];
		$moreQuery.= " AND (price >= ".$minPrice." AND price<=".$maxPrice.")";
	} 
	//echo "_REQUEST['duration']==".$_REQUEST['duration'];
	if($request['duration']!=''){
		$duration =str_replace(array(':00',' '),array('',''),$request['duration']);
		$dExp =explode('-',$duration);
		$moreQuery.= " AND ( duration >= '".($dExp[0]*3600)."' AND duration <='".($dExp[1]*3600)."') ";  
	}
	
    if($request['Stops']!=''){
	$Stops=substr($request['Stops'],0,-1);
	  $moreQuery.= ' and max_stops IN('.$Stops.')'; 
	}
	
	
	$airlines=substr($request['airlines'],0,-1);
	$Cri_airlines =explode(",",$request['airlines']); 
	$Cri_airlines =array_filter($Cri_airlines);
	if(count($Cri_airlines)>0) {
	 $moreQuery.= " AND validating_carrier IN (";	
	 $airLineStr ='';
	foreach($Cri_airlines as $v){   
	  $airLineStr.= " '".$v."',"; 	 
	 }
	 $airLine =substr($airLineStr,0,-1);
	 
	 $moreQuery.=$airLine;
	 $moreQuery.= " )";   
	}
	
	$res =DB::select("select count(*) as totalcount from flight_results ".$moreQuery." ");
	$totalcount = $res[0]->totalcount;
		
	$Sqls = "select * from flight_results ".$moreQuery."  ".$orderBy." LIMIT ".$page.", $limit";
	//echo $Sqls;
	$results=DB::select($Sqls);
	$flightData=array();
    foreach($results as $Objs){ 	 
        $onewayFlights =json_decode($Objs->onewayFlights);	
        $returnFlights =json_decode($Objs->returnFlights);	
		if($returnFlights!=''){ $isReturn='Yes'; } else { $isReturn='No';}
		
	    $fly_duration_1 = floor($Objs->duration/3600).': '.floor(($Objs->duration/60)%60);
	    //$return_duration =floor($Objs->return_duration/3600).': '.floor(($Objs->return_duration/60)%60);
		$fly_duration=date('H:i',$Objs->arrival_datetime-$Objs->departure_datetime);
		$return_duration=date('H:i',$Objs->return_arrival_datetime-$Objs->return_departure_datetime);
		
		$bagData =json_decode($Objs->baglimit);	
		$FareBreakdown =json_decode($Objs->FareBreakdown,true);
		
		$airlines =json_decode($Objs->airlines);
		$airLineData =array();
/*		foreach($airlines as $airlinecode){
		  $airResults =$wpdb->get_results("select * from kw_airlines WHERE airline_code='".$airlinecode."'");	
		  $airObj =$airResults[0];
		  $airLineData[]=array('airline_name'=>$airObj->name,'airline_code'=>$airlinecode);
		}*/
        
		$flightData['result'][] =array('totalcountfilter'=>$totalcount,'onewayFlights'=>$onewayFlights,'returnFlights'=>$returnFlights,'actual_price'=>$Objs->api_price,'price'=>$Objs->price,'Tax'=>$Objs->tax,'currency'=>$Objs->currency,'IsLCC'=>$Objs->IsLCC,'is_direct'=>$Objs->is_direct,'IsRefundable'=>$Objs->IsRefundable,'validating_carrier'=>$Objs->validating_carrier,
		'return_validating_carrier'=>$Objs->return_validating_carrier,
		'departure_date'=>date('d M Y',$Objs->departure_datetime),
		'departure_time'=>date('H:i',$Objs->departure_datetime),
		'arrival_date'=>date('d M Y',$Objs->arrival_datetime),
		'arrival_time'=>date('H:i',$Objs->arrival_datetime),
		
		'return_departure_date'=>date('d M Y',$Objs->return_departure_datetime),
		'return_departure_time'=>date('H:i',$Objs->return_departure_datetime),
		'return_arrival_date'=>date('d M Y',$Objs->return_arrival_datetime),
		'return_arrival_time'=>date('H:i',$Objs->return_arrival_datetime),
		
		'total_duration'=>$Objs->duration,
		'fly_duration'=>$fly_duration,
		
		'return_total_duration'=>$return_duration,
		'origon_airport'=>$Objs->origon_airport,
		'destination_airport'=>$Objs->destination_airport,
		'max_stops'=>$Objs->max_stops,
		'return_max_stops'=>$Objs->return_max_stops,
		'booking_token'=>$Objs->OfferId,
		'airLineData'=>$airLineData,
		'search_id'=>$Objs->search_id,
		'id'=>$Objs->id,
		'FareBreakup'=>json_decode($Objs->FareBreakdown,true),
		'bagData'=>json_decode($Objs->baglimit),
		'conversion_rate'=>1,//$Objs->conversion_rate,
		'product'=>$Objs->product,
		'isLCC'=>$Objs->IsLCC,
		'currency_symbol'=>$this->currency_symbol,
		'isReturn'=>$isReturn,
		);		  
	  }
	echo json_encode($flightData); 
	}// Show_flight end
	
	
	public function FlightController(Request $request) 
    {
	$search_id =trim($request['search_id']); 
	
	$modeQuery ='';
	/*=== Stopage ===*/	
	$stopesSql =DB::select("select distinct max_stops from flight_results  where search_id='".$search_id."' $modeQuery ORDER BY max_stops ASC");
	$stopages=array();
	foreach($stopesSql as $stopesObj){
	 $max_stops=$stopesObj->max_stops;
	 $resultsstop=DB::select("select  count(max_stops) as maxstopcount from flight_results where max_stops='".$max_stops."' and search_id='".$search_id."' $modeQuery "); 
	 $maxstopcount=$resultsstop[0]->maxstopcount;
	 $stopages[] =array('max_stops'=>$max_stops,'maxstopcount'=>$maxstopcount);   
	}
	
	/*=== Airline ===*/
	 $airlines =array();
     $airlineSql=DB::select("select distinct validating_carrier from flight_results where search_id='".$search_id."' $modeQuery");
	 foreach($airlineSql as $airline ){
		$results=DB::select("select airline_code,name from kw_airlines where airline_code='".$airline->validating_carrier."'");		    
		$conResults = DB::select("select count(*) as carriercount  from flight_results WHERE validating_carrier='".$airline->validating_carrier."' and search_id='".$search_id."' $modeQuery");
		$airlines[]=array('airline_code'=>$results[0]->airline_code,'name'=>$results[0]->name,'carriercount'=>$conResults[0]->carriercount); 
	  }
            	
	$results =DB::select("select count(*) as total,origon_airport,destination_airport,airlines,MIN(price) as minprice, MAX(price) as maxprice,MIN(departure_datetime) as departure_mintime,MAX(departure_datetime) as departure_maxtime,MIN(arrival_datetime) as arrival_mintime,MAX(arrival_datetime) as arrival_maxtime,MIN(return_departure_datetime) as return_departure_mintime,MAX(return_departure_datetime) as return_departure_maxtime,MIN(return_arrival_datetime) as return_arrival_mintime,MAX(return_arrival_datetime) as return_arrival_maxtime,MIN(duration) as fly_duration_mintime,MAX(duration) as fly_duration_maxtime,MIN(return_duration) as returnfly_duration_mintime, MAX(return_duration) as returnfly_duration_maxtime,(select count(*) from flight_results where search_id='".$search_id."' and IsRefundable=1 $modeQuery) as refundableCount,(select count(*) from flight_results where search_id='".$search_id."' and IsRefundable=0 $modeQuery) as non_refundableCount,(select count(*) from flight_results where search_id='".$search_id."' and IsLCC=1) as LccCount,(select count(*) from flight_results where search_id='".$search_id."' and IsLCC=0) as non_LccCount from flight_results where search_id='".$search_id."' $modeQuery");
		 
	$obj =$results[0];   
	
    $data =array('total'=>$obj->total,'minprice'=>floor($obj->minprice),'maxprice'=>ceil($obj->maxprice),'departure_mintime'=>floor(date('H',$obj->departure_mintime)),'departure_maxtime'=>ceil(date('H',$obj->departure_maxtime)),'arrival_mintime'=>floor(date('H',$obj->arrival_mintime)),'arrival_maxtime'=>floor(date('H',$obj->arrival_maxtime)),'return_departure_mintime'=>floor($obj->return_departure_mintime/3600),'return_departure_maxtime'=>ceil($obj->return_departure_maxtime/3600),'return_arrival_mintime'=>floor($obj->return_arrival_mintime/3600),'return_arrival_maxtime'=>floor($obj->return_arrival_maxtime/3600),'origon_airports'=>$obj->origon_airport,'destination_airports'=>$obj->destination_airport,'min_stop_duration'=>$obj->fly_duration_mintime,'max_stop_duration'=>$obj->fly_duration_maxtime,'fly_duration_mintime'=>floor($obj->fly_duration_mintime/3600),'fly_duration_maxtime'=>ceil($obj->fly_duration_maxtime/3600),'returnfly_duration_mintime'=>floor($obj->returnfly_duration_mintime/3600),'returnfly_duration_maxtime'=>floor($obj->returnfly_duration_maxtime/3600),'stopages'=>$stopages,'products'=>'Flight','refundableCount'=>$obj->refundableCount,'non_refundableCount'=>$obj->non_refundableCount,'LccCount'=>$obj->LccCount,'non_LccCount'=>$obj->non_LccCount,'airlines'=>$airlines,'airbaggages'=>'','currency_symbol'=>$this->currency_symbol);
   echo json_encode($data);
   
   }// FlightController end
	
	
	
	public function SelectFlight(Request $request) {
		$flightData= crud_model::readOne('flight_results',array('id'=>$request->input('id'))); 
		$OfferId=$flightData->OfferId;
		$actionUrl='https://api.duffel.com/air/offers/'.$OfferId;
			
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $actionUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json','Duffel-Version: beta','Authorization: Bearer '.$this->ACCESS_TOKEN));
		$contents = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
	
		$this->createLogFile('select_'.rand(),$actionUrl,$contents);
	
		$response=json_decode($contents,true);
		
		$data=array(
		'search_id'=>$flightData->search_id,
		'ref_id'=>$flightData->id,
		'request'=>$actionUrl,
		'response'=>$contents,
		'response_xml'=>$contents,
		'TravelerKey'=>'',
		'date_time'=>date('Y-m-d H:i:s')
		);
						
		$value = Crud_Model::insertData('flight_check',$data);
		$contentsArr=json_decode($contents,true); 
		if(isset($contentsArr['data'])){
			 $api_currency=$contentsArr['data']['total_currency'];
			 $contentsArr['data']['apiPrice']=$contentsArr['data']['total_amount'];
			 $contentsArr['data']['base_amount']=number_format($this->convertCurrencyRateFlight($api_currency,$contentsArr['data']['base_amount']),2, '.', '');
			 $contentsArr['data']['total_amount']=number_format($this->convertCurrencyRateFlight($api_currency,$contentsArr['data']['total_amount']),2, '.', '');;
			 $contentsArr['data']['tax_amount']=number_format($this->convertCurrencyRateFlight($api_currency,$contentsArr['data']['tax_amount']),2, '.', '');;
			 $contentsArr['data']['currency_symbol']=$this->currency_symbol; 
			 $contentsArr['data']['currency']=$this->currency;
		}
		echo json_encode($contentsArr);
	}


	public function FlightFinalCheckout(Request $request) 
    {
	
		$this->createLogFile('form_submit_data'.rand(),json_encode($_REQUEST),'');
		
		$request_data=array();
		$request_data=$request->input();
		$flightData= crud_model::readOne('flight_results',array('id'=>$request->input('id'))); 
		$adults=$flightData->adults;
		$children=$flightData->children;
		$infants=$flightData->infants;
		
		if($flightData->is_return==0){ $isoneway='Yes'; } else{ $isoneway='No';  }
		
		$flight_check=crud_model::readOne('flight_check',array('ref_id'=>$request->input('id'))); 
		$flight_check_response=$flight_check->response;
		
		$flight_check_responseArr=json_decode($flight_check->response,true);
				
		$passengers_id=$flight_check_responseArr['data']['passengers'];
				for($p=0;$p<count($passengers_id);$p++){
						if($passengers_id[$p]['type']=='adult'){ $adult_id[]=$passengers_id[$p]['id']; }
						if($passengers_id[$p]['type']=='child'){ $child_id[]=$passengers_id[$p]['id']; }
						if($passengers_id[$p]['type']=='infant'){ $infant_id[]=$passengers_id[$p]['id']; }
				 }
		$OfferId[]=$request->input('OfferId');
		
		$adultArr=$request_data['passenger']['adult'];  
		if(isset($request_data['passenger']['child'])){ $childArr=$request_data['passenger']['child']; } else{ $childArr=array(); }
		if(isset($request_data['passenger']['infant'])){ $infantArr=$request_data['passenger']['infant']; } else{ $infantArr=array(); }
		$total_amount=$flight_check_responseArr['data']['total_amount'];
		$total_currency=$flight_check_responseArr['data']['total_currency'];
		
		$payments[]=array(
				'type'=>'balance',
				'currency'=> $total_currency,
        		'amount'=> $total_amount
			);
		for($a=0;$a<$adults;$a++){
			 $passengers[]=array(
					'phone_number'=>'+91'.$request_data['passenger']['phone'],
					'email'=> $request_data['passenger']['email'],
					'born_on'=>$adultArr['dob'][$a],
					'title'=> $adultArr['title'][$a],
					'gender'=>$adultArr['gender'][$a],
					'family_name'=> $adultArr['first_name'][$a].' '.$adultArr['last_name'][$a],
					'given_name'=>  $adultArr['first_name'][$a].' '.$adultArr['last_name'][$a],
					'id'=> $adult_id[$a], //$adultArr['id'][$a],
			 );
		 }
		 
		for($c=0;$c<$children;$c++){
			 $passengers[]=array(
					'phone_number'=>'+91'.$request_data['passenger']['phone'],
					'email'=>$request_data['passenger']['email'],
					'born_on'=>$childArr['dob'][$c],
					'title'=> $childArr['title'][$c],
					'gender'=>$childArr['gender'][$c],
					'family_name'=> $childArr['first_name'][$c].' '.$childArr['last_name'][$c],
					'given_name'=>  $childArr['first_name'][$c].' '.$childArr['last_name'][$c],
					'id'=> $child_id[$c], //$childArr['id'][$c],
			 );
		 }
		 
	   for($i=0;$i<$infants;$i++){
			 $passengers[]=array(
					'phone_numbe'=>'+91'.$request_data['passenger']['phone'],
					'email'=> $request_data['passenger']['email'],
					'born_on'=>$infantArr['dob'][$i],
					'title'=> $infantArr['title'][$i],
					'gender'=>$infantArr['gender'][$i],
					'family_name'=> $infantArr['first_name'][$i].' '.$infantArr['last_name'][$i],
					'given_name'=>  $infantArr['first_name'][$i].' '.$infantArr['last_name'][$i],
					'infant_passenger_id'=> $infantArr['id'][$i],
					'id'=> $infant_id[$c], //$adultArr['id'][0],
			 );
		 }
		
		$data=array(
			'selected_offers'=>$OfferId,
			'payments'=>$payments,
			'passengers'=>$passengers,
		);
		
		$book_request=array('data'=>$data);
		$user_id=session()->get('user_id');
		
		if($user_id==''){
			$user_id=$this->createUser($adultArr['first_name'][0],$adultArr['last_name'][0],$request_data['passenger']['email'],$request_data['passenger']['phone'],$request_data['passenger']['address'],$request_data['passenger']['city'],$request_data['passenger']['country']);
		}

		$order_id=strtoupper(uniqid());
		
		$FlightsSegment['outbound']=json_decode($flightData->onewayFlights,true);
		if($flightData->is_return==1){ $FlightsSegment['inbound']=json_decode($flightData->returnFlights,true); }
		
		$data=array(
		'ResultID'=>$flightData->OfferId,
		'search_id'=>$flight_check->search_id,
		'ref_id'=>$flight_check->id,
		'order_id'=>$order_id, 
		'user_id'=>$user_id, 
		'ticket_status'=>'',   
		'request_data'=>json_encode($request_data),
		'FlightsSegment'=>json_encode($FlightsSegment), 
		'first_name'=>$adultArr['first_name'][0], 
		'last_name'=>$adultArr['last_name'][0],
		'email'=>$request_data['passenger']['email'],
		'phone'=>$request_data['passenger']['phone'],
		'address'=>$request_data['passenger']['address'],
		'travellers'=>json_encode($request_data['passenger']),
		'api_currency'=>$flightData->api_currency,
		'api_price'=>$flightData->api_price,
		'base_price'=>$flightData->base_fare,
		'adminPrice'=>$flightData->adminPrice,
		'currency'=>$flightData->currency,
		'prices'=>$flightData->price,
		'payment_status'=>'Pending',
		'booking_status'=>'Pending',
		'book_request'=>json_encode($book_request),
		'last_ticket_date'=>'',
		'adults'=>$flightData->adults,
		'children'=>$flightData->children,
		'infants'=>$flightData->infants,
		'created_at'=>date('Y-m-d H:i:s'),
		'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
		);
		$value = Crud_Model::insertData('bookings',$data);
		
		$redirect_page=url('/')."/travel/payment/".$request_data['payment_type']."/?order_id=".$order_id."&module=flight";
		if($request_data['payment_type']=='wallet'){
			$return=$this->WalletDeduct($flightData->adminPrice,$flightData->currency,$user_id,$order_id);
			$redirect_page=url('/')."/book-flight?order_id=".$order_id;
		}
		
		Crud_Model::updateData('bookings',array('payment_status'=>'Confirmed'),array('order_id'=>$order_id));
		$redirect_page=url('/')."/book-flight?order_id=".$order_id;
			
		//return redirect('/flight-payment/'.base64_encode($order_id)."/".base64_encode($request_data['chargeableRate']));	
		return redirect($redirect_page);		
	}
	
	//  Final Checkout end
	
	//  Book Flight Start 
	public function BookFlight(Request $request){	
	   $request_data=$request->input('');  
	   echo "order_id==".$order_id=$request->input('order_id');
	   
	   $flight_book_req=crud_model::readOne('bookings',array('order_id'=>$request->input('order_id')));
	   $book_request=$flight_book_req->book_request;
	   $payment_status=$flight_book_req->payment_status;
	   
	   if($payment_status=='Confirmed'){
			
			$actionUrl='https://api.duffel.com/air/orders';	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $actionUrl);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $book_request);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json','Duffel-Version: beta','Authorization: Bearer '.$this->ACCESS_TOKEN));
		   $contents = curl_exec($ch);
			curl_close($ch);
			
			$this->createLogFile('Book_'.rand(),$book_request,$contents);
			$book_response_Arr=json_decode($contents,true);
			
			if(isset($book_response_Arr['errors'])){ 
				$PNR=''; 
				$booking_status='Failed'; 
				$error=$book_response_Arr['errors'][0]['title'].', '.$book_response_Arr['errors'][0]['message']; 
			}else { 
				$PNR=$book_response_Arr['data']['booking_reference']; 
				$booking_status='Confirmed';  $error=''; 
			}
			$BookingId=strtoupper(uniqid());
			$data=array(
				'book_response'=>$contents,
				'pnr'=>$PNR,
				'booking_status'=>$booking_status,
				'error_msg'=>$error,
			);
			Crud_Model::updateData('bookings',$data,array('order_id'=>$order_id));
			
		}
		
		return redirect('/flight-confirmation/'.base64_encode($order_id));	
	}
	//  Book Flight end
	
	
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
				  'txn_detail' => 'Wallet Deduct for Flight Booking Regarding order id '.$order_id,
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
				  'payment_type' =>"wallet",
				  'error_msg' => $error_msg,
			  );
		 	  $status =Crud_Model::updateData('bookings',$data,array('order_id'=>$order_id));
			  
			return 1;
		  
	}
	
	public function getWalletBal($user_id){ 
		 $userData = crud_model::readOne('user',array('id'=>$user_id));
		 $walletAmt=$userData->wallet;
		 return $walletAmt;
	}
	
	
	
	public  function Check(Request $request){
			echo "price===".$this->convertCurrencyRateFlight('USD',100);
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
		return $price;
	}
	
    public function calAdminPrice($price){
			$user_type=session()->get('user_type');
			if($user_type=='agent'){ $markp= $this->flight_markup_agent; $type=$this->flight_markup_agent_type; }
			else{ $markp= $this->flight_markup; $type=$this->flight_markup_type;  }
			
			if($type=='flat'){ $price=floatval($price)+floatval($markp); }
			else{ $price=floatval($price)+(floatval($price)/100)*floatval($markp); }
			return $price;
	}
	
	public function calAgentPrice($price){
			$user_id=session()->get('user_id');
			$data= crud_model::readOne('user',array('id'=>$user_id)); //$this->crud_model->readOne('website_setting',1);
		   	$common_data= $data->common_data;
			$common_dataArr= json_decode($common_data,true);
			
			if(isset($common_dataArr['flight_markup'])){
				$markp=$this->flight_markup=$common_dataArr['flight_markup'];
				$type=$this->flight_markup_type=$common_dataArr['flight_markup_type'];
				if($type=='flat'){ $price=floatval($price)+floatval($markp); }
				else{ $price=floatval($price)+(floatval($price)/100)*floatval($markp); }
			}
			return $price;
	}
	
	
	public function createLogFile($action,$request,$response){  
		$credentials=$this->ACCESS_TOKEN; 
		$file_name =$action.'-'.date('dmy his');	
		$log_filename = "travel/LogFile"; 
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
	
	public function unique_key($array,$keyname){

	 $new_array = array();
	 foreach($array as $key=>$value){
	
	   if(!isset($new_array[$value[$keyname]])){
		 $new_array[$value[$keyname]] = $value;
	   }
	
	 }
	 $new_array = array_values($new_array);
	 return $new_array;
	}
	
	public function createLanding($fromIATA,$toIATA,$api_currency,$total_amount,$search_id){
			$citySingelFROM = crud_model::readOne('airports',array('code'=>$fromIATA));
			$citySingelTO = crud_model::readOne('airports',array('code'=>$toIATA));
				$other_content=array(
				   "outbound_days" => "1", 
				   "inbound_days" => "1", 
				   "adult" => "1", 
				   "child" => "0", 
				   "infant" => "0", 
				   "price" => $total_amount, 
				   "currency" => $api_currency, 
				   "airline" => "AI", 
				   "flight_type" => "oneway",
				);
				$data = array(
					'page_id' => 'flights-from-'.$citySingelFROM->city_name.'-to-'.$citySingelTO->city_name,
					'name' =>'flights-from-'.$citySingelFROM->city_name.'-to-'.$citySingelTO->city_name,
					'image' => 'uploads/flight1.jpg',
					'title' => 'flights-from-'.$citySingelFROM->city_name.'-to-'.$citySingelTO->city_name,
					'meta_keywords' =>'flights-from-'.$citySingelFROM->city_name.'-to-'.$citySingelTO->city_name,
					'meta_description' =>'flights-from-'.$citySingelFROM->city_name.'-to-'.$citySingelTO->city_name,
					'content' =>'flights-from-'.$citySingelFROM->city_name.'-to-'.$citySingelTO->city_name,
					'other_content' => json_encode($other_content),
					'status' => 'active',
					'type' => 'landing',
					'type_name' => 'flights',
					'city_from_code' => $citySingelFROM->code,
					'city_from' => $citySingelFROM->city_name,
					'cityFromUrl' => $citySingelFROM->cityUrl,
					'countryFromUrl' =>$citySingelFROM->countryUrl,
					'county_from_code' => $citySingelFROM->country_code, 
					'city_to_code' =>$citySingelTO->code,
					'city_to' =>$citySingelTO->city_name,
					'cityToUrl' => $citySingelTO->cityUrl,
					'countryToUrl' => $citySingelTO->countryUrl,
					'county_to_code' =>$citySingelTO->country_code, 
					'search_id' =>$search_id,
					'date_time' => date('Y-m-d H:i:s')
				);
			$flightData=crud_model::readOne('pages',array('city_from_code'=>$citySingelFROM->code,'city_to_code'=>$citySingelTO->code,'type'=>'landing','type_name'=>'flights'));
			if(!is_object($flightData)){  
				$status = Crud_Model::insertData('pages',$data); 				
			}else{ 
				$status = Crud_Model::updateData('pages',$data,array('city_from_code'=>$citySingelFROM->code,'city_to_code'=>$citySingelTO->code,'type'=>'landing','type_name'=>'flights'));
			}
			
	}
	
	
		
}



