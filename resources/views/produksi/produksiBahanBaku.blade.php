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
            <div class="card-header text-start">
                <i class="bi bi-table"></i> <strong>Data Bahan Baku</strong> 
            </div>
            <div class="card-body">
                <a href="/bahanBaku/tambah" class="btn btn-success mb-3"><i class="bi bi-plus-circle"></i> Tambah Bahan Baru</a>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Sisa</th>
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
                            @elseif($bahan->total_stok_bahan == 0)
                                <td style="color: red">{{ $bahan->total_stok_bahan }} (Habis)</td>
                            @else
                                <td style="color: red">{{ $bahan->total_stok_bahan }} (Hampir Habis)</td>
                            @endif
                            <td>{{ $bahan->created_at }}</td>
                            <td>{{ $bahan->last_updated }}</td>
                            <td class="text-center">
                                <a href="/bahanBaku/edit/{{ $bahan->namaBahan }}" class="btn btn-warning me-2">Edit</a>
                                <a href="/produksiBahanBaku/detail/{{ $bahan->namaBahan }}" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection