<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    public $timestamps = false;
    protected $table = "bahan_baku";

    protected $guarded = ['id'];

    public function detail_bahan_baku()
    {
        return $this->belongsTo(DetailBahanBaku::class,'idBahan','id');
    }

}
