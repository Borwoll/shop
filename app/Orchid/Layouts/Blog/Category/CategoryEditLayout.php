<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Blog\Category;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class CategoryEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('blog_categories.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Название'))
                ->placeholder(__('Название')),

            Input::make('blog_categories.slug')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Уникальное имя'))
                ->placeholder(__('Уникальное имя')),

            Input::make('blog_categories.title')
                ->type('text')
                ->max(255)
                ->title(__('Заголовок'))
                ->placeholder(__('Заголовок')),

            Input::make('blog_categories.description')
                ->type('text')
                ->max(255)
                ->title(__('Описание'))
                ->placeholder(__('Описание')),

            Input::make('blog_categories.parent_id')
                ->type('number')
                ->title(__('Родитель'))
                ->placeholder(__('Родитель')),
        ];
    }
}
