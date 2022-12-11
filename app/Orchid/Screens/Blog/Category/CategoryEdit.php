<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Blog\Category;

use App\Orchid\Layouts\Blog\Category\CategoryEditLayout;
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
use App\UseCases\Admin\Blog\CategoryManageService;

class CategoryEdit extends Screen {
    private $service;
    private $category;

    public function __construct(CategoryManageService $service) {
        $this->service = $service;
    }

    public function query(Category $category): iterable {
        $this->category = $category;
        return [
            'blog_categories' => $category,
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
            'platform.systems.blog.category',
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
            Layout::block(CategoryEditLayout::class)
                ->title(__('Информация о категории'))
                ->description(__('Обновите информацию категории.'))
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
        return redirect()->route('platform.systems.blog.category');
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'blog_categories.parent_id' => 'nullable|integer|exists:blog_categories,id',
            'blog_categories.name' => 'required|string|max:255',
            'blog_categories.slug' => 'required|string|max:255',
            'blog_categories.title' => 'nullable|string|max:255',
            'blog_categories.description' => 'nullable|string',
        ]);

        $category
            ->fill($request->collect('blog_categories')->toArray())
            ->save();
        return redirect()->route('platform.systems.blog.category');
    }
}