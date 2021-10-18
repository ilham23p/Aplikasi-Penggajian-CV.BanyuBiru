<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $fillable = [
        'name', 'gapok', 'tunjangan', 'lembur','uang_makan','pendidikan_min','kode_jabatan'
    ];
}
