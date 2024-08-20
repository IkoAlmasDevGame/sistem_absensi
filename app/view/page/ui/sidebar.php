<?php 
if($_SESSION["role"] == ""){
    echo "<script>document.location.href = '../../auth/index.php'</script>";
    die;
    exit;
}
?>

<?php if($_SESSION['role'] == "karyawan"){
?>
<header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
    <div class="d-flex align-items-center justify-content-between">
        <a href="" role="button" class="logo d-flex align-items-center fs-6 fst-normal fw-semibold">
            Sistem Absensi
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto mx-3">
        <ul>
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                    data-bs-toggle="dropdown" aria-controls="dropdown">
                    <?php $baseFile = mysqli_fetch_array($konfigs->query("SELECT * FROM karyawan WHERE email = '$_SESSION[email]'")); ?>
                    <img src="../../../../assets/karyawan/<?php echo $baseFile['foto']; ?>" width="32"
                        alt="<?php echo $_SESSION['name']?>" class="rounded-3 img-circle img-responsive">
                    <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <hr class="dropdown-divider">
                        <div class="text-start">username : <?php echo $_SESSION['username'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">Email : <?php echo $_SESSION['email'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">nama : <?php echo $_SESSION['name'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">Jabatan : <?php echo $_SESSION['role'] ?></div>
                        <hr class="dropdown-divider">
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>
<!-- ======= Header ======= -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=beranda">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Blank Page Nav -->

        <li class="nav-item">
            <a href="#" data-bs-target="#master-nav" data-bs-toggle="collapse" class="nav-link collapsed">
                <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul class="nav-content collapse" id="master-nav" data-bs-parent="#sidebar-nav">
                <a href="?page=keterangan" aria-current="page" class="nav-link nav-pills">
                    <i class="fa fa-circle fa-1x"></i>
                    <span>Master Keterangan</span>
                </a>
                <a href="?page=absensi" aria-current="page" class="nav-link nav-pills">
                    <i class="fa fa-circle fa-1x"></i>
                    <span>Master Absensi</span>
                </a>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page"
                href="?aksi=ubah-karyawan&username=<?php echo $_SESSION['username']?>"
                onclick="return confirm('Apakah anda ingin edit profile anda ?')">
                <i class="fa fa-user-edit fa-1x"></i>
                <span>Edit Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=keluar"
                onclick="return confirm('Apakah anda ingin logout ?')">
                <i class="fa fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Blank Page Nav -->
    </ul>
</aside><!-- End Sidebar-->
<!-- ======= Sidebar ======= -->

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                </div>

            </div><!-- End Right side columns -->

        </div>
    </section>
    <?php
}else{
    echo "<script>
    document.location.href = '../../auth/index.php';
    </script>";
    die;
    exit;
}
?>