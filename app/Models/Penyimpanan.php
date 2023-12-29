<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyimpanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_simpan',
        'lorong',
        'tanggal',
        'genre',
    ];
}
