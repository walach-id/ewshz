<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_pengeluaran'];
$jumlah = $_GET['jumlah'];
$tgl = $_GET['tgl'];
$jam = $_GET['jam'];
$comp = $_GET['comp'];
$status = $_GET['status'];
//query update

if($status == "Diterima") {
  $query = mysqli_query($koneksi,"DELETE FROM pengeluaran WHERE id_pengeluaran='$id' ");
  if ($query) {
    $query2 = mysqli_query($koneksi,"DELETE from tahan_hapus_pengeluaran WHERE id_pengeluaran='$id' ");
    header("location:request delete data.php");
  }
  else{
    echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
  }
}

else {
  $query3 = mysqli_query($koneksi,"DELETE from tahan_hapus_pengeluaran WHERE id_pengeluaran='$id' ");
  if ($query3) {
    header("location:request delete data.php");
  }
  else{
    echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
  }
}

//mysql_close($host);
?>