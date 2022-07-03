
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarKedai', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="layoutSidenav_content">
    <style>
        .header, strong {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <main >
        <?php $i = 0; ?>
        <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($i > 0 ): ?>
                <?php break; ?>
            <?php else: ?>
                <div class="header text-center">
                    <h2 class="pt-3 px-4"><strong>Data Stok Coffee</strong></h2>
                    <h3 class="px-4" style="color: brown;"><strong>~<?php echo e($p->namaProduk); ?></strong></h3>
                    <?php $i++; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($p->kategori); ?></td>
                                <?php if($p->total_stok >= 150): ?>
                                    <td style="color: green"><?php echo e($p->total_stok); ?></td>
                                <?php else: ?>
                                    <td style="color: red"><?php echo e($p->total_stok); ?></td>
                                <?php endif; ?>

                                <?php if($p->kategori=='Biji Kopi'): ?>
                                    <?php $__currentLoopData = $last_price_biji; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td>Rp. <?php echo e(number_format($lp,2,',','.')); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <?php $__currentLoopData = $last_price_bubuk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td>Rp. <?php echo e(number_format($lp,2,',','.')); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                        <a href="/kedaiStockKopi" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/kedai/KedaiStockKopiDetail.blade.php ENDPATH**/ ?>