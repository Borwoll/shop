<?php

namespace App\UseCases\Admin\Region;

use App\Entity\Region;
use App\UseCases\Service;
use App\Query\Region\Find\FindRegionsListQuery;
use App\Query\Region\Find\FindRegionsQuery;
use App\Command\Admin\Region\Remove\Command as RegionRemoveCommand;

class RegionManageService extends Service
{
    public function remove(Region $region): void
    {
        $this->commandBus->handle(new RegionRemoveCommand($region));
    }

    public function getRegions()
    {
        $regions = $this->queryBus->query(new FindRegionsQuery());
        return $regions;
    }

    public function getRegionsList()
    {
        $regions = $this->queryBus->query(new FindRegionsListQuery());
        return $regions;
    }
}