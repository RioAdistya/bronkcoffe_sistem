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
                <h4><strong>Tambah Data Bahan Baku</strong></h4>
            </div>
            <hr>
            <div class="form-edit">
                <form method="post" action="/bahanBaku/store">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    {{-- Nama Bahan --}}
                    <div class="row mb-3">
                        <label for="namaBahan" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Nama Produk</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="text" id="namaBahan" list="listNama" class="form-control" name="namaBahan" placeholder="Nama Bahan Baku" autocomplete="off" required oninvalid="this.setCustomValidity('Nama tidak boleh Kosong')" oninput="this.setCustomValidity('')"/>
                            <datalist id="listNama" >
                                @foreach ($bahan_baku as $p)
                                    <option>{{ $p->namaBahan }}</option>
                                @endforeach
                            </datalist>
                            @if($errors->has('namaBahan'))
                            <div class="text-danger">
                                {{ $errors->first('namaBahan')}}
                            </div>
                        @endif
                        </div>
                    </div>
                    
                    {{-- Kuantitas --}}
                    <div class="row mb-3">
                        <label for="kuantitas" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Kuantitas</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="0" max="99999" name="kuantitas" id="kuantitas" placeholder="Kuantitas Bahan Baku" autocomplete="off" required oninvalid="this.setCustomValidity('Cek kembali jumlah stok')" oninput="this.setCustomValidity('')"/>
                            @if($errors->has('kuantitas'))
                            <div class="text-danger">
                                {{ $errors->first('kuantitas')}}
                            </div>
                        @endif
                        </div>
                    </div>

                    {{-- Harga Satuan --}}
                    <div class="row mb-3">
                        <label for="hargaSatuan" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Harga Satuan</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="500" max="100000000" step="500" name="hargaSatuan" id="hargaSatuan" placeholder="Harga Satuan" autocomplete="off" required oninvalid="this.setCustomValidity('Cek kembali harga')" oninput="this.setCustomValidity('')"/>
                            @if($errors->has('hargaSatuan'))
                            <div class="text-danger">
                                {{ $errors->first('hargaSatuan')}}
                            </div>
                        @endif
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="row mb-3">
                        <label for="keterangan" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Keterangan</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="4" placeholder="Keterangan" autocomplete="off"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-end mx-3 my-4">
                        <div class="col-sm-8 col-md-9 col-xl-10" style="text-align:end;">
                            <input type="submit" class="btn btn-success mx-3" value="Tambah">
                            <a type="button" class="btn btn-secondary border" href="/produksiBahanBaku">
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