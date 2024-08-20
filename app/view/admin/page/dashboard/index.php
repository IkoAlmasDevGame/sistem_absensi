<?php 
require_once("../ui/header.php");
require_once("../ui/sidebar.php");
require_once("../../../../database/koneksi.php");
?>

<!-- Body -->
<div class="container-fluid">
    <div class="col-sm-10 col-md-11">
        <?php 
            if(isset($_GET['info'])){
                if($_GET['info'] == "success"){
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Informasi</strong>
            <p>Selamat datang di halaman beranda sistem aplikasi absensi ...</p>
            <button type="button" onclick="document.location.href = '?page=beranda'" class="btn-close"
                data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
                }
            }
        ?>
    </div>
    <div class="d-flex justify-content-around align-items-center flex-wrap gap-1">
        <div class="col-sm-3 col-md-4">
            <div class="card mb-4">
                <div class="card-header py-2">
                    <i class="fa fa-user-plus fa-3x"></i>
                    <h4 class="card-title text-end">
                        <span>Jumlah Master Admin</span>
                    </h4>
                </div>
                <div class="card-body">
                    <?php 
                        $data = $konfigs->query("SELECT count(id_akun) as jumlah_admin FROM users");
                        $count = mysqli_fetch_array($data);
                    ?>
                    <div class="text-center fs-1 display-4">
                        <?php echo $count['jumlah_admin'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-md-4">
            <div class="card mb-4">
                <div class="card-header py-2">
                    <i class="fa fa-user-tag fa-3x"></i>
                    <h4 class="card-title text-end">
                        <span>Jumlah Master Karyawan</span>
                    </h4>
                </div>
                <div class="card-body">
                    <?php 
                        $data = $konfigs->query("SELECT count(id_karyawan) as jumlah_karyawan FROM karyawan");
                        $count = mysqli_fetch_array($data);
                    ?>
                    <div class="text-center fs-1 display-4">
                        <?php echo $count['jumlah_karyawan'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-md-4">
            <div class="card mb-4">
                <div class="card-header py-2">
                    <i class="fa fa-pencil fa-3x"></i>
                    <h4 class="card-title text-end">
                        <span>Jumlah Master Absensi</span>
                    </h4>
                </div>
                <div class="card-body">
                    <?php 
                        $data = $konfigs->query("SELECT count(id_absensi) as jumlah_absensi FROM absensi");
                        $count = mysqli_fetch_array($data);
                    ?>
                    <div class="text-center fs-1 display-4">
                        <?php echo $count['jumlah_absensi'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-md-4">
            <div class="card mb-4">
                <div class="card-header py-2">
                    <i class="fa fa-bookmark fa-3x"></i>
                    <h4 class="card-title text-end">
                        <span>Jumlah Master Keterangan</span>
                    </h4>
                </div>
                <div class="card-body">
                    <?php 
                        $data = $konfigs->query("SELECT count(id_keterangan) as jumlah_keterangan FROM keterangan");
                        $count = mysqli_fetch_array($data);
                    ?>
                    <div class="text-center fs-1 display-4">
                        <?php echo $count['jumlah_keterangan'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Body -->

<?php 
require_once("../ui/footer.php");
?>