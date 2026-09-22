<?php

namespace App\Models;

use Sakuci\Database\Model;

class Kategori extends Model
{
    protected static ?string $table = 'kategori';
    protected string $primaryKey = 'id_kategori';

    protected array $fillable = [
        'id_kategori',
        'nama_lengkap',
        'kategori',
        'kelas',
        'keluhan',
        ];
}
