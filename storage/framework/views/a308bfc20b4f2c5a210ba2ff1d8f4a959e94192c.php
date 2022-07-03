
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarKedai', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="layoutSidenav_content">

    <style>
        strong, thead{
            font-family: 'Poppins', sans-serif;
        }
        </style>
    <main>
        <div class="container-fluid px-4">
        <a href="#" onclick="showStuff('tambah', this); return false;" id="btn1" class="btn btn-secondary w-100 mt-3"><i class="bi bi-arrow-bar-down"></i> Tambah</a>
            <span id="tambah" style="display: none;">
            <?php echo $__env->make('kedai.kedaiPenjualanTambah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </span>
            <div class="card mt-3">
                <div class="card-header text-start">
                    <i class="bi bi-table"></i> <strong>Data Penjualan Kopi</strong> 
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="month">Pilih Bulan : </label>
                        <select id="month" class="form-select" style="width: 150px">
                            <option selected hidden><?php echo e($periodeURL); ?></option>
                            <?php $__currentLoopData = $periodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $periode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($periode); ?>"><?php echo e($periode); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Kuantitas (gr)</th>
                                <th>Harga 100gr (Rp)</th>
                                <th>Harga Total (Rp)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data_penjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($data->tanggal); ?></td>
                                <td><?php echo e($data->namaProduk); ?></td>
                                <td><?php echo e($data->kategori); ?></td>
                                <td><?php echo e($data->kuantitas); ?></td>
                                <td>Rp. <?php echo e(number_format($data->hargaPer100Gram,2,',','.')); ?></td>
                                <?php 
                                if ($data->kategori=='Biji Kopi') {
                                    $harga_total = $data->kuantitas * $data->hargaPer100Gram/100;
                                } else{
                                    $harga_total = $data->kuantitas * $data->hargaPer100Gram/100;
                                }
                                ?>
                                <td>Rp. <?php echo e(number_format($harga_total,2,',','.')); ?></td>
                                <td class="text-center">
                                    <a href="/penjualan/edit/<?php echo e($data->idPenjualan); ?>" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>

        var sortMonth = document.getElementById('month');
        sortMonth.addEventListener("input", function(){
            var strUser = this.value;
            var nextURL = 'http://127.0.0.1:8000/kedaiPenjualan/'+ strUser;
            window.location.replace(nextURL);
        });

        function showStuff(tambah, btn1) {
            document.getElementById(tambah).style.display = 'block';
            btn1.style.display = 'none';
        }

        var nama = document.getElementById('namaProduk');
        var kategory = document.getElementById('kategori');
        document.getElementById("kategori").disabled = true;
        document.getElementById("kuantitas").disabled = true;

        nama.addEventListener("input", function(){
            document.getElementById("kategori").disabled = false;
        });

        kategory.addEventListener("input", function(){
            document.getElementById("kuantitas").disabled = false;
        });

        function useValue() {
            var list_price = new Array;
            var nama2 = nama.value;
            var kategory2 = kategory.value;
            const data = <?php echo json_encode($data_produk, 15, 512) ?>;
            const myObj = JSON.parse(JSON.stringify(data));
            for(var i in myObj) {
                if(nama2 == myObj[i]['namaProduk'] && kategory2 == myObj[i]['kategori']){
                    list_price.push(myObj[i]["harga"]);
                }
            }
            var price = list_price.slice(-1)[0];
            return price;
        }
        nama.onchange = useValue;  
        nama.onblur = useValue;
        kategory.onchange = useValue;  
        kategory.onblur = useValue;
    
        document.getElementById("kuantitas").addEventListener("input", function(){
            document.getElementById("harga").value = this.value*useValue()/100;
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/kedai/kedaiPenjualan.blade.php ENDPATH**/ ?>