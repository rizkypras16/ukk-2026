<?php

namespace App\Models;

use Sakuci\Database\Model;

class Alat extends Model
{
    protected static ?string $table = 'alat';
    protected string $primaryKey = 'id_alat';

    public bool $timestamps = false;

    protected array $fillable = [
        'id_kategori',
        'kode_alat',
        'nama_alat',
        'jumlah',
        'kondisi',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}