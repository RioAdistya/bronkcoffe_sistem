<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public $timestamps = false;
    protected $table = "produk";

    protected $guarded = ['id'];

    public function detail_produk()
    {
        return $this->hasMany(DetailProduk::class, 'idProduk', 'id');
    }

    public function detail_penjualan()
    {
        return $this->hasMany(DetailProduk::class, 'idProduk', 'id');
    }
}
