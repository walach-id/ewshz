<?php
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'koneksi.php';
 
// menangkap data yang dikirim dari form
$email =mysqli_real_escape_string($koneksi,$_POST['email']);
$pass =mysqli_real_escape_string($koneksi, $_POST['pass']);
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from admin where email='$email' and pass='$pass'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d');
$jam = date('h:i:s');

if($cek > 0){
$sesi = mysqli_query($koneksi,"select * from admin where email='$email' and pass='$pass'");
$sesi = mysqli_fetch_assoc($sesi);
	$_SESSION['id'] = $sesi['id_admin'];
	$_SESSION['nama'] = $sesi['nama'];
	$_SESSION['status'] = "login";
	$_SESSION['level'] = $sesi['level'];
	$_SESSION['nama_lengkap'] = $sesi['nama_lengkap'];
	$_SESSION['nowa'] = $sesi['no_hp'];
	
$nama = $sesi['nama'];
$level = $sesi['level'];

	
$kelog = mysqli_query($koneksi,"INSERT INTO log_login (`nama`, `level`, `tanggal`, `jam`) VALUES ('$nama', '$level', '$tgl', '$jam')");

	if ($_SESSION['level']=="admin"){
		header("location:index.php");
	}else{
		header("location:index.php");
	}
}else{
    echo $mysqli -> connect_error;
	//header("location:login.php?pesan=gagal");
}
?>