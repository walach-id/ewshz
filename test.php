      <?php
          include 'cek-sesi.php';
        	
        	for($i = 1; $i <= 12; $i++) {

	        $pemasukan1=mysqli_query($koneksi,"SELECT SUM(jumlah) as hasil FROM pemasukan where month(tgl_pemasukan) = '$i' and nama_perusahaan = 'rsdh' ");
	        
	        while ($masuk1=mysqli_fetch_array($pemasukan1)){
	            echo $masuk1['hasil'];
	        }
		}
            

        ?>