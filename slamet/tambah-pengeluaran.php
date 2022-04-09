<?php 
//include('dbconnected.php');
require 'cek-sesi.php';
include('koneksi.php');

date_default_timezone_set('Asia/Jakarta');
$tgl_pengeluaran = date('Y-m-d');
$jam_pengeluaran = date('H:i:s');
$jumlah = $_GET['jumlah'];
$perusahaan = $_SESSION['level'];
$slamet = $_SESSION['nama_lengkap'];
$nickname = "Admin Slamet";
$query_check = "SELECT tgl_pengeluaran from pengeluaran where tgl_pengeluaran = '$tgl_pengeluaran' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'";
$result = mysqli_query($koneksi, $query_check);
$jumlahdata = mysqli_num_rows($result);


if($jumlahdata >= 1) {
	header("location:pengeluaran.php?pesan='MAAF TIDAK DAPAT MENGINPUT 2X'");
}
else {

	$query = mysqli_query($koneksi,"INSERT INTO `pengeluaran` (`tgl_pengeluaran`, `jam_pengeluaran`, `jumlah`, `nama_perusahaan`, `flag1`) VALUES ('$tgl_pengeluaran', '$jam_pengeluaran', '$jumlah', '$perusahaan', '$nickname')");

	if ($query) {
		header("location:pengeluaran.php"); 
	}
	else{
	    echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
	}
}
?>