<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Master Pengaturan</title>
        <?php 
            if($_SESSION['role'] == "admin"){
                require_once("../ui/header.php");
                require_once("../../../../database/koneksi.php");
                if(isset($_POST['submit'])){
                    $id_jam = htmlspecialchars($_POST['id_jam']);
                    $jam_masuk = htmlspecialchars($_POST['jam_masuk']);
                    $id_sistem = htmlspecialchars($_POST['id_sistem']);
                    $developer = htmlspecialchars($_POST['developer']);
                    $status = htmlspecialchars($_POST['status']);
                    # code ...
                    $konfigs->query("UPDATE jam_masuk SET jam_masuk = '$jam_masuk' WHERE id_jam = '$id_jam'");
                    $konfigs->query("UPDATE sistem SET developer = '$developer', status = '$status' WHERE id_sistem = '$id_sistem'");
                    echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                    die;
                }
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
            <h4 class="panel-heading">Data Master Pengaturan</h4>
            <div class="panel-body">
                <div class="d-flex justify-content-end align-items-end flex-wrap mx-2">
                    <div class="breadcrumb">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page"
                                class="text-decoration-none text-primary">Beranda</a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=pengaturan&id_sistem=1" aria-current="page"
                                class="text-decoration-none text-primary">Ubah Pengaturan</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title">Ubah Pengaturan</h4>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="fs-6 d-flex justify-content-start align-items-start flex-wrap">
                        Status Sistem :
                        <ol type="1">
                            <li>Jika Tidak Aktif akan berwarna abu - abu, dan</li>
                            <li>Jika Aktif akan berwarna biru</li>
                        </ol>
                    </div>
                    <?php 
                        $sql = "SELECT * FROM sistem WHERE id_sistem = '1'";
                        $data = $konfigs->query($sql);
                        while($isi = $data->fetch_array()){
                    ?>
                    <form action="?page=pengaturan" method="post">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-8 col-md-9">
                                <div class="card-body">
                                    <div class="card-header card-title">
                                        <div class="display-4 fs-5 text-center">Pengaturan Sistem Aplikasi Absensi</div>
                                    </div>
                                    <?php 
                                        $jam = $konfigs->query("SELECT * FROM jam_masuk WHERE id_jam = '1'");
                                        $pro = mysqli_fetch_array($jam);
                                    ?>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for=""
                                                    class="label label-default"><?php echo ucfirst(ucwords('jam masuk')) ?></label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="hidden" name="id_jam" required
                                                    value="<?php echo $pro['id_jam']?>">
                                                <input type="time" name="jam_masuk" class="form-control" required
                                                    aria-required="TRUE" aria-label="jam masuk"
                                                    value="<?=$pro['jam_masuk']?>" placeholder="masukkan jam masuk ..."
                                                    id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border border-top my-1 row-cols-3 row-cols-sm-3"></div>
                                    <input type="hidden" name="id_sistem" required
                                        value="<?php echo $isi['id_sistem']?>">
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for=""
                                                    class="label label-default"><?php echo ucfirst(ucwords('developer')) ?></label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <input type="text" name="developer" class="form-control" required
                                                    aria-required="TRUE" aria-label="developer"
                                                    value="<?=$isi['developer']?>"
                                                    placeholder="masukkan nama developer ..." maxlength="100" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for=""
                                                    class="label label-default"><?php echo ucfirst(ucwords('status')) ?></label>
                                            </div>
                                            <div class="col-sm-7 col-md-8">
                                                <div class="form-switch form-check">
                                                    <input type="checkbox" name="status" value="0"
                                                        class="form-check-input" <?php if($isi['status'] == "0"){?>
                                                        checked <?php } ?> id=""> tidak aktif /
                                                    <input type="checkbox" name="status" value="1"
                                                        class="form-check-input" <?php if($isi['status'] == "1"){?>
                                                        checked <?php } ?> id=""> aktif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-center">
                                        <button type="submit" name='submit' class="btn btn-primary">
                                            <i class="fa fa-save fa-1x"></i>
                                            <span>Simpan data</span>
                                        </button>
                                        <a href="?page=beranda" aria-current="page" class="btn btn-default">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>