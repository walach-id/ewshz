    <?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data_Pengeluaran_All.xls");
	?>
	<h3>Data Pengeluaran Total</h3>    
	<table border="1" cellpadding="5"> 
	<tr>    
	<th>ID Pengeluaran</th>
    <th>Tgl Pengeluaran</th>
    <th>Jumlah</th>    
	<th> ID Sumber</th> 
	</tr>  
	<?php  
	// Load file koneksi.php  
	include "koneksi.php";    
	// Buat query untuk menampilkan semua data siswa 
$query = mysqli_query($koneksi, "SELECT * FROM pengeluaran as a INNER JOIN sumber as b ON a.id_sumber = b.id_sumber");
	// Untuk penomoran tabel, di awal set dengan 1 
	while($data = mysqli_fetch_array($query)){ 
	// Ambil semua data dari hasil eksekusi $sql 
	echo "<tr>";    
	echo "<td>".$data['id_pengeluaran']."</td>";   
	echo "<td>".$data['tgl_pengeluaran']."</td>";    
	echo "<td>".$data['jumlah']."</td>";    
	echo "<td>".$data['nama']."</td>";      
	echo "</tr>";        
	}  ?></table>