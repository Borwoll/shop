<?php

namespace App\Command\My\Order\Cancel;

use App\Entity\Shop\Order\Order;
use App\Entity\User\User;
use App\Http\Requests\My\Order\CancelRequest;

class Command
{
    public $userId;
    public $order;
    public $reason;

    public function __construct(Order $order, User $user, CancelRequest $request)
    {
        $this->userId = $user->id;
        $this->order = $order;
        $this->reason = $request->reason;
    }
}