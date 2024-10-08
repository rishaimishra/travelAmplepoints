<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud_Model;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;



class Site extends Controller
{
	
/*	  public function __construct()
	  {
		// IP address
		$userIP = $_SERVER['REMOTE_ADDR'] ;
		echo $apiURL = 'https://freegeoip.app/json/'.$userIP;  echo "<br>";
		$ch = curl_init($apiURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		echo "apiResponse==".$apiResponse = curl_exec($ch);
		curl_close($ch);
		$ipData = json_decode($apiResponse, true);
		
		
		function get_browser_name_1($user_agent)
		{
			if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
			elseif (strpos($user_agent, 'Edge')) return 'Edge';
			elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
			elseif (strpos($user_agent, 'Safari')) return 'Safari';
			elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
			elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
		   
			return 'Other';
		}
		// Usage:
		$browser=get_browser_name_1($_SERVER['HTTP_USER_AGENT']);
	
		// (A) MOBILE DEVICE CHECK
		$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
		 
		// (B) TABLET CHECK
		$isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet"));
		 
		// (C) DESKTOP?
		$isDesktop = !$isMob && !$isTab;
	
		if($isMob=='true'){ $device='Mobile'; }
		else if($isTab=='true'){ $device='Tab'; }
		else if($isDesktop=='true'){ $device='Desktop'; }
	 
		// (D) MANY OTHERS...
		$isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows"));
		$isAndroid = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "android"));
		$isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "iphone"));
		$isIPad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "ipad"));
		$isIOS = $isIPhone || $isIPad ;
		
		if($isWin=='true'){ $os='Windows'; }
		else if($isAndroid=='true'){ $os='Android'; }
		else if($isIPhone=='true'){ $os='IPhone'; }
		else if($isIPad=='true'){ $os='IPad'; }
		else if($isIOS=='true'){ $os='IOS'; }
	
		$data = array(
				'ip' => $userIP,
				'device' =>  $device,
				'os' => $os,
				'country' => $ipData['country_name'],
				'country_code' => $ipData['country_code'],  
				'region' => $ipData['region_name'],
				'city' => $ipData['city'],
				'zip_code' => $ipData['zip_code'],
				'time_zone' => $ipData['time_zone'],
				'latitude' => $ipData['latitude'],
				'longitude' => $ipData['longitude'],
				'browser' => $browser,
				'response' => $apiResponse,
				'date_time' => date('Y-m-d h:i:s')
			);
	
			$value = Crud_Model::insertData('visitor',$data);
			//$query = $this->crud_model->insert('visitor', $data);
		}
  */
  
  		public $currency='';  public $currency_symbol='';
		
		public function __construct(){
			$this->emailObj= new EmailController();
			$data= crud_model::readOne('users',array('website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),'user_type'=>'admin'));
		   	//$data= crud_model::readOne('user',array('id'=>1)); //$this->crud_model->readOne('website_setting',1);
		   	$common_data= $data->common_data;
			$common_dataArr= json_decode($common_data,true);
			$this->currency=$data->currency;
			$this->currency_symbol=$data->currency_symbol;
		}
  
 public static function Index($id=0){
 	if(!isset($_REQUEST['client_id'])){ $_REQUEST['client_id']=1;  }
 	$id=$_REQUEST['client_id']; 
	if(session()->get('user_type')=='agent' ){ $id=session()->get('user_id'); }
   	$currency_list = crud_model::readByCondition('currency_rates',array('published'=>'Yes'));
	$siteData = crud_model::readOne('users',array('user_id'=>$id)); //crud_model::readOne('website_setting',array('id'=>1));
	
		//MOBILE DEVICE CHECK
		$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
		$isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet"));
		$isDesktop = !$isMob && !$isTab;
		if($isMob=='true'){ $device='Mobile'; }
		else if($isTab=='true'){ $device='Tab'; }
		else if($isDesktop=='true'){ $device='Desktop'; }
	
	return json_encode(array('currency_list'=>$currency_list,'siteData'=>$siteData,'device'=>$device));
  }
  
   public static function PageData(){
	echo url('/'); echo "<br>";

	$pageData = crud_model::readOne('pages',array('page_id'=>'home'));
	return json_encode(array('pageData'=>$pageData));
  }
  
  public function Index3($id=0){
    // Fetch all records
    $userData['data'] = User::where('user_id','1')->first();  //Crud_Model::read('users','1');
    return $userData;
  }
  public function ChangeCurrency(Request $request)  
  {  
           $redirectUrl=$request->input('redirectUrl');
		   $id=1;
		  if(session()->get('user_type')=='agent' ){ $id=session()->get('user_id'); }
		   $p_currency=$request->input('currency');
		   $p_currencyArr=explode('_',$p_currency);
		   
		   $t_data = array(
			'currency' => json_encode($common_dataArr),
			'currency_symbol' => $p_currencyArr[0],
		   );
		   $value = Crud_Model::updateData('users',$t_data,array('user_id'=>$id));
       return redirect($redirectUrl); 
    }
	











  public function Signup(Request $request){ 
	$user_type=$request->input('user_type');
	$images='{"logo":null,"icon":null,"profile_pic":"https:\/\/dev.plistbooking.travel\/images\/noimage.png"}';
	$common_data='{"color":"","contact1":"","contact2":null,"email1":"","email2":null,"address1":"","address2":null,"about":null,"fb_link":null,"tw_link":null,"insta_link":null,"ld_link":null,"ticktok_link":null,"telegram_link":null,"youtube_link":null,"wh_link":null,"hotelbeds_secret":null,"hotelbeds_key":null,"hotelbeds_tours_secret":null,"hotelbeds_tours_key":null,"hotelbeds_transfer_secret":null,"hotelbeds_transfer_key":null,"flight_duffel_token":null}';
	 $data = array(
			'user_type' => $request->input('user_type'),
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
			'email' => $request->input('email'),
			'mobile' => $request->input('contact_number'),
			'address' => $request->input('address'),
			'email' => $request->input('email'),
			'password' => $request->input('pass1'),  //Hash::make($request->input('pass1')), //
			'status'=>$request->input('status'),
			'images'=>$images,
			'common_data'=>$common_data,
			'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
		);
            // Insert
    $value = Crud_Model::insertData('users',$data); 
	if($value>1){
		// $this->emailObj->AccountActivationMail($value);
		if($user_type=="customer"){
			// dd(1);
			$res=$this->insertAmplepointDatabase($data);
			// dd($res);
			// die();
		}
		return redirect('/login?msg=Inserted Successfully');
    	//return view('site/login')->with("msg",'Inserted Successfully');
	}else{
		return redirect($user_type.'-signup?msg=Something Went Wrong Please Try Again');
		//return view('site/'.$user_type.'-signup')->with("msg",'Something Went Wrong Please Try Again');
	}
    //return $value;
  }
  







public function insertAmplepointDatabase($data){

        //this code is for register user from travel project ==> to amplepoint project user tbale using php core code

        // Specify API endpoint
       $url = 'http://localhost:8080/tarunAmple/api/regFromTravel';

        // Specify payload for POST request
        $payload = json_encode($data);

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
            CURLOPT_RETURNTRANSFER => true,
        ]);

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for cURL error
        if ($error = curl_error($ch)) {
            // Handle cURL error
            return response()->json(['error' => $error], 500);
        }

        // Close cURL session
        curl_close($ch);

        // Handle the response as needed
        return response()->json(['response' => $response]);

}







public function userInserFromAmplepoint(Request $request){
	// return $request->all();
	//user insert code with ample point
	$ins=new User;
	$ins->user_type="customer";
	$ins->first_name=$request->first_name;
	$ins->last_name=$request->last_name;
	$ins->ample=$request->total_ample;
	$ins->email=$request->email;
	$ins->phone=$request->mobile;
	$ins->password=$request->pass;
	$ins->website="travel.amplepoints.com";
	$ins->save();

	return "Resgistraion to travel project is successfull";
}









  public function Enquiry(Request $request){ 
      $redirectUrl=$request->input('redirectUrl');
	 $data = array(
			'name' => @$request->input('name')." ".@$request->input('lname'),
			'email' => @$request->input('email'),
			'phone' => @$request->input('phone'),
			'how_know_me' => @$request->input('how_know_me'),
			'address' => @$request->input('address'),
			'type' => @$request->input('type'),
			'tid' => @$request->input('tid'),
			'message' => @$request->input('message'),
			'date_time' => date('Y-m-d h:i:s'),
			'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
		);
            // Insert
    $value = Crud_Model::insertData('enquiry',$data);
   
    
	
	$this->emailObj->EnquiryMail($value);
	if($request->type="enq"){
	 return back();
	}
	return redirect($redirectUrl); 
    //return $value;
  }

  public function Logout(Request $request){
		Session::flush();
		//echo Auth::logout(); 
		return redirect('/login');  
  }
  
  //user login
  public function Login(Request $request){
  	$data = array(
		'email' => $request->input('email'),
		'password' => ($request->input('password')),
		);
		
		//$check = Crud_Model::auth_check('users',$data);
 // Fetch the user by email
        $check = User::where('email', $request->input('email'))->first();

        // Verify the password
        if ($check && Hash::check($request->input('password'), $check->password)) {
            // Convert user object to array
            $result_user = json_decode(json_encode($check), true);
            $user_type = $result_user['user_type'];

            // Check if the user is an agent and inactive
            if ($result_user['status'] !== 'active' && $user_type === 'agent') {
                return redirect('/login?msg=Your Account is Not Activated.');
            }

            // Log the user in
            Auth::login($check);

            // Redirect to the intended page or dashboard
            // return redirect()->intended('dashboard');
        // }else{
        	
        // }
			// dd(Auth::user()->id);



			
			
			Session::put('user_id', $result_user['user_id']);
			Session::put('email', $result_user['email']);
			Session::put('first_name', $result_user['first_name']);
			Session::put('last_name', $result_user['last_name']);
			Session::put('markup', $result_user['mark_up']);
			Session::put('user_type', $result_user['user_type']);
			Session::put('user_image', $result_user['profile_pic']);

			// dd(Session::get('user_id'));;


			if($user_type == "admin"){
				return redirect('/login?msg=Invalid Username or Password!');
			}
			else if($user_type == "agent"){
				return redirect('/agent-dashboard');
			}
			else{
				if($request->prevUrl){
					// dd($request->prevUrl);
					return redirect()->to($request->prevUrl);
				}
				// dd(Session::get('user_id'));
				return redirect('/customer-dashboard');
				// return redirect('/');
			} 

		}
		else{
			// 
			$check2 = User::where('email', $request->input('email'))->where('password',$request->input('password'))->first();
			if($check2){
				$result_user = json_decode(json_encode($check), true);
	            $user_type = $result_user['user_type'];

	            // Check if the user is an agent and inactive
	            if ($result_user['status'] !== 'active' && $user_type === 'agent') {
	                return redirect('/login?msg=Your Account is Not Activated.');
	            }

	            // Log the user in
	            Auth::login($check);
			
				Session::put('user_id', $result_user['user_id']);
				Session::put('email', $result_user['email']);
				Session::put('first_name', $result_user['first_name']);
				Session::put('last_name', $result_user['last_name']);
				Session::put('markup', $result_user['mark_up']);
				Session::put('user_type', $result_user['user_type']);
				Session::put('user_image', $result_user['profile_pic']);


				if($user_type == "admin"){
					return redirect('/login?msg=Invalid Username or Password!');
				}
				else if($user_type == "agent"){
					return redirect('/agent-dashboard');
				}
				else{
					if($request->prevUrl){
						// dd($request->prevUrl);
						return redirect()->to($request->prevUrl);
					}
					// dd(Session::get('user_id'));
					return redirect('/customer-dashboard');
					// return redirect('/');
				} 
			}
			else{
				return redirect('/login?msg=Invalid Username or Password!');
			}
			return redirect('/login?msg=Invalid Username or Password!');
		}
  }
  
   public function reset_password(Request $request){ 
		$password=$request['password'];
		$email=$request['email'];
		   $t_data = array(
			'password' => $password,
		   );
		   $value = Crud_Model::updateData('users',$t_data,array('email'=>$email));
		$data=array('error'=>'No','msg'=>'successfull');
		echo json_encode($data);
		die;
	}
  
  
  public function send_mail($mail_from,$mail_to,$subject,$content){
    //$headers = "From: $subject <$mail_from>";

    # Send the email.
   // $success = mail($mail_to, $subject, $content, $headers);
	$headers = "From: $mail_from" . "\r\n" ;//."CC: techieakm@gmail.com";
	
	return mail($mail_to,$subject,$content,$headers);	  
 }
		public  function Check(Request $request){
			echo "price===".$this->convertCurrencyRateFlight('USD',100);
		}

   public static function convertCurrencyRateFlight($from,$price){
		$data= crud_model::readOne('users',array('user_id'=>1)); //$this->crud_model->readOne('website_setting',1);
		$to=$data->currency;
		$currency_symbol=$data->currency_symbol;
		
		if($to==''){ $to='INR'; }
		if($from==''){ $from='INR'; }
		$price=preg_replace('/[^0-9^.]/', '', $price);
		if($price==''){ $price=100.00; } //$price=100.00;
		
		$usdRate =1;
		if($from!=$to){  
			//$currObj=$this->crud_model->customQuery($from,$to);
			$currObj = DB::select("select rate as fromRate, (select rate from  currency_rates where `currency`='".$to."')  as toRate  from currency_rates where `currency`='".$from."'");
						
			if(isset($currObj[0])){
				$fromRate =$currObj[0]->fromRate; 
				$toRate =$currObj[0]->toRate;
				if($usdRate>$fromRate){
				 $usdPrice =($price*$fromRate);	
				}else{
				 $usdPrice =($price/$fromRate);	
				}
				$price =($usdPrice*$toRate);
			}
		}

		$price=number_format($price,2, '.', ',');
		return  $price;
	}
	
	
 public static function GetDest($LIMIT=0){
 	if(!isset($_REQUEST['client_id'])){ $_REQUEST['client_id']=1;  }
 	$Africa = DB::select("select * from airports where `continent_id`='AF' GROUP by country_code LIMIT ".$LIMIT." ");
	$Asia = DB::select("select * from airports where `continent_id`='AS' GROUP by country_code LIMIT ".$LIMIT." ");
	$Europe = DB::select("select * from airports where `continent_id`='EU' GROUP by country_code LIMIT ".$LIMIT." ");
	$North_America = DB::select("select * from airports where `continent_id`='NA' GROUP by country_code LIMIT ".$LIMIT." ");
	$South_America = DB::select("select * from airports where `continent_id`='SA' GROUP by country_code LIMIT ".$LIMIT." ");
	$Oceania = DB::select("select * from airports where `continent_id`='OC' GROUP by country_code LIMIT ".$LIMIT." ");
	$Antarctica = DB::select("select * from airports where `continent_id`='AN' GROUP by country_code LIMIT ".$LIMIT." ");
	
	return json_encode(array('Africa'=>$Africa,'Asia'=>$Asia,'Europe'=>$Europe,'Asia'=>$Asia,'North_America'=>$North_America,'South_America'=>$South_America,'Oceania'=>$Oceania,'Antarctica'=>$Antarctica));
		
  }
  
   public static function GetDestAll(){
 	if(!isset($_REQUEST['client_id'])){ $_REQUEST['client_id']=1;  }
 	$Africa = DB::select("select * from airports where `continent_id`='AF'   ");
	$Asia = DB::select("select * from airports where `continent_id`='AS'  ");
	$Europe = DB::select("select * from airports where `continent_id`='EU'  ");
	$North_America = DB::select("select * from airports where `continent_id`='NA' ");
	$South_America = DB::select("select * from airports where `continent_id`='SA'  ");
	$Oceania = DB::select("select * from airports where `continent_id`='OC' ");
	$Antarctica = DB::select("select * from airports where `continent_id`='AN'  ");
	
	return json_encode(array('Africa'=>$Africa,'Asia'=>$Asia,'Europe'=>$Europe,'Asia'=>$Asia,'North_America'=>$North_America,'South_America'=>$South_America,'Oceania'=>$Oceania,'Antarctica'=>$Antarctica));
		
  }








public function cronJobForUpdateAmplePoint(){
    // Specify API endpoint
    $url = 'http://localhost:8080/tarunAmple/api/cronJobForUpdateAmplePoint';

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
        ],
        CURLOPT_RETURNTRANSFER => true,
    ]);

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for cURL error
    if ($error = curl_error($ch)) {
        // Handle cURL error
        return response()->json(['error' => $error], 500);
    }

    // Close cURL session
    curl_close($ch);

    // dd(json_decode($response, true));
    foreach(json_decode($response, true) as $val){
    	// dd($val);
    	$up=User::where('email',$val->email)->update(['ample'=>$val->amplepoint]);
    }

    // Handle the response as needed
    return response()->json(['response' => "Data updated"]);
}






public function Login_new(Request $request){
	$userDetail=User::where('email',$request->email)->first();
	// dd($userDetail);
	Auth::login($userDetail);
	 // Store user ID in a cookie
        Cookie::queue('user_id', $userDetail->id, 60000); // Cookie will last for 60 minutes

	// dd(Auth::user()->id);
	// return view('test');
	return redirect()->route('test');
}


public function test(){
	 return view('test');
}











public function adminLogin(Request $request){
	$data = array(
		'email' => $request->input('email'),
		'password' => ($request->input('password')),
		);
		
		 // Fetch the user by email
        // $check = User::where('email', $request->input('email'))->where('user_type','admin')->first();
        $check = User::where('email', $request->input('email'))->where('password',$request->input('password'))->where('user_type','admin')->first();

        // Verify the password
        if ($check ) {
            // Convert user object to array
            $result_user = json_decode(json_encode($check), true);
            $user_type = $result_user['user_type'];

            // Check if the user is an agent and inactive
            if ($result_user['status'] !== 'active' && $user_type === 'agent') {
                return redirect('/login?msg=Your Account is Not Activated.');
            }

            // Log the user in
            Auth::login($check);

            // Redirect to the intended page or dashboard
            // return redirect()->intended('dashboard');
   //      }else{
   //      	 return redirect('/admin-login?msg=Credential missmatch.');
   //      }
			// // dd(Auth::user()->id);


			
			
			Session::put('user_id', $result_user['id']);
			Session::put('email', $result_user['email']);
			Session::put('first_name', $result_user['first_name']);
			Session::put('last_name', $result_user['last_name']);
			Session::put('markup', $result_user['mark_up']);
			Session::put('user_type', $result_user['user_type']);
			Session::put('user_image', $result_user['profile_pic']);

			// dd(Session::get('user_id'));;


			if($user_type == "admin"){
				return redirect('/admin-dashboard');
			}
			else if($user_type == "agent"){
				return redirect('/agent-dashboard');
			}
			else{
				// dd(Session::get('user_id'));
				return redirect('/customer-dashboard');
				// return redirect('/');
			} 

		}
		else{
			return redirect('/admin-login?msg=Invalid Username or Password!');
		}
}


	
}
