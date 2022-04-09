<?php
//include('dbconnected.php');
require 'cek-sesi.php';
include('koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$tgl_pemasukan = date('Y-m-d');
$jam_pemasukan = date('H:i:s');
$jumlah = $_GET['jumlah'];
$perusahaan = $_SESSION['level'];
$slamet = $_SESSION['nama_lengkap'];
$nickname = "Admin Slamet";

    $query_check = "SELECT tgl_pemasukan from pemasukan where tgl_pemasukan = '$tgl_pemasukan' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'";
$result = mysqli_query($koneksi, $query_check);
$jumlahdata = mysqli_num_rows($result);

if($jumlahdata >= 1) {
	header("location:pendapatan.php?pesan='MAAF TIDAK DAPAT MENGINPUT 2X'");
}
else {

	$query = mysqli_query($koneksi,"INSERT INTO `pemasukan` (`tgl_pemasukan`, `jam_pemasukan`, `jumlah`, `nama_perusahaan`, `flag1`) VALUES ('$tgl_pemasukan', '$jam_pemasukan', '$jumlah', '$perusahaan', '$nickname')");

	if ($query) {
 		header("location:pendapatan.php"); 
	}
	else{
 		echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
	}
}
?>