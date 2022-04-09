    <?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data_Total_Pemasukan_Pengeluaran_Seluruh_Perusahaan.xls");
	?>
	<h3>Rekapitulasi Laporan</h3>    
	<table border="1" cellpadding="5"> 
	<tr>    
	<th>No.</th>
    <th>Perusahaan</th>
    <th>Total Pemasukan</th>
    <th>Total Pengeluaran</th>
	<th>Saldo Akhir</th>
	</tr>  
	<?php  
	// Load file koneksi.php  
	include "koneksi.php";    
	// Buat query untuk menampilkan semua data siswa 
$query = mysqli_query($koneksi, "SELECT pemasukan.nama_perusahaan, SUM(pemasukan.jumlah) as total_pemasukan, SUM(pengeluaran.jumlah) as total_pengeluaran, SUM(pemasukan.jumlah)-SUM(pengeluaran.jumlah) as saldo_akhir FROM pemasukan JOIN pengeluaran ON pemasukan.nama_perusahaan = pengeluaran.nama_perusahaan GROUP BY nama_perusahaan");
	// Untuk penomoran tabel, di awal set dengan 1 
	$nomer = 1;
	while($data = mysqli_fetch_array($query)){ 
	// Ambil semua data dari hasil eksekusi $sql 
	echo "<tr>";
	echo "<td>".$nomer++."</td>";   
	echo "<td>".$data['nama_perusahaan']."</td>";   
	echo "<td>".$data['total_pemasukan']."</td>";    
	echo "<td>".$data['total_pengeluaran']."</td>";    
	echo "<td>".$data['saldo_akhir']."</td>";      
	$saldoakhir += $data['saldo_akhir'];
	echo "</tr>";

	}  
		echo "Total Saldo Keseluruhan : ".$saldoakhir;
		?></table>
	<br>
	<br>
