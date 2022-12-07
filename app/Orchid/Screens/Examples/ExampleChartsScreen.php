<?php

namespace App\Orchid\Screens\Examples;

use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\ChartLineExample;
use App\Orchid\Layouts\Examples\ChartPercentageExample;
use App\Orchid\Layouts\Examples\ChartPieExample;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ExampleChartsScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'charts' => [
                [
                    'name'   => 'Некоторые данные',
                    'values' => [25, 40, 30, 35, 8, 52, 17],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
                [
                    'name'   => 'Еще один набор',
                    'values' => [25, 50, -10, 15, 18, 32, 27],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
                [
                    'name'   => 'Еще один',
                    'values' => [15, 20, -3, -15, 58, 12, -17],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
                [
                    'name'   => 'И последний',
                    'values' => [10, 33, -8, -3, 70, 20, -34],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
            ],
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Графики';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @throws \Throwable
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            ChartLineExample::make('charts', 'Действия с твитом')
                ->description('Общее количество взаимодействий пользователя с твитом. Сюда входят все клики по любым ссылкам в твите (включая хэштеги, ссылки, аватар, имя пользователя и кнопку развернуть), ретвиты, ответы, лайки и добавления в список прочитанного.'),

            Layout::columns([
                ChartLineExample::make('charts', 'Линейный график')
                    ->description('Это простые линейные диаграммы с разными цветами.'),
                ChartBarExample::make('charts', 'Столбчатая диаграмма')
                    ->description('Это простые столбчатые диаграммы с разными цветами.'),
            ]),

            Layout::columns([
                ChartPercentageExample::make('charts', 'Процентная диаграмма')
                    ->description('Простые, отзывчивые, современные SVG-диаграммы с нулевыми зависимостями'),

                ChartPieExample::make('charts', 'Круговая диаграмма')
                    ->description('Простые, отзывчивые, современные SVG-диаграммы с нулевыми зависимостями'),
            ]),
        ];
    }
}
