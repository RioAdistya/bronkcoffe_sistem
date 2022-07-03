@extends('layouts.app')
@section('content')
@include('partials.navbar')
@include('partials.sidebarOwner')
    <div id="layoutSidenav_content">
        <style>
            main {
                font-family: 'Poppins', sans-serif;
            }
        </style>
        <main>
            <div class="container-fluid px-4">
                <div class="modal-body my-2" style="text-align: center">
                    <h1 class="h2">
                        <i class="fa fa-user-circle mb-2" aria-hidden="true" style="font-size: 150px;"></i>
                    </h1>
                    <h2><strong>{{ $karyawan->namaKaryawan}}</strong></h2>
                    <div style="color: rgb(148, 148, 148)">
                        <h5>
                            <strong>Karyawan Kedai - </strong> 
                            @if($karyawan->status->status == 'Aktif')
                                <strong class="status text-success">{{ $karyawan->status->status}}</strong>
                            @else
                                <strong class="status text-danger">{{ $karyawan->status->status}}</strong>
                            @endif
                        </h5>
                        <h5>{{ $karyawan->noTelepon }}</h5>
                    </div>
                </div>
                <div class="address py-3 px-3 mb-2" style="background-color: rgb(231, 240, 245); border-radius:10px;">
                    <h4><strong>Tanggal Mulai Kerja</strong></h4>
                    <strong><h6>{{ $karyawan->created_at }}</h6></strong>
                </div>
                <div class="address py-3 px-3 mb-3" style="background-color: rgb(231, 240, 245); border-radius:10px;">
                    <h4><strong>Alamat</strong></h4>
                    <h6>{{ $karyawan->alamat }}</h6>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="/karyawanKedai" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </main>
@endsection