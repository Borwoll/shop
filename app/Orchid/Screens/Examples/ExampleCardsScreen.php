<?php

namespace App\Orchid\Screens\Examples;

use Illuminate\Http\Request;
use Orchid\Platform\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ExampleCardsScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'user' => User::firstOrFail(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Карточки';
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @throws \Throwable
     *
     * @return array
     */
    public function layout(): iterable
    {
        return [
            Layout::legend('user', [
                Sight::make('id', 'Идентификатор')->popover('Идентификатор, символ, который однозначно идентифицирует объект или запись'),
                Sight::make('name', 'Имя'),
                Sight::make('email', 'Электронная почта'),
                Sight::make('email_verified_at', 'Электронная почта подтверждена?')->render(fn (User $user) => $user->email_verified_at === null
                    ? '<i class="text-danger">●</i> Нет'
                    : '<i class="text-success">●</i> Да'),
                Sight::make('created_at', 'Созданный'),
                Sight::make('updated_at', 'Обновленный'),
                Sight::make('Простой текст')->render(fn () => 'Это более широкая карточка со вспомогательным текстом ниже в качестве естественного перехода к дополнительному контенту.'),
                Sight::make('Действия')->render(fn () => Button::make('Показать уведомление')
                    ->type(Color::DEFAULT())
                    ->method('showToast')),
            ])->title('Пользователь'),
        ];
    }

    /**
     * @param Request $request
     */
    public function showToast(Request $request): void
    {
        Toast::warning($request->get('toast', 'Привет, мир! Это тостовое сообщение.'));
    }
}
