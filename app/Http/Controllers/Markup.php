<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud_Model;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmailController;


class Markup extends Controller
{ 	
		public $currency='';  public $currency_symbol='';
		public $ACCESS_TOKEN='duffel_test_ocGJmEe__3yoXi8rpCX2PIBwzCamnNrLGbsO-UDyWv6';
		
		public function __construct(){
			$this->emailObj= new EmailController();
			$this->emailObj= new EmailController();
		    $data= crud_model::readOne('users',array('user_id'=>1)); 
		   	$common_data= $data->common_data;
			$common_dataArr= json_decode($common_data,true);
			
			$this->flight_markup=$common_dataArr['flight_markup'];
			$this->flight_markup_type=$common_dataArr['flight_markup_type'];
			$this->flight_markup_agent=$common_dataArr['flight_markup_agent'];
			$this->flight_markup_agent_type=$common_dataArr['flight_markup_agent_type'];
			
			$this->hotel_markup=$common_dataArr['hotel_markup'];
			$this->hotel_markup_type=$common_dataArr['hotel_markup_type'];
			$this->hotel_markup_agent=$common_dataArr['hotel_markup_agent'];
			$this->hotel_markup_agent_type=$common_dataArr['hotel_markup_agent_type'];
			
			$this->currency=$data->currency;
			$this->currency_symbol=$data->currency_symbol;
		}
	
		
	
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
		return ceil($price);
	}
	
    public function calAdminPrice($price,$product){
			$user_type=session()->get('user_type');
			if($product=='flight'){
				if($user_type=='agent'){ $markp= $this->flight_markup_agent; $type=$this->flight_markup_agent_type; }
				else{ $markp= $this->flight_markup; $type=$this->flight_markup_type;  }
			}else if($product=='hotel'){
				if($user_type=='agent'){ $markp= $this->hotel_markup_agent; $type=$this->hotel_markup_agent_type; }
				else{ $markp= $this->hotel_markup; $type=$this->hotel_markup_type;  }
			}
			
			if($type=='flat'){ $price=floatval($price)+floatval($markp); }
			else{ $price=floatval($price)+(floatval($price)/100)*floatval($markp); }
			return ceil($price);
	}
	
	public function calAgentPrice($price,$product){
			$user_id=session()->get('user_id');
			$data= crud_model::readOne('users',array('user_id'=>$user_id)); //$this->crud_model->readOne('website_setting',1);
		   	$common_data= $data->common_data;
			$common_dataArr= json_decode($common_data,true);
			
			if(isset($common_dataArr['flight_markup'])){
				$markp=$this->flight_markup=$common_dataArr['flight_markup'];
				$type=$this->flight_markup_type=$common_dataArr['flight_markup_type'];
				if($type=='flat'){ $price=floatval($price)+floatval($markp); }
				else{ $price=floatval($price)+(floatval($price)/100)*floatval($markp); }
			}
			return ceil($price);
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




