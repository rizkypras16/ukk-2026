<?php

namespace App\Controllers\Core;

use App\Models\User;
use Sakuci\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('welcome', ['user' => User::current()]);
    }

    public function admin()
    {
        return view('welcome', ['user' => User::current()]);
    }
}

