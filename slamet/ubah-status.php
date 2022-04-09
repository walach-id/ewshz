<?php
//include('dbconnected.php');
include('koneksi.php');


$pesan_status = $_POST['statuspesan'];
$idpesan = $_GET['id'];

echo $pesan_status;
echo $idpesan;

$query = mysqli_query($koneksi,"UPDATE alert_message SET status='$pesan_status' WHERE id='$idpesan'");

if ($query) {

 header("location:message.php"); 
}
else{
 echo "ERROR, Status pesan gagal di ubah". mysqli_error($Koneksi);
}


?>