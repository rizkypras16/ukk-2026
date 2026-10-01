<?php

namespace App\Models;

use Sakuci\Database\Model;

class Aspirasi extends Model
{
    public static ?string $table = 'pengaduan';

    public function kategori()
    {
        // Ubah 'id' di parameter ketiga menjadi nama primary key yang benar di tabel kategori (contoh: id_kategori atau id)
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}