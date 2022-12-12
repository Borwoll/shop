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
use App\Entity\Shop\Product\Characteristic;
use App\Entity\Shop\Product\Photo;

use App\UseCases\Admin\Shop\Product\CharacteristicManageService;
use App\UseCases\Admin\Shop\Product\PhotoManageService;
use App\UseCases\Admin\Shop\Product\ProductManageService;

class ProductsIndex extends Screen {
    private $service_characteristic;
    private $service_photo;
    private $service_product;

    public function __construct(CharacteristicManageService $service_characteristic, PhotoManageService $service_photo, ProductManageService $service_product) {
        $this->service_characteristic = $service_characteristic;
        $this->service_photo = $service_photo;
        $this->service_product = $service_product;
    }

    public function query(): iterable {
        return [
            'products' => Product::get(),
            'photos' => Photo::get(),
            'characteristics' => Characteristic::get(),
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
            Link::make(__('Добавить товар'))
                ->icon('plus')
                ->route('platform.systems.shop.products.create'),

            Link::make(__('Добавить фотографию'))
                ->icon('plus')
                ->route('platform.systems.shop.products.photo.create'),

            Link::make(__('Добавить характеристику'))
                ->icon('plus')
                ->route('platform.systems.shop.products.characteristic.create'),
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
                            ->method('destroy_product', [
                                'id' => $products->id,
                            ]),
                    ])),
            ]),

            Layout::table('photos', [
                TD::make('product_id', 'ID продукта'),
                TD::make('photo', 'Фотография'),

                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Photo $photos) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.systems.shop.products.photo.edit', $photos->id)
                            ->icon('pencil'),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy_photo', [
                                'id' => $photos->id,
                            ]),
                    ])),
            ]),

            Layout::table('characteristics', [
                TD::make('product_id', 'ID продукта'),
                TD::make('characteristic_id', 'ID характеристики'),
                TD::make('variant_id', 'ID варианта'),

                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Characteristic $characteristics) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.systems.shop.products.characteristic.edit', $characteristics->id)
                            ->icon('pencil'),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy_characteristics', [
                                'id' => $characteristics->id,
                            ]),
                    ])),
            ])
        ];
    }

    public function destroy_product(Request $request) {
        $products = Product::findOrFail($request->get('id'));
        $this->service_product->remove($products);
        return redirect()->route('platform.systems.shop.products');
    }

    public function destroy_photo(Photo $photo) {
        $this->service_photo->remove($photo);
        return redirect()->route('platform.systems.shop.products');
    }

    public function destroy_characteristics(Characteristic $characteristic) {
        $this->service_characteristic->remove($characteristic);
        return redirect()->route('platform.systems.shop.products');
    }

    public function activate(Product $products) {
        $this->service_product->activate($products);
        return redirect()->route('platform.systems.shop.products');
    }

    public function draft(Product $products) {
        $this->service_product->draft($products);
        return redirect()->route('platform.systems.shop.products');
    }

    public function available(Product $products) {
        $this->service_product->makeAvailable($products);
        return redirect()->route('platform.systems.shop.products');
    }

    public function unavailable(Product $products) {
        $this->service_product->makeUnavailable($products);
        return redirect()->route('platform.systems.shop.products');
    }
}
