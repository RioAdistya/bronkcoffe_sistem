
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarProduksi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="layoutSidenav_content">
    <style>
        strong, ::placeholder {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <main>
        <div class="container-fluid px-4 py-4">
            <div class="header">
                <h4><strong>Tambah Data Produk</strong></h4>
            </div>
            <hr>
            <div class="form-edit">
                <form method="post" action="/stockKopi/store">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(method_field('PATCH')); ?>

                    
                    <div class="row mb-3">
                        <label for="nama" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Nama Produk</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="text" id="namaProduk" list="listNama" class="form-control" name="namaProduk" placeholder="Nama Produk" autocomplete="off" required oninvalid="this.setCustomValidity('Nama tidak boleh Kosong')" oninput="this.setCustomValidity('')"/>
                            <datalist id="listNama" >
                                <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option><?php echo e($p->namaProduk); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </datalist>
                            <?php if($errors->has('namaProduk')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('namaProduk')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                    <hr style="width:100%">
                    
                    <div class="row mb-3">
                        <label for="kategori" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Kategori</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <select name="kategori" class="form-select" >
                                <option value="1">Biji Kopi</option>
                                <option value="2">Kopi Bubuk</option>
                            </select>
                                <?php if($errors->has('idKategori')): ?>
                                    <div class="text-danger">
                                        <?php echo e($errors->first('kategori')); ?>

                                    </div>
                                <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <label for="stok" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Stok (gr)</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="0" max="99999"  name="jumlahStok" id="jumlahStok" placeholder="Stok Kopi" autocomplete="off" required oninvalid="this.setCustomValidity('Cek kembali jumlah stok')" oninput="this.setCustomValidity('')"/>
                            <?php if($errors->has('jumlahStok')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('jumlahStok')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <label for="hargaPer100Gram" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Harga 100gr (Rp)</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="0" max="9999999999" step="500" name="hargaPer100Gram" id="hargaPer100Gram" placeholder="Harga Per 100 Gram" autocomplete="off" required oninvalid="this.setCustomValidity('Cek kembali harga')" oninput="this.setCustomValidity('')"/>
                            <?php if($errors->has('hargaPer100Gram')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('hargaPer100Gram')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-end mx-3 my-4">
                        <div class="col-sm-8 col-md-9 col-xl-10" style="text-align:end;">
                            <input type="submit" class="btn btn-success mx-3" value="Tambah">
                            <a type="button" class="btn btn-secondary border" href="/produksiStockKopi">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/produksi/stockKopiTambah.blade.php ENDPATH**/ ?>