<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Shop\Products;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ProductsCharacteristicEditLayout extends Rows {
    public function fields(): array {
        return [
            Input::make('shop_product_characteristics.product_id')
                ->type('number')
                ->title(__('ID товара'))
                ->placeholder(__('ID товара')),

            Input::make('shop_product_characteristics.characteristic_id')
                ->type('number')
                ->required()
                ->title(__('ID характеристики'))
                ->placeholder(__('ID характеристики')),

            Input::make('shop_product_characteristics.variant_id')
                ->type('number')
                ->title(__('ID варианта'))
                ->placeholder(__('ID варианта')),
        ];
    }
}
