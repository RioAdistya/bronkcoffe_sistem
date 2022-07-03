
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarOwner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <strong>TAMBAH DATA KARYAWAN</strong>
                </div>
                <div class="card-body">
                    <a href="/karyawanKedai" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>
                    
                    <form method="post" action="/karyawanKedai/store">
 
                        <?php echo e(csrf_field()); ?>

 
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="namaKaryawan" class="form-control" placeholder="Nama Karyawan">
                            <?php if($errors->has('namaKaryawan')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('namaKaryawan')); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="tel" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" name="noTelepon" class="form-control" placeholder="No Telepon">
                            <?php if($errors->has('noTelepon')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('noTelepon')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
 
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Alamat Karyawan"></textarea>
                             <?php if($errors->has('alamat')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('alamat')); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" placeholder="Status Karyawan">
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>
                             <?php if($errors->has('status')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('status')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
 
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>
 
                    </form>
 
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views//crud/karyawanKedaiTambah.blade.php ENDPATH**/ ?>