<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Интернет магазин</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset("images/favicon.ico") }}">
    
    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/owl.carousel.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/owl.theme.default.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/core.css") }}">
    <link rel="stylesheet" href="{{ asset("css/shortcode/shortcodes.css") }}">
    <link rel="stylesheet" href="{{ asset("style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/responsive.css") }}">
    <link rel="stylesheet" href="{{ asset("css/custom.css") }}">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    @yield('links')

    <script src="{{ asset("js/vendor/modernizr-2.8.3.min.js") }}"></script>
    @yield('header_scripts')
</head>

<body>
    <div class="wrapper fixed__footer">
        <header id="header" class="htc-header">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                            <div class="logo">
                                <a href="{{ route("home") }}">
                                    <img src="{{ asset("images/logo/logo.png") }}" alt="logo">
                                </a>
                            </div>
                        </div>
                        <!-- Start MAinmenu Ares -->
                        <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                            <nav class="mainmenu__nav hidden-xs hidden-sm">
                                <ul class="main__menu">
                                    <li><a href="{{ route('home') }}">Главная</a></li>
                                    <li><a href="{{ route('blog.posts.all') }}">Блог</a></li>
                                    <li><a href="{{ route('shop.products.index') }}">Магазин</a></li>
                                    <li><a href="{{ route('contact') }}">Контакты</a></li>
                                </ul>
                            </nav>
                            <div class="mobile-menu clearfix visible-xs visible-sm">
                                <nav id="mobile_dropdown">
                                    <ul>
                                        <li><a href="{{ route('home') }}">Главная</a></li>
                                        <li><a href="{{ route('blog.posts.all') }}">Блог</a></li>
                                        <li><a href="{{ route('shop.products.index') }}">Магазин</a></li>
                                        <li><a href="{{ route('contact') }}">Контакты</a></li>
                                    </ul>
                                </nav>
                            </div>                          
                        </div>
                        <!-- End MAinmenu Ares -->
                        <div class="col-md-2 col-sm-4 col-xs-3">  
                            <ul class="menu-extra">
                                <li><a href="{{ route('shop.products.search') }}"><span class="ti-search"></span></a></li>
                                @auth
                                    <li><a href="{{ route('my') }}"><span class="ti-user"></span></a></li>
                                @else
                                    <li><a href="{{ route('login') }}"><span class="ti-user"></span></a></li>                             
                                @endauth
                                <li><a href="{{ route('shop.cart.index') }}"><span class="ti-shopping-cart"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
            
        @yield('content')
        
        <footer class="htc__foooter__area gray-bg">
            <div class="container">
                <div class="row">
                    <div class="footer__container clearfix">
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="ft__widget">
                                <div class="ft__logo">
                                    <a href="index.html">
                                        <img src="{{ asset("images/logo/logo.png") }}" alt="footer logo">
                                    </a>
                                </div>
                                <div class="footer-address">
                                    <ul>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-pin"></i>
                                            </div>
                                            <div class="address-text">
                                                <p>Адрес</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-email"></i>
                                            </div>
                                            <div class="address-text">
                                                <a href="#">Адрес электронной почты</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-phone-in-talk"></i>
                                            </div>
                                            <div class="address-text">
                                                <p>Номер телефона</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-2 col-sm-6 smt-30 xmt-30">
                            <div class="ft__widget">
                                <h2 class="ft__title">Информация</h2>
                                <ul class="footer-categories">
                                    <li><a href="{{ route('contact') }}">О нас</a></li>
                                    <li><a href="{{ route('contact') }}">Связаться с нами</a></li>
                                    <li><a href="{{ route('terms.show') }}">Правила и условия</a></li>
                                    <li><a href="{{ route('policy.show') }}">Политика конфиденциальности</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-lg-offset-1 col-sm-6 smt-30 xmt-30">
                            <div class="ft__widget">
                                <h2 class="ft__title">Новости</h2>
                                <div class="newsletter__form">
                                    <p>Подпишитесь на нашу рассылку новостей и получите скидку 10% на свою первую покупку.</p>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="htc__copyright__area">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="copyright__inner">
                                <div class="copyright">
                                    <p>© 2022 <a href="#">Shop.test</a>
                                    Все права защищены.</p>
                                </div>
                                <ul class="footer__menu">
                                    <li><a href="{{ route("home") }}">Главная</a></li>
                                    <li><a href="{{ route("shop.products.index") }}">Товары</a></li>
                                    <li><a href="{{ route("contact") }}">Связаться с нами</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div id="quickview-wrapper">
        @yield('modals')
    </div>

    <script src="{{ asset("js/vendor/jquery-1.12.0.min.js") }}"></script>
    <script src="{{ asset("js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("js/plugins.js") }}"></script>
    <script src="{{ asset("js/slick.min.js") }}"></script>
    <script src="{{ asset("js/owl.carousel.min.js") }}"></script>
    <script src="{{ asset("js/waypoints.min.js") }}"></script>
    <script src="{{ asset("js/main.js") }}"></script>
    @yield('scripts')
</body>
</html>