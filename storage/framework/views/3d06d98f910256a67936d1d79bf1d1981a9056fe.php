
  
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
            <div class="container-fluid px-4">
                <div class="modal-body my-2" style="text-align: center">
                    <h1 class="h2">
                        <i class="fa fa-user-circle mb-2" aria-hidden="true" style="font-size: 150px;"></i>
                    </h1>
                    <h2><strong><?php echo e($karyawan->namaKaryawan); ?></strong></h2>
                    <div style="color: rgb(148, 148, 148)">
                        <h5>
                            <strong>Karyawan Produksi - </strong> 
                            <?php if($karyawan->status->status == 'Aktif'): ?>
                                <strong class="status text-success"><?php echo e($karyawan->status->status); ?></strong>
                            <?php else: ?>
                                <strong class="status text-danger"><?php echo e($karyawan->status->status); ?></strong>
                            <?php endif; ?>
                        </h5>
                        <h5><?php echo e($karyawan->noTelepon); ?></h5>
                    </div>
                </div>
                <div class="address py-3 px-3 mb-2" style="background-color: rgb(231, 240, 245); border-radius:10px;">
                    <h4><strong>Tanggal Mulai Kerja</strong></h4>
                    <strong><h6><?php echo e($karyawan->created_at); ?></h6></strong>
                </div>
                <div class="address py-3 px-3 mb-3" style="background-color: rgb(231, 240, 245); border-radius:10px;">
                    <h4><strong>Alamat</strong></h4>
                    <h6><?php echo e($karyawan->alamat); ?></h6>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="/karyawanProduksi" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> kembali</a>
                </div>
            </div>
        </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/owner/produksiDetail.blade.php ENDPATH**/ ?>