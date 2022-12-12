<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;

use App\Orchid\Screens\Blog\Category\CategoryIndex;
use App\Orchid\Screens\Blog\Category\CategoryEdit;
use App\Orchid\Screens\Blog\Category\CategoryCreate;

use App\Orchid\Screens\Blog\Comments\CommentsIndex;
use App\Orchid\Screens\Blog\Comments\CommentsEdit;

use App\Orchid\Screens\Blog\Posts\PostsIndex;
use App\Orchid\Screens\Blog\Posts\PostsEdit;
use App\Orchid\Screens\Blog\Posts\PostsCreate;

use App\Orchid\Screens\Location\Regions\RegionsIndex;
use App\Orchid\Screens\Location\Regions\RegionsEdit;
use App\Orchid\Screens\Location\Regions\RegionsCreate;

use App\Orchid\Screens\Shop\Brands\BrandsIndex;
use App\Orchid\Screens\Shop\Brands\BrandsEdit;
use App\Orchid\Screens\Shop\Brands\BrandsCreate;

use App\Orchid\Screens\Shop\Categories\CategoriesIndex;
use App\Orchid\Screens\Shop\Categories\CategoriesEdit;
use App\Orchid\Screens\Shop\Categories\CategoriesCreate;

use App\Orchid\Screens\Shop\Comments\ShopCommentsIndex;
use App\Orchid\Screens\Shop\Comments\ShopCommentsEdit;

use App\Orchid\Screens\Shop\Delivery\DeliveryIndex;
use App\Orchid\Screens\Shop\Delivery\DeliveryEdit;
use App\Orchid\Screens\Shop\Delivery\DeliveryCreate;

use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

Route::screen('/main', ExampleScreen::class)
    ->name('platform.main')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->push('Главная'));

Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Профиль'), route('platform.profile')));

Route::screen('blog/category', CategoryIndex::class)
    ->name('platform.systems.blog.category')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Блог / Категории'), route('platform.systems.blog.category')));

Route::screen('blog/category/{category}/edit', CategoryEdit::class)
    ->name('platform.systems.blog.category.edit')
    ->breadcrumbs(fn (Trail $trail, $category) => $trail
    ->parent('platform.systems.blog.category')
    ->push(__('Редактировать'), route('platform.systems.blog.category.edit', $category)));

Route::screen('blog/category/create', CategoryCreate::class)
    ->name('platform.systems.blog.category.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.blog.category')
    ->push(__('Создать'), route('platform.systems.blog.category.create')));

Route::screen('blog/comments', CommentsIndex::class)
    ->name('platform.systems.blog.comments')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Блог / Комментарии'), route('platform.systems.blog.comments')));

Route::screen('blog/comments/{comments}/edit', CommentsEdit::class)
    ->name('platform.systems.blog.comments.edit')
    ->breadcrumbs(fn (Trail $trail, $comments) => $trail
    ->parent('platform.systems.blog.comments')
    ->push(__('Редактировать'), route('platform.systems.blog.comments.edit', $comments)));

Route::screen('blog/posts', PostsIndex::class)
    ->name('platform.systems.blog.posts')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Блог / Посты'), route('platform.systems.blog.posts')));

Route::screen('blog/posts/{category}/edit', PostsEdit::class)
    ->name('platform.systems.blog.posts.edit')
    ->breadcrumbs(fn (Trail $trail, $posts) => $trail
    ->parent('platform.systems.blog.posts')
    ->push(__('Редактировать'), route('platform.systems.blog.posts.edit', $posts)));

Route::screen('blog/posts/create', PostsCreate::class)
    ->name('platform.systems.blog.posts.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.blog.posts')
    ->push(__('Создать'), route('platform.systems.blog.posts.create')));
        
Route::screen('location/regions', RegionsIndex::class)
    ->name('platform.systems.location.regions')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Местоположение / Регионы'), route('platform.systems.location.regions')));

Route::screen('location/regions/{regions}/edit', RegionsEdit::class)
    ->name('platform.systems.location.regions.edit')
    ->breadcrumbs(fn (Trail $trail, $regions) => $trail
    ->parent('platform.systems.blog.posts')
    ->push(__('Редактировать'), route('platform.systems.location.regions.edit', $regions)));

Route::screen('location/regions/create', RegionsCreate::class)
    ->name('platform.systems.location.regions.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.location.regions')
    ->push(__('Создать'), route('platform.systems.location.regions.create')));

Route::screen('shop/brands', BrandsIndex::class)
    ->name('platform.systems.shop.brands')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Магазин / Бренды'), route('platform.systems.shop.brands')));

Route::screen('shop/brands/{brands}/edit', BrandsEdit::class)
    ->name('platform.systems.shop.brands.edit')
    ->breadcrumbs(fn (Trail $trail, $brands) => $trail
    ->parent('platform.systems.shop.brands')
    ->push(__('Редактировать'), route('platform.systems.shop.brands.edit', $brands)));

Route::screen('shop/brands/create', BrandsCreate::class)
    ->name('platform.systems.shop.brands.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.shop.brands')
    ->push(__('Создать'), route('platform.systems.shop.brands.create')));

Route::screen('shop/categories', CategoriesIndex::class)
    ->name('platform.systems.shop.categories')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Магазин / Категории'), route('platform.systems.shop.categories')));

Route::screen('shop/categories/{categories}/edit', CategoriesEdit::class)
    ->name('platform.systems.shop.categories.edit')
    ->breadcrumbs(fn (Trail $trail, $categories) => $trail
    ->parent('platform.systems.shop.categories')
    ->push(__('Редактировать'), route('platform.systems.shop.categories.edit', $categories)));

Route::screen('shop/categories/create', CategoriesCreate::class)
    ->name('platform.systems.shop.categories.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.shop.categories')
    ->push(__('Создать'), route('platform.systems.shop.categories.create')));

Route::screen('shop/comments', ShopCommentsIndex::class)
    ->name('platform.systems.shop.comments')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Магазин / Комментарии'), route('platform.systems.shop.comments')));

Route::screen('shop/comments/{comments}/edit', ShopCommentsEdit::class)
    ->name('platform.systems.shop.comments.edit')
    ->breadcrumbs(fn (Trail $trail, $comments) => $trail
    ->parent('platform.systems.shop.comments')
    ->push(__('Редактировать'), route('platform.systems.shop.comments.edit', $comments)));
    
Route::screen('shop/delivery', DeliveryIndex::class)
    ->name('platform.systems.shop.delivery')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Магазин / Методы доставки'), route('platform.systems.shop.delivery')));

Route::screen('shop/delivery/{delivery}/edit', DeliveryEdit::class)
    ->name('platform.systems.shop.delivery.edit')
    ->breadcrumbs(fn (Trail $trail, $delivery) => $trail
    ->parent('platform.systems.shop.delivery')
    ->push(__('Редактировать'), route('platform.systems.shop.delivery.edit', $delivery)));

Route::screen('shop/delivery/create', DeliveryCreate::class)
    ->name('platform.systems.shop.delivery.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.shop.delivery')
    ->push(__('Создать'), route('platform.systems.shop.delivery.create')));

Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
    ->parent('platform.systems.users')
    ->push(__('Пользователи'), route('platform.systems.users.edit', $user)));

Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.users')
    ->push(__('Создать'), route('platform.systems.users.create')));

Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Пользователи'), route('platform.systems.users')));

Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
    ->parent('platform.systems.roles')
    ->push(__('Роли'), route('platform.systems.roles.edit', $role)));

Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.roles')
    ->push(__('Создать'), route('platform.systems.roles.create')));

Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Роли'), route('platform.systems.roles')));