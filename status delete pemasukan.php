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
  $query = mysqli_query($koneksi,"DELETE FROM pemasukan WHERE id_pemasukan='$id' ");
  if ($query) {
    $query2 = mysqli_query($koneksi,"DELETE from tahan_hapus_pemasukan WHERE id_pemasukan='$id' ");
    header("location:request delete data.php");
  }
  else{
    echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
  }
}

else {
  $query3 = mysqli_query($koneksi,"DELETE from tahan_hapus_pemasukan WHERE id_pemasukan='$id' ");
  if ($query3) {
    header("location:request delete data.php");
  }
  else{
    echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
  }
}

//mysql_close($host);
?>