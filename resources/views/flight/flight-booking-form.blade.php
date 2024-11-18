@include('site.header')
@inject('siteData1', 'App\Http\Controllers\Site')
@php   $data=json_decode($siteData1::Index(),true);
$common_data= $data['siteData']['common_data'];
$common=json_decode($common_data,true);
$images=  $data['siteData']['images'];
$images=json_decode($images,true);
$sessionval=session()->all();
$currency=$data['siteData']['currency'];
$currency_symbol=$data['siteData']['currency_symbol'];

$DOB=date('m/d/Y ', strtotime(date('m/d/Y').' -19 year'));
$DOB2=date('m/d/Y ', strtotime(date('m/d/Y').' -11 year'));
$DOB3=date('m/d/Y ', strtotime(date('m/d/Y').' -2 year'));
@endphp

<!-- ================================
START BREADCRUMB AREA
================================= -->
<!-- end breadcrumb-area -->
<!-- ================================
END BREADCRUMB AREA
================================= -->
<!-- ================================
START BOOKING AREA
================================= -->
<link rel="stylesheet" type="text/css" href="https://amplepoints.com/newcss/css/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="https://amplepoints.com/newcss/css/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="https://amplepoints.com/newcss/css/style-check.css" >
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<style>
@media only screen and (max-width:600px){.btn-b-apply{margin:0!important}}.hotel-info-main{}.hotel-tab-group{display:flex;align-items:center;justify-content:start}.hotel-tab-item{height:50px;float:left;text-transform:uppercase;margin-right:0;background:#f75d00;color:#fff;padding:12px 33.7px;font-size:14px;margin:0 1px 0 0}.o-box-room{}.hotel-info-title{margin-top:0;position:relative;font-weight:600;font-size:19px;padding-bottom:8px;margin:0 0 20px;border-bottom:1px solid rgba(128,137,150,.1);}.hotel-info-title:after{content:"";width:25px;height:4px;background:#ff7200;bottom:0;left:0;position:absolute;position:fixed;top:-99999999999999px;left:-999999999999999999px;opacity:0;}.o-b-group{display:flex;align-items:center;justify-content:start}.o-b-item{cursor:default;background-color:#fff;border:1px solid #ddd;border-bottom-color:transparent;background:#f75d00;color:#fff;padding:12px 33.7px}.h-i-tab{padding:20px;border:1px solid #e2e2e2;margin-top:-1px;z-index:1;position:relative}.h-i-ul{}.h-i-ul li{color:#111}.hotel-info-title-sm{margin:20px 0 10px;font-weight:700}.h-i-table{width:100%;border:1px solid #e2e2e2;margin:0 0 20px}.h-i-table tr,.h-i-table th,.h-i-table td{border:1px solid #e2e2e2;padding:8px;border-color:rgba(128,137,150,.2)}.h-i-table .text-left{}.h-i-table .text-right{}.hi-booking-box{}.hi-bb-title{text-align:center;background:#ff4500;color:#fff;padding:10px 39px 10px;font-weight:700;letter-spacing:1px;position:relative;margin:0;font-size:14px;line-height:18px}.hi-main-box{}.hi-bb-row{background:#e6e6e6;box-shadow:0 0 5px #e6e6e6;padding:15px 5px 0;margin:0}.hi-bb-row>div{margin:0 0 10px}.hi-bb-label{}.hi-bb-form-control{border-radius:0}.btn-hi-bb-apply{color:#ffffff;background-color:#07253f;border:none;padding:10px 15px;font-weight:bold;margin:0 0 0 0%;font-size:13px;border-radius:0}.hi-bb-footer{background:#07253f;padding:15px 0;text-align:center}.btn-hi-bb-book-now{width:auto;display:inline-block;margin:0 auto;text-align:center;clear:both;padding-left:15px;padding-right:15px;font-size:14px;color:#fff;background:#ff4500;border:none;border-radius:0}.hi-bb-form-control[readonly]{background-color:#eee}.c-form-box{border:1px solid rgba(128,137,150,.1);-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;background-color:#fff;-webkit-box-shadow:0 0 40px rgba(82,85,90,.1);-moz-box-shadow:0 0 40px rgba(82,85,90,.1);box-shadow:0 0 40px rgba(82,85,90,.1);padding:20px}
.bootstrap-select>.dropdown-toggle{
  height: 53px !important;
  border: 1px #e6e7ea solid;
}
</style>
<section class="booking-area padding-top-100px padding-bottom-70px">
    <div class="container">
        <div class="row" style="
            width: 100%;
            max-width: 100%;
            min-width: 100%;
            display: block;
            margin: 0;
            ">
            <div class="hotel-info-main">
                <div class="o-box-room">
                    <div class="row">
                        <div class="col-md-8 col-12 c-form-box-main"> <div class="c-form-box">
                            <div class="hotel-info-title">Rate Breakup</div>
                            
                            
                            
                            <div class="hotel-info-title-sm">Rate Summary:</div>
                            <table class="h-i-table">
                                <tbody>
                                    <tr id="dp2tr" style="display:none">
                                        <td class="text-left" >Discount</td>
                                        <td class="text-right">{{$currency_symbol}} <span id="dp2"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Total Price</td>
                                        <td class="text-right">{{$currency_symbol}} <span id="rate-break-total-price">{{$flightData->price*2}}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 c-form-box-main"> <div class="c-form-box">
                        
                        @php
                        $admin_model_obj = new \App\Models\CommonFunctionModel;
                        $toCurrencyRate = $admin_model_obj->getFromToCurrencyRate(1.00,'USD', 'USD');
                        $original_single_price = (int)$flightData->price;
                        $OfferedPriceRoundedOff = $admin_model_obj->displayFinalRates((int)$flightData->price, $toCurrencyRate);
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
                        $free_with_amples = ($single_price / .12);
                        $incrementIndex=0;
                        
                        @endphp
                        <br>
                        <p>Book and earn amplepoints : {{round($no_of_amples)}}</p>
                        
                        <div>
                            <div class='sidebar-booking-box'>
                                <h3 class='text-center' style="font-size: 15px !important;">USE AMPLE POINTS TO GET THIS
                                ROOM</h3>
                                <div class='booking-box-body'>
                                    <form>
                                        <div class='col-md-12 col-sm-12 col-xs-12 no-space'>
                                            <div class="row">
                                                <div class='col-md-5 col-sm-5 col-xs-5 no-space'>
                                                    <label>Price</label>
                                                </div>
                                                <div class='input-group margin-bottom-sm col-md-7 col-sm-7 col-xs-7'>
                                                    <input type='text'
                                                    id='itemprice_<?php echo (int)$flightData->price ?>'
                                                    name='itemprice'
                                                    class='form-control'
                                                    value='$<?php echo $single_price; ?>'
                                                    disabled>
                                                    <!--<span class='input-group-addon'><i class='fa fa-calendar fa-fw'></i></span>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-md-12 col-sm-12 col-xs-12 no-space'>
                                            <div class="row">
                                                <div class='col-md-5 col-sm-5 col-xs-5 no-space'>
                                                    <label>Buy & Earn</label>
                                                </div>
                                                <div class='input-group margin-bottom-sm col-md-7 col-sm-7 col-xs-7'>
                                                    <input type='text'
                                                    id='buyearnamples_<?php echo (int)$flightData->price ?>'
                                                    name='buyearnamples'
                                                    class='form-control'
                                                    placeholder='D'
                                                    value='<?php echo $admin_model_obj->DisplayAmplePoints($no_of_amples); ?>'
                                                    disabled>
                                                    <!--<span class='input-group-addon'><i class='fa fa-calendar fa-fw'></i></span>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-md-12 col-sm-12 col-xs-12 no-space'>
                                            <div class="row">
                                                <div class='col-md-5 col-sm-5 col-xs-5 no-space'>
                                                    <label>Amples Needed to Redeem</label>
                                                </div>
                                                <div class='input-group margin-bottom-sm col-md-7 col-sm-7 col-xs-7'>
                                                    <input type='text'
                                                    id='useamplestoshop_<?php echo (int)$flightData->price ?>'
                                                    name='useamplestoshop'
                                                    class='form-control'
                                                    value='<?php echo $admin_model_obj->DisplayAmplePoints($free_with_amples); ?> Amples'
                                                    disabled>
                                                    <!--<span class='input-group-addon'><i class='fa fa-calendar fa-fw'></i></span>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-md-12 col-sm-12 col-xs-12 no-space'>
                                            <div class="row">
                                                <div class='col-md-5 col-sm-5 col-xs-5 no-space'>
                                                    <label>Apply Amples</label>
                                                </div>
                                                <div class='input-group margin-bottom-sm col-md-7 col-sm-7 col-xs-7'>
                                                    <input type='text' onchange="ampleEnterFun(this.value,'<?php echo (int)$flightData->price ?>')"
                                                    id='inputamples_<?php echo (int)$flightData->price ?>'
                                                    name='inputamples'
                                                    class='form-control'>
                                                    <!--<span class='input-group-addon'><i class='fa fa-calendar fa-fw'></i></span>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-md-4 col-sm-4 col-xs-4 no-space add-cart-submit btn-b-apply' style="margin-left: 210px;">
                                            <button class="btn btn-dark" style="width:100%" id='applyamples_<?php echo (int)$flightData->price ?>'
                                            type='button'
                                            onclick="applyAmplePoints('<?php echo (int)$flightData->price ?>','<?php echo $single_price; ?>','<?php echo $discount_price; ?>','<?php echo $discount; ?>')">
                                            APPLY
                                            </button>
                                        </div>
                                        
                                        <div class='clearfix'></div>
                                        <div class='grand-total1 text-center'>
                                            <div class="row">
                                                <div class='col-md-8 col-sm-8 col-xs-8 no-space'
                                                    id='newpricesection_<?php echo (int)$flightData->price ?>'
                                                    style='display:none;'><span
                                                    style="width: 42%;">New Price : </span>
                                                    <h4 id='newitemprice_<?php echo (int)$flightData->price ?>'
                                                    style="margin: 15px 10px;">&nbsp;
                                                    $<?php echo $single_price; ?></h4>
                                                    <span class='res-collection-sub'
                                                        style='display:none;margin: 12px 0 0 -10px;'
                                                    id="res_collection_sub_<?php echo (int)$flightData->price ?>">FREE</span>
                                                    <input type="hidden"
                                                    id="usernewitemprice_<?php echo (int)$flightData->price ?>"
                                                    value="<?php echo $single_price; ?>"/>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class='res-collection-sub1'
                                            id="res_collection_sub_1_<?php echo (int)$flightData->price ?>">
                                            <div class='col-md-12 col-sm-12 col-xs-12 no-space'
                                                id='earnrewardsection_<?php echo (int)$flightData->price ?>'
                                                style='display:none;'>
                                                <div class='col-md-5 col-sm-5 col-xs-5 no-space'>
                                                    <label>Earn Reward</label>
                                                </div>
                                                <div class='input-group margin-bottom-sm col-md-7 col-sm-7 col-xs-7'>
                                                    <input type='text'
                                                    id='earnrewardamples_<?php echo (int)$flightData->price ?>'
                                                    name='earnrewardamples'
                                                    class='form-control'
                                                    disabled>
                                                    <!--<span class='input-group-addon'><i class='fa fa-calendar fa-fw'></i></span>-->
                                                </div>
                                            </div>
                                            <div class='col-md-12 col-sm-12 col-xs-12 no-space'>
                                                <div class="row">
                                                    <div class='col-md-5 col-sm-5 col-xs-5 no-space'>
                                                        <label>Reward Value</label>
                                                    </div>
                                                    <div class='input-group margin-bottom-sm col-md-7 col-sm-7 col-xs-7'>
                                                        <input type='text'
                                                        id='earnrewardonitem_<?php echo (int)$flightData->price ?>'
                                                        name='earnrewardonitem'
                                                        value='<?php echo $discount_price; ?>'
                                                        class='form-control'
                                                        disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-12 col-sm-12 col-xs-12 no-space'>
                                                <div class="row">
                                                    <div class='col-md-5 col-sm-5 col-xs-5 no-space'>
                                                        <label>You Earn</label>
                                                    </div>
                                                    <div class='input-group margin-bottom-sm col-md-7 col-sm-7 col-xs-7'>
                                                        <input type='text'
                                                        id='youearndiscount_<?php echo (int)$flightData->price ?>'
                                                        name='youearndiscount'
                                                        value='<?php echo (int)$discount; ?>%'
                                                        class='form-control'
                                                        disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='clearfix'></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>











<div class="row">
    <div class="col-lg-8">
        <div class="form-box">
            <div class="form-title-wrap">
                <h3 class="title">Traveler Information</h3>
                </div><!-- form-title-wrap -->

    <div class="form-content">
        <div class="contact-form-action">
            <form method="post" action="{{ asset('flight-final-checkout') }}">
                @csrf
                <input class="form-control" type="hidden" name="OfferId" id="OfferId" value="<?php echo $flightData->OfferId; ?>">
                <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $flightData->id; ?>">
                <input class="form-control" type="hidden" name="chargeableRate" id="chargeableRate" value="<?php echo (int)$flightData->price; ?>">
                <input class="form-control" type="hidden" name="booked_ample" id="booked_ample" value="0">
                <input class="form-control" type="hidden" name="discount_by_ample" id="discount_by_ample" value="0">
                <div class="row">
                    <?php for($a=0;$a<$flightData->adults;$a++){ ?>
                    <div class="form-title-wrap col-lg-12">
                        <h3 class="title">Adult <?php echo $a+1; ?></h3>
                        </div><!-- form-title-wrap -->
                        
                        <div class="col-lg-6 responsive-column">
                            <div class="input-box">
                                <label class="label-text">Title <span style="color:#FF0000">*</span></label>
                                <div class="form-group">
                                    <div >
                                        <select class="select-contain-select" name="passenger[adult][title][]" requited>
                                            <option value="mr">Mr</option>
                                            <option value="mrs">Mrs</option>
                                            <option value="miss">Miss</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 responsive-column">
                            <div class="input-box">
                                <label class="label-text">First Name <span style="color:#FF0000">*</span></label>
                                <div class="form-group">
                                    <span class="la la-user form-icon"></span>
                                    <input class="form-control" type="text" name="passenger[adult][first_name][]" placeholder="First name" requited>
                                </div>
                            </div>
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-6 responsive-column">
                                <div class="input-box">
                                    <label class="label-text">Last Name</label>
                                    <div class="form-group">
                                        <span class="la la-user form-icon"></span>
                                        <input class="form-control" type="text" name="passenger[adult][last_name][]" placeholder="Last name">
                                    </div>
                                </div>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6 responsive-column">
                                    <div class="input-box">
                                        <label class="label-text">DOB <span style="color:#FF0000">*</span></label>
                                        <div class="form-group">
                                            <span class="la la-calendar form-icon"></span>
                                            <input class="form-control adult_dob" type="text" name="passenger[adult][dob][]" value="{{$DOB}}" placeholder="" requited>
                                        </div>
                                    </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">Gender <span style="color:#FF0000">*</span></label>
                                            <div class="form-group">
                                                <div >
                                                    <select class="select-contain-select" name="passenger[adult][gender][]" requited>
                                                        <option value="m">Male</option>
                                                        <option value="f">Female</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  <div class="col-lg-6 responsive-column">
                                        <div class="input-box">
                                            <label class="label-text">ID </label>
                                            <div class="form-group">
                                                <div >
                                                    <input class="form-control" type="text" name="passenger[adult][id][]" placeholder="Document ID">
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <?php } ?>
                                    <hr /><hr />
                                    <?php for($a=0;$a<$flightData->children;$a++){ ?>
                                    <div class="form-title-wrap col-lg-12">
                                        <h3 class="title">Children <?php echo $a+1; ?></h3>
                                        </div><!-- form-title-wrap -->
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">Title <span style="color:#FF0000">*</span></label>
                                                <div class="form-group">
                                                    <div >
                                                        <select class="select-contain-select" name="passenger[child][title][]" requited>
                                                            <option value="mr">Mr</option>
                                                            <option value="mrs">Mrs</option>
                                                            <option value="miss">Miss</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">First Name <span style="color:#FF0000">*</span></label>
                                                <div class="form-group">
                                                    <span class="la la-user form-icon"></span>
                                                    <input class="form-control" type="text" name="passenger[child][first_name][]" placeholder="First name" requited>
                                                </div>
                                            </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6 responsive-column">
                                                <div class="input-box">
                                                    <label class="label-text">Last Name</label>
                                                    <div class="form-group">
                                                        <span class="la la-user form-icon"></span>
                                                        <input class="form-control" type="text" name="passenger[child][last_name][]" placeholder="Last name">
                                                    </div>
                                                </div>
                                                </div><!-- end col-lg-6 -->
                                                <div class="col-lg-6 responsive-column">
                                                    <div class="input-box">
                                                        <label class="label-text">DOB <span style="color:#FF0000">*</span></label>
                                                        <div class="form-group">
                                                            <span class="la la-calendar form-icon"></span>
                                                            <input class="form-control child-dob" type="text" name="passenger[child][dob][]" value="{{$DOB2}}" requited>
                                                        </div>
                                                    </div>
                                                    </div><!-- end col-lg-6 -->
                                                    
                                                    <div class="col-lg-6 responsive-column">
                                                        <div class="input-box">
                                                            <label class="label-text">Gender <span style="color:#FF0000">*</span></label>
                                                            <div class="form-group">
                                                                <div >
                                                                    <select class="select-contain-select" name="passenger[child][gender][]" requited>
                                                                        <option value="m">Male</option>
                                                                        <option value="f">Female</option>
                                                                        <option value="other">Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--  <div class="col-lg-6 responsive-column">
                                                        <div class="input-box">
                                                            <label class="label-text">ID</label>
                                                            <div class="form-group">
                                                                <div >
                                                                    <input class="form-control" type="text" name="passenger[child][id][]" placeholder="Enter ID" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    
                                                    <?php } ?>
                                                    <hr /><hr />



<?php for($a=0;$a<$flightData->infants;$a++){ ?>
<div class="form-title-wrap col-lg-12">
    <h3 class="title">Infants <?php echo $a+1; ?></h3>
    </div><!-- form-title-wrap -->
    <div class="col-lg-6 responsive-column">
        <div class="input-box">
            <label class="label-text">Title <span style="color:#FF0000">*</span></label>
            <div class="form-group">
                <div >
                    <select class="select-contain-select" name="passenger[infant][title][]" requited>
                        <option value="mr">Mr</option>
                        <option value="mrs">Mrs</option>
                        <option value="miss">Miss</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 responsive-column">
        <div class="input-box">
            <label class="label-text">First Name <span style="color:#FF0000">*</span></label>
            <div class="form-group">
                <span class="la la-user form-icon"></span>
                <input class="form-control" type="text" name="passenger[infant][first_name][]" placeholder="First name" requited>
            </div>
        </div>
        </div><!-- end col-lg-6 -->
        <div class="col-lg-6 responsive-column">
            <div class="input-box">
                <label class="label-text">Last Name</label>
                <div class="form-group">
                    <span class="la la-user form-icon"></span>
                    <input class="form-control" type="text" name="passenger[infant][last_name][]" placeholder="Last name">
                </div>
            </div>
            </div><!-- end col-lg-6 -->
            <div class="col-lg-6 responsive-column">
                <div class="input-box">
                    <label class="label-text">DOB <span style="color:#FF0000">*</span></label>
                    <div class="form-group">
                        <span class="la la-calendar form-icon"></span>
                        <input class="form-control infa_dob" type="text" name="passenger[infant][dob][]" value="{{$DOB3}}" requited>
                    </div>
                </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6 responsive-column">
                    <div class="input-box">
                        <label class="label-text">Gender <span style="color:#FF0000">*</span></label>
                        <div class="form-group">
                            <div >
                                <select class="select-contain-select" name="passenger[infant][gender][]">
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {{--  <div class="col-lg-6 responsive-column">
                    <div class="input-box">
                        <label class="label-text">ID </label>
                        <div class="form-group">
                            <div >
                                <input class="form-control" type="text" name="passenger[infant][id][]" placeholder="Enter ID">
                            </div>
                        </div>
                    </div>
                </div> --}}
                <?php } ?>
                <hr /><hr />
                <div class="col-lg-6 responsive-column">
                    <div class="input-box">
                        <label class="label-text">Your Email <span style="color:#FF0000">*</span></label>
                        <div class="form-group">
                            <span class="la la-envelope-o form-icon"></span>
                            <input class="form-control" type="email" name="passenger[email]" placeholder="Email address" requited>
                        </div>
                    </div>
                    </div><!-- end col-lg-6 -->
                    <div class="col-lg-6 responsive-column">
                        <div class="input-box">
                            <label class="label-text">Phone Number <span style="color:#FF0000">*</span></label>
                            <div class="form-group">
                                <span class="la la-phone form-icon"></span>
                                {{--  <input class="form-control" type="text" name="passenger[phone]" placeholder="Phone Number" requited> --}}
                                <input class="form-control" type="tel" minlength="10" maxlength="15" name="passenger[phone]" placeholder="Phone Number" pattern="[0-9+\-\(\) ]{10,15}" required>
                            </div>
                        </div>
                        </div><!-- end col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="input-box">
                                <label class="label-text">Address <span style="color:#FF0000">*</span></label>
                                <div class="form-group">
                                    <span class="la la-map-marked form-icon"></span>
                                    <input class="form-control" type="text" name="passenger[address]" placeholder="Address line" requited>
                                </div>
                            </div>




</div><!-- end col-lg-12 -->
<div class="col-lg-6">
    <div class="input-box">
        <label class="label-text">City <span style="color:#FF0000">*</span></label>
        <div class="form-group">
            <span class="la la-map-marked form-icon"></span>
            <input class="form-control" type="text" name="passenger[city]" placeholder="City" requited>
        </div>
    </div>
    </div><!-- end col-lg-12 -->
    <div class="col-lg-6 responsive-column">
        <div class="input-box">
            <label class="label-text">Country <span style="color:#FF0000">*</span></label>
            <div class="form-group">
                <div >
                    <select class="select-contain-select" name="passenger[country]" required>
                        <option value="select-country">Select country</option>
                        <option value="Afghanistan">Afghanistan</option>
                        @foreach($countryData as $key => $data)
                        <option value="{{$data->name}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        </div><!-- end col-lg-6 -->
        <?php if(!isset($sessionval['user_id'])){ $sessionval['user_type']=''; } ?>
        @if($sessionval['user_type']=='agent')
        <input type="hidden" name="payment_type" value="wallet" />
        @else
        <div class="col-lg-6 responsive-column" style="display:none">
            <div class="input-box">
                <label class="label-text">Choose Payment Type</label>
                <div class="form-group">
                    <div >
                        <select class="select-contain-select" name="payment_type">
                            <option value="flutterwave">Flutterwave</option>
                            <option value="braintree">Braintree</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="col-lg-12">
            <div class="input-box">
                <div class="custom-checkbox mb-0">
                    <input type="checkbox" id="receiveChb">
                    <label for="receiveChb">Accept <a target="_blank" href="{{ asset('terms-and-condition')}}">Terms & Condition</a></label>
                </div>
            </div>
            </div><!-- end col-lg-12 -->
        </div>
        <button class="theme-btn" id="show_button" onclick="checkTerm()" type="button" >Confirm Booking</button>
        <button style="display:none" class="theme-btn"  id="submit_btn" type="submit">Confirm Booking</button>
        <button style="background:#FF0000;display:none" id="NotAvalible" type="button">Flight No Longer Avalible Please Select Other Flight.</button>
    </form>
    </div><!-- end contact-form-action -->
    </div><!-- end form-content -->
    </div><!-- end form-box -->
</div>





<div class="col-lg-4">
    <div class="form-box booking-detail-form">
        <div class="form-title-wrap">
            <h3 class="title">Booking Details</h3>
            </div><!-- end form-title-wrap -->
            <div class="form-content">
                <div class="card-item shadow-none radius-none mb-0">
                    <div class="card-img pb-4">
                        <a href="#" class="d-block">
                            <img src="https://res.cloudinary.com/wego/image/upload/c_fit,w_100,h_100/v20190802/flights/airlines_square/<?php echo $flightData->validating_carrier; ?>" alt="plane-img">
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="card-title"><?php echo $flightData->cityFrom; ?> to <?php echo $flightData->cityTo; ?></h3>
                                <p class="card-meta"><?php if($flightData->is_return==0){ echo "One way Flight"; }else{ echo "Return Flight"; } ?></p>
                            </div>
                            
                        </div>
                        <!--<div class="card-rating">
                            <span class="badge text-white">4.4/5</span>
                            <span class="review__text">Average</span>
                            <span class="rating__text">(30 Reviews)</span>
                        </div>-->
                        <div class="section-block"></div>
                        <ul class="list-items list-items-2 list-items-flush py-2">
                            <li class="font-size-15"><span class="w-auto d-block mb-n1"><i class="la la-plane mr-1 font-size-17"></i>Take off</span><?php echo date('d M  Y  h:i:s',$flightData->departure_datetime); ?></li>
                            <li class="font-size-15"><i class="la la-clock-o mr-1 text-black font-size-17"></i><?php echo floor($flightData->duration/3600).' Hours '.floor(($flightData->duration/60)%60).' Minutes' ?></li>
                            <li class="font-size-15"><span class="w-auto d-block mb-n1"><i class="la la-plane mr-1 font-size-17"></i>Landing</span><?php echo date('d M  Y  h:i:s',$flightData->arrival_datetime); ?></li>
                        </ul>
                        <?php $onewayFlights=json_decode($flightData->onewayFlights,true); ?>
                        <h3 class="card-title pb-3">Order Details</h3>
                        <div class="section-block"></div>
                        <ul class="list-items list-items-2 py-3">
                            <li><span>Airline:</span><?php echo $onewayFlights[0]['airline_name'];  ?> </li>
                            <li><span>Flight Type:</span><?php echo $flightData->CabinClass; ?></li>
                            <li><span>Passengers:</span>Adult: <?php echo $flightData->adults; ?> Children: <?php echo $flightData->children; ?> Infants: <?php echo $flightData->infants; ?></li>
                        </ul>
                        <div class="section-block"></div>
                        <ul class="list-items list-items-2 pt-3">
                            {{--  <li><span>Base Fare:</span><span class="base_fare">...<?php echo $flightData->base_fare; ?></span></li>
                            <li><span>Taxes And Fees:</span><span class="tax">...<?php echo $flightData->tax; ?></span></li> --}}
                            
                            
                            
                            <li {{-- id="tali1" --}}><span>Total Price:</span><span class="total_amount" {{-- id="ta1" --}}>$ {{(int)$flightData->price*2;}} </span></li>
                            <li id="dpli" style="display:none"><span>Discount Price:</span><span class="discount_amount" id="dp"></span></li>
                            <li id="tali2" style="display:none"><span>New Price:</span><span class="total_amount2" id="ta2"></span></li>
                        </ul>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div><!-- end card-item -->
    </div><!-- end form-content -->
    </div><!-- end form-box -->
    </div><!-- end col-lg-4 -->
    </div><!-- end row -->
    </div><!-- end container -->
    </section><!-- end booking-area -->
    <!-- ================================
    END BOOKING AREA
    ================================= -->
    <div class="section-block"></div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
                                
function checkTerm()
{
    var val=$("#receiveChb").prop("checked");
    if(val==true){
        $("#submit_btn").trigger("click");
    }
    else{
        alert('Please Accept Terms and Condition.');
    }
        
}
                                
var innerHtml=''; var page=0; var search_session='';
jQuery(document).ready(function(){
        // var innerHtml='<div class="loader"><svg class="spinner" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg></div>';   jQuery('.flight_ist').html(innerHtml);
                        $.ajax({
url:'<?php url(''); ?>/recheck_flight',
type: "GET",
data: {
action: "recheck_flight",
id: "<?php echo $flightData->id; ?>",
rand: "<?php echo rand(); ?>",
},
dataType: "json",
success: function (data) {
if(typeof data.errors === 'object'){
alert('Flight No Longer Avalible. Please Select Other Flight.'); $("#show_button").hide(); $("#NotAvalible").show();
}
else if(typeof data.data === 'object'){
document.getElementById('api_currency').value=data.data.total_currency;
document.getElementById('currency_main').value=data.data.currency;
document.getElementById('chargeableRate').value=data.data.total_amount;
document.getElementById('apiPrice').value=data.data.apiPrice;
document.getElementById('base_fare').value=data.data.base_amount;
document.getElementById('tax').value=data.data.tax_amount;

jQuery('.base_fare').html(data.data.currency_symbol+' '+parseFloat(data.data.base_amount).toLocaleString());
jQuery('.tax').html(data.data.currency_symbol+' '+parseFloat(data.data.tax_amount).toLocaleString());
jQuery('.total_amount').html(data.data.currency_symbol+' '+parseFloat(data.data.total_amount).toLocaleString());
}else{
alert('Error Occur.'); $("#show_button").hide(); $("#NotAvalible").show();
}
},
error: function (error) {
console.log(`Error ${error}`);
}
});
});


function applyAmplePoints(room_index, single_price, discount_price, discount) {
// console.log(room_index)
var user_total_alample = {{ @Auth::user()->ample ?? 0 }};
var qty = 1;
var totalamples = $('#useamplestoshop_'+room_index).val();
var amplesbyuser = $('#inputamples_'+room_index).val();
var amplesbyusr = parseFloat(amplesbyuser);
// console.log(totalamples)
var totalpamples = totalamples.split(' ');
var totalitemamples = parseFloat(totalpamples[0]);
var checkusertotal = parseFloat(user_total_alample);
var checkapplyample = parseFloat(amplesbyuser);
var pattern = /^\d+(\.\d{1,2})?$/;
if (!pattern.test(amplesbyuser)) {
alert("Please Enter Valid AmplePoints");
return false;
}
if (amplesbyuser == '00' || amplesbyuser <= 0) {
alert("Please Enter Valid AmplePoints");
return false;
}
if (checkapplyample > checkusertotal) {
alert("You Don't Have Enough Ample Please Earn More Ample, your remaining ample is "+user_total_alample);
return false;
}
if (amplesbyuser == '') {
alert("Please enter number of amples you want to apply");
} else if (amplesbyusr > totalitemamples) {
alert("Please enter the number of amples below to total of amples for this product.");
$('#inputamples').val('');
} else {
$("#btax_" + room_index).hide();
$("#atax_" + room_index).show();
var amplepricebyuser = ((amplesbyuser * 12) / 100);
var itempricebyample = ((totalitemamples * 12) / 100);
var itemprice = single_price;
//    alert(itemprice);
var itemreward = discount_price;
var itemdiscount = discount;
//var newitemreward = (qty * itemreward);
var newitemprice = (qty * itemprice);
//alert(newitemprice);
var newitemdiscount = (qty * itemdiscount);
// New Price by user = (amples needed to redeem - apply amples)*.12  $...
// Earn Reward = (new price by user * discount percentage)/.12       Amples....
// If No amples applied by user then Reward Value = (retail price * discount percentage)  $....
// Reward Value = (new price by user * discount percentage)      $....
// You Earn = discount percentage
var newitempricebyuser = (itempricebyample - amplepricebyuser);
var earnrewardamples = (((newitempricebyuser * ((itemdiscount) / 100)) / 12) * 100);
var newitemreward = (newitempricebyuser * ((itemdiscount) / 100));
if (newitempricebyuser == 0.00) {
$("#newpricesection_" + room_index).css("display", "block");
$('#newitemprice_' + room_index).text(' ' + '$' + newitempricebyuser.toFixed(2));
//$('#usernewitemprice').val((newitempricebyuser/qty).toFixed(2));
$('#usernewitemprice_' + room_index).val(newitempricebyuser.toFixed(2));
$('#earnrewardamples_' + room_index).val('0.00');
$("#earnrewardsection_" + room_index).css("display", "none");
$("#res_collection_sub_1_" + room_index).css("display", "none");
$("#res_collection_sub_" + room_index).css("display", "block");
} else {
$("#res_collection_sub_1_" + room_index).css("display", "block");
$("#res_collection_sub_" + room_index).css("display", "none");
$("#earnrewardsection_" + room_index).css("display", "none");
$("#newpricesection_" + room_index).css("display", "block");
$("#newitemprice_" + room_index).css("display", "block");
$('#newitemprice_' + room_index).text(' ' + '$' + newitempricebyuser.toFixed(2));
//$('#usernewitemprice').val((newitempricebyuser/qty).toFixed(2));
$('#usernewitemprice_' + room_index).val(newitempricebyuser.toFixed(2));
$("#earnrewardsection_" + room_index).css("display", "block");
$('#earnrewardamples_' + room_index).val(earnrewardamples.toFixed(2) + ' Amples');
$('#earnrewardonitem_' + room_index).val('$' + newitemreward.toFixed(2));
if (qty > 1) {
var newitemdiscountpercentage = parseInt((newitemdiscount) / qty);
$('#youearndiscount_' + room_index).val(newitemdiscountpercentage.toFixed(2) + '%');
} else {
var newitemdiscountpercentage = parseInt(newitemdiscount);
$('#youearndiscount_' + room_index).val(newitemdiscountpercentage.toFixed(2) + '%');
}
}
}

//first price
var firstPrice= $("#itemprice_" + room_index).val().split("$")[1];
var newFinal_Price=newitempricebyuser.toFixed(2);
var discount_price=(parseInt(firstPrice) - newFinal_Price).toFixed(2);
var ampleEnterPoint=$("#inputamples_"+room_index).val()
console.log(firstPrice,newFinal_Price,discount_price)
$("#dpli").show();
$("#tali2").show();
$("#tali1").hide();
$("#dp").html(' ' + '$' + discount_price);
$("#ta2").html(' ' + '$' + newFinal_Price);
$("#dp2tr").show();
$("#dp2").html(' '+ discount_price);
$("#rate-break-total-price").html(' '+ newFinal_Price);
$("#chargeableRate").val(newFinal_Price/2)
$("#booked_ample").val(amplesbyuser)
}




function ampleEnterFun(val,room_index){
// console.log(val,room_index)
if(val==0 || val=="" || val==null){
// var firstPrice= $("#itemprice_" + room_index).val().split("$")[1];
$("#dpli").show();
$("#tali2").hide();
$("#tali1").show();
$("#dp").html(' ' + '$' + 0);
$("#ta2").html(' ' + '$' + 0);
$('#newitemprice_' + room_index).text(' ' + '$' + room_index*2);
$("#chargeableRate").val(room_index)
$("#booked_ample").val(0)
$("#dp2").html(' '+ 0);
$("#rate-break-total-price").html(' '+ room_index*2);
}
}
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
var datePickers = document.querySelectorAll('.child-dob');
var today = new Date();
var maxChildDate = new Date(today.getFullYear() - 2, today.getMonth(), today.getDate());
var minChildDate = new Date(today.getFullYear() - 11, today.getMonth(), today.getDate());
datePickers.forEach(function(datePicker) {
flatpickr(datePicker, {
// dateFormat: 'Y-m-d',
dateFormat: 'm-d-Y',
minDate: minChildDate,
maxDate: maxChildDate
});
});
});
document.addEventListener('DOMContentLoaded', function () {
var adultDatePickers = document.querySelectorAll('.adult_dob');
var today = new Date();
// Adult date range (12 years and older)
var maxAdultDate = new Date(today.getFullYear() - 12, today.getMonth(), today.getDate());
// Note: No minimum date for adults since there's no upper limit to age
adultDatePickers.forEach(function(datePicker) {
flatpickr(datePicker, {
// dateFormat: 'Y-m-d',
dateFormat: 'm-d-Y',
maxDate: maxAdultDate
});
});
});
document.addEventListener('DOMContentLoaded', function () {
var infantDatePickers = document.querySelectorAll('.infa_dob');
var today = new Date();
// Infant date range (under 2 years)
var maxInfantDate = today;
var minInfantDate = new Date(today.getFullYear() - 2, today.getMonth(), today.getDate());

infantDatePickers.forEach(function(datePicker) {
flatpickr(datePicker, {
// dateFormat: 'Y-m-d',
dateFormat: 'm-d-Y',
minDate: minInfantDate,
maxDate: maxInfantDate
});
});
});
</script>
@include('site.footer')