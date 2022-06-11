<footer id="food_footer">
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-menu">
                        <div class="footer-menu-header">
                            <h5>{{ __('Quick Links') }}</h5>
                        </div>
                        <nav>
                            <ul>
                                {{ Menu('Footer First','','','','right',true) }}
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-menu">
                        <div class="footer-menu-header">
                            <h5>{{ __('Categories') }}</h5>
                        </div>
                        <nav>
                            <ul>
                                {{ Menu('Footer Second','','','','right',true) }}
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-menu">
                        <div class="footer-menu-header">
                            <h5 id="footer_contact_title">{{ content('food_footer','footer_contact_title') }}</h5>
                        </div>
                        <nav>
                            <ul>
                                <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M17.084 15.812a7 7 0 1 0-10.168 0A5.996 5.996 0 0 1 12 13a5.996 5.996 0 0 1 5.084 2.812zM12 23.728l-6.364-6.364a9 9 0 1 1 12.728 0L12 23.728zM12 12a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg> <span id="footer_address">{{ content('food_footer','footer_address') }}</span>
                                </li>
                                <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M9.366 10.682a10.556 10.556 0 0 0 3.952 3.952l.884-1.238a1 1 0 0 1 1.294-.296 11.422 11.422 0 0 0 4.583 1.364 1 1 0 0 1 .921.997v4.462a1 1 0 0 1-.898.995c-.53.055-1.064.082-1.602.082C9.94 21 3 14.06 3 5.5c0-.538.027-1.072.082-1.602A1 1 0 0 1 4.077 3h4.462a1 1 0 0 1 .997.921A11.422 11.422 0 0 0 10.9 8.504a1 1 0 0 1-.296 1.294l-1.238.884zm-2.522-.657l1.9-1.357A13.41 13.41 0 0 1 7.647 5H5.01c-.006.166-.009.333-.009.5C5 12.956 11.044 19 18.5 19c.167 0 .334-.003.5-.01v-2.637a13.41 13.41 0 0 1-3.668-1.097l-1.357 1.9a12.442 12.442 0 0 1-1.588-.75l-.058-.033a12.556 12.556 0 0 1-4.702-4.702l-.033-.058a12.442 12.442 0 0 1-.75-1.588z"/></svg> <span id="footer_phone_number">{{ content('food_footer','footer_phone_number') }}</span></li>
                                <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm17 4.238l-7.928 7.1L4 7.216V19h16V7.238zM4.511 5l7.55 6.662L19.502 5H4.511z"/></svg> <span id="footer_email_address">{{ content('food_footer','footer_email_address') }}</span></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3">
                    
                    <div class="follow-area">
                        <div class="follow-header-title">
                            <h5 id="footer_social_title">{{ content('food_footer','footer_social_title') }}</h5>
                        </div>
                        <div class="follow-body">
                            <nav>
                                <ul>
                                    <li><a id="first_icon_link" href="{{ content('food_footer','first_icon_link','social_first_icon') }}"><img id="first_icon" src="{{ content('food_footer','first_icon','social_first_icon') }}" alt=""></a></li>
                                    <li><a href="#"><img id="second_icon" src="{{ content('food_footer','second_icon','social_second_icon') }}" alt=""></a></li>
                                    <li><a href="#"><img id="third_icon" src="{{ content('food_footer','third_icon','social_third_icon') }}" alt=""></a></li>
                                    <li><a href="#"><img id="four_icon" src="{{ content('food_footer','four_icon','social_four_icon') }}" alt=""></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center footer-bottom">
                <div class="col-lg-6">
                    <div class="footer-bottom-area">
                        <div class="payement-icon">
                            <img id="footer_payment_img" src="{{ content('food_footer','footer_payment_img') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-right-area f-right">
                        <p id="footer_copyright">{{ content('food_footer','footer_copyright') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>