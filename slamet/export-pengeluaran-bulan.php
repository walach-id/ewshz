    <?php
require 'cek-sesi.php';
$level=$_SESSION['level'];
$date=date('Y-m-d');
$bulan = $_GET['bulan'];
//$bulan = substr($date, 5, 2);
$tahun = substr($date, 0, 4);
if ($bulan=='01') {
  $bulannow='Januari';
}elseif ($bulan=='02') {
  $bulannow='Februari';
}elseif ($bulan=='03') {
  $bulannow='Maret';
}elseif ($bulan=='04') {
  $bulannow='April';
}elseif ($bulan=='05') {
  $bulannow='Mei';
}elseif ($bulan=='06') {
  $bulannow='Juni';
}elseif ($bulan=='07') {
  $bulannow='Juli';
}elseif ($bulan=='08') {
  $bulannow='Agustus';
}elseif ($bulan=='09') {
  $bulannow='September';
}elseif ($bulan=='10') {
  $bulannow='Oktober';
}elseif ($bulan=='11') {
  $bulannow='November';
}elseif ($bulan=='12') {
  $bulannow='Desember';
}
header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data_Pengeluaran_$bulannow.xls");
	?>
	<h3>Data Pengeluaran Bulan <?php echo $bulannow ." ". $tahun ?></h3>    
	<table border="1" cellpadding="5"> 
	<tr>    
	<th>No</th>
    <th>Tanggal</th>
    <th>Jam</th>
    <th>Jumlah</th>
	</tr> 
	<?php  
	// Load file koneksi.php  
	require 'koneksi.php';  
	// Buat query untuk menampilkan semua data siswa 
$query = mysqli_query($koneksi,"SELECT * FROM pengeluaran WHERE month(tgl_pengeluaran) = '$bulan' and nama_perusahaan = '$level' order by tgl_pengeluaran DESC");
	$nomer = 1;
	// Untuk penomoran tabel, di awal set dengan 1 
	while($data = mysqli_fetch_array($query)){ 
	// Ambil semua data dari hasil eksekusi $sql 
	echo "<tr>";    
	echo "<td>".$nomer++."</td>";   
	echo "<td>".$data['tgl_pengeluaran']."</td>";
	echo "<td>".$data['jam_pengeluaran']."</td>"; 
	echo "<td>".$data['jumlah']."</td>";         
	echo "</tr>";        
	}  ?></table>