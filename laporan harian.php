<?php
require 'cek-sesi.php';
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
$date=date('Y-m-d');
$bulan = substr($date, 5, 2);
$tahun = substr($date, 0, 4);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link href="img/icon.png" rel="icon">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Laporan Keuangan Harian</title>

  <!-- Custom fonts for this template -->
 <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

<?php 
require 'koneksi.php';
require 'sidebar.php'; 
$perusahaan = $_SESSION['level'];
?>

      <!-- Main Content -->
      <div id="content">

<?php 

require 'navbar.php'; 
?>

        <?php if($perusahaan != "admin") { ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
   
                   <!-- DataTales Bulan ini -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Laporan Keuangan Harian <?php echo date('d F Y');?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Jumlah Transaksi </th>
                      <th>Jumlah Total Uang</th>
				      
                    </tr>
                  </thead>
                  <tbody>
<?php
$perusahaan = $_SESSION['level'];
$tgl = date('Y-m-d');

// SELECT * FROM pemasukan where month(tgl_pemasukan)= '12'

//$pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where month(tgl_pemasukan) like '%$tahun%' AND tgl_pemasukan like '%$bulanangka%' and nama_perusahaan = '$perusahaan' ");

//
$pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = '$tgl' and nama_perusahaan = '$perusahaan' and NOT flag1 = 'Admin Slamet'");

while ($masuk1=mysqli_fetch_array($pemasukan1)){
$arraymasuk1[] = $masuk1['jumlah'];
}
$jumlahmasuk1 = array_sum($arraymasuk1);


$pengeluaran1=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran = '$tgl' and nama_perusahaan = '$perusahaan' and NOT flag1 = 'Admin Slamet'");

while ($keluar1=mysqli_fetch_array($pengeluaran1)){
$arraykeluar1[] = $keluar1['jumlah'];
}
$jumlahkeluar1 = array_sum($arraykeluar1);


$query2 = mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = '$tgl' and nama_perusahaan = '$perusahaan' and NOT flag1 = 'Admin Slamet'");
$query2 = mysqli_num_rows($query2);

$query3 = mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran = '$tgl' and nama_perusahaan = '$perusahaan' and NOT flag1 = 'Admin Slamet'");

$query3 = mysqli_num_rows($query3);
$no1 = 1;
?>
                    <tr>
                      <td>Pemasukan</td>
                      <td><?=$query2?></td>
                      <td>Rp <?=number_format($jumlahmasuk1,0,',','.');?></td>
					 
</tr>

                    <tr>
                      <td>Pengeluaran</td>
                      <td><?=$query3?></td>
                      <td>Rp <?=number_format($jumlahkeluar1,0,',','.');?></td>
					
</tr>
                  </tbody> 
                </table>
                <br/>
              <?php
             
               
               if($jumlahmasuk1 > $jumlahkeluar1) {
               $sisa  = $jumlahmasuk1 - $jumlahkeluar1;
               $persen = ($sisa / $jumlahkeluar1);
               $x = round($persen,2) * 100;
               $judul = "Keuntungan";
               }
               elseif ($jumlahkeluar1 > $jumlahmasuk1) {
               $sisa  = $jumlahmasuk1 - $jumlahkeluar1;
               $persen = ($sisa / $jumlahkeluar1);
               $x = round($persen,2) * 100;
               $judul = "Pengeluaran";
               }


              ?>
              <p style="color: black;"><b>KETERANGAN </b></p>
              </div>
              <p style="color: #2C4D01;"><b>Saldo Tanggal <?php echo date('d F Y');?> (Pemasukan - Pengeluaran): <?php echo "Rp ".number_format($sisa,0,',','.'); ?></b></p>
             
              <?php
                $perusahaan = $_SESSION['level'];
              
                $total_pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where nama_perusahaan = '$perusahaan'");
                while ($total_masuk1=mysqli_fetch_array($total_pemasukan1)){
                $total_arraymasuk1[] = $total_masuk1['jumlah'];
                }
                $total_jumlahmasuk1 = array_sum($total_arraymasuk1);

                $total_pengeluaran1=mysqli_query($koneksi,"SELECT * FROM pengeluaran where nama_perusahaan = '$perusahaan' and NOT flag1 = 'Admin Slamet'");
                while ($total_keluar1=mysqli_fetch_array($total_pengeluaran1)){
                $total_arraykeluar1[] = $total_keluar1['jumlah'];
                }
                $total_jumlahkeluar1 = array_sum($total_arraykeluar1);

                $sisa  = $total_jumlahmasuk1 - $total_jumlahkeluar1;
              ?>
               <p style="color: red;"><b> Saldo s.d Tanggal  <?php echo date('d F Y');?> : <?php echo "Rp ".number_format($sisa,0,',','.'); ?></b></p>
              
            </div>
          </div>

        </div>
      </div>
      <?php } else { ?>

             <div class="container-fluid">
        <form action="#" method="POST">  
        <select style="width: 220px;" class="form-control" id="gender1" name="kantor">
          <option value="" selected disabled>PILIH PERUSAHAAN</option>
         <?php
            $queryy = "select * from admin where level NOT IN('admin') and NOT (nama) = 'PT Harira Energi' and NOT (nama_lengkap) = 'admin slamet'";
            $hasil = mysqli_query($koneksi,$queryy);
            while ($qtabel = mysqli_fetch_assoc($hasil))
            {
              echo '<option value="'.$qtabel['level'].'">'.$qtabel['nama_lengkap'].'</option>';
            
            }
         ?>
           
        </select>
           <input style="margin-top:8px; width: 220px;" type="submit" name="btn-bulan" value="Tampilkan Laporan">  
         </form>
         <br/>
         <?php $namakantor = $_POST['kantor']; ?>
          <div class="card shadow mb-4">

            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Laporan Keuangan Harian <?php echo date('d F Y');?></h6>
              <h6 class="m-0 font-weight-bold text-primary">Perusahaan : <?php echo $namakantor; ?></h6>
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Jumlah Transaksi </th>
                      <th>Jumlah Total Uang</th>
                    <th>Whatsapp</th>    
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $perusahaan = $_SESSION['level'];
                    $tgl = date('Y-m-d');

                    $pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = '$tgl' and nama_perusahaan = '$namakantor' and NOT flag1 = 'Admin Slamet'");

                    while ($masuk1=mysqli_fetch_array($pemasukan1)){
                    $arraymasuk1[] = $masuk1['jumlah'];
                    }
                    $jumlahmasuk1 = array_sum($arraymasuk1);


                    $pengeluaran1=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran = '$tgl' and nama_perusahaan = '$namakantor' and NOT flag1 = 'Admin Slamet'");

                    while ($keluar1=mysqli_fetch_array($pengeluaran1)){
                    $arraykeluar1[] = $keluar1['jumlah'];
                    }
                    $jumlahkeluar1 = array_sum($arraykeluar1);


                    $query2 = mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = '$tgl' and nama_perusahaan = '$namakantor' and NOT flag1 = 'Admin Slamet'");
                    $query2 = mysqli_num_rows($query2);

                    $query3 = mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran = '$tgl' and nama_perusahaan = '$namakantor' and NOT flag1 = 'Admin Slamet'");

                    $query3 = mysqli_num_rows($query3);
                    $no1 = 1;
                   
                    $query4 = mysqli_query($koneksi,"SELECT * FROM admin where level = '$namakantor' and NOT nama_lengkap = 'admin slamet' and not email = 'pthariraenergi@gmail.com'");
                    while ($dapatwa=mysqli_fetch_assoc($query4)){
                    $arraywa = $dapatwa['no_hp'];
                    }
                    $nowa = $arraywa;
                 
                    ?>
                    <tr>
                      <td>Pemasukan</td>
                      <td><?=$query2?></td>
                      <td>Rp <?=number_format($jumlahmasuk1,0,',','.');?></td>
                      <td><a href="https://api.whatsapp.com/send?phone=<?php echo $nowa; ?>" target="_blank">Hubungi</a></td>
          
</tr>

                    <tr>
                      <td>Pengeluaran</td>
                      <td><?=$query3?></td>
                      <td>Rp <?=number_format($jumlahkeluar1,0,',','.');?></td>
             <td><a href="https://api.whatsapp.com/send?phone=<?php echo $nowa; ?>" target="_blank">Hubungi</a></td>
</tr>
                  </tbody> 
                </table>
                <br/>
              <?php
             
               
               if($jumlahmasuk1 > $jumlahkeluar1) {
               $sisa  = $jumlahmasuk1 - $jumlahkeluar1;
               $persen = ($sisa / $jumlahkeluar1);
               $x = round($persen,2) * 100;
               $judul = "Keuntungan";
               }
               elseif ($jumlahkeluar1 > $jumlahmasuk1) {
               $sisa  = $jumlahmasuk1 - $jumlahkeluar1;
               $persen = ($sisa / $jumlahkeluar1);
               $x = round($persen,2) * 100;
               $judul = "Pengeluaran";
               }


              ?>
              <p style="color: black;"><b>KETERANGAN </b></p>
              </div>
              <p style="color: #2C4D01;"><b> Saldo Tanggal <?php echo date('d F Y');?> (Pemasukan - Pengeluaran) : <?php echo "Rp ".number_format($sisa,0,',','.'); ?></b></p>
          
              <?php
                $perusahaan = $_SESSION['level'];
              
                $total_pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where nama_perusahaan = '$namakantor'  and NOT flag1 = 'Admin Slamet'");
                while ($total_masuk1=mysqli_fetch_array($total_pemasukan1)){
                $total_arraymasuk1[] = $total_masuk1['jumlah'];
                }
                $total_jumlahmasuk1 = array_sum($total_arraymasuk1);

                $total_pengeluaran1=mysqli_query($koneksi,"SELECT * FROM pengeluaran where nama_perusahaan = '$namakantor'  and NOT flag1 = 'Admin Slamet'");
                while ($total_keluar1=mysqli_fetch_array($total_pengeluaran1)){
                $total_arraykeluar1[] = $total_keluar1['jumlah'];
                }
                $total_jumlahkeluar1 = array_sum($total_arraykeluar1);

                $sisa  = $total_jumlahmasuk1 - $total_jumlahkeluar1;
              ?>
               <p style="color: red;"><b> Saldo s.d Per Tanggal  <?php echo date('d F Y');?> : <?php echo "Rp ".number_format($sisa,0,',','.'); ?></b></p>
              
            </div>
          </div>

        </div>
      <?php } ?>


         
        </div>
        <!-- /.container-fluid -->


      <!-- End of Main Content -->

<?php require 'footer.php'?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
<?php require 'logout-modal.php';?>

  <!-- Bootstrap core JavaScript-->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
