<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Comments;

use App\Orchid\Layouts\Shop\Comments\ShopCommentsEditLayout;
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

class ShopCommentsEdit extends Screen {
    private $service;
    private $comments;

    public function __construct(CommentManageService $service) {
        $this->service = $service;
    }

    public function query(Comment $comments): iterable {
        $this->comments = $comments;
        return [
            'shop_product_comments' => $comments,
        ];
    }

    public function name(): ?string {
        return 'Редактировать комментарий';
    }

    public function description(): ?string {
        return '';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.comments',
        ];
    }

    public function commandBar(): iterable {
        return [
            Button::make(__('Удалить'))
                ->icon('trash')
                ->method('destroy')
                ->canSee($this->comments->exists),

            Button::make(__('Сохранить'))
                ->icon('check')
                ->method('update'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(ShopCommentsEditLayout::class)
                ->title(__('Информация о комментарии'))
                ->description(__('Обновите информацию о комментарии.'))
                ->commands(
                    Button::make(__('Сохранить'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->comments->exists)
                        ->method('update')
                ),
        ];
    }

    public function destroy(Comment $comments) {
        $this->service->remove($comments);
        return redirect()->route('platform.systems.shop.comments');
    }

    public function update(Request $request, Comment $comments) {
        $request->validate([
            'shop_product_comments.parentId' => 'nullable|integer|max:10',
            'shop_product_comments.text' => 'required|string|max:500'
        ]);

        $comments
            ->fill($request->collect('shop_product_comments')->toArray())
            ->save();
        return redirect()->route('platform.systems.shop.comments');
    }
}