@extends('layouts.app')
@section('content')
    <section class="htc__product__area ptb--130 bg__white">
        <div class="container">
            <div class="htc__product__container">
                <div class="row">
                    <div class="product__list another-product-style">
                        @include ('layouts.flash')
                        <table class="table table-bordered table-striped table-responsive">
                            <tr>
                                <th>Идентификатор</th><td>{{ $user->id }}</td>
                                <th>Имя</th><td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Фамилия</th><td>{{ $user->profile->surname ?: 'Не заполнено' }}</td>
                                <th>Отчество</th><td>{{ $user->profile->patronymic ?: 'Не заполнено' }}</td>
                            </tr>
                            <tr>
                                <th>Электронная почта</th><td>{{ $user->email }}</td>
                                <th>Телефон</th><td>{{ $user->profile->phone ?: 'Не заполнено' }}</td>
                            </tr>
                            <tr>
                                <th>Почтовый индекс</th><td>{{ $user->profile->code ?: 'Не заполнено' }}</td>
                                <th>Действия:</th>
                                <td>
                                    <a href="{{ route('my.profile.fillForm') }}">
                                        <span class="arrow-narrow-left">Редактировать</span>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection