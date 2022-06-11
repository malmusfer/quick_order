@extends('theme::layouts.app')

@section('content')
    <!-- slider area start -->
    <section id="food_hero"> 
        <div class="slider-area" id="bg_img" style="background-image: url('{{ asset(content('food_hero','bg_img')) }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="slider-content">
                            <div class="slider-main-area">
                                <form action="{{ route('resturents.search') }}" id="searchform">
                                    <h3 id="hero_title">{{ content('food_hero','hero_title') }}</h3>
                                    <div class="slider-address-filed">
                                        <div class="slider-input">
                                            <input type="hidden" id="lat" name="lat" required="">
                                            <input type="hidden" id="long" name="long" required="">
                                            <input type="hidden" id="city" name="city" required="">
                                            <input type="text" placeholder="{{ __('Enter Delivery Address') }}" class="form-control" id="location_input" name="address" required="">
                                            <div class="location-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                                  </svg>
                                            </div>
                                            <div class="current-location-icon">
                                                <a href="javascript:void(0)" id="locationIcon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="ic-locate-me-round" width="24" height="24"><defs><path id="a" d="M11.5 18a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM12 4v2.019A6.501 6.501 0 0 1 17.981 12H20v1h-2.019a6.501 6.501 0 0 1-5.98 5.981L12 21h-1v-2.019a6.501 6.501 0 0 1-5.981-5.98L3 13v-1h2.019A6.501 6.501 0 0 1 11 6.02V4h1zm-.5 11a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm0 1a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7zm0-2.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path></defs><use fill="#ff3252" xlink:href="#a"></use></svg>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="slider-button">
                                            <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                              </svg> <span id="hero_btn">{{ content('food_hero','hero_btn') }}</span></button>
                                        </div>
    
                                    </div>
                                    <div class="slider-des">
                                        <p id="hero_des">{{ content('food_hero','hero_des') }}</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider area end -->

    @php
    $categories=\App\Category::where('type',2)->select('name','slug','avatar')->inRandomOrder()->take(20)->get();
    @endphp
    <!-- category area start -->
    <section id="food_category">
        <div class="category-area pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="category-title">
                            <h3 id="category_title">{{ content('food_category','category_title') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($categories as $value)
                    <div class="col-lg-3 mb-30">
                        <a href="{{ route('category',$value->slug) }}">
                            <div class="single-category text-center">
                                <img src="{{ asset(imagesize($value->avatar,'medium')) }}" alt="{{ $value->name }}">
                                <div class="category-name">
                                    <h4>{{ $value->name }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- category area end -->

    @if(count($features_resturent) > 0)
    <!-- polpular restaurants area start -->
    <section id="featured_restaturents">
        <div class="popular-restaurants mt-150 mb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="restaurants-header-content text-center">
                            <h2 id="featured_title">{{ content('featured_restaturents','featured_title') }}</h2>
                            <p id="featured_des">{{ content('featured_restaturents','featured_des') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    @foreach ($features_resturent as $value)
                    <div class="col-lg-6 mb-30">
                        <div class="single-restaturants">
                            <div class="restaturants-img">
                                <a href="{{ route('store.show',$value['slug']) }}"><img class="img-fluid" src="{{ asset($value['avatar']) }}" alt="{{ $value['name'] }}"></a>
                            </div>
                            <div class="restaturants-content">
                                <a href="{{ route('store.show',$value['slug']) }}"><h2>{{ $value['name'] }}</h2></a>
                                <p><strong>{{ __('Location') }}: </strong>{{ $value['city']['title'] }}</p>
                                <div class="restaturants-middle-area">
                                    <div class="restaturants-price">
                                        <p>{{ $value['time'] }} {{ __('Min') }}</p>
                                    </div>
                                    <div class="restaturants-icon">
                                        <div class="delivery-icon">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Delivery Time: {{ $value['time'] }} {{ __('Min') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M8.365 10L11.2 8H17v2h-5.144L9 12H2v-2h6.365zm.916 5.06l2.925-1.065.684 1.88-2.925 1.064a4.5 4.5 0 1 1-.684-1.88zM5.5 20a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm13 2a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9zm0-2a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zM4 11h6l2.6-1.733.28-1.046 1.932.518-1.922 7.131-1.822-.888.118-.44L9 16l-1-2H4v-3zm12.092-5H20v3h-2.816l1.92 5.276-1.88.684L15.056 9H15v-.152L13.6 5H11V3h4l1.092 3z"/></svg></a>
                                        </div>
                                        <div class="pickup-icon">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="PickUp Time: {{ $value['pickup'] }} {{ __('Min') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8h4v2h-6V7h2v5z"/></svg></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="restaturants-bottom-area">
                                    <div class="rating-area">
                                        @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $value['avg_ratting'])
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z"/></svg>
                                        @else 
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928L12 18.26zm0-2.292l4.247 2.377-.949-4.773 3.573-3.305-4.833-.573L12 5.275l-2.038 4.42-4.833.572 3.573 3.305-.949 4.773L12 15.968z"/></svg>
                                        @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- polpular restaurants area end -->
    @endif
    
    @if (count($locations) > 0)
    <!-- location area start -->
    <section id="location">
        <div class="location-area pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="location-header-title text-center">
                            <h4 id="location_title">{{ content('location','location_title') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    @foreach ($locations as $location)
                    <div class="col-lg-3 mb-30">
                        <a href="{{ route('area',$location['slug']) }}">
                            <div class="single-city text-center">
                                <div class="city-img">
                                    <img class="img-fluid" src="{{ asset($location['preview']) }}" alt="">
                                </div>
                                <div class="city-content">
                                    <h3>{{ $location['title'] }}</h3>
                                </div>
                            </div>
                        </a>
                    </div> 
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- location area end -->
    @endif

    <!-- partnership area strart -->
    <section id="partnership">
        <div class="partnership-area mb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="partnership-header-area text-center">
                            <h3 id="partnership_title">{{ content('partnership','partnership_title') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-6">
                        <div class="single-partnership">
                            <img id="partnership_left_img" src="{{ content('partnership','partnership_left_img') }}" alt="">
                            <div class="partner-bottom-area">
                                <h4 id="partnership_left_title">{{ content('partnership','partnership_left_title') }}</h4>
                                <a href="{{ url('rider/register') }}">{{ __('Register Now') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single-partnership">
                            <img id="partnership_right_img" src="{{ content('partnership','partnership_right_img') }}" alt="">
                            <div class="partner-bottom-area">
                                <h4 id="partnership_right_title">{{ content('partnership','partnership_right_title') }}</h4>
                                <a href="{{ url('restaurant/register') }}">{{ __('Register Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- partnership area end -->
@endsection

@push('js')
    <script defer src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en&key={{ env('PLACE_KEY') }}"></script>
    <script src="{{ theme_asset('food/public/js/store/home.js') }}"></script>
    <script src="{{ theme_asset('khana/public/js/jquery.unveil.js') }}"></script>
@endpush