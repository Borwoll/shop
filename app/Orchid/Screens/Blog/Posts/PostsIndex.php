<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Blog\Posts;

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

use App\Entity\Blog\Post\Post;
use App\UseCases\Admin\Blog\PostManageService;

class PostsIndex extends Screen {
    private $service;

    public function __construct(PostManageService $service) {
        $this->service = $service;
    }

    public function query(): iterable {
        return [
            'posts' => Post::get(),
        ];
    }

    public function name(): ?string {
        return 'Посты';
    }

    public function description(): ?string {
        return 'Все добавленные посты';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.blog.posts',
        ];
    }

    public function commandBar(): iterable {
        return [
            Link::make(__('Добавить'))
                ->icon('plus')
                ->route('platform.systems.blog.posts.create'),
        ];
    }

    public function layout(): iterable {
        return [
            Layout::table('posts', [
                TD::make('author_id', 'ID автора'),
                TD::make('category_id', 'ID категории'),
                TD::make('title', 'Заголовок'),
                TD::make('slug', 'Уникальное имя'),
                TD::make('description', 'Описание'),
                TD::make('content', 'Содержание'),
                TD::make('status', 'Статус'),
                TD::make('views', 'Просмотры'),
                TD::make('comments', 'Комментарии'),
                TD::make('likes', 'Лайки'),
                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Post $posts) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.systems.blog.posts.edit', $posts->id)
                            ->icon('pencil'),

                        Button::make(__('Проверить'))
                            ->icon('like')
                            ->method('verify', [
                                'id' => $posts->id,
                            ]),

                        Button::make(__('В архив'))
                            ->icon('dislike')
                            ->method('draft', [
                                'id' => $posts->id,
                            ]),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy', [
                                'id' => $posts->id,
                            ]),
                    ])),
            ])
        ];
    }

    public function verify(Post $post) {
        $this->service->verify($post);
        return redirect()->route('platform.systems.blog.posts');
    }

    public function draft(Post $post) {
        $this->service->draft($post);
        return redirect()->route('platform.systems.blog.posts');
    }

    public function destroy(Request $request) {
        $posts = Post::findOrFail($request->get('id'));
        $this->service->remove($posts);
        return redirect()->route('platform.systems.blog.posts');
    }
}
