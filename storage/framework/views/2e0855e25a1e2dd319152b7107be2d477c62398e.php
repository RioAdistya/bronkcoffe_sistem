<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/home.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
        <title>Rodicord</title>
    </head>
    <body>
        <div class="body-head">
            <div class="container-fluid px-4 px-lg-5 h-100">
                <div class="logo">
                    <a href="/"><img src="assets/img/Rodicord-logo.png" height="50" alt="Logo-Rodicord"></a>
                </div>
                <div class="row gx-4 gx-lg-5 h-100">
                    <div class="content lg-6">
                        <div class="col-lg-6 align-self-end">
                            <h1 class="text-white">BronkCoffee</h1>
                        </div>
                        <div class="col-lg-6 align-self-baseline">
                            <p class="text-white mb-5">Rodicord (Bronkcoffee Prediction And Record) adalah sebuah sistem informasi
                                berbasis website akan pencatatan dan olah data stok, produksi, dan penjualan kopi. Dengan menggunakan sistem ini, diharap dapat mempermudah mitra dalam mengetahui
                                penyimpanan data stok, produksi, dan penjualan kopi. Selain untuk melakukan pencatatan dan
                                olah data, sistem ini juga berfungsi untuk memprediksi jumlah permintaan pasar dan jumlah
                                stok biji kopi.</p>
                        </div>
                        <div class="btn">
                            <a type="button" class="btn btn-success mx-3" href="/login">Login</a>
                            <a type="button" class="btn btn-outline-success text-white" href="#about">Tentang Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="page-section" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Rodicord</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-80 mb-3">Sistem ini ditujukan untuk mitra kami yang memiliki permasalahan
                            dalam pencatatan dan olah data stok, produksi, dan penjualan kopi dengan cara
                            manual. Sehingga target pengguna sistem ini adalah Mitra sendiri (Owner
                            Bronkcoffee), dan karyawan-karyawan mitra. Yang mana diharapkan
                            penerapan sistem ini akan mempermudah karyawan-karyawan mitra dalam hal
                            pencatatan dan olah data stok, produksi, dan penjualan kopi. Serta
                            mempermudah mitra juga untuk memantau rekap data penjualan, pengeluaran,
                            dan pemasukan.</p>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/main.blade.php ENDPATH**/ ?>