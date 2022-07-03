
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarOwner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    <div id="layoutSidenav_content">
        <style>
            strong, ::placeholder {
                font-family: 'Poppins', sans-serif;
            }
        </style>
        <main>
            <div class="container-fluid px-4 py-4">
                <div class="header">
                    <h4><strong>Tambah Data Karyawan Kedai</strong></h4>
                </div>
                <hr>
                <div class="form-edit">
                    <form method="post" action="/karyawanKedai/store">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('PATCH')); ?>

                        
                        <div class="row mb-3">
                            <label for="nama" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Nama</strong></label>
                            <div class="col-sm-8 col-md-9 col-xl-10">
                                <input type="text" class="form-control" name="namaKaryawan" id="namaKaryawan" placeholder="Nama Karyawan" required oninvalid="this.setCustomValidity('Nama tidak boleh Kosong')" oninput="this.setCustomValidity('')"/>
                                <?php if($errors->has('namaKaryawan')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('namaKaryawan')); ?>

                                </div>
                            <?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="phone" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Nomor Handphone</strong></label>
                            <div class="col-sm-8 col-md-9 col-xl-10">
                                <input type="text" pattern="[0-9]{10,13}" class="form-control" name="noTelepon" id="noTelepon" placeholder="08xxxxxxxxxx" required oninvalid="this.setCustomValidity('Mohon diisi dengan angka, minimal 10 digit, maksimal 13 digit')" oninput="this.setCustomValidity('')"/>
                                <?php if($errors->has('noTelepon')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('noTelepon')); ?>

                                </div>
                            <?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="address" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Alamat</strong></label>
                            <div class="col-sm-8 col-md-9 col-xl-10">
                                <textarea type="textarea" class="form-control" name="alamat" id="alamat" rows="4" placeholder="Alamat" required oninvalid="this.setCustomValidity('Alamat tidak boleh Kosong')" oninput="this.setCustomValidity('')"></textarea>
                                <?php if($errors->has('alamat')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('alamat')); ?>

                                </div>
                            <?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="status" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Status</strong></label>
                            <div class="col-sm-8 col-md-9 col-xl-10">
                                <select name="idStatus" class="form-control" placeholder="Status Karyawan">
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                </select>
                                    <?php if($errors->has('idStatus')): ?>
                                    <div class="text-danger">
                                        <?php echo e($errors->first('status')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group d-none">
                            <label>Karyawan Kedai</label>
                            <select name="type_id" class="form-control">
                                <option value="3">3</option>
                            </select>
                                <?php if($errors->has('type_id')): ?>
                                <div class="text-danger">
                                    <?php echo e($errors->first('type_id')); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row mb-3 justify-content-end mx-3 my-4">
                            <div class="col-sm-8 col-md-9 col-xl-10" style="text-align:end;">
                                <input type="submit" class="btn btn-success mx-3" value="Tambah">
                                <a type="button" class="btn btn-secondary border" href="/karyawanKedai">
                                    Batal
                                </a>
                            </div>
                        </div>

                        <?php if(count($errors) > 0): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                    </form>
                </div>
            </div>
        </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/owner/karyawanKedaiTambah.blade.php ENDPATH**/ ?>