<?php

namespace App\Orchid\Screens\Examples;

use App\Orchid\Layouts\Examples\TabMenuExample;
use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ExampleLayoutsScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Обзорные макеты';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Компоненты для разработки вашего проекта';
    }

    /**
     * Button commands.
     *
     * @return Action[]
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
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [

            Layout::block(Layout::view('platform::dummy.block'))
                ->title('Заголовок блока')
                ->description('Отличное описание, которое редактирует или просматривает в блоке'),

            Layout::tabs([
                'Пример вкладки 1' => Layout::view('platform::dummy.block'),
                'Пример вкладки 2' => Layout::view('platform::dummy.block'),
                'Пример вкладки 3' => Layout::view('platform::dummy.block'),
            ]),

            TabMenuExample::class,
            Layout::view('platform::dummy.block'),

            Layout::columns([
                Layout::view('platform::dummy.block'),
                Layout::view('platform::dummy.block'),
                Layout::view('platform::dummy.block'),
            ]),

            Layout::accordion([
                'Складной элемент группы #1' => Layout::view('platform::dummy.block'),
                'Складной элемент группы #2' => Layout::view('platform::dummy.block'),
                'Складной элемент группы #3' => Layout::view('platform::dummy.block'),
            ]),

        ];
    }
}
