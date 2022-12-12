<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Blog\Comments;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class CommentsEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('blog_post_comments.parentId')
                ->type('number')
                ->title(__('ID родителя'))
                ->placeholder(__('ID родителя')),

            Input::make('blog_post_comments.text')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Текст'))
                ->placeholder(__('Текст')),
        ];
    }
}
