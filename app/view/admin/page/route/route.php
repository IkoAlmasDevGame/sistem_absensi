<?php 
require_once("../../../../database/koneksi.php");
$sql = "SELECT * FROM sistem WHERE status = '1'";
$data = mysqli_query($konfigs, $sql);
$row = mysqli_fetch_array($data);

/* Files Model & Files Controller */ 
/* Files Model */
require_once("../../../../model/model_users.php");
require_once('../../../../model/model_karyawan.php');
$user = new model\user_personalia($konfigs);
$people = new model\people($konfigs);
/* Files Controller */
require_once("../../../../controller/controller.php");
$auth = new controller\AuthPersonalia($konfigs);
$karyawan = new controller\karyawan($konfigs);

if(!isset($_GET['page'])){

}else{
    switch($_GET['page']){
        case 'beranda':
            require_once("../dashboard/index.php");
            break;

        case 'admin':
            require_once("../admin/admin.php");
            break;

        case 'karyawan':
            require_once("../karyawan/karyawan.php");
            break;

        case 'absensi':
            require_once("../absensi/absensi.php");
            break;

        case 'keterangan':
            require_once("../keterangan/keterangan.php");
            break;

        case 'daftaradmin':
            require_once("../admin/daftar.php");
            break;

        case 'daftarkaryawan':
            require_once("../karyawan/daftar.php");
            break;

        case 'pengaturan':
            require_once("../pengaturan/pengaturan.php");
            break;
            
        case 'keluar':
            if(isset($_SESSION['status'])){
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            header("location:../../auth/index.php");
            exit(0);
            break;
        
        default:
            require_once("../dashboard/index.php");
            break;
    }
}

if(!isset($_GET['aksi'])){
}else{
    switch ($_GET['aksi']) {
        # Admin Master
        case 'ubah-admin':
            require_once("../profile/ubah.php");
            break;
        case 'tambah-admin':
            $auth->buatedit();
            break;
        case 'hapus-admin':
            $auth->hapus();
            break;
        # Admin Master

        # Karyawan Master
        case 'tambah-karyawan':
            $karyawan->buat();
            break;
        case 'select-karyawan':
            $karyawan->pilih();
            break;
        case 'hapus-karyawan':
            $karyawan->hapus();
            break;
        # Karyawan Master
        
        default:
            require_once("../../../../controller/controller.php");
            break;
    }
}
?>