<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Categories;

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

use App\Entity\Shop\Category;
use App\UseCases\Admin\Shop\CategoryManageService;

class CategoriesIndex extends Screen {
    private $service;

    public function __construct(CategoryManageService $service) {
        $this->service = $service;
    }

    public function query(): iterable {
        return [
            'category' => Category::get(),
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
            'platform.systems.shop.category',
        ];
    }

    public function commandBar(): iterable {
        return [
            Link::make(__('Добавить'))
                ->icon('plus')
                ->route('platform.systems.shop.categories.create'),
        ];
    }

    public function layout(): iterable {
        return [
            Layout::table('category', [
                TD::make('name', 'Название'),
                TD::make('slug', 'Уникальное имя'),
                TD::make('title', 'Заголовок'),
                TD::make('description', 'Описание'),
                TD::make('parent_id', 'ID родителя'),

                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Category $category) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Button::make(__(''))
                            ->icon('arrow-up-circle')
                            ->method('first', [
                                'id' => $category->id,
                            ]),

                        Button::make(__(''))
                            ->icon('arrow-up')
                            ->method('up', [
                                'id' => $category->id,
                            ]),

                        Button::make(__(''))
                            ->icon('arrow-down')
                            ->method('down', [
                                'id' => $category->id,
                            ]),

                        Button::make(__(''))
                            ->icon('arrow-down-circle')
                            ->method('last', [
                                'id' => $category->id,
                            ]),

                        Link::make(__('Редактировать'))
                            ->route('platform.systems.shop.categories.edit', $category->id)
                            ->icon('pencil'),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy', [
                                'id' => $category->id,
                            ]),
                    ])),
            ])
        ];
    }

    public function first(Category $category) {
        $first = $this->service->getSiblings($category);
        if ($first)
            $this->service->first($category, $first);
        return redirect()->route('platform.systems.shop.categories');
    }

    public function up(Category $category) {
        $this->service->up($category);
        return redirect()->route('platform.systems.shop.categories');
    }

    public function down(Category $category) {
        $this->service->down($category);
        return redirect()->route('platform.systems.shop.categories');
    }

    public function last(Category $category) {
        $last = $this->service->getSiblingsDesc($category);
        if ($last)
            $this->service->last($category, $last);
        return redirect()->route('platform.systems.shop.categories');
    }

    public function destroy(Request $request) {
        $category = Category::findOrFail($request->get('id'));
        $this->service->remove($category);
        return redirect()->route('platform.systems.shop.categories');
    }
}
