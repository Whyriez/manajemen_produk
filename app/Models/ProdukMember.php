<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukMember extends Model
{
    use HasFactory;
    protected $table = "produk_member";
    protected $fillable = [
        'id_produk',
        'id_member',
        'jumlah_terima'
    ];
}
