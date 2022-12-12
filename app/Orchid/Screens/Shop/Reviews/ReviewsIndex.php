<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Reviews;

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

use App\Entity\Shop\Review;
use App\Entity\Shop\Product\Product;
use App\UseCases\Admin\Shop\ReviewManageService;

class ReviewsIndex extends Screen {
    private $service;

    public function __construct(ReviewManageService $service) {
        $this->service = $service;
    }

    public function query(): iterable {
        return [
            'reviews' => Review::get(),
        ];
    }

    public function name(): ?string {
        return 'Отзывы';
    }

    public function description(): ?string {
        return 'Все добавленные отзывы';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.reviews',
        ];
    }

    public function commandBar(): iterable {
        return [];
    }

    public function layout(): iterable {
        return [
            Layout::table('reviews', [
                TD::make('author_id', 'ID автора'),
                TD::make('product_id', 'ID товара'),
                TD::make('rating', 'Рейтинг'),
                TD::make('text', 'Содержание'),

                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Review $reviews) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.systems.shop.reviews.edit', $reviews->id)
                            ->icon('pencil'),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy', [
                                'product_id' => $reviews->product_id,
                                'id' => $reviews->id
                            ]),
                    ])),
            ])
        ];
    }

    public function destroy(Product $product, Review $review) {
        $this->service->remove($product, $review);
        return redirect()->route('platform.systems.shop.reviews');
    }
}
