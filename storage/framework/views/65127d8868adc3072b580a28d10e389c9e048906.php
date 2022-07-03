
  
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarOwner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="layoutSidenav_content">    
        <style>
            main {
                font-family: 'Poppins', sans-serif;
            }
        </style>
        <main>
            <div class="container-fluid px-4 py-4">
                <div class="header">
                    <h4><strong>Edit Profil Owner</strong></h4>
                </div>
                <hr>
                <div class="form-edit">
                    <form action="">
                        
                        <div class="row mb-3">
                            <label for="nama" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Nama</strong></label>
                            <div class="col-sm-8 col-md-9 col-xl-10">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required value="Ferdian Fernanda Syahputra"/>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="email" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Email</strong></label>
                            <div class="col-sm-8 col-md-9 col-xl-10">
                                <input type="email" class="form-control" name="email" id="email" placeholder="email" required value="owner@gmail.com" />
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="phone" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Nomor Handphone</strong></label>
                            <div class="col-sm-8 col-md-9 col-xl-10">
                                <input type="tel" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" class="form-control" name="phone" id="phone" placeholder="Phone Number" required value="0821-2123-2384"/>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="address" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Alamat</strong></label>
                            <div class="col-sm-8 col-md-9 col-xl-10">
                                <textarea type="textarea" class="form-control" name="address" id="address" rows="4" placeholder="Alamat">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</textarea>
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="row mb-3 justify-content-end mx-3">
                            <div class="col-sm-8 col-md-9 col-xl-10" style="text-align:end;">
                                <button type="submit" class="btn btn-success mx-3">
                                    Simpan
                                </button>
                                <a type="button" class="btn btn-light border" href="/ownerMitra">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/editOwner.blade.php ENDPATH**/ ?>