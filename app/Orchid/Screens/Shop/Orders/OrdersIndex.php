<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Orders;

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

use App\Entity\Shop\Order\Order;
use App\UseCases\Admin\Shop\Order\OrderManageService;

class OrdersIndex extends Screen {
    private $service;

    public function __construct(OrderManageService $service) {
        $this->service = $service;
    }

    public function query(): iterable {
        return [
            'orders' => Order::get(),
        ];
    }

    public function name(): ?string {
        return 'Заказы';
    }

    public function description(): ?string {
        return 'Все добавленные заказы';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.orders',
        ];
    }

    public function commandBar(): iterable {
        return [];
    }

    public function layout(): iterable {
        return [
            Layout::table('orders', [
                TD::make('user_id', 'ID пользователя'),
                TD::make('customer_data_id', 'ID исполнителя'),
                TD::make('delivery_data_id', 'ID доставки'),
                TD::make('delivery_method_id', 'ID метода доставки'),
                TD::make('delivery_method_name', 'Название метода доставки'),
                TD::make('delivery_method_cost', 'Стоимость доставки'),
                TD::make('payment_method', 'Метод оплаты'),
                TD::make('cost', 'Стоимость'),
                TD::make('note', 'Заметка'),
                TD::make('current_status', 'Текущий статус'),
                TD::make('cancel_reason', 'Причина отмены'),

                TD::make(__('Смена статуса'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Order $orders) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Button::make(__('Отправлено'))
                            ->icon('clock')
                            ->method('send', [
                                'id' => $orders->id,
                            ]),

                        Button::make(__('Оплачено'))
                            ->icon('plus')
                            ->method('pay', [
                                'id' => $orders->id,
                            ]),

                        Button::make(__('Завершено'))
                            ->icon('check')
                            ->method('complete', [
                                'id' => $orders->id,
                            ]),

                        Button::make(__('Отменено'))
                            ->icon('close')
                            ->method('cancel', [
                                'id' => $orders->id,
                            ]),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy', [
                                'id' => $orders->id,
                            ]),
                    ])),
            ])
        ];
    }

    public function pay(Order $order) {
        $order->pay();
        return redirect()->route('platform.systems.shop.orders');
    }

    public function send(Order $order) {
        $order->send();
        return redirect()->route('platform.systems.shop.orders');
    }

    public function complete(Order $order) {
        $order->complete();
        return redirect()->route('platform.systems.shop.orders');
    }

    public function cancel(Order $order) {
        $order->cancelByAdmin("Заказ закрыт администратором");
        return redirect()->route('platform.systems.shop.orders');
    }

    public function destroy(Order $order) {
        $this->service->remove($order);
        return redirect()->route('platform.systems.shop.orders');
    }
}
