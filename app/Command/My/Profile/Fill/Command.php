<?php

namespace App\Command\My\Profile\Fill;

use App\Entity\User\Profile;
use App\Http\Requests\My\Profile\FillRequest;

class Command
{
    public $surname;
    public $patronymic;
    public $phone;
    public $code;

    public $profile;

    public function __construct(FillRequest $request, Profile $profile)
    {
        $this->surname = $request->surname;
        $this->patronymic = $request->patronymic;
        $this->phone = $request->phone;
        $this->code = $request->code;
        $this->profile = $profile;
    }
}