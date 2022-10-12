<x-jet-action-section>
    <x-slot name="title">
        {{ __('Двухфакторная аутентификация') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Добавьте дополнительную безопасность к своей учетной записи с помощью двухфакторной аутентификации.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Завершите включение двухфакторной аутентификации.') }}
                @else
                    {{ __('Вы включили двухфакторную аутентификацию.') }}
                @endif
            @else
                {{ __('Вы не включили двухфакторную аутентификацию.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('Когда включена двухфакторная аутентификация, вам будет предложено ввести безопасный случайный токен во время аутентификации. Вы можете получить этот токен из приложения Google Authenticator на вашем телефоне.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('Чтобы завершить включение двухфакторной аутентификации, отсканируйте следующий QR-код с помощью приложения аутентификации вашего телефона или введите ключ настройки и введите сгенерированный OTP-код.') }}
                        @else
                            {{ __('Теперь включена двухфакторная аутентификация. Отсканируйте следующий QR-код с помощью приложения аутентификации вашего телефона или введите ключ настройки.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Ключ настройки') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-jet-label for="code" value="{{ __('Code') }}" />

                        <x-jet-input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                            wire:model.defer="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-jet-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Храните эти коды восстановления в безопасном менеджере паролей. Они могут быть использованы для восстановления доступа к вашей учетной записи в случае утери вашего устройства двухфакторной аутентификации.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('Включить') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Создать новые коды восстановления') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @elseif ($showingConfirmation)
                    <x-jet-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-jet-button type="button" class="mr-3" wire:loading.attr="disabled">
                            {{ __('Подтвердить') }}
                        </x-jet-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Показать коды восстановления') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-jet-secondary-button wire:loading.attr="disabled">
                            {{ __('Отменить') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-jet-danger-button wire:loading.attr="disabled">
                            {{ __('Выключить') }}
                        </x-jet-danger-button>
                    </x-jet-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-jet-action-section>
