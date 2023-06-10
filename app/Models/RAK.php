<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RAK extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_rak',
        'kapasitas',
    ];
}
