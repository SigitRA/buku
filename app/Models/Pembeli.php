<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_trx',
        'nama_pembeli',
        'tanggal',
        'jenis_kelamin',
    ];
}
