@extends('platform::auth')
@section('title',__('Sign in to your account'))

@section('content')
    <h1 class="h4 text-black mb-4">{{__('Войдите в свою учетную запись')}}</h1>

    <form class="m-t-md"
          role="form"
          method="POST"
          data-controller="form"
          data-action="form#submit"
          data-form-button-animate="#button-login"
          data-form-button-text="{{ __('Загрузка...') }}"
          action="{{ route('platform.login.auth') }}">
        @csrf

        @includeWhen($isLockUser,'platform::auth.lockme')
        @includeWhen(!$isLockUser,'platform::auth.signin')
    </form>
@endsection
