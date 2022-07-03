@extends('layouts.app')
@section('content')
@include('partials.navbar')
@include('partials.sidebarKedai')
<div id="layoutSidenav_content">
    <style>
        .header, strong {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <main >
        @php $i = 0; @endphp
        @foreach($produk as $p)
            @if ($i > 0 )
                @php break; @endphp
            @else
                <div class="header text-center">
                    <h2 class="pt-3 px-4"><strong>Data Stok Coffee</strong></h2>
                    <h3 class="px-4" style="color: brown;"><strong>~{{ $p->namaProduk }}</strong></h3>
                    @php $i++; @endphp
                </div>
            @endif
        @endforeach
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card-body">
                    <table class="table table-light table-striped text-center" style="font-size: 20px">
                        <thead>
                            <tr>
                                <th><strong>Kategori</strong></th>
                                <th><strong>Stok (gr)</strong></th>
                                <th><strong>Harga 100gr (Rp)</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produk as $p)
                            <tr>
                                <td>{{ $p->kategori }}</td>
                                @if($p->total_stok >= 150)
                                    <td style="color: green">{{ $p->total_stok }}</td>
                                @else
                                    <td style="color: red">{{ $p->total_stok }}</td>
                                @endif

                                @if($p->kategori=='Biji Kopi')
                                    @foreach ($last_price_biji as $lp)
                                        <td>Rp. {{ number_format($lp,2,',','.') }}</td>
                                    @endforeach
                                @else
                                    @foreach ($last_price_bubuk as $lp)
                                        <td>Rp. {{ number_format($lp,2,',','.') }}</td>
                                    @endforeach
                                @endif

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                        <a href="/kedaiStockKopi" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
