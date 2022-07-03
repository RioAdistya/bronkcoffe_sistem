<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $table = "owner";
    // protected $fillable = ['namaKaryawan','noTelepon','alamat'];
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class,'type_id','type');
    }

}
