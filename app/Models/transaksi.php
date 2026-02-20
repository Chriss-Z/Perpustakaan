<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';
    //7 Model Transaksi
    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];
    //8 Tanggal Pinjam dan Kembali
    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_kembali' => 'datetime',
    ];
    //9 Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //10 Relasi dengan Book
    public function book()
    {
        return $this->belongsTo(book::class);
    }
}
