<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Shop\Comments;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ShopCommentsEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('shop_product_comments.parent_id')
                ->type('number')
                ->max(255)
                ->title(__('ID родителя'))
                ->placeholder(__('ID родителя')),

            Input::make('shop_product_comments.author_id')
                ->type('number')
                ->max(255)
                ->required()
                ->title(__('ID автора'))
                ->placeholder(__('ID автора')),

            Input::make('shop_product_comments.product_id')
                ->type('number')
                ->max(255)
                ->required()
                ->title(__('ID товара'))
                ->placeholder(__('ID товара')),

            Input::make('shop_product_comments.text')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Содержание'))
                ->placeholder(__('Содержание')),

            Input::make('shop_product_comments.active')
                ->type('number')
                ->max(255)
                ->required()
                ->title(__('Статус'))
                ->placeholder(__('Статус')),
        ];
    }
}
