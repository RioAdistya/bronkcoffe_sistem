<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <style>
            nav {
                font-family: 'Poppins', sans-serif;
            }
        </style>
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="/home">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Data Akun</div>
                    <a class="nav-link" href="/ownerMitra">
                        <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                        Profil  
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
                        Karyawan
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link" href="/karyawanKedai">
                                Kedai Kopi
                            </a>
                            <a class="nav-link" href="/karyawanProduksi">
                                Produksi Kopi
                            </a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Data Kopi</div>
                    <a class="nav-link" href="/ownerStockKopi">
                        <div class="sb-nav-link-icon"><i class="fa fa-coffee"></i></div>
                        Stock Kopi
                    </a>
                    <a class="nav-link" href="/ownerBahanBaku">
                        <div class="sb-nav-link-icon"><i class="fa fa-cubes"></i></i></div>
                        Bahan Baku
                    </a>
                    <a class="nav-link" href="/ownerRekapitulasi">
                        <div class="sb-nav-link-icon"><i class="bi bi-currency-dollar"></i></div>
                        Keuangan
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages2" aria-expanded="false" aria-controls="collapsePages2">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Prediksi
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages2" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link" href="/ownerPrediksiPasar/Americano/Biji Kopi/Keseluruhan">
                                Permintaan Pasar
                            </a>
                            <a class="nav-link" href="/ownerPrediksiStok/Keseluruhan">
                                Stok Biji Kopi 
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as: </div>
                <?php echo e(Auth::user()->name); ?>

            </div>
        </nav>
    </div>

<?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/partials/sidebarOwner.blade.php ENDPATH**/ ?>