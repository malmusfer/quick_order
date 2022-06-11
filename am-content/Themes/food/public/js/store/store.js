
(function($) {
	"use strict";
	$(window).on('load',function(){
		var url = $('#store_url').val();
		var store_slug = $('#store_slug').val();
		$.ajax({
			url: url,
			data: null,
			type: "GET",
			dataType: "HTML",
			beforeSend: function() {

			},
			success: function(response) {
				let storeproduct = '';
				$.each(JSON.parse(response), function( key, value ) {
					storeproduct += `<div class="single-food-menu" id="${value.slug}">
					<div class="food-menu-header">
						<h5>${value.name}</h5>
						<br>
					</div>
					<div class="food-menu-body">
						<div class="row">`;
							$.each(value.products, function( index, item ) { 
								storeproduct += `<div class="col-lg-4 mb-30">
								<div class="single-food" onclick="product_add_to_cart('${item.slug}','${store_slug}')">
									<div class="food-img">
										<img class="img-fluid" src="${item.preview.content}" alt="">
									</div>
									<div class="food-title-des">
										<h5>${item.title}</h5>
										<p>${item.excerpt.content}
										</p>
									</div>
									<div class="food-price-btn">
										<div class="food-price">
											<span>USD ${item.price.price.toFixed(2)}</span>
										</div>
										<div class="add-to-cart">
											<a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path d="M11 11V7h2v4h4v2h-4v4h-2v-4H7v-2h4zm1 11C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"></path></svg></a>
										</div>
									</div>
								</div>
							</div>`;
							}) 

						storeproduct += `</div>
					</div>
				</div>`;
				});
				$(".storeproduct").html(storeproduct);

				let categories = '';
				$.each(JSON.parse(response), function( key, value ) {
					categories += `<li><a href="#${value.slug}">${value.name}</a></li>`; 
				});
				$(".categories").html(categories);
			}
		});
	});

	$('#book_form').on('submit',function(e){
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
			beforeSend: function()
			{
				$('#book_submit').html('Please Wait...');
			},
			success: function(response){ 

				if(response.errors)
				{
					$('.error-message-area').fadeIn();
					$('.error-msg').html(response.errors);
					$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
					$('#book_submit').html('Submit');
				}

				if(response == 'ok')
				{
					$('.alert-message-area').fadeIn();
					$('.ale').html('Your booking request successfully sent');
					$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
					$('#book_submit').html('Submit');
					document.getElementById('book_form').reset();
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



})(jQuery);

function restaurantsinfo(slug)
{
	if(!$('*').hasClass('restaurantsinfo_open')){
		var url = $('#resturantinfo_url').val();
		$.ajax({
			url: url,
			data: {slug:slug},
			type: "GET",
			dataType: "HTML",
			beforeSend: function() {
				$('#info').html('<div class="loader-main-area"><div class="loader-area"><div class="loader"></div></div></div>');
			},
			success: function(response) {
				$('#info').html(response);
			}
		});
	}
}





