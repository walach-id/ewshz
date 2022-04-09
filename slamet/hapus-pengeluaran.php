<?php
//include('dbconnected.php');
include('koneksi.php');
include('cek-sesi.php');

$id = $_GET['id_pengeluaran'];
date_default_timezone_set('Asia/Jakarta');
$tgl =  date('Y-m-d');
$jam =  date('H:i:s');
$status = "Menunggu";
$jumlah = abs((int) $_GET['jumlah']);
$perusahaan = $_SESSION['level'];
$slamet = $_SESSION['nama_lengkap'];
//query update
//$query = mysqli_query($koneksi,"DELETE FROM `pengeluaran` WHERE id_pengeluaran = '$id'");
$query = mysqli_query($koneksi,"INSERT INTO `tahan_hapus_pengeluaran` (`id_pengeluaran`,`tgl_pengeluaran`, `jam_pengeluaran`, `jumlah`, `nama_perusahaan`, `status`, `flag1`) VALUES ('$id','$tgl', '$jam', '$jumlah', '$perusahaan', '$status', '$slamet')");

if ($query) {
 # credirect ke page index
 header("location:pengeluaran.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>