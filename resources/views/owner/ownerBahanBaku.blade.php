@extends('layouts.app')
@section('content')
@include('partials.navbar')
@include('partials.sidebarOwner')
<div id="layoutSidenav_content">
    <style>
        strong, thead{
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <main>
    <div class="container-fluid px-4">
        <div class="card mt-3">
            <div class="card-header text-start">
                <i class="bi bi-table"></i> <strong>Data Bahan Baku</strong> 
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Sisa</th>
                            <th>Harga Satuan</th>
                            <th>Tanggal Input</th>
                            <th>Terakhir Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bahan_baku as $bahan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bahan->namaBahan }}</td>
                            @if($bahan->total_stok_bahan >= 5)
                                <td style="color: green">{{ $bahan->total_stok_bahan }}</td>
                            @else
                                <td style="color: red">{{ $bahan->total_stok_bahan }} (Hampir Habis)</td>
                            @endif
                            <td>Rp. {{ number_format($bahan->hargaSatuan,2,',','.') }}</td>
                            <td>{{ $bahan->created_at }}</td>
                            <td>{{ $bahan->last_updated }}</td>
                            <td class="text-center">
                                <a href="/ownerBahanBaku/detail/{{ $bahan->namaBahan }}" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection