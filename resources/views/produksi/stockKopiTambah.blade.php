@extends('layouts.app')
@section('content')
@include('partials.navbar')
@include('partials.sidebarProduksi')
<div id="layoutSidenav_content">
    <style>
        strong, ::placeholder {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <main>
        <div class="container-fluid px-4 py-4">
            <div class="header">
                <h4><strong>Tambah Data Produk</strong></h4>
            </div>
            <hr>
            <div class="form-edit">
                <form method="post" action="/stockKopi/store">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    {{-- Nama Produk --}}
                    <div class="row mb-3">
                        <label for="nama" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Nama Produk</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="text" id="namaProduk" list="listNama" class="form-control" name="namaProduk" placeholder="Nama Produk" autocomplete="off" required oninvalid="this.setCustomValidity('Nama tidak boleh Kosong')" oninput="this.setCustomValidity('')"/>
                            <datalist id="listNama" >
                                @foreach ($produk as $p)
                                    <option>{{ $p->namaProduk }}</option>
                                @endforeach
                            </datalist>
                            @if($errors->has('namaProduk'))
                            <div class="text-danger">
                                {{ $errors->first('namaProduk')}}
                            </div>
                        @endif
                        </div>
                    </div>
                    <hr style="width:100%">
                    {{-- Kategori --}}
                    <div class="row mb-3">
                        <label for="kategori" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Kategori</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <select name="kategori" class="form-select" >
                                <option value="1">Biji Kopi</option>
                                <option value="2">Kopi Bubuk</option>
                            </select>
                                @if($errors->has('idKategori'))
                                    <div class="text-danger">
                                        {{ $errors->first('kategori')}}
                                    </div>
                                @endif
                        </div>
                    </div>

                    {{-- Stok --}}
                    <div class="row mb-3">
                        <label for="stok" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Stok (gr)</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="0" max="99999"  name="jumlahStok" id="jumlahStok" placeholder="Stok Kopi" autocomplete="off" required oninvalid="this.setCustomValidity('Cek kembali jumlah stok')" oninput="this.setCustomValidity('')"/>
                            @if($errors->has('jumlahStok'))
                            <div class="text-danger">
                                {{ $errors->first('jumlahStok')}}
                            </div>
                        @endif
                        </div>
                    </div>

                    {{-- Harga Per100Gram --}}
                    <div class="row mb-3">
                        <label for="hargaPer100Gram" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Harga 100gr (Rp)</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="0" max="9999999999" step="500" name="hargaPer100Gram" id="hargaPer100Gram" placeholder="Harga Per 100 Gram" autocomplete="off" required oninvalid="this.setCustomValidity('Cek kembali harga')" oninput="this.setCustomValidity('')"/>
                            @if($errors->has('hargaPer100Gram'))
                            <div class="text-danger">
                                {{ $errors->first('hargaPer100Gram')}}
                            </div>
                        @endif
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-end mx-3 my-4">
                        <div class="col-sm-8 col-md-9 col-xl-10" style="text-align:end;">
                            <input type="submit" class="btn btn-success mx-3" value="Tambah">
                            <a type="button" class="btn btn-secondary border" href="/produksiStockKopi">
                                Batal
                            </a>
                        </div>
                    </div>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </main>
@endsection