
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarProduksi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="layoutSidenav_content">
    <style>
        strong, ::placeholder {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <main>
        <?php $__currentLoopData = $bahan_baku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="container-fluid px-4 py-4">
            <div class="header">
                <h4><strong>Edit Data Bahan Baku</strong></h4>
            </div>
            <hr>
            <div class="form-edit">
                <form method="post" action="/bahanBaku/update/<?php echo e($p->namaBahan); ?>/<?php echo e($p->kuantitas); ?>/<?php echo e($p->hargaSatuan); ?>/<?php echo e($p->keterangan); ?>">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(method_field('PATCH')); ?>


                    
                    <div class="row mb-3">
                        <label for="namaBahan" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Nama Produk</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="text" id="namaBahan" readonly="readonly" class="form-control" name="namaBahan" placeholder="Nama Bahan Baku" autocomplete="off" required oninvalid="this.setCustomValidity('Nama tidak boleh Kosong')" oninput="this.setCustomValidity('')" value="<?php echo e($p->namaBahan); ?>"/>
                            <?php if($errors->has('namaBahan')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('namaBahan')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <label for="kuantitas" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Kuantitas</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="0" max="99999" name="kuantitas" id="kuantitas" placeholder="Kuantitas" autocomplete="off" required oninvalid="this.setCustomValidity('Cek kembali jumlah stok')" oninput="this.setCustomValidity('')" value="<?php echo e($p->total_stok_bahan); ?>"/>
                            <?php if($errors->has('kuantitas')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('kuantitas')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div> 

                    
                    <div class="row mb-3">
                        <label for="hargaSatuan" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Harga Satuan</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <input type="number" class="form-control" min="500" max="100000000" step="500" name="hargaSatuan" id="hargaSatuan" placeholder="Harga Satuan" autocomplete="off" required oninvalid="this.setCustomValidity('Cek kembali harga')" oninput="this.setCustomValidity('')" value="<?php echo e($p->hargaSatuan); ?>"/>
                            <?php if($errors->has('hargaSatuan')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('hargaSatuan')); ?>

                            </div>
                        <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <label for="keterangan" class="col-form-label col-sm-4 col-md-3 col-xl-2"><strong>Keterangan</strong></label>
                        <div class="col-sm-8 col-md-9 col-xl-10">
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="4" placeholder="Keterangan" autocomplete="off"></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3 justify-content-end mx-3 my-4">
                        <div class="col-sm-8 col-md-9 col-xl-10" style="text-align:end;">
                            <a type="submit" id="edit" class="btn btn-success mx-3" stokLama="<?php echo e($p->total_stok_bahan); ?>"><?php echo e(__('Simpan')); ?></a>
                            <a type="button" class="btn btn-secondary border" href="/produksiBahanBaku">
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
<script 
    src="https://code.jquery.com/jquery-3.6.0.slim.js"  integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
    crossorigin="anonymous">
</script>
<script>
    var kuantitas = document.getElementById("kuantitas");
    var namaBahan = document.getElementById("namaBahan");
    var hargaSatuan = document.getElementById("hargaSatuan");
    var keterangan = document.getElementById("keterangan");

    $('#edit').click(function(){
        var stokLama = $(this).attr('stokLama');
        var stokBaru = kuantitas.value - stokLama;

        if (kuantitas.value.length == 0 || kuantitas.value < 0){
            Swal.fire({
                title: 'Maaf',
                text: "Kuantitas atau harga tidak boleh kosong.",
                icon: 'warning',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonColor: '#ffc107',
                cancelButtonText: 'OK',
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/bahanBaku/edit/"+namaBahan.value;
                }
            })
        } else if (hargaSatuan.value.length == 0 || hargaSatuan.value < 0){
            Swal.fire({
                title: 'Maaf',
                text: "Kuantitas atau harga tidak boleh kosong.",
                icon: 'warning',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonColor: '#ffc107',
                cancelButtonText: 'OK',
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/bahanBaku/edit/"+hargaSatuan.value;
                }
            })          
        } else{
            if (stokBaru > 0 && stokBaru <= 99999 ){
                if (hargaSatuan.value.length >= 11 || hargaSatuan.value.length < 3 || hargaSatuan.value%500 != 0){
                    Swal.fire({
                        title: 'Maaf',
                        text: "Cek kembali harga yang anda inputkan dan inputan minimal 500",
                        icon: 'warning',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonColor: '#ffc107',
                        cancelButtonText: 'OK',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "/bahanBaku/edit/"+hargaSatuan.value;
                        }
                    }) 
                } else {
                    Swal.fire({
                        title: 'Yakin?',
                        text: "Ingin menambahkan jumlah " + namaBahan.value +" sebanyak "+ stokBaru + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Batal'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            if (keterangan.value == ""){
                                keterangan.value = "-"
                                window.location = "/bahanBaku/update/"+namaBahan.value+"/"+kuantitas.value+"/"+hargaSatuan.value+"/"+keterangan.value;
                            } else{
                                window.location = "/bahanBaku/update/"+namaBahan.value+"/"+kuantitas.value+"/"+hargaSatuan.value+"/"+keterangan.value;
                            }
                        }
                    })
                }
            } else if (stokBaru < 0 && stokBaru <= 99999 ) {
                if (hargaSatuan.value.length >= 11 || hargaSatuan.value.length < 3 || hargaSatuan.value%500 != 0){
                    Swal.fire({
                        title: 'Maaf',
                        text: "Cek kembali harga yang anda inputkan dan inputan minimal 500",
                        icon: 'warning',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonColor: '#ffc107',
                        cancelButtonText: 'OK',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "/bahanBaku/edit/"+hargaSatuan.value;
                        }
                    }) 
                } else {
                    Swal.fire({
                        title: 'Yakin?',
                        text: "Ingin mengurangi jumlah " + namaBahan.value +" sebanyak "+ Math.abs(stokBaru) + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Batal'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            if (keterangan.value == ""){
                                keterangan.value = "-"
                                window.location = "/bahanBaku/update/"+namaBahan.value+"/"+kuantitas.value+"/"+hargaSatuan.value+"/"+keterangan.value;
                            } else{
                                window.location = "/bahanBaku/update/"+namaBahan.value+"/"+kuantitas.value+"/"+hargaSatuan.value+"/"+keterangan.value;
                            }
                        }
                    })  
                }
            } else if (stokBaru == 0){
                Swal.fire({
                    title: 'Maaf',
                    text: "Anda belum mengedit kuantitas bahan baku.",
                    icon: 'warning',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#ffc107',
                    cancelButtonText: 'OK',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/bahanBaku/edit/"+namaBahan.value;
                    }
                })
            } else{
                Swal.fire({
                    title: 'Maaf',
                    text: "Kuantitas bahan baku melebihi jumlah maksimum.",
                    icon: 'warning',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#ffc107',
                    cancelButtonText: 'OK',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/bahanBaku/edit/"+namaBahan.value;
                    }
                })
            }
        }
    })
    
</script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/produksi/BahanBakuEdit.blade.php ENDPATH**/ ?>