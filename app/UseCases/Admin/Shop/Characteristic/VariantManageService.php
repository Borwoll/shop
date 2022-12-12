<?php

namespace App\UseCases\Admin\Shop\Characteristic;

use App\Entity\Shop\Characteristic\Characteristic;
use App\Entity\Shop\Characteristic\Variant;
use App\Command\Admin\Shop\Characteristic\Variant\Remove\Command as VariantRemoveCommand;
use App\Query\Shop\Characteristic\Variant\Find\FindVariantsByCharacteristicIdQuery;
use App\UseCases\Service;

class VariantManageService extends Service
{
    public function remove(Variant $variant)
    {
        $this->commandBus->handle(new VariantRemoveCommand($variant));
    }

    public function getVariantsByCharacteristic($characteristic)
    {
        $variants = $this->queryBus->query(new FindVariantsByCharacteristicIdQuery($characteristic->id));
        return $variants;
    }
}