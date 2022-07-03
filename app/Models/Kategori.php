<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Kategori extends Model
{
    public $timestamps = false;
    protected $table = "kategori";

    protected $guarded = ['id'];

    public function detail_produk()
    {
        return $this->hasMany(DetailProduk::class, 'idKategori', 'id');
    }

    public function detail_penjualan()
    {
        return $this->hasMany(DetailProduk::class, 'idKategori', 'id');
    }

}
