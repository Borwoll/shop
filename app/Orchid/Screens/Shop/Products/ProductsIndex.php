<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Products;

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

use App\Entity\Shop\Product\Product;
use App\UseCases\Admin\Shop\Product\ProductManageService;

class ProductsIndex extends Screen {
    private $service;

    public function __construct(ProductManageService $service) {
        $this->service = $service;
    }

    public function query(): iterable {
        return [
            'products' => Product::get(),
        ];
    }

    public function name(): ?string {
        return 'Товары';
    }

    public function description(): ?string {
        return 'Все добавленные товары';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.products',
        ];
    }

    public function commandBar(): iterable {
        return [
            Link::make(__('Добавить'))
                ->icon('plus')
                ->route('platform.systems.shop.products.create'),
        ];
    }

    public function layout(): iterable {
        return [
            Layout::table('products', [
                TD::make('category_id', 'ID категории'),
                TD::make('brand_id', 'ID бренда'),
                TD::make('availability', 'Доступность'),
                TD::make('title', 'Заголовок'),
                TD::make('slug', 'Уникальное имя'),
                TD::make('price', 'Цена'),
                TD::make('content', 'Содержание'),
                TD::make('status', 'Статус'),
                TD::make('rating', 'Рейтинг'),
                TD::make('reviews', 'Отзывы'),
                TD::make('comments', 'Комментарии'),
                TD::make('weight', 'Вес'),
                TD::make('quantity', 'Количество'),

                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Product $products) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.systems.shop.products.edit', $products->id)
                            ->icon('pencil'),

                        Button::make(__('Активировать'))
                            ->icon('refresh')
                            ->method('activate', [
                                'id' => $products->id,
                            ]),

                        Button::make(__('Деактивировать'))
                            ->icon('refresh')
                            ->method('draft', [
                                'id' => $products->id,
                            ]),

                        Button::make(__('Сделать товар доступным'))
                            ->icon('check')
                            ->method('available', [
                                'id' => $products->id,
                            ]),

                        Button::make(__('Сделать товар недоступным'))
                            ->icon('close')
                            ->method('unavailable', [
                                'id' => $products->id,
                            ]),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy', [
                                'id' => $products->id,
                            ]),
                    ])),
            ])
        ];
    }

    public function destroy(Request $request) {
        $products = Product::findOrFail($request->get('id'));
        $this->service->remove($products);
        return redirect()->route('platform.systems.shop.products');
    }

    public function activate(Product $products) {
        $this->service->activate($products);
        return redirect()->route('platform.systems.shop.products');
    }

    public function draft(Product $products) {
        $this->service->draft($products);
        return redirect()->route('platform.systems.shop.products');
    }

    public function available(Product $products) {
        $this->service->makeAvailable($products);
        return redirect()->route('platform.systems.shop.products');
    }

    public function unavailable(Product $products) {
        $this->service->makeUnavailable($products);
        return redirect()->route('platform.systems.shop.products');
    }
}
