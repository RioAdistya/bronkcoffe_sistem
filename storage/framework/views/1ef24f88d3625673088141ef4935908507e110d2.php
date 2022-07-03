
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarOwner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <strong>EDIT DATA</strong>
                </div>
                <div class="card-body">
                    <form method="post" action="/karyawanKedai/update/<?php echo e($karyawan->id); ?>">

                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('PUT')); ?>


                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="namaKaryawan" class="form-control" placeholder="Nama Karyawan" value="<?php echo e($karyawan->namaKaryawan); ?>">
                            <?php if($errors->has('nama')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('nama')); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="tel" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" name="noTelepon" class="form-control" placeholder="No Telepon" value="<?php echo e($karyawan->noTelepon); ?>">
                            <?php if($errors->has('noTelepon')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('noTelepon')); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Alamat Karyawan"><?php echo e($karyawan->alamat); ?></textarea>
                            <?php if($errors->has('alamat')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('alamat')); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" placeholder="Status Karyawan" value="<?php echo e($karyawan->status); ?>">
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>
                             <?php if($errors->has('status')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('status')); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group my-2 text-align-end">
                            <a href="/karyawanKedai" class="btn btn-danger">Kembali</a>
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>

                    </form>

                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views//crud/karyawanKedaiEdit.blade.php ENDPATH**/ ?>