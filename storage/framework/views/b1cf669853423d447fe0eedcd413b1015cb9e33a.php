
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarOwner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                <i class="bi bi-table"></i> <strong>Data Stok Kopi Pasca Produksi</strong> 
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Total Stok (gr)</th>
                            <th>Tanggal Input</th>
                            <th>Terakhir Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($p->namaProduk); ?></td>
                            <?php if($p->total_stok >= 300): ?>
                                <td style="color: green"><?php echo e($p->total_stok); ?></td>
                            <?php else: ?>
                                <td style="color: red"><?php echo e($p->total_stok); ?> (Hampir Habis)</td>
                            <?php endif; ?>
                            <td><?php echo e($p->created_at); ?></td>
                            <td><?php echo e($p->last_updated); ?></td>
                            <td class="text-center">
                                
                                <a href="/ownerStockKopi/detail/<?php echo e($p->namaProduk); ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/owner/ownerStockKopi.blade.php ENDPATH**/ ?>