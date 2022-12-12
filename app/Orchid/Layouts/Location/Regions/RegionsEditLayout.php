<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Location\Regions;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class RegionsEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('regions.parent_id')
                ->type('number')
                ->title(__('ID родителя'))
                ->placeholder(__('ID родителя')),

            Input::make('regions.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Название'))
                ->placeholder(__('Название')),
        ];
    }
}
