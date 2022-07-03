<div class="card mt-3">
    <div class="card-header text-start">
        <strong>Tambah Data</strong> 
    </div>
    <div class="card-body">
        <p>Masukkan data penjualan :</p>
        <div class="border p-3">
            <form class="row" method="post" action="/penjualan/store">
                <?php echo e(csrf_field()); ?>

                <?php echo e(method_field('PATCH')); ?>

                
                <div class="mb-3 col-xl-6 col-md-12">
                    <label for="namaProduk" class="form-label">Nama Produk</label>
                    <select id="namaProduk" name="namaProduk" class="form-select" placeholder="Nama Produk" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Produk tidak boleh Kosong')" oninput="this.setCustomValidity('')">
                        <option value="" hidden>Pilih produk</option>
                        <?php $__currentLoopData = $nama_produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $np): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option><?php echo e($np->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('namaProduk')): ?>
                    <div class="text-danger">
                        <?php echo e($errors->first('namaProduk')); ?>

                    </div>
                    <?php endif; ?>
                </div>

                
                <div class="mb-3 col-xl-6 col-md-12">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select id="kategori" name="kategori" class="form-select" placeholder="Nama Produk" autocomplete="off" required oninvalid="this.setCustomValidity('Kategori tidak boleh Kosong')" oninput="this.setCustomValidity('')">
                        <option value="" hidden>Pilih Kategori</option>
                        <?php $__currentLoopData = $nama_kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option><?php echo e($nk->kategori); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('kategori')): ?>
                    <div class="text-danger">
                        <?php echo e($errors->first('kategori')); ?>

                    </div>
                    <?php endif; ?>
                </div>

                
                <div class="mb-3 col-xl-6 col-md-12">
                    <label for="kuantitas" class="form-label">Kuantitas (gr)</label>
                    <input name="kuantitas" type="number" min="5" class="form-control" id="kuantitas" placeholder="Jumlah Kuantitas (gr)" required oninvalid="this.setCustomValidity('Kuantitas tidak boleh Kosong')" oninput="this.setCustomValidity('')"/>
                </div>

                
                <div class="mb-3 col-xl-6 col-md-12">
                    <label for="harga" class="form-label">Harga Total (Rp)</label>
                    <input name="harga" readonly type="number" class="form-control" id="harga" placeholder="Harga Total"/>
                </div>

                <div>
                    <button class="btn btn-success w-100">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/kedai/kedaiPenjualanTambah.blade.php ENDPATH**/ ?>