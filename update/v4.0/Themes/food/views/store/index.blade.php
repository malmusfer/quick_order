@extends('theme::layouts.app')

@section('content')
<!-- restaurants details main area start  -->
<section>
    <div class="resturants-details-area" style="background-image: url('{{ asset($store->preview->content) }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="resturants-content-area">
                        <div class="resturant-logo">
                            <img src="{{ asset($store->avatar) }}" alt="">
                        </div>
                        <div class="resturants-another-iformation">
                            <h4>{{ $store->name }}</h4>
                            @php 
                            $json_info = json_decode($store->info->content);
                            @endphp
                            <p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M18.364 17.364L12 23.728l-6.364-6.364a9 9 0 1 1 12.728 0zM12 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0-2a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg> {{ $json_info->full_address }}</p>
                            <div class="resturants-rating">
                                @for ($i = 0; $i < 5; $i++)
                                @if ($i < $store->avg_ratting->content)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z"/></svg>
                                @else 
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928L12 18.26zm0-2.292l4.247 2.377-.949-4.773 3.573-3.305-4.833-.573L12 5.275l-2.038 4.42-4.833.572 3.573 3.305-.949 4.773L12 15.968z"/></svg>
                                @endif
                                @endfor
                                <span>({{ $store->ratting->content }} {{ __('Reviews') }})</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="resturents-right-side-information">
                        <div class="delivery-time">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M8.365 10L11.2 8H17v2h-5.144L9 12H2v-2h6.365zm.916 5.06l2.925-1.065.684 1.88-2.925 1.064a4.5 4.5 0 1 1-.684-1.88zM5.5 20a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm13 2a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9zm0-2a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zM4 11h6l2.6-1.733.28-1.046 1.932.518-1.922 7.131-1.822-.888.118-.44L9 16l-1-2H4v-3zm12.092-5H20v3h-2.816l1.92 5.276-1.88.684L15.056 9H15v-.152L13.6 5H11V3h4l1.092 3z"/></svg>
                            <p>
                                {{ __('Delivery Time') }}: {{ $store->delivery->content }} {{ __('Min') }}<span>
                                    {{ __('PickUp Time') }} : {{ $store->pickup->content }} {{ __('Min') }}</span>
                            </p>
                        </div>
                        <div class="resturants-open">
                            <select class="form-select" aria-label="Default select example">
                                @foreach ($store->shopday as $value)
                                <option selected><span>{{ $value->day }}: </span> {{ $value->opening }} - {{ $value->close }}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="returants-details">
        <div class="container">
            <div class="row mt-5 mb-5">
                <div class="col-lg-3">
                    <div class="category">
                        <div class="category-header">
                            <h4>{{ __('Categories') }}</h4>
                        </div>
                        <div class="category-body">
                            <div class="category-lists">
                                <nav>
                                    <ul class="categories">
                                       
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="food-lists-area">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M18.901 10a2.999 2.999 0 0 0 4.075 1.113 3.5 3.5 0 0 1-1.975 3.55L21 21h-6v-2a3 3 0 0 0-5.995-.176L9 19v2H3v-6.336a3.5 3.5 0 0 1-1.979-3.553A2.999 2.999 0 0 0 5.098 10h13.803zm-1.865-7a3.5 3.5 0 0 0 4.446 2.86 3.5 3.5 0 0 1-3.29 3.135L18 9H6a3.5 3.5 0 0 1-3.482-3.14A3.5 3.5 0 0 0 6.964 3h10.072z"/></svg> {{ __('Menu') }}</button>
                              <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 8.994A5.99 5.99 0 0 1 8 3h8c3.313 0 6 2.695 6 5.994V21H8c-3.313 0-6-2.695-6-5.994V8.994zM20 19V8.994A4.004 4.004 0 0 0 16 5H8a3.99 3.99 0 0 0-4 3.994v6.012A4.004 4.004 0 0 0 8 19h12zm-6-8h2v2h-2v-2zm-6 0h2v2H8v-2z"/></svg> {{ __('Reviews') }}({{ $store->vendor_reviews->count() }})</button>
                              <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-book" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 8h16V5H4v3zm10 11v-9h-4v9h4zm2 0h4v-9h-4v9zm-8 0v-9H4v9h4zM3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z"/></svg> {{ __('Book A Table') }}</button>
                              <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM11 7h2v2h-2V7zm0 4h2v6h-2v-6z"/></svg> {{ __('Restaturent Info') }}</button>
                            </div>
                          </nav>
                          <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="food-menu-area storeproduct">
                                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="reviews-main-area">
                                    <div class="review-header-area">
                                        <h4>{{ __('ALL Reviews') }}</h4>
                                    </div>
                                    <div class="review-body-area">
                                        @foreach($store->vendor_reviews as $review)
                                        <div class="single-review">
                                            <div class="review-img">
                                                <img src="{{ asset(App\User::find($review->user_id)->avatar) }}" alt="">
                                            </div>
                                            <div class="review-content">
                                                <div class="author-name">
                                                    <h2>{{ App\User::find($review->user_id)->name }}</h2>
                                                </div>
                                                <div class="review-ratings">
                                                    @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $review->comment_meta->star_rate)
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z"/></svg>
                                                    @else 
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928L12 18.26zm0-2.292l4.247 2.377-.949-4.773 3.573-3.305-4.833-.573L12 5.275l-2.038 4.42-4.833.572 3.573 3.305-.949 4.773L12 15.968z"/></svg>
                                                    @endif
                                                    @endfor
                                                </div>
                                                <div class="review-paragraph">
                                                    <p>{{ $review->comment_meta->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-book" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="book-table-area">
                                    <form action="{{ route('book.store',$store->slug) }}" method="POST" id="book_form">
                                        @csrf
                                        <div class="book-header-area">
                                            <h6>{{ __('Book A Table') }}</h6>
                                        </div>
                                        <div class="book-body-area">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="book-header">
                                                        <h6>{{ __('Booking Information') }}</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Number of Guests') }}</label>
                                                        <input type="number" class="form-control" name="number_of_gutes" placeholder="{{ __('Number of Guests') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Date Of Booking') }}</label>
                                                        <input type="date" class="form-control" name="date" placeholder="{{ __('Date Of Booking') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-lg-12">
                                                    <div class="book-header">
                                                        <h6>{{ __('Contact Information') }}</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Name') }}</label>
                                                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Email') }}</label>
                                                        <input type="email" name="email" class="form-control" placeholder="{{ __('Email') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Phone Number') }}</label>
                                                        <input type="number" class="form-control" name="mobile" placeholder="{{ __('Phone Number') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Your Instructions') }}</label>
                                                        <textarea cols="30" name="message" rows="5" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="button-area f-right">
                                                        <button type="submit">{{ __('Submit') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" >
                                <div class="restaturants-area">
                                    <div class="row mt-5">
                                        <div class="col-lg-6">
                                            <div class="restaturant-header-area">
                                                <h4>{{ __('Restaurant Info') }}</h4>
                                            </div>
                                            @php
                                                $data = json_decode($store->info->content);
                                            @endphp
                                            <div class="restaurant-content-area">
                                                <p>{{ $data->description }}</p>
                                                <div class="restaurant-phone-number">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M9.366 10.682a10.556 10.556 0 0 0 3.952 3.952l.884-1.238a1 1 0 0 1 1.294-.296 11.422 11.422 0 0 0 4.583 1.364 1 1 0 0 1 .921.997v4.462a1 1 0 0 1-.898.995c-.53.055-1.064.082-1.602.082C9.94 21 3 14.06 3 5.5c0-.538.027-1.072.082-1.602A1 1 0 0 1 4.077 3h4.462a1 1 0 0 1 .997.921A11.422 11.422 0 0 0 10.9 8.504a1 1 0 0 1-.296 1.294l-1.238.884zm-2.522-.657l1.9-1.357A13.41 13.41 0 0 1 7.647 5H5.01c-.006.166-.009.333-.009.5C5 12.956 11.044 19 18.5 19c.167 0 .334-.003.5-.01v-2.637a13.41 13.41 0 0 1-3.668-1.097l-1.357 1.9a12.442 12.442 0 0 1-1.588-.75l-.058-.033a12.556 12.556 0 0 1-4.702-4.702l-.033-.058a12.442 12.442 0 0 1-.75-1.588z"/></svg> {{ $data->phone1 }}, {{ $data->phone2 }}
                                                </div>
                                                <div class="restaurant-email-number">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm17 4.238l-7.928 7.1L4 7.216V19h16V7.238zM4.511 5l7.55 6.662L19.502 5H4.511z"/></svg> {{ $data->email1 }} <br>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm17 4.238l-7.928 7.1L4 7.216V19h16V7.238zM4.511 5l7.55 6.662L19.502 5H4.511z"/></svg> {{ $data->email2 }} 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="google-map">
                                                <iframe class="map-size b-0" src="https://maps.google.com/maps?q={{ $store->location->latitude }},{{ $store->location->longitude }}&amp;output=embed" allowfullscreen=""></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                          </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="main_cart">
                        <div class="cart">
                            <div class="cart-title text-center">
                                <h5>{{ __('Your order') }} {{ $store->name }}</h5>
                            </div>
                            <form action="{{ route('checkout.index') }}" class="cartform">
                                <div class="cart-body">
                                    <div class="delivery-toogle-action text-center">
                                        <span class="delivery-title">{{ __('Delivery') }}</span>
                                        <div class="form-switch">
                                            <input class="form-check-input" type="checkbox" name="delivery_type" value="0" id="flexSwitchCheckChecked">
                                            <input type="hidden" id="pickup_price" value="{{ $store->pickup->content }}">
                                            <input type="hidden" id="delivery_price" value="{{ $store->delivery->content }}">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">{{ __('PickUp') }}</label>
                                        </div>
                                    </div>
                                    <div class="pickup-time text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M8.965 18a3.5 3.5 0 0 1-6.93 0H1V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2h3l3 4.056V18h-2.035a3.5 3.5 0 0 1-6.93 0h-5.07zM15 7H3v8.05a3.5 3.5 0 0 1 5.663.95h5.674c.168-.353.393-.674.663-.95V7zm2 6h4v-.285L18.992 10H17v3zm.5 6a1.5 1.5 0 1 0 0-3.001 1.5 1.5 0 0 0 0 3.001zM7 17.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/></svg> <span>21 {{ __('Min') }}</span>
                                    </div>
                                    <div class="cart-item">
                                        @foreach(Cart::instance('cart_'.$store->slug)->content() as $cart)
                                        <div class="single-item">
                                            <div class="item-title">
                                                <h5>{{ $cart->name }}</h5>
                                                <p>{{ $cart->options->type }}</p>
                                            </div>
                                            <div class="item-right-side">
                                                <div class="item-price">
                                                    <p>{{ $currency_name }} {{ number_format($cart->price,2) }}</p>
                                                </div>
                                                <div class="item-increase">
                                                    @if($cart->qty > 1)
                                                    <a href="javascript:void(0)" class="first" onclick="limit_minus('{{ $cart->rowId }}','{{ $store->slug }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-5-9h10v2H7v-2z"/></svg>
                                                    </a>
                                                    @else 
                                                    <a href="javascript:void(0)" class="first" onclick="delete_cart('{{ $cart->rowId }}','{{ $store->slug }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M17 6h5v2h-2v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8H2V6h5V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3zm1 2H6v12h12V8zm-9 3h2v6H9v-6zm4 0h2v6h-2v-6zM9 4v2h6V4H9z"/></svg>
                                                    </a>
                                                    @endif
                                                    <input type="hidden" id="total_limit{{ $cart->rowId }}" value="{{ $cart->qty }}">
                                                    <span class="count-qty">{{ $cart->qty }}</span>
                                                    <a href="javascript:void(0)" class="last" onclick="limit_plus('{{ $cart->rowId }}','{{ $store->slug }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M11 11V7h2v4h4v2h-4v4h-2v-4H7v-2h4zm1 11C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/></svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="cart-subtotal">
                                        <h4>{{ __('Subtotal') }}:</h4>
                                        <p>{{ $currency_name }}: {{ Cart::subtotal() }}</p>
                                    </div>
                                    <div class="cart-checkout">
                                        <button type="submit">Checkout</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="resturantinfo_url" value="{{ route('store.resturantinfo') }}">
<input type="hidden" id="store_url" value="{{ route('store_data',$store->slug) }}">
<input type="hidden" id="addon_url" value="{{ route('addon_product') }}">
<input type="hidden" id="store_slug" value="{{ $store->slug }}">
<input type="hidden" id="add_to_cart_url" value="{{ route('add_to_cart') }}">
<input type="hidden" id="cart_update" value="{{ route('cart.update') }}">
<input type="hidden" id="cart_delete" value="{{ route('cart.delete') }}">
<!-- restaurants details main area end -->
@endsection

@push('js')
    <script src="{{ theme_asset('food/public/js/store/store.js') }}"></script>
@endpush