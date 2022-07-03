<?php

namespace Database\Seeders;

use \App\Models\User;
use \App\Models\Owner;
use \App\Models\Produk;
use \App\Models\Status;
use \App\Models\Kategori;
use \App\Models\Karyawan;
use \App\Models\DetailProduk;
use \App\Models\BahanBaku;
use \App\Models\DetailBahanBaku;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        // Users
        User::create([
            'type'=>1,
            'name'=>'Owner Mitra',
            'email'=>'owner@gmail.com',
            'password'=> bcrypt('123456')
        ]);
        User::create([
            'type'=>2,
            'name'=>'Karyawan Produksi Kopi',
            'email'=>'produksi@gmail.com',
            'password'=> bcrypt('123456')
        ]);
        User::create([
            'type'=> 3,
            'name'=>'Karyawan Kedai Kopi',
            'email'=>'kedai@gmail.com',
            'password'=> bcrypt('123456')
        ]);

        // Owner Mitra
        Owner::create([
            'namaMitra'=>'Ferdian Fernanda Syahputra',
            'type_id'=>1,
            'noTelepon'=>'082121232384',
            'alamat'=>'Jalan Ahmad Sukun, Jombang, Jawa Timur, Indonesia'
        ]);


        // Status Karyawan
        Status::create([
            'status'=>'Aktif'
        ]);
        Status::create([
            'status'=>'Tidak Aktif'
        ]);

        
        // Karyawan
        Karyawan::create([
            'namaKaryawan'=>'Lilik Dwi Wulandari',
            'type_id'=>2,
            'noTelepon'=>'08111112222',
            'alamat'=>'Desa Kabuh, Jombang, Jawa Timur, Indonesia',
            'idStatus'=>1
        ]);
        Karyawan::create([
            'namaKaryawan'=>'Rio Adistya',
            'type_id'=>2,
            'noTelepon'=>'087121232384',
            'alamat'=>'Jalan Sukaharja No 12, Kalipuro Banyuwangi, Indonesia',
            'idStatus'=>1
        ]);
        Karyawan::create([
            'namaKaryawan'=>'Muhammad Hidayatur Rahman',
            'type_id'=>2,
            'noTelepon'=>'082123451234',
            'alamat'=>'Desa Jurang Sapi, Tapen Bondowoso, Indonesia',
            'idStatus'=>2
        ]);
        Karyawan::create([
            'namaKaryawan'=>'Azimatul Hanafiyah',
            'type_id'=>3,
            'noTelepon'=>'081112344321',
            'alamat'=>'Desa Cermee, Bondowoso, Indonesia',
            'idStatus'=>1
        ]);
        Karyawan::create([
            'namaKaryawan'=>'Naadiyatushofia',
            'type_id'=>3,
            'noTelepon'=>'082132321235',
            'alamat'=>'Jalan Jaksa Agung, Blitar, Indonesia',
            'idStatus'=>1
        ]);
        Karyawan::create([
            'namaKaryawan'=>'Tiara Dwi Melinda',
            'type_id'=>3,
            'noTelepon'=>'08136780009',
            'alamat'=>'Panjii, Kabupaten Situbondo, Indonesia',
            'idStatus'=>1
        ]);


        // Produk
        Produk::create([
            'namaProduk'=>'Espresso'
        ]);
        Produk::create([
            'namaProduk'=>'Long Black'
        ]);
        Produk::create([
            'namaProduk'=>'Americano'
        ]);
        Produk::create([
            'namaProduk'=>'Cappuchino'
        ]);
        Produk::create([
            'namaProduk'=>'Latte'
        ]);

        // Kategori
        Kategori::create([
            'Kategori'=>'Biji Kopi'
        ]);
        Kategori::create([
            'Kategori'=>'Kopi Bubuk'
        ]);

    }
}
