<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBahanBaku extends Model
{
    protected $table = "detail_bahan_baku";

    protected $guarded = ['id'];

    public function bahan_baku()
    {
        return $this->hasMany(BahanBaku::class,'idBahan','id');
    }

    public function users()
    {
        return $this->belongsTo(Users::class,'type_id','type');
    }
}
