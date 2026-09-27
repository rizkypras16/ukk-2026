<?php

namespace App\Models;

use Sakuci\Database\Model;

class Pengaduan extends Model
{
    protected static ?string $table = 'pengaduan';

    public static function createData($data)
    {
        return static::query()->insert($data);
    }
}