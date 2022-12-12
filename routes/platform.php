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

use App\Orchid\Screens\Shop\Reviews\ReviewsIndex;
use App\Orchid\Screens\Shop\Reviews\ReviewsEdit;

use App\Orchid\Screens\Shop\Products\ProductsIndex;
use App\Orchid\Screens\Shop\Products\ProductsEdit;
use App\Orchid\Screens\Shop\Products\ProductsCreate;
use App\Orchid\Screens\Shop\Products\ProductsPhotoCreate;
use App\Orchid\Screens\Shop\Products\ProductsPhotoEdit;
use App\Orchid\Screens\Shop\Products\ProductsCharacteristicCreate;
use App\Orchid\Screens\Shop\Products\ProductsCharacteristicEdit;

use App\Orchid\Screens\Shop\Orders\OrdersIndex;
use App\Orchid\Screens\Shop\Orders\OrdersShow;

use App\Orchid\Screens\Shop\Characteristics\CharacteristicsIndex;
use App\Orchid\Screens\Shop\Characteristics\CharacteristicsEdit;
use App\Orchid\Screens\Shop\Characteristics\CharacteristicsCreate;
use App\Orchid\Screens\Shop\Characteristics\VariantEdit;
use App\Orchid\Screens\Shop\Characteristics\VariantCreate;

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

Route::screen('shop/reviews', ReviewsIndex::class)
    ->name('platform.systems.shop.reviews')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Магазин / Отзывы'), route('platform.systems.shop.reviews')));

Route::screen('shop/reviews/{reviews}/edit', ReviewsEdit::class)
    ->name('platform.systems.shop.reviews.edit')
    ->breadcrumbs(fn (Trail $trail, $reviews) => $trail
    ->parent('platform.systems.shop.reviews')
    ->push(__('Редактировать'), route('platform.systems.shop.reviews.edit', $reviews)));

Route::screen('shop/products', ProductsIndex::class)
    ->name('platform.systems.shop.products')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Магазин / Товары'), route('platform.systems.shop.products')));

Route::screen('shop/products/{products}/edit', ProductsEdit::class)
    ->name('platform.systems.shop.products.edit')
    ->breadcrumbs(fn (Trail $trail, $products) => $trail
    ->parent('platform.systems.shop.products')
    ->push(__('Редактировать'), route('platform.systems.shop.products.edit', $products)));

Route::screen('shop/products/create', ProductsCreate::class)
    ->name('platform.systems.shop.products.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.shop.products')
    ->push(__('Создать'), route('platform.systems.shop.products.create')));

Route::screen('shop/products/photos/create', ProductsPhotoCreate::class)
    ->name('platform.systems.shop.products.photo.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.shop.products')
    ->push(__('Создать'), route('platform.systems.shop.products.photo.create')));

Route::screen('shop/photo/{photo}/edit', ProductsPhotoEdit::class)
    ->name('platform.systems.shop.products.photo.edit')
    ->breadcrumbs(fn (Trail $trail, $photo) => $trail
    ->parent('platform.systems.shop.products')
    ->push(__('Редактировать'), route('platform.systems.shop.products.photo.edit', $photo)));

Route::screen('shop/products/characteristics/create', ProductsCharacteristicCreate::class)
    ->name('platform.systems.shop.products.characteristic.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.shop.products')
    ->push(__('Создать'), route('platform.systems.shop.products.characteristic.create')));

Route::screen('shop/characteristic/{characteristic}/edit', ProductsCharacteristicEdit::class)
    ->name('platform.systems.shop.products.characteristic.edit')
    ->breadcrumbs(fn (Trail $trail, $characteristic) => $trail
    ->parent('platform.systems.shop.products')
    ->push(__('Редактировать'), route('platform.systems.shop.products.characteristic.edit', $characteristic)));

Route::screen('shop/characteristics', CharacteristicsIndex::class)
    ->name('platform.systems.shop.characteristics')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Магазин / Характеристики'), route('platform.systems.shop.characteristics')));

Route::screen('shop/characteristics/{characteristics}/edit', CharacteristicsEdit::class)
    ->name('platform.systems.shop.characteristics.edit')
    ->breadcrumbs(fn (Trail $trail, $characteristics) => $trail
    ->parent('platform.systems.shop.characteristics')
    ->push(__('Редактировать'), route('platform.systems.shop.characteristics.edit', $characteristics)));

Route::screen('shop/characteristics/create', CharacteristicsCreate::class)
    ->name('platform.systems.shop.characteristics.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.shop.characteristics')
    ->push(__('Создать'), route('platform.systems.shop.characteristics.create')));

Route::screen('shop/characteristics/variant/{variant}/edit', VariantEdit::class)
    ->name('platform.systems.shop.variant.edit')
    ->breadcrumbs(fn (Trail $trail, $variant) => $trail
    ->parent('platform.systems.shop.characteristics')
    ->push(__('Редактировать'), route('platform.systems.shop.variant.edit', $variant)));

Route::screen('shop/characteristics/variant/create', VariantCreate::class)
    ->name('platform.systems.shop.variant.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.systems.shop.characteristics')
    ->push(__('Создать'), route('platform.systems.shop.variant.create')));

Route::screen('shop/orders', OrdersIndex::class)
    ->name('platform.systems.shop.orders')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.main')
    ->push(__('Магазин / Заказы'), route('platform.systems.shop.orders')));
    
Route::screen('shop/orders/{orders}/show', OrdersShow::class)
    ->name('platform.systems.shop.orders.show')
    ->breadcrumbs(fn (Trail $trail, $orders) => $trail
    ->parent('platform.systems.shop.orders')
    ->push(__('Подробнее'), route('platform.systems.shop.orders.show', $orders)));

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