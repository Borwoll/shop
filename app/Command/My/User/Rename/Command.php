<?php

namespace App\Command\My\User\Rename;

use App\Entity\User\User;
use App\Http\Requests\My\Profile\FillRequest;

class Command
{
    public $name;

    public $user;

    public function __construct(User $user, FillRequest $request)
    {
        $this->user = $user;
        $this->name = $request->name;
    }
}