<header id="food_header">
    <div class="header-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <div class="logo-img">
                        <a href="{{ url('/') }}"><img id="logo" src="{{ asset(content('food_header','logo')) }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="login-btn f-right">
                        <a href="{{ url('user/register') }}" id="header_btn_txt">{{ content('food_header','header_btn_txt') }}</a>
                    </div>
                    @if(Session::has('restaurant_cart'))
                    <div class="count_load">
                        <div class="cart-section f-right">
                            <a href="{{ route('store.show',Session::get('restaurant_cart')['slug']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                              </svg>
                            </a>
                            @if(Session::has('restaurant_cart'))
                            @if(Request::is('store/'.Session::get('restaurant_cart')['slug']) || Request::is('/') || Request::is('area*') || Request::is('checkout'))
                            <span class="count">{{ Cart::instance('cart_'.Session::get('restaurant_cart')['slug'])->count() }}</span>
                            @else 
                            <span class="count">00</span>
                            @endif
                            @else 
                            <span class="count">00</span>
                            @endif
                        </div>
                    </div>
                    @else 
                    <div class="count_load">
                        <div class="cart-section f-right">
                            <a href="javascript:void(0)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                              </svg>
                            </a>
                            <span class="count count_load">00</span>
                        </div>
                    </div>
                    @endif 
                    <div class="header-menu f-right">
                        <div class="mobile-menu">
                            <a class="toggle f-right" href="#" role="button" aria-controls="hc-nav-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"/></svg>
                            </a>
                        </div>
                        <nav id="main-nav">
                            <ul>
                                <li></li>
                                {{ Menu('Header','submenu','','','right',true) }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>