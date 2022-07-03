
  
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
            <?php $__currentLoopData = $owner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="container-fluid px-4">
                <div class="btn-edit">
                    <a type="button" href="/ownerMitra/edit/<?php echo e($o->id); ?>" class="edit-icon" role="button" aria-pressed="true">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </div>
                <div class="modal-body my-2" style="text-align: center">
                    <h1 class="h2">
                        <i class="fa fa-user-circle mb-2" aria-hidden="true" style="font-size: 150px;"></i>
                    </h1>
                    <h2><strong><?php echo e($o->namaMitra); ?></strong></h2>
                    <div style="color: rgb(148, 148, 148)">
                        
                        <h5><?php echo e($o->noTelepon); ?></h5>
                    </div>
                </div>
                <div class="address py-3 px-3 mb-5" style="background-color: rgb(231, 240, 245); border-radius:10px;">
                    <h4><strong>Alamat</strong></h4>
                    <h6 style="color: rgb(148, 148, 148)"><?php echo e($o->alamat); ?></h6>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/ownerMitra.blade.php ENDPATH**/ ?>