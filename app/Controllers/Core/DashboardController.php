<?php

namespace App\Controllers\Core;

use App\Models\User;
use App\Models\Siswa;
use Sakuci\Controller;

class DashboardController extends Controller
{
public function index()
{
    $user = User::current();
    $siswa = Siswa::firstWhere('id_user', $user->id_user);

    return view('core.dashboard.siswa', [
        'user'  => $user,
        'siswa' => $siswa,
    ]);
}

public function admin()
{
    return view('core.dashboard.admin', ['user' => User::current()]);
}
}

