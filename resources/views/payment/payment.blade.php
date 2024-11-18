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



<?php

$baseurl = url('/');

$total_amount = round($orderDetail->chargable_rate);
$order_id = $orderDetail->order_id;
$customer_id = @Auth::user()->id;
$customer_name =  @Auth::user()->first_name;
$customer_email =  @Auth::user()->email;

 //dd($total_amount,$order_id,$customer_id,$customer_name,$customer_email);

?>


{{-- @include('includes.head')
@include('includes.new_head')
@include('includes.header') --}}
<script src="https://js.stripe.com/v3/"></script>
@include('payment.payment_css')

<style>
	.modal-backdrop {
    opacity: 0.5;
    background-color: rgba(0, 0, 0, 0.5); /* Adjust as needed */
}

/* Override Bootstrap's modal fade class */
.fade {
    opacity: 1 !important;
    visibility: visible !important;
}
</style>


    <section>
        <div class="all-start">
            <div class="columns-container">
                <div class="container" id="columns">
                    <div class="row">
                        <div class="center_column col-lg-12">
                            <div class="container" id="wrap">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2 my_frm_cntr">
                                        <div class="reg_frm_container">

                                            <legend>Payment For Hotel Order No: {{ $order_id }}</legend>

                                            @if(isset($message))
                                                <div class="col-xs-12 col-md-12 no_left_padding no_right_padding">
                                                    <div class="alert alert-danger alert-dismissable">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        {{ $message }}
                                                    </div>
                                                </div>
                                            @endif

                                            <div style="margin-bottom: 15px;text-align: center;">
                                                <p><b>Your Total Order Amount: ${{ number_format($total_amount, 2, '.', '') }}</b></p>
                                            </div>
                                             <!--<p>Use any of these test cards to simulate a payment.</p>
                                            <br>
                                            <p><b>Payment succeeds: 4242424242424242</b> </p>
                                            <p><b>Payment requires authentication: 4000002500003155</b></p>
                                            <p><b>Payment is declined: 4000000000009995</b></p>
                                            <hr>-->

                                            <form id="payment-form">
                                                <div id="link-authentication-element">
                                                    <!-- Stripe.js injects the Link Authentication Element -->
                                                </div>
                                                <div id="payment-element">
                                                    <!-- Stripe.js injects the Payment Element -->
                                                </div>
                                                <button id="submit" class="stripe_btn">
                                                    <div class="spinner hidden" id="spinner"></div>
                                                    <span id="button-text">Pay now</span>
                                                </button>
                                                <div id="payment-message" class="hidden"></div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.container -->
                </div>
            </div>
        </div>
    </section>














@include('site.footer')
{{-- @include('includes.script') --}}
{{-- @include('member.payment.payment_script') --}}

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


<script>
    var total_payment_amount = '<?php echo $total_amount; ?>';
    var my_order_id = '<?php echo $order_id; ?>';
    var my_customer_id = '<?php echo $customer_id; ?>';
    var my_customer_name = '<?php echo $customer_name; ?>';

    // This is your test publishable API key.

    const stripe = Stripe("pk_test_51NpOZ4GY4n5u6WbIlWOsccAKTTMLq7xnjfG8fFboidp6jZCx2XlssuBHyNbvBsqfGDkbVkZH2Knka498eIzAjdPZ00YZBjdzik");

    // This is your Live publishable API key.

    // const stripe = Stripe("pk_live_51NpOZ4GY4n5u6WbIpfu1Ysf1rJ7qRurQD9U4lRTgeUPCSy8Crfl0D6bcDSPsRKk2fg5AnZ6vLrlxSnWJUx3OaZHX00O8wy3Qtn");

    // The items the customer wants to buy
    const items = [{id: "xl-tshirt"}];

    let elements;

    initialize();
    checkStatus();

    document.querySelector("#payment-form").addEventListener("submit", handleSubmit);

    let emailAddress = '';

    // Fetches a payment intent and captures the client secret
    async function initialize() {
        const {clientSecret} = await fetch("<?php echo $baseurl; ?>/createstrippayment", {
            method: "POST",
            headers: {"Content-Type": "application/json", 'X-CSRF-TOKEN': "{{csrf_token()}}" },
            body: JSON.stringify({total_amount : total_payment_amount, order_id : my_order_id, customer_id : my_customer_id, customer_name : my_customer_name}),
        }).then((r) => r.json());

        elements = stripe.elements({clientSecret});

        const linkAuthenticationElement = elements.create("linkAuthentication");
        linkAuthenticationElement.mount("#link-authentication-element");

        const paymentElementOptions = {
            layout: "tabs",
        };

        const paymentElement = elements.create("payment", paymentElementOptions);
        paymentElement.mount("#payment-element");
    }

    async function handleSubmit(e) {
        e.preventDefault();
        setLoading(true);

        const {error} = await stripe.confirmPayment({
            elements,
            confirmParams: {
                // Make sure to change this to your payment completion page
                 return_url:"{{route('stripeorderstatus',['order_id' => $order_id, 'customer_id' => $customer_id])}}",
                
                receipt_email: emailAddress,
            },
        });

        // This point will only be reached if there is an immediate error when
        // confirming the payment. Otherwise, your customer will be redirected to
        // your `return_url`. For some payment methods like iDEAL, your customer will
        // be redirected to an intermediate site first to authorize the payment, then
        // redirected to the `return_url`.
        if (error.type === "card_error" || error.type === "validation_error") {
            showMessage(error.message);
        } else {
            showMessage("An unexpected error occurred.");
        }

        setLoading(false);
    }

    // Fetches the payment intent status after payment submission
    async function checkStatus() {
        const clientSecret = new URLSearchParams(window.location.search).get(
            "payment_intent_client_secret"
        );

        if (!clientSecret) {
            return;
        }

        const {paymentIntent} = await stripe.retrievePaymentIntent(clientSecret);

        console.log("Payment Intent : "+paymentIntent.status);

        alert("Payment Intent : "+paymentIntent.status);

        switch (paymentIntent.status) {
            case "succeeded":
                showMessage("Payment succeeded!");
                break;
            case "processing":
                showMessage("Your payment is processing.");
                break;
            case "requires_payment_method":
                showMessage("Your payment was not successful, please try again.");
                break;
            default:
                showMessage("Something went wrong.");
                break;
        }
    }

    // ------- UI helpers -------

    function showMessage(messageText) {
        const messageContainer = document.querySelector("#payment-message");

        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;

        setTimeout(function () {
            messageContainer.classList.add("hidden");
            messageContainer.textContent = "";
        }, 5000);
    }

    // Show a spinner on payment submission
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector("#submit").disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#button-text").classList.add("hidden");
        } else {
            document.querySelector("#submit").disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#button-text").classList.remove("hidden");
        }
    }
</script>
