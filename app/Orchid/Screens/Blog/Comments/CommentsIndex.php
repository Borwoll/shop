<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Blog\Comments;

use App\Orchid\Layouts\User\ProfilePasswordLayout;
use App\Orchid\Layouts\User\UserEditLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\DropDown;

use App\Entity\Blog\Comment;
use App\UseCases\Admin\Blog\CommentManageService;

class CommentsIndex extends Screen {
    private $service;
    private $comments;

    public function __construct(CommentManageService $service) {
        $this->service = $service;
    }

    public function query(): iterable {
        return [
            'comments' => Comment::get(),
        ];
    }

    public function name(): ?string {
        return 'Комментарии';
    }

    public function description(): ?string {
        return 'Все добавленные комментарии';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.blog.comments',
        ];
    }

    public function commandBar(): iterable {
        return [];
    }

    public function layout(): iterable {
        return [
            Layout::table('comments', [
                TD::make('created_at', 'Дата создания')->render(fn (Comment $comment) => $comment->created_at->toDateTimeString()),
                TD::make('updated_at', 'Последнее обновление')->render(fn (Comment $comment) => $comment->updated_at->toDateTimeString()),
                TD::make('parent_id', 'ID родителя'),
                TD::make('author_id', 'ID автора'),
                TD::make('post_id', 'ID поста'),
                TD::make('text', 'Текст'),
                TD::make('active', 'Статус')->render(fn (Comment $comment) => ($comment->active ? 'активен' : 'архив')),
                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Comment $comments) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.systems.blog.comments.edit', $comments->id)
                            ->icon('pencil'),

                        Button::make(__('Активировать'))
                            ->icon('refresh')
                            ->method('activate', [
                                'id' => $comments->id,
                            ]),

                        Button::make(__('Деактивировать'))
                            ->icon('refresh')
                            ->method('draft', [
                                'id' => $comments->id,
                            ]),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy', [
                                'id' => $comments->id,
                            ]),
                    ])),
            ])
        ];
    }

    public function destroy(Request $request) {
        $comment = Comment::findOrFail($request->get('id'));
        $this->service->remove($comment);
        return redirect()->route('platform.systems.blog.comments');
    }

    public function activate(Request $request) {
        $comment = Comment::findOrFail($request->get('id'));
        $this->service->activate($comment);
        return redirect()->route('platform.systems.blog.comments');
    }

    public function draft(Request $request) {
        $comment = Comment::findOrFail($request->get('id'));
        $this->service->draft($comment);
        return redirect()->route('platform.systems.blog.comments');
    }
}
