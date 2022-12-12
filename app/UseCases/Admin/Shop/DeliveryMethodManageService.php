<?php

namespace App\UseCases\Admin\Shop;

use App\Entity\Shop\DeliveryMethod;
use App\Query\Shop\DeliveryMethod\Find\FindMethodsQuery;
use App\UseCases\Service;
use App\Command\Admin\Shop\DeliveryMethod\Remove\Command as RemoveDeliveryMethodCommand;

class DeliveryMethodManageService extends Service {
    public function remove(DeliveryMethod $deliveryMethod) {
        $this->commandBus->handle(new RemoveDeliveryMethodCommand($deliveryMethod));
    }

    public function getMethods() {
        $methods = $this->queryBus->query(new FindMethodsQuery());
        return $methods;
    }
}