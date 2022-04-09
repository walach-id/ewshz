<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_pemasukan'];
$jumlah = $_GET['jumlah'];
$tgl = $_GET['tgl'];
$jam = $_GET['jam'];
$comp = $_GET['comp'];
$status = $_GET['status'];
//query update

if($status == "Diterima") {
  $query = mysqli_query($koneksi,"UPDATE pemasukan SET jumlah='$jumlah' , tgl_pemasukan='$tgl', jam_pemasukan='$jam', jumlah='$jumlah', nama_perusahaan='$comp' WHERE id_pemasukan='$id' ");
  if ($query) {
    $query2 = mysqli_query($koneksi,"DELETE from tahan_ubah_pemasukan WHERE id_pemasukan='$id' ");
    header("location:request update data.php");
  }
  else{
    echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
  }
}

else {
  $query3 = mysqli_query($koneksi,"DELETE from tahan_ubah_pemasukan WHERE id_pemasukan='$id' ");
  if ($query3) {
    header("location:request update data.php");
  }
  else{
    echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
  }
}

//mysql_close($host);
?>