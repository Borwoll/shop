<?php

namespace App\Orchid\Screens\Examples;

use Orchid\Platform\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateRange;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Map;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Range;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\UTM;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ExampleFieldsAdvancedScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'name'  => 'Привет! Мы собрали все поля в одном месте',
            'place' => [
                'lat' => 37.181244855427394,
                'lng' => -3.6021993309259415,
            ],
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Расширенные элементы управления формами';
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
     * @throws \Throwable
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [

            Layout::rows([

                Group::make([
                    Input::make('phone')
                        ->mask('(999) 999-9999')
                        ->title('Телефон')
                        ->placeholder('Введите номер телефона')
                        ->help('Номер телефона'),

                    Input::make('ip_address')
                        ->title('IP-адрес:')
                        ->placeholder('Введите адрес')
                        ->help('Задает адрес в формате IPv4')
                        ->mask([
                            'alias' => 'ip',
                        ]),

                    Input::make('license_plate')
                        ->title('Номерной знак:')
                        ->mask([
                            'mask' => '[9-]AAA-999',
                        ]),
                ]),

                Group::make([

                    Input::make('credit_card')
                        ->mask('9999-9999-9999-9999')
                        ->title('Кредитная карта:')
                        ->placeholder('Номер кредитной карты')
                        ->help('Номер - это длинный набор цифр, отображаемый на лицевой стороне вашей пластиковой карты'),

                    Input::make('currency')
                        ->title('Валюта доллар:')
                        ->mask([
                            'alias' => 'currency',
                        ])->help('Некоторые псевдонимы, найденные в расширениях: электронная почта, валюта, десятичное число, целое число, дата, datetime, дд / мм /гггг и т.д.'),

                    Input::make('currency')
                        ->title('Валюта евро:')
                        ->mask([
                            'mask'         => '€ 999.999.999,99',
                            'numericInput' => true,
                        ]),
                ]),

            ])->title('Маска ввода'),

            Layout::rows([

                Group::make([
                    DateTimer::make('open')
                        ->title('Дата открытия')
                        ->help('Мероприятие по открытию состоится'),

                    DateTimer::make('allowInput')
                        ->title('Разрешить ввод')
                        ->required()
                        ->allowInput(),

                    DateTimer::make('enabledTime')
                        ->title('Включенное время')
                        ->enableTime(),
                ]),

                Group::make([
                    DateTimer::make('AllowEmpty')
                        ->title('Разрешить пустой')
                        ->allowEmpty(),

                    DateTimer::make('AvailableDates')
                        ->title('Доступные даты')
                        ->available([
                            now(),
                            now()->addDays(2),
                            now()->addDays(3),
                        ]),

                    DateTimer::make('AvailableDatesPeriod')
                        ->title('Доступные даты Период')
                        ->available([
                            ['from' => now(), 'to' => now()->addWeek()],
                        ]),
                ]),

                Group::make([
                    DateTimer::make('format24hr')
                        ->title('Формат 24 часа')
                        ->enableTime()
                        ->format24hr(),

                    DateTimer::make('custom')
                        ->title('Пользовательский формат')
                        ->noCalendar()
                        ->format('h:i K'),

                    DateRange::make('rangeDate')
                        ->title('Диапазон дат'),
                ]),

            ])->title('Дата и время'),

            Layout::columns([
                Layout::rows([
                    Select::make('robot.')
                        ->options([
                            'index'   => 'Индекс',
                            'noindex' => 'Нет индекса',
                        ])
                        ->multiple()
                        ->title('Множественный выбор')
                        ->help('Разрешить поисковым ботам индексировать'),

                    Relation::make('user')
                        ->fromModel(User::class, 'name')
                        ->title('Выберите для красноречивой модели'),
                ])->title('Выбрать'),
                Layout::rows([

                    Group::make([
                        CheckBox::make('free-checkbox')
                            ->sendTrueOrFalse()
                            ->title('Свободный флажок')
                            ->placeholder('Мероприятие бесплатно')
                            ->help('Мероприятие бесплатно'),

                        Switcher::make('free-switch')
                            ->sendTrueOrFalse()
                            ->title('Свободный переключатель')
                            ->placeholder('Мероприятие бесплатно')
                            ->help('Мероприятие бесплатно'),
                    ]),

                    RadioButtons::make('radioButtons')
                        ->options([
                            1 => 'Включенный',
                            0 => 'Выключенный',
                            3 => 'На паузе',
                            4 => 'Работает',
                        ])
                        ->help('Переключатели обычно представлены в группах радио'),

                ])->title('Статус'),
            ]),

            Layout::rows([
                Group::make([
                    Range::make('range')
                        ->title('Примерный диапазон')
                        ->max(5)
                        ->min(0)
                        ->step(1)
                        ->help('Дорожка и большой палец оформлены так, чтобы они выглядели одинаково во всех браузерах.'),

                    Range::make('range_disabled')
                        ->title('Отключенный диапазон')
                        ->disabled(),
                ]),
            ])->title('Диапазон'),

            Layout::rows([

                Input::make('raw_file')
                    ->type('file')
                    ->title('Пример ввода файла')
                    ->horizontal(),

                Input::make('raw_files')
                    ->type('file')
                    ->title('Пример ввода нескольких файлов')
                    ->multiple()
                    ->horizontal(),

                Picture::make('picture')
                    ->title('Изображение')
                    ->horizontal(),

                Cropper::make('cropper')
                    ->title('Кроппер')
                    ->width(500)
                    ->height(300)
                    ->horizontal(),

                Upload::make('files')
                    ->title('Загрузить файлы')
                    ->horizontal(),

                Upload::make('files_with_catalog')
                    ->title('Загрузка с каталогом')
                    ->media()
                    ->closeOnAdd()
                    ->horizontal(),

            ])->title('Загрузка файла'),

            Layout::rows([

                UTM::make('link')
                    ->title('Ссылка UTM')
                    ->help('Сгенерированная ссылка UTM'),

                Matrix::make('matrix')
                    ->columns([
                        'Атрибут',
                        'Значения',
                        'Единицы',
                    ]),

                Map::make('place')
                    ->title('Объект на карте')
                    ->help('Введите координаты или воспользуйтесь поиском'),

            ])->title('Расширенное'),
        ];
    }
}
