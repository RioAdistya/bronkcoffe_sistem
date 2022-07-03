<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = "detail_penjualan";

    protected $guarded = ['id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'idProduk', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idKategori', 'id');
    }
}
