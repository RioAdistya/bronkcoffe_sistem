@extends('layouts.app')
@section('content')
@include('partials.navbar')
@include('partials.sidebarKedai')
<div id="layoutSidenav_content">
    <style>
        strong, ::placeholder {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <main>
        @foreach ($produk as $p)
        <div class="container-fluid px-4 py-4">
            <div class="header">
                <h4><strong>Edit Data Penjualan</strong></h4>
            </div>
            <hr>
            <div class="form-edit">
                <form method="get" action="/penjualan/update/{{$p->idPenjualan }}">
                    {{-- {{ csrf_field() }}
                    {{ method_field('PATCH') }} --}}

                    <input id="idPenjualan" type="number" hidden value="{{$p->idPenjualan }}">
                    {{-- Nama Produk --}}
                    <div class="row mb-3">
                        <label for="namaProduk" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Nama Produk</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="text" id="namaProduk" readonly="readonly" class="form-control" name="namaProduk" placeholder="Nama Produk" autocomplete="off" required oninvalid="this.setCustomValidity('Nama tidak boleh Kosong')" oninput="this.setCustomValidity('')" value="{{ $p->namaProduk }}"/>
                            @if($errors->has('namaProduk'))
                            <div class="text-danger">
                                {{ $errors->first('namaProduk')}}
                            </div>
                        @endif
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div class="row mb-3">
                        <label for="kategori" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Kategori</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="text" id="kategori" readonly="readonly" class="form-control" name="kategori" placeholder="Kategori " autocomplete="off" required oninvalid="this.setCustomValidity('Kategori tidak boleh Kosong')" oninput="this.setCustomValidity('')" value="{{ $p->kategori }}"/>
                                @if($errors->has('kategori'))
                                <div class="text-danger">
                                    {{ $errors->first('kategori')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Kuantitas --}}
                    <div class="row mb-3">
                        <label for="kuantitas" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Kuantitas (gr)</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="0" max="100000" name="kuantitas" id="kuantitas" placeholder="Stok Kopi" autocomplete="off" required oninvalid="this.setCustomValidity('Stok harus angka')" oninput="this.setCustomValidity('')" value="{{ $p->kuantitas }}"/>
                            @if($errors->has('kuantitas'))
                            <div class="text-danger">
                                {{ $errors->first('kuantitas')}}
                            </div>
                        @endif
                        </div>
                    </div>

                    {{-- Harga Per100Gram --}}
                    <div class="row mb-3">
                        <label for="harga" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Harga 100gr (Rp)</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="0" readonly="readonly" name="harga" id="harga" placeholder="Harga Per 100 Gram" autocomplete="off" required oninvalid="this.setCustomValidity('Inputan Min 1000')" oninput="this.setCustomValidity('')" value="{{ $p->hargaPer100Gram }}"/>
                            @if($errors->has('harga'))
                            <div class="text-danger">
                                {{ $errors->first('harga')}}
                            </div>
                        @endif
                        </div>
                    </div>

                    {{-- Harga Total --}}
                    <div class="row mb-3">
                        <label for="hargaTotal" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Harga Total (Rp)</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" readonly="readonly" min="0" name="hargaTotal" id="hargaTotal" placeholder="Harga Per 100 Gram" autocomplete="off" required oninvalid="this.setCustomValidity('Inputan Min 1000')" oninput="this.setCustomValidity('')" value="{{ $p->hargaPer100Gram*$p->kuantitas /100 }}"/>
                            @if($errors->has('hargaTotal'))
                            <div class="text-danger">
                                {{ $errors->first('hargaTotal')}}
                            </div>
                        @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3 justify-content-end mx-3 my-4">
                        <div class="col-sm-8 col-md-9 col-xl-10" style="text-align:end;">
                            {{-- <a type="submit" id="edit" class="btn btn-success mx-3" stokLama="{{ $p->kuantitas }}">{{ __('Simpan') }}</a> --}}
                            <button class="btn btn-success mx-3">Simpan</button>
                            <a type="button" class="btn btn-secondary border" href="/kedaiPenjualan/Keseluruhan">
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
    @endforeach

<script 
    src="https://code.jquery.com/jquery-3.6.0.slim.js"  integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
    crossorigin="anonymous">
</script>
<script>
    var hargaSatuan = document.getElementById('harga').value;
    var kuantitas = document.getElementById('kuantitas').value;
    var idPenjualan = document.getElementById('idPenjualan').value;

    document.getElementById("kuantitas").addEventListener("input", function(){
        document.getElementById("hargaTotal").value = this.value*hargaSatuan/100;
    });

</script>
@endsection 