<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;

use App\Models\Crud_Model;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Auth;
// use DB;

class PdfController extends Controller
{
    public function index() 
    {	
	    $filename = 'voucher/hello_world.pdf';
    	$data = [
    		'title' => 'Hello world!', 
			'order_id' => 'Hello world!',
			'css_data1' => $css_data1,
			'css_data2' => $css_data2,
			'css_data3' => $css_data3
    	];
    	$view = \View::make('voucher/flight-voucher', $data);
        $html = $view->render();
    	$pdf = new TCPDF;
        $pdf::SetTitle('Hello World');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::Output(public_path($filename), 'F');

        return response()->download(public_path($filename));
				
    }
	
	public function FlightTicket(Request $request) 
    {
		$order_id=$request['order_id'];
	    $bookingsData = crud_model::readOne('bookings',array('order_id'=>$order_id));
		$pageData = crud_model::readOne('pages',array('page_id'=>'flight-ticket'));
		if(session()->get('user_type')=='agent' ){
	   		$siteData = crud_model::readOne('users',array('user_id'=>$bookingsData->user_id));
		}else{
			$siteData = crud_model::readOne('users',array('website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),'user_type'=>'admin'));
		}
	    $filename = 'voucher/flight-ticket-'.$order_id.'.pdf';
    	$data = [
			'bookingsData' => $bookingsData,
			'siteData' => $siteData,
			'pageData' => $pageData,
			'show_price' => $request['show_price'],
    	];
    	$view = \View::make('voucher/flight-voucher', $data);
        $html = $view->render();
    	$pdf = new TCPDF;
        $pdf::SetTitle('flight-ticket-'.$order_id);
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
				
    }
	
	
	public function HotelBedsVoucher(Request $request) 
    {
		$order_id=$request['order_id'];
	    $bookingsData = crud_model::readOne('twc_booking',array('order_id'=>$order_id));
		$pageData = crud_model::readOne('pages',array('page_id'=>'hotel-ticket'));
		if(session()->get('user_type')=='agent' ){
	   		$siteData = crud_model::readOne('users',array('user_id'=>$bookingsData->user_id));
		}else{
			$siteData = crud_model::readOne('users',array('website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),'user_type'=>'admin'));
		} 
	    $filename = 'voucher/hotel-voucher-'.$order_id.'.pdf';
	    $adultData=DB::table('hotel_book_adults')->where('order_id',$order_id)->get();
    	$data = [
			'bookingsData' => $bookingsData,
			'siteData' => $siteData,
			'pageData' => $pageData,
			'show_price' => $request['show_price'],
			'adultData'=>$adultData,
    	];
    	$view = \View::make('voucher/hotel-voucher', $data);
        $html = $view->render();
    	$pdf = new TCPDF;
        $pdf::SetTitle('hotel-voucher-'.$order_id);
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
				
    }
	
	public function ToursBedsVoucher(Request $request) 
    {
		$order_id=$request['order_id'];
	    $bookingsData = crud_model::readOne('twc_booking',array('order_id'=>$order_id));
		$pageData = crud_model::readOne('pages',array('page_id'=>'tours-ticket'));
		if(session()->get('user_type')=='agent' ){
	   		$siteData = crud_model::readOne('users',array('user_id'=>$bookingsData->user_id));
		}else{
			$siteData = crud_model::readOne('users',array('website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),'user_type'=>'admin'));
		} 
	    $filename = 'voucher/tours-voucher-'.$order_id.'.pdf';
    	$data = [
			'bookingsData' => $bookingsData,
			'siteData' => $siteData,
			'pageData' => $pageData,
			'show_price' => $request['show_price'],
    	];
    	$view = \View::make('voucher/tours-voucher', $data);
        $html = $view->render();
    	$pdf = new TCPDF;
        $pdf::SetTitle('tours-voucher-'.$order_id);
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
				
    }
	
	public function TransfersBedsVoucher(Request $request) 
    {
		$order_id=$request['order_id'];
	    $bookingsData = crud_model::readOne('twc_booking',array('order_id'=>$order_id));
		$pageData = crud_model::readOne('pages',array('page_id'=>'transfers-ticket'));
		if(session()->get('user_type')=='agent' ){
	   		$siteData = crud_model::readOne('users',array('user_id'=>$bookingsData->user_id));
		}else{
			$siteData = crud_model::readOne('users',array('website'=> str_replace('www.','',$_SERVER['SERVER_NAME']),'user_type'=>'admin'));
		} 
	    $filename = 'voucher/transfers-voucher-'.$order_id.'.pdf';
    	$data = [
			'bookingsData' => $bookingsData,
			'siteData' => $siteData,
			'pageData' => $pageData,
			'show_price' => $request['show_price'],
    	];
    	$view = \View::make('voucher/transfers-voucher', $data);
        $html = $view->render();
    	$pdf = new TCPDF;
        $pdf::SetTitle('transfers-voucher-'.$order_id);
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
				
    }
	
}