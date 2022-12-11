<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Brands;

use App\Orchid\Layouts\Shop\Brands\BrandsEditLayout;
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

use App\Entity\Shop\Brand;
use App\UseCases\Admin\Shop\BrandManageService;

class BrandsCreate extends Screen {
    private $service;
    private $brands;

    public function __construct(BrandManageService $service) {
        $this->service = $service;
    }

    public function query(Brand $brands): iterable {
        $this->brands = $brands;
        return [
            'brands' => $brands,
        ];
    }

    public function name(): ?string {
        return 'Добавить бренд';
    }

    public function description(): ?string {
        return '';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.brands',
        ];
    }

    public function commandBar(): iterable {
        return [];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(BrandsEditLayout::class)
                ->title(__('Информация о бренде'))
                ->description(__('Добавьте информацию о бренде.'))
                ->commands(
                    Button::make(__('Добавить'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('create')
                ),
        ];
    }

    public function destroy(Brand $brands) {
        $this->service->remove($brands);
        return redirect()->route('platform.systems.shop.brands');
    }

    public function create(Request $request, Brand $brands) {
        $request->validate([
            'shop_brands.name' => 'required|string|max:255',
            'shop_brands.slug' => 'required|string|max:255|unique:shop_brands',
            'shop_brands.description' => 'nullable|string'
        ]);

        $brands
            ->fill($request->collect('shop_brands')->toArray())
            ->save();
        return redirect()->route('platform.systems.shop.brands');
    }
}