<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Products;

use App\Orchid\Layouts\Shop\Products\ProductsEditLayout;
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

class ProductsEdit extends Screen {
    private $service;
    private $products;

    public function __construct(ProductManageService $service) {
        $this->service = $service;
    }

    public function query(Product $products): iterable {
        $this->products = $products;
        return [
            'shop_products' => $products,
        ];
    }

    public function name(): ?string {
        return 'Редактировать товар';
    }

    public function description(): ?string {
        return '';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.products',
        ];
    }

    public function commandBar(): iterable {
        return [
            Button::make(__('Удалить'))
                ->icon('trash')
                ->method('destroy')
                ->canSee($this->products->exists),

            Button::make(__('Сохранить'))
                ->icon('check')
                ->method('update'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(ProductsEditLayout::class)
                ->title(__('Информация о товаре'))
                ->description(__('Обновите информацию о товаре.'))
                ->commands(
                    Button::make(__('Сохранить'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->products->exists)
                        ->method('update')
                ),
        ];
    }

    public function destroy(Product $products) {
        $this->service->remove($products);
        return redirect()->route('platform.systems.shop.products');
    }

    public function update(Request $request, Product $products) {
        $request->validate([
            'shop_products.category_id' => 'nullable|integer',
            'shop_products.brand_id' => 'required|integer',
            'shop_products.title' => 'required|string|max:255',
            'shop_products.slug' => 'required|string|max:255',
            'shop_products.price' => 'required|integer',
            'shop_products.content' => 'required|string',
            'shop_products.weight' => 'required|integer|min:0',
            'shop_products.quantity' => 'nullable|integer|min:0'
        ]);

        $products
            ->fill($request->collect('shop_products')->toArray())
            ->save();
        return redirect()->route('platform.systems.shop.products');
    }
}