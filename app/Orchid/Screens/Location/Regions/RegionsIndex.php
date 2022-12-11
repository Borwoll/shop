<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Location\Regions;

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

use App\Entity\Region;
use App\UseCases\Admin\Region\RegionManageService;

class RegionsIndex extends Screen {
    private $service;

    public function __construct(RegionManageService $service) {
        $this->service = $service;
    }

    public function query(): iterable {
        return [
            'regions' => Region::get(),
        ];
    }

    public function name(): ?string {
        return 'Регионы';
    }

    public function description(): ?string {
        return 'Все добавленные регионы';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.location.regions',
        ];
    }

    public function commandBar(): iterable {
        return [
            Link::make(__('Добавить'))
                ->icon('plus')
                ->route('platform.systems.location.regions.create'),
        ];
    }

    public function layout(): iterable {
        return [
            Layout::table('regions', [
                TD::make('parent_id', 'ID родителя'),
                TD::make('name', 'Название'),

                TD::make(__('Действия'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Region $regions) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Редактировать'))
                            ->route('platform.systems.location.regions.edit', $regions->id)
                            ->icon('pencil'),

                        Button::make(__('Удалить'))
                            ->icon('trash')
                            ->method('destroy', [
                                'id' => $regions->id,
                            ]),
                    ])),
            ])
        ];
    }

    public function destroy(Request $request) {
        $regions = Region::findOrFail($request->get('id'));
        $this->service->remove($regions);
        return redirect()->route('platform.systems.location.regions');
    }
}
