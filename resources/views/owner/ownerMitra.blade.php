@extends('layouts.app')
  
@section('content')
@include('partials.navbar')
@include('partials.sidebarOwner')
    <div id="layoutSidenav_content">
        <style>
            main {
                font-family: 'Poppins', sans-serif;
            }
            .btn-edit{
                text-align:end;
                margin-top:30px;
                margin-right: 50px; 
                border: none;
                font-size: 30px;
            }
            .btn-edit a {
                color: black;
                transition: transform .2s;
            }
            /* .btn-edit:hover{
                transform: scale(1.1) 
            }    */
        </style>
        <main>
            @foreach($owner as $o)
            <div class="container-fluid px-4">
                <div class="btn-edit">
                    <a type="button" href="/ownerMitra/edit/{{ $o->id }}" class="edit-icon" role="button" aria-pressed="true">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </div>
                <div class="modal-body my-2" style="text-align: center">
                    <h1 class="h2">
                        <i class="fa fa-user-circle mb-2" aria-hidden="true" style="font-size: 150px;"></i>
                    </h1>
                    <h2><strong>{{ $o->namaMitra}}</strong></h2>
                    <div style="color: rgb(148, 148, 148)">
                        {{-- <h5>{{ $o->email}}</h5> --}}
                        <h5>{{ $o->noTelepon }}</h5>
                    </div>
                </div>
                <div class="address py-3 px-3 mb-5" style="background-color: rgb(231, 240, 245); border-radius:10px;">
                    <h4><strong>Alamat</strong></h4>
                    <h6 style="color: rgb(148, 148, 148)">{{ $o->alamat }}</h6>
                </div>
                @endforeach
            </div>
        </main>
@endsection