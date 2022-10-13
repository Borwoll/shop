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
                            <li role="presentation" class="login"><a href="{{ route('login') }}">Авторизация</a></li>
                            <li role="presentation" class="register active"><a href="#register" role="tab" data-toggle="tab">Регистрация</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Start Login Register Content -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="htc__login__register__wrap">
                            <div id="register" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                                <form class="login" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Имя') }}">
                                    <input id="email" type="email" name="email" :value="old('email')" required placeholder="{{ __('Адрес электронной почты') }}">
                                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="{{ __('Пароль') }}">
                                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Подтвердите пароль') }}">

                                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                        <input type="checkbox" name="terms" id="terms">
                                        <span>{!! __('Я согласен с :terms_of_service и :privacy_policy', [
                                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Условиями предоставления услуг').'</a>',
                                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Политикой конфиденциальности').'</a>',
                                        ]) !!}</span>
                                    @endif
                                    <div class="htc__login__btn">
                                        <button type="submit" value="submit">Зарегистрироваться</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection