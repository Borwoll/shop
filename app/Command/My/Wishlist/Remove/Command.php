<?php

namespace App\Command\My\Wishlist\Remove;

use App\Entity\User\WishlistItem;

class Command
{
    public $item;

    public function __construct(WishlistItem $item)
    {
        $this->item = $item;
    }
}