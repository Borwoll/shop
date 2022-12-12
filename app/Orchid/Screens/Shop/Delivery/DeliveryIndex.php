<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Delivery;

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

use App\Entity\Shop\DeliveryMethod;
use App\UseCases\Admin\Shop\DeliveryMethodManageService;

class DeliveryIndex extends Screen {
    private $service;

    public function __construct(DeliveryMethodManageService $service) {
        $this->service = $service;
    }

    public function query(): iterable {
        return [
            'delivery' => DeliveryMethod::get(),
        ];
    }

    public function name(): ?string {
        return 'Методы доставки';
    }

    public function description(): ?string {
        return 'Все добавленные методы доставки';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.delivery',
        ];
    }

    public function commandBar(): iterable {
        return [
            Link::make(__('Добавить'))
                ->icon('plus')
                ->route('platform.systems.shop.delivery.create'),
        ];
    }

    public function layout(): iterable {
        return [
            Layout::table('delivery', [
                TD::make('name', 'Название'),
                TD::make('cost', 'Стоимость'),
                TD::make('min_weight', 'Минимальный вес'),
                TD::make('max_weight', 'Максимальный вес'),
                TD::make('sort', 'Сортировка'),

                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (DeliveryMethod $delivery) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.systems.shop.delivery.edit', $delivery->id)
                            ->icon('pencil'),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy', [
                                'id' => $delivery->id,
                            ]),
                    ])),
            ])
        ];
    }

    public function destroy(Request $request) {
        $delivery = DeliveryMethod::findOrFail($request->get('id'));
        $this->service->remove($delivery);
        return redirect()->route('platform.systems.shop.delivery');
    }
}
