<?php 
namespace controller;
use model\user_personalia;
use model\people;
use model\absensi;
use model\keterangan;

class AuthPersonalia {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new user_personalia($konfig);
    }

    public function buatedit(){
        $username = htmlspecialchars($_POST['username']) ? htmlentities($_POST['username']) : strip_tags($_POST['username']);
        $email = htmlspecialchars($_POST['email']) ? htmlentities($_POST['email']) : strip_tags($_POST['email']);
        $password = md5(htmlspecialchars($_POST['password']), false) ? md5(htmlentities($_POST['password']), false) : md5($_POST['password'], false);
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : strip_tags($_POST['nama']);
        $role = htmlspecialchars($_POST['role']) ? htmlentities($_POST['role']) : strip_tags($_POST['role']);
        $data = $this->konfig->create($username, $email, $password, $nama, $role);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id_akun = htmlspecialchars($_GET['id_akun']) ? htmlentities($_GET['id_akun']) : strip_tags($_GET['id_akun']);
        $data = $this->konfig->delete($id_akun);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function login(){
        session_start();
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
        $password = md5($_POST['password'], false);
        $data = $this->konfig->signin($userInput, $password);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class karyawan {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new people($konfig);
    }

    public function login(){
        session_start();
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
        $password = md5($_POST['password'], false);
        $data = $this->konfig->signin($userInput, $password);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id_akun = htmlspecialchars($_GET['id_karyawan']) ? htmlentities($_GET['id_karyawan']) : strip_tags($_GET['id_karyawan']);
        $data = $this->konfig->delete($id_akun);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function buat(){
        $username = htmlspecialchars($_POST['username']) ? htmlentities($_POST['username']) : strip_tags($_POST['username']);
        $password = md5(htmlspecialchars($_POST['password']), false) ? md5(htmlentities($_POST['password']), false) : md5($_POST['password'], false);
        $nip = htmlspecialchars($_POST['nip']) ? htmlentities($_POST['nip']) : strip_tags($_POST['nip']);
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : strip_tags($_POST['nama']);
        $tempat = htmlspecialchars($_POST['tempat_lahir']) ? htmlentities($_POST['tempat_lahir']) : strip_tags($_POST['tempat_lahir']);
        $tanggal = htmlspecialchars($_POST['tanggal_lahir']) ? htmlentities($_POST['tanggal_lahir']) : strip_tags($_POST['tanggal_lahir']);
        $alamat = htmlspecialchars($_POST['alamat']) ? htmlentities($_POST['alamat']) : strip_tags($_POST['alamat']);
        $email = htmlspecialchars($_POST['email']) ? htmlentities($_POST['email']) : strip_tags($_POST['email']);
        $role = htmlspecialchars($_POST['role']) ? htmlentities($_POST['role']) : strip_tags($_POST['role']);
        $data = $this->konfig->created($username, $password, $nip, $nama, $tempat, $tanggal, $alamat, $email, $role);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function pilih(){
        $status = htmlspecialchars($_POST['status']) ? htmlentities($_POST['status']) : strip_tags($_POST['status']);
        $username = htmlspecialchars($_POST['username']) ? htmlentities($_POST['username']) : strip_tags($_POST['username']);
        $data = $this->konfig->statusCreate($status,$username);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class attedance {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new absensi($konfig);
    }

    public function attdance(){
        $nip = htmlentities($_POST['nip']) ? htmlspecialchars($_POST['nip']) : $_POST['nip'];
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : $_POST['nama'];
        $tanggal = htmlspecialchars($_POST['tanggal']) ? htmlentities($_POST['tanggal']) : $_POST['tanggal'];
        $absensi = htmlspecialchars($_POST['jam']) ? htmlentities($_POST['jam']) : $_POST['jam'];
        $jam = htmlspecialchars($_POST['jam2']) ? htmlentities($_POST['jam2']) : $_POST['jam2'];
        $data = $this->konfig->simpan_absensi($nip, $nama, $tanggal, $absensi, $jam);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $username = htmlspecialchars($_POST['username']) ? htmlentities($_POST['username']) : strip_tags($_POST['username']);
        $password = md5(htmlspecialchars($_POST['password']), false) ? md5(htmlentities($_POST['password']), false) : md5($_POST['password'], false);
        $nip = htmlspecialchars($_POST['nip']) ? htmlentities($_POST['nip']) : strip_tags($_POST['nip']);
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : strip_tags($_POST['nama']);
        $tempat = htmlspecialchars($_POST['tempat_lahir']) ? htmlentities($_POST['tempat_lahir']) : strip_tags($_POST['tempat_lahir']);
        $tanggal = htmlspecialchars($_POST['tanggal_lahir']) ? htmlentities($_POST['tanggal_lahir']) : strip_tags($_POST['tanggal_lahir']);
        $alamat = htmlspecialchars($_POST['alamat']) ? htmlentities($_POST['alamat']) : strip_tags($_POST['alamat']);
        $email = htmlspecialchars($_POST['email']) ? htmlentities($_POST['email']) : strip_tags($_POST['email']);
        $role = htmlspecialchars($_POST['role']) ? htmlentities($_POST['role']) : strip_tags($_POST['role']);
        $data = $this->konfig->update($username, $password, $nip, $nama, $tempat, $tanggal, $alamat, $email, $role);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class document {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new keterangan($konfig);
    }

    public function buat_keterangan(){
        $nip = htmlspecialchars($_POST['nip']) ? htmlentities($_POST['nip']) : strip_tags($_POST['nip']);
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : strip_tags($_POST['nama']);
        $keterangan = htmlspecialchars($_POST['keterangan']) ? htmlentities($_POST['keterangan']) : strip_tags($_POST['keterangan']);
        $alasan = htmlspecialchars($_POST['alasan']) ? htmlentities($_POST['alasan']) : strip_tags($_POST['alasan']);
        $tanggal = htmlspecialchars($_POST['tanggal']) ? htmlentities($_POST['tanggal']) : strip_tags($_POST['tanggal']);
        $jam = htmlspecialchars($_POST['jam']) ? htmlentities($_POST['jam']) : strip_tags($_POST['jam']);
        $data = $this->konfig->simpan_keterangan($nip, $nama, $keterangan, $alasan, $tanggal, $jam);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

?>