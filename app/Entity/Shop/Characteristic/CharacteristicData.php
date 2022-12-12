<?php

namespace App\Entity\Shop\Characteristic;
use Orchid\Screen\AsSource;

class CharacteristicData {
    use AsSource;
    public $name;
    public $value;

    public function __construct(string $name, string $value) {
        $this->name = $name;
        $this->value = $value;
    }
}