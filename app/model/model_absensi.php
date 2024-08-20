<?php 

namespace model;

class absensi {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function simpan_absensi($nip, $nama, $tanggal, $absensi, $jam){
        $nip = htmlentities($_POST['nip']) ? htmlspecialchars($_POST['nip']) : $_POST['nip'];
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : $_POST['nama'];
        $tanggal = htmlspecialchars($_POST['tanggal']) ? htmlentities($_POST['tanggal']) : $_POST['tanggal'];
        $absensi = htmlspecialchars($_POST['jam']) ? htmlentities($_POST['jam']) : $_POST['jam'];
        $jam = htmlspecialchars($_POST['jam2']) ? htmlentities($_POST['jam2']) : $_POST['jam2'];

        $table = "absensi";
        $base = $this->db->query("SELECT * FROM $table WHERE nip = '$nip' and tanggal = '$tanggal'");
        $match = mysqli_num_rows($base);
        
        if($match){
            echo "<script>alert('Anda sudah absensi di tanggal ($tanggal) segini');</script>";
            die;
        }else{
            $insert = "INSERT INTO $table SET nip = '$nip', nama = '$nama', tanggal = '$tanggal', jam = '$absensi', jam2 = '$jam'";
            $data = $this->db->query($insert);
            if($data != null){
                if($data){
                    echo "<script>alert('Anda sudah berhasil absensi di hari ini ...'); document.location.href = '../ui/header.php?page=beranda';</script>";
                    die;
                }
            }else{
                echo "<script>alert('Maaf anda belum absensi ... !');</script>";
                die;
            }
        }
    }

    public function update($username, $password, $nip, $nama, $tempat, $tanggal, $alamat, $email, $role){
        $username = htmlspecialchars($_POST['username']) ? htmlentities($_POST['username']) : strip_tags($_POST['username']);
        $password = md5($_POST['password'], false);
        $nip = htmlspecialchars($_POST['nip']) ? htmlentities($_POST['nip']) : strip_tags($_POST['nip']);
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : strip_tags($_POST['nama']);
        $tempat = htmlspecialchars($_POST['tempat_lahir']) ? htmlentities($_POST['tempat_lahir']) : strip_tags($_POST['tempat_lahir']);
        $tanggal = htmlspecialchars($_POST['tanggal_lahir']) ? htmlentities($_POST['tanggal_lahir']) : strip_tags($_POST['tanggal_lahir']);
        $alamat = htmlspecialchars($_POST['alamat']) ? htmlentities($_POST['alamat']) : strip_tags($_POST['alamat']);
        $email = htmlspecialchars($_POST['email']) ? htmlentities($_POST['email']) : strip_tags($_POST['email']);
        $role = htmlspecialchars($_POST['role']) ? htmlentities($_POST['role']) : strip_tags($_POST['role']);

        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif'); 
        $photo_src = htmlentities($_FILES["foto"]["name"]) ? htmlspecialchars($_FILES["foto"]["name"]) : $_FILES["foto"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['foto']['size'];
        $file_tmp_photo_src = $_FILES['foto']['tmp_name'];

        if(in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true){
            if($ukuran_photo_src < 10440070){
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/karyawan/" . $photo_src);
            }else{
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit;                
            }
        }else{
            echo "Tidak Dapat Ter - Upload Gambar";
            exit;
        }

        $table = "karyawan";
        $select = $this->db->query("SELECT * FROM $table WHERE username='$username'");
        $cekselect = mysqli_fetch_array($select);

        if($cekselect['username'] > 0){
            if(isset($_POST['ubahfoto'])){
                if($cekselect['foto'] == ""){
                    $update = "UPDATE $table SET password = '$password', nip = '$nip', nama = '$nama', tempat_lahir = '$tempat', tanggal_lahir = '$tanggal', alamat = '$alamat',
                    email = '$email', role = '$role', foto = '$photo_src' WHERE username = '$username'";
                    $data = $this->db->query($update);
                    if($data != null){
                        if($data){
                            echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                            die;
                        }
                    }else{
                        echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                        die;
                    }
                }elseif($cekselect['foto'] != ""){
                    if($photo_src != ""){
                        $updated = "UPDATE $table SET password = '$password', nip = '$nip', nama = '$nama', tempat_lahir = '$tempat', tanggal_lahir = '$tanggal', alamat = '$alamat',
                         email = '$email', role = '$role', foto = '$photo_src' WHERE username = '$username'";
                        $data = $this->db->query($updated);
                        unlink("../../../../assets/karyawan/$cekselect[foto]");
                        if($data != null){
                            if($data){
                                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                                die;
                            }
                        }else{
                            echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                            die;
                        }
                    }
                }
            }
        }
    }
}

?>