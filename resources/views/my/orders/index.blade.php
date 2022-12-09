@extends('layouts.app')
@section('content')
    <section class="htc__product__area ptb--130 bg__white">
        <div class="container">
            <div class="htc__product__container">
                <div class="row">
                    <div class="product__list another-product-style">
                        <h3>Мои заказы</h3>
                        @foreach ($user->orders as $order)
                            <h4>
                                <a href="{{ route('orders.show', $order) }}" style="color:black">
                                    <span style="@if ($order->isCancelled()) color:red @endif">Заказ №{{ $order->id }} ({{ date('d-M h:i', strtotime($order->created_at)) }})</span>
                                </a>
                            </h4>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection