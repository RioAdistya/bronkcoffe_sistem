@extends('layouts.app')
@section('content')
@include('partials.navbar')
@include('partials.sidebarOwner')
<div id="layoutSidenav_content">
    <style>
        #scrollContainer{
            height: 300px;
            overflow-y: auto;
        }
        #chartContainer{
            height: 400px;
            width: 100%;
            position: relative;
        }
    </style>
    <main>
        <div class="container-fluid px-4 mt-3">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Prediksi Pasar 
                        </div>
                        <div class="card-body">
                            <div class="select" style="display: flex">
                                <div class="form-group mb-2">
                                    <label for="produk">Pilih Produk : </label>
                                    <select id="produk" class="form-select" style="width: 150px">
                                        <option selected hidden>{{ $produkURL }}</option>
                                        @foreach ($produk as $p)
                                        <option value="{{ $p->namaProduk }}">{{ $p->namaProduk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-2 ms-2">
                                    <label for="kategori">Pilih Kategori : </label>
                                    <select id="kategori" class="form-select" style="width: 150px">
                                        <option selected hidden>{{ $kategoriURL }}</option>
                                        @foreach ($kategori as $k)
                                        <option value="{{ $k->kategori }}">{{ $k->kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-2 ms-2">
                                    <label for="year">Pilih Tahun : </label>
                                    <select id="year" class="form-select" style="width: 150px">
                                        <option selected hidden>{{ $yearURL }}</option>
                                        <option value="Keseluruhan">Keseluruhan</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-header">
                                <div id="chartContainer">
                                    <div id="chartPasar" class="d-flex justify-content-center" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>

        var produk = document.getElementById('produk');
        var kategori = document.getElementById('kategori');
        var sortYear = document.getElementById('year');
        var akurasi = 100-@json($mape);
        sortYear.addEventListener("input", function(){
            var strUser = this.value;
            var nextURL = 'http://127.0.0.1:8000/ownerPrediksiPasar/'+ produk.value + '/' + kategori.value + '/' + strUser;
            window.location.replace(nextURL);
        });

        Highcharts.chart('chartPasar', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Prediksi Permintaan Pasar ' + produk.value  + ' ' + kategori.value
            },
            subtitle: {
                text: '(Akurasi = ' + akurasi + '%)'
            },
            legend: {
                layout: 'horizontal',
                align: 'left',
                verticalAlign: 'top',
                x: 20,
                floating: true,
                borderWidth: 0.5,
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
            },
            xAxis: {
                categories: @json($month),
            },
            yAxis: {
                title: {
                    text: 'Total Produk Terjual (gram)'
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ' gram'
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
                name: 'Terjual ',
                data: @json($dataset)
            }, {
                name: 'Peramalan',
                data: @json($forecast)
            }]
        });

    </script>
@endsection