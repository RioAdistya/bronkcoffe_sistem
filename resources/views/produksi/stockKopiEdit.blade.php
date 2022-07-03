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
        @foreach ($produk as $p)
        <div class="container-fluid px-4 py-4">
            <div class="header">
                <h4><strong>Edit Data Produk</strong></h4>
            </div>
            <hr>
            <div class="form-edit">
                <form method="post" action="/stockKopi/update/{{$p->namaProduk}}/{{ $p->kategori }}/{{ $p->jumlahStok }}/{{ $p->hargaPer100Gram }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

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

                    {{-- Stok --}}
                    <div class="row mb-3">
                        <label for="stok" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Jumlah Stok</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="0" max="99999" name="jumlahStok" id="jumlahStok" placeholder="Stok Kopi" autocomplete="off" required oninvalid="this.setCustomValidity('Stok harus angka')" oninput="this.setCustomValidity('')" value="{{ $p->total_stok }}"/>
                            @if($errors->has('jumlahStok'))
                            <div class="text-danger">
                                {{ $errors->first('jumlahStok')}}
                            </div>
                        @endif
                        </div>
                    </div>

                    {{-- Harga Per100Gram --}}
                    <div class="row mb-3">
                        <label for="hargaPer100Gram" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Harga gr (Rp)</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">

                            @if($p->kategori=='Biji Kopi')
                                @foreach ($last_price_biji as $lp)
                                    <input type="number" class="form-control" min="500" max="100000000" step="500" name="hargaPer100Gram" id="hargaPer100Gram" placeholder="Harga Per 100 Gram" autocomplete="off" required oninvalid="this.setCustomValidity('Inputan Min 1000')" oninput="this.setCustomValidity('')" value="{{ $lp }}"/>
                                @endforeach
                            @else
                                @foreach ($last_price_bubuk as $lp)    
                                    <input type="number" class="form-control" min="500" max="100000000" step="500" name="hargaPer100Gram" id="hargaPer100Gram" placeholder="Harga Per 100 Gram" autocomplete="off" required oninvalid="this.setCustomValidity('Inputan Min 1000')" oninput="this.setCustomValidity('')" value="{{ $lp }}"/>
                                @endforeach
                            @endif

                            @if($errors->has('hargaPer100Gram'))
                            <div class="text-danger">
                                {{ $errors->first('hargaPer100Gram')}}
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
                    
                    <div class="row mb-3 justify-content-end mx-3 my-4">
                        <div class="col-sm-8 col-md-9 col-xl-10" style="text-align:end;">
                            <a type="submit" id="edit" class="btn btn-success mx-3" stokLama="{{ $p->total_stok }}">{{ __('Simpan') }}</a>
                            <a type="button" class="btn btn-secondary border" href="/produksiStockKopi/detail/{{ $p->namaProduk}}">
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
<script 
    src="https://code.jquery.com/jquery-3.6.0.slim.js"  integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
    crossorigin="anonymous">
</script>
<script>

    var namaProduk = document.getElementById("namaProduk");
    var kategori = document.getElementById("kategori");
    var jumlahStok = document.getElementById("jumlahStok");
    var hargaPer100Gram = document.getElementById("hargaPer100Gram");

    $('#edit').click(function(){
        var stokLama = $(this).attr('stokLama');
        var stokBaru = jumlahStok.value - stokLama;

        if (jumlahStok.value.length == 0 || jumlahStok.value <= 0){
            Swal.fire({
                title: 'Maaf',
                text: "Stok atau harga tidak boleh kosong.",
                icon: 'warning',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonColor: '#ffc107',
                cancelButtonText: 'OK',
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/stockKopi/edit/"+namaProduk.value+"/"+kategori.value;
                }
            })
        } else if (hargaPer100Gram.value.length == 0 || hargaPer100Gram.value <= 0){
            Swal.fire({
                title: 'Maaf',
                text: "Stok atau harga tidak boleh kosong.",
                icon: 'warning',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonColor: '#ffc107',
                cancelButtonText: 'OK',
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/stockKopi/edit/"+namaProduk.value+"/"+kategori.value;
                }
            })
        } else{
            if (stokBaru > 0 && stokBaru <= 99999){
                if (hargaPer100Gram.value.length >= 11 || hargaPer100Gram.value.length < 3 || hargaPer100Gram.value%500 != 0){
                    Swal.fire({
                        title: 'Maaf',
                        text: "Cek kembali harga yang anda inputkan dan inputan minimal 500",
                        icon: 'warning',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonColor: '#ffc107',
                        cancelButtonText: 'OK',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "/stockKopi/edit/"+namaProduk.value+"/"+kategori.value;
                        }
                    }) 
                } else{
                    Swal.fire({
                        title: 'Yakin?',
                        text: "Akan menambahkan stok kopi sebanyak "+ stokBaru + " gram",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Batal'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "/stockKopi/update/"+namaProduk.value+"/"+kategori.value+"/"+jumlahStok.value+"/"+hargaPer100Gram.value;
                        }
                    })
                }
            } else if (stokBaru < 0 && stokBaru <= 99999) {
                if (hargaPer100Gram.value.length >= 11 || hargaPer100Gram.value.length < 3 || hargaPer100Gram.value%500 != 0){
                    Swal.fire({
                        title: 'Maaf',
                        text: "Cek kembali harga yang anda inputkan dan inputan minimal Rp.500",
                        icon: 'warning',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonColor: '#ffc107',
                        cancelButtonText: 'OK',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "/stockKopi/edit/"+namaProduk.value+"/"+kategori.value;
                        }
                    }) 
                }else{
                    Swal.fire({
                        title: 'Yakin?',
                        text: "Akan mengurangi stok kopi sebanyak "+ Math.abs(stokBaru) + " gram",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Batal'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "/stockKopi/update/"+namaProduk.value+"/"+kategori.value+"/"+jumlahStok.value+"/"+hargaPer100Gram.value;
                        }
                    })
                }
            } else if (stokBaru == 0){
                Swal.fire({
                    title: 'Maaf',
                    text: "Anda belum menambah atau mengurangi stok.",
                    icon: 'warning',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#ffc107',
                    cancelButtonText: 'OK',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/stockKopi/edit/"+namaProduk.value+"/"+kategori.value
                    }
                })
            } else {
                Swal.fire({
                    title: 'Maaf',
                    text: "Stok melebihi jumlah maksimum.",
                    icon: 'warning',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#ffc107',
                    cancelButtonText: 'OK',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/stockKopi/edit/"+namaProduk.value+"/"+kategori.value
                    }
                })
            }
        }
    })
    
</script>
@endforeach
@endsection