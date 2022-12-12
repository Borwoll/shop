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

class VariantEdit extends Screen {
    private $service_characteristic;
    private $service_variant;
    private $variant;

    public function __construct(CharacteristicManageService $service_characteristic, VariantManageService $service_variant) {
        $this->service_characteristic = $service_characteristic;
        $this->service_variant = $service_variant;
    }

    public function query(Variant $variant): iterable {
        $this->variant = $variant;
        return [
            'shop_characteristic_variants' => $variant
        ];
    }

    public function name(): ?string {
        return 'Редактировать вариант';
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
        return [
            Button::make(__('Удалить'))
                ->icon('trash')
                ->method('destroy')
                ->canSee($this->variant->exists),

            Button::make(__('Сохранить'))
                ->icon('check')
                ->method('update'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(VariantEditLayout::class)
                ->title(__('Информация о варианте'))
                ->description(__('Обновите информацию о варианте.'))
                ->commands(
                    Button::make(__('Сохранить'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->variant->exists)
                        ->method('update')
                ),
        ];
    }

    public function destroy(Variant $variant) {
        $this->service_variant->remove($variant);
        return redirect()->route('platform.systems.shop.characteristics');
    }

    public function update(Request $request, Variant $variant) {
        $request->validate([
            'shop_characteristic_variants.name' => 'required|string|max:255'
        ]);

        $variant
            ->fill($request->collect('shop_characteristic_variants')->toArray())
            ->save();
        return redirect()->route('platform.systems.shop.characteristics');
    }
}