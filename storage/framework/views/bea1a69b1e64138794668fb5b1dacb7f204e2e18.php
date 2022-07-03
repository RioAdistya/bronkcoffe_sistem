
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarOwner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                        <option selected hidden><?php echo e($produkURL); ?></option>
                                        <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($p->namaProduk); ?>"><?php echo e($p->namaProduk); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group mb-2 ms-2">
                                    <label for="kategori">Pilih Kategori : </label>
                                    <select id="kategori" class="form-select" style="width: 150px">
                                        <option selected hidden><?php echo e($kategoriURL); ?></option>
                                        <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($k->kategori); ?>"><?php echo e($k->kategori); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group mb-2 ms-2">
                                    <label for="year">Pilih Tahun : </label>
                                    <select id="year" class="form-select" style="width: 150px">
                                        <option selected hidden><?php echo e($yearURL); ?></option>
                                        <option value="Keseluruhan">Keseluruhan</option>
                                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        var akurasi = 100-<?php echo json_encode($mape, 15, 512) ?>;
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
                categories: <?php echo json_encode($month, 15, 512) ?>,
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
                data: <?php echo json_encode($dataset, 15, 512) ?>
            }, {
                name: 'Peramalan',
                data: <?php echo json_encode($forecast, 15, 512) ?>
            }]
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/owner/ownerPrediksiPasar.blade.php ENDPATH**/ ?>