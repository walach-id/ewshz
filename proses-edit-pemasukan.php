<?php
session_start();
include('koneksi.php');
 define('LOG','log.txt');
function write_log($log){  
  date_default_timezone_set('Asia/Jakarta');
  $time = @date('[Y-d-m:H:i:s]');
 $op=$time.' '.$log."\n".PHP_EOL;
 $fp = @fopen(LOG, 'a');
 $write = @fwrite($fp, $op);
 @fclose($fp);
}

$id = (int) $_POST['id_pemasukan'];
date_default_timezone_set('Asia/Jakarta');
// $tgl = abs((int) $_POST['tgl_pemasukan']);
// $jam = abs((int) $_POST['jam_pemasukan']);
$tgl =  date('Y-m-d');
$jam =  date('H:i:s');
//$jumlah = abs((int) $_POST['jumlah']);
$jumlah = str_replace(",","",$_POST['jumlah']);
$perusahaan = $_SESSION['level'];
$status = "Menunggu";

//query update
//$query = mysqli_query($koneksi,"UPDATE pemasukan SET tgl_pemasukan='$tgl' , jam_pemasukan='$jam', jumlah='$jumlah', nama_perusahaan='$perusahaan' WHERE id_pemasukan='$id' ");

$query = mysqli_query($koneksi,"INSERT INTO `tahan_ubah_pemasukan` (`id_pemasukan`,`tgl_pemasukan`, `jam_pemasukan`, `jumlah`, `nama_perusahaan`, `status`) VALUES ('$id','$tgl', '$jam', '$jumlah', '$perusahaan', '$status')");



$namaadmin = $_SESSION['nama'];
if ($query) {
write_log("Nama Admin : ".$namaadmin." => Edit Pemasukan => ".$id." => Sukses Edit");
 # credirect ke page index
 header("location:pendapatan.php"); 
}
else{
write_log("Nama Admin : ".$namaadmin." => Edit Pemasukan => ".$id." => Gagal Edit");
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>