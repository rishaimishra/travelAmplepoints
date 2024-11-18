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

         @endphp

                

                <section class="card-area section--padding">

  <div class="container">

                    <div class="row">

      <div class="col-lg-3"> </div>

      <!-- end col-lg-12 -->

      <div class="col-lg-6">

        <div class="form-content">

        <h1 class="loading">Loading...</h1>

          <div style="display:none" class="paymentForm contact-form-action">

           <form id="payment-form" action="<?php echo url('') ?>/travel/payment/Braintree/payment-confirmation.php" method="post">

              <!-- Putting the empty container you plan to pass to

      `braintree.dropin.create` inside a form will make layout and flow

      easier to manage -->

              <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />

              <input type="hidden" name="amount" value="<?php echo $amount; ?>" />

              <input type="hidden" name="confirmation_page" value="<?php echo url('') ?>/transfers-confirmation" />

              <input type="hidden" name="book_url" value="<?php echo url('') ?>/book-transfers" />

              

              <div id="dropin-container"></div>

              <input style="float:right"  class="theme-btn" type="submit" value="SUBMIT" />

              <input type="hidden" id="nonce" name="payment_method_nonce"/>

            </form>

          </div>

        </div>

      </div>

      <!-- end col-lg-12 -->

      <div class="col-lg-3"> </div>

      <!-- end col-lg-12 -->

    </div>

                    <!-- end row -->

                  </div>

  <!-- end container -->

</section>

                <head>

                <meta charset="utf-8">

                <script src="https://js.braintreegateway.com/web/dropin/1.32.1/js/dropin.min.js"></script>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                <script src="https://www.abengines.com/javascript/iframeConsoleUI.min.js"/>

                </script>

                <script type="text/javascript">

				//jQuery(".preloader").hide();

    // call braintree.dropin.create code here

	const form = document.getElementById('payment-form');

	var authorization_token='';

					jQuery.ajax({

                        url:'<?php url(''); ?>/travel/payment/Braintree/payment-create-token.php?action=Braintree',

                        method:'GET',

                        success:function(response){	 

											

							braintree.dropin.create({ 

							  authorization: response, //'CLIENT_AUTHORIZATION',

							  container: '#dropin-container'

							}).then((dropinInstance) => {

							jQuery('.loading').hide();	 jQuery('.paymentForm').show();	

							  form.addEventListener('submit', (event) => {

								event.preventDefault();

							

								dropinInstance.requestPaymentMethod().then((payload) => {

								  // Step four: when the user is ready to complete their

								  //   transaction, use the dropinInstance to get a payment

								  //   method nonce for the user's selected payment method, then add

								  //   it a the hidden field before submitting the complete form to

								  //   a server-side integration

								  document.getElementById('nonce').value = payload.nonce;

								  

								  form.submit();

								}).catch((error) => { throw error; });

							  });

							}).catch((error) => {

							  // handle errors

							});

							

							}

                    });

	

  </script>

@include('site.footer') 