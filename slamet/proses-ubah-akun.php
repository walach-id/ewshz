<?php
//include('dbconnected.php');
include('koneksi.php');

$usernamelama = $_POST['usernamelama'];
$usernamebaru = $_POST['usernamebaru'];
$password = $_POST['pass'];
$wa = $_POST['wa'];

//query update
$query = mysqli_query($koneksi,"UPDATE admin SET email='$usernamebaru', no_hp = '$wa' WHERE pass='$password'");

if ($query) {
 # credirect ke page index
 header("location:login.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysql_error();
}

//mysql_close($host);
?>