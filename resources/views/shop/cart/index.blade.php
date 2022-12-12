@extends('layouts.app')
@section('content')
    <div class="wrapper fixed__footer">        
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Корзина</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-main-area bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @if ($user->cartItems()->exists())            
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Товар</th>
                                        <th class="product-price">Цена</th>
                                        <th class="product-quantity">Количество</th>
                                        <th class="product-subtotal">Итоговая цена</th>
                                        <th class="product-subtotal">Общий вес</th>
                                        <th class="product-remove">Удалить</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $cartItem)
                                        <tr>
                                            <td class="product-name">
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <img src="{{ asset('images/product/sm-img/1.jpg') }}" alt="" width="60px" height="60px">
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
                                            <td class="product-remove">
                                                <form id="destroy_{{ $cartItem->product->id }}" action="{{ route('shop.cart.destroy', compact('cartItem')) }}" method="POST">
                                                    @csrf
                                                    <i class="lnr lnr-trash" onclick="document.getElementById('destroy_{{ $cartItem->product->id }}').submit()"></i>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-7 col-xs-12">
                                <div class="buttons-cart">
                                    <a href="{{ route('shop.products.index') }}">Вернуться в магазин</a>
                                    <form action="{{ route('shop.cart.destroyAll') }}" method="POST">
                                        @csrf
                                        <input type="submit" value="Удалить все"></input>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <div class="cart_totals">
                                    <h2>Итоги корзины</h2>
                                    <br>
                                    <table>
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Промежуточная цена</th>
                                                <td>
                                                    <td><span class="amount" id="total_price">0.0</span></td>
                                                </td>
                                            </tr>      
                                            <tr class="cart-subtotal">
                                                <th>Промежуточный вес</th>
                                                <td>
                                                    <td><span class="amount" id="total_weight">0.0</span></td>
                                                </td>
                                            </tr>                                      
                                        </tbody>
                                    </table>
                                    <div class="wc-proceed-to-checkout">
                                        <a href="{{ route('shop.orders.checkout') }}">Перейти к оформлению заказа</a>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        @else
                            <p class="text-center">Корзина пуста - <a href="{{ route('shop.products.index') }}">вернуться в магазин</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section ('scripts')
    <script>
        let totalPrice = 0;

        $('.price').each(function (index, value) {
            totalPrice += + $(this).text();
        });

        $("#total_price").text(totalPrice);
    </script>

    <script>
        let totalWeight = 0;

        $('.weight').each(function (index, value) {
            totalWeight += + $(this).text();
        });

        $("#total_weight").text(totalWeight);
    </script>
@endsection