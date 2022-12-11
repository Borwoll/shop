<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Blog\Posts;

use App\Orchid\Layouts\Blog\Posts\PostsEditLayout;
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

class PostsCreate extends Screen {
    private $service;
    private $posts;

    public function __construct(PostManageService $service) {
        $this->service = $service;
    }

    public function query(Post $posts): iterable {
        $this->posts = $posts;
        return [
            'blog_posts' => $posts,
        ];
    }

    public function name(): ?string {
        return 'Создать пост';
    }

    public function description(): ?string {
        return '';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.blog.posts',
        ];
    }

    public function commandBar(): iterable {
        return [];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(PostsEditLayout::class)
                ->title(__('Информация о посте'))
                ->description(__('Добавьте информацию о посте.'))
                ->commands(
                    Button::make(__('Создать'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('create')
                ),
        ];
    }

    public function destroy(Post $posts) {
        $this->service->remove($posts);
        return redirect()->route('platform.systems.blog.posts');
    }

    public function create(Request $request, Post $posts) {
        $request->validate([
            'blog_posts.category' => 'nullable|integer',
            'blog_posts.title' => 'required|string|max:255',
            'blog_posts.slug' => 'required|string|max:255|unique:blog_posts',
            'blog_posts.description' => 'required|string',
            'blog_posts.content' => 'required|string',
            'blog_posts.photo' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $posts
            ->fill($request->collect('blog_posts')->toArray())
            ->save();
        return redirect()->route('platform.systems.blog.posts');
    }
}