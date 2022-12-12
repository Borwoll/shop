<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Shop\Delivery;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class DeliveryEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('shop_delivery_methods.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Название'))
                ->placeholder(__('Название')),

            Input::make('shop_delivery_methods.cost')
                ->type('number')
                ->required()
                ->title(__('Стоимость'))
                ->placeholder(__('Стоимость')),

            Input::make('shop_delivery_methods.min_weight')
                ->type('number')
                ->required()
                ->title(__('Минимальный вес'))
                ->placeholder(__('Минимальный вес')),

            Input::make('shop_delivery_methods.max_weight')
                ->type('number')
                ->required()
                ->title(__('Максимальный вес'))
                ->placeholder(__('Максимальный вес')),

            Input::make('shop_delivery_methods.sort')
                ->type('number')
                ->required()
                ->title(__('Сортировка'))
                ->placeholder(__('Сортировка')),
        ];
    }
}
