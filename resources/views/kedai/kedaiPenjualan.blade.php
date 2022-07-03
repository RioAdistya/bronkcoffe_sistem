@extends('layouts.app')
@section('content')
@include('partials.navbar')
@include('partials.sidebarKedai')
<div id="layoutSidenav_content">

    <style>
        strong, thead{
            font-family: 'Poppins', sans-serif;
        }
        </style>
    <main>
        <div class="container-fluid px-4">
        <a href="#" onclick="showStuff('tambah', this); return false;" id="btn1" class="btn btn-secondary w-100 mt-3"><i class="bi bi-arrow-bar-down"></i> Tambah</a>
            <span id="tambah" style="display: none;">
            @include('kedai.kedaiPenjualanTambah')
        </span>
            <div class="card mt-3">
                <div class="card-header text-start">
                    <i class="bi bi-table"></i> <strong>Data Penjualan Kopi</strong> 
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="month">Pilih Bulan : </label>
                        <select id="month" class="form-select" style="width: 150px">
                            <option selected hidden>{{ $periodeURL }}</option>
                            @foreach ($periodes as $periode)
                                <option value="{{ $periode }}">{{ $periode }}</option>
                            @endforeach
                        </select>
                    </div>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Kuantitas (gr)</th>
                                <th>Harga 100gr (Rp)</th>
                                <th>Harga Total (Rp)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_penjualan as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->tanggal }}</td>
                                <td>{{ $data->namaProduk }}</td>
                                <td>{{ $data->kategori }}</td>
                                <td>{{ $data->kuantitas }}</td>
                                <td>Rp. {{ number_format($data->hargaPer100Gram,2,',','.') }}</td>
                                @php 
                                if ($data->kategori=='Biji Kopi') {
                                    $harga_total = $data->kuantitas * $data->hargaPer100Gram/100;
                                } else{
                                    $harga_total = $data->kuantitas * $data->hargaPer100Gram/100;
                                }
                                @endphp
                                <td>Rp. {{ number_format($harga_total,2,',','.') }}</td>
                                <td class="text-center">
                                    <a href="/penjualan/edit/{{ $data->idPenjualan }}" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>

        var sortMonth = document.getElementById('month');
        sortMonth.addEventListener("input", function(){
            var strUser = this.value;
            var nextURL = 'http://127.0.0.1:8000/kedaiPenjualan/'+ strUser;
            window.location.replace(nextURL);
        });

        function showStuff(tambah, btn1) {
            document.getElementById(tambah).style.display = 'block';
            btn1.style.display = 'none';
        }

        var nama = document.getElementById('namaProduk');
        var kategory = document.getElementById('kategori');
        document.getElementById("kategori").disabled = true;
        document.getElementById("kuantitas").disabled = true;

        nama.addEventListener("input", function(){
            document.getElementById("kategori").disabled = false;
        });

        kategory.addEventListener("input", function(){
            document.getElementById("kuantitas").disabled = false;
        });

        function useValue() {
            var list_price = new Array;
            var nama2 = nama.value;
            var kategory2 = kategory.value;
            const data = @json($data_produk);
            const myObj = JSON.parse(JSON.stringify(data));
            for(var i in myObj) {
                if(nama2 == myObj[i]['namaProduk'] && kategory2 == myObj[i]['kategori']){
                    list_price.push(myObj[i]["harga"]);
                }
            }
            var price = list_price.slice(-1)[0];
            return price;
        }
        nama.onchange = useValue;  
        nama.onblur = useValue;
        kategory.onchange = useValue;  
        kategory.onblur = useValue;
    
        document.getElementById("kuantitas").addEventListener("input", function(){
            document.getElementById("harga").value = this.value*useValue()/100;
        });
    </script>

@endsection