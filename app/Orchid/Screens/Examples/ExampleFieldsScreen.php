<?php

namespace App\Orchid\Screens\Examples;

use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Fields\Radio;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ExampleFieldsScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'name' => 'Привет! Мы собрали все поля в одном месте',
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Основные элементы управления формой';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Примеры для создания самых разнообразных форм.';
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
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::columns([
                Layout::rows([

                    Input::make('name')
                        ->title('Полное имя:')
                        ->placeholder('Введите полное имя')
                        ->required()
                        ->help('Пожалуйста, введите свое полное имя'),

                    Input::make('email')
                        ->title('Адрес электронной почты')
                        ->placeholder('Адрес электронной почты')
                        ->help("Мы никогда не передадим вашу электронную почту кому-либо еще.")
                        ->popover('Всплывающая подсказка - подсказка, которую пользователь открывает сам.'),

                    Password::make('password')
                        ->title('Пароль')
                        ->placeholder('Пароль'),

                    Label::make('static')
                        ->title('Статический:')
                        ->value('email@example.com'),

                    Select::make('select')
                        ->title('Выбрать')
                        ->options([1, 2]),

                    CheckBox::make('checkbox')
                        ->title('Флажок')
                        ->placeholder('Запомнить меня?'),

                    Radio::make('radio')
                        ->placeholder('Да')
                        ->value(1)
                        ->title('Радио'),

                    Radio::make('radio')
                        ->placeholder('Нет')
                        ->value(0),

                    TextArea::make('textarea')
                        ->title('Пример текстовой области')
                        ->rows(6),

                ])->title('Base Controls'),
                Layout::rows([
                    Input::make('disabled_input')
                        ->title('Отключенный ввод')
                        ->placeholder('Отключенный ввод')
                        ->help('Отключенный элемент ввода непригоден для использования и не кликабелен.')
                        ->disabled(),

                    Select::make('disabled_select')
                        ->title('Отключенный выбор')
                        ->options([1, 2])
                        ->value(0)
                        ->disabled(),

                    TextArea::make('disabled_textarea')
                        ->title('Отключенная текстовая область')
                        ->placeholder('Отключенная текстовая область')
                        ->rows(6)
                        ->disabled(),

                    Input::make('readonly_input')
                        ->title('Ввод только для чтения')
                        ->placeholder('Ввод только для чтения')
                        ->readonly(),

                    CheckBox::make('readonly_checkbox')
                        ->title('Флажок только для чтения')
                        ->placeholder('Запомнить меня?')
                        ->disabled(),

                    Radio::make('radio')
                        ->placeholder('Да')
                        ->value(1)
                        ->title('Радио')
                        ->disabled(),

                    Radio::make('radio')
                        ->placeholder('Нет')
                        ->value(0)
                        ->disabled(),

                    TextArea::make('readonly_textarea')
                        ->title('Текстовая область только для чтения')
                        ->placeholder('Текстовая область только для чтения')
                        ->rows(7)
                        ->disabled(),

                ])->title('Input States'),
            ]),

            Layout::rows([
                Group::make([
                    Button::make('Первичный')->method('buttonClickProcessing')->type(Color::PRIMARY()),
                    Button::make('Вторичный')->method('buttonClickProcessing')->type(Color::SECONDARY()),
                    Button::make('Успех')->method('buttonClickProcessing')->type(Color::SUCCESS()),
                    Button::make('Опасность')->method('buttonClickProcessing')->type(Color::DANGER()),
                    Button::make('Предупреждение')->method('buttonClickProcessing')->type(Color::WARNING()),
                    Button::make('Инфо')->method('buttonClickProcessing')->type(Color::INFO()),
                    Button::make('Светлый')->method('buttonClickProcessing')->type(Color::LIGHT()),
                    Button::make('Темный')->method('buttonClickProcessing')->type(Color::DARK()),
                    Button::make('По умолчанию')->method('buttonClickProcessing')->type(Color::DEFAULT()),
                    Button::make('Ссылка')->method('buttonClickProcessing')->type(Color::LINK()),
                ])->autoWidth(),
            ])->title('Кнопки'),

            Layout::rows([
                Input::make('test')
                    ->title('Текст')
                    ->value('Кустарная капуста')
                    ->help('Основные однострочные текстовые поля.')
                    ->horizontal(),

                Input::make('search')
                    ->type('search')
                    ->title('Поиск')
                    ->value('Как мне снимать веб')
                    ->help('Текстовые поля, предназначенные для ввода пользователем поисковых запросов в.')
                    ->horizontal(),

                Input::make('email')
                    ->type('email')
                    ->title('Электронная почта')
                    ->value('bootstrap@example.com')
                    ->help('Используется, чтобы позволить пользователю вводить и редактировать адрес электронной почты')
                    ->horizontal(),

                Input::make('url')
                    ->type('url')
                    ->title('URL-адрес')
                    ->value('https://getbootstrap.com')
                    ->horizontal()
                    ->help('Вы можете использовать это, когда попросите ввести адрес их веб-сайта для бизнес-каталога'),

                Input::make('tel')
                    ->type('tel')
                    ->title('Телефон')
                    ->value('1-(555)-555-5555')
                    ->horizontal()
                    ->popover('Включаются механизмы автозаполнения устройства и предлагают телефонные номера, которые могут быть автоматически заполнены одним нажатием.')
                    ->help('Фокусировка ввода на телефонном поле открывает цифровую клавиатуру, готовую к вводу номера.'),

                Input::make('password')
                    ->type('password')
                    ->title('Пароль')
                    ->value('Пароль')
                    ->horizontal(),

                Input::make('number')
                    ->type('number')
                    ->title('Номер')
                    ->value(42)
                    ->horizontal(),

                Input::make('date_and_time')
                    ->type('datetime-local')
                    ->title('Дата и время')
                    ->value('2011-08-19T13:45:00')
                    ->horizontal(),

                Input::make('date')
                    ->type('date')
                    ->title('Дата')
                    ->value('2011-08-19')
                    ->horizontal(),

                Input::make('month')
                    ->type('month')
                    ->title('Месяц')
                    ->value('2011-08')
                    ->horizontal(),

                Input::make('week')
                    ->type('week')
                    ->title('Неделя')
                    ->value('2011-W33')
                    ->horizontal(),

                Input::make('Time')
                    ->type('time')
                    ->title('Время')
                    ->value('13:45:00')
                    ->horizontal(),

                Input::make('datalist')
                    ->title('Пример Datalist')
                    ->help('Большинство браузеров включают некоторую поддержку элементов "datalist", их стиль в лучшем случае непоследователен.')
                    ->datalist([
                        'Сан-Франциско',
                        'Нью-Йорк',
                        'Сиэтл',
                        'Лос-Анджелес',
                        'Чикаго',
                    ])
                    ->horizontal(),

                Input::make('color')
                    ->type('color')
                    ->title('Цвет')
                    ->value('#563d7c')
                    ->horizontal(),

                Button::make('Submit')
                    ->method('buttonClickProcessing')
                    ->type(Color::DEFAULT()),

            ])->title('Текстовые входные данные HTML5'),
        ];
    }

    public function buttonClickProcessing()
    {
        Alert::warning('Предоставляйте контекстные сообщения обратной связи для типичных действий пользователя с помощью нескольких доступных и гибких предупреждающих сообщений.');
    }
}
