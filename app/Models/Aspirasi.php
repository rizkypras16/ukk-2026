<?php

namespace App\Models;

use Sakuci\Database\Model;

class Aspirasi extends Model
{
    public static ?string $table = 'pengaduan';

    protected string $primaryKey = 'id';

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    protected array $fillable = [
        'user_id',
        'id_kategori',
        'id_alat',
        'judul',
        'deskripsi',
        'foto',
        'status',
        'tanggapan',
    ];
}