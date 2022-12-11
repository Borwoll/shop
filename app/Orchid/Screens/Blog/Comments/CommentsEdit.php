<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Blog\Comments;

use App\Orchid\Layouts\Blog\Comments\CommentsEditLayout;
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

class CommentsEdit extends Screen {
    private $service;
    private $comments;

    public function __construct(CommentManageService $service) {
        $this->service = $service;
    }

    public function query(Comment $comments): iterable {
        $this->comments = $comments;
        return [
            'blog_post_comments' => $comments,
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
            'platform.systems.blog.comments',
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
            Layout::block(CommentsEditLayout::class)
                ->title(__('Информация о комменатрии'))
                ->description(__('Обновите информацию комментария.'))
                ->commands(
                    Button::make(__('Сохранить'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->comments->exists)
                        ->method('update')
                ),
        ];
    }

    public function destroy(Category $comments) {
        $this->service->remove($comments);
        return redirect()->route('platform.systems.blog.comments');
    }

    public function update(Request $request, Comment $comments) {
        $request->validate([
            'blog_post_comments.parentId' => 'nullable|integer|max:10',
            'blog_post_comments.text' => 'required|string|max:500'
        ]);

        $comments
            ->fill($request->collect('blog_post_comments')->toArray())
            ->save();
        return redirect()->route('platform.systems.blog.comments');
    }
}