<?php

namespace App\UseCases\My;

use App\Entity\User\User;
use App\Http\Requests\My\Profile\FillRequest;
use App\UseCases\Service;
use App\Command\My\User\Rename\Command as RenameUserCommand;

class UserService extends Service
{
    public function changeName(FillRequest $request, User $user)
    {
        $this->commandBus->handle(new RenameUserCommand($user, $request));
    }
}