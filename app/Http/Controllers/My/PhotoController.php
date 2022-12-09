<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use App\Http\Requests\My\Photo\CreateRequest;
use App\UseCases\My\PhotoService;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    private $service;

    public function __construct(PhotoService $service)
    {
        $this->service = $service;
    }

    public function show()
    {
        $user = Auth::user();

        return view('my.photo.show', compact('user'));
    }

    public function store(CreateRequest $request)
    {
        $this->service->create($request, Auth::user());

        return redirect()->route('my.photo.show');
    }
}