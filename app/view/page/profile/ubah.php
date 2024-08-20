<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Master karyawan</title>
        <?php 
            if($_SESSION['role'] == "karyawan"){
                require_once("../ui/header.php");
                require_once("../../../database/koneksi.php");
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
            <h4 class="panel-heading">Data Master karyawan</h4>
            <div class="panel-body">
                <div class="d-flex justify-content-end align-items-end flex-wrap mx-2">
                    <div class="breadcrumb">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page"
                                class="text-decoration-none text-primary">Beranda</a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?aksi=ubah-karyawan&username=<?php echo $_SESSION['username']?>"
                                aria-current="page" class="text-decoration-none text-primary">Ubah Data karyawan</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title">Ubah Data karyawan</h4>
            </div>
            <div class="card-body">
                <div class="container">
                    <?php 
                        if(isset($_SESSION['username'])){
                        $named = htmlspecialchars($_SESSION['username']);
                        $sql = "SELECT * FROM karyawan WHERE username = '$named'";
                        $data = $konfigs->query($sql);
                        while($isi = $data->fetch_array()){
                    ?>
                    <form action="?aksi=edit-karyawan" enctype="multipart/form-data" method="post">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-8 col-md-9">
                                <div class="card-body">
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default">username</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="text" name="username" class="form-control" required
                                                    aria-required="TRUE" aria-label="username" readonly
                                                    value="<?=$isi['username']?>"
                                                    placeholder="masukkan username baru ..." maxlength="100" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default">email</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="email" name="email" class="form-control" required
                                                    aria-required="TRUE" aria-label="email" value="<?=$isi['email']?>"
                                                    placeholder="masukkan email baru ..." maxlength="255" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default">password</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="password" name="password" class="form-control" required
                                                    aria-required="TRUE" aria-label="password"
                                                    placeholder="masukkan password baru ..." maxlength="255" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default">nip karyawan</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="text" name="nip" class="form-control" required
                                                    aria-required="TRUE" aria-label="nip karyawan"
                                                    value="<?=$isi['nip']?>" placeholder="masukkan nip karyawan ..."
                                                    maxlength="18" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default">nama lengkap</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="text" name="nama" class="form-control" required
                                                    aria-required="TRUE" aria-label="nama" value="<?=$isi['nama']?>"
                                                    placeholder="masukkan nama lengkap ..." maxlength="100" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default">tempat lahir</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="text" name="tempat_lahir" class="form-control" required
                                                    aria-required="TRUE" aria-label="tempat lahir"
                                                    value="<?=$isi['tempat_lahir']?>"
                                                    placeholder="masukkan tempat lahir ..." maxlength="255" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default">tanggal lahir</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="date" name="tanggal_lahir" class="form-control" required
                                                    aria-required="TRUE" aria-label="tanggal lahir"
                                                    value="<?=$isi['tanggal_lahir']?>"
                                                    placeholder="masukkan tanggal lahir ..." id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default">tanggal lahir</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <textarea name="alamat" class="form-control" required
                                                    aria-required="TRUE" maxlength="255"
                                                    placeholder="masukkan alamat karyawan ..."
                                                    id=""><?php echo $isi['alamat'] ?></textarea>
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
                                                    <img <?php if($isi['foto'] != ""){?>
                                                        src="../../../../assets/karyawan/<?=$isi['foto']?>"
                                                        <?php }else{?> src="../../../../assets/karyawan/user_logo.png"
                                                        <?php } ?> id="preview" alt="" width="64"
                                                        class="img-rounded img-fluid">
                                                    <br>
                                                    <input type="file" name="foto" accept="image/*"
                                                        class="form-control-file mt-2 mt-lg-2" required
                                                        onchange="previewImage(this)" aria-required="true">
                                                    <br>
                                                    <input type="checkbox" name="ubahfoto" id=""> Klik jika ingin ubah
                                                    foto
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="form-inline row justify-content-center
                                             align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default">jabatan</label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="radio" name="role" class="radio radio-inline ms-2 me-3"
                                                    required aria-required="TRUE"
                                                    <?php if($isi['role'] == "karyawan"){?> checked <?php } ?>
                                                    aria-label="jabatan" value="karyawan" id="">karyawan
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
                                        <a href="?page=beranda" aria-current="page" class="btn btn-default">Cancel</a>
                                        <button type="reset" class="btn btn-danger">
                                            <i class="fa fa-eraser fa-1x"></i>
                                            <span>Hapus semua</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>