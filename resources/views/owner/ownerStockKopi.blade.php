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
                <i class="bi bi-table"></i> <strong>Data Stok Kopi Pasca Produksi</strong> 
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Total Stok (gr)</th>
                            <th>Tanggal Input</th>
                            <th>Terakhir Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produk as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->namaProduk }}</td>
                            @if($p->total_stok >= 300)
                                <td style="color: green">{{ $p->total_stok }}</td>
                            @else
                                <td style="color: red">{{ $p->total_stok }} (Hampir Habis)</td>
                            @endif
                            <td>{{ $p->created_at }}</td>
                            <td>{{ $p->last_updated }}</td>
                            <td class="text-center">
                                
                                <a href="/ownerStockKopi/detail/{{ $p->namaProduk }}" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection