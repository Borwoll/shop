<?php

namespace App\Orchid\Screens\Examples;

use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\ChartLineExample;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Repository;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use App\Entity\User\User;
use App\Entity\Blog\Comment;
use App\Entity\Shop\Product\Product;
use App\Entity\Shop\Order\Order;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class ExampleScreen extends Screen {
    public function query(): iterable {
        return [
            'metrics' => [
                'users'    => ['value' => User::count()],
                'orders' => ['value' => Order::count()],
                'products'   => ['value' => Product::count()],
                'comments'    => Comment::count(),
            ],
        ];
    }

    public function name(): ?string {
        return 'Главная';
    }

    public function description(): ?string {
        return 'На этой странице представлена основная информация об активности интернет-магазина';
    }

    public function layout(): iterable {
        return [
            Layout::metrics([
                'Количество пользователей' => 'metrics.users',
                'Количество заказов' => 'metrics.orders',
                'Количество товаров' => 'metrics.products',
                'Количество комментариев' => 'metrics.comments',
            ]),
        ];
    }
}
