<?php
  
namespace App\Models;
  
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
  
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array

     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    /**
     * The attributes that should be cast.
     *
     * @var array

     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 
    /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["","owner", "produksi", "kedai"][$value],
        );
    }

    public function owner()
    {
        return $this->hasMany(Owner::class,'type_id','type');
    }

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class,'type_id','type');
    }

    public function detail_produk()
    {
        return $this->hasMany(DetailProduk::class,'type_id','type');
    }

    public function bahan_baku()
    {
        return $this->hasMany(BahanBaku::class,'type_id','type');
    }

    public function detail_penjualan()
    {
        return $this->hasMany(BahanBaku::class,'type_id','type');
    }

}