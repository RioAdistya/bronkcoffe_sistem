
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
                <h4><strong>Tambah Data Bahan Baku</strong></h4>
            </div>
            <hr>
            <div class="form-edit">
                <form method="post" action="/bahanBaku/store">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(method_field('PATCH')); ?>

                    
                    <div class="row mb-3">
                        <label for="namaBahan" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Nama Produk</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="text" id="namaBahan" list="listNama" class="form-control" name="namaBahan" placeholder="Nama Bahan Baku" autocomplete="off" required oninvalid="this.setCustomValidity('Nama tidak boleh Kosong')" oninput="this.setCustomValidity('')"/>
                            <datalist id="listNama" >
                                <?php $__currentLoopData = $bahan_baku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option><?php echo e($p->namaBahan); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </datalist>
                            <?php if($errors->has('namaBahan')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('namaBahan')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                    
                    
                    <div class="row mb-3">
                        <label for="kuantitas" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Kuantitas</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="0" max="99999" name="kuantitas" id="kuantitas" placeholder="Kuantitas Bahan Baku" autocomplete="off" required oninvalid="this.setCustomValidity('Cek kembali jumlah stok')" oninput="this.setCustomValidity('')"/>
                            <?php if($errors->has('kuantitas')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('kuantitas')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <label for="hargaSatuan" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Harga Satuan</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="500" max="100000000" step="500" name="hargaSatuan" id="hargaSatuan" placeholder="Harga Satuan" autocomplete="off" required oninvalid="this.setCustomValidity('Cek kembali harga')" oninput="this.setCustomValidity('')"/>
                            <?php if($errors->has('hargaSatuan')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('hargaSatuan')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <label for="keterangan" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Keterangan</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="4" placeholder="Keterangan" autocomplete="off"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-end mx-3 my-4">
                        <div class="col-sm-8 col-md-9 col-xl-10" style="text-align:end;">
                            <input type="submit" class="btn btn-success mx-3" value="Tambah">
                            <a type="button" class="btn btn-secondary border" href="/produksiBahanBaku">
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/produksi/bahanBakuTambah.blade.php ENDPATH**/ ?>