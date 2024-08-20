<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Master Karyawan</title>
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
            <h4 class="panel-heading">Data Master Karyawan</h4>
            <div class="panel-body">
                <div class="d-flex justify-content-end align-items-end flex-wrap mx-2">
                    <div class="breadcrumb">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page"
                                class="text-decoration-none text-primary">Beranda</a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=karyawan" aria-current="page" class="text-decoration-none text-primary">Data
                                Master Karyawan</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title">Master Data Karyawan</h4>
                <a href="?page=karyawan" aria-current="page" class="btn btn-info">
                    <i class="fa fa-refresh fa-1x"></i>
                    <span>Refresh Page</span>
                </a>
                <a href="?page=daftarkaryawan" aria-current="page" class="btn btn-danger">
                    <i class="fa fa-plus fa-1x"></i>
                    <span>Tambah Data Karyawan</span>
                </a>
            </div>
            <div class="card-body mt-1">
                <div class="container">
                    <div class="table-responsive">
                        <form action="" method="post">
                            <input type="search" name="cari" aria-controls="example2_filter" id="example1_filter"
                                required>
                        </form>
                        <div class="fs-6 d-flex justify-content-start align-items-start flex-wrap">
                            Status Karyawan :
                            <ol type="1">
                                <li>Jika Tidak Aktif akan berwarna abu - abu, dan</li>
                                <li>Jika Aktif akan berwarna biru</li>
                            </ol>
                        </div>
                        <div class="d-table">
                            <table class="table-layout-karyawan" id="example1">
                                <thead>
                                    <tr>
                                        <th class="table-layout-2 text-center">No.</th>
                                        <th class="table-layout-2 text-center">nip karyawan</th>
                                        <th class="table-layout-2 text-center">nama lengkap</th>
                                        <th class="table-layout-2 text-center">tempat, tanggal lahir</th>
                                        <th class="table-layout-2 text-center">alamat karyawan</th>
                                        <th class="table-layout-2 text-center">email karyawan</th>
                                        <th class="table-layout-2 text-center">jabatan</th>
                                        <th class="table-layout-2 text-center">foto karyawan</th>
                                        <th class="table-layout-2 text-center">status karyawan</th>
                                        <th class="table-layout-2 text-center">opsional</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $sql = "SELECT * FROM karyawan order by id_karyawan asc";
                                        $data = $konfigs->query($sql);
                                        while($isi = $data->fetch_array()){
                                    ?>
                                    <tr>
                                        <td class="table-layout-2 text-center"><?php echo $no; ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['nip'] ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['nama'] ?></td>
                                        <td class="table-layout-2 text-center">
                                            <?php echo $isi['tempat_lahir'].", ".$isi['tanggal_lahir'] ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['alamat'] ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['email'] ?></td>
                                        <td class="table-layout-2 text-center"><?php echo $isi['role'] ?></td>
                                        <td class="table-layout-2 text-center">
                                            <?php $baseFile = "../../../../../assets/karyawan/$isi[foto]"; ?>
                                            <img src="<?php echo $baseFile;?>" width="64" alt="">
                                        </td>
                                        <td class="table-layout-2 text-center">
                                            <form action="?aksi=select-karyawan" method="post">
                                                <input type="hidden" name="username"
                                                    value="<?php echo $isi['username']?>">
                                                <div class="form-switch form-check">
                                                    <input type="checkbox" name="status" value="0"
                                                        class="form-check-input" onchange="this.form.submit()"
                                                        <?php if($isi['status'] == "0"){?> checked <?php } ?> required
                                                        id=""> tidak aktif /
                                                    <input type="checkbox" name="status" value="1"
                                                        class="form-check-input" onchange="this.form.submit()"
                                                        <?php if($isi['status'] == "1"){?> checked <?php } ?> required
                                                        id=""> aktif
                                                </div>
                                            </form>
                                        </td>
                                        <td class="table-layout-2 text-center">
                                            <a href="?aksi=hapus-data&id_karyawan=<?php echo $isi['id_karyawan']?>"
                                                aria-current="page"
                                                onclick="return confirm('Apakah anda ingin menghapus data karyawan ini ?')"
                                                class="btn btn-danger">
                                                <i class="fa fa-trash-alt fa-1x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
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