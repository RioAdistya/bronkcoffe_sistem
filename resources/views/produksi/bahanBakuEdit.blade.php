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
        @foreach ($bahan_baku as $p)
        <div class="container-fluid px-4 py-4">
            <div class="header">
                <h4><strong>Edit Data Bahan Baku</strong></h4>
            </div>
            <hr>
            <div class="form-edit">
                <form method="post" action="/bahanBaku/update/{{$p->namaBahan}}/{{ $p->kuantitas }}/{{ $p->hargaSatuan }}/{{ $p->keterangan }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    {{-- Nama Bahan --}}
                    <div class="row mb-3">
                        <label for="namaBahan" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Nama Produk</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="text" id="namaBahan" readonly="readonly" class="form-control" name="namaBahan" placeholder="Nama Bahan Baku" autocomplete="off" required oninvalid="this.setCustomValidity('Nama tidak boleh Kosong')" oninput="this.setCustomValidity('')" value="{{ $p->namaBahan }}"/>
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
                            <input type="number" class="form-control" min="0" max="99999" name="kuantitas" id="kuantitas" placeholder="Kuantitas" autocomplete="off" required oninvalid="this.setCustomValidity('Cek kembali jumlah stok')" oninput="this.setCustomValidity('')" value="{{ $p->total_stok_bahan }}"/>
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
                            <input type="number" class="form-control" min="500" max="100000000" step="500" name="hargaSatuan" id="hargaSatuan" placeholder="Harga Satuan" autocomplete="off" required oninvalid="this.setCustomValidity('Cek kembali harga')" oninput="this.setCustomValidity('')" value="{{ $p->hargaSatuan }}"/>
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
                            <a type="submit" id="edit" class="btn btn-success mx-3" stokLama="{{ $p->total_stok_bahan }}">{{ __('Simpan') }}</a>
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
<script 
    src="https://code.jquery.com/jquery-3.6.0.slim.js"  integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
    crossorigin="anonymous">
</script>
<script>
    var kuantitas = document.getElementById("kuantitas");
    var namaBahan = document.getElementById("namaBahan");
    var hargaSatuan = document.getElementById("hargaSatuan");
    var keterangan = document.getElementById("keterangan");

    $('#edit').click(function(){
        var stokLama = $(this).attr('stokLama');
        var stokBaru = kuantitas.value - stokLama;

        if (kuantitas.value.length == 0 || kuantitas.value < 0){
            Swal.fire({
                title: 'Maaf',
                text: "Kuantitas atau harga tidak boleh kosong.",
                icon: 'warning',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonColor: '#ffc107',
                cancelButtonText: 'OK',
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/bahanBaku/edit/"+namaBahan.value;
                }
            })
        } else if (hargaSatuan.value.length == 0 || hargaSatuan.value < 0){
            Swal.fire({
                title: 'Maaf',
                text: "Kuantitas atau harga tidak boleh kosong.",
                icon: 'warning',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonColor: '#ffc107',
                cancelButtonText: 'OK',
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/bahanBaku/edit/"+hargaSatuan.value;
                }
            })          
        } else{
            if (stokBaru > 0 && stokBaru <= 99999 ){
                if (hargaSatuan.value.length >= 11 || hargaSatuan.value.length < 3 || hargaSatuan.value%500 != 0){
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
                            window.location = "/bahanBaku/edit/"+hargaSatuan.value;
                        }
                    }) 
                } else {
                    Swal.fire({
                        title: 'Yakin?',
                        text: "Ingin menambahkan jumlah " + namaBahan.value +" sebanyak "+ stokBaru + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Batal'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            if (keterangan.value == ""){
                                keterangan.value = "-"
                                window.location = "/bahanBaku/update/"+namaBahan.value+"/"+kuantitas.value+"/"+hargaSatuan.value+"/"+keterangan.value;
                            } else{
                                window.location = "/bahanBaku/update/"+namaBahan.value+"/"+kuantitas.value+"/"+hargaSatuan.value+"/"+keterangan.value;
                            }
                        }
                    })
                }
            } else if (stokBaru < 0 && stokBaru <= 99999 ) {
                if (hargaSatuan.value.length >= 11 || hargaSatuan.value.length < 3 || hargaSatuan.value%500 != 0){
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
                            window.location = "/bahanBaku/edit/"+hargaSatuan.value;
                        }
                    }) 
                } else {
                    Swal.fire({
                        title: 'Yakin?',
                        text: "Ingin mengurangi jumlah " + namaBahan.value +" sebanyak "+ Math.abs(stokBaru) + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Batal'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            if (keterangan.value == ""){
                                keterangan.value = "-"
                                window.location = "/bahanBaku/update/"+namaBahan.value+"/"+kuantitas.value+"/"+hargaSatuan.value+"/"+keterangan.value;
                            } else{
                                window.location = "/bahanBaku/update/"+namaBahan.value+"/"+kuantitas.value+"/"+hargaSatuan.value+"/"+keterangan.value;
                            }
                        }
                    })  
                }
            } else if (stokBaru == 0){
                Swal.fire({
                    title: 'Maaf',
                    text: "Anda belum mengedit kuantitas bahan baku.",
                    icon: 'warning',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#ffc107',
                    cancelButtonText: 'OK',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/bahanBaku/edit/"+namaBahan.value;
                    }
                })
            } else{
                Swal.fire({
                    title: 'Maaf',
                    text: "Kuantitas bahan baku melebihi jumlah maksimum.",
                    icon: 'warning',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#ffc107',
                    cancelButtonText: 'OK',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/bahanBaku/edit/"+namaBahan.value;
                    }
                })
            }
        }
    })
    
</script>
@endforeach
@endsection