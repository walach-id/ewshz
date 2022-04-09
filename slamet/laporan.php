<?php
require 'cek-sesi.php';
error_reporting(0);
$date=date('Y-m-d');
$bulan = substr($date, 5, 2);
$tahun = substr($date, 0, 4);
$slamet = "Admin Slamet";
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

  <title>Laporan Keuangan</title>

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

<?php require 'navbar.php'; ?>
    <?php if($perusahaan != "admin") { ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <form action="#" method="POST">  
        <select style="width: 220px;" class="form-control" id="gender1" name="month">
          <option value="" selected disabled>Tampilkan Seluruh Bulan</option>
          <option value="Januari">Januari</option>
          <option value="Februari">Februari</option>
          <option value="Maret">Maret</option>
          <option value="April">April</option>
          <option value="Mei">Mei</option>
          <option value="Juni">Juni</option>
          <option value="Juli">Juli</option>
          <option value="Agustus">Agustus</option>
          <option value="September">September</option>
          <option value="Oktober">Oktober</option>
          <option value="November">November</option>
          <option value="Desember">Desember</option>
        </select>
        <input style="margin-top:8px; width: 220px;" type="submit" name="btn-bulan" value="Pilih Bulan">       
      </form>
      <?php
      if(isset($_POST['btn-bulan'])){
      $bulan_terpilih = $_POST['month'];  // Storing Selected Value In Variable  
      
      if ($bulan_terpilih=='Januari') {
        $bulanangka='01';
      }elseif ($bulan_terpilih=='Februari') {
        $bulanangka='02';
      }elseif ($bulan_terpilih=='Maret') {
        $bulanangka='03';
      }elseif ($bulan_terpilih=='April') {
        $bulanangka='04';
      }elseif ($bulan_terpilih=='Mei') {
        $bulanangka='05';
      }elseif ($bulan_terpilih=='Juni') {
        $bulanangka='06';
      }elseif ($bulan_terpilih=='Juli') {
        $bulanangka='07';
      }elseif ($bulan_terpilih=='Agustus') {
        $bulanangka='08';
      }elseif ($bulan_terpilih=='September') {
        $bulanangka='09';
      }elseif ($bulan_terpilih=='Oktober') {
        $bulanangka='10';
      }elseif ($bulan_terpilih=='November') {
        $bulanangka='11';
      }elseif ($bulan_terpilih=='Desember') {
        $bulanangka='12';
      }  
         }
      ?>
     
        <br>       
                   <!-- DataTales Bulan ini -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Laporan Keuangan Bulan <?php echo "$bulan_terpilih" ."&nbsp"."$tahun"?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Jumlah Transaksi </th>
                      <th>Jumlah Total Uang</th>
					  <th>Download</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$perusahaan = $_SESSION['level'];
// SELECT * FROM pemasukan where month(tgl_pemasukan)= '12'

//$pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where month(tgl_pemasukan) like '%$tahun%' AND tgl_pemasukan like '%$bulanangka%' and nama_perusahaan = '$perusahaan' ");

$pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where month(tgl_pemasukan) = '$bulanangka' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");

while ($masuk1=mysqli_fetch_array($pemasukan1)){
$arraymasuk1[] = $masuk1['jumlah'];
}
$jumlahmasuk1 = array_sum($arraymasuk1);

$pengeluaran1=mysqli_query($koneksi,"SELECT * FROM pengeluaran where month(tgl_pengeluaran) = '$bulanangka' and nama_perusahaan = '$perusahaan'  and flag1 = '$slamet'");

while ($keluar1=mysqli_fetch_array($pengeluaran1)){
$arraykeluar1[] = $keluar1['jumlah'];
}
$jumlahkeluar1 = array_sum($arraykeluar1);


$query2 = mysqli_query($koneksi,"SELECT * FROM pemasukan where month(tgl_pemasukan) = '$bulanangka' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
$query2 = mysqli_num_rows($query2);

$query3 = mysqli_query($koneksi,"SELECT id_pengeluaran FROM pengeluaran where month(tgl_pengeluaran) = '$bulanangka' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");

$query3 = mysqli_num_rows($query3);
$no1 = 1;
?>
                    <tr>
                      <td>Pemasukan</td>
                      <td><?=$query2?></td>
                      <td>Rp. <?=number_format($jumlahmasuk1,2,',','.');?></td>
					  <td>
                    <!-- Button untuk modal -->
<a href="export-pemasukan-bulan.php?bulan=<?php echo $bulanangka; ?>" type="button" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a>
</td>
</tr>

                    <tr>
                      <td>Pengeluaran</td>
                      <td><?=$query3?></td>
                      <td>Rp. <?=number_format($jumlahkeluar1,2,',','.');?></td>
					  <td>
                    <!-- Button untuk modal -->
<a href="export-pengeluaran-bulan.php?bulan=<?php echo $bulanangka; ?>" type="button" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a>
</td>
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

               $total_pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where nama_perusahaan = '$perusahaan'and flag1 = '$slamet'");
                while ($total_masuk1=mysqli_fetch_array($total_pemasukan1)){
                $total_arraymasuk1[] = $total_masuk1['jumlah'];
                }
                $total_jumlahmasuk1 = array_sum($total_arraymasuk1);

                $total_pengeluaran1=mysqli_query($koneksi,"SELECT * FROM pengeluaran where nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
                while ($total_keluar1=mysqli_fetch_array($total_pengeluaran1)){
                $total_arraykeluar1[] = $total_keluar1['jumlah'];
                }
                $total_jumlahkeluar1 = array_sum($total_arraykeluar1);

                $sisaa  = $total_jumlahmasuk1 - $total_jumlahkeluar1;


              ?>
              <p style="color: black;"><b>KETERANGAN </b></p>
              </div>
              <p style="color: green;"><b> Saldo Bulan <?php echo $bulan_terpilih; ?> : <?php echo "Rp. ".number_format($sisa,2,',','.'); ?></b></p>
               <p style="color: red;"><b> Saldo Saat Ini Per Tanggal  <?php echo date('d F Y');?> : <?php echo "Rp. ".number_format($sisaa,2,',','.'); ?></b></p>
             
            </div>
          </div>

        </div>

        </div>
      <?php } else { ?>
            <!-- Begin Page Content -->
        <div class="container-fluid">
        <form action="#" method="POST">  
        <select style="width: 220px;" class="form-control" id="gender1" name="kantor">
          <option value="" selected disabled>PILIH PERUSAHAAN</option>
         <?php
            $queryy = "select * from admin where level NOT IN('admin')";
            $hasil = mysqli_query($koneksi,$queryy);
            while ($qtabel = mysqli_fetch_assoc($hasil))
            {
              echo '<option value="'.$qtabel['level'].'">'.$qtabel['nama_lengkap'].'</option>';        
            }
         ?>
           
        </select>
        <br>
        <select style="width: 220px;" class="form-control" id="gender1" name="month">
          <option value="" selected disabled>PILIH BULAN</option>
          <option value="Januari">Januari</option>
          <option value="Februari">Februari</option>
          <option value="Maret">Maret</option>
          <option value="April">April</option>
          <option value="Mei">Mei</option>
          <option value="Juni">Juni</option>
          <option value="Juli">Juli</option>
          <option value="Agustus">Agustus</option>
          <option value="September">September</option>
          <option value="Oktober">Oktober</option>
          <option value="November">November</option>
          <option value="Desember">Desember</option>
        </select>
        <input style="margin-top:8px; width: 220px;" type="submit" name="btn-bulan" value="Tampilkan Laporan">       
      </form>
      <?php
      $namakantor = $_POST['kantor'];
      if(isset($_POST['btn-bulan'])){
      $bulan_terpilih = $_POST['month'];  // Storing Selected Value In Variable  
      
      if ($bulan_terpilih=='Januari') {
        $bulanangka='01';
      }elseif ($bulan_terpilih=='Februari') {
        $bulanangka='02';
      }elseif ($bulan_terpilih=='Maret') {
        $bulanangka='03';
      }elseif ($bulan_terpilih=='April') {
        $bulanangka='04';
      }elseif ($bulan_terpilih=='Mei') {
        $bulanangka='05';
      }elseif ($bulan_terpilih=='Juni') {
        $bulanangka='06';
      }elseif ($bulan_terpilih=='Juli') {
        $bulanangka='07';
      }elseif ($bulan_terpilih=='Agustus') {
        $bulanangka='08';
      }elseif ($bulan_terpilih=='September') {
        $bulanangka='09';
      }elseif ($bulan_terpilih=='Oktober') {
        $bulanangka='10';
      }elseif ($bulan_terpilih=='November') {
        $bulanangka='11';
      }elseif ($bulan_terpilih=='Desember') {
        $bulanangka='12';
      }  
         }
      ?>
     
        <br>       
                   <!-- DataTales Bulan ini -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Laporan Keuangan Bulan <?php echo "$bulan_terpilih" ."&nbsp"."$tahun"?></h6>
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
            <th>Download</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$perusahaan = $_SESSION['level'];
// SELECT * FROM pemasukan where month(tgl_pemasukan)= '12'

//$pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where month(tgl_pemasukan) like '%$tahun%' AND tgl_pemasukan like '%$bulanangka%' and nama_perusahaan = '$perusahaan' ");

$pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where month(tgl_pemasukan) = '$bulanangka' and nama_perusahaan = '$namakantor' ");

while ($masuk1=mysqli_fetch_array($pemasukan1)){
$arraymasuk1[] = $masuk1['jumlah'];
}
$jumlahmasuk1 = array_sum($arraymasuk1);


$pengeluaran1=mysqli_query($koneksi,"SELECT * FROM pengeluaran where month(tgl_pengeluaran) = '$bulanangka' and nama_perusahaan = '$namakantor' ");

while ($keluar1=mysqli_fetch_array($pengeluaran1)){
$arraykeluar1[] = $keluar1['jumlah'];
}
$jumlahkeluar1 = array_sum($arraykeluar1);


$query2 = mysqli_query($koneksi,"SELECT * FROM pemasukan where month(tgl_pemasukan) = '$bulanangka' and nama_perusahaan = '$namakantor'");
$query2 = mysqli_num_rows($query2);

$query3 = mysqli_query($koneksi,"SELECT id_pengeluaran FROM pengeluaran where month(tgl_pengeluaran) = '$bulanangka' and nama_perusahaan = '$namakantor'");

$query3 = mysqli_num_rows($query3);
$no1 = 1;
?>
                    <tr>
                      <td>Pemasukan</td>
                      <td><?=$query2?></td>
                      <td>Rp. <?=number_format($jumlahmasuk1,2,',','.');?></td>
            <td>
                    <!-- Button untuk modal -->
<a href="export-pemasukan-bulan.php?bulan=<?php echo $bulanangka; ?>" type="button" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a>
</td>
</tr>

                    <tr>
                      <td>Pengeluaran</td>
                      <td><?=$query3?></td>
                      <td>Rp. <?=number_format($jumlahkeluar1,2,',','.');?></td>
            <td>
                    <!-- Button untuk modal -->
<a href="export-pengeluaran-bulan.php?bulan=<?php echo $bulanangka; ?>" type="button" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a>
</td>
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

               $total_pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where nama_perusahaan = '$perusahaan'");
                while ($total_masuk1=mysqli_fetch_array($total_pemasukan1)){
                $total_arraymasuk1[] = $total_masuk1['jumlah'];
                }
                $total_jumlahmasuk1 = array_sum($total_arraymasuk1);

                $total_pengeluaran1=mysqli_query($koneksi,"SELECT * FROM pengeluaran where nama_perusahaan = '$perusahaan' ");
                while ($total_keluar1=mysqli_fetch_array($total_pengeluaran1)){
                $total_arraykeluar1[] = $total_keluar1['jumlah'];
                }
                $total_jumlahkeluar1 = array_sum($total_arraykeluar1);

                $sisaa  = $total_jumlahmasuk1 - $total_jumlahkeluar1;


              ?>
              <p style="color: black;"><b>KETERANGAN </b></p>
              </div>
              <p style="color: green;"><b> Saldo Bulan <?php echo $bulan_terpilih; ?> : <?php echo "Rp. ".number_format($sisa,2,',','.'); ?></b></p>
               <p style="color: red;"><b> Saldo Saat Ini Per Tanggal  <?php echo date('d F Y');?> : <?php echo "Rp. ".number_format($sisaa,2,',','.'); ?></b></p>
             
            </div>
          </div>

        </div>

        </div>
      <?php } ?>
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
