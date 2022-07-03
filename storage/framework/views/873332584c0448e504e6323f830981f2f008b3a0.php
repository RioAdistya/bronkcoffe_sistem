
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
                <form method="post" action="/produkProduksi/store">
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

                    
                    <div class="row mb-3">
                        <label for="phone" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Jumlah Stok</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" name="stok" id="stok" placeholder="Stok Kopi" autocomplete="off" required oninvalid="this.setCustomValidity('Stok harus angka')" oninput="this.setCustomValidity('')"/>
                            <?php if($errors->has('stok')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('stok')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <label for="kategori" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Kategori</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <select name="kategori" class="form-control" placeholder="Kategori Kopi">
                                <option value="Biji Kopi">Biji Kopi</option>
                                <option value="Kopi Bubuk">Kopi Bubuk</option>
                            </select>
                                <?php if($errors->has('kategori')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('kategori')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-end mx-3 my-4">
                        <div class="col-sm-8 col-md-9 col-xl-10" style="text-align:end;">
                            <input type="submit" class="btn btn-success mx-3" value="Tambah">
                            <a type="button" class="btn btn-secondary border" href="/produkProduksi">
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/produksi/produkProduksiTambah.blade.php ENDPATH**/ ?>