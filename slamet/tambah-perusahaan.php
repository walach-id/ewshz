<?php
//include('dbconnected.php');
require 'cek-sesi.php';
include('koneksi.php');

$namauser = $_POST['nama_user'];
$email  = $_POST['email'];
$pass  = $_POST['password'];
$nama_lengkap  = $_POST['nama_perusahaan'];
$level  = $_POST['level'];
$nowa  = $_POST['no_wa'];


$query = mysqli_query($koneksi,"INSERT INTO `admin` (`nama`, `email`, `pass`, `level`, `nama_lengkap`,`no_hp`) VALUES ('$namauser', '$email', '$pass', '$level', '$nama_lengkap', '$nowa')");

	if ($query) {
 		header("location:kelola perusahaan.php"); 
	}
	else{
 		echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
	}
?>