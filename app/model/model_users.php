<?php 
namespace model;

class user_personalia {
    protected $db;
    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function create($username, $email, $password, $nama, $role){
        $username = htmlspecialchars($_POST['username']) ? htmlentities($_POST['username']) : strip_tags($_POST['username']);
        $email = htmlspecialchars($_POST['email']) ? htmlentities($_POST['email']) : strip_tags($_POST['email']);
        $password = md5($_POST['password'], false);
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : strip_tags($_POST['nama']);
        $role = htmlspecialchars($_POST['role']) ? htmlentities($_POST['role']) : strip_tags($_POST['role']);
        
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif'); 
        $photo_src = htmlentities($_FILES["foto"]["name"]) ? htmlspecialchars($_FILES["foto"]["name"]) : $_FILES["foto"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['foto']['size'];
        $file_tmp_photo_src = $_FILES['foto']['tmp_name'];

        if(in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true){
            if($ukuran_photo_src < 10440070){
                move_uploaded_file($file_tmp_photo_src, "../../../../../assets/admin/" . $photo_src);
            }else{
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit;                
            }
        }else{
            echo "Tidak Dapat Ter - Upload Gambar";
            exit;
        }

        $table = "users";
        $select = $this->db->query("SELECT * FROM $table WHERE username='$username'");
        $cekselect = mysqli_fetch_array($select);

        if($cekselect['username'] > 0){
            if(isset($_POST['ubahfoto'])){
                if($cekselect['foto'] == ""){
                    $update = "UPDATE $table SET email = '$email', password = '$password', nama = '$nama', foto = '$photo_src', role = '$role' WHERE username = '$username'";
                    $data = $this->db->query($update);
                    if($data != null){
                        if($data){
                            echo "<script>document.location.href = '../ui/header.php?page=admin'</script>";
                            die;
                        }
                    }else{
                        echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                        die;                
                    }
                }elseif($cekselect['foto'] != ""){
                    if($photo_src != ""){
                        $update = "UPDATE $table SET email = '$email', password = '$password', nama = '$nama', foto = '$photo_src', role = '$role' WHERE username = '$username'";
                        $data = $this->db->query($update);
                        if($data != null){
                            if($data){
                                echo "<script>document.location.href = '../ui/header.php?page=admin'</script>";
                                unlink("../../../../assets/admin/$cekselect[foto]");
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
            $insert = "INSERT INTO $table SET username = '$username', email = '$email', password = '$password', nama = '$nama', foto = '$photo_src', role = '$role'";
            $data = $this->db->query($insert);
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=admin'</script>";
                    die;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                die;                
            }
        }
    }

    public function delete($id_akun){
        $id_akun = htmlspecialchars($_GET['id_akun']) ? htmlentities($_GET['id_akun']) : strip_tags($_GET['id_akun']);
        $table = "users";
        $select = $this->db->query("SELECT * FROM $table WHERE id_akun = '$id_akun'");
        $array = mysqli_fetch_array($select);
        $foto = $array["foto"];

        if($array["foto"] == ""){
            $delete = "DELETE FROM $table WHERE id_akun = '$id_akun'";
            $data = $this->db->query($delete);
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=admin'</script>";
                    die;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=admin'</script>";
                die;
            }
        }else{
            unlink("../../../../assets/admin/$foto");
            $data = $this->db->query("DELETE FROM $table WHERE id_akun = '$id_akun'");
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=admin'</script>";
                    die;
                    }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=admin'</script>";
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

        $table = "users";
        $sql = "SELECT * FROM $table WHERE username = '$userInput' and password = '$password' || email = '$userInput' and password = '$password'";
        $data = $this->db->query($sql);
        $cek = mysqli_num_rows($data);

        if($cek > 0){
            $response = array($userInput, $password);
            $response["users"] = $response;
            if($row = mysqli_fetch_assoc($data)){
                if($row['role'] == "admin"){
                    $_SESSION['id'] = $row['id_akun'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['nama'];
                    $_SESSION['foto'] = $row['foto'];
                    $_SESSION['role'] = "admin";
                    echo "<script>document.location.href = '../page/ui/header.php?page=beranda&info=success'</script>";
                }
                $_SESSION['status'] = true;
                $_COOKIE['cookies'] = $userInput;
                setcookie($response[$table], $row['username'], time() + (86400 * 30), "/");
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
}

?>