<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Shop\Reviews;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ReviewsEditLayout extends Rows {
    public function fields(): array {
        return [
            Input::make('shop_product_reviews.author_id')
                ->type('number')
                ->required()
                ->title(__('ID автора'))
                ->placeholder(__('ID автора')),

            Input::make('shop_product_reviews.product_id')
                ->type('number')
                ->required()
                ->title(__('ID товара'))
                ->placeholder(__('ID товара')),

            Input::make('shop_product_reviews.rating')
                ->type('number')
                ->required()
                ->title(__('Рейтинг'))
                ->placeholder(__('Рейтинг')),

            Input::make('shop_product_reviews.text')
                ->type('text')
                ->required()
                ->title(__('Содержание'))
                ->placeholder(__('Содержание')),
        ];
    }
}
