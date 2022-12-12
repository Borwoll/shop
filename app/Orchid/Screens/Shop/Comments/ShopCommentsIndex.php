<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Comments;

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

use App\Entity\Shop\Comment;
use App\UseCases\Admin\Shop\CommentManageService;

class ShopCommentsIndex extends Screen {
    private $service;

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
            'platform.systems.shop.comments',
        ];
    }

    public function commandBar(): iterable {
        return [];
    }

    public function layout(): iterable {
        return [
            Layout::table('comments', [
                TD::make('parent_id', 'ID родителя'),
                TD::make('author_id', 'ID автора'),
                TD::make('product_id', 'ID продукта'),
                TD::make('text', 'Содержание'),
                TD::make('active', 'Статус'),

                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Comment $comments) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Button::make(__('Активировать'))
                            ->icon('refresh')
                            ->method('activate', [
                                'id' => $comments->id,
                            ]),

                        Link::make(__('Редактировать'))
                            ->route('platform.systems.shop.comments.edit', $comments->id)
                            ->icon('pencil'),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy', [
                                'id' => $comments->id,
                            ]),
                    ])),
            ])
        ];
    }

    public function activate(Comment $comments) {
        $this->service->activate($comments);
        return redirect()->route('platform.systems.shop.comments');
    }

    public function destroy(Request $request) {
        $comments = Comment::findOrFail($request->get('id'));
        $this->service->remove($comments);
        return redirect()->route('platform.systems.shop.comments');
    }
}
