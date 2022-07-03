
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarProduksi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                    <table id="datatablesSimple" style="font-size: 20px">
                        <thead>
                            <tr>
                                <th><strong>Kategori</strong></th>
                                <th><strong>Stok (Kg)</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($p->kategori); ?></td>
                                <?php if($p->stok >= 15): ?>
                                    <td style="color: green"><?php echo e($p->total_stok); ?></td>
                                <?php else: ?>
                                    <td style="color: red"><?php echo e($p->total_stok); ?></td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div style="text-align:end;">
                        <a type="button" class="btn btn-dark border" href="/produkProduksi">
                            Kembali
                        </a>
                        <a href="/produkProduksi/edit/<?php echo e($p->namaProduk); ?>" class="btn btn-warning my-2 mx-1">Edit</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/produksi/produkDetail.blade.php ENDPATH**/ ?>