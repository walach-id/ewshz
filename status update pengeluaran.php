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
  $query = mysqli_query($koneksi,"UPDATE pengeluaran SET jumlah='$jumlah' , tgl_pengeluaran='$tgl', jam_pengeluaran='$jam', jumlah='$jumlah', nama_perusahaan='$comp' WHERE id_pengeluaran='$id' ");
  if ($query) {
    $query2 = mysqli_query($koneksi,"DELETE from tahan_ubah_pengeluaran WHERE id_pengeluaran='$id' ");
    header("location:request update data.php");
  }
  else{
    echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
  }
}

else {
  $query3 = mysqli_query($koneksi,"DELETE from tahan_ubah_pengeluaran WHERE id_pengeluaran='$id' ");
  if ($query3) {
    header("location:request update data.php");
  }
  else{
    echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
  }
}

//mysql_close($host);
?>