<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Shop\Products;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ProductsPhotoEditLayout extends Rows {
    public function fields(): array {
        return [
            Input::make('shop_product_photos.product_id')
                ->type('number')
                ->title(__('ID товара'))
                ->placeholder(__('ID товара')),

            Input::make('shop_product_photos.photo')
                ->type('text')
                ->required()
                ->title(__('Фотография'))
                ->placeholder(__('Фотография')),
        ];
    }
}
