<?php 
// error_reporting(0);
date_default_timezone_set("Asia/Jakarta");

$konfigs = mysqli_connect("localhost", "root", "", "absensi_karyawan");

try {
    $configs = new PDO("mysql:host=localhost;dbname=absensi_karyawan;", "root", "");
} catch (Exception $e){
    die("Database Gagal : ".$e->getMessage());
}

?>