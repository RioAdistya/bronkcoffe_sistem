@extends('layouts.app')
@section('content')
@include('partials.navbar')
@include('partials.sidebarProduksi')
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
                            Prediksi Stok Biji Kopi
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="year">Pilih Tahun : </label>
                                <select id="year" class="form-select" style="width: 150px">
                                    <option selected hidden>{{ $yearURL }}</option>
                                    <option value="Keseluruhan">Keseluruhan</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-header">
                                <div id="chartContainer">
                                    <div id="chartBijiKopi" class="d-flex justify-content-center" style="width: 100%;"></div>
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

        var sortYear = document.getElementById('year');
        var akurasi = 100-@json($mape);
        sortYear.addEventListener("input", function(){
            var strUser = this.value;
            var nextURL = 'http://127.0.0.1:8000/produksiPrediksiStok/'+ strUser;
            window.location.replace(nextURL);
        });

        Highcharts.chart('chartBijiKopi', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Prediksi Stok Biji Kopi ' + sortYear.value
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
                borderWidth: 1,
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
            },
            xAxis: {
                categories: @json($month),
            },
            yAxis: {
                title: {
                    text: 'Total Stok Kopi'
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
                name: 'Stok Kopi',
                data: @json($dataset)
            }, {
                name: 'Peramalan',
                data: @json($forecast)
            }]
        });

    </script>
@endsection