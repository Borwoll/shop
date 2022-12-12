<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    public function registerMainMenu(): array
    {
        return [
            Menu::make('Главная')
                ->icon('monitor')
                ->route('platform.main')
                ->title('Навигация'),

            Menu::make(__('Категории'))
                ->icon('number-list')
                ->route('platform.systems.blog.category')
                ->permission('platform.systems.blog.category')
                ->title(__('Блог')),

            Menu::make(__('Комментарии'))
                ->icon('bubble')
                ->route('platform.systems.blog.comments')
                ->permission('platform.systems.blog.comments'),

            Menu::make(__('Посты'))
                ->icon('docs')
                ->route('platform.systems.blog.posts')
                ->permission('platform.systems.blog.posts'),
                
            Menu::make(__('Регионы'))
                ->icon('location-pin')
                ->route('platform.systems.location.regions')
                ->permission('platform.systems.location.regions')
                ->title(__('Местоположение')),

            Menu::make(__('Бренды'))
                ->icon('barcode')
                ->route('platform.systems.shop.brands')
                ->permission('platform.systems.shop.brands')
                ->title(__('Магазин')),

            Menu::make(__('Категории'))
                ->icon('user')
                ->route('platform.systems.shop.categories')
                ->permission('platform.systems.shop.category'),

            // Menu::make(__('Характеристики'))
            //     ->icon('user')
            //     ->route('platform.systems.shop.characteristics')
            //     ->permission('platform.systems.shop.characteristics'),

            Menu::make(__('Комментарии'))
                ->icon('speech')
                ->route('platform.systems.shop.comments')
                ->permission('platform.systems.shop.comments'),

            // Menu::make(__('Методы доставки'))
            //     ->icon('user')
            //     ->route('platform.systems.shop.delivery')
            //     ->permission('platform.systems.shop.delivery'),

            // Menu::make(__('Заказы'))
            //     ->icon('user')
            //     ->route('platform.systems.shop.orders')
            //     ->permission('platform.systems.shop.orders'),

            // Menu::make(__('Товары'))
            //     ->icon('user')
            //     ->route('platform.systems.shop.products')
            //     ->permission('platform.systems.shop.products'),

            // Menu::make(__('Отзывы'))
            //     ->icon('user')
            //     ->route('platform.systems.shop.reviews')
            //     ->permission('platform.systems.shop.reviews'),

            Menu::make(__('Пользователи'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Права доступа')),

            Menu::make(__('Роли'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Личный кабинет')
                ->route('my')
                ->icon('monitor'),
        ];
    }

    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('Блог'))
                ->addPermission('platform.systems.blog.category', __('Категории'))
                ->addPermission('platform.systems.blog.comments', __('Комментарии'))
                ->addPermission('platform.systems.blog.posts', __('Посты')),

            ItemPermission::group(__('Местоположение'))
                ->addPermission('platform.systems.location.regions', __('Регионы')),

            ItemPermission::group(__('Магазин'))
                ->addPermission('platform.systems.shop.brands', __('Бренды'))
                ->addPermission('platform.systems.shop.category', __('Категории'))
                ->addPermission('platform.systems.shop.characteristics', __('Характеристики'))
                ->addPermission('platform.systems.shop.comments', __('Комментарии'))
                ->addPermission('platform.systems.shop.delivery', __('Методы доставки'))
                ->addPermission('platform.systems.shop.orders', __('Заказы'))
                ->addPermission('platform.systems.shop.products', __('Товары'))
                ->addPermission('platform.systems.shop.reviews', __('Оценки')),

            ItemPermission::group(__('Система'))
                ->addPermission('platform.systems.roles', __('Роли'))
                ->addPermission('platform.systems.users', __('Пользователи')),
        ];
    }
}
