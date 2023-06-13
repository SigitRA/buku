<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RAKDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_inventaris',
        'id_barang',
        'stok',
        'sub_total',
    ];

    public function getBarang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
}
