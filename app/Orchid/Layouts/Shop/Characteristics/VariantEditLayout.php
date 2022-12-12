<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Shop\Characteristics;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class VariantEditLayout extends Rows {
    public function fields(): array {
        return [
            Input::make('shop_characteristic_variants.characteristic_id')
                ->type('number')
                ->required()
                ->title(__('ID характеристики'))
                ->placeholder(__('ID характеристики')),

            Input::make('shop_characteristic_variants.name')
                ->type('text')
                ->required()
                ->title(__('Название'))
                ->placeholder(__('Название'))
        ];
    }
}
