<?php

namespace App\Query\My\Profile\Find;

class FindProfileByUserIdQuery
{
    public $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }
}