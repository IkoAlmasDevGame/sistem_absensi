<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Master Admin</title>
        <?php 
            if($_SESSION['role'] == "admin"){
                require_once("../ui/header.php");
                require_once("../../../../database/koneksi.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                die;
            }
        ?>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="panel container panel-default bg-body-secondary">
            <h4 class="panel-heading">Data Master Admin</h4>
            <div class="panel-body">
                <div class="d-flex justify-content-end align-items-end flex-wrap mx-2">
                    <div class="breadcrumb">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page"
                                class="text-decoration-none text-primary">Beranda</a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=admin" aria-current="page" class="text-decoration-none text-primary">Data
                                Master Admin</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title">Master Data Admin</h4>
                <a href="?page=admin" aria-current="page" class="btn btn-info">
                    <i class="fa fa-refresh fa-1x"></i>
                    <span>Refresh Page</span>
                </a>
                <a href="?page=daftaradmin" aria-current="page" class="btn btn-danger">
                    <i class="fa fa-plus fa-1x"></i>
                    <span>Tambah Data Admin</span>
                </a>
            </div>
            <div class="card-body mt-1">
                <div class="container">
                    <div class="table-responsive">
                        <form action="" method="post">
                            <input type="search" name="cari" aria-controls="example2_filter" id="example1_filter"
                                required>
                        </form>
                        <div class="d-table">
                            <table class="table-layout" id="example1">
                                <thead>
                                    <tr>
                                        <th class="table-layout-2 text-center">No.</th>
                                        <th class="table-layout-2 text-center">username</th>
                                        <th class="table-layout-2 text-center">email</th>
                                        <th class="table-layout-2 text-center">password</th>
                                        <th class="table-layout-2 text-center">nama</th>
                                        <th class="table-layout-2 text-center">foto</th>
                                        <th class="table-layout-2 text-center">jabatan</th>
                                        <th class="table-layout-2 text-center">opsional</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        if(isset($_SESSION['role'])){
                                        $sql = "SELECT * FROM users  WHERE role = '$_SESSION[role]' order by id_akun asc";
                                        $data = mysqli_query($konfigs, $sql);
                                        while($isi = $data->fetch_array()){
                                    ?>
                                    <tr>
                                        <td class="table-layout-2 text-center"><?php echo $no; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['username'] ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['email'] ?></td>
                                        <td class="table-layout-2 text-center">password ter-enkripsi</td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['nama'] ?></td>
                                        <?php $baseFile = "../../../../../assets/admin/$isi[foto]"; ?>
                                        <td class="table-layout-2 text-center"><img src="<?php echo $baseFile; ?>"
                                                width="64" alt=""></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['role'] ?></td>
                                        <td class="table-layout-2 text-center">
                                            <a href="?aksi=hapus-admin&id_akun=<?php echo $isi['id_akun']?>"
                                                onclick="return confirm('apakah anda ingin menghapus data admin ini ?')"
                                                aria-current="page" class="btn btn-danger">
                                                <i class="fa fa-trash-alt fa-1x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>