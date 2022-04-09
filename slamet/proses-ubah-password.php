<?php
//include('dbconnected.php');
include('koneksi.php');

$usernamelama = $_POST['usernamelama'];
$password = $_POST['pass'];


//query update
$query = mysqli_query($koneksi,"UPDATE admin SET pass='$password' WHERE email='$usernamelama'");

if ($query) {
 # credirect ke page index
 header("location:login.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysql_error();
}

//mysql_close($host);
?>