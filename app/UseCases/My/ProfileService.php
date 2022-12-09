<?php

namespace App\UseCases\My;

use App\Entity\User\Profile;
use App\Query\My\Profile\Find\FindProfileByUserIdQuery;
use App\UseCases\Service;
use App\Http\Requests\My\Profile\FillRequest;
use App\Command\My\Profile\Fill\Command as FillProfileCommand;

class ProfileService extends Service
{
    public function fill(FillRequest $request, Profile $profile)
    {
        $this->commandBus->handle(new FillProfileCommand($request, $profile));
    }

    public function findProfileByUserId(int $userId)
    {
        $profile = $this->queryBus->query(new FindProfileByUserIdQuery($userId));
        return $profile;
    }
}