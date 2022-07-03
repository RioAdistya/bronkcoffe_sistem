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
                <i class="bi bi-table"></i> <strong>Data Rekapitulasi Keuangan</strong> 
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Periode</th>
                            <th>Total Debit</th>
                            <th>Total Kredit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                         @foreach($periode as $kredit)
                         <tr>
                             <td>{{ $loop->iteration }}</td>
                             <td>{{ $kredit }}</td>
                             @while ($i < count($all_debit))
                                 <td style="color: green">Rp. {{ number_format($all_debit[$i],2,',','.') }}</td>
                                 @break
                             @endwhile
                             @while ($i < count($all_kredit))
                                 <td style="color: red">Rp. {{ number_format($all_kredit[$i],2,',','.') }}</td>
                                 @break
                             @endwhile
                             {{-- <td style="color: red">Rp. {{ number_format($kredit->total_kredit,2,',','.') }}</td> --}}
                             <td class="text-center">
                                 <a href="/ownerRekapitulasiDetail/{{ $kredit }}" class="btn btn-success">Detail</a>
                             </td>
                         </tr>
                         @php
                             $i += 1;
                         @endphp
                         @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection