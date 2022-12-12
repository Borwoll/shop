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

class OrdersShow extends Screen {
    private $service;
    private $order;

    public function __construct(OrderManageService $service) {
        $this->service = $service;
    }

    public function query(Order $order): iterable {
        $this->order = $order;
        return [
            'shop_orders' => $order,
            'shop_order_items' => $order->items,
            'shop_order_statuses' => $order->statuses
        ];
    }

    public function name(): ?string {
        return 'Заказ';
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
            Layout::table('shop_order_items', [
                TD::make('order_id', 'ID заказа'),
                TD::make('product_id', 'ID товара'),
                TD::make('product_name', 'Название товара'),
                TD::make('product_price', 'Цена товара'),
                TD::make('product_quantity', 'Количество товара'),
                TD::make('total_price', 'Итоговая цена'),
            ]),

            Layout::table('shop_order_statuses', [
                TD::make('order_id', 'ID заказа'),
                TD::make('value', 'Статус заказа'),
            ])
        ];
    }
}
