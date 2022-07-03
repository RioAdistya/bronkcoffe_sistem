@extends('layouts.app')
@section('content')
@include('partials.navbar')
@include('partials.sidebarProduksi')
<div id="layoutSidenav_content">
    <style>
        strong, thead{
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <main>
    <div class="container-fluid px-4">
        <div class="card mt-3">
            @foreach($bahan_baku as $bahan)
            <div class="card-header text-start">
                <i class="bi bi-table"></i> <strong>Riwayat Penggunaan {{ $bahan->namaBahan }}</strong> 
            </div>
            @php break; @endphp
            @endforeach
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Kuantitas</th>
                            <th>Harga Satuan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bahan_baku as $bahan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bahan->updated_at }}</td>
                            <td>{{ $bahan->namaBahan }}</td>
                            @if($bahan->kuantitas > 0)
                                <td style="color: green">{{ $bahan->kuantitas }}</td>
                            @elseif ($bahan->kuantitas < 0)
                                <td style="color: red">{{ $bahan->kuantitas }}</td>
                            @else
                                <td style="color: black">{{ $bahan->kuantitas }}</td>
                            @endif
                            <td>Rp. {{ number_format($bahan->hargaSatuan,2,',','.') }}</td>
                            <td style="width: 300px;">{{ $bahan->keterangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>       
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-3">
            <a href="/produksiBahanBaku" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
    </div>
@endsection