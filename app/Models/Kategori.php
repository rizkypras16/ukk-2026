<?php

namespace App\Models;

use Sakuci\Database\Model;

class Kategori extends Model
{
    public static ?string $table = 'kategori';
    protected string $primaryKey = 'id_kategori'; // Hapus kata 'static' agar sesuai dengan class induk Sakuci

    protected array $fillable = [
        'kategori',
        'keterangan',
    ];
}