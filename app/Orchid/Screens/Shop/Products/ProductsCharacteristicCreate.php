<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Products;

use App\Orchid\Layouts\Shop\Products\ProductsCharacteristicEditLayout;
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

class ProductsCharacteristicCreate extends Screen {
    private $service_characteristic;
    private $service_photo;
    private $service_product;

    public function __construct(CharacteristicManageService $service_characteristic, PhotoManageService $service_photo, ProductManageService $service_product) {
        $this->service_characteristic = $service_characteristic;
        $this->service_photo = $service_photo;
        $this->service_product = $service_product;
    }

    private $characteristic;

    public function query(Characteristic $characteristic): iterable {
        $this->characteristic = $characteristic;
        return [
            'shop_product_characteristics' => $characteristic,
        ];
    }

    public function name(): ?string {
        return 'Добавить характеристику';
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
        return [];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(ProductsCharacteristicEditLayout::class)
                ->title(__('Информация о характеристике'))
                ->description(__('Добавьте информацию о характеристики.'))
                ->commands(
                    Button::make(__('Добавить'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('create')
                ),
        ];
    }

    public function destroy(Characteristic $characteristic) {
        $this->service_characteristic->remove($characteristic);
        return redirect()->route('platform.systems.shop.products');
    }

    public function create(Request $request, Characteristic $characteristic) {
        $request->validate([
            'shop_product_characteristics.characteristic_id' => 'required|integer'
        ]);

        $characteristic
            ->fill($request->collect('shop_product_characteristics')->toArray())
            ->save();
        return redirect()->route('platform.systems.shop.products');
    }
}