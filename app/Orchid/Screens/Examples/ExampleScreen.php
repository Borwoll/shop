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


class ExampleScreen extends Screen {
    public const TEXT_EXAMPLE = 'Lorem ipsum но в первый раз сила начала иссякать,
    если бы раньше не было так трудно жить на озере Уорт.
    Нектар библиотеки Мацумото будет жить вечно, но матрас будет терзаться круглый год,
    и наши влюбленные не будут беспокоиться о трауре.';

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


    public function commandBar(): iterable {        
        return [
            DropDown::make('Выгрузка файла')
                ->icon('cloud-download')
                ->list([
                    Button::make('Json')
                        ->method('export')
                        ->rawClick()
                        ->novalidate(),

                    Button::make('Csv')
                        ->method('export')
                        ->rawClick()
                        ->novalidate(),

                    Button::make('Pdf')
                        ->method('export')
                        ->rawClick()
                        ->novalidate(),

                    Button::make('Docx')
                        ->method('export')
                        ->rawClick()
                        ->novalidate(),

                    Button::make('Xlsx')
                        ->method('export')
                        ->rawClick()
                        ->novalidate(),
                ]),

        ];
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

    public function export()
    {
        return response()->streamDownload(function () {
            $csv = tap(fopen('php://output', 'wb'), function ($csv) {
                fputcsv($csv, ['header:col1', 'header:col2', 'header:col3']);
            });

            collect([
                ['row1:col1', 'row1:col2', 'row1:col3'],
                ['row2:col1', 'row2:col2', 'row2:col3'],
                ['row3:col1', 'row3:col2', 'row3:col3'],
            ])->each(function (array $row) use ($csv) {
                fputcsv($csv, $row);
            });

            return tap($csv, function ($csv) {
                fclose($csv);
            });
        }, 'File-name.csv');
    }
}
