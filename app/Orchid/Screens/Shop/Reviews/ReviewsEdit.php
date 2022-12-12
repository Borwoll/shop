<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Reviews;

use App\Orchid\Layouts\Shop\Reviews\ReviewsEditLayout;
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

class ReviewsEdit extends Screen {
    private $service;
    private $reviews;

    public function __construct(ReviewManageService $service) {
        $this->service = $service;
    }

    public function query(Review $reviews): iterable {
        $this->reviews = $reviews;
        return [
            'shop_product_reviews' => $reviews,
        ];
    }

    public function name(): ?string {
        return 'Редактировать отзыв';
    }

    public function description(): ?string {
        return '';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.reviews',
        ];
    }

    public function commandBar(): iterable {
        return [];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(ReviewsEditLayout::class)
                ->title(__('Информация о отзыве'))
                ->description(__('Обновите информацию о отзыве.'))
                ->commands(
                    Button::make(__('Сохранить'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->reviews->exists)
                        ->method('update')
                ),
        ];
    }

    public function update(Request $request, Review $reviews) {
        $request->validate([
            'shop_product_reviews.rating' => 'integer|min:1|max:5',
            'shop_product_reviews.text' => 'string'
        ]);

        $reviews
            ->fill($request->collect('shop_product_reviews')->toArray())
            ->save();
        return redirect()->route('platform.systems.shop.reviews');
    }
}