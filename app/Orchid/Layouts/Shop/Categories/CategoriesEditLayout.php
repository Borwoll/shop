<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Shop\Categories;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class CategoriesEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('shop_categories.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Название'))
                ->placeholder(__('Название')),

            Input::make('shop_categories.slug')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Уникальное имя'))
                ->placeholder(__('Уникальное имя')),

            Input::make('shop_categories.title')
                ->type('text')
                ->max(255)
                ->title(__('Заголовок'))
                ->placeholder(__('Заголовок')),

            Input::make('shop_categories.description')
                ->type('text')
                ->max(255)
                ->title(__('Описание'))
                ->placeholder(__('Описание')),

            Input::make('shop_categories.parent_id')
                ->type('number')
                ->title(__('ID родителя'))
                ->placeholder(__('ID родителя')),
        ];
    }
}
