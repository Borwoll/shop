<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Delivery;

use App\Orchid\Layouts\Shop\Delivery\DeliveryEditLayout;
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

use App\Entity\Shop\DeliveryMethod;
use App\UseCases\Admin\Shop\DeliveryMethodManageService;

class DeliveryEdit extends Screen {
    private $service;
    private $delivery;

    public function __construct(DeliveryMethodManageService $service) {
        $this->service = $service;
    }

    public function query(DeliveryMethod $delivery): iterable {
        $this->delivery = $delivery;
        return [
            'shop_delivery_methods' => $delivery,
        ];
    }

    public function name(): ?string {
        return 'Редактировать метод доставки';
    }

    public function description(): ?string {
        return '';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.delivery',
        ];
    }

    public function commandBar(): iterable {
        return [
            Button::make(__('Удалить'))
                ->icon('trash')
                ->method('destroy')
                ->canSee($this->delivery->exists),

            Button::make(__('Сохранить'))
                ->icon('check')
                ->method('update'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(DeliveryEditLayout::class)
                ->title(__('Информация о методе доставки'))
                ->description(__('Обновите информацию о методе доставки.'))
                ->commands(
                    Button::make(__('Сохранить'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->delivery->exists)
                        ->method('update')
                ),
        ];
    }

    public function destroy(DeliveryMethod $delivery) {
        $this->service->remove($delivery);
        return redirect()->route('platform.systems.shop.delivery');
    }

    public function update(Request $request, DeliveryMethod $delivery) {
        $request->validate([
            'shop_delivery_methods.name' => 'required|string|max:255',
            'shop_delivery_methods.cost' => 'required|integer|min:0',
            'shop_delivery_methods.min_weight' => 'required|integer|min:0',
            'shop_delivery_methods.max_weight' => 'required|integer',
            'shop_delivery_methods.sort' => 'required|integer'
        ]);

        $delivery
            ->fill($request->collect('shop_delivery_methods')->toArray())
            ->save();
        return redirect()->route('platform.systems.shop.delivery');
    }
}