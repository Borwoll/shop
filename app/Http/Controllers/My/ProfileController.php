<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use App\Http\Requests\My\Profile\FillRequest;
use App\UseCases\My\ProfileService;
use App\UseCases\My\UserService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $profileService;
    private $userService;

    public function __construct(
        ProfileService $profileService,
        UserService $userService
    )
    {
        $this->profileService = $profileService;
        $this->userService = $userService;
    }

    public function index()
    {
        $user = Auth::guard()->user();

        return view('my.profile.index', compact('user'));
    }

    public function fillForm()
    {
        $user = Auth::guard()->user();

        return view('my.profile.fill', compact('user'));
    }

    public function fill(FillRequest $request)
    {
        $profile = $this->profileService->findProfileByUserId(Auth::guard()->id());

        $this->userService->changeName($request, Auth::guard()->user());
        $this->profileService->fill($request, $profile);

        return redirect()->route('my.profile.index');
    }
}