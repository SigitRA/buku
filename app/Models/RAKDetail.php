<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RAKDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_barang',
        'nama_rak',
        'stok',
        'sub_total',
    ];

    public function getBarang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }

    public function getRak()
    {
        return $this->belongsTo(RAK::class, 'nama_rak', 'id');
    }
}
