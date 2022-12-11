<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Categories;

use App\Orchid\Layouts\Shop\Categories\CategoriesEditLayout;
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

class CategoriesEdit extends Screen {
    private $service;
    private $category;

    public function __construct(CategoryManageService $service) {
        $this->service = $service;
    }

    public function query(Category $category): iterable {
        $this->category = $category;
        return [
            'shop_categories' => $category,
        ];
    }

    public function name(): ?string {
        return 'Редактировать категорию';
    }

    public function description(): ?string {
        return '';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.category',
        ];
    }

    public function commandBar(): iterable {
        return [
            Button::make(__('Удалить'))
                ->icon('trash')
                ->method('destroy')
                ->canSee($this->category->exists),

            Button::make(__('Сохранить'))
                ->icon('check')
                ->method('update'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(CategoriesEditLayout::class)
                ->title(__('Информация о категории'))
                ->description(__('Обновите информацию о категории.'))
                ->commands(
                    Button::make(__('Сохранить'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->category->exists)
                        ->method('update')
                ),
        ];
    }

    public function destroy(Category $category) {
        $this->service->remove($category);
        return redirect()->route('platform.systems.shop.categories');
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'shop_categories.parent' => 'nullable|integer|exists:shop_categories,id',
            'shop_categories.name' => 'required|string|max:255',
            'shop_categories.slug' => 'required|string|max:255',
            'shop_categories.title' => 'nullable|string|max:255',
            'shop_categories.description' => 'nullable|string'
        ]);

        $category
            ->fill($request->collect('shop_categories')->toArray())
            ->save();
        return redirect()->route('platform.systems.shop.categories');
    }
}