<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Shop\Brands;

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

use App\Entity\Shop\Brand;
use App\UseCases\Admin\Shop\BrandManageService;

class BrandsIndex extends Screen {
    private $service;

    public function __construct(BrandManageService $service) {
        $this->service = $service;
    }

    public function query(): iterable {
        return [
            'brands' => Brand::get(),
        ];
    }

    public function name(): ?string {
        return 'Бренды';
    }

    public function description(): ?string {
        return 'Все добавленные бренды';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.shop.brands',
        ];
    }

    public function commandBar(): iterable {
        return [
            Link::make(__('Добавить'))
                ->icon('plus')
                ->route('platform.systems.shop.brands.create'),
        ];
    }

    public function layout(): iterable {
        return [
            Layout::table('brands', [
                TD::make('name', 'Название'),
                TD::make('slug', 'Уникальное имя'),
                TD::make('description', 'Описание'),

                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Brand $brands) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.systems.shop.brands.edit', $brands->id)
                            ->icon('pencil'),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy', [
                                'id' => $brands->id,
                            ]),
                    ])),
            ])
        ];
    }

    public function destroy(Request $request) {
        $brands = Brand::findOrFail($request->get('id'));
        $this->service->remove($brands);
        return redirect()->route('platform.systems.shop.brands');
    }
}
