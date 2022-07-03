
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
        <div class="card mt-5">
            <div class="card-header text-start">
                <strong>Data Karyawan Kedai Kopi</strong> 
            </div>
            <div class="card-body">
                <a href="/karyawanKedai/tambah" class="btn btn-success">Input Karyawan Baru</a>
                <br/>
                <br/>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($k->namaKaryawan); ?></td>
                            <td><?php echo e($k->noTelepon); ?></td>
                            <td><?php echo e($k->alamat); ?></td>
                            <?php if($k->idStatus == 1): ?>
                                <td style="color: green">Aktif</td>
                            <?php else: ?>
                                <td style="color: red">Tidak Aktif</td>
                            <?php endif; ?>
                            <td class="text-center">
                                <a href="/karyawanKedai/edit/<?php echo e($k->id); ?>" class="btn btn-warning my-2 mx-1">Edit</a>
                                <a href="/karyawanKedai/detail/<?php echo e($k->id); ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/owner/karyawanKedai.blade.php ENDPATH**/ ?>