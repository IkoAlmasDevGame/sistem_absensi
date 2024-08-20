<?php 
namespace model;

class keterangan {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function simpan_keterangan($nip, $nama, $keterangan, $alasan, $tanggal, $jam){
        $nip = htmlspecialchars($_POST['nip']) ? htmlentities($_POST['nip']) : strip_tags($_POST['nip']);
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : strip_tags($_POST['nama']);
        $keterangan = htmlspecialchars($_POST['keterangan']) ? htmlentities($_POST['keterangan']) : strip_tags($_POST['keterangan']);
        $alasan = htmlspecialchars($_POST['alasan']) ? htmlentities($_POST['alasan']) : strip_tags($_POST['alasan']);
        $tanggal = htmlspecialchars($_POST['tanggal']) ? htmlentities($_POST['tanggal']) : strip_tags($_POST['tanggal']);
        $jam = htmlspecialchars($_POST['jam']) ? htmlentities($_POST['jam']) : strip_tags($_POST['jam']);

        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif'); 
        $photo_src = htmlentities($_FILES["foto"]["name"]) ? htmlspecialchars($_FILES["foto"]["name"]) : $_FILES["foto"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['foto']['size'];
        $file_tmp_photo_src = $_FILES['foto']['tmp_name'];

        if(in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true){
            if($ukuran_photo_src < 10440070){
                move_uploaded_file($file_tmp_photo_src, "../../../../../assets/keterangan/" . $photo_src);
            }else{
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit;                
            }
        }else{
            echo "Tidak Dapat Ter - Upload Gambar";
            exit;
        }

        $table = "keterangan";
        $base = $this->db->query("SELECT * FROM $table WHERE nip = '$nip' and tanggal = '$tanggal'");
        $cek = mysqli_num_rows($base);

        if($cek){
            echo "<script>alert('anda sudah membuat laporan keterangan sebelumnya !'); document.location.href = '../ui/header.php?page=keterangan';</script>";
            die;
        }else{
            $insert = "INSERT INTO $table SET nip = '$nip', nama = '$nama', keterangan = '$keterangan', alasan = '$alasan', tanggal = '$tanggal', jam = '$jam', foto = '$photo_src'";
            $data = $this->db->query($insert);
            if($data != null){
                if($data){
                    echo "<script>alert('anda sudah membuat laporan keterangan !'); document.location.href = '../ui/header.php?page=beranda';</script>";
                    die;
                }
            }else{
                echo "<script>alert('maaf anda belum isi semua form surat keterangan !'); document.location.href = '../ui/header.php?page=keterangan';</script>";
                die;                
            }
        }
    }
}

?>