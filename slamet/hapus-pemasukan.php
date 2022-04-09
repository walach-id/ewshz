<?php
//include('dbconnected.php');

include('koneksi.php');
include('cek-sesi.php');


$id = $_GET['id_pemasukan'];
date_default_timezone_set('Asia/Jakarta');
$tgl =  date('Y-m-d');
$jam =  date('H:i:s');
$status = "Menunggu";
$jumlah = abs((int) $_GET['jumlah']);
$perusahaan = $_SESSION['level'];
$slamet = $_SESSION['nama_lengkap'];

//$query = mysqli_query($koneksi,"DELETE FROM `pemasukan` WHERE id_pemasukan = '$id'");
$query = mysqli_query($koneksi,"INSERT INTO `tahan_hapus_pemasukan` (`id_pemasukan`,`tgl_pemasukan`, `jam_pemasukan`, `jumlah`, `nama_perusahaan`, `status`, `flag1`) VALUES ('$id','$tgl', '$jam', '$jumlah', '$perusahaan', '$status', '$slamet')");

if ($query) {
 # credirect ke page index
 header("location:pendapatan.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}
//mysql_close($host);
?>