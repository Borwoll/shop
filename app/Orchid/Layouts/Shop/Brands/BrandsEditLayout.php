<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Shop\Brands;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class BrandsEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('shop_brands.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Название'))
                ->placeholder(__('Название')),

            Input::make('shop_brands.slug')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Уникальное имя'))
                ->placeholder(__('Уникальное имя')),

            Input::make('shop_brands.description')
                ->type('text')
                ->max(255)
                ->title(__('Описание'))
                ->placeholder(__('Описание')),
        ];
    }
}
