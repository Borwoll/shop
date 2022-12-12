<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Characteristics;

use App\Orchid\Layouts\Shop\Characteristics\CharacteristicsEditLayout;
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
use App\UseCases\Admin\Shop\Characteristic\CharacteristicManageService;

class CharacteristicsCreate extends Screen {
    private $service;
    private $characteristic;

    public function __construct(CharacteristicManageService $service) {
        $this->service = $service;
    }

    public function query(Characteristic $characteristic): iterable {
        $this->characteristic = $characteristic;
        return [
            'shop_characteristics' => $characteristic,
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
            'platform.systems.shop.characteristics',
        ];
    }

    public function commandBar(): iterable {
        return [];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(CharacteristicsEditLayout::class)
                ->title(__('Информация о характеристике'))
                ->description(__('Добавьте информацию о характеристике.'))
                ->commands(
                    Button::make(__('Добавить'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('create')
                ),
        ];
    }

    public function destroy(Characteristic $characteristic) {
        $this->service->remove($characteristic);
        return redirect()->route('platform.systems.shop.characteristics');
    }

    public function create(Request $request, Characteristic $characteristic) {
        $request->validate([
            'shop_characteristics.name' => 'required|string|max:255',
            'shop_characteristics.type' => 'required|string|max:16',
            'shop_characteristics.required' => 'required|boolean',
            'shop_characteristics.default' => 'required',
            'shop_characteristics.sort' => 'required|integer'
        ]);

        $characteristic
            ->fill($request->collect('shop_characteristics')->toArray())
            ->save();
        return redirect()->route('platform.systems.shop.characteristics');
    }
}