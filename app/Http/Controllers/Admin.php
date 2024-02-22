<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud_Model;
use Session;
use Illuminate\Support\Facades\File; 
use App\Http\Controllers\EmailController;

class Admin extends Controller
{
	     public $success_message='Saved.';
		 public $failed_message='Already Saved.';
	  public function __construct()
	  { 
	  	$this->emailObj= new EmailController();
	  	if(session()->get('user_type')=='' ){ return redirect('/login?msg=Invalid Credentials'); }
	  }
	  
	  public static function Index(){
		 $id=session()->get('user_id'); 
		$currency_list = crud_model::readByCondition('currency_rates',array('published'=>'Yes'));
		$siteData = crud_model::readOne('user',array('id'=>$id)); //crud_model::readOne('website_setting',array('id'=>1));
		return json_encode(array('currency'=>$currency_list,'siteData'=>$siteData));
	  }
     
  	 public function UpdateUserData(Request $request){ 
	  	$logo='akm'; $icon='akm';
		$profile_pic = $request->file('profile_pic');
		$website_logo = $request->file('website_logo');
		$website_icon = $request->file('website_icon');
		$id = $request->input('id');
		
		$postData = $request->input('common');
		$common_data_json = json_encode($postData);
			  
		  $destinationPath = 'uploads';
		  if(isset($profile_pic)){
		 	  File::delete("uploads/profile".$id.".png");
			  $profile_pic_name="profile".$id.".".$profile_pic->getClientOriginalExtension();
			  $profile_pic->move($destinationPath,$profile_pic_name);
			  $profile_pic_path="/uploads/".$profile_pic_name;
		  }else { $profile_pic_path=$request->input('profile_pic_pre'); }
		 
		  if(isset($website_logo)){
		      File::delete("uploads/logo".$id.".png");
			  $weblogo_name="logo".$id.".".$website_logo->getClientOriginalExtension();
			  $website_logo->move($destinationPath,$weblogo_name);
			  $weblogo_path="/uploads/".$weblogo_name;
		  }else { $weblogo_path=$request->input('website_logo_pre'); }
		  
		  if(isset($website_icon)){
		 	  File::delete("uploads/icon".$id.".png");
			  $webicon_name="icon".$id.".".$website_icon->getClientOriginalExtension();
			  $website_icon->move($destinationPath,$webicon_name);
			  $webicon_path="/uploads/".$webicon_name;
		  }else { $webicon_path=$request->input('website_icon_pre'); }
		  
		  $imageArr=array(
		  "logo"=>$weblogo_path,
		  "icon"=>$webicon_path,
		  "profile_pic"=>$profile_pic_path,
		  );
		  $website_name='';
			if(isset($postData['website_name'])) { $website_name=$postData['website_name']; }
		$data = array(
			'first_name' => $request->input('first_name'),
			'last_name' =>$request->input('last_name'),
			'phone' => $request->input('phone'),
			'email' => $request->input('email'),
			'password' => $request->input('password'),
			'address' => $request->input('address'),
			'city' => $request->input('city'),
			'country' => $request->input('country'),
			'user_type' => $request->input('user_type'),
			'status' => $request->input('status'),
			'user_type' => $request->input('user_type'),
			'date_time' => date('Y-m-d H:i:s'),
			
			'profile_pic' => $profile_pic_path,
			'extra_info' =>  json_encode($request->input('extra_info')),
			'is_member' => $request->input('is_member'),
			'role' => $request->input('role'),
			
			'website_name' => $website_name,
			'images' => json_encode($imageArr),
			'common_data' => $common_data_json,
		);
		
		$status = Crud_Model::updateData('user',$data,array('id'=>$id));
		if($id==1){
			if($status==1){
			    return redirect('/user-details?msg='.$this->success_message); die; 
			}else{
				return redirect('/user-details?msg='.$this->failed_message); die; 
			}
		}else{
			if($status==1){
			    return redirect('/user-details/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/user-details/'.$id.'?msg='.$this->failed_message); die; 
			}
		}	
  }
  
  	 public function UpdateCurrencyData(Request $request){ 	  
		$id = $request->input('id');
		$data = array(
			'currency' => $request->input('currency'),
			'currency_name' =>$request->input('currency_name'),
			'currency_symbol' => $request->input('currency_symbol'),
			'rate' => $request->input('rate'),
			'published' => $request->input('published'),
		);
		
		$status = Crud_Model::updateData('currency_rates',$data,array('id'=>$id));		
		    if($status==1){
			    return redirect('/currency-details/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/currency-details/'.$id.'?msg='.$this->failed_message); die; 
			}
			
  }
  
     public function UpdateHotelData(Request $request){
	 $order_id = $request->input('order_id');
		$data = array(
			'itineraryId' => $request->input('itineraryId'),
			'booking_mode' =>$request->input('booking_mode'),
			'booking_status' => $request->input('booking_status'),
			'hotelName' => $request->input('hotelName'),
			'hotelRating' => $request->input('hotelRating'),
			
			'hotelAddress' => $request->input('hotelAddress'),
			'hotelCity' =>$request->input('hotelCity'),
			'hotelCountryCode' => $request->input('hotelCountryCode'),
			'user_name' => $request->input('user_name'),
			'user_email' => $request->input('user_email'),
			'user_contactno' => $request->input('user_contactno'),
			
			'check_in' => $request->input('check_in'),
			'check_out' =>$request->input('check_out'),
			'chargable_rate' => $request->input('chargable_rate'),
			'PaymentType' => $request->input('PaymentType'),
			'payment_status' => $request->input('payment_status'),
			
			'rooms' => $request->input('rooms'),
			'adults' => $request->input('adults'),
			'children' => $request->input('children'),			
		);
		
		$status = Crud_Model::updateData('twc_booking',$data,array('order_id'=>$order_id));
		
		 if($status==1){
			    return redirect('/hotel-details-admin/'.$order_id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/hotel-details-admin/'.$order_id.'?msg='.$this->failed_message); die; 
			}
		
		
		}
  
     public function UpdateFlightData(Request $request){
	 $id = $request->input('id');
		$data = array(
			'pnr_number' => $request->input('pnr_number'),
			'booking_mode' =>$request->input('booking_mode'),
			'booking_status' => $request->input('booking_status'),
			'email' => $request->input('email'),
			'contact_number' => $request->input('contact_number'),
			
			'address' => $request->input('address'),
			'city' =>$request->input('city'),
			'country' => $request->input('country'),
			'postal_code' => $request->input('postal_code'),
			'adult' => $request->input('adult'),
			'children' => $request->input('children'),
			
			'infant' => $request->input('infant'),
			'airlines' =>$request->input('airlines'),
			'price' => $request->input('price'),
			'currency' => $request->input('currency'),
			'origon_airport' => $request->input('origon_airport'),
			
			'destination_airport' => $request->input('destination_airport'),
			'oneway_departure_date' => $request->input('oneway_departure_date'),
			'oneway_departure_time' => $request->input('oneway_departure_time'),	
			
			'oneway_arrival_date' => $request->input('oneway_arrival_date'),
			'oneway_arrival_time' => $request->input('oneway_arrival_time'),
			'booking_status' => $request->input('booking_status'),		
		);
		
		$status = Crud_Model::updateData('manage_flight_commission',$data,array('id'=>$id));
		
		 if($status==1){
			    return redirect('/flight-details/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/flight-details/'.$id.'?msg='.$this->failed_message); die; 
			}
		
		}
  
  public function FlightCityPost(Request $request){ 	  
		$id = $request->input('id');
		$image = $request->file('image');	
		$AirportCode=$request->input('AirportCode');
		$destinationPath = 'uploads';
		if(isset($image)){
		 	  File::delete("uploads/".$AirportCode."_city_".$id.".png");
			   $image_name=$AirportCode."_city_".$id.".".$image->getClientOriginalExtension();
			  $image->move($destinationPath,$image_name);
			  $image_path="/uploads/".$image_name;
		  }else { $image_path=$request->input('image_pre'); }
		  
		 
		
		$data = array(
		    'AirportCode' => $request->input('AirportCode'),
			'AirportName' => $request->input('AirportName'),
			'CityCode' => $request->input('CityCode'),
			'CityName' =>$request->input('CityName'),
			'CountryName' => $request->input('CountryName'),
			'CountryCode' =>$request->input('CountryCode'),
			'CurrencyCode' => $request->input('CurrencyCode'),
			'image' =>$image_path,
			'content' =>$request->input('content'),
			'priority' => $request->input('priority'),
		);
		
		
		if($id!=''){ 
			$status = Crud_Model::updateData('flight_airportlist',$data,array('id'=>$id));
			if($status==1){
			    return redirect('/update-flight-city/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('update-flight-city/'.$id.'?msg='.$this->failed_message); die; 
			}
		 }
		else { 
			$status = Crud_Model::insertData('flight_airportlist',$data);
			if($status==1){
			    return redirect('/add-flight-city?msg='.$this->success_message); die; 
			}else{
				return redirect('/add-flight-city?msg='.$this->failed_message); die; 
			}
		 }		
			
  }
  
   public function HotelCityPost(Request $request){ 	  
		$id = $request->input('id');
		$image = $request->file('image');	
		$city_code=$request->input('city_code');
		$destinationPath = 'uploads';
		if(isset($image)){
		 	  File::delete("uploads/".$city_code."_city_H_".$id.".png");
			   $image_name=$city_code."_city_H_".$id.".".$image->getClientOriginalExtension();
			  $image->move($destinationPath,$image_name);
			  $image_path="/uploads/".$image_name;
		  }else { $image_path=$request->input('image_pre'); }
		  
		 
		
		$data = array(
		    'city_code' => $request->input('city_code'),
			'city_name' => $request->input('city_name'),
			'countryCode' => $request->input('countryCode'),
			'latitude' =>$request->input('latitude'),
			'longitude' => $request->input('longitude'),
			'image' =>$image_path,
			'content' =>$request->input('content'),
			'priority' => $request->input('priority'),
		);
		
		
		if($id!=''){ 
			$status = Crud_Model::updateData('hotelbeds_destinations',$data,array('id'=>$id));
			if($status==1){
			    return redirect('/update-hotel-city/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('update-hotel-city/'.$id.'?msg='.$this->failed_message); die; 
			}
		 }
		else { 
			$status = Crud_Model::insertData('hotelbeds_destinations',$data);
			if($status==1){
			    return redirect('/add-hotel-city?msg='.$this->success_message); die; 
			}else{
				return redirect('/add-hotel-city?msg='.$this->failed_message); die; 
			}
		 }		
			
  }
  
  
  public function ReviewPost(Request $request){ 	  
		$id = $request->input('id');
		
		$profile_pic = $request->file('profile_pic');			  
		  $destinationPath = 'uploads';
		  
		  if(isset($profile_pic)){
		 	  File::delete("uploads/profile".$id.".png");
			  $profile_pic_name="review".$id.".".$profile_pic->getClientOriginalExtension();
			  $profile_pic->move($destinationPath,$profile_pic_name);
			  $profile_pic_path="/uploads/".$profile_pic_name;
		  }else { $profile_pic_path=$request->input('profile_pic_pre'); }
		
		$data = array(
		    'customer_name' => $request->input('customer_name'),
			'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
			'profile_pic' => $profile_pic_path,
			'customer_address' =>$request->input('customer_address'),
			'rating' => $request->input('rating'),
			'review' => $request->input('review'),
			'published' => $request->input('published'),
			'date_time' => date('Y-m-d H:i:s'),
		);
		
		if($id!=''){ 
			$status = Crud_Model::updateData('customer_review',$data,array('id'=>$id));
			if($status==1){
			    return redirect('/customer-review/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/customer-reviewt/'.$id.'?msg='.$this->failed_message); die; 
			}
		 }
		else { 
			$status =Crud_Model::insertData('customer_review',$data); 
			
			if($status==1){
			    return redirect('/customer-review?msg='.$this->success_message); die; 
			}else{
				return redirect('/customer-review?msg='.$this->failed_message); die; 
			}
		 }
			
  }	
  
   public function BlogCategoryPost(Request $request){ 	  
		$id = $request->input('id');		
		$data = array(
		    'parent_id' => $request->input('parent_id'),
			'category' =>$request->input('category'),
			'status' => $request->input('status'),
			'date_time' => date('Y-m-d H:i:s'),
		);

		if($id!=''){ 
			$status = Crud_Model::updateData('blog_category',$data,array('id'=>$id));
			if($status==1){
			    return redirect('/blog-category/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/blog-category/'.$id.'?msg='.$this->failed_message); die; 
			}
		 }
		else { 
			$status = Crud_Model::insertData('blog_category',$data); 
			
			if($status==1){
			    return redirect('/customer-review?msg='.$this->success_message); die; 
			}else{
				return redirect('/customer-review?msg='.$this->failed_message); die; 
			}
		 }
		
			
  }	
  
     public function BlogPost(Request $request){ 	  
		$id = $request->input('id'); 			
		  $thumb_nail = $request->file('thumb_nail');			  
		  $destinationPath = 'uploads';
		  
		  if(isset($thumb_nail)){
		 	  File::delete("uploads/profile".$id.".png");
			  $thumb_nail_name="thumb_nail".$id.".".$thumb_nail->getClientOriginalExtension();
			  $thumb_nail->move($destinationPath,$thumb_nail_name);
			  $thumb_nail_path="/uploads/".$thumb_nail_name;
		  }else { $thumb_nail_path=$request->input('thumb_nail_pre'); }
			
		$data = array(
		    'heading' => $request->input('heading'),
			'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
			'sub_heading' =>$request->input('sub_heading'),
			'thumb_nail' => $thumb_nail_path,
			'content' => $request->input('content'),
			'user_id' =>session()->get('user_id'),
			'category' => json_encode($request->input('category')),
			'quotes' =>$request->input('quotes'),
			'published' => $request->input('published'),
			'date_time' => date('Y-m-d H:i:s'),
		);

		if($id!=''){ 
			$status = Crud_Model::updateData('blogs',$data,array('id'=>$id));
			if($status==1){
			    return redirect('/add-blog/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/add-blog/'.$id.'?msg='.$this->failed_message); die; 
			}
		 }
		else { 
			$status = Crud_Model::insertData('blogs',$data); 
			
			if($status==1){
			    return redirect('/add-blog?msg='.$this->success_message); die; 
			}else{
				return redirect('/add-blog?msg='.$this->failed_message); die; 
			}
		 }
		
		
				
  }	
  
  
  	public function JobPost(Request $request){ 	  
		$id = $request->input('id'); 						
		$data = array(
		    'name' => $request->input('name'),
			'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
		    'location' => $request->input('location'),
			'About_Job' =>$request->input('About_Job'),
			'Job_Responsibilities' => $request->input('Job_Responsibilities'),
			'Requirements' =>$request->input('Requirements'),
			'What_do_we_offer' => $request->input('What_do_we_offer'),
			'Vacancy' =>$request->input('Vacancy'),
			'Employment_Status' => $request->input('Employment_Status'),
			'Experience' =>$request->input('Experience'),
			'Gender' => $request->input('Gender'),
			'Age' =>$request->input('Age'),
			'Salary' => $request->input('Salary'),
			'Application_Deadline' =>$request->input('Application_Deadline'),
			'status' => $request->input('status'),
			'date_time' => date('Y-m-d H:i:s'),
		);

		if($id!=''){ 
			$status = Crud_Model::updateData('jobs',$data,array('id'=>$id));
			if($status==1){
			    return redirect('/add-job/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/add-jobg/'.$id.'?msg='.$this->failed_message); die; 
			}
		 }
		else { 
			$status = Crud_Model::insertData('jobs',$data); 
			
			if($status==1){
			    return redirect('/add-job?msg='.$this->success_message); die; 
			}else{
				return redirect('/add-job?msg='.$this->failed_message); die; 
			}
		 }
  }	
  
   public function PagePost(Request $request){ 	  
		$id = $request->input('id'); 			
		  $b_image = $request->file('b_image');		
		  $main_image_1 = $request->file('main_image_1');	
		  $main_image_2 = $request->file('main_image_2');		  
		  $destinationPath = 'uploads';
		  
		  if(isset($b_image)){
		 	  File::delete("uploads/page".$id.".png");
			  $image_name="b_image".$id.".".$b_image->getClientOriginalExtension();
			  $b_image->move($destinationPath,$image_name);
			  $image_path="/uploads/".$image_name;
		  }else { $image_path=$request->input('image_pre'); }
		  
		 $other_content= $request->input('other_content');
		 if($other_content==''){ $other_content= $request->input('oc'); }
		 if(isset($main_image_1)){
		 	  File::delete("uploads/other_content_main_image_1_".$request->input('page_id').".png");
			   $image_name="other_content_main_image_1_".$request->input('page_id').".".$main_image_1->getClientOriginalExtension();
			  $main_image_1->move($destinationPath,$image_name);
			  $other_content['main_image_1']="/uploads/".$image_name;
		  }else {  $other_content['main_image_1']=$request->input('image_pre'); }
		 
		 if(isset($main_image_2)){
		 	  File::delete("uploads/other_content_main_image_2_".$request->input('page_id').".png");
			   $image_name="other_content_main_image_2_".$request->input('page_id').".".$main_image_2->getClientOriginalExtension();
			  $main_image_2->move($destinationPath,$image_name);
			  $other_content['main_image_2']="/uploads/".$image_name;
		  }else {  $other_content['main_image_2']=$request->input('image_pre'); }
		 if(isset($other_content['alt_text'])){
			 for($i=0;$i<count($other_content['alt_text']);$i++){
				  if($request->file('image_'.$i)!=''){
					  File::delete("uploads/other_content_".$request->input('page_id')."_".$i.".png");
					  $image_name="other_content_".$request->input('page_id')."_".$i.".".$request->file('image_'.$i)->getClientOriginalExtension();
					  $request->file('image_'.$i)->move($destinationPath,$image_name);
					  $other_content['images'][]="/uploads/".$image_name;
				  }else { $other_content['images'][]=$request->input('image_pre_'.$i); }
			 }
		 }
			if(isset($other_content['IATA_from'])){ $city_from_code=$other_content['IATA_from']; }else if(isset($other_content['city_code'])){ $city_from_code=$other_content['city_code']; }else{ $city_from_code=''; }
			if(isset($other_content['IATA_to'])){ $city_to_code=$other_content['IATA_to']; }else{ $city_to_code=''; }
			if(isset($other_content['city_from'])){ $city_from=$other_content['city_from']; }else if(isset($other_content['city_name'])){ $city_from=$other_content['city_name']; }else{ $city_from=''; }
			if(isset($other_content['city_to'])){ $city_to=$other_content['city_to']; }else{ $city_to=''; }
			if(isset($other_content['country_from'])){ $county_from_code=$other_content['country_from']; }else if(isset($other_content['countryCode'])){ $county_from_code=$other_content['countryCode']; }else{ $county_from_code=''; }
			if(isset($other_content['country_to'])){ $county_to_code=$other_content['country_to']; }else{ $county_to_code=''; }
			if(isset($other_content['cityFromUrl'])){ $cityFromUrl=$other_content['cityFromUrl']; }else{ $cityFromUrl=''; }
			if(isset($other_content['cityToUrl'])){ $cityToUrl=$other_content['cityToUrl']; }else{ $cityToUrl=''; }
			if(isset($other_content['countryFromUrl'])){ $countryFromUrl=$other_content['countryFromUrl']; }else{ $countryFromUrl=''; }
			if(isset($other_content['countryToUrl'])){ $countryToUrl=$other_content['countryToUrl']; }else{ $countryToUrl=''; }
			
		$data = array(
		    'page_id' => $request->input('page_id'),
			'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
			'name' =>$request->input('name'),
			'image' => $image_path,
			'title' => $request->input('title'),
			'meta_keywords' =>$request->input('meta_keywords'),
			'meta_description' =>$request->input('meta_description'),
			'content' => $request->input('content'),
			'other_content' => json_encode($other_content),
			'status' => $request->input('status'),
			'type' => $request->input('type'),
			'type_name' => $request->input('type_name'),
			'city_from_code' => $city_from_code,
			'city_to_code' => $city_to_code,
			'city_from' => $city_from,
			'city_to' => $city_to,
			'cityFromUrl' => $cityFromUrl,
			'cityToUrl' => $cityToUrl,
			'countryFromUrl' => $countryFromUrl,
			'countryToUrl' => $countryToUrl,
			'county_from_code' => $county_from_code,
			'county_to_code' => $county_to_code,
			'date_time' => date('Y-m-d H:i:s'),
		);
		
		Session::flash('message', 'Email was sent');
		$redirect_url=$request->input('redirect_url');
		if($id!=''){ 
			$status = Crud_Model::updateData('pages',$data,array('id'=>$id));
			if($status==1){
			    return redirect('/'.$redirect_url.'/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/'.$redirect_url.'/'.$id.'?msg='.$this->failed_message); die; 
			}
		}
		else { 
			$status = Crud_Model::insertData('pages',$data); 
			if($status==1){
			    return redirect('/'.$redirect_url.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/'.$redirect_url.'?msg='.$this->failed_message); die; 
			}
		}				
  }	
  
  
     public function ServicePost(Request $request){ 	  
		$id = $request->input('id'); 			
		  $image = $request->file('image');	
		  $icon_image = $request->file('icon_image');			  
		  $destinationPath = 'uploads';
		  
		  if(isset($image)){
		 	  File::delete("uploads/page".$id.".png");
			  $image_name="service_icon_image".$id.".".$image->getClientOriginalExtension();
			  $image->move($destinationPath,$image_name);
			  $image_path="/uploads/".$image_name;
		  }else { $image_path=$request->input('image_pre'); }
		  
		   if(isset($icon_image)){
		 	  File::delete("uploads/page".$id.".png");
			  $image_name="service_image".$id.".".$icon_image->getClientOriginalExtension();
			  $icon_image->move($destinationPath,$image_name);
			  $icon_image_path="/uploads/".$image_name;
		  }else { $icon_image_path=$request->input('icon_image_pre'); }
			
		$data = array(
		    'service_name' => $request->input('service_name'),
			'icon_image_alt_text' =>$request->input('icon_image_alt_text'),
			'image' => $image_path,
			'icon_image' => $icon_image_path,
			'image_alt_text' => $request->input('image_alt_text'),
			'short_description' =>$request->input('short_description'),
			'type' =>$request->input('type'),
			'status' => $request->input('status'),
			'date_time' => date('Y-m-d H:i:s'),
			'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
		);
		if($id!=''){ 
			$status = Crud_Model::updateData('services',$data,array('id'=>$id));
			if($status==1){
			    return redirect('/add-service/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/add-service/'.$id.'?msg='.$this->failed_message); die; 
			}
		}
		else { 
			$status = Crud_Model::insertData('services',$data); 
			if($status==1){
			    return redirect('/add-service?msg='.$this->success_message); die; 
			}else{
				return redirect('/add-service?msg='.$this->failed_message); die; 
			}
		}				
  }	
  
  
  public function FAQPost(Request $request){ 	  
		$id = $request->input('id'); 
		$by = $request->input('by'); 
		$asked_by=$request->input('name').'_'.$request->input('email');
		$data = array(
		    'question' => $request->input('question'),
		    'category' => $request->input('category'),
			'answer' =>$request->input('answer'),
			'asked_by' => $asked_by,
			'status' => $request->input('status'),
			'date_time' => date('Y-m-d H:i:s'),
			'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
		);
		if($id!=''){ 
			$status = Crud_Model::updateData('faqs',$data,array('id'=>$id));			
			if($status==1){
			    return redirect('/add-faq/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/add-faq/'.$id.'?msg='.$this->failed_message); die; 
			}
			
		}else if($by=='site'){
			$status = Crud_Model::insertData('faqs',$data); 
			if($status==1){
			    return redirect('/support?msg='.$this->success_message); die; 
			}else{
				return redirect('/support?msg='.$this->failed_message); die; 
			}
		}
		else { 
			$status = Crud_Model::insertData('faqs',$data); 
			if($status==1){
			    return redirect('/add-faq?msg='.$this->success_message); die; 
			}else{
				return redirect('/add-faq?msg='.$this->failed_message); die; 
			}
		}				
  	}	
	
	  public function WalletFundByPGPost(Request $request){ 
	  	 $id = $request->input('id');
		 $order_id=uniqid();
		  $data = array(
			  'price' => $request->input('amount'),
			  'currency' =>'USD',
			  'bank_name' =>$request->input('bank_name'),
			  'type' =>'Payment Gateway',
			  'customer_remarks' => $request->input('remarks'),
			  'agent_id'=>session()->get('user_id'),
			  'order_id'=>$order_id,
			  'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
		  );
		  
		  $agent_id=session()->get('user_id');
	  	  $insertID =Crud_Model::insertData('wallet_fund_request',$data); 
		  	  
	  	  //$this->emailObj->WalletFundRequestMail($insertID);
		  $bankData = crud_model::readOne('bank_details',array('id'=>$request->input('bank_name')));
	  
		 $payment_page=url('/')."/travel/payment/".$bankData->ac_number."/?order_id=".$order_id."&agent_id=".$agent_id."&module=wallet";	
		 return redirect($payment_page);	
	  }
	  
	  public function WalletFundRequestPost(Request $request){ 
	 	 $proof_of_payment = $request->file('proof_of_payment');
	  	 $id = $request->input('id');
				
		$destinationPath = 'uploads';
		  if(isset($proof_of_payment)){
		 	 // File::delete("uploads/profile".$id.".png");
			  $proof_of_payment_name="wallet_request".rand().".".$proof_of_payment->getClientOriginalExtension();
			  $proof_of_payment->move($destinationPath,$proof_of_payment_name);
			  $proof_of_payment_path="uploads/".$proof_of_payment_name;
		  }else { $proof_of_payment_path=$request->input('proof_of_payment_pre'); }
		  
		  $userData = crud_model::readOne('user',array('id'=>session()->get('user_id')));
		
	  $data = array(
	  	  'currency' => $userData->currency,
		  'price' => $request->input('amount'),
		  'bank_name' =>$request->input('bank_name'),
		  'banktranscationid' => $request->input('payment_reference'),
		  'attachemnt' => $proof_of_payment_path,
		  'customer_remarks' => $request->input('remarks'),
		  'type' =>'Request',
		  'website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),
		  'agent_id'=>session()->get('user_id'),
	  );
	  
	    $insertID =Crud_Model::insertData('wallet_fund_request',$data); 
		
	  
	  	$this->emailObj->WalletFundRequestMail($insertID);
	  
	 	if($insertID>1){
			return redirect('/wallet-fund-request?msg='.$this->success_message); die; 
		}else{
			return redirect('/wallet-fund-request?msg='.$this->failed_message); die; 
		}	
	  }

	/*ManualWalletFundDeductPost Start*/
	  public function ManualWalletFundDeductPost(Request $request){ 
	  	 $agent_id = $request->input('agent_id');
		 $transaction_type = $request->input('transaction_type');
		 $payment_reference = $request->input('payment_reference');
		 $txn_detail = $request->input('txn_detail');
		 
		 $requestAmt=$request->input('amount');
		 $userData = crud_model::readOne('user',array('id'=>$agent_id));
		 $walletAmt=$userData->wallet;
		 echo "<br>request Amt==".$requestAmt;
		 echo "<br>walletAmt==".$walletAmt;
		 if($transaction_type=='CREDITED'){
		 	$finalAmt=floatval($walletAmt)+floatval($requestAmt);
		 }else
		 {
		 	$finalAmt=floatval($walletAmt)-floatval($requestAmt);
		 }
		 
		 echo "<br>finalAmt==".$finalAmt;
		 echo "<pre>"; print_r($userData); 
		 $status = Crud_Model::updateData('user',array('wallet'=>$finalAmt),array('id'=>$agent_id));
						
	  $data = array(
		  'agent_id' => $agent_id,
		  'currency' =>$request->input('currency'),
		  'amount' => $requestAmt,
		  'final_amount' => $finalAmt,
		  'txn_detail' =>$txn_detail,
		  'txn_number'=>$payment_reference,
		  'payment_status' => 'Confirmed',
		  'transaction_type' =>$transaction_type,
		  'published' => 'Yes',
		  'funded_type' => 'Manual',
		  'website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),
		  'date_time'=>date('Y-m-d H:i:s'),
	  );
	  
	  $val =Crud_Model::insertData('wallet_transactions_history',$data); 
	  
	 	if($val>1){
			return redirect('/agents?msg=Wallet '.$transaction_type); die; 
		}else{
			return redirect('/agents?msg=Wallet Not Funded Please try Again!'); die; 
		}	
	}
	/*ManualWalletFundDeductPost End */
	
	
	/*WalletFund Start*/
	public function WalletFund(Request $request){ 
	  	 $id = $request->input('id');
		 $type = $request->input('type');
		 $reqData = crud_model::readOne('wallet_fund_request',array('id'=>$id));
		 if(is_object($reqData) && $reqData->status='complete'){
			 $requestAmt=$reqData->price;
			 $userData = crud_model::readOne('user',array('id'=>$reqData->agent_id));
			 $walletAmt=$userData->wallet;
			 echo "<br>request Amt==".$requestAmt;
			 echo "<br>walletAmt==".$walletAmt;
			 $finalAmt=$walletAmt+$requestAmt;
			 echo "<br>finalAmt==".$finalAmt;
			 echo "<pre>"; print_r($userData); 
			 $status = Crud_Model::updateData('user',array('wallet'=>$finalAmt),array('id'=>$userData->id));
			 $status = Crud_Model::updateData('wallet_fund_request',array('status'=>'complete','fund_date'=>date('Y-m-d H:i:s')),array('id'=>$id));	
		 
	  $data = array(
		  'agent_id' => $reqData->agent_id,
		  'currency' =>$reqData->currency,
		  'amount' => $requestAmt,
		  'final_amount' => $finalAmt,
		  'txn_detail' => 'Wallet Funded',
		  'txn_number'=>$reqData->banktranscationid,
		  'payment_status' => 'Confirmed',
		  'transaction_type' => 'CREDITED', 
		  'funded_type' => $type,
		  'published' => 'Yes',
		  'website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),
		  'date_time'=>date('Y-m-d H:i:s'),
	  );
	  
	  $this->emailObj->WalletFundMail($id);
	  
	  $val =Crud_Model::insertData('wallet_transactions_history',$data); 
	  
	 	if($val>1){
			return redirect('/wallet-transation-history?msg=Wallet Funded'); die; 
		}else{
			return redirect('/wallet-transation-history?msg=Wallet Not Funded Please try Again!'); die; 
		}
		}// payment status check endSSSSS	
		else{
			return redirect('/wallet-transation-history?msg=Wallet Not Funded Please try Again!'); 
		}
	}
	
	 public function AddBankDetailsPost(Request $request){ 	  
		$id = $request->input('id');		
		$data = array(
		    'user_id' => session()->get('user_id'),
			'bank_name' => $request->input('bank_name'),
			'ac_number' =>$request->input('ac_number'),
			'ac_holder' => $request->input('ac_holder'),
			'branch_name' => $request->input('branch_name'),
			'ac_type' => $request->input('ac_type'),
			'NEFT_IFSC' => $request->input('NEFT_IFSC'),
			'more_details' => $request->input('more_details'),
			'status' => $request->input('status'),
			'website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),
			'date_time' => date('Y-m-d H:i:s'),
			'website'=>str_replace('www.','',$_SERVER['SERVER_NAME']),
		);
		
		if($id!=''){ 
			$status = Crud_Model::updateData('bank_details',$data,array('id'=>$id));
			if($status==1){
			    return redirect('/add-bank-details/'.$id.'?msg='.$this->success_message); die; 
			}else{
				return redirect('/add-bank-details/'.$id.'?msg='.$this->failed_message); die; 
			}
		 }
		else { 
			$val =Crud_Model::insertData('bank_details',$data); 
			
			if($val>1){
			    return redirect('/add-bank-details?msg='.$this->success_message); die; 
			}else{
				return redirect('/add-bank-details?msg='.$this->failed_message); die; 
			}
		 }
			
  }
  
  	
	
}
