<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Shop\Orders;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class OrdersEditLayout extends Rows {
    public function fields(): array {
        return [
            Input::make('shop_orders.user_id')
                ->type('number')
                ->required()
                ->title(__('ID пользователя'))
                ->placeholder(__('ID пользователя')),
            
            Input::make('shop_orders.customer_data_id')
                ->type('number')
                ->title(__('ID заказчика'))
                ->placeholder(__('ID заказчика')),

            Input::make('shop_orders.delivery_data_id')
                ->type('number')
                ->title(__('ID доставки'))
                ->placeholder(__('ID доставки')),

            Input::make('shop_orders.delivery_method_id')
                ->type('number')
                ->title(__('ID метода доставки'))
                ->placeholder(__('ID метода доставки')),

            Input::make('shop_orders.delivery_method_name')
                ->type('text')
                ->title(__('Название метода доставки'))
                ->placeholder(__('Название метода доставки')),

            Input::make('shop_orders.payment_method')
                ->type('text')
                ->title(__('Метод оплаты'))
                ->placeholder(__('Метод оплаты')),

            Input::make('shop_orders.cost')
                ->type('number')
                ->required()
                ->title(__('Стоимость'))
                ->placeholder(__('Стоимость')),

            Input::make('shop_orders.note')
                ->type('text')
                ->title(__('Заметка'))
                ->placeholder(__('Заметка')),

            Input::make('shop_orders.current_status')
                ->type('text')
                ->required()
                ->title(__('Текущий статус'))
                ->placeholder(__('Текущий статус')),

            Input::make('shop_orders.cancel_reason')
                ->type('text')
                ->title(__('Причина отмены'))
                ->placeholder(__('Причина отмены')),
        ];
    }
}
