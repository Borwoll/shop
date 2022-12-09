<?php

namespace App\Http\Controllers;
use App\UseCases\Shop\CategoryService;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
}
