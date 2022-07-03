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
        <div class="row mt-3">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Data Rekapitulasi <?= $this_periode ?>
                    </div>
                    <div class="card-body"><canvas id="myPieChart" width="100%" height="75"></canvas></div>
                    {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-1">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Detail
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><h5 class="text-lg-start" style="color: #007bff;"><strong>Debit</strong></h5></th>
                                    <th><h5 class="text-lg-start " style="color: #dc3545; "><strong>Kredit</strong></h5></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h6 class="text-sm-start">Rp. <?= number_format($debit_this_mounth[0],2,',','.') ?></h6></td>
                                    <td><h6 class="text-sm-start">Rp. <?= number_format($kredit_this_mounth[0],2,',','.') ?></h6></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Top 5 Produk Paling Laku <?= $this_periode ?>
                    </div>
                    <div class="card-body">
                        <canvas id="myBarChart" height="125"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="/ownerRekapitulasi" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var debit = @json($debit_this_mounth)/1;
        var kredit = @json($kredit_this_mounth)/1;
        var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Debit", "Kredit"],
            datasets: [{
            data: [debit, kredit],
            backgroundColor: ['#007bff', '#dc3545'],
            }],
        },
        });

        var ctx = document.getElementById("myBarChart");
        var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($top_five_produk),
            datasets: [{
            label: "Keuntungan",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: @json($top_five_harga),
            }],
        },
        options: {
            scales: {
            xAxes: [{
                weight:2,
                time: {
                unit: 'date'
                },
                gridLines: {
                display: false
                },
                ticks: {
                maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                min: 0,
                maxTicksLimit: 5
                },
                gridLines: {
                color: "rgba(0, 0, 0, .125)",
                }
            }],
            },
            legend: {
            display: false
            }
        }
        });
    </script>
@endsection