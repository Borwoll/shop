<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Shop\Characteristics;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class CharacteristicsEditLayout extends Rows {
    public function fields(): array {
        return [
            Input::make('shop_characteristics.name')
                ->type('text')
                ->required()
                ->title(__('Название'))
                ->placeholder(__('Название')),

            Input::make('shop_characteristics.type')
                ->type('text')
                ->required()
                ->title(__('Тип'))
                ->placeholder(__('Тип')),

            Input::make('shop_characteristics.required')
                ->type('number')
                ->required()
                ->title(__('Требуемый'))
                ->placeholder(__('Требуемый')),

            Input::make('shop_characteristics.default')
                ->type('text')
                ->required()
                ->title(__('По умолчанию'))
                ->placeholder(__('По умолчанию')),

            Input::make('shop_characteristics.sort')
                ->type('number')
                ->required()
                ->title(__('Сортировка'))
                ->placeholder(__('Сортировка')),
        ];
    }
}
