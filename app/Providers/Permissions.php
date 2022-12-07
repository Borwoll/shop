<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\Dashboard;

class Permissions extends ServiceProvider {
    public function boot() {
        Blade::if('hasAccess', function (string $value) {
            $user = Auth::user();
    
            if ($user === null)
                return false;
    
            return $user->hasAccess($value);
        });
    }
}

class PermissionServiceProvider extends ServiceProvider {
    public function boot(Dashboard $dashboard) {
        $permissions = ItemPermission::group('Модули')
            ->addPermission('analytics', 'Access to data analytics')
            ->addPermission('monitor', 'Access to the system monitor');

        $dashboard->registerPermissions($permissions);
    }
}