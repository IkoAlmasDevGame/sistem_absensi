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
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=daftarkaryawan" aria-current="page"
                                class="text-decoration-none text-primary">Tambah Data Karyawan</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title">Tambah Data Karyawan</h4>
            </div>
            <div class="card-body">
                <div class="container">
                    <form action="?aksi=tambah-karyawan" enctype="multipart/form-data" method="post">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-8 col-md-9">
                                <div class="card-body">
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-5">username</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="text" name="username" class="form-control"
                                                    aria-required="TRUE" required maxlength="255"
                                                    placeholder="masukkan username baru karyawan ..." id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-5">password</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="password" name="password" class="form-control"
                                                    aria-required="TRUE" required maxlength="255"
                                                    placeholder="masukkan password baru karyawan ..." id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-5">nip karyawan</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="text" name="nip" inputmode="numeric" class="form-control"
                                                    aria-required="TRUE" required maxlength="18"
                                                    placeholder="masukkan nip baru karyawan ..." id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-5">nama karyawan</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="text" name="nama" class="form-control" aria-required="TRUE"
                                                    required maxlength="100" placeholder="masukkan nama karyawan ..."
                                                    id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-5">tempat lahir</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="text" name="tempat_lahir" class="form-control"
                                                    aria-required="TRUE" required maxlength="255"
                                                    placeholder="masukkan tempat lahir karyawan ..." id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-5">tanggal lahir</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="date" name="tanggal_lahir" class="form-control"
                                                    aria-required="TRUE" required id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-5">alamat</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <textarea name="alamat" class="form-control" required
                                                    aria-required="TRUE" placeholder="masukkan alamat karyawan ...."
                                                    maxlength="255" id=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-5">email karyawan</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="email" name="email" class="form-control"
                                                    aria-required="TRUE" required maxlength="255"
                                                    placeholder="masukkan email karyawan ..." id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default">jabatan</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="radio" name="role" class="radio radio-inline ms-2 me-3"
                                                    required aria-required="TRUE" aria-label="jabatan" value="karyawan"
                                                    id="">karyawan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default">Photo</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <div class="form-icon">
                                                    <img src="../../../../../assets/karyawan/user_logo.png" id="preview"
                                                        alt="" width="64" class="img-rounded img-fluid">
                                                </div>
                                                <div class="form-check-input">
                                                    <input type="file" name="foto" accept="image/*"
                                                        class="form-control-file" required onchange="previewImage(this)"
                                                        aria-required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save fa-1x"></i>
                                            <span>Simpan data</span>
                                        </button>
                                        <a href="?page=karyawan" aria-current="page" class="btn btn-default">Cancel</a>
                                        <button type="reset" class="btn btn-danger">
                                            <i class="fa fa-eraser fa-1x"></i>
                                            <span>Hapus semua</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>