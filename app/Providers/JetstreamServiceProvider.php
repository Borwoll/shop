<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Illuminate\Foundation\AliasLoader;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Laravel\Jetstream\Http\Livewire\ApiTokenManager', 'App\Http\Livewire\ApiTokenManager');
        $loader->alias('Laravel\Jetstream\Http\Livewire\CreateTeamForm', 'App\Http\Livewire\CreateTeamForm');
        $loader->alias('Laravel\Jetstream\Http\Livewire\DeleteTeamForm', 'App\Http\Livewire\DeleteTeamForm');
        $loader->alias('Laravel\Jetstream\Http\Livewire\DeleteUserForm', 'App\Http\Livewire\DeleteUserForm');
        $loader->alias('Laravel\Jetstream\Http\Livewire\LogoutOtherBrowserSessionsForm', 'App\Http\Livewire\LogoutOtherBrowserSessionsForm');
        $loader->alias('Laravel\Jetstream\Http\Livewire\NavigationDropdown', 'App\Http\Livewire\NavigationDropdown');
        $loader->alias('Laravel\Jetstream\Http\Livewire\TeamMemberManager', 'App\Http\Livewire\TeamMemberManager');
        $loader->alias('Laravel\Jetstream\Http\Livewire\TwoFactorAuthenticationForm', 'App\Http\Livewire\TwoFactorAuthenticationForm');
        $loader->alias('Laravel\Jetstream\Http\Livewire\UpdatePasswordForm', 'App\Http\Livewire\UpdatePasswordForm');
        $loader->alias('Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm', 'App\Http\Livewire\UpdateProfileInformationForm');
        $loader->alias('Laravel\Jetstream\Http\Livewire\UpdateTeamNameForm', 'App\Http\Livewire\UpdateTeamNameForm');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
