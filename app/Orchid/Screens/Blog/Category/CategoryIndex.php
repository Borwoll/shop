<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Blog\Category;

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

use App\Entity\Blog\Category;

class CategoryIndex extends Screen
{
    public function query(): iterable {
        return [
            'categories' => Category::get(),
        ];
    }

    public function name(): ?string {
        return 'Категории';
    }

    public function description(): ?string {
        return 'Все добавленные категории';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.blog.category',
        ];
    }

    public function commandBar(): iterable {
        return [
            Link::make(__('Добавить'))
                ->icon('plus')
                ->route('platform.systems.users.create'),
        ];
    }

    public function layout(): iterable {
        return [
            Layout::table('categories', [
                TD::make('name', 'Имя'),
                TD::make('slug', 'Уникальное имя'),
                TD::make('title', 'Заголовок'),
                TD::make('description', 'Описание'),
                TD::make('_lft', 'LFT'),
                TD::make('_rgt', 'RGT'),
                TD::make('parent_id', 'ID родителя'),
                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Category $category) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.systems.users.edit', $category->id)
                            ->icon('pencil'),

                        Button::make(__('Удалить'))
                            ->route('platform.systems.users.edit', $category->id)
                            ->icon('trash'),
                    ])),
            ])
        ];
    }

    public function asyncGetUser(User $user): iterable {
        return [
            'user' => $user,
        ];
    }

    public function saveUser(Request $request, User $user): void {
        $request->validate([
            'user.email' => [
                'required',
                Rule::unique(User::class, 'email')->ignore($user),
            ],
        ]);

        $user->fill($request->input('user'))->save();

        Toast::info(__('Пользователь был сохранен.'));
    }

    public function remove(Request $request): void {
        User::findOrFail($request->get('id'))->delete();

        Toast::info(__('Пользователь был удален'));
    }
}
