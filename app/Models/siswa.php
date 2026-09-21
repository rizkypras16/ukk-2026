<?<?php

namespace App models;
use Sakuci\Database\Model;
class Siswa exstends Model 
{
    protected static ?string $table = 'siswa';

    protected string $primaryKey = 'id siswa';

    protected array $fillable = [
        'id user',
        'nis',
        'nama',
        'kleas'
    ]
}