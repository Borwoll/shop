@extends('layouts.app')

@section('content')
<x-app-layout>
    <section class="ptb--130 bg__white">
        <div class="container">
            <div class="row">
                <div class="product__list another-product-style">
                    <div class="col-md-12 single__pro col-lg-12 cat--1 col-sm-12 col-xs-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.update-profile-information-form')
                        @endif
                    </div>

                    <div class="col-md-12 single__pro col-lg-12 cat--1 col-sm-12 col-xs-12 mt-5">
                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.update-password-form')
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12 single__pro col-lg-12 cat--1 col-sm-12 col-xs-12 mt-5">
                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.two-factor-authentication-form')
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12 single__pro col-lg-12 cat--1 col-sm-12 col-xs-12 mt-5">
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.logout-other-browser-sessions-form')
                        </div>
                    </div>

                    <div class="col-md-12 single__pro col-lg-12 cat--1 col-sm-12 col-xs-12 mt-5">
                        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.delete-user-form')
                            </div>
                        @endif	
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
@endsection

@section('modals')

@endsection