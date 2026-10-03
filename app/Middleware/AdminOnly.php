<?php

namespace App\Middleware;

// Jika EnsureRole berada di namespace yang sama, pastikan terpanggil atau extend langsung ke Middleware utama jika EnsureRole adalah class abstrak turunan Middleware
class AdminOnly extends EnsureRole
{
    protected function roles(): array
    {
        return ['admin'];
    }
}