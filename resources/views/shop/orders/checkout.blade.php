@extends ('layouts.app')

@section ('content')
    <div class="wrapper fixed__footer">
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Оформление заказа</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="our-checkout-area bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-8">
                        <div class="ckeckout-left-sidebar">
                            <!-- Start Checkbox Area -->
                            <form method="POST" action="{{ route('shop.orders.checkoutForm') }}" id="checkoutForm">
                            @csrf
                                <div class="checkout-form">
                                    @include ('layouts.flash')
                                    <h2 class="section-title-3">Платежные реквизиты</h2>
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">
                                            {{ $error }}
                                        </div>
                                    @endforeach

                                    <div class="checkout-form-inner">
                                        <div class="single-checkout-box">
                                            <input type="text" value="{{ $user->name }}" placeholder="Имя">
                                            <input type="text" value="{{ $user->profile->surname }}" placeholder="Фамилия">
                                        </div>
                                        <div class="single-checkout-box">
                                            <input type="text" value="{{ $user->profile->patronymic }}" placeholder="Отчество">
                                        </div>
                                        <div class="single-checkout-box">
                                            <input type="email" value="{{ $user->email }}" placeholder="Электронная почта">
                                            <input type="text" value="{{ $user->profile->phone }}" placeholder="Телефон">
                                        </div>
                                        <div class="single-checkout-box">
                                            <textarea name="note" id="message" placeholder="Сообщение"></textarea>
                                        </div>
                                        <div class="single-checkout-box select-option mt--40">
                                            <select class="shipping_select" id="region" name="region">
                                                <option class="not_selected" selected>Не выбран</option>
                                                @foreach ($regions as $region)
                                                    <option data-value="{{ $region->id }}" value="{{ $region->id }}">{{ $region->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" value="{{ $user->profile->code }}" placeholder="Почтовый индекс">
                                        </div>
                                        <div class="single-checkout-box">
                                            <h2 class="section-title-3">Способ доставки:</h2>
                                            <br>

                                            <select class="shipping_select" id="delivery" name="delivery">
                                                <option class="not_selected" id="method_none" data-name="none" data-price="0" id="method_none" value="0" selected>Не выбран</option>
                                                @foreach ($deliveryMethods as $method)
                                                    <option id="method_{{ $method->name }}" data-name="{{ $method->name }}" data-price="{{ $method->cost }}" id="method_{{ $method->name }}" value="{{ $method->id }}">{{ $method->name }}: {{ $method->cost }} ₽</option>
                                                @endforeach
                                            </select>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="section-title-3">Ваш заказ:</h2>
                                <br>
                                <div class="table-content table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Товар</th>
                                                <th class="product-price">Цена</th>
                                                <th class="product-quantity">Количество</th>
                                                <th class="product-subtotal">Итоговая цена</th>
                                                <th class="product-subtotal">Общий вес</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cartItems as $cartItem)
                                                <tr>
                                                    <td class="product-name">
                                                        <div class="media">
                                                            <div class="d-flex">
                                                                <img src="{{ $cartItem->product->getImageUrl($cartItem->product->photos()->exists() ? $cartItem->product->photos()->first()->photo : '') }}" alt="" width="60px" height="60px">
                                                            </div>
                                                            <div class="media-body">
                                                                <p>{{ $cartItem->product->title }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="product-price">
                                                        <h5>{{ $cartItem->product->price }} ₽</h5>
                                                    </td>
                                                    <td class="product-quantity">
                                                        <span class="qty">{{ $cartItem->quantity }}</span>
                                                    </td>
                                                    <td class="product-subtotal">
                                                        <h5><span class="price">{{ $cartItem->total_price }}</span> ₽</h5>
                                                    </td>
                                                    <td class="product-subtotal">
                                                        <h5><span class="weight">{{ $cartItem->total_weight }}</span></h5>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="our-payment-sestem">
                                    <h2 class="section-title-3">Итог:</h2>
                                    <br>
                                    <li><a href="javascript:void(0)">Промежуточный итог <span><span id="subtotal">0</span> ₽</span></a></li>
                                    <li><a href="javascript:void(0)">Доставка <span><span id="shipping">0</span> ₽</span></a></li>
                                    <li><a href="javascript:void(0)">Итоговая цена <span><span id="total">0</span> ₽</span></a></li>
                                    <br>
                                    <div class="checkout-btn">
                                        <a class="ts-btn btn-light btn-large hover-theme" href="#" onclick="document.getElementById('checkoutForm').submit()">Подтвердить</a>
                                    </div>
                                    <br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section ('scripts')
    <script>
        let subtotalPrice = 0;

        $('.price').each(function (index, value) {
            subtotalPrice += + $(this).text();
        });

        $("#subtotal").text(subtotalPrice);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            recountTotalPrice();
        });

        $('#delivery').on('change', function (){
            let select = this;
            let optionSelected = $("option:selected", select);
            let price = optionSelected[0].dataset.price;
            $('#shipping').text(price);
            recountTotalPrice();
        })
    </script>

    <script>
        $('.shipping_select').on('change', function () {
            let select = this;
            let optionSelected = $("option:selected", this);
            let regionId = optionSelected.data('value');

            let isReset = $(optionSelected).hasClass('reset');
            let isNotSelected = $(optionSelected).hasClass('not_selected');

            isReset ? isReset = 1 : isReset = 0;

            if (!isNotSelected) {
                $.ajax({
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "url": "/shop/order/region",
                    "method": "POST",
                    "data": {
                        regionId: regionId,
                        isReset: isReset
                    },
                    "success": function (data) {
                        if (data) {
                            $(select).html(data);
                        }
                    }
                });
            }
        });
    </script>

    <script>
        function recountTotalPrice() {
            let subtotalPrice = $("#subtotal").text();
            let deliveryPrice = $("#shipping").text();
            let price = +subtotalPrice +  +deliveryPrice;

            $("#total").text(price);
        }
    </script>
@endsection