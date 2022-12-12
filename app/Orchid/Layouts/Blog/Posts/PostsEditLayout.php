<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Blog\Posts;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class PostsEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('blog_posts.author_id')
                ->type('number')
                ->required()
                ->title(__('ID автора'))
                ->placeholder(__('ID автора')),

            Input::make('blog_posts.category_id')
                ->type('number')
                ->title(__('ID категории'))
                ->placeholder(__('ID категории')),

            Input::make('blog_posts.photo')
                ->type('text')
                ->title(__('Название фотографии'))
                ->placeholder(__('Название фотографии')),

            Input::make('blog_posts.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Заголовок'))
                ->placeholder(__('Заголовок')),

            Input::make('blog_posts.slug')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Уникальное имя'))
                ->placeholder(__('Уникальное имя')),

            Input::make('blog_posts.description')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Описание'))
                ->placeholder(__('Описание')),

            Input::make('blog_posts.content')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Содержание'))
                ->placeholder(__('Содержание')),

            Input::make('blog_posts.status')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Статус'))
                ->placeholder(__('Статус')),
        ];
    }
}
