<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Characteristics;

use App\Orchid\Layouts\Shop\Characteristics\VariantEditLayout;
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

use App\Entity\Shop\Characteristic\Characteristic;
use App\Entity\Shop\Characteristic\Variant;

use App\UseCases\Admin\Shop\Characteristic\CharacteristicManageService;
use App\UseCases\Admin\Shop\Characteristic\VariantManageService;

class VariantCreate extends Screen {
    private $service_characteristic;
    private $service_variant;

    public function __construct(CharacteristicManageService $service_characteristic, VariantManageService $service_variant) {
        $this->service_characteristic = $service_characteristic;
        $this->service_variant = $service_variant;
    }

    public function query(): iterable {
        return [
            'characteristics' => Characteristic::get(),
            'variants' => Variant::get(),
        ];
    }

    public function name(): ?string {
        return 'Добавить вариант';
    }

    public function description(): ?string {
        return '';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.characteristics',
        ];
    }

    public function commandBar(): iterable {
        return [];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(VariantEditLayout::class)
                ->title(__('Информация о варианте'))
                ->description(__('Добавьте информацию о варианте.'))
                ->commands(
                    Button::make(__('Добавить'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('create')
                ),
        ];
    }

    public function destroy(Variant $variant) {
        $this->service->remove($variant);
        return redirect()->route('platform.systems.shop.characteristics');
    }

    public function create(Request $request, Variant $variant) {
        $request->validate([
            'shop_characteristic_variants.name' => 'required|string|max:255'
        ]);

        $variant
            ->fill($request->collect('shop_characteristic_variants')->toArray())
            ->save();
        return redirect()->route('platform.systems.shop.characteristics');
    }
}