<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;
    protected $table = "status";

    protected $guarded = ['id'];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'idStatus', 'id');
    }
}
