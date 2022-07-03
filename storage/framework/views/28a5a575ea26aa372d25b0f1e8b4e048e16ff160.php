<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<nav class="sb-topnav navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <button class="btn btn-link btn-lg order-1 order-lg-0 me-4 me-lg-0 mx-2" id="sidebarToggle"><i class="fas fa-bars"></i></button>
    <div class="sb-nav-link-icon mx-2">
        <img src="../../../assets/img/Rodicord-logo.png" height="40" alt="RODICORD">
    </div>
    <!-- Navbar-->
    <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" type="submit" id="logout"><i class="bi bi-box-arrow-in-left"></i> <?php echo e(__('Logout')); ?></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<script 
    src="https://code.jquery.com/jquery-3.6.0.slim.js"  
    integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
    crossorigin="anonymous">
</script>
<script>
    $('#logout').click(function(){
        Swal.fire({
            title: 'Yakin?',
            text: "Apakah Anda yakin ingin Logout?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#c4c4c4',
            confirmButtonText: 'Yakin',
            cancelButtonText: 'Batal'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location = "<?php echo e(route('logout')); ?>";
            }
        })
    })
</script><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/partials/navbar.blade.php ENDPATH**/ ?>