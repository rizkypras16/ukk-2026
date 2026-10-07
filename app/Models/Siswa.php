<?php

namespace App\Models;

use Sakuci\Database\Model;

class Siswa extends Model 
{
    protected static ?string $table = 'siswa';

    protected string $primaryKey = 'id_siswa';

    protected array $fillable = [
        'id_user',
        'id_kategori',
        'nis',
        'nama',
        'kelas',
    ];

   // Relasi ke User
public function user()
{
    return $this->belongsTo(User::class, 'id_user', 'id_user');
}

// Relasi ke Kategori
public function kategori()
{
    return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
}
}