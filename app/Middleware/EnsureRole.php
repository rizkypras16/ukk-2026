<?php

namespace App\Middleware;

use App\Models\User;
use Sakuci\Http\Request;
use Sakuci\Middleware;

abstract class EnsureRole extends Middleware
{
    abstract protected function roles(): array;

    public function handle(Request $request, \Closure $next): mixed
    {
        $user = User::current();

        if ($user === null) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (! $user->hasRole(...$this->roles())) {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}