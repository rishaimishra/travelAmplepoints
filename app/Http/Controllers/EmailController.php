<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;

use Illuminate\Support\Facades\Mail;
use App\Models\Crud_Model;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EmailController extends Controller
{
    public function index() 
    {
	    $view = \View::make('voucher/flight-voucher');
        $html = $view->render();
        $pdf = new TCPDF();
        $pdf::SetTitle('Hello World');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output('hello_world.pdf');
    }
	
	public $website_name='';
	  public function __construct(){
		// dd($_SERVER['SERVER_NAME']);

		    $data= crud_model::readOne('user',array('website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),'user_type'=>'admin'));
			$this->website_name = $data->website_name;
		   	$common_data= $data->common_data;
			$common_dataArr= json_decode($common_data,true);
			$this->currency=$data->currency;
			$this->currency_symbol=$data->currency_symbol;
		}
	
	/*Send Otp Start*/
	public function SendOtp(Request $request){ 
		$email=$request['email'];
		$user_check = crud_model::readOne('user',array('email'=>$email)); 
		if(is_object($user_check)){
			$otp=rand(10000,99999); 
			 $data = array(
				'name' => "Amit",
				'otp' => $otp,
				'website_name' => $this->website_name,
				'email' => $email,
				'user_id' => $user_check->id,
			); 
			Mail::send('email/otp',$data, function($message) use ($data)
			{
				$message->to($data['email'], "User")
					->subject('Forgot Password OTP ');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
			});
			//echo "Successfully sent the email";
			$data=array('error'=>'No','otp'=>$otp,'website'=>$user_check->website);
		}else{ $data=array('error'=>'Yes','msg'=>'','website'=>''); }
		echo json_encode($data);
		
	}
	/*Send Otp End*/
	
	/*FlightTicketEmail  Start*/
	public function FlightTicketEmail(Request $request){ 
		
		$order_id=$request['order_id'];
	    $bookingsData = crud_model::readOne('bookings',array('order_id'=>$order_id));
	    if(session()->get('user_type')=='agent' ){
	   		$siteData = crud_model::readOne('user',array('id'=>$bookingsData->user_id));
		}else{
			$siteData = crud_model::readOne('user',array('website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),'user_type'=>'admin'));
		} 
		
		
		//create Attachments
		$filename = 'voucher/flight-ticket-'.$order_id.'.pdf';
    	$data = [
			'bookingsData' => $bookingsData,
			'siteData' => $siteData,
    	];
    	$view = \View::make('voucher/flight-voucher', $data);
        $html = $view->render();
    	$pdf = new TCPDF;
        $pdf::SetTitle('flight-ticket-'.$order_id);
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
		$pdf::Output(public_path($filename), 'F');
		//create Attachments
		
		$email=$bookingsData->email;
		$booking_status=$bookingsData->booking_status;
			 $data = array(
				'bookingsData' => $bookingsData,
				'siteData' => $siteData,
				'email' => $email,
				'order_id' => $order_id,
				'booking_status' => $booking_status,
				'website_name' => $this->website_name,
				'show_price' => 'No', 
			); 
			Mail::send('voucher/flight-voucher',$data, function($message) use ($data)
			{
				$message->to($data['email'], "User")
					->subject('Your Flight Booking is '.$data["booking_status"].' ('.$data["order_id"].')');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
				$file_to_attach = 'voucher/flight-ticket-'.$data["order_id"].'.pdf';
				$message->attach( $file_to_attach  );
			});
			//echo "Successfully sent the email";
			$data=array('error'=>'No','msg'=>'Mail Send');
		 
			echo json_encode($data);
			
			die;
	}
	/*FlightTicketEmail  End*/
	
	/*Hotel Voucher  Start*/
	public function HotelVouchertEmail(Request $request){ 
		
		$order_id=$request['order_id'];
		
	    $bookingsData = crud_model::readOne('twc_booking',array('order_id'=>$order_id));
		if(session()->get('user_type')=='agent' ){
	   		$siteData = crud_model::readOne('user',array('id'=>$bookingsData->user_id));
		}else{
			$siteData = crud_model::readOne('user',array('website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),'user_type'=>'admin'));
		} 
		
		
		//create Attachments
		$filename = 'voucher/hotel-voucher-'.$order_id.'.pdf';
    	$data = [
			'bookingsData' => $bookingsData,
			'siteData' => $siteData,
			'show_price' => $request['show_price'],
    	];
    	$view = \View::make('voucher/hotel-voucher', $data);
        $html = $view->render();
    	$pdf = new TCPDF;
        $pdf::SetTitle('hotel-voucher-'.$order_id);
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output(public_path($filename), 'F');
		//create Attachments
		
		$email=$bookingsData->user_email;
		$booking_status=$bookingsData->booking_status;
			 $data = array(
				'bookingsData' => $bookingsData,
				'siteData' => $siteData,
				'email' => $email,
				'order_id' => $order_id,
				'booking_status' => $booking_status,
				'website_name' => $this->website_name,
				'show_price' => 'No', 
			); 
			Mail::send('voucher/hotel-voucher',$data, function($message) use ($data)
			{
				$message->to($data['email'], "User")
					->subject('Your Hotel Booking is '.$data["booking_status"].' ('.$data["order_id"].')');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
				$file_to_attach = 'voucher/hotel-voucher-'.$data["order_id"].'.pdf';
				$message->attach( $file_to_attach  );
			});
			//echo "Successfully sent the email";
			$data=array('error'=>'No','msg'=>'Mail Send');
		 
			echo json_encode($data);
		 	//die;
	}
	/*Hotel Voucher   End*/
	
	/*Tours Voucher  Start*/
	public function ToursVouchertEmail(Request $request){ 
		
		$order_id=$request['order_id'];
		
	    $bookingsData = crud_model::readOne('twc_booking',array('order_id'=>$order_id));
		if(session()->get('user_type')=='agent' ){
	   		$siteData = crud_model::readOne('user',array('id'=>$bookingsData->user_id));
		}else{
			$siteData = crud_model::readOne('user',array('website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),'user_type'=>'admin'));
		} 
		
		
		//create Attachments
		$filename = 'voucher/tours-voucher-'.$order_id.'.pdf';
    	$data = [
			'bookingsData' => $bookingsData,
			'siteData' => $siteData,
			'show_price' => $request['show_price'],
    	];
    	$view = \View::make('voucher/tours-voucher', $data);
        $html = $view->render();
    	$pdf = new TCPDF;
        $pdf::SetTitle('tours-voucher-'.$order_id);
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output(public_path($filename), 'F');
		//create Attachments
		
		$email=$bookingsData->user_email;
		$booking_status=$bookingsData->booking_status;
			 $data = array(
				'bookingsData' => $bookingsData,
				'siteData' => $siteData,
				'email' => $email,
				'order_id' => $order_id,
				'booking_status' => $booking_status,
				'website_name' => $this->website_name,
				'show_price' => 'No', 
			); 
			Mail::send('voucher/tours-voucher',$data, function($message) use ($data)
			{
				$message->to($data['email'], "User")
					->subject('Your Tours Booking is '.$data["booking_status"].' ('.$data["order_id"].')');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
				$file_to_attach = 'voucher/tours-voucher-'.$data["order_id"].'.pdf';
				$message->attach( $file_to_attach  );
			});
			//echo "Successfully sent the email";
			$data=array('error'=>'No','msg'=>'Mail Send');
		 
			echo json_encode($data);
		 	//die;
	}
	/*Tours Voucher   End*/
	
	/*transfers Voucher  Start*/
	public function TransfersVouchertEmail(Request $request){ 
		
		$order_id=$request['order_id'];
		
	    $bookingsData = crud_model::readOne('twc_booking',array('order_id'=>$order_id));
		if(session()->get('user_type')=='agent' ){
	   		$siteData = crud_model::readOne('user',array('id'=>$bookingsData->user_id));
		}else{
			$siteData = crud_model::readOne('user',array('website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),'user_type'=>'admin'));
		} 
		
		
		//create Attachments
		$filename = 'voucher/transfers-voucher-'.$order_id.'.pdf';
    	$data = [
			'bookingsData' => $bookingsData,
			'siteData' => $siteData,
			'show_price' => $request['show_price'],
    	];
    	$view = \View::make('voucher/transfers-voucher', $data);
        $html = $view->render();
    	$pdf = new TCPDF;
        $pdf::SetTitle('transfers-voucher-'.$order_id);
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output(public_path($filename), 'F');
		//create Attachments
		
		$email=$bookingsData->user_email;
		$booking_status=$bookingsData->booking_status;
			 $data = array(
				'bookingsData' => $bookingsData,
				'siteData' => $siteData,
				'email' => $email,
				'order_id' => $order_id,
				'booking_status' => $booking_status,
				'website_name' => $this->website_name,
				'show_price' => 'No', 
			); 
			Mail::send('voucher/transfers-voucher',$data, function($message) use ($data)
			{
				$message->to($data['email'], "User")
					->subject('Your Transfers Booking is '.$data["booking_status"].' ('.$data["order_id"].')');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
				$file_to_attach = 'voucher/transfers-voucher-'.$data["order_id"].'.pdf';
				$message->attach( $file_to_attach  );
			});
			//echo "Successfully sent the email";
			$data=array('error'=>'No','msg'=>'Mail Send');
		 
			echo json_encode($data);
		 	//die;
	}
	/*transfers Voucher   End*/
	
	/*AccountActivationMail  Start*/
	public function AccountActivationMail($id){ 
		
	    $siteData = crud_model::readOne('user',array('id'=>$id));
		
			 $data = array(
				'siteData' => $siteData,
				'email' => $siteData->email,
				'user_id' => $siteData->id,
				'website_name' => $this->website_name,
				'show_price' => 'No', 
			); 
			Mail::send('email/AccountActivationMail',$data, function($message) use ($data)
			{
				$message->to($data['email'], "User")
					->subject('Account Activation Mail '.$data["email"].' (AZ-'.$data["user_id"].')');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
			});
			//echo "Successfully sent the email";
			$data=array('error'=>'No','msg'=>'Mail Send');
		 
		echo json_encode($data);
	}
	/*AccountActivationMail  End*/
	
	/*AccountActivatedMail  Start*/
	public function AccountActivatedMail($id){ 
		
	    $siteData = crud_model::readOne('user',array('id'=>$id));
		
			 $data = array(
				'siteData' => $siteData,
				'email' => $siteData->email,
				'password' => $siteData->password,
				'user_id' => $siteData->id,
				'website_name' => $this->website_name,
				'show_price' => 'No', 
			); 
			Mail::send('email/AccountActivatedMail',$data, function($message) use ($data)
			{
				$message->to($data['email'], "User")
					->subject('Congratulations Your Account is Activated '.$data["email"].' (AZ-'.$data["user_id"].')');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
			});
			//echo "Successfully sent the email";
			$data=array('error'=>'No','msg'=>'Mail Send');
		 
		echo json_encode($data);
	}
	/*AccountActivatedMail  End*/
	
	/*WalletFundRequestMail  Start*/
	public function WalletFundRequestMail($id){ 
		
	    $walletData = crud_model::readOne('wallet_fund_request',array('id'=>$id));
		$userData = crud_model::readOne('user',array('id'=>$walletData->agent_id));
		
			 $data = array(
			 	'tid' => $id,
				'walletData' => $walletData,
				'email'=> $userData->email,
				'price' => $walletData->price,
				'bank_name' => $walletData->bank_name,
				'banktranscationid' => $walletData->banktranscationid,
				'attachemnt' => $walletData->attachemnt, 
				'agent_id' => $walletData->agent_id, 
				'website_name' => $this->website_name,
			); 
			Mail::send('email/WalletFundRequestMail',$data, function($message) use ($data)
			{
				$message->to($data['email'], "User")
					->subject('Wallet Fund Request  (AZ-'.$data["agent_id"].')');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
				$message->attach( $data['attachemnt']  );
			});
			//echo "Successfully sent the email";
			$data=array('error'=>'No','msg'=>'Mail Send');
		 
		echo json_encode($data);
		
	}
	/*WalletFundRequestMail  End*/
	

	
    /*WalletFundMail  Start*/
	public function WalletFundMail($id){ 
		
	    $walletData = crud_model::readOne('wallet_fund_request',array('id'=>$id));
		$userData = crud_model::readOne('user',array('id'=>$walletData->agent_id));
		
			 $data = array(
			 	'tid' => $id,
				'walletData' => $walletData,
				'email'=> $userData->email,
				'price' => $walletData->price,
				'bank_name' => $walletData->bank_name,
				'banktranscationid' => $walletData->banktranscationid,
				'attachemnt' => $walletData->attachemnt, 
				'agent_id' => $walletData->agent_id, 
				'website_name' => $this->website_name,
			); 
			Mail::send('email/WalletFundMail',$data, function($message) use ($data)
			{
				$message->to($data['email'], "User")
					->subject('Wallet Fund Successful  ('.$data["price"].')');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
				if(isset($data['attachemnt'])){ $message->attach( $data['attachemnt']  ); }
			});
			//echo "Successfully sent the email";
			$data=array('error'=>'No','msg'=>'Mail Send');
		 
		echo json_encode($data);
		
	}
	/*WalletFundMail  End*/
	
    /*WalletRejectdMail  Start*/
	public function WalletRejectdMail($id){ 
		
	    $walletData = crud_model::readOne('wallet_fund_request',array('id'=>$id));
		$userData = crud_model::readOne('user',array('id'=>$walletData->agent_id));
		
			 $data = array(
			 	'tid' => $id,
				'walletData' => $walletData,
				'email'=> $userData->email,
				'price' => $walletData->price,
				'bank_name' => $walletData->bank_name,
				'banktranscationid' => $walletData->banktranscationid,
				'attachemnt' => $walletData->attachemnt, 
				'agent_id' => $walletData->agent_id, 
				'status' => $walletData->status,
				'status_msg' => $walletData->status_msg,
				'website_name' => $this->website_name,
			); 
			Mail::send('email/WalletRejectdMail',$data, function($message) use ($data)
			{
				$message->to($data['email'], "User")
					->subject('Wallet Fund Reject  ('.$data["price"].')');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
			});
			//echo "Successfully sent the email";
			//$data=array('error'=>'No','msg'=>'Mail Send');
		 
		echo json_encode($data);
		
	}
	/*WalletRejectdMail  End*/
	

	/*EnquiryMail  Start*/
	public function EnquiryMail($id){ 
		
	    $enquiryData = crud_model::readOne('enquiry',array('id'=>$id));
		
			 $data = array(
			 	'name' => $enquiryData->name,
				'email' =>$enquiryData->email,
				'phone'=> $enquiryData->phone,
				'address' => $enquiryData->address,
				'how_know_me' => $enquiryData->how_know_me,
				'type' => $enquiryData->type,
				'tid' => $enquiryData->tid,
				'msg' => $enquiryData->message,
				'website_name' => $this->website_name,
			); 
			
			Mail::send('email/EnquiryMail',$data, function($message) use ($data)
			{
				$message->to($data['email'], "User")
					->subject('Enquiry Mail  ('.$data["email"].')');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
			});
			
			
			//echo "Successfully sent the email";
			$data=array('error'=>'No','msg'=>'Mail Send');
		 
		echo json_encode($data);
		
	}


	/*EnquiryMail  End*/
	
	


















	// anish code start -----------------------------


	public function AjaxTestMail($test_data){ 
		
	    // $enquiryData = crud_model::readOne('enquiry',array('id'=>$id));
		
			 $data = array(
			 	'test_data' => $test_data,
			); 
			
			Mail::send('email/TestMail',$data, function($message) use ($data)
			{
				$message->to('anishrajsharma06@gmail.com', "User")
					->subject('Test Mail.. by anish');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message->from('noreplay@airzain.com', 'airzain.com');
			});
			
			
			//echo "Successfully sent the email";
			$data=array('error'=>'No','msg'=>'Mail Send');
		 
		echo json_encode($data);
		
	}



	public function VisaSentMail($visa_id,$agent_id){ 
		
	    // $enquiryData = crud_model::readOne('visa',array('id'=>$id));
		$visaData = crud_model::readByCondition('visa',array('id'=>$visa_id));
		$agentData = crud_model::readByCondition('user',array('id'=>$agent_id));


		if($visaData[0]->visa_nature == 'uae-visa'){
			$visa_nature = "UAE";
		}else{
			$visa_nature = "Global";
		}

		
			 $data = array(
			 	'agent_name' => $agentData[0]->first_name.' '.$agentData[0]->last_name,
				'agent_email' =>$agentData[0]->email,
				'order_id' =>$visaData[0]->order_id,
				'visa_nature' =>$visa_nature,
				'date_time' =>$visaData[0]->user_send_date,
				'total_price' =>$visaData[0]->total_rate,
				'applicant_mobile' =>$visaData[0]->applicant_mobile,
				'applicant_name' =>$visaData[0]->first_name.' '.$visaData[0]->last_name,
				'passport_number' =>$visaData[0]->passport_number,
				'visa_type' =>$visaData[0]->visa_type,
				'source_type' =>$visaData[0]->source_type1.' / '.$visaData[0]->source_type2,
				'website_name' => $this->website_name,
			); 
			
			Mail::send('email/VisaSentMail',$data, function($message) use ($data)
			{
				$message->to($data['agent_email'], "User")
					->subject('Visa Submitted!');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message ->cc('anishrajsharma08@gmail.com', 'Developer');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
			});
			
			
			//echo "Successfully sent the email";
			$data=array('error'=>'No','msg'=>'Mail Send');
		 
		echo json_encode($data);
		
	}








	public function VisaStatusUpdatedMail($visa_id, $agent_id){ 
		
		$visaData = crud_model::readByCondition('visa',array('id'=>$visa_id));
		$agentData = crud_model::readByCondition('user',array('id'=>$agent_id));

		if($visaData[0]->visa_nature == 'uae-visa'){
			$visa_nature = "UAE";
		}else{
			$visa_nature = "Global";
		}
		
			 $data = array(
				'agent_email' =>$agentData[0]->email,
				'order_id' =>$visaData[0]->order_id,
				'visa_nature' =>$visa_nature,
				'date_time' =>$visaData[0]->date_time,
				'current_status' =>$visaData[0]->admin_status,
				'website_name' => $this->website_name,
			); 
			
			Mail::send('email/VisaStatusUpdatedMail',$data, function($message) use ($data)
			{
				$message->to($data['agent_email'], "User")
					->subject('Visa Status Updated!');				
				$message ->cc('techieakm@gmail.com', 'Developer Team');
				$message ->cc('info@propertylisthub.com', 'PlistTeam');			
				$message ->cc('anishrajsharma08@gmail.com', 'Developer');			
				$message->from('noreplay@airzain.com', $data["website_name"]);
			});
			
			
			//echo "Successfully sent the email";
			$data=array('error'=>'No','msg'=>'Mail Send');
		 
		echo json_encode($data);
		
	}




	// anish code end -----------------------------
	
	
	
}