
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
            <div class="card-header text-start">
                <i class="bi bi-table"></i> <strong>Data Bahan Baku</strong> 
            </div>
            <div class="card-body">
                <a href="/bahanBaku/tambah" class="btn btn-success mb-3"><i class="bi bi-plus-circle"></i> Tambah Bahan Baru</a>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Sisa</th>
                            <th>Tanggal Input</th>
                            <th>Terakhir Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bahan_baku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bahan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($bahan->namaBahan); ?></td>
                            <?php if($bahan->total_stok_bahan >= 5): ?>
                                <td style="color: green"><?php echo e($bahan->total_stok_bahan); ?></td>
                            <?php elseif($bahan->total_stok_bahan == 0): ?>
                                <td style="color: red"><?php echo e($bahan->total_stok_bahan); ?> (Habis)</td>
                            <?php else: ?>
                                <td style="color: red"><?php echo e($bahan->total_stok_bahan); ?> (Hampir Habis)</td>
                            <?php endif; ?>
                            <td><?php echo e($bahan->created_at); ?></td>
                            <td><?php echo e($bahan->last_updated); ?></td>
                            <td class="text-center">
                                <a href="/bahanBaku/edit/<?php echo e($bahan->namaBahan); ?>" class="btn btn-warning me-2">Edit</a>
                                <a href="/produksiBahanBaku/detail/<?php echo e($bahan->namaBahan); ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/produksi/produksiBahanBaku.blade.php ENDPATH**/ ?>