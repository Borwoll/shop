<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Shop\Products;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ProductsEditLayout extends Rows {
    public function fields(): array {
        return [
            Input::make('shop_products.category_id')
                ->type('number')
                ->title(__('ID категории'))
                ->placeholder(__('ID категории')),

            Input::make('shop_products.brand_id')
                ->type('number')
                ->required()
                ->title(__('ID бренда'))
                ->placeholder(__('ID бренда')),

            Input::make('shop_products.availability')
                ->type('text')
                ->required()
                ->title(__('Доступность'))
                ->placeholder(__('Доступность')),

            Input::make('shop_products.title')
                ->type('text')
                ->required()
                ->title(__('Заголовок'))
                ->placeholder(__('Заголовок')),

            Input::make('shop_products.slug')
                ->type('text')
                ->required()
                ->title(__('Уникальное имя'))
                ->placeholder(__('Уникальное имя')),

            Input::make('shop_products.price')
                ->type('number')
                ->required()
                ->title(__('Цена'))
                ->placeholder(__('Цена')),

            Input::make('shop_products.content')
                ->type('text')
                ->required()
                ->title(__('Содержание'))
                ->placeholder(__('Содержание')),

            Input::make('shop_products.status')
                ->type('text')
                ->required()
                ->title(__('Статус'))
                ->placeholder(__('Статус')),

            Input::make('shop_products.weight')
                ->type('number')
                ->required()
                ->title(__('Вес'))
                ->placeholder(__('Вес')),

            Input::make('shop_products.quantity')
                ->type('number')
                ->required()
                ->title(__('Количество'))
                ->placeholder(__('Количество')),
        ];
    }
}
