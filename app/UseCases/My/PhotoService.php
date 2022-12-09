<?php

namespace App\UseCases\My;

use App\Entity\User\User;
use App\Http\Requests\My\Photo\CreateRequest;
use App\UseCases\Service;
use App\Command\My\Photo\Upload\Command as UploadUserPhotoCommand;

class PhotoService extends Service
{
    public function create(CreateRequest $request, User $user)
    {
        $this->commandBus->handle(new UploadUserPhotoCommand($user, $request));
    }
}