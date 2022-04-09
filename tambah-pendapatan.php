<?php
//include('dbconnected.php');
require 'cek-sesi.php';
include('koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$tgl_pemasukan = date('Y-m-d');
$jam_pemasukan = date('H:i:s');
$jumlah = str_replace(",","",$_GET['jumlah']);
$perusahaan = $_SESSION['level'];
$kantor = $_SESSION['nama_lengkap'];
$query_check = "SELECT tgl_pemasukan from pemasukan where tgl_pemasukan = '$tgl_pemasukan' and nama_perusahaan = '$perusahaan' and NOT flag1 = 'Admin Slamet'";
$result = mysqli_query($koneksi, $query_check);
$jumlahdata = mysqli_num_rows($result);

if($jumlahdata >= 1) {
	header("location:pendapatan.php?pesan='MAAF TIDAK DAPAT MENGINPUT 2X'");
}
else {

	$query = mysqli_query($koneksi,"INSERT INTO `pemasukan` (`tgl_pemasukan`, `jam_pemasukan`, `jumlah`, `nama_perusahaan`) VALUES ('$tgl_pemasukan', '$jam_pemasukan', '$jumlah', '$perusahaan')");
    $title = "Notifikasi EWS HZ - Pemasukan";
	$message = "Pemasukan Berhasil di tambah hari ini";
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
	if ($query) {
 		header("location:pendapatan.php"); 
	}
	else{
 		echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
	}
}
?>