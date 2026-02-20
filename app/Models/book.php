<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //5 Model Buku
    protected $fillable = [
        'kd_buku',
        'judul',
        'pengarang',
        'penerbit',
        'tahun',
        'dipinjam',
    ];
    //6 Relasi dengan Transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class)
            ->where('status', 'dipinjam');
    }
}
