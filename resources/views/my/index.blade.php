@extends('layouts.app')

@section('content')
    <section class="htc__product__area ptb--130 bg__white">
        <div class="container">
            <div class="htc__product__container">
                <div class="row">
                    <div class="product__list another-product-style">
                        @if ($user->hasFilledProfile())
                        <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                            <div class="product foo">
                                <div class="product__inner">
                                    <div class="pro__thumb">
                                        <a href="{{ route("orders.index") }}#">
                                            <img src="{{ asset("images/my/box.png") }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="product__details">
                                    <h2><a href="{{ route("orders.index") }}">Мои заказы</a></h2>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                            <div class="product foo">
                                <div class="product__inner">
                                    <div class="pro__thumb">
                                        <a href="{{ route("profile.show") }}">
                                            <img src="{{ asset("images/my/settings.png") }}"">
                                        </a>
                                    </div>
                                </div>
                                <div class="product__details">
                                    <h2><a href="{{ route("profile.show") }}">Управление аккаунтом</a></h2>
                                </div>
                            </div>
                        </div>

                        @hasAccess("platform.index")
                            <div class="col-md-3 single__pro col-lg-3 col-sm-4 col-xs-12 cat--4">
                                <div class="product foo">
                                    <div class="product__inner">
                                        <div class="pro__thumb">
                                            <a href="{{ route("platform.index") }}">
                                                <img src="{{ asset("images/my/admin.png") }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product__details">
                                        <h2><a href="{{ route("platform.index") }}">Панель администратора</a></h2>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                            <div class="product foo">
                                <div class="product__inner">
                                    <div class="pro__thumb">
                                        <a href="{{ route("comparison.index") }}">
                                            <img src="{{ asset("images/my/comp.png") }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="product__details">
                                    <h2><a href="{{ route("comparison.index") }}">Сравнение товаров</a></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                            <div class="product foo">
                                <div class="product__inner">
                                    <div class="pro__thumb">
                                        <a href="{{ route("my.profile.index") }}">
                                            <img src="{{ asset("images/my/profile.png") }}"">
                                        </a>
                                    </div>
                                </div>
                                <div class="product__details">
                                    <h2><a href="{{ route("my.profile.index") }}">Мой профиль</a></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 single__pro col-lg-3 col-sm-4 col-xs-12 cat--4">
                            <div class="product foo">
                                <div class="product__inner">
                                    <div class="pro__thumb">
                                        <a href="{{ route("wishlist.index") }}">
                                            <img src="{{ asset("images/my/wish.png") }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="product__details">
                                    <h2><a href="{{ route("wishlist.index") }}">Список желаний</a></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 single__pro col-lg-3 col-sm-4 col-xs-12 cat--2">
                            <div class="product foo">
                                <div class="product__inner">
                                    <div class="pro__thumb">
                                        <form id="logout_1" method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <a a href="#" onclick="document.getElementById('logout_1').submit()"><img src="{{ asset("images/my/exit.png") }}"></a>
                                        </form>
                                    </div>
                                </div>
                                <div class="product__details">
                                    <form id="logout_2" method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <h2><a href="#" onclick="document.getElementById('logout_2').submit()">Выйти из системы</a></h2>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')

@endsection