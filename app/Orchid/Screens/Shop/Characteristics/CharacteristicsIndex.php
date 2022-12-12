<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Characteristics;

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

use App\Entity\Shop\Characteristic\Characteristic;
use App\Entity\Shop\Characteristic\Variant;

use App\UseCases\Admin\Shop\Characteristic\CharacteristicManageService;
use App\UseCases\Admin\Shop\Characteristic\VariantManageService;

class CharacteristicsIndex extends Screen {
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
        return 'Характеристики';
    }

    public function description(): ?string {
        return 'Все добавленные характеристики';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.characteristics',
        ];
    }

    public function commandBar(): iterable {
        return [
            Link::make(__('Добавить характеристику'))
                ->icon('plus')
                ->route('platform.systems.shop.characteristics.create'),
            Link::make(__('Добавить вариант'))
                ->icon('plus')
                ->route('platform.systems.shop.variant.create'),
        ];
    }

    public function layout(): iterable {
        return [
            Layout::table('characteristics', [
                TD::make('name', 'Название'),
                TD::make('type', 'Тип'),
                TD::make('required', 'Требуемый'),
                TD::make('default', 'По умолчанию'),
                TD::make('sort', 'Сортировка'),

                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Characteristic $characteristics) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.systems.shop.characteristics.edit', $characteristics->id)
                            ->icon('pencil'),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy', [
                                'id' => $characteristics->id,
                            ]),
                    ])),
            ]),

            Layout::table('variants', [
                TD::make('characteristic_id', 'ID характеристики'),
                TD::make('name', 'Название'),

                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Variant $variant) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.systems.shop.variant.edit', $variant->id)
                            ->icon('pencil'),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy_variant', [
                                'id' => $variant->id,
                                'id' => $variant->id,
                            ]),
                    ])),
            ])
        ];
    }

    public function destroy(Request $request) {
        $characteristics = Characteristic::findOrFail($request->get('id'));
        $this->service_characteristic->remove($characteristics);
        return redirect()->route('platform.systems.shop.characteristics');
    }

    public function destroy_variant(Variant $variant) {
        $this->service_variant->remove($variant);
        return redirect()->route('platform.systems.shop.characteristics');
    }
}
