@extends('theme::layouts.app')

@section('content')
 <!-- checkout area start -->
 <section>
	<div class="checkout-area pt-150 pb-150">
		<form action="{{ route('order.create') }}" method="POST" id="place_order_form">
			@csrf
			<div class="container">
				<div class="row">
					<div class="col-lg-7">
						<div class="checkout-form">
							
							<div class="row">
								<div class="col-lg-12">
									<div class="checkout-header-area">
										<h2><span>1</span> {{ __('Checkout') }}</h2>
									</div>
								</div>
							</div>
							<div class="checkout-main-area">
								@if ($errors->any())
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="name">{{ __('Name') }}</label>
											<input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>{{ __('Phone Number') }}</label>
											<input type="text" name="phone" class="form-control" placeholder="{{ __('Phone Number') }}">
										</div>
									</div>
									<input type="hidden" name="order_type" value="{{ $ordertype }}">
									@if($ordertype == 1)
									<input type="hidden" name="latitude" id="latitude" value="{{ $resturent_info->resturentlocation->latitude }}">
									<input type="hidden" name="longitude" id="longitude" value="{{ $resturent_info->resturentlocation->longitude }}">
									<div class="col-lg-12">
										<div class="form-group">
											<label>{{ __('Delivery Address') }}</label>
											<input type="text" class="form-control location_input" id="location_input" name="delivery_address" autocomplete="off" placeholder="{{ __('Delivery Address') }}">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<div class="map-canvas" id="map-canvas">

											</div>
											<input type="hidden" name="shipping" id="shipping">
										</div>
									</div>
									@endif
									<div class="col-lg-12">
										<div class="form-group">
											<label>{{ __('Order Note') }}</label>
											<textarea name="note" cols="30" rows="6" placeholder="Order Note" class="form-control"></textarea>
										</div>
									</div>
									<input type="hidden" name="total_amount" id="total_amount" value="{{ number_format(str_replace(',', '', Cart::instance('cart_'.Session::get('restaurant_cart')['slug'])->total()),2) }}">
								</div>
							</div>
							<div class="row mt-5">
								<div class="col-lg-12">
									<div class="checkout-header-area">
										<h2><span>2</span> {{ __('Select Payment Gateway') }}</h2>
									</div>
								</div>
							</div>
							<div class="row justify-content-center select_payment">

								@if(env('STRIPE_KEY') != '')
								<div class="col-lg-3 payment_section">
									<label for="stripe" class="single-payment-section stripe text-center mb-30" onclick="select_payment('stripe')">
										<img class="img-fluid" src="{{ theme_asset('khana/public/img/stripe.png') }}" alt="">
									</label>
									<input type="radio" name="payment_method" value="stripe" id="stripe" class="d-none">
								</div>
								@endif
								@if ($credentials != null)
								@if($credentials->paypal_status == 'enabled')
								<div class="col-lg-3 payment_section">
									<label for="paypal" class="single-payment-section paypal text-center mb-30" onclick="select_payment('paypal')">
										<img class="img-fluid" src="{{ theme_asset('khana/public/img/paypal.png') }}" alt="">
									</label>
									<input id="paypal" type="radio" class="d-none" name="payment_method" value="paypal">
								</div>
								@endif

								@if($credentials->toyyibpay_status == 'enabled')
								<div class="col-lg-3 payment_section">
									<label for="toyyibpay" class="single-payment-section toyyibpay text-center mb-30" onclick="select_payment('toyyibpay')">
										<img class="img-fluid" src="{{ theme_asset('khana/public/img/toyyibpay.png') }}" alt="">
									</label>
									<input id="toyyibpay" type="radio" class="d-none" name="payment_method" value="toyyibpay">
								</div>
								@endif

								@if($credentials->razorpay_status == 'enabled')
								<div class="col-lg-3 payment_section">
									<label for="razorpay" class="single-payment-section razorpay text-center mb-30" onclick="select_payment('razorpay')">
										<img class="img-fluid" src="{{ theme_asset('khana/public/img/razorpay-logo.svg') }}" alt="">
									</label>
									<input id="razorpay" type="radio" class="d-none" name="payment_method" value="razorpay">
								</div>
								@endif

								@if($credentials->instamojo_status == 'enabled')
								<div class="col-lg-3 payment_section">
									<label for="instamojo" class="single-payment-section text-center instamojo" onclick="select_payment('instamojo')">
										<img class="img-fluid" src="{{ theme_asset('khana/public/img/logo_instamojo.webp') }}" alt="">
									</label>
									<input id="instamojo" type="radio" class="d-none" name="payment_method" value="instamojo">
								</div>
								@endif
								@endif
								<div class="col-lg-3 payment_section">
									<label for="cod" class="single-payment-section text-center cod" onclick="select_payment('cod')">
										<img class="img-fluid cod" src="{{ theme_asset('khana/public/img/cod.png') }}" alt="">
									</label>
									<input id="cod" type="radio" class="d-none" name="payment_method" value="cod">
								</div>
							</div>
						</div> 
					</div>
					<div class="col-lg-4">
						<div class="checkout-right-area ">
							<div class="order-from text-center">
								<p>{{ __('Your order from') }} {{ Session::get('restaurant_id')['name'] }}</p>
							</div>
							<div class="checkout-cart-items">
								@foreach(Cart::instance('cart_'.Session::get('restaurant_cart')['slug'])->content() as $cart)
								<div class="single-cart-items">
									<div class="cart-left">
										<div class="qty-count">
											<strong>{{ $cart->qty }}</strong><span class="icon">x</span>
											<span class="name">{{ $cart->name }}
										</span>
										</div>
									</div>
									<div class="cart-right">
										<div class="cart-price">
											<span>{{ $currency->value }} {{ number_format($cart->price,2) }}</span>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							<div class="checkout-bottom-area">
								<div class="single-cart-items">
									<div class="cart-left">
										<div class="qty-count">
											<span class="name"><strong>{{ __('Subtotal') }}</strong>
										</span>
										</div>
									</div>
									<div class="cart-right">
										<div class="cart-price">
											<span>{{ $currency->value }} {{ Cart::instance('cart_'.Session::get('restaurant_cart')['slug'])->priceTotal() }}</span>
										</div>
									</div>
								</div>
								@if($ordertype == 1)
								<div class="single-cart-items">
									<div class="cart-left">
										<div class="qty-count">
											<span class="name"><strong>{{ __('Delivery Fee') }}</strong>
										</span>
										</div>
									</div>
									<div class="cart-right">
										<div class="cart-price">
											<span>{{ $currency->value }} </span><span id="delivery_fee"></span>
										</div>
									</div>
								</div>
								@endif
								<div class="single-cart-items">
									<div class="cart-left">
										<div class="qty-count">
											<span class="name"><strong>{{ __('Tax Fee') }}</strong>
										</span>
										</div>
									</div>
									<div class="cart-right">
										<div class="cart-price">
											<span>{{ $currency->value }} {{ Cart::instance('cart_'.Session::get('restaurant_cart')['slug'])->tax() }}</span>
										</div>
									</div>
								</div>
								<div class="single-cart-items">
									<div class="cart-left">
										<div class="qty-count">
											<span class="name"><strong>{{ __('Total(Incl. VAT)') }}</strong>
										</span>
										</div>
									</div>
									<div class="cart-right">
										<div class="cart-price">
											<span>{{ $currency->value }} </span>
											<span id="last_total">{{ Cart::instance('cart_'.Session::get('restaurant_cart')['slug'])->total() }}</span>
										</div>
									</div>
								</div>
								<div class="place-order mt-20">
									<button id="place_order_button">{{ __('Place Order') }}</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>
<!-- checkout area end -->

<input type="hidden" id="stripe_api_key" value="{{ env('STRIPE_KEY') }}">
<input type="hidden" id="currency_value" value="{{ $currency->value }}">
@endsection
@push('js')
 <script>
	 $('#place_order_form').on('submit',function(){
		$('#place_order_button').attr('disabled','');
		$('#place_order_button').html('Please wait....');
	 });
	 	//coupon form submit
		 $('#couponform').on('submit',function(e){
    	e.preventDefault();
    	$.ajaxSetup({
    		headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
    	});
    	$.ajax({
    		type: 'POST',
    		url: this.action,
    		data: new FormData(this),
    		dataType: 'json',
    		contentType: false,
    		cache: false,
    		processData:false,

    		success: function(response){ 
    			if(response.message)
    			{
    				$('#checkout_right').load(' #checkout_right');
    				$('.alert-message-area').fadeIn();
    				$('.ale').html(response.message);
    				$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
    				window.location.reload();
    			}

    			if(response.error)
    			{
    				$('.error-message-area').fadeIn();
    				$('.error-msg').html(response.error);
    				$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
    			}

    		},
    		error: function(xhr, status, error) 
    		{
    			$('.errorarea').show();
    			$.each(xhr.responseJSON.errors, function (key, item) 
    			{
    				Sweet('error',item)
    				$("#errors").html("<li class='text-danger'>"+item+"</li>")
    			});
    			errosresponse(xhr, status, error);
    		}
    	})
    });

$("body").on("contextmenu",function(e){
return false;
});
$(document).keydown(function(e){
if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117)){
return false;
}
if(e.which === 123){
return false;
}
if(e.metaKey){
return false;
}
//document.onkeydown = function(e) {
// "I" key
if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
return false;
}
// "J" key
if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
return false;
}
// "S" key + macOS
if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
return false;
}
if (e.keyCode == 224 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
return false;
}
// "U" key
if (e.ctrlKey && e.keyCode == 85) {
return false;
}
// "F12" key
if (event.keyCode == 123) {
return false;
}
});
</script> 

@if($ordertype == 1)

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('PLACE_KEY') }}&libraries=places&callback=initialize"></script>
<script>
	"use strict";
	if (localStorage.getItem('location') != null) {
		var locs= localStorage.getItem('location');
	}
	else{
		var locs = "{{ $json->full_address }}";
	}
	$('#location_input').val(locs);
	if (localStorage.getItem('lat') !== null) {
		var lati=localStorage.getItem('lat');
		$('#latitude').val(lati)
	}	
	else{
		var lati= {{ $resturent_info->resturentlocation->latitude }};
	}

	if (localStorage.getItem('long') !== null) {
		var longlat=localStorage.getItem('long');
		$('#longitude').val(longlat)
	}
	else{
		var longlat= {{ $resturent_info->resturentlocation->longitude }};

	}


	var resturentlocation="{{ $json->full_address }}";
	var feePerkilo= {{ $km_rate->value }};
	var mapOptions;
	var map;
	var marker;
	var searchBox;
	var city;

	function select_payment(type)
	{
		$('#payment_type').val(type);
	}
</script>
<script src="{{ theme_asset('khana/public/js/checkout/map.js') }}"></script>   
@endif

@endpush

