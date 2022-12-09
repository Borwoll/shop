@extends ('layouts.app')

@section ('content')
    <div class="wrapper fixed__footer">
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Контакты</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="htc__contact__area ptb--120 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="htc__contact__container">
                            <div class="htc__contact__address">
                                <h2 class="contact__title">Контактная информация</h2>
                                <div class="contact__address__inner">
                                    <div class="single__contact__address">
                                        <div class="contact__icon">
                                            <span class="ti-location-pin"></span>
                                        </div>
                                        <div class="contact__details">
                                            <p>Местоположение : <br> г. Белгород.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="contact__address__inner">
                                    <!-- Start Single Adress -->
                                    <div class="single__contact__address">
                                        <div class="contact__icon">
                                            <span class="ti-mobile"></span>
                                        </div>
                                        <div class="contact__details">
                                            <p> Телефон : <br><a href="#">+000 000 000 000 </a></p>
                                        </div>
                                    </div>
                                    <!-- End Single Adress -->
                                    <!-- Start Single Adress -->
                                    <div class="single__contact__address">
                                        <div class="contact__icon">
                                            <span class="ti-email"></span>
                                        </div>
                                        <div class="contact__details">
                                            <p> Электронная почта :<br><a href="#">info@example.com</a></p>
                                        </div>
                                    </div>
                                    <!-- End Single Adress -->
                                </div>
                            </div>
                            <div class="contact-form-wrap">
                            <div class="contact-title">
                                <h2 class="contact__title">Связаться</h2>
                            </div>
                            @include('layouts.flash')
                            <form id="contact-form" action="{{ route('contact.send') }}" method="POST" id="contactForm">
                                @csrf
                                <div class="single-contact-form">
                                    <div class="contact-box name">
                                        <input type="text" id="name" name="name" placeholder="Введите ваше имя" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" @guest @else value="{{ Auth::guard()->user()->name }}" @endguest>
                                        <input type="email" id="email" name="email" placeholder="Введите адрес электронной почты" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" @guest @else value="{{ Auth::guard()->user()->email }}" @endguest>
                                    </div>
                                </div>
                                <div class="single-contact-form">
                                    <div class="contact-box message">
                                        <textarea name="message" id="message" rows="1" placeholder="Введите сообщение" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'"></textarea>
                                    </div>
                                </div>
                                <div class="contact-btn">
                                    <button type="submit" class="fv-btn">Отправить</button>
                                </div>
                            </form>
                        </div> 
                        <div class="form-output">
                            <p class="form-messege"></p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection