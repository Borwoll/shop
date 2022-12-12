<?php

namespace App\Entity\Shop\Characteristic;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model {
    use AsSource;
    public $timestamps = false;

    protected $table = 'shop_characteristic_variants';
    protected $fillable = [
        'name', 'characteristic_id'
    ];

    public static function new(
        int $characteristic_id,
        string $name
    ): self
    {
        return static::create([
            'characteristic_id' => $characteristic_id,
            'name' => $name
        ]);
    }
}