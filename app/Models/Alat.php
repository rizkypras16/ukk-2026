<?php

namespace App\Models;

class Alat extends \Core\Database\Model
{
    public $timestamps = false;

    protected $table = 'alat';
    
    public $kategori;
    public $nama_alat;
    public $kode_alat;
    public $kondisi;
    public $jumlah;

    protected $fillable = [
        'kategori',
        'nama_alat',
        'kode_alat',
        'kondisi',
        'jumlah'
    ];
}