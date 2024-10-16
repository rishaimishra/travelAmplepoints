<!-- ================================
    START BREADCRUMB AREA
================================= -->

@include('site.header')

  @inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
        $common_data= $data['siteData']['common_data'];
                $common=json_decode($common_data,true);
                $images_main=  $data['siteData']['images'];
                $images_main=json_decode($images_main,true);
                 $sessionval=session()->all();
                $currency=$data['siteData']['currency'];  
                $currency_symbol=$data['siteData']['currency_symbol']; 
                $DOB=date('Y/m/d ', strtotime(date('m/d/Y').' -19 year')); 
         @endphp
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
  
    <style>
@media only screen and (max-width:600px){.btn-b-apply{margin:0!important}}.hotel-info-main{}.hotel-tab-group{display:flex;align-items:center;justify-content:start}.hotel-tab-item{height:50px;float:left;text-transform:uppercase;margin-right:0;background:#f75d00;color:#fff;padding:12px 33.7px;font-size:14px;margin:0 1px 0 0}.o-box-room{}.hotel-info-title{margin-top:0;position:relative;font-weight:600;font-size:19px;padding-bottom:8px;margin:0 0 20px;border-bottom:1px solid rgba(128,137,150,.1);}.hotel-info-title:after{content:"";width:25px;height:4px;background:#ff7200;bottom:0;left:0;position:absolute;position:fixed;top:-99999999999999px;left:-999999999999999999px;opacity:0;}.o-b-group{display:flex;align-items:center;justify-content:start}.o-b-item{cursor:default;background-color:#fff;border:1px solid #ddd;border-bottom-color:transparent;background:#f75d00;color:#fff;padding:12px 33.7px}.h-i-tab{padding:20px;border:1px solid #e2e2e2;margin-top:-1px;z-index:1;position:relative}.h-i-ul{}.h-i-ul li{color:#111}.hotel-info-title-sm{margin:20px 0 10px;font-weight:700}.h-i-table{width:100%;border:1px solid #e2e2e2;margin:0 0 20px}.h-i-table tr,.h-i-table th,.h-i-table td{border:1px solid #e2e2e2;padding:8px;border-color:rgba(128,137,150,.2)}.h-i-table .text-left{}.h-i-table .text-right{}.hi-booking-box{}.hi-bb-title{text-align:center;background:#ff4500;color:#fff;padding:10px 39px 10px;font-weight:700;letter-spacing:1px;position:relative;margin:0;font-size:14px;line-height:18px}.hi-main-box{}.hi-bb-row{background:#e6e6e6;box-shadow:0 0 5px #e6e6e6;padding:15px 5px 0;margin:0}.hi-bb-row>div{margin:0 0 10px}.hi-bb-label{}.hi-bb-form-control{border-radius:0}.btn-hi-bb-apply{color:#ffffff;background-color:#07253f;border:none;padding:10px 15px;font-weight:bold;margin:0 0 0 0%;font-size:13px;border-radius:0}.hi-bb-footer{background:#07253f;padding:15px 0;text-align:center}.btn-hi-bb-book-now{width:auto;display:inline-block;margin:0 auto;text-align:center;clear:both;padding-left:15px;padding-right:15px;font-size:14px;color:#fff;background:#ff4500;border:none;border-radius:0}.hi-bb-form-control[readonly]{background-color:#eee}.c-form-box{border:1px solid rgba(128,137,150,.1);-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;background-color:#fff;-webkit-box-shadow:0 0 40px rgba(82,85,90,.1);-moz-box-shadow:0 0 40px rgba(82,85,90,.1);box-shadow:0 0 40px rgba(82,85,90,.1);padding:20px}
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
      
      {{--  <div class="o-b-group">
        <div class="o-b-item">Room name</div>
      </div>
      <div class="hotel-info-title-sm">Rate Breakup:</div>
      <table class="h-i-table">
        <thead>
          <tr>
            <th class="text-left">Date</th>
            <th class="text-right">Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-left">10/02/2024</td>
            <td class="text-right">$ 22.20</td>
          </tr>
        </tbody>
      </table> --}}
      
      @php
      $d=1;
      @endphp
      @foreach($rooms as $date => $roomData)
      <div class="o-b-group">
        <div class="o-b-item">Date: {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</div>
      </div>
      <div class="hotel-info-title-sm">Rate Breakup for day {{$d}} :</div>
      @foreach($roomData as $key=> $data)
      <table class="h-i-table">
        <thead>
          <tr>
            <th class="text-left">Room {{$key+1}}</th>
            <th class="text-right">Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-left">{{ $data['room'] }}</td>
            <td class="text-right">{{$currency_symbol}} {{ number_format($data['price']*2, 2) }}</td>
          </tr>
        </tbody>
      </table>
      @endforeach
      @php
      $d++;
      @endphp
      @endforeach
      <div class="hotel-info-title-sm">Rate Summary:</div>
      <table class="h-i-table">
        <tbody>
          <tr id="dp2tr" style="display:none">
            <td class="text-left" >Discount</td>
            <td class="text-right">{{$currency_symbol}} <span id="dp2"></span></td>
          </tr>
          <tr>
            <td class="text-left">Total Price</td>
            <td class="text-right">{{$currency_symbol}} <span id="rate-break-total-price">{{$totalPrice*2}}</span></td>
          </tr>
        </tbody>
      </table>
    </div>
    </div>








<div class="col-md-4 col-12 c-form-box-main"> <div class="c-form-box">
 
  @php
  $admin_model_obj = new \App\Models\CommonFunctionModel;
  $toCurrencyRate = $admin_model_obj->getFromToCurrencyRate(1.00,'USD', 'USD');
  $original_single_price = $totalPrice;
  $OfferedPriceRoundedOff = $admin_model_obj->displayFinalRates($totalPrice, $toCurrencyRate);
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
  
  <!-- end card-item -->

 
  <p>Book and earn amplepoints : {{round($no_of_amples)}}</p>
  <br>
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
              id='itemprice_<?php echo $totalPrice ?>'
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
              id='buyearnamples_<?php echo $totalPrice ?>'
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
              id='useamplestoshop_<?php echo $totalPrice ?>'
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
              <input type='text' onchange="ampleEnterFun(this.value,'<?php echo $totalPrice ?>')"
              id='inputamples_<?php echo $totalPrice ?>'
              name='inputamples'
              class='form-control'>
              <!--<span class='input-group-addon'><i class='fa fa-calendar fa-fw'></i></span>-->
            </div>
          </div>
        </div>
        <div class='col-md-4 col-sm-4 col-xs-4 no-space add-cart-submit btn-b-apply' style="margin-left: 210px;">
          <button class="btn btn-dark" style="width:100%" id='applyamples_<?php echo $totalPrice ?>'
          type='button'
          onclick="applyAmplePoints('<?php echo $totalPrice ?>','<?php echo $single_price; ?>','<?php echo $discount_price; ?>','<?php echo $discount; ?>')">
          APPLY
          </button>
        </div>
        
        <div class='clearfix'></div>
        <div class='grand-total1 text-center'>
          <div class="row">
            <div class='col-md-8 col-sm-8 col-xs-8 no-space'
              id='newpricesection_<?php echo $totalPrice ?>'
              style='display:none;'><span
              style="width: 42%;">New Price : </span>
              <h4 id='newitemprice_<?php echo $totalPrice ?>'
              style="margin: 15px 10px;">&nbsp;
              $<?php echo $single_price; ?></h4>
              <span class='res-collection-sub'
                style='display:none;margin: 12px 0 0 -10px;'
              id="res_collection_sub_<?php echo $totalPrice ?>">FREE</span>
              <input type="hidden"
              id="usernewitemprice_<?php echo $totalPrice ?>"
              value="<?php echo $single_price; ?>"/>
            </div>
            
          </div>
        </div>
        <div class='res-collection-sub1'
          id="res_collection_sub_1_<?php echo $totalPrice ?>">
          <div class='col-md-12 col-sm-12 col-xs-12 no-space'
            id='earnrewardsection_<?php echo $totalPrice ?>'
            style='display:none;'>
            <div class='col-md-5 col-sm-5 col-xs-5 no-space'>
              <label>Earn Reward</label>
            </div>
            <div class='input-group margin-bottom-sm col-md-7 col-sm-7 col-xs-7'>
              <input type='text'
              id='earnrewardamples_<?php echo $totalPrice ?>'
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
                id='earnrewardonitem_<?php echo $totalPrice ?>'
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
                id='youearndiscount_<?php echo $totalPrice ?>'
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
          </div>
          <!-- form-title-wrap -->
          <div class="form-content">
            <div class="contact-form-action">
              <form method="post" action="{{ asset('hotel-final-checkout') }}">
              @csrf
                <input class="form-control" type="hidden" name="EANHotelID" id="EANHotelID" value="<?php echo $hotelSearchData->EANHotelID; ?>">
                <input class="form-control" type="hidden" name="search_id" id="search_id" value="<?php echo $hotelSearchData->search_session; ?>">
                <input class="form-control" type="hidden" name="ref_id" id="ref_id" value="<?php echo $hotelSearchData->id; ?>">
                <input class="form-control" type="hidden" name="paymentType" id="paymentType" value="<?php echo $hotelSearchData->paymentType; ?>">
                <input class="form-control" type="hidden" name="agent_id" id="agent_id">
                <input class="form-control" type="hidden" name="user_id" id="user_id" value="<?php if(isset($sessionval['user_id'])){ echo $sessionval['user_id']; } ?>">
                <input class="form-control" type="hidden" name="currency" id="currency_main">
                <input class="form-control" type="hidden" name="api_currency" id="api_currency" value="<?php echo $hotelSearchData->api_currency; ?>">
                <input class="form-control" type="hidden" name="apiPrice" id="apiPrice">
                <input class="form-control" type="hidden" name="chargeableRate" id="chargeableRate">
                <input class="form-control" type="hidden" name="base_fare" id="base_fare">
                <input class="form-control" type="hidden" name="tax" id="tax">
                 <input class="form-control" type="hidden" name="booked_ample" id="booked_ample" value="0">
                <span class="inpurroomdata"></span>
                
                <div class="row">
                  <?php 
          $AdultArr=json_decode($hotelSearchData->Cri_Adults,true);
           $AdultArr = explode(',', $AdultArr);

          $ChildArr=json_decode($hotelSearchData->Cri_Childs,true);
           $ChildArr=explode(',', $ChildArr);
           for($r=0;$r<$hotelSearchData->rooms;$r++){ ?>
                   <div class="form-title-wrap col-lg-12">
                    <h3 class="title">Room <?php echo $r+1; ?></h3>
                  </div>
                  <?php for($a=0;$a<1;$a++){   //for($a=0;$a<$AdultArr[$r];$a++){ ?>
                  <div class="form-title-wrap col-lg-12">
                    <h3 class="title">Adult <?php echo $a+1; ?></h3>
                  </div>
                  <!-- form-title-wrap -->
                 {{--  <div class="col-lg-2 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Title <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <div>
                          <select class="select-contain-select" name="passenger[adult][title][<?php echo $r; ?>][]" required>
                            <option value="mr">Mr</option>
                            <option value="mrs">Mrs</option>
                            <option value="miss">Miss</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                  <div class="col-lg-5 responsive-column">
                    <div class="input-box">
                      <label class="label-text">First Name <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="passenger[adult][first_name][<?php echo $r; ?>][]" placeholder="First name" required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-5 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Last Name <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="passenger[adult][last_name][<?php echo $r; ?>][]" placeholder="Last name" required> 
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
               {{--    <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">DOB <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-calendar form-icon"></span>
                        <input class="form-control date-picker-single2" value="{{$DOB}}" type="text" name="passenger[adult][dob][<?php echo $r; ?>][]" readonly required>
                        
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Gender <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <div class=" w-auto">
                          <select class="select-contain-select" name="passenger[adult][gender][<?php echo $r; ?>][]" required>
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                            <option value="other">Other</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                  {{-- <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">ID</label>
                      <div class="form-group"> 
                        <div class="select-contain w-auto">
                          <input class="form-control" type="text" name="passenger[adult][id][<?php echo $r; ?>][]" placeholder="Enter ID" >
                        </div>
                      </div>
                    </div>
                  </div> --}}
                  <?php } ?>





                 {{--  <?php for($a=0;$a<$ChildArr[$r];$a++){ ?>
                  <div class="form-title-wrap col-lg-12">
                    <h3 class="title">Children <?php echo $a+1; ?></h3>
                  </div>
                  <!-- form-title-wrap -->
                  <div class="col-lg-2 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Title <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <div class=" w-auto">
                          <select class="select-contain-select" name="passenger[child][title][<?php echo $r; ?>][]" required>
                            <option value="mr">Mr</option>
                            <option value="mrs">Mrs</option>
                            <option value="miss">Miss</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5 responsive-column">
                    <div class="input-box">
                      <label class="label-text">First Name <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="passenger[child][first_name][<?php echo $r; ?>][]" placeholder="First name" required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-5 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Last Name</label>
                      <div class="form-group"> <span class="la la-user form-icon"></span>
                        <input class="form-control" type="text" name="passenger[child][last_name][<?php echo $r; ?>][]" placeholder="Last name">
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">DOB <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <input class="form-control date-picker-single2" value="{{$DOB}}" type="text" name="passenger[child][dob][<?php echo $r; ?>][]" readonly required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-4 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Gender <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> 
                        <div class=" w-auto">
                          <select class="select-contain-select" name="passenger[child][Gender][<?php echo $r; ?>][]" required>
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                            <option value="other">Other</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                 
                  <?php   //}
          echo "<hr>";
           }?>
                  <div class="col-lg-6 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Your Email <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-envelope-o form-icon"></span>
                        <input class="form-control" type="email" name="passenger[email]" placeholder="Email address" required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-6 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Phone Number <span style="color:#FF0000">*</span> </label>
                      <div class="form-group"> <span class="la la-phone form-icon"></span>
                        <input class="form-control" type="tel" minlength="10" maxlength="15" name="passenger[phone]" placeholder="Phone Number" pattern="[0-9+\-\(\) ]{10,15}" required>

                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-6">
                    <div class="input-box">
                      <label class="label-text">Address Line <span style="color:#FF0000">*</span></label>
                      <div class="form-group"> <span class="la la-map-marked form-icon"></span>
                        <input class="form-control" type="text" name="passenger[address]" placeholder="Address line" required>
                      </div>
                    </div>
                  </div>
                  <!-- end col-lg-12 -->
                  <div class="col-lg-6 responsive-column">
                    <div class="input-box">
                      <label class="label-text">Country <span style="color:#FF0000">*</span></label>
                      <div class="form-group">
                        <div class=" w-auto">
                          <select class="select-contain-select" name="passenger[country]" required>
                            <option value="select-country">Select country</option>
                            {{-- <option value="Afghanistan">Afghanistan</option> --}}
                             @foreach($countryData as $key => $data)
                                      <option value="{{$data->name}}">{{$data->name}}</option>
                                      @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                 
                  <!-- end col-lg-6 --> <?php if(!isset($sessionval['user_id'])){ $sessionval['user_type']=''; } ?>
                @if($sessionval['user_type']=='agent')
                                <input type="hidden" name="payment_type" value="wallet" />
                                @else
                          <div class="col-lg-6 responsive-column" style="display:none">
                                        <div class="input-box">
                                            <label class="label-text">Choose Payment Type</label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
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
                  </div>
                  <!-- end col-lg-12 -->
                </div>
                <button class="theme-btn" onclick="checkTerm()" type="button" >Confirm Booking</button>
        <button style="display:none" class="theme-btn"  id="submit_btn" type="cubmit">Confirm Booking</button>
              </form>
            </div>
            <!-- end contact-form-action -->
          </div>
          <!-- end form-content -->
        </div>
        <!-- end form-box -->
      </div>
      <!-- end col-lg-8 -->
      <div class="col-lg-4">
        <div class="form-box booking-detail-form">
          <div class="form-title-wrap">
            <h3 class="title">Booking Details</h3>
          </div>
          <!-- end form-title-wrap -->
          <div class="form-content">
            <div class="card-item shadow-none radius-none mb-0">
              <div class="card-img pb-4"> <a href="#" class="d-block"> <img src="<?php echo $hotelSearchData->thumbNailUrl; ?>" alt="plane-img"> </a> </div>
              <div class="card-body p-0">
                <div class="d-flex justify-content-between">
                  <div>
                    <h3 class="card-title"><?php echo $hotelSearchData->Name; ?> </h3>
                    <p class="card-meta"><?php echo $hotelSearchData->address1;  ?></p>
                  </div>
                </div>
               
                <div class="section-block"></div>
                <ul class="list-items list-items-2 list-items-flush py-2">
                  <li class="font-size-15"><span class="w-auto d-block mb-n1"><i class="la la-plane mr-1 font-size-17"></i>Check In</span>{{-- <?php echo date('d M  Y  ',strtotime($hotelSearchData->checkin)); ?> --}} {{ \Carbon\Carbon::parse($hotelSearchData->checkin)->format('m-d-Y') }}</li>
                  <li class="font-size-15"><span class="w-auto d-block mb-n1"><i class="la la-plane mr-1 font-size-17"></i>Check Out</span>{{-- <?php echo date('d M  Y  ',strtotime($hotelSearchData->checkout)); ?> --}} {{ \Carbon\Carbon::parse($hotelSearchData->checkout)->format('m-d-Y') }}</li>
                </ul>
                <h3 class="card-title pb-3">Order Details</h3>
                <div class="section-block"></div>
                <ul class="list-items list-items-2 py-3">
                  <li><span>Board Name:</span><?php echo $hotelSearchData->boardName;  ?> </li>
                  <li><span>Payment Type:</span><?php echo $hotelSearchData->paymentType; ?></li>
                  <li>
                 <?php 
              $AdultsArr=json_decode($hotelSearchData->Cri_Adults,true);
               $AdultsArr = explode(',', $AdultsArr);
              $ChildsArr=json_decode($hotelSearchData->Cri_Childs,true);
               $ChildsArr=explode(',', $ChildsArr);
              $ChildAgeArr=json_decode($hotelSearchData->child_age,true);
              for($i=0;$i<$hotelSearchData->rooms;$i++){ ?>
                            <br />
                            <div class="sidebar-widget-item">
                                <div class="qty-box mb-2 d-flex align-items-center justify-content-between">
                                    <label class="font-size-16">Room {{$i+1}}<span></span></label>
                                    <div class="qtyBtn d-flex align-items-center">
                                    </div>
                                </div><!-- end qty-box -->
                            </div>
                            <div class="sidebar-widget-item">
                                <div class="qty-box mb-2 d-flex align-items-center justify-content-between">
                                    <div class=" d-flex align-items-center">
                                        <input class=" form-control" type="text" name="Cri_Adults"  value="Adult(s): <?php echo $AdultsArr[$i]; ?>" readonly>
                                        &nbsp;&nbsp;
                                        <input class=" form-control" type="text" name="Cri_Adults"  value="Children: <?php echo $ChildsArr[$i]; ?>" readonly>
                                        
                                    </div>                                   
                                </div><!-- end qty-box -->
                                 <?php for($c=0;$c<$ChildsArr[$i];$c++){ ?>
                                 <div class="qty-box mb-2 d-flex align-items-center justify-content-between">
                                    <div class=" d-flex align-items-center">
                                        <input class=" form-control" type="text" name="Cri_Adults"  value="Child {{$c+1}} Age : <?php echo $ChildAgeArr[$i][$c]; ?>" readonly>  </div></div>
                    <?php } ?>
                            </div><!-- end sidebar-widget-item -->
                            <?php } ?>
                  </li>
                </ul>
                <div class="section-block"></div>
                <ul class="list-items list-items-2 pt-3 price_details">
                  
                  <li><span>Total Price:</span><span class="total_amount"><?php echo $hotelSearchData->currency." ".$totalPrice*2 ?></span></li>
                </ul>
              </div>

            {{--    @php
               $admin_model_obj = new \App\Models\CommonFunctionModel;
               $toCurrencyRate = $admin_model_obj->getFromToCurrencyRate(1.00,'USD', 'USD');
                $original_single_price = $totalPrice;
                $OfferedPriceRoundedOff = $admin_model_obj->displayFinalRates($totalPrice, $toCurrencyRate);

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
                // $DayRates = isset($hotelDetailsData->DayRates) ? $hotelDetailsData->DayRates : array(); /*Array of Object*/
                // $Price = $hotelDetailsData->Price; /*Object*/
                // $Amenities = $hotelDetailsData->Amenities; /*Array*/
                // $Amenity = $hotelDetailsData->Amenity; /*Array*/
                // $SmokingPreference = $hotelDetailsData->SmokingPreference; /*string*/
                // $BedTypes = $hotelDetailsData->BedTypes; /*Array*/
                // $HotelSupplements = $hotelDetailsData->HotelSupplements; /*Array*/
                // $LastCancellationDate = $hotelDetailsData->LastCancellationDate; /*Date time String Ex: 2020-04-16T23:59:59 */
                // $CancellationPolicies = $hotelDetailsData->CancellationPolicies; /*Array*/
                // $CancellationPolicy = $hotelDetailsData->CancellationPolicy; /*String*/
                // $Inclusion = $hotelDetailsData->Inclusion; /*String*/
               @endphp --}}
              {{--  <br>
              <p>Book and earn amplepoints : {{round($no_of_amples)}}</p> --}}
            </div>
            <!-- end card-item -->












{{-- 
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
              id='itemprice_<?php echo $totalPrice ?>'
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
              id='buyearnamples_<?php echo $totalPrice ?>'
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
              id='useamplestoshop_<?php echo $totalPrice ?>'
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
              <input type='text' onchange="ampleEnterFun(this.value,'<?php echo $totalPrice ?>')"
              id='inputamples_<?php echo $totalPrice ?>'
              name='inputamples'
              class='form-control'>
              <!--<span class='input-group-addon'><i class='fa fa-calendar fa-fw'></i></span>-->
            </div>
          </div>
        </div>
        <div class='col-md-4 col-sm-4 col-xs-4 no-space add-cart-submit btn-b-apply' style="margin-left: 210px;">
          <button class="btn btn-dark" style="width:100%" id='applyamples_<?php echo $totalPrice ?>'
          type='button'
          onclick="applyAmplePoints('<?php echo $totalPrice ?>','<?php echo $single_price; ?>','<?php echo $discount_price; ?>','<?php echo $discount; ?>')">
          APPLY
          </button>
        </div>
        
        <div class='clearfix'></div>
        <div class='grand-total1 text-center'>
          <div class="row">
            <div class='col-md-8 col-sm-8 col-xs-8 no-space'
              id='newpricesection_<?php echo $totalPrice ?>'
              style='display:none;'><span
              style="width: 42%;">New Price : </span>
              <h4 id='newitemprice_<?php echo $totalPrice ?>'
              style="margin: 15px 10px;">&nbsp;
              $<?php echo $single_price; ?></h4>
              <span class='res-collection-sub'
                style='display:none;margin: 12px 0 0 -10px;'
              id="res_collection_sub_<?php echo $totalPrice ?>">FREE</span>
              <input type="hidden"
              id="usernewitemprice_<?php echo $totalPrice ?>"
              value="<?php echo $single_price; ?>"/>
            </div>
            
          </div>
        </div>
        <div class='res-collection-sub1'
          id="res_collection_sub_1_<?php echo $totalPrice ?>">
          <div class='col-md-12 col-sm-12 col-xs-12 no-space'
            id='earnrewardsection_<?php echo $totalPrice ?>'
            style='display:none;'>
            <div class='col-md-5 col-sm-5 col-xs-5 no-space'>
              <label>Earn Reward</label>
            </div>
            <div class='input-group margin-bottom-sm col-md-7 col-sm-7 col-xs-7'>
              <input type='text'
              id='earnrewardamples_<?php echo $totalPrice ?>'
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
                id='earnrewardonitem_<?php echo $totalPrice ?>'
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
                id='youearndiscount_<?php echo $totalPrice ?>'
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
    </div> --}}
    
  </div>



  
          <!-- end form-content -->
        </div>
        <!-- end form-box -->
      </div>
      <!-- end col-lg-4 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
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

   

   //'action=RoomAvailability&pid='+$scope.pid+'&hotelId=' + $scope.hotelId + '&regionid=' + $scope.regionid + '&boardCode='+$scope.boardCode+'&rateClass='+$scope.rateClass+'&roomCodeIds='+$scope.roomCodeIds+'&checkIn=' + $scope.checkIn + '&checkOut=' + $scope.checkOut + '&rooms=' + $scope.rooms + '&adults=' + $scope.adults + '&children=' + $scope.children + '&childAge='+$scope.childage+'&group='+$scope.group+'&language=' + $scope.language + '&isCombo='+$scope.isCombo+'&currency=' + $scope.currency;

   

    RoomAvailability();  
               function RoomAvailability(){  
               $.ajax({ 
                url:'/RoomAvailability',
                type: "GET",
                data: {
                  action: "RoomAvailability",  
                  hotelId: "<?php echo $hotelSearchData->EANHotelID; ?>",
                  regionid: "<?php echo $hotelSearchData->desti_lat_lon; ?>",
                  destination: "<?php echo $hotelSearchData->city; ?>",
                  checkIn: "<?php echo $hotelSearchData->checkin; ?>",  
                  checkOut: "<?php echo $hotelSearchData->checkout; ?>",
                  rooms: "<?php echo $hotelSearchData->rooms; ?>",
                  adults: '<?php echo $hotelSearchData->Cri_Adults; ?>',
                  childs: '<?php echo $hotelSearchData->Cri_Childs; ?>',  
                  boardCode: "<?php  echo $board;  ?>",
                  rateClass: "<?php  echo $rateClass;  ?>",
                  roomCodeIds: "<?php  echo $roomCodeIds;  ?>",
                  search_session: "<?php echo $hotelSearchData->search_session; ?>",
                  tid: "<?php echo $hotelSearchData->id; ?>",
                },
                dataType: "json",
                success: function (response) {
                  // console.log(response.responseData)
                var SelectedRoom=response.responseData.SelectedRoom;
                var innerHtml='';
                // var priceHtml ='';
                var total_price=0;
                var total_apiPrice=0;
                let rateKeys = []; // Array to store rate keys
                for(var i=0;i<SelectedRoom.length;i++){
                  // console.log(SelectedRoom[i].rates)
                   rateKeys.push(SelectedRoom[i].rates.rateKey); 
                  innerHtml +='<ul style="display: none" >';
                  innerHtml +='<input  name="roomPrice[]" value="'+SelectedRoom[i].rates.net+'"/>';
                  innerHtml +='<input name="roomName[]" value="'+SelectedRoom[i].name+'" />';
                  innerHtml +='<input name="rateClass[]" value="'+SelectedRoom[i].rates.rateClass+'" />';
                  innerHtml +='<input name="boardCode[]" value="'+SelectedRoom[i].rates.boardCode+'" />';
                  innerHtml +='<input name="boardName[]" value="'+SelectedRoom[i].rates.boardName+'" />';
                  innerHtml +='<input name="rateType[]" value="'+SelectedRoom[i].rates.rateType+'" />';
                  innerHtml +='<input name="paymentType" value="'+SelectedRoom[i].rates.paymentType+'" />';
                  innerHtml +='<input name="rateCommentsId[]" value="'+SelectedRoom[i].rates.rateCommentsId+'" />';
                innerHtml +='<input name="rateKey[]" value="'+SelectedRoom[i].rates.rateKey+'" />';
                  innerHtml +='</ul>';

                  // priceHtml +='Room: '+parseInt(parseInt(i)+parseInt(1))+'<li><span>Base Fare:</span><span class="base_fare">'+response.currency_symbol+' '+parseFloat(SelectedRoom[i].rates.net)*2+'</span></li>';

                  // total_price=parseFloat(total_price)+parseFloat(SelectedRoom[i].rates.net);

                  // total_apiPrice=parseFloat(total_apiPrice)+parseFloat(SelectedRoom[i].rates.api_price || SelectedRoom[i].rates.net);

                  // console.log(total_price,total_apiPrice)
                  
                }

                // console.log(innerHtml,SelectedRoom.length);
                // priceHtml +='<li id="dpli" style="display:none"><span>Discount Price:</span><span class="discount_amount" id="dp"></span></li>';

                // priceHtml +='<li id="tali1"><span>Total Price:</span><span class="total_amount" id="ta1">'+response.currency_symbol+' '+total_price*2+'</span></li>';

                // priceHtml +='<li id="tali2" style="display:none"><span>Total Price:</span><span class="total_amount2" id="ta2"></span></li>';

                // jQuery('.price_details').html(priceHtml);
                // jQuery('.total_amount').html(response.currency_symbol+' '+total_price.toFixed(2)*2);
                jQuery('.inpurroomdata').html(innerHtml);
                // document.getElementById('currency_main').value=response.currency;
                // document.getElementById('chargeableRate').value=total_price.toFixed(2);
                // document.getElementById('apiPrice').value=total_apiPrice.toFixed(2);
                },
                error: function (error) {
                  console.log(`Error ${error}`);

                }
              });
              }
      });    
      </script>



















<script>
    // $(document).ready(function () {

    //     // $('#open-review-box').click(function () {

    //     //     $("#post-review-box").toggle();
    //     // })
    // })

    function showqyalert() {

        alert("Room Not Available");
    }

    function applyAmplePoints(room_index, single_price, discount_price, discount) {

        var user_total_alample = {{ @Auth::user()->ample ?? 0 }};
        var qty = 1;
        var totalamples = $('#useamplestoshop_' + room_index).val();
        var amplesbyuser = $('#inputamples_' + room_index).val();
        var amplesbyusr = parseFloat(amplesbyuser);
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
  
    var priceHtml ='';
    var total_price=0;
    var total_apiPrice=0;
    var roomArray = @json($roomArray);
    var length = roomArray.length;
     console.log(roomArray,length);

      for (let k = 0; k < length; k++) {
        RoomAvailabilitytwo(k);
    }
   
    
               function RoomAvailabilitytwo(index){ 

               // for(var i=0; i<3;i++){ 
                // alert(1);

               $.ajax({ 
                url:'/RoomAvailability',
                type: "GET",
                data: {
                  action: "RoomAvailability",  
                  hotelId: "<?php echo $hotelSearchData->EANHotelID; ?>",
                  regionid: "<?php echo $hotelSearchData->desti_lat_lon; ?>",
                  destination: "<?php echo $hotelSearchData->city; ?>",
                  checkIn: "<?php echo $hotelSearchData->checkin; ?>",  
                  checkOut: "<?php echo $hotelSearchData->checkout; ?>",
                  rooms: "<?php echo 1; ?>",
                  adults: '<?php echo $hotelSearchData->Cri_Adults; ?>',
                  childs: '<?php echo $hotelSearchData->Cri_Childs; ?>',  
                  boardCode: roomArray[index].board,
                  rateClass: roomArray[index].rateClass,
                  roomCodeIds: roomArray[index].roomCodeIds,
                  search_session: "<?php echo $hotelSearchData->search_session; ?>",
                  tid: "<?php echo $hotelSearchData->id; ?>",
                },
                dataType: "json",
                success: function (response) {
                 
                var SelectedRoom=response.responseData.SelectedRoom;
                
                for(var i=0;i<SelectedRoom.length;i++){
                

                  priceHtml +='Room: '+parseInt(parseInt(index)+parseInt(1))+'<li><span>Base Fare:</span><span class="base_fare">'+response.currency_symbol+' '+parseFloat(SelectedRoom[i].rates.net)*2+'</span></li>';

                  total_price=parseFloat(total_price)+parseFloat(SelectedRoom[i].rates.net);

                  total_apiPrice=parseFloat(total_apiPrice)+parseFloat(SelectedRoom[i].rates.api_price || SelectedRoom[i].rates.net);
                  
                }

                if(index+1==length){
                priceHtml +='<li id="dpli" style="display:none"><span>Discount Price:</span><span class="discount_amount" id="dp"></span></li>';

                priceHtml +='<li id="tali1"><span>Total Price:</span><span class="total_amount" id="ta1">'+response.currency_symbol+' '+total_price*2+'</span></li>';

                priceHtml +='<li id="tali2" style="display:none"><span>Total Price:</span><span class="total_amount2" id="ta2"></span></li>';
              }

                jQuery('.price_details').html(priceHtml);
                jQuery('.total_amount').html(response.currency_symbol+' '+total_price.toFixed(2)*2);
             
                document.getElementById('currency_main').value=response.currency;
                document.getElementById('chargeableRate').value=total_price.toFixed(2);
                document.getElementById('apiPrice').value=total_apiPrice.toFixed(2);
                },
                error: function (error) {
                  console.log(`Error ${error}`);

                }
              });
              }


</script>
@include('site.footer')