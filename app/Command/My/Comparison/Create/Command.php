<?php

namespace App\Command\My\Comparison\Create;

use App\Entity\User\User;

class Command
{
    public $userId;
    public $productId;

    public function __construct(User $user, int $productId)
    {
        $this->userId = $user->id;
        $this->productId = $productId;
    }
}