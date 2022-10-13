@extends('layouts.app')

@section('content')
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">login & Register</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active">login & Register</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="htc__login__register bg__white ptb--130">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <ul class="login__register__menu" role="tablist">
                            <li role="presentation" class="login active"><a href="#login" role="tab" data-toggle="tab">Авторизация</a></li>
                            <li role="presentation" class="register"><a href="{{ route('register') }}">Регистрация</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="htc__login__register__wrap">
                            <div id="login" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                                <form class="login" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <input id="email" type="text" name="email" :value="old('email')" required autofocus placeholder="Адрес электронной почты">
                                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Пароль">

                                    <div class="tabs__checkbox">
                                        <input type="checkbox" id="remember_me" name="remember">
                                        <span>Запомнить меня</span>
                                        <span class="forget"><a href="{{ route('password.request') }}"">Забыли свой пароль?</a></span>
                                    </div>
                                    <div class="htc__login__btn mt--30">
                                        <button type="submit" value="submit">Авторизоваться</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection