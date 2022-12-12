<?php

namespace App\Entity\Shop\Characteristic;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Characteristic extends Model {
    use AsSource;
    public const TYPE_INTEGER = 'Integer';
    public const TYPE_FLOAT = 'Float';
    public const TYPE_STRING = 'String';

    public $timestamps = false;

    protected $table = 'shop_characteristics';
    protected $fillable = [
        'name', 'type', 'required', 'default', 'sort'
    ];

    public static function new(
        $name, $type,
        $required, $default,
        $sort
    ): self
    {
        return static::create([
            'name' => $name,
            'type' => $type,
            'required' => $required,
            'default' => $default,
            'sort' => $sort
        ]);
    }

    public function variants() {
        return $this->hasMany(Variant::class, 'id', 'characteristic_id');
    }

    public function isRequired(): bool {
        return $this->required === true;
    }

    public static function typesList(): array {
        return [
            Characteristic::TYPE_INTEGER => 'Integer',
            Characteristic::TYPE_FLOAT => 'Float',
            Characteristic::TYPE_STRING => 'String'
        ];
    }
}