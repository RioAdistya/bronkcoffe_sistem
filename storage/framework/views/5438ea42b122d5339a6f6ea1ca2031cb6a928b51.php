
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarKedai', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="layoutSidenav_content">
    <style>
        strong, ::placeholder {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <main>
        <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="container-fluid px-4 py-4">
            <div class="header">
                <h4><strong>Edit Data Penjualan</strong></h4>
            </div>
            <hr>
            <div class="form-edit">
                <form method="get" action="/penjualan/update/<?php echo e($p->idPenjualan); ?>">
                    

                    <input id="idPenjualan" type="number" hidden value="<?php echo e($p->idPenjualan); ?>">
                    
                    <div class="row mb-3">
                        <label for="namaProduk" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Nama Produk</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="text" id="namaProduk" readonly="readonly" class="form-control" name="namaProduk" placeholder="Nama Produk" autocomplete="off" required oninvalid="this.setCustomValidity('Nama tidak boleh Kosong')" oninput="this.setCustomValidity('')" value="<?php echo e($p->namaProduk); ?>"/>
                            <?php if($errors->has('namaProduk')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('namaProduk')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <label for="kategori" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Kategori</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="text" id="kategori" readonly="readonly" class="form-control" name="kategori" placeholder="Kategori " autocomplete="off" required oninvalid="this.setCustomValidity('Kategori tidak boleh Kosong')" oninput="this.setCustomValidity('')" value="<?php echo e($p->kategori); ?>"/>
                                <?php if($errors->has('kategori')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('kategori')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <label for="kuantitas" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Kuantitas (gr)</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="5" max="100000" name="kuantitas" id="kuantitas" placeholder="Stok Kopi" autocomplete="off" required oninvalid="this.setCustomValidity('Stok harus angka')" oninput="this.setCustomValidity('')" value="<?php echo e($p->kuantitas); ?>"/>
                            <?php if($errors->has('kuantitas')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('kuantitas')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <label for="harga" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Harga 100gr (Rp)</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="0" readonly="readonly" name="harga" id="harga" placeholder="Harga Per 100 Gram" autocomplete="off" required oninvalid="this.setCustomValidity('Inputan Min 1000')" oninput="this.setCustomValidity('')" value="<?php echo e($p->hargaPer100Gram); ?>"/>
                            <?php if($errors->has('harga')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('harga')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <label for="hargaTotal" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Harga Total (Rp)</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" readonly="readonly" min="0" name="hargaTotal" id="hargaTotal" placeholder="Harga Per 100 Gram" autocomplete="off" required oninvalid="this.setCustomValidity('Inputan Min 1000')" oninput="this.setCustomValidity('')" value="<?php echo e($p->hargaPer100Gram*$p->kuantitas /100); ?>"/>
                            <?php if($errors->has('hargaTotal')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('hargaTotal')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="row mb-3 justify-content-end mx-3 my-4">
                        <div class="col-sm-8 col-md-9 col-xl-10" style="text-align:end;">
                            
                            <button class="btn btn-success mx-3">Simpan</button>
                            <a type="button" class="btn btn-secondary border" href="/kedaiPenjualan/Keseluruhan">
                                Batal
                            </a>
                        </div>
                    </div>

                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </main>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script 
    src="https://code.jquery.com/jquery-3.6.0.slim.js"  integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
    crossorigin="anonymous">
</script>
<script>
    var hargaSatuan = document.getElementById('harga').value;
    var kuantitas = document.getElementById('kuantitas').value;
    var idPenjualan = document.getElementById('idPenjualan').value;

    document.getElementById("kuantitas").addEventListener("input", function(){
        document.getElementById("hargaTotal").value = this.value*hargaSatuan/100;
    });

</script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/kedai/kedaiPenjualanEdit.blade.php ENDPATH**/ ?>