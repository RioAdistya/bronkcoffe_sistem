
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarOwner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="layoutSidenav_content">
        <style>
            main {
                font-family: 'Poppins', sans-serif;
            }
            .btn-edit{
                text-align:end;
                margin-top:30px;
                margin-right: 50px; 
                border: none;
                font-size: 30px;
            }
            .btn-edit a {
                color: black;
                transition: transform .2s;
            }
            /* .btn-edit:hover{
                transform: scale(1.1) 
            }    */
        </style>
        <main>
            <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="container-fluid px-4">
                <div class="modal-body my-2" style="text-align: center">
                    <h1 class="h2">
                        <i class="fa fa-user-circle mb-2" aria-hidden="true" style="font-size: 150px;"></i>
                    </h1>
                    <h2><strong><?php echo e($k->namaKaryawan); ?></strong></h2>
                    <div style="color: rgb(148, 148, 148)">
                        <h5>
                            <strong>Karyawan Kedai - </strong> 
                            <?php if($k->status == 'Aktif'): ?>
                                <strong class="status text-success"><?php echo e($k->status); ?></strong>
                            <?php else: ?>
                                <strong class="status text-danger"><?php echo e($k->status); ?></strong>
                            <?php endif; ?>
                        </h5>
                        <h5><?php echo e($k->noTelepon); ?></h5>
                    </div>
                </div>
                <div class="address py-3 px-3 mb-2" style="background-color: rgb(231, 240, 245); border-radius:10px;">
                    <h4><strong>Tanggal Mulai Kerja</strong></h4>
                    <strong><h6><?php echo e($k->created_at); ?></h6></strong>
                </div>
                <div class="address py-3 px-3 mb-5" style="background-color: rgb(231, 240, 245); border-radius:10px;">
                    <h4><strong>Alamat</strong></h4>
                    <h6><?php echo e($k->alamat); ?></h6>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/kedaiDetail.blade.php ENDPATH**/ ?>