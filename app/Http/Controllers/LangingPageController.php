<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud_Model;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Auth;


class LangingPageController extends Controller
{
	public $ACCESS_TOKEN='duffel_test_ocGJmEe__3yoXi8rpCX2PIBwzCamnNrLGbsO-UDyWv6';
	public $fromAtirports=array('LOS','ABV','PHC','ENU','KAN','BNI','CBQ','KAD','MIU','ILR','IBA');
	
		public $hotelbeds_keyTour='526a0b6f4d07cf75e5ed2c272babd21a';
		public $hotelbeds_secretTour='4d796cc468'; 
		public $endpointTour= "https://api.test.hotelbeds.com/activity-api/3.0";
		
		public $hotelbeds_keyTransfer='e11070419f23bb1743576ff13cf72fa5';
		public $hotelbeds_secretTransfer='fbec08d52d'; 
		public $endpointTransfer= "https://api.test.hotelbeds.com/transfer-api/1.0";
		
		public $currency='';  public $currency_symbol=''; public $headerData=''; public $hotelbeds_key=''; public $hotelbeds_secret='';
		
		public function __construct(){
		    $data= crud_model::readOne('user',array('id'=>1)); //$this->crud_model->readOne('website_setting',1);
		   	$common_data= $data->common_data;
			$common_dataArr= json_decode($common_data,true);
			$this->currency=$data->currency;
			$this->currency_symbol=$data->currency_symbol;
			$this->hotelbeds_key=$common_dataArr['hotelbeds_key'];
			$this->hotelbeds_secret=$common_dataArr['hotelbeds_secret'];
			$signature = hash("sha256", $this->hotelbeds_key.$this->hotelbeds_secret.time());
			$this->headerData=array('Content-Type: application/json','Accept:application/json','Api-key:'.$this->hotelbeds_key, 'X-Signature:'.$signature);
			
			$signatureTour = hash("sha256", $this->hotelbeds_keyTour.$this->hotelbeds_secretTour.time());
			$this->headerDataTour=array('Content-Type: application/json','Accept:application/json','Api-key:'.$this->hotelbeds_keyTour, 'X-Signature:'.$signatureTour);
			
			
			$signatureTransfer = hash("sha256", $this->hotelbeds_keyTransfer.$this->hotelbeds_secretTransfer.time());
			$this->headerDataTransfer=array('Content-Type: application/json','Accept:application/json','Api-key:'.$this->hotelbeds_keyTransfer, 'X-Signature:'.$signatureTransfer);
			
		}
	
    public function Index(Request $request) 
    {
		$request= $request->input();
		$type_name=$request['type_name']; $id=$request['id'];
		
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
			Crud_Model::updateData('airports',array($type_name.'Landing'=>'Yes'),array('id'=>$id));
		}else{ $lastid=$pageSingel->id; }	
		
		if($type_name=='city'){ 		
			$this->getFlightResult($citySingel,$this->fromAtirports[0],$citySingel->code,0);
			$this->getHotelResult($citySingel);
			$this->getTourResult($citySingel);
			$this->getTransferResult($citySingel);
		}
					
		$pageSingel = crud_model::readOne('pages',array('id'=>$lastid));
		return view('admin/add-page', array('pageSingel' => $pageSingel));
		
	}
	
	function getFlightResult($fromIATA,$toIATA){
		   $departure_date= date('Y-m-d', strtotime(date('m/d/Y').' +6 day'));
		   $slices[]=array("origin"=>$fromIATA,"destination"=>$toIATA,"departure_date"=>$departure_date);
		   $passengers[]= array("type"=>"adult");
		   $Request = array('data'=>array('slices'=>$slices,'passengers'=>$passengers,'cabin_class'=>'economy')); 		   
		   $actionUrl='https://api.duffel.com/air/offer_requests';	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $actionUrl);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Request));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json','Duffel-Version: beta','Authorization: Bearer '.$this->ACCESS_TOKEN));
		    $contents = curl_exec($ch);
			curl_close($ch);
			$res=json_decode($contents,true);
			$isFind='No';
			if(isset($res['data'])){	
		$offers=$res['data']['offers'];
		
		if(count($offers)>0){ $count=20; }else { $count =0; }  $count=count($offers);
		for($i=0;$i<$count;$i++)
		{
			$api_currency=$offers[$i]['base_currency'];   
			$base_amount= $this->convertCurrencyRateFlight($api_currency,$offers[$i]['base_amount']);
			$tax_amount= $this->convertCurrencyRateFlight($api_currency,$offers[$i]['tax_amount']);
			$total_amount= $this->convertCurrencyRateFlight($api_currency,$offers[$i]['total_amount']);
			$actual_price=$offers[$i]['total_amount'];
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
			
				$tax_amount=100;
			$data[]=array(
					'TokenId'=>$TokenId,
					'OfferId'=>$OfferId,
					'IsLCC'=>$IsLCC,
					'IsRefundable'=>$IsRefundable,
					'onewayFlights'=>json_encode($onewayFlights),
					'price'=>$total_amount,
					'base_fare'=>$base_amount,
					'tax'=>$tax_amount,
					'actual_price'=>$actual_price,
					'currency'=>$this->currency,
					'api_currency'=>$api_currency,
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
					'type_flights'=>'',
					'bags_price'=>'',
					'flight_no'=>$onewayFlights[0]['flight_no'],
					'airlines'=>$operating_carrier,
					'baglimit'=>'',
					'airAirPricingSolution'=>'',
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
					'type'=>'landing',
				);
		}
			//$data=$this->unique_key($offers,'flight_number');
			$status = Crud_Model::insertData('flight_results',$data);
		
		$isFind='Yes'; $contents='';
	}else{ $isFind='No'; }
	
			$data=array('isFind'=>$isFind,'search_session'=>$search_session,'contents'=>$contents); 
		    echo json_encode($data);		
				
	}
	
	
	
	
	
	function getHotelResult($citySingel){
	$toIATA=$citySingel->city_code;
		$checkIn= date('Y-m-d', strtotime(date('m/d/Y').' +6 day'));
		$checkOut= date('Y-m-d', strtotime(date('m/d/Y').' +7 day'));

		$hotel =array(); $img=array();
		$dquery =DB::select("select hotel_id,img_path from hotelbeds_hotels WHERE destinationCode='".$toIATA."' and status_deleted=0 ORDER BY id DESC limit 1,200");
		foreach($dquery as $dobj){
		 $hotel['hotel'][]=	trim($dobj->hotel_id); $img[$dobj->hotel_id]=$dobj->img_path;
		}
					$packs[]=array('type'=>'AD','age'=>40);
					$occupancies[]=array('rooms'=>1,'adults'=>1,'children'=>0,'paxes'=>$packs);
					$brdlist=array('RO','BB','AI','HB','FB','RR','AB','DB','GB','IB','LB');
					$boardarr=array('included'=>true,'board'=>$brdlist);
	
					$reviewsArr[] =array('type'=>'TRIPADVISOR','maxRate'=>5,'minReviewCount'=>1);
					$accommodationsArr=array('HOTEL','RESORT','HOSTEL','HOMES','APTHOTEL','APARTMENT');
					$postdata =array('language'=>'ENG',
                     'currency'=>'USD', 
	                 'stay'=>array('checkIn'=>$checkIn,'checkOut'=>$checkOut,'shiftDays'=>1),
	                 'occupancies'=>$occupancies,
                     'hotels'=>$hotel,
					 'filter'=>array('packaging'=>true),
					 'boards'=>$boardarr,
	                );
					$actionUrl='https://api.test.hotelbeds.com/hotel-api/1.0/hotels';
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
				
			$res=json_decode($response,true);
			if(isset($res['hotels']['hotels'])){	
				$hotels=$res['hotels']['hotels'];	
				$api_currency=$hotels[0]['currency'];
				$total_amount= $this->convertCurrencyRateFlight($api_currency,$hotels[0]['minRate']);
				$code=$hotels[0]['code'];
				$other_content=array("IATA_from" => '', 
				   "city_from" => '', 
				   "cityFromUrl" => '', 
				   "countryFromUrl" => '', 
				   "country_from" => '', 
				   "fly_from" => '', 
				   "IATA_to" => $citySingel->code, 
				   "city_to" => $citySingel->city_name, 
				   "cityToUrl" => $citySingel->cityUrl, 
				   "countryToUrl" => $citySingel->countryUrl,
				   "country_to" =>$citySingel->country_code, 
				   "fly_to" => $citySingel->name, 
				   "outbound_days" => "1", 
				   "inbound_days" => "1", 
				   "room" => "1",
				   "adult" => "1", 
				   "child" => "0", 
				   "infant" => "0", 
				   "price" => $total_amount, 
				   "currency" => $api_currency, 
				
				   "hotel_image" => 'http://photos.hotelbeds.com/giata/'.$img[$code], 
				   "rating" => str_replace('EST','',$hotels[0]['categoryCode']), 
				   "hotel_address" => $hotels[0]['destinationName'], 
				   "hotel_name" =>$hotels[0]['name'], 
				   "hotel_code" => $hotels[0]['code'], 
				   
				);
				$data = array(
					'page_id' => $toIATA.'-Hotel',
					'name' => $toIATA.' Hotel',
					'image' => '',
					'title' => $toIATA.' Hotel',
					'meta_keywords' =>$toIATA.' Hotel',
					'meta_description' =>$toIATA.' Hotel',
					'content' =>$toIATA.' Hotel',
					'other_content' => json_encode($other_content),
					'status' => 'active',
					'type' => 'landing',
					'type_name' => 'hotel',
					'city_from_code' => '',
					'city_to_code' => $other_content['IATA_to'],
					'city_from' => '',
					'city_to' =>$other_content['city_to'],
					'cityFromUrl' => '',
					'cityToUrl' => $other_content['cityToUrl'],
					'countryFromUrl' =>'',
					'countryToUrl' => $other_content['countryToUrl'],
					'county_from_code' => '',
					'county_to_code' =>$other_content['country_to'],
					'date_time' => date('Y-m-d H:i:s'),
				);
				$status = Crud_Model::insertData('pages',$data); 				
			}
			
				
	}
	
	
	function getTourResult($citySingel){
	$toIATA=$citySingel->city_code;
		   $checkIn= date('Y-m-d', strtotime(date('m/d/Y').' +6 day'));

			$actionUrl=$this->endpointTour.'/activities';
			$dest[] =array('type'=>'destination','value'=>$toIATA); 
			$desti[] =array('searchFilterItems'=>$dest);
			$postdata =array('filters'=>$desti,'from'=>$checkIn,'to'=>$checkIn);			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $actionUrl);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerDataTour);
			$contents = curl_exec($ch); 
			curl_close($ch);		
				
			$res=json_decode($contents,true);
			if(isset($res['activities'][0])){	
				$activities=$res['activities'];	
				
				$content = $activities[0]['content']; 		
				if(isset($content['images'])){ 
					$images = $content['media']['images'];								
					$thumbNail = $images[0]['urls'][4]['resource']; 
					$findArr = array('http:', 'https:');
					$replaceArr = array('http://', 'https://');
					$thumbNailUrl = str_replace($findArr, $replaceArr, $thumbNail);					
				 } else { $thumbNailUrl='/images/nohotel.jpg'; $images=''; }
				
				$api_currency=$activities[0]['currency'];
				$total_amount= $this->convertCurrencyRateFlight($api_currency,$activities[0]['amountsFrom'][0]['amount']);
				
				$other_content=array("IATA_from" => '', 
				   "city_from" => '', 
				   "cityFromUrl" => '', 
				   "countryFromUrl" => '', 
				   "country_from" => '', 
				   "fly_from" => '', 
				   "IATA_to" => $citySingel->code, 
				   "city_to" => $citySingel->city_name, 
				   "cityToUrl" => $citySingel->cityUrl, 
				   "countryToUrl" => $citySingel->countryUrl,
				   "country_to" =>$citySingel->country_code, 
				   "fly_to" => $citySingel->name, 
				   "outbound_days" => "1", 
				   "inbound_days" => "1", 
				   "room" => "1",
				   "adult" => "1", 
				   "child" => "0", 
				   "infant" => "0", 
				   "price" => $total_amount, 
				   "currency" => $api_currency, 
				);
				$data = array(
					'page_id' => $toIATA.'-Tours',
					'name' => $toIATA.' Tours',
					'image' => $thumbNailUrl,
					'title' => $toIATA.' Tours',
					'meta_keywords' =>$toIATA.' Tours',
					'meta_description' =>$toIATA.' Tours',
					'content' =>$toIATA.' Tours',
					'other_content' => json_encode($other_content),
					'status' => 'active',
					'type' => 'landing',
					'type_name' => 'tours',
					'city_from_code' => '',
					'city_to_code' => $other_content['IATA_to'],
					'city_from' => '',
					'city_to' =>$other_content['city_to'],
					'cityFromUrl' => '',
					'cityToUrl' => $other_content['cityToUrl'],
					'countryFromUrl' =>'',
					'countryToUrl' => $other_content['countryToUrl'],
					'county_from_code' => '',
					'county_to_code' =>$other_content['country_to'],
					'date_time' => date('Y-m-d H:i:s'),
				);
				$status = Crud_Model::insertData('pages',$data); 				
			}
			
				
	}
	
	
	function getTransferResult($citySingel){
	$toIATA=$citySingel->city_code;
		   $departure_date= date('Y-m-d', strtotime(date('m/d/Y').' +6 day'));
			$pickupTime=11;
			$DepartureTime=$departure_date.'T'.$pickupTime.':00';
			echo "select hotel_id from hotelbeds_hotels WHERE destinationCode='".$toIATA."' and status_deleted=0 ORDER BY rating DESC limit 1";
			$res =DB::select("select hotel_id from hotelbeds_hotels WHERE destinationCode='".$toIATA."' and status_deleted=0 ORDER BY rating DESC limit 1");
			$hotel_id = $res[0]->hotel_id;
			
			$URL=$this->endpointTransfer.'/availability/en/from/IATA/'.$toIATA.'/to/ATLAS/'.$hotel_id.'/'.$DepartureTime.'/1/0/0';
	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $URL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerDataTransfer);
			$contents = curl_exec($ch);
			curl_close ($ch);	
				
			$res=json_decode($contents,true);
			if(isset($res['services'])){	
				$services=$res['services'];	
				
				$content =$services[0]['content'];
				$imagesUrl =$content['images'][1]['url'];
				
				$api_currency=$services[0]['price']['currencyId'];
				$total_amount= $this->convertCurrencyRateFlight($api_currency,$services[0]['price']['totalAmount']);
				
				$other_content=array("IATA_from" => '', 
				   "city_from" => '', 
				   "cityFromUrl" => '', 
				   "countryFromUrl" => '', 
				   "country_from" => '', 
				   "fly_from" => '', 
				   "IATA_to" => $citySingel->code, 
				   "city_to" => $citySingel->city_name, 
				   "cityToUrl" => $citySingel->cityUrl, 
				   "countryToUrl" => $citySingel->countryUrl,
				   "country_to" =>$citySingel->country_code, 
				   "fly_to" => $citySingel->name, 
				   "outbound_days" => "1", 
				   "inbound_days" => "1", 
				   "room" => "1",
				   "adult" => "1", 
				   "child" => "0", 
				   "infant" => "0", 
				   "price" => $total_amount, 
				   "currency" => $api_currency, 
				);
				$data = array(
					'page_id' => $toIATA.'-Transfer',
					'name' => $toIATA.' Transfer',
					'image' => $imagesUrl,
					'title' => $toIATA.' Transfer',
					'meta_keywords' =>$toIATA.' Transfer',
					'meta_description' =>$toIATA.' Transfer',
					'content' =>$toIATA.' Transfer',
					'other_content' => json_encode($other_content),
					'status' => 'active',
					'type' => 'landing',
					'type_name' => 'transfer',
					'city_from_code' => '',
					'city_to_code' => $other_content['IATA_to'],
					'city_from' => '',
					'city_to' =>$other_content['city_to'],
					'cityFromUrl' => '',
					'cityToUrl' => $other_content['cityToUrl'],
					'countryFromUrl' =>'',
					'countryToUrl' => $other_content['countryToUrl'],
					'county_from_code' => '',
					'county_to_code' =>$other_content['country_to'],
					'date_time' => date('Y-m-d H:i:s'),
				);
				$status = Crud_Model::insertData('pages',$data); 				
			}
			
				
	}
	
	
	
	
	
	
	
	
	
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
	
	
	
	
	
}
