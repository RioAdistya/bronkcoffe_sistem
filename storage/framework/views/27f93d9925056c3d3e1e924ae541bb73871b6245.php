
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarProduksi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="layoutSidenav_content">
    <style>
        strong, thead{
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <main>
    <div class="container-fluid px-4">
        <div class="card mt-3">
            <?php $__currentLoopData = $bahan_baku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bahan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card-header text-start">
                <i class="bi bi-table"></i> <strong>Riwayat Pengguanaan <?php echo e($bahan->namaBahan); ?></strong> 
            </div>
            <?php break; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Kuantitas</th>
                            <th>Harga Satuan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bahan_baku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bahan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($bahan->updated_at); ?></td>
                            <td><?php echo e($bahan->namaBahan); ?></td>
                            <?php if($bahan->kuantitas > 0): ?>
                                <td style="color: green"><?php echo e($bahan->kuantitas); ?></td>
                            <?php elseif($bahan->kuantitas < 0): ?>
                                <td style="color: red"><?php echo e($bahan->kuantitas); ?></td>
                            <?php else: ?>
                                <td style="color: black"><?php echo e($bahan->kuantitas); ?></td>
                            <?php endif; ?>
                            <td>Rp. <?php echo e(number_format($bahan->hargaSatuan,2,',','.')); ?></td>
                            <td style="width: 300px;"><?php echo e($bahan->keterangan); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>       
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-3">
            <a href="/produksiBahanBaku" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/produksi/produksiBahanBakuDetail.blade.php ENDPATH**/ ?>