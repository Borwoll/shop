<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Location\Regions;

use App\Orchid\Layouts\Location\Regions\RegionsEditLayout;
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

class RegionsCreate extends Screen {
    private $service;
    private $regions;

    public function __construct(RegionManageService $service) {
        $this->service = $service;
    }

    public function query(Region $regions): iterable {
        $this->regions = $regions;
        return [
            'regions' => $regions,
        ];
    }

    public function name(): ?string {
        return 'Добавить регион';
    }

    public function description(): ?string {
        return '';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.location.regions',
        ];
    }

    public function commandBar(): iterable {
        return [];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(RegionsEditLayout::class)
                ->title(__('Информация о регионе'))
                ->description(__('Добавьте информацию о регионе.'))
                ->commands(
                    Button::make(__('Добавить'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('create')
                ),
        ];
    }

    public function destroy(Region $regions) {
        $this->service->remove($regions);
        return redirect()->route('platform.systems.location.regions');
    }

    public function create(Request $request, Region $regions) {
        $request->validate([
            'regions.parent' => 'nullable|integer',
            'regions.name' => 'required|string|max:255',
        ]);

        $regions
            ->fill($request->collect('regions')->toArray())
            ->save();
        return redirect()->route('platform.systems.location.regions');
    }
}