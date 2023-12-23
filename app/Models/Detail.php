<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_trx',
        'id_barang',
        'qty',
        'sub_total',
    ];

    public function getBarang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
}
