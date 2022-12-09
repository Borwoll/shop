@extends('layouts.app')
@section('content')
    <section class="htc__product__area ptb--120 bg__white" style="margin-bottom:100px;">
        <div class="container">
            <div class="htc__product__container">
                <div class="row">
                    <div class="product__list another-product-style">
                        <p>
                            @if ($order->canBePaid())
                                <form action="{{ route('orders.pay', $order) }}" method="POST" id="pay-form">
                                    @csrf
                                    <button class="btn btn-success">Оплатить</button>
                                </form>
                            @endif

                            @if ($order->canBeCanceled())
                                <a href="#" id="cancel" class="btn btn-danger">Отменить</a>

                                @include ('my.orders.cancel-form', $order)
                            @endif
                        </p>

                        <table class="table table-bordered table-striped table-responsive">
                            <tbody>
                                <tr>
                                    <th>Номер заказа</th><td>{{ $order->id }}</td>
                                    <th>Имя</th><td>{{ $order->customerData->name }}</td>
                                    <th>Фамилия</th><td>{{ $order->customerData->surname }}</td>
                                    <th>Отчество</th><td>{{ $order->customerData->patronymic }}</td>
                                </tr>
                                <tr>
                                    <th>Электронная почта</th><td>{{ $order->customerData->email }}</td>
                                    <th>Телефон</th><td>{{ $order->customerData->phone }}</td>
                                    <th>Местоположение</th><td>{{ $order->deliveryData->region->name }}</td>
                                    <th>Почтовый индекс</th><td>{{ $order->deliveryData->code }}</td>
                                </tr>
                                <tr>
                                    <th>Способ доставки</th><td>{{ $order->delivery_method_name }}</td>
                                    <th>Стоимость способа доставки</th><td>{{ $order->delivery_method_cost }}</td>
                                    <th>Способ оплаты</th><td>{{ $order->payment_method ?: 'Не оплачено' }}</td>
                                    <th>Причина отмены</th><td>{{ $order->cancel_reason ?? 'Не отменено' }}</td>
                                </tr>
                                <tr>
                                    <th>Созданный в</th><td>{{ date('d-M h:i', strtotime($order->created_at)) }}</td>
                                    <th>Обновлено на</th><td>{{ date('d-M h:i', strtotime($order->updated_at)) }}</td>
                                    <th>Стоимость</th><td>{{ $order->cost }}</td>
                                    <th>Статус</th>
                                    <td>
                                        @if ($order->isNew())
                                            <span class="badge badge-danger">Новое</span>
                                        @endif

                                        @if ($order->isPaid())
                                            <span class="badge badge-primary">Оплачено</span>
                                        @endif

                                        @if ($order->isSent())
                                            <span class="badge badge-primary">Отправлено</span>
                                        @endif

                                        @if ($order->isCompleted())
                                            <span class="badge badge-success">Завершенный</span>
                                        @endif

                                        @if ($order->isCancelledByCustomer())
                                            <span class="badge badge-danger">Отменено клиентом</span>
                                        @endif

                                        @if ($order->isCancelledByAdmin())
                                            <span class="badge badge-danger">Отменено администратором</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h5>Примечание</h5>
                        <p>{{ $order->note ?: 'Пусто' }}</p>

                        <br>

                        <table class="table table-bordered table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>Фотография</th>
                                <th>Имя</th>
                                <th>Цена за 1 товар</th>
                                <th>Количество</th>
                                <th>Итоговая цена</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($order->items as $orderItem)
                                <tr>
                                    <td><img src="{{ $orderItem->product->photos()->exists() ? $orderItem->product->photos()->first()->getUrl() : '' }}" alt="" width="100px"></td>
                                    <td><a href="{{ route('shop.products.single', ['id' => $orderItem->product->id, 'slug' => $orderItem->product->slug]) }}">{{ $orderItem->product_name }}</a></td>
                                    <td>{{ $orderItem->product_price }}</td>
                                    <td>{{ $orderItem->product_quantity }}</td>
                                    <td>{{ $orderItem->total_price }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        <div class="row">
                            <h5>История статусов</h5>
                            <br><br>

                            <table class="table table-bordered table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th>Статус</th>
                                    <th>Время</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <th><span class="badge badge-danger">Новое</span></th>
                                    <td>{{ date('d-M h:i', strtotime($order->created_at)) }}</td>
                                </tr>

                                @foreach ($order->statuses as $status)
                                    <tr>
                                        <td>
                                            @if ($order->isPaid())
                                                <span class="badge badge-primary">Оплачено</span>
                                            @endif

                                            @if ($order->isSent())
                                                <span class="badge badge-primary">Отправлено</span>
                                            @endif

                                            @if ($order->isCompleted())
                                                <span class="badge badge-success">Завершенный</span>
                                            @endif

                                            @if ($order->isCancelledByCustomer())
                                                <span class="badge badge-danger">Отменено клиентом</span>
                                            @endif

                                            @if ($order->isCancelledByAdmin())
                                                <span class="badge badge-danger">Отменено администратором</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d-M h:i', strtotime($status->created_at)) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).on("click", "#cancel", function () {
            let cancelForm = $("#cancel-form");
            let cancelButton = $("#cancel");
            let isActiveForm = cancelButton.hasClass("form-active");

            if (isActiveForm) {
                cancelForm.css("display", "none");
                cancelButton.removeClass("form-active");
                cancelButton.text("Отменить");
            } else {
                cancelForm.css("display", "block");
                cancelButton.addClass("form-active");
                cancelButton.text("Убрать форму");
            }

            return false;
        });
    </script>
@endsection