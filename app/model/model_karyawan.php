<?php 
namespace model;

class people {
    protected $db;
    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function created($username, $password, $nip, $nama, $tempat, $tanggal, $alamat, $email, $role){
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
                move_uploaded_file($file_tmp_photo_src, "../../../../../assets/karyawan/" . $photo_src);
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
                    $update = "UPDATE $table SET nip = '$nip', nama = '$nama', tempat_lahir = '$tempat', tanggal_lahir = '$tanggal', alamat = '$alamat',
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
                        $updated = "UPDATE $table SET nip = '$nip', nama = '$nama', tempat_lahir = '$tempat', tanggal_lahir = '$tanggal', alamat = '$alamat',
                         email = '$email', role = '$role', foto = '$photo_src' WHERE username = '$username'";
                        $data = $this->db->query($updated);
                        unlink("../../../assets/karyawan/$cekselect[foto]");
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
        }else{
            $insert = "INSERT INTO $table SET username = '$username', password = '$password', nip = '$nip', nama = '$nama', tempat_lahir = '$tempat', tanggal_lahir = '$tanggal',
             alamat = '$alamat', email = '$email', role = '$role', foto = '$photo_src', status = '0'";
            $data = $this->db->query($insert);
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=karyawan&info=berhasil'</script>";
                    die;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=karyawan&info=gagal'</script>";
                die;
            }
        }
    }

    public function delete($id_akun){
        $id_akun = htmlspecialchars($_GET['id_karyawan']) ? htmlentities($_GET['id_karyawan']) : strip_tags($_GET['id_karyawan']);
        $table = "karyawan";
        $select = $this->db->query("SELECT * FROM $table WHERE id_karyawan = '$id_akun'");
        $array = mysqli_fetch_array($select);
        $foto = $array["foto"];

        if($array["foto"] == ""){
            $delete = "DELETE FROM $table WHERE id_karyawan = '$id_akun'";
            $data = $this->db->query($delete);
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/hedaer.php?page=karyawan'</script>";
                    die;
                }
            }else{
                echo "<script>document.location.href = '../ui/hedaer.php?page=karyawan&info=gagal'</script>";
                die;
            }
        }else{
            unlink("../../../../assets/karyawan/$foto");
            $data = $this->db->query("DELETE FROM $table WHERE id_karyawan = '$id_akun'");
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/hedaer.php?page=karyawan'</script>";
                    die;
                    }
            }else{
                echo "<script>document.location.href = '../ui/hedaer.php?page=karyawan&info=gagal'</script>";
                die;                
            }            
        }
    }

    public function signin($userInput, $password){
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
        $password = md5($_POST['password'], false);
        password_verify($password, PASSWORD_DEFAULT);
        
        if($userInput == "" || $password == ""){
            echo "<script>document.location.href = '../auth/index.php'</script>";
            die;
        }

        $table = "karyawan";
        $sql = "SELECT * FROM $table WHERE username = '$userInput' and password = '$password' and status = '1' || email = '$userInput' and password = '$password' and status = '1'";
        $data = $this->db->query($sql);
        $cek = mysqli_num_rows($data);

        if($cek > 0){
            $response = array($userInput, $password);
            $response["karyawan"] = $response;
            if($row = mysqli_fetch_assoc($data)){
                if($row['role'] == "karyawan"){
                    $_SESSION['id'] = $row['id_karyawan'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['nama'];
                    $_SESSION['nip'] = $row['nip'];
                    $_SESSION['tempat_lahir'] = $row['tempat_lahir'];
                    $_SESSION['tanggal_lahir'] = $row['tanggal_lahir'];
                    $_SESSION['alamat'] = $row['alamat'];
                    $_SESSION['foto'] = $row['foto'];
                    $_SESSION['role'] = "karyawan";
                    echo "<script>document.location.href = '../page/ui/header.php?page=beranda'</script>";
                }
                $_SESSION['status'] = true;
                $_COOKIE['cookies'] = $userInput;
                setcookie($response[$table], $row['username']['email'], time() + (86400 * 30), "/");
                $_SERVER['HTTPS'] == $_SERVER['HTTP'] = "on";
                array_push($response['users'], $row);
            }
        }else{
            $_SESSION['status'] = false;
            $_SERVER['HTTPS'] == $_SERVER['HTTP'] = "off";
            echo "<script>document.location.href = '../auth/index.php'</script>";
            die;
        }
    }

    public function statusCreate($status, $username){
        $status = htmlspecialchars($_POST['status']) ? htmlentities($_POST['status']) : strip_tags($_POST['status']);
        $username = htmlspecialchars($_POST['username']) ? htmlentities($_POST['username']) : strip_tags($_POST['username']);
        $table = "karyawan";
        $update = "UPDATE $table SET status = '$status' WHERE username='$username'";
        $data = $this->db->query($update);
        if($data != null){
            if($data){
                echo "<script>document.location.href = '../ui/header.php?page=karyawan'</script>";
                die;
            }
        }else{
            echo "<script>document.location.href = '../ui/header.php?page=karyawan'</script>";
            die;
        }
    }
}
?>