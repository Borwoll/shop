<?php

namespace App\UseCases\Admin\Shop\Characteristic;

use App\Entity\Shop\Characteristic\Characteristic;
use App\Command\Admin\Shop\Characteristic\Characteristic\Remove\Command as CharacteristicRemoveCommand;
use App\Query\Shop\Characteristic\Characteristic\Find\FindCharacteristicsQuery;
use App\Query\Shop\Characteristic\Characteristic\GetTypesListQuery;
use App\Query\Shop\Characteristic\Variant\Find\FindVariantsByCharacteristicIdQuery;
use App\UseCases\Service;

class CharacteristicManageService extends Service
{
    public function remove(Characteristic $characteristic): void
    {
        $this->commandBus->handle(new CharacteristicRemoveCommand($characteristic));
    }

    public function getCharacteristics()
    {
        $characteristics = $this->queryBus->query(new FindCharacteristicsQuery());
        return $characteristics;
    }

    public function getTypes(): array
    {
        $types = $this->queryBus->query(new GetTypesListQuery());
        return $types;
    }

    public function getVariantsByCharacteristic($characteristic)
    {
        $variants = $this->queryBus->query(new FindVariantsByCharacteristicIdQuery($characteristic->id));
        return $variants;
    }
}