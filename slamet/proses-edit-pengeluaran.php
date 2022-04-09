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
$id = (int) $_POST['id_pengeluaran'];
// $tgl = abs((int) $_POST['tgl_pengeluaran']);
// $jam = abs((int) $_POST['jam_pengeluaran']);
$tgl =  date('Y-m-d');
$jam =  date('H:i:s');
$jumlah = abs((int) $_POST['jumlah']);	
$perusahaan = $_SESSION['level'];
$status = "Menunggu";
$slamet = $_SESSION['nama_lengkap'];
//query update
$query = mysqli_query($koneksi,"INSERT INTO `tahan_ubah_pengeluaran` (`id_pengeluaran`,`tgl_pengeluaran`, `jam_pengeluaran`, `jumlah`, `nama_perusahaan`, `status`, `flag1`) VALUES ('$id','$tgl', '$jam', '$jumlah', '$perusahaan', '$status', '$slamet')");
$namaadmin = $_SESSION['nama'];
if ($query) {
 # credirect ke page index
write_log("Nama Admin : ".$namaadmin." => Edit Pengeluaran => ".$id." => ".$jumlah." => ".$sumber." => Sukses Edit");
 header("location:pengeluaran.php"); 
}
else{
write_log("Nama Admin : ".$namaadmin." => Edit Pengeluaran => ".$id." => ".$jumlah." => ".$sumber." =>  Gagal Edit");
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>