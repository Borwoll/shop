<?php

namespace App\Orchid\Layouts\Examples;

use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Layouts\TabMenu;

class TabMenuExample extends TabMenu
{
    /**
     * Get the menu elements to be displayed.
     *
     * @return Menu[]
     */
    protected function navigations(): iterable
    {
        return [
            Menu::make('Overview layouts')
                ->route('main.layouts'),

            Menu::make('Get Started')
                ->route('main'),

            Menu::make('Documentation')
                ->url('https://orchid.software/en/docs'),

            Menu::make('Example screen')
                ->icon('monitor')
                ->route('platform.main')
                ->badge(fn () => 6),
        ];
    }
}
