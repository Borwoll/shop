<?php

namespace App\Command\My\Comparison\Remove;

use App\Entity\User\ComparisonItem;

class Command
{
    public $comparisonItem;

    public function __construct(ComparisonItem $comparisonItem)
    {
        $this->comparisonItem = $comparisonItem;
    }
}