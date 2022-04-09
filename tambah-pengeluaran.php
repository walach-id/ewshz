<?php 
//include('dbconnected.php');
require 'cek-sesi.php';
include('koneksi.php');

date_default_timezone_set('Asia/Jakarta');
$tgl_pengeluaran = date('Y-m-d');
$jam_pengeluaran = date('H:i:s');
$jumlah = str_replace(",","",$_GET['jumlah']);
$perusahaan = $_SESSION['level'];
$kantor = $_SESSION['nama_lengkap'];

$query_check = "SELECT tgl_pengeluaran from pengeluaran where tgl_pengeluaran = '$tgl_pengeluaran' and nama_perusahaan = '$perusahaan' and NOT flag1 = 'Admin Slamet'";
$result = mysqli_query($koneksi, $query_check);
$jumlahdata = mysqli_num_rows($result);


if($jumlahdata >= 1) {
	header("location:pengeluaran.php?pesan='MAAF TIDAK DAPAT MENGINPUT 2X'");
}
else {

	$query = mysqli_query($koneksi,"INSERT INTO `pengeluaran` (`tgl_pengeluaran`, `jam_pengeluaran`, `jumlah`, `nama_perusahaan`) VALUES ('$tgl_pengeluaran', '$jam_pengeluaran', '$jumlah', '$perusahaan')");
    
	if ($query) {
		$title = "Notifikasi EWS HZ - Pengeluaran";
	$message = "Pengeluaran Berhasil di tambah hari ini";
	$icon = "https://yourwebsite.com/icon.png";
	$url = "#";
	
	$apiKey = "3bcac3786531e574a284f49c78807bbc";

	$curlUrl = "https://api.pushalert.co/rest/v1/send";

	//POST variables
	$post_vars = array(
		"icon" => $icon,
		"title" => $title,
		"message" => $message,
		"url" => $url
	);

	$headers = Array();
	$headers[] = "Authorization: api_key=".$apiKey;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $curlUrl);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_vars));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);

	$output = json_decode($result, true);
	if($output["success"]) {
		echo $output["id"]; //Sent Notification ID
	}
	else {
		//Others like bad request
	}
		header("location:pengeluaran.php"); 
	    
	    
	}
	else{
	    echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
	}
}
?>