<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_admin'];
$query2 = mysqli_query($koneksi,"DELETE from admin WHERE id_admin='$id' ");

if($query2) {
  header("location:kelola perusahaan.php");
}
else {

}


?>