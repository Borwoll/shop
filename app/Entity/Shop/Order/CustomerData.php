<?php

namespace App\Entity\Shop\Order;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class CustomerData extends Model {
    use AsSource;
    public $timestamps = false;

    protected $table = 'shop_order_customer_data';
    protected $fillable = [
        'name', 'surname',
        'patronymic', 'email', 'phone'
    ];

    public static function new(
        string $name, string $surname,
        string $patronymic, string $email,
        int $phone
    )
    {
        return static::create([
            'name' => $name,
            'surname' => $surname,
            'patronymic' => $patronymic,
            'email' => $email,
            'phone' => $phone
        ]);
    }
}