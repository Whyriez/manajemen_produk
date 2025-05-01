<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiProduk extends Model
{
    use HasFactory;
    protected $table = "distribusi_produk";
    protected $fillable = [
        'id_member',
        'id_produk',
        'id_admin',
        'jumlah',
    ];

    public function member()
    {
        return $this->belongsTo(User::class, 'id_member');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
