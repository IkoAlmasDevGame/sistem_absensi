<?php 
require_once("../../../database/koneksi.php");
$sql = "SELECT * FROM sistem WHERE status = '1'";
$data = mysqli_query($konfigs, $sql);
$row = mysqli_fetch_array($data);

/* Files Model & Files Controller */ 
/* Files Model */
require_once('../../../model/model_karyawan.php');
require_once('../../../model/model_absensi.php');
require_once("../../../model/model_keterangan.php");
$people = new model\people($konfigs);
$absensi = new model\absensi($konfigs);
$keterangan = new model\keterangan($konfigs);
/* Files Controller */
require_once("../../../controller/controller.php");
$karyawan = new controller\karyawan($konfigs);
$attedance = new controller\attedance($konfigs);
$document = new controller\document($konfigs);

if(!isset($_GET['page'])){

}else{
    switch($_GET['page']){
        case 'beranda':
            require_once("../dashboard/index.php");
            break;
            
        case 'absensi':
            require_once("../absensi/absensi.php");
            break;
            
        case 'keterangan':
            require_once("../keterangan/keterangan.php");
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
        case 'simpan-absensi':
            $attedance->attdance();
            break;

        case 'simpan-keterangan':
            $document->buat_keterangan();
            break;

        case 'ubah-karyawan':
            require_once("../profile/ubah.php");
            break;

        case 'edit-karyawan':
            $attedance->ubah();
            break;
        
        default:
            require_once("../../../controller/controller.php");
            break;
    }
}
?>