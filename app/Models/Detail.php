<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_simpan',
        'id_buku',
        'stok',
        'sub_total',
    ];

    public function getBuku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id');
    }
}
