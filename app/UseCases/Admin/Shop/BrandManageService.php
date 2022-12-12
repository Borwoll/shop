<?php

namespace App\UseCases\Admin\Shop;

use App\Entity\Shop\Brand;
use App\Command\Admin\Shop\Brand\Remove\Command as BrandRemoveCommand;
use App\Query\Shop\Brand\Find\FindBrandsQuery;
use App\UseCases\Service;

class BrandManageService extends Service
{
    public function remove(Brand $brand): void
    {
        $this->commandBus->handle(new BrandRemoveCommand($brand));
    }

    public function getBrands()
    {
        $brands = $this->queryBus->query(new FindBrandsQuery());
        return $brands;
    }
}