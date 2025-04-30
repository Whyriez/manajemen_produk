<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksi";
    protected $fillable = [
        'kode_trx',
        'id_produk',
        'id_member',
        'tanggal',
        'jumlah_terjual'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'id_member');
    }
}
